<script setup>
import { defineProps, ref } from 'vue';

const toggler = ref(props.isOpen ? true: false);
const props = defineProps({
    'accordionName' : String,
    'accordionTitle' : String,
    'isOpen' : Boolean,
    'accordionPosition' : String
});

const accordion = () => {
    toggler.value = !toggler.value;
}

const positionClass = ref({
    'rounded-t-xl' : props.accordionPosition == 'first',
    'border-b-0' : props.accordionPosition == 'middle',
    'bg-gray-100 text-gray-800' : toggler,
});
</script>

<template>
<h2>
    <button @click="accordion" type="button" :class="positionClass" class="flex justify-between items-center p-5 w-full font-medium text-left text-gray-500 border border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800" aria-expanded="true" :aria-controls="accordionName">
        <span class="flex items-center">
            <svg class="mr-2 w-5 h-5 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path></svg>
            <slot name="title">{{accordionTitle}}</slot>
        </span>
        <svg data-accordion-icon :class="{'rotate-180': toggler}" class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
        </svg>
    </button>
</h2>
<div :id="accordionName" :class="{'hidden': !toggler}" :aria-labelledby="accordionName">
<div :class="[accordionPosition == 'last' ? '': 'border-b-0']" class="p-5 border border-gray-200 dark:border-gray-700 dark:bg-gray-900">
    <slot name="body"></slot>
</div>
</div>
</template>
