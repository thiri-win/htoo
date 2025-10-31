<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import { computed, watch } from 'vue';

const props = defineProps({
    voucher: Object
})

const form = useForm({
    'date': props.voucher.date ? new Date(props.voucher.date).toISOString().split('T')[0] : new Date().toISOString().split('T')[0],
    'customer_name': props.voucher.car?.customer_name || '',
    'customer_phone': props.voucher.car?.customer_phone || '',
    'car_brand': props.voucher.car?.car_brand || '',
    'car_model': props.voucher.car?.car_model || '',
    'car_number': props.voucher.car?.car_number || '',
    'sales': props.voucher.sales || [
        {
            'id': 1,
            'description': '',
            'quantity': 1,
            'unit_price': 0,
            'total': 0,
        }
    ],
    'discount': props.voucher.discount || 0,
    'sub_total': props.voucher.sub_total || 0,
    'grand_total': props.voucher.grand_total || 0,
    'remark': props.voucher.remark || null
})

const addSale = () => {
    form.sales.push({
        description: form.sales.description,
        quantity: form.sales.quantity || 1,
        unit_price: form.sales.unit_price || 0,
        total: form.sales.total
    });
};

const removeSale = (sale) => {
    form.sales = form.sales.filter(s => s.id != sale.id)
}

const total = () => {
    form.sales.forEach((sale) => {
        return sale.total = (sale.quantity || 1) * (sale.unit_price || 0)
    })
}

watch(() => [form.sales, form.discount], total, { deep: true, immediate: true });

form.sub_total = computed(() => {
    return form.sales.reduce((sum, item) => {
        return sum + (item.quantity * item.unit_price)
    }, 0)
})

form.grand_total = computed(() => {
    return form.sales.reduce((sum, item) => {
        return sum + (item.quantity * item.unit_price)
    }, 0) - form.discount
})

const submit = () => {
    if(props.voucher.id) {
        form.put(route('vouchers.update', props.voucher.id))
    } else {
        form.post(route('vouchers.store'));
    }
}

</script>
<template>
    <!-- <AppLayout :breadcrumbs="breadcrumbs"> -->
    <AppLayout>
        <form action="" method="" @submit.prevent="submit">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-2 gap-y-5 bg-neutral-100 dark:bg-(--sidebar-background) p-5 rounded-lg">
                <div>
                    <input type="date" name="date" id="date" v-model="form.date" :class="form.errors.date ? 'border-red-300' : ''">
                </div>
                <div>
                    <input type="text" name="customer_name" id="customer_name" placeholder="Customer Name" v-model="form.customer_name" :class="form.errors.customer_name ? 'border-red-300' : ''">
                </div>
                <div>
                    <input type="tel" name="customer_phone" id="customer_phone" placeholder="Phone" v-model="form.customer_phone" :class="form.errors.customer_phone ? 'border-red-300' : ''">
                </div>
                <div>
                    <input type="text" name="car_brand" id="car_brand" placeholder="Car Brand" v-model="form.car_brand" :class="form.errors.car_brand ? 'border-red-300' : ''">
                </div>
                <div>
                    <input type="text" name="car_model" id="car_model" placeholder="Car Model" v-model="form.car_model" :class="form.errors.car_model ? 'border-red-300' : ''">
                </div>
                <div>
                    <input type="text" name="car_number" id="car_number" placeholder="Car Number" v-model="form.car_number" :class="form.errors.car_number ? 'border-red-300' : ''">
                </div>
            </div>
            <div class="bg-neutral-100 dark:bg-(--sidebar-background) my-5 p-5 rounded-lg">
                <table class="w-full">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Description</th>
                            <th>Quantity</th>
                            <th>unit_price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(sale, index) in form.sales" :key="sale.id">
                            <td>
                                {{ index + 1 }}
                            </td>
                            <td>
                                <input type="text" v-model="sale.description" placeholder="Description" class="border-white" :class="form.errors[`sales.${index}.description`] ? '!border-b !border-red-300' : ''">
                            </td>
                            <td>
                                <input type="number" v-model="sale.quantity" placeholder="Qty" class="border-white" :class="form.errors[`sales.${index}.quantity`] ? '!border-b !border-red-300' : ''">
                            </td>
                            <td>
                                <input type="number" v-model="sale.unit_price" placeholder="Amount" class="border-white" :class="form.errors[`sales.${index}.unit_price`] ? '!border-b !border-red-300' : ''">
                            </td>
                            <td>
                                {{ sale.quantity * sale.unit_price }}
                            </td>
                            <td>
                                <a href="#" @click.prevent="removeSale(sale)" class="text-nowrap"> - Remove</a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5" class="text-nowrap">
                                <a href="#" @click.prevent="addSale">+ Add</a>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4">
                                <label for="sub_total">Sub Total</label>
                            </td>
                            <td>
                                {{ form.sub_total }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <label for="discount">Discount</label>
                            </td>
                            <td>
                                <input type="number" name="discount" id="discount" v-model="form.discount">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <label for="total">Grand Total</label>
                            </td>
                            <td>
                                {{ form.grand_total }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="bg-neutral-100 dark:bg-stone-900 my-5 p-5 rounded-lg">
                <label for="remark">Note:</label>
                <textarea name="remark" id="remark" v-model="form.remark"></textarea>
            </div>

            <div class="text-right">
                <button type="submit" :class="props.voucher.id ? 'edit-btn' : 'submit-btn'">
                    {{ props.voucher.id ? 'Update' : 'Submit' }}
                </button>
            </div>
        </form>
    </AppLayout>
</template>