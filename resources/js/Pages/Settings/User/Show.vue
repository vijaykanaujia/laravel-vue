<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import BreezeButton from '@/Components/Button.vue';

defineProps({
    'title' : ''
});
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
                        show user details here
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
