<script setup lang="ts">
import TextLink from '@/components/TextLink.vue';
import AppLayout from '@/layouts/AppLayout.vue';
const props = defineProps({
    voucher: Object
})
</script>
<template>
    <AppLayout>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-2 gap-x-5">
            <div class="border-b-2 border-black">
                <label for="" class="italic font-light me-2">Date:</label>
                <p class="font-bold inline-block">{{ voucher.date }}</p>
            </div>
            <div></div>
            <div class="border-b-2 border-black">
                <label for="" class="italic font-light me-2">Customer Name:</label>
                <p class="font-bold inline-block">{{ voucher.customer_name }}</p>
            </div>
            <div class="border-b-2 border-black">
                <label for="" class="italic font-light me-2">Customer Phone:</label>
                <p class="font-bold inline-block">{{ voucher.customer_phone }}</p>
            </div>
            <div class="border-b-2 border-black">
                <label for="" class="italic font-light me-2">Car Model:</label>
                <p class="font-bold inline-block">{{ voucher.car_brand }} {{ voucher.car_model }}</p>
            </div>
            <div class="border-b-2 border-black">
                <label for="" class="italic font-light me-2">Car No:</label>
                <p class="font-bold inline-block">{{ voucher.car_number }}</p>
            </div>
            <div class="col-span-full my-5 bg-gray-100 dark:bg-stone-900 p-5 rounded">
                <table class="w-full">
                    <thead class="border-b-2 border-black">
                        <tr>
                            <th class="!text-left">description</th>
                            <th>quantity</th>
                            <th>unit_price</th>
                            <th>amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="sale in voucher.sales" :key="sale.id">
                            <td class="!text-left">{{ sale.description }}</td>
                            <td>{{ sale.quantity }}</td>
                            <td>{{ sale.unit_price }}</td>
                            <td>{{ sale.sub_total }}</td>
                        </tr>
                    </tbody>
                    <tfoot class="border-t-2 border-black">
                        <tr>
                            <td colspan="3" class="font-bold">Discount</td>
                            <td>{{ voucher.discount }}</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="font-bold">Total</td>
                            <td>{{ voucher.total }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="col-span-full text-right">
                <a :href="route('vouchers.print', voucher)" class="print-btn mr-3">Print</a>
                <TextLink :href="route('vouchers.edit', voucher)" class="edit-btn">Edit</TextLink>
            </div>
        </div>
    </AppLayout>
</template>