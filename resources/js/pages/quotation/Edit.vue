<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import { computed, ref, watch } from 'vue';
import 'vue-select/dist/vue-select.css';

const props = defineProps({
    quotation: Object
})

const form = useForm({
    'date': new Date(props.quotation.date).toISOString().split('T')[0],
    'subject': props.quotation.subject,
    'to': props.quotation.to,
    'items': props.quotation.items,
    'discount': props.quotation.discount,
    'sub_total': props.quotation.sub_total,
    'advance': props.quotation.advance,
    'grand_total': props.quotation.grand_total,
    'remark': props.quotation.remark,
})

const addQuotationItem = () => {
    form.items.push({
        // id: Math.random().toString(36).substring(2),
        description: '',
        quantity: 1,
        unit_price: 0,
        total: 0
    });
};

const removeQuotationItem = (item) => {
    form.items = form.items.filter(i => i.id != item.id)
}

const total = () => {
    form.items.forEach((item) => {
        return item.total = (item.quantity || 1) * (item.unit_price || 0)
    })
}

watch(() => [form.items, form.discount], total, { deep: true, immediate: true });

form.sub_total = computed(() => {
    return form.items.reduce((sum, item) => {
        return sum + (item.quantity * item.unit_price)
    }, 0)
})

form.grand_total = computed(() => {
    return form.items.reduce((sum, item) => {
        return sum + (item.quantity * item.unit_price)
    }, 0) - form.discount - form.advance
})

const submit = () => {
    form.put(route('quotations.update', props.quotation.id))
}

</script>
<template>
    <AppLayout>
        <form @submit.prevent="submit">

            <div
                class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-2 gap-y-5 bg-neutral-100 dark:bg-(--sidebar-background) p-5 rounded-lg">

                <div>
                    <input type="date" name="date" id="date" v-model="form.date"
                        :class="form.errors.date ? 'border-red-300' : ''">
                </div>
                <div>
                    <input type="text" name="subject" id="subject" placeholder="Subject" v-model="form.subject"
                        :class="form.errors.subject ? 'border-red-300' : ''">
                </div>
                <div>
                    <input type="text" name="to" id="to" placeholder="To" v-model="form.to"
                        :class="form.errors.to ? 'border-red-300' : ''">
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
                                <input type="text" v-model="item.description" :name="`items[${index}][description]`"
                                    placeholder="Description" class="border-white"
                                    :class="form.errors[`items.${index}.description`] ? '!border-b !border-red-300' : ''">
                            </td>
                            <td>
                                <input type="number" v-model="item.quantity" :name="`items[${index}][quantity]`"
                                    placeholder="Qty" class="border-white"
                                    :class="form.errors[`items.${index}.quantity`] ? '!border-b !border-red-300' : ''">
                            </td>
                            <td>
                                <input type="number" v-model="item.unit_price" :name="`items[${index}][unit_price]`"
                                    placeholder="Amount" class="border-white"
                                    :class="form.errors[`items.${index}.unit_price`] ? '!border-b !border-red-300' : ''">
                            </td>
                            <td>
                                <input type="number" v-model="item.total" :name="`items[${index}][total]`"
                                    placeholder="Total" class="border-white" tabindex="-1"
                                    :class="form.errors[`items.${index}.total`] ? '!border-b !border-red-300' : ''"
                                    readonly>
                            </td>
                            <td>
                                <a href="#" @click.prevent="removeQuotationItem(item)" class="text-nowrap"> - Remove</a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5" class="text-nowrap">
                                <a href="#" @click.prevent="addQuotationItem">+ Add</a>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4">
                                <label for="sub_total">Sub Total</label>
                            </td>
                            <td>
                                <input type="number" name="sub_total" id="sub_total" v-model="form.sub_total"
                                    tabindex="-1" readonly>
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
                                <label for="advance">Advance</label>
                            </td>
                            <td>
                                <input type="number" name="advance" id="advance" v-model="form.advance">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <label for="total">Grand Total</label>
                            </td>
                            <td>
                                <input type="number" name="grand_total" id="grand_total" v-model="form.grand_total"
                                    readonly>
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
                <button type="submit" class='btn edit-btn'>
                    Update
                </button>
            </div>
        </form>
    </AppLayout>
</template>