<script setup>

import AppLayout from '@/layouts/AppLayout.vue';
import dayjs from 'dayjs';

defineProps({
    'record': Object
})

</script>
<template>
    <AppLayout>
        <h1>စာရင်းအသေးစိတ်</h1>
        <div class="mb-3">
            <label class="w-38">Date: </label>
            <span class="px-3 py-2">{{ dayjs(record.date).format('DD-MM-YYYY') }}</span>
        </div>
        <div class="mb-3" v-if="record.sales.length < 1">
            <div>
                <label class="w-38">အကြောင်းအရာ :</label>
                <span class="px-3 py-2">{{ record.description }}</span>
            </div>
            <div>
                <label class="w-38">အမျိုးအစား :</label>
                <span class="px-3 py-2">{{ record.category.title }}</span>
            </div>
            <div>
                <label class="w-38">ပမာဏ :</label>
                <span class="px-3 py-2">{{ record.grand_total }}</span>
            </div>
            <div>
                <label class="w-38">မှတ်ချက် :</label>
                <span class="px-3 py-2">{{ record.remark }}</span>
            </div>
        </div>
        <div v-else>
            <table v-if="record.car" class="w-full mb-5">
                <tr>
                    <td class="w-38 italic">Customer Name</td>
                    <td class="font-semibold">{{ record.car.customer_name }}</td>
                    <td class="w-38 italic">Customer Phone</td>
                    <td class="font-semibold">{{ record.car.customer_phone }}</td>
                    <td class="w-38 italic"></td>
                    <td class="font-semibold"></td>
                </tr>
                <tr>
                    <td class="w-38 italic">Car Number</td>
                    <td class="font-semibold">{{ record.car.car_number }}</td>
                    <td class="w-38 italic">Car Brand</td>
                    <td class="font-semibold">{{ record.car.car_brand }}</td>
                    <td class="w-38 italic font">Car Model</td>
                    <td class="font-semibold">{{ record.car.car_model }}</td>
                </tr>
            </table>
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="text-left">No</th>
                        <th class="text-left">description</th>
                        <th class="text-right">quantity</th>
                        <th class="text-right">unit price</th>
                        <th class="text-right">total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(sale, index) in record.sales" :key="sale.id">
                        <td>{{ index + 1 }}</td>
                        <td>{{ sale.description }}</td>
                        <td class="text-right">{{ sale.quantity }}</td>
                        <td class="text-right">{{ sale.unit_price }}</td>
                        <td class="text-right">{{ sale.total }}</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="text-right">Sub Total</td>
                        <td class="text-right">{{ record.sub_total }}</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-right">Discount</td>
                        <td class="text-right">{{ record.discount }}</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-right">Grand Total</td>
                        <td class="text-right">{{ record.grand_total }}</td>
                    </tr>
                    <tr>
                        <td>မှတ်ချက် :</td>
                        <td colspan="4">{{ record.remark }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div v-if="record.sales.length > 0" class="inline-block">
            <a :href="route('vouchers.edit', record)" class="edit-btn my-5 inline-block mr-2">Edit</a>
        </div>
        <div v-else class="inline-block">
            <a :href="route('records.edit', record)" class="edit-btn my-5 inline-block mr-2">Edit</a>
        </div>
        <a href="/dashboard" class="new-btn my-5 inline-block">Back to Dashboard</a>
    </AppLayout>
</template>