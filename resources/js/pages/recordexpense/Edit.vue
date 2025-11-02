<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import { computed, watch } from 'vue';

const props = defineProps({
    record: Object,
    categories: Array,
})

const form = useForm({
    'date': props.record.date ? new Date(props.record.date).toISOString().split('T')[0] : new Date().toISOString().split('T')[0],
    'description': props.record.description || '',
    'category_id': props.record.category_id || '',
    'items': props.record.items || [
        {
            'id': 1,
            'description': '',
            'quantity': 1,
            'unit_price': 0,
            'total': 0,
        }
    ],
    'discount': props.record.discount || 0,
    'sub_total': props.record.sub_total || 0,
    'grand_total': props.record.grand_total || 0,
    'remark': props.record.remark || null
})

const addItem = () => {
    form.items.push({
        description: form.items.description,
        quantity: form.items.quantity || 1,
        unit_price: form.items.unit_price || 0,
        total: form.items.total
    });
};

const removeItem = (item) => {
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

const submit = () => {
    form.put(route('records.update', props.record.id))
}

</script>
<template>
    <AppLayout>
        <h1>စာရင်းပြင်ဆင်ရန် - {{ record.category.title }}</h1>
        <form action="" method="" @submit.prevent="submit">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-2 gap-y-5 bg-neutral-100 dark:bg-(--sidebar-background) p-5 rounded-lg">
                <div>
                    <input type="date" name="date" id="date" v-model="form.date" :class="form.errors.date ? 'border-red-300' : ''">
                </div>
                <div>
                    <input type="text" name="description" id="description" placeholder="Car Number" v-model="form.description" :class="form.errors.description ? 'border-red-300' : ''">
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
                                <input type="text" v-model="item.description" placeholder="Description" class="border-white" :class="form.errors[`items.${index}.description`] ? '!border-b !border-red-300' : ''">
                            </td>
                            <td>
                                <input type="number" v-model="item.quantity" placeholder="Qty" class="border-white" :class="form.errors[`items.${index}.quantity`] ? '!border-b !border-red-300' : ''">
                            </td>
                            <td>
                                <input type="number" v-model="item.unit_price" placeholder="Amount" class="border-white" :class="form.errors[`items.${index}.unit_price`] ? '!border-b !border-red-300' : ''">
                            </td>
                            <td>
                                {{ item.quantity * item.unit_price }}
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
                                {{ form.sub_total }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="bg-neutral-100 dark:bg-(--sidebar-background) my-5 p-5 rounded-lg">
                <label for="remark">Note:</label>
                <textarea name="remark" id="remark" v-model="form.remark"></textarea>
            </div>

            <div class="text-right">
                <button type="submit" :class="props.record.id ? 'edit-btn' : 'submit-btn'">
                    {{ props.record.id ? 'Update' : 'Submit' }}
                </button>
            </div>
        </form>
    </AppLayout>
</template>