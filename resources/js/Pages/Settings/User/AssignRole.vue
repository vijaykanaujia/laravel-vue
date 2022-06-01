<script setup>
import BreezeButton from '@/Components/Button.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeSelect from '@/Components/Select.vue';
import BreezeError from '@/Components/InputError.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import {
    Head,
    useForm
} from '@inertiajs/inertia-vue3';
import { getCurrentInstance, onUnmounted } from 'vue';

const app = getCurrentInstance();
const props = defineProps({
    'title': String,
    'user_id': Number,
});
const modalData = app.appContext.config.globalProperties.modalData;
console.log(modalData);
const form = useForm({
    user: '',
    roles: '',
    _token : '{{csrf_token()}}'
});

const submit = () => {
    form.post(route('role.store'), {
        onSuccess: () => {form.reset()},
        onError: (errors) => {debugger},
    });
};

onUnmounted(() => {
    app.appContext.config.globalProperties.modalData = {};
});

</script>

<template>
<Head :title="title" />

<BreezeValidationErrors class="mb-4" />
<form @submit.prevent="submit">
    <div class="grid grid-cols-1 gap-2">

        <div>
            <BreezeLabel for="name" value="Name" />
            <BreezeInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" autocomplete="name" />
            <BreezeError :message="form.errors.name" />
        </div>

        <div>
            <BreezeLabel for="guard_name" value="Guard Name" />
            <BreezeSelect :options="[{id : 'web', text : 'WEB', selected : 1},{id : 'api', text : 'API', selected : 0}]" id="guard_name" class="mt-1 block w-full" v-model="form.guard_name" autocomplete="Select Name" />
            <BreezeError :message="form.errors.guard_name" />
        </div>
        <div class="col-span-1">

            <div class="flex items-center justify-end">
                <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Save
                </BreezeButton>
            </div>
        </div>
    </div>
</form>
</template>
