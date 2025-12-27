<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import { computed, ref, watch } from 'vue';
import vSelect from 'vue-select';
import 'vue-select/dist/vue-select.css';

const props = defineProps({
    cars: Array,
})

const form = useForm({
    'date': new Date().toISOString().split('T')[0],
    'description': '',
    'car_id': null,
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
    'advance': 0,
    'grand_total': 0,
    'remark': null,
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
            if (form.description === '' || form.description === 'Invoice' || !form.description) {
                form.description = car.car_number || car.customer_name || 'Invoice';
            }
        }
    } else {
        selectedCar.value = { car_number: '', car_brand: '', car_model: '', customer_name: '', customer_phone: '' };
    }
}, { immediate: true });

const addSale = () => {
    const newId = form.items.length > 0 ? Math.max(...form.items.map(item => item.id)) + 1 : 1;

    form.items.push({
        id: newId,
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
    form.post(route('expenses.store'));
}

</script>
<template>
    <!-- <AppLayout :breadcrumbs="breadcrumbs"> -->
    <AppLayout>
        <form action="" method="" @submit.prevent="submit">
            <div class="grid grid-cols-1 sm:grid-cols-4 gap-2 gap-y-5 bg-neutral-100 dark:bg-(--sidebar-background) p-5 rounded-lg">
                <div>
                    <input type="date" name="date" id="date" v-model="form.date" :class="form.errors.date ? 'border-red-300' : ''">
                </div>
                <div>
                    <input type="text" name="description" id="description" placeholder="Description" v-model="form.description" :class="form.errors.description ? 'border-red-300' : ''">
                </div>
                <div class="v-select-container">
                    <v-select
                        v-model="form.car_id"
                        :options="cars"
                        :reduce="car => car.id"
                        label="car_number"
                        placeholder="Car Number ရွေးပါ"
                        :class="form.errors.car_id ? 'v-select-error' : ''"
                        class="border-b"
                    ></v-select>
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
                    <p class="text-xs mt-1">List ထဲမှာ ကားနံပါတ် မရှိပါက အသစ်ထပ်ထည့်ရပါမည်</p>
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
                                <label for="discount">Advance</label>
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
                <button type="submit" class="btn submit-btn">
                    Submit
                </button>
            </div>
        </form>
    </AppLayout>
</template>