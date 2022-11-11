<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import BreezeButton from "@/Components/Button.vue";
import Pagination from "@/Components/Pagination.vue";
import DataTable from "@/Components/DataTable.vue";
import { Head } from "@inertiajs/inertia-vue3";
import Modal from "@/Components/Modal.vue";
import CreateRoleComponent from "@/Pages/Settings/Role/Create.vue";
import { watch, computed, ref } from "vue";
import { useToast } from "vue-toastification";

defineProps({
    page: Number,
    pageSize: Number,
    cols: Array,
    filter: String,
    orderField: String,
    orderBy: String,
    displayedColumns: Array,
    dataSource: Object,
    title: String,
});
// const app = getCurrentInstance();
const toast = useToast();

const search_all = ref("");
const showModal = ref(false);

watch(search_all, (val) => {
    if ((val.length <= 3) & (val.length != 0)) {
        return;
    }
    let q = val.length ? { filter: JSON.stringify({ all: val }) } : {};
    fetchData(q);
});

const action_ids = ref([]);
const activate_action = ref(false);
const trigger_action = computed(() => {
    return activate_action.value;
});
function fnMultiAction(data) {
    activate_action.value = data.length ? true : false;
    action_ids.value = data;
}

function fnSortingOrder(data) {
    fetchData(data);
}

async function fetchData(q, preserveState = true) {
    Inertia.get(route("role.index"), q, {
        preserveState: preserveState,
    });
    return false;
}

const multiDelete = () => {
    Inertia.delete(route("role.destroy", 0), {
        data: {
            ids: action_ids.value,
            action_type: "multi-delete",
        },
        onBefore: () => confirm("Are you sure you want to delete these roles?"),
        onSuccess: (page) => {
            activate_action.value = false;
            toast.success("Roles deleted successfully");
        },
        onError: (errors) => {
            toast.error("Something went wrong!");
        },
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
                        <div class="relative shadow-md sm:rounded-lg">
                            <div class="flex">
                                <div class="w-2/5">
                                    <div class="p-4">
                                        <label
                                            for="table-search"
                                            class="sr-only"
                                            >Search</label
                                        >
                                        <div class="relative mt-1">
                                            <div
                                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"
                                            >
                                                <svg
                                                    class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                                    fill="currentColor"
                                                    viewBox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                        clip-rule="evenodd"
                                                    ></path>
                                                </svg>
                                            </div>
                                            <input
                                                v-model="search_all"
                                                type="text"
                                                id="table-search"
                                                class="bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 pl-10 p-2.5  dark:bg-gray-200 dark:border-gray-300 dark:placeholder-gray-900 dark:text-gray-900 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Search for items"
                                            />
                                        </div>
                                    </div>
                                </div>
                                <div class="w-3/5">
                                    <div class="p-4">
                                        <!-- <Link :href="route('role.create')"> -->
                                        <BreezeButton
                                            class="ml-4 float-right"
                                            @click="showModal = true"
                                        >
                                            Add Role
                                        </BreezeButton>
                                        <!-- </Link> -->
                                        <Modal
                                            :show="showModal"
                                            :title="'Create Role'"
                                            @close="showModal = false"
                                        >
                                            <template #body>
                                                <CreateRoleComponent
                                                    :title="'Create Role'"
                                                ></CreateRoleComponent>
                                            </template>
                                            <template #footer>&nbsp;</template>
                                        </Modal>
                                    </div>
                                </div>
                            </div>
                            <template v-if="trigger_action">
                                <div class="flex">
                                    <div>
                                        <BreezeButton
                                            @click="multiDelete"
                                            class="ml-4"
                                        >
                                            delete
                                        </BreezeButton>
                                    </div>
                                </div>
                            </template>
                            <DataTable
                                :displayed-columns="displayedColumns"
                                :data-source="dataSource.data"
                                :order-by="orderBy"
                                :order-field="orderField"
                                @sorting-order="fnSortingOrder"
                                @multi-action="fnMultiAction"
                            />
                            <Pagination
                                class="my-2"
                                :links="dataSource.links"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
