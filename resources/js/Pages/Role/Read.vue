<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import BreezeButton from "@/Components/Button.vue";
import {
    Head,
    Link
} from "@inertiajs/inertia-vue3";
import DataTable from "@/Components/DataTable.vue";

defineProps({
    'page': Number,
    'pageSize': Number,
    'cols': Array,
    'filter': Array,
    'orderField': String,
    'orderBy': String,
    'displayedColumns': Array,
    'dataSource': Object,
    'title': String,
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
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <div class="flex">
                            <div class="w-2/5">
                                <div class="p-4">
                                    <label for="table-search" class="sr-only">Search</label>
                                    <div class="relative mt-1">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <input type="text" id="table-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for items">
                                    </div>
                                </div>
                            </div>
                            <div class="w-3/5 text-right">
                                <div class="p-4">
                                    <Link :href="route('role.create')">
                                    <BreezeButton class="ml-4">
                                        Add Role
                                    </BreezeButton>
                                    </Link>
                                </div>
                            </div>
                        </div>
                        <DataTable :displayed-columns="displayedColumns" :data-source="dataSource.data" :order-by="orderBy" :order-field="orderField" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</BreezeAuthenticatedLayout>
</template>
