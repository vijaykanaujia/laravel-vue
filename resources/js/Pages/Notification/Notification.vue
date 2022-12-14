<script setup>
import { Inertia } from "@inertiajs/inertia";
import { usePage } from "@inertiajs/inertia-vue3";
import moment from "moment";
import { onMounted, ref, toDisplayString } from "vue";
import { useToast } from "vue-toastification";
import BreezeDropdown from "../../Components/Dropdown.vue";
// import AcademicCapIcon from '@heroicons/vue/outline/BellIcon';

const props = ref({
    notifications: Array,
    badge: Number,
    notificationType: String,
});
props.value.badge = 0;
const toast = useToast();
function getNotifications(notificationType = "limited") {
    axios
        .get(route("notification"), {
            params: {
                notificationType: notificationType,
            },
        })
        .then(function (response) {
            props.value.notifications = response.data.data.notifications;
            props.value.badge = response.data.data.badge;
            props.value.notificationType = response.data.data.notificationType;
        })
        .catch(function (error) {
            toast.error(error.response.data.message);
        });
}
onMounted(() => {
    getNotifications();
    Echo.private(`App.Models.User.${usePage().props.value.auth.user.id}`)
    .notification((notification) => {
        console.log(notification);
    }).error((error)=>{
        debugger;
    });

    // Echo.join(`test-channel`)
    // .here((users) => {
    //     console.log(users);
    // })
    // .joining((user) => {
    //     console.log(user.name);
    // })
    // .leaving((user) => {
    //     console.log(user.name);
    // })
    // .error((error) => {
    //     console.error(error);
    // });
});

function getReadNotification() {
    getNotifications("read");
}

function getUnreadNotification() {
    getNotifications("unread");
}

function getAllNotification() {
    getNotifications("all");
}

function markAsReadNotification(id = 0) {
    axios
        .put(route("mark_as_read", { id: id }))
        .then(function (response) {
            getNotifications(props.value.notificationType);
            toast.success(response.data.message);
        })
        .catch(function (error) {
            toast.error(error.response.data.message);
        });
}

function deleteNotification(id = 0) {
    axios
        .delete(route("delete.notification", { id: id }))
        .then(function (response) {
            getNotifications(props.value.notificationType);
            toast.success(response.data.message);
        })
        .catch(function (error) {
            toast.error(error.response.data.message);
        });
}

function getFormattedDate(value) {
    return value ? moment(value).format("DD-MM-YYYY") : "...";
}
</script>

<template>
    <BreezeDropdown align="right" width="80">
        <template #trigger>
            <span class="inline-flex rounded-md">
                <button
                    type="button"
                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                >
                    <div
                        class="z-30 inline-flex absolute -top-2 -right-1 justify-center items-center w-6 h-6 text-xs font-bold text-white bg-red-500 rounded-full border-2 dark:border-gray-900"
                    >
                        {{ props.badge }}
                    </div>
                    <!-- <AcademicCapIcon class="h-6 w-6 text-blue-500"/> -->
                    <font-awesome-icon
                        icon="fa-regular fa-bell"
                        class="h-4 w-4"
                    />
                </button>
            </span>
        </template>

        <template #content>
            <div id="notification_container" class="grid grid-flow-colid">
                <div class="header p-2 bg-gray-200">
                    <h4 class="mb-1">Notifications</h4>
                    <ul class="flex space-x-2">
                        <!-- <li class="basis-5/12"></li> -->
                        <li
                            class="cursor-pointer text-xs"
                            @click="getAllNotification()"
                        >
                            <span
                                class="bg-gray-600 border-r-0 px-1 rounded text-white"
                                >All</span
                            >
                        </li>
                        <li
                            class="cursor-pointer text-xs"
                            @click="getReadNotification()"
                        >
                            <span
                                class="bg-gray-600 border-r-0 px-1 rounded text-white"
                                >Read</span
                            >
                        </li>
                        <li
                            class="cursor-pointer text-xs"
                            @click="getUnreadNotification()"
                        >
                            <span
                                class="bg-gray-600 border-r-0 px-1 rounded text-white"
                                >Unread</span
                            >
                        </li>
                        <li
                            class="cursor-pointer text-xs"
                            @click="markAsReadNotification()"
                        >
                            <span
                                class="bg-gray-600 border-r-0 px-1 rounded text-white"
                                >Mark As Read</span
                            >
                        </li>
                        <li
                            class="cursor-pointer text-xs"
                            @click="deleteNotification()"
                        >
                            <span
                                class="bg-gray-600 border-r-0 px-1 rounded text-white"
                                >Clear All</span
                            >
                        </li>
                    </ul>
                </div>
                <div class="body dark:bg-gray-100">
                    <ul class="flex flex-col">
                        <li
                            :class="{ 'bg-slate-200': !notification.read_at }"
                            class="text-xs p-2 border-b-2 border-slate-300"
                            v-for="notification in props.notifications"
                        >
                            New User <b>{{ notification.data.name }}</b> ({{
                                notification.data.email
                            }}) registered at
                            {{ getFormattedDate(notification.data.created_at) }}
                            <p class="text-right">
                                <span
                                    @click="
                                        markAsReadNotification(notification.id)
                                    "
                                    class="bg-gray-600 border-r-0 px-1 cursor-pointer rounded text-white"
                                    >Read</span
                                >
                                <span
                                    @click="deleteNotification(notification.id)"
                                    class="bg-gray-600 border-r-0 px-1 ml-1 cursor-pointer rounded text-white"
                                    >Delete</span
                                >
                            </p>
                        </li>
                    </ul>
                </div>
            </div>
        </template>
    </BreezeDropdown>
</template>
<style scoped>
#notification_container .header {
    border-bottom: 1px solid #ddd;
}
#notification_container .body {
    min-height: 250px;
    max-height: 250px;
    overflow-y: auto;
}
</style>
