<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import { computed, onMounted } from 'vue';
import { DownloadCloud, PlusIcon } from 'lucide-vue-next';
import PieChart from '@/components/PieChart.vue';

const props = defineProps({
    records: Array,
    vouchers: Array,
    categorySums: Array,
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

const chartData = computed(() => {
    // if (!Array.isArray(categorySums) || categorySums.length === 0) {
    //     return {
    //         labels: [],
    //         datasets: []
    //     }
    // }
    return {
        labels: props.categorySums.map(c => c.title),
        datasets: [
            {
                label: 'Category Amount',
                data: props.categorySums.map(c => c.records_sum_amount || 0),
                backgroundColor: [
                    '#f87171', '#60a5fa', '#fbbf24', '#34d399', '#a78bfa', '#f472b6', '#facc15', '#38bdf8', '#fb7185', '#4ade80'
                ],
            }
        ]
    }
});

</script>

<template>

    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">

        <div class="w-full border">
            <div class="w-1/3 border p-5">
                <PieChart :chartData="chartData"></PieChart>
            </div>
        </div>

        <Link :href="route('records.create')" class="new-btn mr-2">
        <PlusIcon class="inline-block"></PlusIcon>စာရင်းအသစ်ထည့်ရန်</Link>
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
                    <th>Category</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="record in records" v-bind:key="record.id">
                    <td v-text="record.date"></td>
                    <td v-text="record.title"></td>
                    <td v-text="record.amount"></td>
                    <td v-text="record.category.title"></td>
                    <td>
                        <Link :href="route('records.show', record)" class="show-btn text-sm">View</Link>
                        <Link :href="route('records.edit', record)" class="edit-btn text-sm">Edit</Link>
                    </td>
                </tr>
                <tr v-for="voucher in vouchers" v-bind:key="voucher.id">
                    <td v-text="voucher.date"></td>
                    <td v-text="voucher.car_number"></td>
                    <td v-text="voucher.total"></td>
                    <td>Voucher</td>
                    <td>
                        <Link :href="route('vouchers.show', voucher)" class="show-btn text-sm">View</Link>
                        <Link :href="route('vouchers.edit', voucher)" class="edit-btn text-sm">Edit</Link>
                    </td>
                </tr>
            </tbody>
        </table>
    </AppLayout>
</template>
