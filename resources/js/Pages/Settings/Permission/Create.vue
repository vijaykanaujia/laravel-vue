<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import BreezeButton from '@/Components/Button.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeSelect from '@/Components/Select.vue';
import BreezeError from '@/Components/InputError.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import { useToast } from "vue-toastification";
import { Inertia } from "@inertiajs/inertia";

const props = defineProps({
    'title': String,
    'menuList': Object,
    'token' : String
});
const toast = useToast();
const form = useForm({
    name: '',
    guard_name: 'web',
    menu_id: '',
    _token: props.token
});

const submit = () => {
    form.post(route('permission.store'), {
        onSuccess: () => {
            form.reset();
            toast.success('Permission created successfully');
            Inertia.get(route('permission.index'));
        },
        onError: (errors) => {
            toast.error('Something went wrong!');
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
                <Link :href="route('permission.index')">
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
                        <div class="grid grid-cols-4 gap-2">

                            <div>
                                <BreezeLabel for="name" value="Permission Name" />
                                <BreezeInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" autocomplete="name" />
                                <BreezeError :message="form.errors.name" />
                            </div>

                            <div>
                                <BreezeLabel for="guard_name" value="guard_name" />
                                <BreezeSelect value="web" :options="[{id : 'web', text : 'WEB'},{id : 'api', text : 'API'}]" id="guard_name" class="mt-1 block w-full" v-model="form.guard_name" />
                                <BreezeError :message="form.errors.guard_name" />
                            </div>

                            <div>
                                <BreezeLabel for="menu_id" value="Menu Name" />
                                <BreezeSelect :options="menuList" id="menu_id" class="mt-1 block w-full" v-model="form.menu_id" />
                                <BreezeError :message="form.errors.menu_id" />
                            </div>

                            <div class="col-span-4">
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
