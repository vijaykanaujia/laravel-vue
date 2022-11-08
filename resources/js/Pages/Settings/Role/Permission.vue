<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import VijayAccordion from '@/Components/Accordion.vue';
import {
    Head,
    Link,
    useForm
} from "@inertiajs/inertia-vue3";
import BreezeButton from '@/Components/Button.vue';

const props = defineProps({
    'title': String,
    'role': Object,
    'menus': Object,
    'token': String
});

const getPosition = (len,index) => {
    if(index == 0){
        return 'first';
    }else if(index == (len - 1) & index != 0){
        return 'last'
    }else{
        return 'middle';
    }
}
const form = useForm({
    permissions: _.map(props.role.permissions, (val) => val.id),
    _token : props.token
});

const reset = () => {
    form.permissions = _.map(props.role.permissions, (val) => val.id);
}
const clearAll = () => {
    form.permissions = [];
}
const selectAll = () => {
    let all = [];
    _.map(props.menus, (val) => {
        _.map(val.permissions, (val) => { all.push(val.id) });
    });
    form.permissions = all;
}
const save = () => {
    form.post(route('role.permission', props.role.id), {
        onSuccess: () => {},
        onError: (errors) => {debugger},
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
                
                <BreezeButton @click="save" class="ml-4 float-right">
                    Save
                </BreezeButton>
                <BreezeButton @click="selectAll" class="ml-4 float-right">
                    Select All
                </BreezeButton>
                <BreezeButton @click="clearAll" class="ml-4 float-right">
                    Clear All
                </BreezeButton>
                <BreezeButton @click="reset" class="ml-4 float-right">
                    Reset
                </BreezeButton>
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
                    <div v-for="(menu, index) in menus" :key="menu.id">
                        <template v-if="menu.permissions.length">
                            <VijayAccordion :accordionTitle="menu.title" :accordionName="menu.page.replace('.','-')" :isOpen="true" :accordionPosition="getPosition(menus.length,index)">
                                <template #body>
                                    <div class="grid grid-cols-4 gap-1">
                                        <div v-for="permission in menu.permissions" :key="permission.id">
                                            <div class="flex items-center mb-4">
                                                <input @click="onSelected" :id="'permission_'+permission.id" :value="permission.id" type="checkbox" v-model="form.permissions" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                <label :for="'permission_'+permission.id" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ permission.name }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </VijayAccordion>
                        </template>
                        <template v-else>
                            <VijayAccordion :accordionTitle="menu.title" :accordionName="menu.page.replace('.','-')" :isOpen="true" :accordionPosition="getPosition(menus.length,index)">
                                <template #body>
                                    <p class="text-center text-orange-400 p-4">Permissions not found!</p>
                                </template>
                            </VijayAccordion>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>
</BreezeAuthenticatedLayout>
</template>
