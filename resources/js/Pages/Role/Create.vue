<script setup>
import BreezeButton from '@/Components/Button.vue';
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import {
    Head,
    Link,
    useForm
} from '@inertiajs/inertia-vue3';

import Modal from '@/Components/Modal.vue'

defineProps({
    'title': String,
});

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
<Head :title="title" />

<BreezeAuthenticatedLayout>
    <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ title }}
        </h2>
    </template>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <Modal />
                        <BreezeValidationErrors class="mb-4" />
                        <form @submit.prevent="submit">
                            <div class="grid grid-cols-4 gap-2">

                                <div>
                                    <BreezeLabel for="name" value="Name" />
                                    <BreezeInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
                                </div>

                                <div>
                                    <BreezeLabel for="email" value="Email" />
                                    <BreezeInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autocomplete="username" />
                                </div>

                                <div>
                                    <BreezeLabel for="password" value="Password" />
                                    <BreezeInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="new-password" />
                                </div>

                                <div>
                                    <BreezeLabel for="password_confirmation" value="Confirm Password" />
                                    <BreezeInput id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" required autocomplete="new-password" />
                                </div>
                                <div class="col-span-4">

                                    <div class="flex items-center justify-end">
                                        <Link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900">
                                    Already registered?
                                    </Link>

                                    <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                        Register
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
