<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head } from "@inertiajs/inertia-vue3";

defineProps({
  products: Object,
});
</script>

<template>
  <Head title="Product" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Product</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
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
                    <th scope="col" class="px-6 py-3">Product name</th>
                    <th scope="col" class="px-6 py-3">Description</th>
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
                      dark:hover:bg-gray-600" v-for="product in products.data" v-bind:key="product.id">
                  <td class="px-6 py-4">{{ product.id }}</td>
                    <th scope="row" class=" px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">{{ product.name }}</th>
                    <td class="px-6 py-4">{{ product.description }}</td>
                    <td class="px-6 py-4 text-right">
                      <a
                        href="#"
                        class="
                          font-medium
                          text-blue-600
                          dark:text-blue-500
                          hover:underline
                        "
                        >Edit</a
                      >
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
        