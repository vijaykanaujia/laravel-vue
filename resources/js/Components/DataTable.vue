<script setup>
import {
    Link
} from '@inertiajs/inertia-vue3'
import {
    ref,
    computed
} from 'vue';
import {
    Inertia
} from '@inertiajs/inertia'

const props = defineProps({
    'displayedColumns': Object,
    'dataSource': Object,
    'orderBy': String,
    'orderField': String
});

const emit = defineEmits(['sortingOrder', 'multiAction'])

const selected = ref([]);
const selectAll = computed({
    get: () => {
        emit('multiAction', selected.value);
        return props.dataSource ? props.dataSource.length == selected.value.length : false;
    },
    set: (val) => {
        var temp = [];
        if (val) {
            props.dataSource.forEach(function (d) {
                temp.push(d.id);
            });
        }
        emit('multiAction', selected.value = temp);
    }
});

function getRowVal(obj, key) {
    return _.get(obj, key, '...');
}

function changeOrder(field, order) {
    emit('sortingOrder', {
        orderField: field,
        orderBy: order == 'asc' ? 'desc' : 'asc'
    });
}
</script>

<template>
<table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <template v-for="col in displayedColumns" :key="col.ref">
                <th v-if="col.ref =='select'" scope="col" class="px-6 py-3">
                    <input type="checkbox" v-model="selectAll">
                </th>
                <th v-if="(['select','action']).indexOf(col.ref) == -1" scope="col" class="px-6 py-3">
                    {{col.name}}
                    <template v-if="orderField == col.ref">
                        <span class="arrow asc desc" :class="[(orderBy == 'desc') ? 'active-desc' : 'active-asc']" @click="changeOrder(orderField, orderBy)"></span>
                    </template>
                    <template v-else>
                        <span class="arrow desc asc" @click="changeOrder(col.ref, 'desc')"></span>
                    </template>
                </th>
                <th v-if="col.ref =='action'" scope="col" class="px-6 py-3">
                    Action
                </th>
            </template>
        </tr>
    </thead>
    <tbody>
        <template v-if="dataSource.length">
            <template v-for="row in dataSource" :key="row.id">
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <template v-for="filter_col in displayedColumns">
                        <td v-if="filter_col.ref == 'select'" class="px-6 py-4">
                            <input type="checkbox" v-model="selected" :value="row.id">
                        </td>
                        <td v-if="(['select','action']).indexOf(filter_col.ref) == -1" class="px-6 py-4">
                            {{ getRowVal(row, filter_col.ref) }}
                        </td>
                        <td v-if="filter_col.ref == 'action'" class="px-6 py-4">
                            <div v-if="filter_col.action_type.length > 0" class="flex space-x-4 text-right">
                                <template v-for="action in filter_col.action_type">
                                    <Link v-if="action.name == 'edit'" :href="route(action.route_name, row.id)" title="Edit">
                                    <svg class="w-6 h-6 stroke-black hover:stroke-cyan-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                    </svg>
                                    </Link>
                                    <Link v-if="action.name == 'delete'" :href="route(action.route_name, row.id)" method="delete">
                                    <svg class="w-6 h-6 stroke-black hover:stroke-cyan-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" />
                                    </svg>
                                    </Link>
                                </template>
                            </div>
                        </td>
                    </template>
                </tr>
            </template>
        </template>
        <template v-else>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
            <td :colspan="displayedColumns.length" class="text-center text-orange-400 p-4">No Data</td>
            </tr>
        </template>
    </tbody>
</table>
</template>

<style scoped>
.arrow {
    display: inline-block;
    vertical-align: middle;
    width: 0;
    height: 0;
    margin-left: 5px;
    opacity: 0.66;
}

.arrow.asc {
    border-left: 4px solid transparent;
    border-right: 4px solid transparent;
    border-bottom: 4px solid var(--primary-color);
}

.arrow.desc {
    border-left: 4px solid transparent;
    border-right: 4px solid transparent;
    border-top: 4px solid var(--primary-color);
}
.arrow.active-asc{
    border-bottom: 4px solid rgb(129 140 248);
}
.arrow.active-desc{
    border-top: 4px solid rgb(129 140 248);
}
</style>
