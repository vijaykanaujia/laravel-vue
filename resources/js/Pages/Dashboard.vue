<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';

import { Head, useToast, onMounted } from "@/Utils/vuex-helpers"

import LanguageSelector from '@/Shared/LanguageSelector.vue'

const toast = useToast();
defineProps({
    'title': String
});

</script>

<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{title}}
                </h2>
            </div>
            <div>
                <div class="flex">
                    <span>Launguage : </span>
                    <LanguageSelector />
                </div>
            </div>
        </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div>language test : {{__('dashboard.test')}}</div>
                        You're logged in!
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
