<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import { computed, onMounted } from 'vue';
import { DownloadCloud, PlusIcon } from 'lucide-vue-next';
import PieChart from '@/components/PieChart.vue';
import BarChart from '@/components/BarChart.vue';

const props = defineProps({
    records: Array,
    vouchers: Array,
    categorySums: Array,
    categorySumsThisYear: Object,
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

const barChartData = computed(() => {
    if (!props.categorySumsThisYear || Object.keys(props.categorySumsThisYear).length === 0) {
        return { labels: [], datasets: [] };
    }

    const year = Object.keys(props.categorySumsThisYear)[0];
    const monthlyData = props.categorySumsThisYear[year];
    const months = Object.keys(monthlyData);

    if (months.length === 0 || !monthlyData[months[0]]) {
        return { labels: [], datasets: [] };
    }

    const categoryTitles = monthlyData[months[0]].map(cat => cat.title);

    const datasets = categoryTitles.map(title => {
        const data = months.map(month => {
            const categoryDataForMonth = monthlyData[month].find(cat => cat.title === title);
            return categoryDataForMonth ? categoryDataForMonth.sum : 0;
        });

        const r = Math.floor(Math.random() * 255);
        const g = Math.floor(Math.random() * 255);
        const b = Math.floor(Math.random() * 255);
        const color = `rgb(${r}, ${g}, ${b})`;

        return {
            label: title,
            data: data,
            borderColor: color,
            backgroundColor: color,
            fill: false,
        };
    });

    return {
        labels: months,
        datasets: datasets
    };
});

</script>

<template>

    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">

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

        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-4 mb-5">
            <div class="border p-5">
                <PieChart :chartData="chartData"></PieChart>
            </div>

            <div class="border p-5 col-span-3">
                <BarChart :chartData="barChartData" class="w-full"></BarChart>
            </div>
        </div>
    </AppLayout>
</template>
