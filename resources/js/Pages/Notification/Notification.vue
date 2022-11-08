<script setup>
import { Inertia } from "@inertiajs/inertia";
import { useToast } from "vue-toastification";
import BreezeDropdown from "../../Components/Dropdown.vue";
// import AcademicCapIcon from '@heroicons/vue/outline/BellIcon';

const props = defineProps({
    notifications: Array,
    badge: Number,
    notificationType: String,
});
const toast = useToast();

function getNotifications(preserveState = true) {
    axios.get(route("notification"))
        .then(function (response) {
            // handle success
            console.log(response);
        })
        .catch(function (error) {
            // handle error
            console.log(error);
        })
        .then(function () {
            // always executed
        });
    return false;
}
getNotifications();
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
                        20
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
                <div class="header p-2">
                    <ul class="flex flex-row space-x-4">
                        <li class="basis-1/4">Notification</li>
                        <li class="basis-4/12"></li>
                        <li class="basis-1/12">All</li>
                        <li class="basis-2/12">Read</li>
                        <li class="basis-2/12">Unread</li>
                    </ul>
                </div>
                <div class="body p-2">
                    <ul class="flex flex-col">
                        <li v-for="notification in notifications">
                            {{ notification.name }}
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
