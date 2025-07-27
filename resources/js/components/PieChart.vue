<script setup lang="ts">
import { Pie } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, ArcElement } from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, ArcElement)

defineProps({
    chartData: String,
    chartOptions: String,
})
</script>

<template>
    <Pie :data="chartData" :options="chartOptions" />
</template>