<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import { DownloadCloud, PlusIcon } from 'lucide-vue-next';

defineProps({
    records: Array,
    vouchers: Array,
})

onMounted(() => {
    $('table').DataTable({
        order: [[1, 'desc']],
        autoWidth: false,
        // scrollX: true,
    });
})

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];
</script>

<template>

    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <Link :href="route('records.create')" class="new-btn mr-2">
            <PlusIcon class="inline-block"></PlusIcon>
            <span>စာရင်းအသစ်ထည့်ရန်</span>
        </Link>
        <Link :href="route('vouchers.create')" class="new-btn mr-2">
            <PlusIcon class="inline-block"></PlusIcon>
            <span>ဘောက်ချာအသစ်ဖွင့်ရန်</span>
        </Link>
        <a href="/backup-database" class="new-btn">
            <DownloadCloud class="inline-block"></DownloadCloud>
            Download DB
        </a>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Title</th>
                    <th>Amount</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="record in records" v-bind:key="record.id">
                    <td v-text="record.date"></td>
                    <td v-text="record.title"></td>
                    <td v-text="record.amount"></td>
                    <td>
                        <Link :href="route('records.show', record)" class="show-btn text-sm">View</Link>
                        <Link :href="route('records.edit', record)" class="edit-btn text-sm">Edit</Link>
                    </td>
                </tr>
                <tr v-for="voucher in vouchers" v-bind:key="voucher.id">
                    <td v-text="voucher.date"></td>
                    <td v-text="voucher.car_number"></td>
                    <td v-text="voucher.total"></td>
                    <td>
                        <Link :href="route('vouchers.show', voucher)" class="show-btn text-sm">View</Link>
                        <Link :href="route('vouchers.edit', voucher)" class="edit-btn text-sm">Edit</Link>
                    </td>
                </tr>
            </tbody>
        </table>
    </AppLayout>
</template>
