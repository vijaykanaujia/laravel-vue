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
import { ref } from "vue";

const props = defineProps({
    'title': String,
    'token' : String,
    'roles' : Array
});
const form = useForm({
    name: '',
    email: '',
    password : '',
    confirm_password: '',
    roles : [],
    _token: props.token
});
console.log(props.roles);
const submit = () => {
    debugger;
    form.post(route('user.store'), {
        onSuccess: () => {
            form.reset()
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
                <Link :href="route('user.index')">
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
                                <BreezeLabel for="name" value="Name" />
                                <BreezeInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" />
                                <BreezeError :message="form.errors.name" />
                            </div>

                            <div>
                                <BreezeLabel for="email" value="Email" />
                                <BreezeInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" />
                                <BreezeError :message="form.errors.email" />
                            </div>

                            <div>
                                <BreezeLabel for="password" value="Password" />
                                <BreezeInput id="password" type="password" class="mt-1 block w-full" v-model="form.password"/>
                                <BreezeError :message="form.errors.password" />
                            </div>
                            <div>
                                <BreezeLabel for="confirm_password" value="Confirm Password" />
                                <BreezeInput id="confirm_password" type="password" class="mt-1 block w-full" v-model="form.confirm_password" />
                                <BreezeError :message="form.errors.confirm_password" />
                            </div>
                            <div>
                                <BreezeLabel for="roles" value="Role" />
                                <!-- <BreezeSelect :options="roles" id="roles" class="mt-1 block w-full" v-model="form.roles" :multiple="true" /> -->
                                <select class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" v-model="form.roles" multiple>
                                    <template v-if="Object.keys(roles).length">
                                        <option v-for="option in roles" :key="option.id" :value="option.id">{{option.text}}</option>
                                    </template>
                                    <template v-else>
                                        <option value=""></option>
                                    </template>
                                </select>
                                <BreezeError :message="form.errors.roles" />
                                {{form.roles}}
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
