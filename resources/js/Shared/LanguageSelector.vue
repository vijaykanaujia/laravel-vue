<template>
<Link :class="{'selected': locale.selected}" class="ml-4" v-for="locale in selectable_locale" :key="locale.name" :href="route('language', locale.name)">
    <Icon class="w-5 h-5" :name="locale.name" />
</Link>
</template>

<script setup>
import Icon from '@/Shared/Icon';
import { computed, usePage, Link } from '@/Utils/vuex-helpers';

const selectable_locale = computed(() => {
    return [
        {name : 'en', selected : usePage().props.value.locale == 'en'},
        {name : 'de', selected : usePage().props.value.locale == 'de'},
    ]
});
</script>

<style scoped>
    .selected{
        border: 1px solid #818cf8;
    }
</style>
