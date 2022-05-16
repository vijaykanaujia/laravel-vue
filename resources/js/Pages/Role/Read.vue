<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import BreezeButton from "@/Components/Button.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";

defineProps({
  roles: Object,
  title: String,
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
                                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
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
              <table
                class="
                  w-full
                  text-sm text-left text-gray-500
                  dark:text-gray-400
                "
              >
                <thead
                  class="
                    text-xs text-gray-700
                    uppercase
                    bg-gray-50
                    dark:bg-gray-700 dark:text-gray-400
                  "
                >
                  <tr>
                    <td scope="col" class="px-6 py-3">ID</td>
                    <th scope="col" class="px-6 py-3">Title</th>
                    <th scope="col" class="px-6 py-3">Guard</th>
                    <th scope="col" class="px-6 py-3">
                      <span class="sr-only">Edit</span>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    class="
                      bg-white
                      border-b
                      dark:bg-gray-800 dark:border-gray-700
                      hover:bg-gray-50
                      dark:hover:bg-gray-600
                    "
                    v-for="role in roles.data"
                    v-bind:key="role.id"
                  >
                    <td class="px-6 py-4">{{ role.id }}</td>
                    <th
                      scope="row"
                      class="
                        px-6
                        py-4
                        font-medium
                        text-gray-900
                        dark:text-white
                        whitespace-nowrap
                      "
                    >
                      {{ role.name }}
                    </th>
                    <td class="px-6 py-4">{{ role.guard_name }}</td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex space-x-4">
                            <Link>
                                <svg class="w-6 h-6 stroke-black hover:stroke-cyan-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                </svg>
                            </Link>
                            <Link>
                                <svg class="w-6 h-6 stroke-black hover:stroke-cyan-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" />
                                </svg>
                            </Link>
                        </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>
        