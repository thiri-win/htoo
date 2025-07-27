<script setup>

import AppLayout from '@/layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import { onMounted } from 'vue';

defineProps({
    records: Array,
    vouchers: Array,
})

onMounted(()=> {
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
                    <th>Title</th>
                    <th>Amount</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="record in records" v-bind:key="record.id">
                    <td v-text="record.id"></td>
                    <td v-text="record.date"></td>
                    <td v-text="record.title"></td>
                    <td v-text="record.amount"></td>
                    <td>
                        <Link :href="route('records.edit', record)" class="edit-btn text-sm">Edit</Link>
                    </td>
                </tr>
                <tr v-for="voucher in vouchers" v-bind:key="voucher.id">
                    <td v-text="voucher.id"></td>
                    <td v-text="voucher.date"></td>
                    <td v-text="voucher.car_number"></td>
                    <td v-text="voucher.total"></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </AppLayout>
</template>