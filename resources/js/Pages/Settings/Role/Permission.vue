<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import {
    Head,
    Link,
useForm
} from "@inertiajs/inertia-vue3";

const props = defineProps({
    'title': String,
    'role': Object,
    'menus': Object,
    'token': String,
});

const form = useForm({
    permissions: []
});
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
                    dsgfdsfdsf
                </div>
            </div>
        </div>
    </div>
</BreezeAuthenticatedLayout>
</template>
