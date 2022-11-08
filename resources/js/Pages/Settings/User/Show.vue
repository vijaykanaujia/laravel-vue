<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import BreezeButton from "@/Components/Button.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import moment from "moment";
import { ref } from "vue";

defineProps({
    title: String,
    user: Object
});

const badge = ref("bg-blue-100 text-blue-800 text-xs font-semibold m-1 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800");

const getRoles = (roles) => {

    return _.join(_.map(roles, (v) => v.name), ',');
}
const getPermissions = (permissions) => {

    let per = [];
    _.forEach(permissions, (v) => {
         per.push(_.map(v.permissions, (v) => '<span class="'+badge.value+'">' + v.name + '</span>'));
    });
    return _.join(per, "~");
}
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
                        <table class="table-auto w-full     ">
                            <tbody>
                                <tr>
                                    <td>Name</td>
                                    <td>{{user.name}}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>{{user.email}}</td>
                                </tr>
                                <tr>
                                    <td>Created At</td>
                                    <td>{{moment(user.created_at).format('DD/MM/YY')}}</td>
                                </tr>
                                <tr>
                                    <td>Role</td>
                                    <td>{{getRoles(user.roles)}}</td>
                                </tr>
                                <tr>
                                    <td>Permissions</td>
                                    <td><div v-html="getPermissions(user.roles)"></div></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
