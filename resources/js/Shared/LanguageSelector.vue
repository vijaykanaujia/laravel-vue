<template>
<div class="ml-4">
    <Link :href="route('language', [selectable_locale])">
        <Icon class="w-5 h-5" :name="selectable_locale" />
    </Link>
</div>
</template>

<script setup>
import Icon from '@/Shared/Icon';
import { computed, usePage, Link } from '@/Utils/vuex-helpers';

const selectable_locale = computed(() => {
    if (usePage().props.value.locale == 'en') {
        return 'en';
    }
    return 'de'
});
</script>
