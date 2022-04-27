<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head } from "@inertiajs/inertia-vue3";

defineProps({
    products: Object,
})
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
            <table class="border-collapse table-auto w-full border border-slate-400">
              <thead>
                <tr>
                  <th class="border border-slate-300 text-left">Id</th>
                  <th class="border border-slate-300 text-left">Name</th>
                  <th class="border border-slate-300 text-left">Description</th>
                  <th class="border border-slate-300 text-left">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="product in products.data" v-bind:key="product.id">
                  <td class="border border-slate-300">{{ product.id}}</td>
                  <td class="border border-slate-300">{{ product.name}}</td>
                  <td class="border border-slate-300">{{ product.description}}</td>
                  <td class="border border-slate-300"></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>
