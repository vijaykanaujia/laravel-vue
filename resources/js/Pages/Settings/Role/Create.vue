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

<script setup>
import BreezeButton from '@/Components/Button.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeSelect from '@/Components/Select.vue';
import BreezeError from '@/Components/InputError.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import { Head, useForm } from "@inertiajs/inertia-vue3";
import { useToast } from "vue-toastification";

defineProps({
    'title': String,
});
const toast = useToast();
const form = useForm({
    name: '',
    guard_name: '',
    _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
});

const submit = () => {
    form.post(route('role.store'), {
        onSuccess: () => {
            form.reset()
            toast.success('Role created successfully');
        },
        onError: (errors) => {
            toast.error('Something went wrong!');
        },
    });
};
</script>
