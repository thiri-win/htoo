<script setup>

import AppLayout from '@/layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    record: Object,
    categories: Array,
})

const form = useForm({
    'date': props.record.date,
    'description': props.record.description,
    'category_id': props.record.category.id,
    'grand_total': props.record.grand_total,
    'remark': props.record.remark,
})

const submit = () => {
    form.put(route('records.update', props.record.id));
}

</script>
<template>
    <AppLayout>
        <h1>စာရင်းပြင်ဆင်ရန်</h1>
        <form action="" method="post" v-on:submit.prevent="submit">
            <div>
                <label for="date">Date:</label>
                <input type="date" name="date" id="date" v-model="form.date">
            </div>
            <div>
                <label for="description">Description:</label>
                <input type="text" name="description" id="description" v-model="form.description">
            </div>
            <div>
                <label for="category_id">Category:</label>
                <select name="category_id" id="category_id" v-model="form.category_id">
                    <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.title }}</option>
                </select>
                <p v-if="form.errors.category_id" class="text-red-500 text-sm mt-1">{{ form.errors.category_id }}</p>
            </div>
            <div class="mb-4">
                <label for="grand_total" class="block text-gray-700 dark:text-gray-300 mb-2">Amount:</label>
                <input type="number" name="grand_total" id="grand_total" v-model="form.grand_total" class="w-full">
                <p v-if="form.errors.grand_total" class="text-red-500 text-sm mt-1">{{ form.errors.grand_total }}</p>
            </div>
            <div class="mb-4">
                <label for="remark" class="block text-gray-700 dark:text-gray-300 mb-2">Remark:</label>
                <input type="text" name="remark" id="remark" v-model="form.remark" class="w-full">
                <p v-if="form.errors.remark" class="text-red-500 text-sm mt-1">{{ form.errors.remark }}</p>
            </div>
            <button type="submit" class="btn submit-btn" :disabled="form.processing">Update Record</button>
        </form>
    </AppLayout>
</template>