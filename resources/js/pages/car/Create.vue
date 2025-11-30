<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    car: Object
})

const form = useForm({
    'customer_name': props.car.customer_name || '',
    'customer_phone': props.car.customer_phone || '',
    'car_number': props.car.car_number || '',
    'car_brand': props.car.car_brand || '',
    'car_model': props.car.car_model || '',
});

const submit = () => {

    form.car_number = form.car_number.toUpperCase();

    if (props.car.id) {
        form.put(route('cars.update', props.car.id));
    } else {
        form.post(route('cars.store'), {
            onSuccess: () => form.reset(),
        });
    }
}

</script>
<template>
    <AppLayout>
        <h1>{{ car.id ? 'Edit Car Information' : 'New Car Information' }}</h1>
        <form action="" method="post" v-on:submit.prevent="submit">
            <input type="text" name="car_number" id="car_number" placeholder="Car Number 1A-1234" class="my-3" v-model="form.car_number" autofocus>
            <p class="text-sm text-red-500" v-text="form.errors.car_number"></p>

            <input type="text" name="car_brand" id="car_brand" placeholder="Car Brand" class="my-3" v-model="form.car_brand">
            <p class="text-sm text-red-500" v-text="form.errors.car_brand"></p>

            <input type="text" name="car_model" id="car_model" placeholder="Car Model" class="my-3" v-model="form.car_model">
            <p class="text-sm text-red-500" v-text="form.errors.car_model"></p>

            <input type="text" name="customer_name" id="customer_name" placeholder="Customer Name" class="my-3" v-model="form.customer_name">
            <p class="text-sm text-red-500" v-text="form.errors.customer_name"></p>

            <input type="text" name="customer_phone" id="customer_phone" placeholder="Customer Phone Number" class="my-3" v-model="form.customer_phone">
            <p class="text-sm text-red-500" v-text="form.errors.customer_phone"></p>

            <button type="submit" class="btn submit-btn">Submit</button>
        </form>
    </AppLayout>
</template>