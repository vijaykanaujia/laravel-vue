<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import BreezeButton from '@/Components/Button.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeSelect from '@/Components/Select.vue';
import BreezeError from '@/Components/InputError.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import {
    Head,
    useForm,
    Link
} from '@inertiajs/inertia-vue3';

const props = defineProps({
    'title': String,
    'role': Object,
    'token': String
});

const form = useForm({
    name: props.role.name,
    guard_name: props.role.guard_name,
    _token: props.token
});

const submit = () => {
    form.put(route('role.update', props.role.id), {
        preserveState : true,
        onSuccess: () => {
            
        },
        onError: (errors) => {
            debugger
        },
    });
};
</script>

<template>
<Head :title="title" />
<BreezeAuthenticatedLayout>
    <template #header>
        <div class="flex justify-between">
            <div>
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{title}}
        </h2>
            </div>
            <div>
                <Link :href="route('role.index')">
                    <BreezeButton class="ml-4 float-right">
                        Back
                    </BreezeButton>
                </Link>
            </div>
        </div>
    </template>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <BreezeValidationErrors class="mb-4" />
                    <form @submit.prevent="submit">
                        <div class="grid grid-cols-1 gap-2">

                            <div>
                                <BreezeLabel for="name" value="Name" />
                                <BreezeInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" autofocus autocomplete="name" />
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
                </div>
            </div>
        </div>
    </div>
</BreezeAuthenticatedLayout>
</template>
