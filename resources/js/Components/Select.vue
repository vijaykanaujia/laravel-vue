<script setup>
import { onMounted, ref } from 'vue';

defineProps(['modelValue', 'options']);

defineEmits(['update:modelValue']);

const select = ref(null);
onMounted(() => {
    if (select.value.hasAttribute('autofocus')) {
        select.value.focus();
    }
});
</script>

<template>
    <select class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" :value="modelValue" @change="$emit('update:modelValue', $event.target.value)" ref="select">
        <template v-if="Object.keys(options).length">
            <option v-for="option in options" :key="option.id" :value="option.id" :selected="option.selected == 1">{{option.text}}</option>
        </template>
        <template v-else>
            <option value=""></option>
        </template>
    </select>
</template>
