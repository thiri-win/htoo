<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import { computed } from 'vue';
import { DownloadCloud, PlusIcon } from 'lucide-vue-next';
import PieChart from '@/components/PieChart.vue';
import BarChart from '@/components/BarChart.vue';
import BalanceSummaryTable from '@/components/BalanceSummaryTable.vue';
import {
    CHART_COLORS,
    categoryStackChartData,
    emptyChartData,
    stackedBarChartOptions,
} from '@/lib/dashboardCharts';

type CategorySum = {
    title: string;
    records_sum_grand_total?: number;
};

type BalanceSummary = Record<string, {
    sum_total: number;
    sub_total: number;
    diff: number;
}>;

const props = defineProps<{
    categorySums: CategorySum[];
    monthlyProfitThisYear: Record<string, number>;
    categorySumByMonth: Record<string, Record<string, number>>;
    categorySumByDay: Record<string, Record<string, number>>;
    monthlyBalance: BalanceSummary;
    yearlySummary: BalanceSummary;
}>();

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: '/dashboard' },
];

const now = new Date();
const year = now.getFullYear();
const month = now.toLocaleString('default', { month: 'short' });
const currentMonth = `${year}-${month}`;

const chartData = computed(() => {
    if (!props.categorySums?.length) {
        return emptyChartData();
    }

    return {
        labels: props.categorySums.map(c => c.title),
        datasets: [{
            label: 'Category Amount',
            data: props.categorySums.map(c => c.records_sum_grand_total || 0),
            backgroundColor: CHART_COLORS,
        }],
    };
});

const barChartData = computed(() => {
    if (!props.monthlyProfitThisYear || Object.keys(props.monthlyProfitThisYear).length === 0) {
        return emptyChartData();
    }

    return {
        labels: Object.keys(props.monthlyProfitThisYear),
        datasets: [{
            label: 'Monthly Profit',
            data: Object.values(props.monthlyProfitThisYear),
            backgroundColor: CHART_COLORS,
        }],
    };
});

const dailyStackChartData = computed(() => categoryStackChartData(props.categorySumByDay));
const dailyStackChartOptions = stackedBarChartOptions(`Daily Category Summary (${month} ${year})`);

const categoryTitles = computed(() => Object.keys(props.categorySumByMonth?.['1'] || {}));
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <Link :href="route('records.create')" class="btn new-btn mr-2">
            <PlusIcon class="inline-block"></PlusIcon>စာရင်းအသစ်ထည့်ရန်
        </Link>
        <Link :href="route('vouchers.create')" class="btn new-btn mr-2">
            <PlusIcon class="inline-block"></PlusIcon>
            <span>ဘောက်ချာအသစ်ဖွင့်ရန်</span>
        </Link>
        <a href="/backup-database" class="btn new-btn">
            <DownloadCloud class="inline-block"></DownloadCloud>
            Download DB
        </a>

        <div class="grid grid-cols-1 xl:grid-cols-2 gap-4 mb-5">
            <div class="border p-5">
                <PieChart :chartData="chartData" class="w-full"></PieChart>
            </div>

            <div class="border p-5 overflow-x-auto">
                <BalanceSummaryTable :rows="monthlyBalance" :highlight-key="currentMonth" />
            </div>

            <div class="border p-5 col-span-2">
                <BarChart :chartData="dailyStackChartData" :chartOptions="dailyStackChartOptions" class="w-full"></BarChart>
            </div>

            <div class="border p-5">
                <BarChart :chartData="barChartData" class="w-full"></BarChart>
            </div>

            <div class="border p-5 overflow-x-auto">
                <BalanceSummaryTable
                    :rows="yearlySummary"
                    :highlight-key="year"
                    show-header
                    first-column-label="Year"
                />
            </div>

            <div class="border p-5 col-span-2 overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 border">Month</th>
                            <th
                                v-for="categoryTitle in categoryTitles"
                                :key="categoryTitle"
                                class="px-6 py-3 text-right border"
                            >
                                {{ categoryTitle }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(sums, monthKey) in categorySumByMonth" :key="monthKey">
                            <th class="px-6 py-4 font-medium whitespace-nowrap border">{{ parseInt(monthKey, 10) }}</th>
                            <td
                                v-for="(total, category) in sums"
                                :key="category"
                                class="px-6 py-4 text-right border"
                            >
                                {{ total.toLocaleString() }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AppLayout>
</template>
