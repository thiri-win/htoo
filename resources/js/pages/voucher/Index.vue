<script setup lang="js">
import AppLayout from '@/layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import dayjs from 'dayjs';

const props = defineProps({
    vouchers: Array
})
onMounted(() => {
    $('table').DataTable({
        order: [[1, 'desc']],
        autoWidth: false,
        scrollX: true,
    });
})

</script>
<template>
    <AppLayout>
        <h1>All Voucher</h1>
        <Link :href="route('vouchers.create')" class="new-btn">+New</Link>
        <table class="!w-full">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Customer Name</th>
                    <th>Brand</th>
                    <th>Model</th>
                    <th>Car Number</th>
                    <th>Total</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="voucher in vouchers" :key="voucher.id">
                    <td>{{ voucher.id }}</td>
                    <td>{{ dayjs(voucher.date).format('D-M-YYYY') }}</td>
                    <td>{{ voucher.customer_name }}</td>
                    <td>{{ voucher.car_brand }}</td>
                    <td>{{ voucher.car_model }}</td>
                    <td>{{ voucher.car_number }}</td>
                    <td>{{ voucher.total }}</td>
                    <td>
                        <Link :href="route('vouchers.show', voucher)" class="show-btn text-sm me-2">Show</Link>
                        <Link :href="route('vouchers.edit', voucher)" class="edit-btn text-sm me-2">Edit</Link>
                        <a :href="route('vouchers.print', voucher)" target="_blank" class="print-btn text-sm">Print</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </AppLayout>
</template>