<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import BreezeButton from "@/Components/Button.vue";
import { Head, Link, ref } from "@/Utils/vuex-helpers";
import moment from "moment";

defineProps({
    title: String,
    model: Object
});
</script>

<template>
    <Head :title="title" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <div>
                    <h2
                        class="font-semibold text-xl text-gray-800 leading-tight"
                    >
                        {{ title }}
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
                        <table class="table-auto w-full     ">
                            <tbody>
                                <tr>
                                    <td>Id</td>
                                    <td>{{model.id}}</td>
                                </tr>
                                <tr>
                                    <td>Name</td>
                                    <td>{{model.name}}</td>
                                </tr>
                                <tr>
                                    <td>Guard Name</td>
                                    <td>{{model.guard_name}}</td>
                                </tr>
                                <tr>
                                    <td>Created At</td>
                                    <td>{{moment(model.created_at).format('DD/MM/YY')}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
