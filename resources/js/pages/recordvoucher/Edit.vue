<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import { computed, ref, watch } from 'vue';

const props = defineProps({
    voucher: Object,
    cars: Array,
})

const form = useForm({
    'date': new Date(props.voucher.date).toISOString().split('T')[0],
    'description': props.voucher.description,
    'car_id': props.voucher.car_id,
    'items': props.voucher.items,
    'discount': props.voucher.discount,
    'sub_total': props.voucher.sub_total,
    'advance': props.voucher.advance,
    'grand_total': props.voucher.grand_total,
    'remark': props.voucher.remark,
})

const selectedCar = ref({
    car_number: '',
    car_brand: '',
    car_model: '',
    customer_name: '',
    customer_phone: '',
})

watch(() => form.car_id, (newCarId) => {
    if (newCarId) {
        const car = props.cars.find(c => c.id == newCarId);
        if (car) {
            selectedCar.value = { ...car };
        }
    } else {
        selectedCar.value = { car_number: '', car_brand: '', car_model: '', customer_name: '', customer_phone: '' };
    }
}, { immediate: true });

const addSale = () => {
    form.items.push({
        id: Math.random().toString(36).substring(2),
        description: '',
        quantity: 1,
        unit_price: 0,
        total: 0
    });
};

const removeSale = (item) => {
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
    form.put(route('vouchers.update', props.voucher.id))
}

</script>
<template>
    <AppLayout>
        <form action="" method="" @submit.prevent="submit">
            <div class="grid grid-cols-1 sm:grid-cols-4 gap-2 gap-y-5 bg-neutral-100 dark:bg-(--sidebar-background) p-5 rounded-lg">
                <div>
                    <input type="date" name="date" id="date" v-model="form.date" :class="form.errors.date ? 'border-red-300' : ''">
                </div>
                <div>
                    <input type="text" name="description" id="description" placeholder="Description" v-model="form.description" :class="form.errors.description ? 'border-red-300' : ''">
                </div>
                <div>
                    <input type="text" list="carNumber" name="car_id" id="car_id" placeholder="Car Number 1A-1234" v-model="form.car_id" :class="form.errors.car_id ? 'border-red-300' : ''">
                    <datalist id="carNumber">
                        <option v-for="car in cars" :key="car.id" :value="car.id">{{ car.car_number }}</option>
                    </datalist>
                    <p class="text-xs">
                        <mark>{{ selectedCar.car_number }}</mark>
                        {{ selectedCar.car_brand }}
                        {{ selectedCar.car_model }}
                        {{ selectedCar.customer_name }}
                        {{ selectedCar.customer_phone }}
                    </p>
                </div>
                <div>
                    <a :href="route('cars.create')" class="btn new-btn !m-0 text-xs">+ New Car</a>
                    <p class="text-xs">List ထဲမှာ ကားနံပါတ် မရှိပါက အသစ်ထပ်ထည့်ရပါမည်</p>
                </div>
            </div>
            <div class="bg-neutral-100 dark:bg-(--sidebar-background) my-3 p-5 rounded-lg">
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
                                <a href="#" @click.prevent="removeSale(item)" class="text-nowrap"> - Remove</a>
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
                <button type="submit" class="btn edit-btn">
                    Update
                </button>
            </div>
        </form>
    </AppLayout>
</template>