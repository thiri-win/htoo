<script setup>

import AppLayout from '@/layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import dayjs from 'dayjs';

defineProps({
    records: Array,
    vouchers: Array,
})

onMounted(() => {
    $('table').DataTable({
        order: [[0, 'desc']],
        autoWidth: false,
        // scrollX: true,
    });
})


</script>

<template>
    <AppLayout>
        <Link :href="route('records.create')" class="new-btn">+ စာရင်းအသစ်ထည့်ရန်</Link>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Amount</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="record in records" v-bind:key="record.id">
                    <td>{{ record.id }}</td>
                    <td>{{ dayjs(record.date).format('DD-MM-YYYY') }}</td>
                    <td>{{ record.description }}</td>
                    <td>{{ record.category.title }}</td>
                    <td>{{ record.grand_total }}</td>
                    <td>
                        <Link :href="route('records.show', record)" class="show-btn text-sm">View</Link>
                    </td>
                </tr>
            </tbody>
        </table>
    </AppLayout>
</template>