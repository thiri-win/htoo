<script setup>

import AppLayout from '@/layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import { onMounted } from 'vue';

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


</script>

<template>
    <AppLayout>
        <Link :href="route('records.create')" class="new-btn">+ New</Link>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Amount</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="record in records" v-bind:key="record.id">
                    <td v-text="record.id"></td>
                    <td v-text="record.date"></td>
                    <td v-text="record.description"></td>
                    <td v-text="record.grand_total"></td>
                    <td>
                        <Link :href="route('records.show', record)" class="show-btn text-sm">View</Link>
                    </td>
                </tr>
            </tbody>
        </table>
    </AppLayout>
</template>