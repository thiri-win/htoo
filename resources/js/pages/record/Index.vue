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
                        <a :href="route('records.show', record)" class="show-btn my-5 inline-block mr-1 text-xs">View</a>
                        <div v-if="record.category.id == 1" class="inline-block">
                            <a :href="route('vouchers.edit', record)" class="edit-btn my-5 inline-block mr-1 text-xs">Edit</a>
                        </div>
                        <div v-else-if="record.category.id == 2" class="inline-block">
                            <a :href="route('expenses.edit', record)" class="edit-btn my-5 inline-block mr-1 text-xs">Edit</a>
                        </div>
                        <div v-else class="inline-block">
                            <a :href="route('records.edit', record)" class="edit-btn my-5 inline-block mr-1 text-xs">Edit</a>
                        </div>
                        <a :href="route('vouchers.print', record)" class="print-btn my-5 inline-block mr-1 text-xs">Print</a>
                        <a :href="route('records.destroy', record)" class="edit-btn my-5 inline-block mr-1 text-xs">Delete</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </AppLayout>
</template>