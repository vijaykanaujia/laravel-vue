<template>
<Link :class="{'selected': locale.selected}" class="ml-4" v-for="locale in selectable_locale" :key="locale.name" :href="route('language', locale.name)">
    <Icon class="w-5 h-5" :name="locale.name" />
</Link>
</template>

<script setup>
import Icon from '@/Shared/Icon.vue';
import { Link, usePage } from '@inertiajs/inertia-vue3';
import { computed } from 'vue';
const selectable_locale = computed(() => {
    return [
        {name : 'en', selected : usePage().props.value.locale == 'en'},
        {name : 'nl', selected : usePage().props.value.locale == 'nl'},
    ]
});
</script>

<style scoped>
    .selected{
        border: 1px solid #818cf8;
    }
</style>
