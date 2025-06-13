<script setup lang="ts">
import Notification from '@/components/Notification.vue';
import AppLayout from '@/layouts/app/AppSidebarLayout.vue';
import type { BreadcrumbItemType } from '@/types';

interface Props {
    breadcrumbs?: BreadcrumbItemType[];
}

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <Notification></Notification>
        <div class="p-5 box">
            <slot />
        </div>
    </AppLayout>
</template>
