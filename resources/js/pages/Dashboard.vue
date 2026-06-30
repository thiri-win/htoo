<script setup lang="ts">
import { computed } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import DynamicTable from '@/components/DynamicTable.vue';
import { Bar, Pie } from 'vue-chartjs';
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale, ArcElement } from 'chart.js';
import { DownloadCloud, PlusIcon } from 'lucide-vue-next';
import { CHART_COLORS, categoryStackChartData, emptyChartData } from '@/lib/dashboardCharts';

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale, ArcElement);

// 🛠️ GLOBAL OPTIONS
ChartJS.defaults.responsive = true;
ChartJS.defaults.maintainAspectRatio = true;
ChartJS.defaults.plugins.title.display = true;
ChartJS.defaults.plugins.title.font = { size: 18 };

const props = defineProps<{
    categorySumByThisMonth: Array<{ title: string; records_sum_grand_total?: number }>;
    monthlyProfitThisYear: Record<string, number>;
    categorySumByMonth: Record<string, Record<string, number>>;
    categorySumByDay: Record<string, Record<string, number>>;
    monthlyBalance: Record<string, any>;
    yearlySummary: Record<string, any>;
    topFiveCarsByModel: Array<any>;
}>();

const year = new Date().getFullYear();
const currentMonth = `${year}-${new Date().toLocaleString('default', { month: 'short' })}`;

const categorySumByThisMonth = computed(() => !props.categorySumByThisMonth?.length ? emptyChartData() : {
    labels: props.categorySumByThisMonth.map(c => c.title),
    datasets: [{ label: 'Category Amount', data: props.categorySumByThisMonth.map(c => c.records_sum_grand_total || 0), backgroundColor: CHART_COLORS }]
});

const topFiveCarsByModel = computed(() => ({
    labels: props.topFiveCarsByModel.map(c => `${c.car_brand} ${c.car_model}`),
    datasets: [{ label: 'Count', data: props.topFiveCarsByModel.map(c => c.count || 0), backgroundColor: CHART_COLORS }]
}));

const monthlyProfitThisYear = computed(() => !props.monthlyProfitThisYear || !Object.keys(props.monthlyProfitThisYear).length ? emptyChartData() : {
    labels: Object.keys(props.monthlyProfitThisYear),
    datasets: [{ label: 'Monthly Profit', data: Object.values(props.monthlyProfitThisYear), backgroundColor: CHART_COLORS }]
});

const dailyStackChartData = computed(() => categoryStackChartData(props.categorySumByDay));
const categoryTitles = computed(() => Object.keys(props.categorySumByMonth?.['1'] || {}));
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="[{ title: 'Dashboard', href: '/dashboard' }]">
        <div class="mb-5 flex flex-wrap gap-2">
            <Link :href="route('records.create')" class="btn new-btn"><PlusIcon class="inline-block mr-1" />စာရင်းအသစ်ထည့်ရန်</Link>
            <Link :href="route('vouchers.create')" class="btn new-btn"><PlusIcon class="inline-block mr-1" />ဘောက်ချာအသစ်ဖွင့်ရန်</Link>
            <a href="/backup-database" class="btn new-btn"><DownloadCloud class="inline-block mr-1" />Download DB</a>
        </div>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3">
            <div class="overflow-x-auto border p-5">
                <Pie :data="categorySumByThisMonth as any" :options="{ plugins: { title: { text: 'ယခုလ အမျိုးအစားအလိုက်ဝင်ငွေ' } } }" />
            </div>

            <div class="overflow-x-auto border p-5 h-[350px]">
                <Bar :data="topFiveCarsByModel as any" :options="{ indexAxis: 'y', maintainAspectRatio: false, plugins: { title: { text: 'ဝပ်ရှော့သို့ အလာအများဆုံး ကားများ' } } }" />
            </div>

            <div class="overflow-x-auto border p-5">
                <DynamicTable
                    title="နှစ်အလိုက်အမြတ်ငွေ စာရင်းဇယား"
                    :headers="['လ', 'ဝင်ငွေ', 'ထွက်ငွေ', 'အမြတ်']"
                    firstKeyName="year"
                    :highlightKey="year"
                    :rows="yearlySummary"
                />
            </div>

            <div class="overflow-x-auto border p-5">
                <DynamicTable
                    title="ယခုနှစ်အမြတ်ငွေ စာရင်းဇယား"
                    :headers="['လ', 'ဝင်ငွေ', 'ထွက်ငွေ', 'အမြတ်']"
                    firstKeyName="month"
                    :highlightKey="currentMonth"
                    :rows="monthlyBalance"
                />
            </div>

            <div class="col-span-full overflow-x-auto border p-5 xl:col-span-2">
                <Bar :data="monthlyProfitThisYear as any" :options="{ scales: { x: { ticks: { maxRotation: 90, minRotation: 90 } } }, plugins: { title: { text: 'ယခုနှစ် လအလိုက်အမြတ်ငွေ' } } }" />
            </div>

            <div class="col-span-full overflow-x-auto border p-5">
                <Bar :data="dailyStackChartData as any" :options="{ scales: { x: { stacked: true }, y: { stacked: true } }, plugins: { title: { text: 'နေ့ရက်အလိုက်စာရင်းများ' } } }" />
            </div>

            <div class="col-span-full overflow-x-auto border p-5">
                <DynamicTable
                    title="ယခုနှစ် ငွေစာရင်းများ"
                    :headers="['Month', ...categoryTitles]"
                    firstKeyName="month"
                    :highlightKey="currentMonth"
                    :rows="categorySumByMonth as any"
                />
            </div>
        </div>
    </AppLayout>
</template>