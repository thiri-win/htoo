<script setup lang="ts">
type BalanceRow = {
    sum_total: number;
    sub_total: number;
    diff: number;
};

defineProps<{
    rows: Record<string, BalanceRow>;
    highlightKey?: string | number;
    showHeader?: boolean;
    firstColumnLabel?: string;
}>();
</script>

<template>
    <table class="w-full">
        <thead v-if="showHeader">
            <tr>
                <th class="px-6 py-3 border text-left">{{ firstColumnLabel ?? 'Period' }}</th>
                <th class="px-6 py-3 border text-right">ဝင်ငွေ</th>
                <th class="px-6 py-3 border text-right">ထွက်ငွေ</th>
                <th class="px-6 py-3 border text-right">အမြတ်</th>
            </tr>
        </thead>
        <tbody>
            <tr
                v-for="(row, key) in rows"
                :key="key"
                class="bg-gray-100 border border-white dark:bg-transparent"
                :class="{ 'bg-gray-200 dark:!bg-accent font-bold': String(key) === String(highlightKey) }"
            >
                <td :class="showHeader ? 'px-6 py-4 border' : ''">{{ key }}</td>
                <td :class="['text-right', showHeader ? 'px-6 py-4 border' : '']">{{ row.sum_total.toLocaleString() }}</td>
                <td :class="['text-right', showHeader ? 'px-6 py-4 border' : '']">{{ row.sub_total.toLocaleString() }}</td>
                <td :class="['text-right', showHeader ? 'px-6 py-4 border' : '']">{{ row.diff.toLocaleString() }}</td>
            </tr>
        </tbody>
    </table>
</template>
