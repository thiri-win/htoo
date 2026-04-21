<script setup>

import AppLayout from '@/layouts/AppLayout.vue';
import dayjs from 'dayjs';

defineProps({
    'car': Object
})

</script>
<template>
    <AppLayout>
        <h1>စာရင်းအသေးစိတ် - {{ car.car_number }}</h1>
        <div class="grid grid-cols-2 gap-2">
            <div>
                <div>
                    <label class="w-42">Car Number: </label>
                    <span class="px-3 py-2">{{ car.car_number }}</span>
                </div>
                <div>
                    <label class="w-42">Car Brand: </label>
                    <span class="px-3 py-2">{{ car.car_brand }}</span>
                </div>
                <div>
                    <label class="w-42">Car Model: </label>
                    <span class="px-3 py-2">{{ car.car_model }}</span>
                </div>
            </div>
            <div>
                <div>
                    <label class="w-42">Customer Name: </label>
                    <span class="px-3 py-2">{{ car.customer_name }}</span>
                </div>
                <div>
                    <label class="w-42">Customer Phone: </label>
                    <span class="px-3 py-2">{{ car.customer_phone }}</span>
                </div>
            </div>
        </div>
        <div v-for="record in car.records" :key="record.id" class="bg-neutral-100 dark:bg-(--sidebar-background) my-3 p-5 rounded-lg">
            <div class="flex justify-between">
                <h4>{{ record.category.title }} - {{ dayjs(record.date).format('DD-MM-YYYY') }}</h4>
                <a :href="route('records.show', record)" class="btn show-btn inline-block mr-1 text-xs">
                    <span>View</span>
                </a>
            </div>
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
                    <tr v-for="(item, index) in record.items" :key="item.id">
                        <td>{{ index + 1 }}</td>
                        <td>{{ item.description }}</td>
                        <td class="text-right">{{ item.quantity }}</td>
                        <td class="text-right">{{ item.unit_price }}</td>
                        <td class="text-right">{{ item.total.toLocaleString() }}</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="text-right">Sub Total</td>
                        <td class="text-right">{{ record.sub_total.toLocaleString() }}</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-right">Discount</td>
                        <td class="text-right">{{ record.discount.toLocaleString() }}</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-right">Grand Total</td>
                        <td class="text-right">{{ record.grand_total.toLocaleString() }}</td>
                    </tr>
                    <tr>
                        <td>မှတ်ချက် :</td>
                        <td colspan="4">{{ record.remark }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </AppLayout>
</template>