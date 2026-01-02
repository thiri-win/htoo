<script setup>

import AppLayout from '@/layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import { computed, watch } from 'vue';

const form = useForm({
    'date': new Date().toISOString().split('T')[0],
    'subject': '',
    'to': '',
    'items': [
        {
            'id': 1,
            'description': '',
            'quantity': 1,
            'unit_price': 0,
            'total': 0,
        }
    ],
    'discount': 0,
    'sub_total': 0,
    'grand_total': 0,
    'remark': null,
})

const addItem = () => {
    const newId = form.items.length > 0 ? Math.max(...form.items.map(item => item.id)) + 1 : 1;

    form.items.push({
        id: newId,
        description: '',
        quantity: 1,
        unit_price: 0,
        total: 0
    });
};

const removeItem = (item) => {
    form.items = form.items.filter(s => s.id != item.id)
}

const total = () => {
    form.items.forEach((item) => {
        return item.total = (item.quantity || 1) * (item.unit_price || 0)
    })
}

const sub_total = computed(() => {
    return form.items.reduce((sum, item) => {
        return sum + (item.quantity * item.unit_price)
    }, 0)
})

const grand_total = computed(() => {
    return form.items.reduce((sum, item) => {
        return sum + (item.quantity * item.unit_price)
    }, 0) - form.discount
})

watch(() => [form.items, form.discount], total, { deep: true, immediate: true });

</script>
<template>
    <AppLayout>
        <form :action="route('pdf-quotation')" method="get">

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-2 gap-y-5 bg-neutral-100 dark:bg-(--sidebar-background) p-5 rounded-lg">

                <div>
                    <input type="date" name="date" id="date" v-model="form.date" :class="form.errors.date ? 'border-red-300' : ''">
                </div>
                <div>
                    <input type="text" name="subject" id="subject" placeholder="Subject" v-model="form.subject" :class="form.errors.subject ? 'border-red-300' : ''">
                </div>
                <div>
                    <input type="text" name="to" id="to" placeholder="To" v-model="form.to" :class="form.errors.to ? 'border-red-300' : ''">
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
                        <tr v-for="(item, index) in form.items" :key="item.id">
                            <td>
                                {{ index + 1 }}
                            </td>
                            <td>
                                <input type="text" v-model="item.description" :name="`items[${index}][description]`" placeholder="Description" class="border-white" :class="form.errors[`items.${index}.description`] ? '!border-b !border-red-300' : ''">
                            </td>
                            <td>
                                <input type="number" v-model="item.quantity" :name="`items[${index}][quantity]`" placeholder="Qty" class="border-white" :class="form.errors[`items.${index}.quantity`] ? '!border-b !border-red-300' : ''">
                            </td>
                            <td>
                                <input type="number" v-model="item.unit_price" :name="`items[${index}][unit_price]`" placeholder="Amount" class="border-white" :class="form.errors[`items.${index}.unit_price`] ? '!border-b !border-red-300' : ''">
                            </td>
                            <td>
                                <input type="number" v-model="item.total" :name="`items[${index}][total]`" placeholder="Total" class="border-white" :class="form.errors[`items.${index}.total`] ? '!border-b !border-red-300' : ''" readonly>
                            </td>
                            <td>
                                <a href="#" @click.prevent="removeItem(item)" class="text-nowrap"> - Remove</a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5" class="text-nowrap">
                                <a href="#" @click.prevent="addItem">+ Add</a>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4">
                                <label for="sub_total">Sub Total</label>
                            </td>
                            <td>
                                <input type="number" name="sub_total" id="sub_total" :value="sub_total" readonly>
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
                                <input type="number" name="grand_total" id="grand_total" :value="grand_total" readonly>
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
                <button type="submit" class='btn submit-btn'>
                    Submit
                </button>
            </div>
        </form>
    </AppLayout>
</template>