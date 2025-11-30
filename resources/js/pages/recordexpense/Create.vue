<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import { computed, ref, watch } from 'vue';

const props = defineProps({
    record: Object,
    categories: Array,
    cars: Array,
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

const form = useForm({
    'date': props.record.date ? new Date(props.record.date).toISOString().split('T')[0] : new Date().toISOString().split('T')[0],
    'description': props.record.description || '',
    'car_id': props.record.car_id || '',
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

form.grand_total = computed(() => {
    return form.items.reduce((sum, item) => {
        return sum + (item.quantity * item.unit_price)
    }, 0) - form.discount
})

const submit = () => {
    // if (props.record.id) {
    //     form.put(route('records.update', props.record.id))
    // } else {
    form.post(route('expenses.store'));
    // }
}

</script>
<template>
    <AppLayout>
        <h1>ပစ္စည်းဝယ်စာရင်းဖြည့်ရန်</h1>
        <form action="" method="" @submit.prevent="submit">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 gap-y-5 bg-neutral-100 dark:bg-(--sidebar-background) p-5 rounded-lg">
                <div>
                    <input type="date" name="date" id="date" v-model="form.date" :class="form.errors.date ? 'border-red-300' : ''">
                </div>
                <div>
                    <input type="text" name="description" id="description" v-model="form.description" :class="form.errors.description ? 'border-red-300' : ''" placeholder="Description" autofocus>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 gap-y-5 bg-neutral-100 dark:bg-(--sidebar-background) my-3 p-5 rounded-lg">
                <div>
                    <input type="text" list="carNumber" name="car_id" id="car_id" placeholder="Car Number 1A-1234" v-model="form.car_id" :class="form.errors.car_id ? 'border-red-300' : ''">
                    <datalist id="carNumber">
                        <option v-for="car in cars" :key="car.id" :value="car.id">{{ car.car_number }}</option>
                    </datalist>
                    <p>
                        <mark>{{ selectedCar.car_number }}</mark>
                        {{ selectedCar.car_brand }}
                        {{ selectedCar.car_model }}
                        {{ selectedCar.customer_name }}
                        {{ selectedCar.customer_phone }}
                    </p>
                </div>
                <div>
                    <p  class="text-xs mb-2">List ထဲမှာ ကားနံပါတ် မရှိပါက အသစ်ထပ်ထည့်ရပါမည်</p>
                    <a :href="route('cars.create')" class="btn new-btn m-0 text-xs">+ New Car</a>
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
    <!-- <AppLayout>
        <h1>နေ့စဥ်စာရင်းအသစ်ထည့်မယ်</h1>
        <form action="" method="" v-on:submit.prevent="submit">
            <table class="w-full">
                <tbody>
                    <tr>
                        <td>
                            <input type="date" name="date" id="date" v-model="form.date" class="mb-3" :class="form.errors.date ? 'border-red-300' : ''"></input>
                        </td>
                    </tr>
                    <tr v-for="(record, index) in form.records" :key="record.id">
                        <td>
                            {{ index + 1 }}
                        </td>
                        <td>
                            <input type="text" placeholder="အကြောင်းအရာ" v-model="record.description" class="mb-3" name="description" :class="form.errors[`records.${index}.description`] ? '!border-b !border-red-300' : ''">
                        </td>
                        <td>
                            <select name="category_id" id="category_id" v-model="record.category_id" class="mb-3" :class="form.errors[`records.${index}.category_id`] ? '!border-b !border-red-300' : ''">
                                <option value="">အမျိုးအစားရွေးပါ</option>
                                <option v-for="category in categories" :key="category.id" :value="category.id">
                                    {{ category.title }}
                                </option>
                            </select>
                        </td>
                        <td>
                            <input type="number" name="grand_total" id="grand_total" placeholder="ပမာဏ" class="mb-3" v-model="record.grand_total" :class="form.errors[`records.${index}.grand_total`] ? '!border-b !border-red-300' : ''">
                        </td>
                        <td>
                            <input type="text" name="remark" id="remark" placeholder="မှတ်ချက်" class="mb-3" v-model="record.remark" :class="form.errors[`records.${index}.remark`] ? '!border-b !border-red-300' : ''">
                        </td>
                        <td>
                            <a href="#" @click.prevent="removeRecord(record)" class="text-nowrap"> - Remove</a>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-nowrap">
                            <a href="#" @click.prevent="addRecord">+ Add</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button type="submit" class="submit-btn mr-2 inline-block">Submit</button>
                            <a href="/dashboard" class="new-btn my-5 inline-block">Back to Dashboard</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </AppLayout> -->
</template>