<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    categories: Array,
    record: Object
})

const form = useForm({
    "title": props.record.title || '',
    "category_id": props.record.category_id || '',
    "amount": props.record.amount || '',
    "remark": props.record.remark || '',
})

const submit = () => {
    if(props.record.id) {
        form.put(route('records.update', props.record.id))
    } else {
        form.post(route('records.store'))
    }
}

</script>
<template>
    <AppLayout>
        <h1>{{ record.id ? 'စာရင်းပြန်ပြင်ခြင်း' : 'နေ့စဥ်စာရင်းအသစ်ထည့်မယ်' }}</h1>
        <form action="" method="" v-on:submit.prevent="submit">
            <input type="text" placeholder="အကြောင်းအရာ" v-model="form.title" class="mb-3" name="title">
            <p class="text-red-500 mb-3" v-text="form.errors.title"></p>
            <select name="category_id" id="category_id" v-model="form.category_id" class="mb-3">
                <option value="">အမျိုးအစားရွေးပါ</option>
                <option v-for="category in categories" :key="category.id" :value="category.id">
                    {{ category.title }}
                </option>
            </select>
            <p class="text-red-500 mb-3" v-text="form.errors.category_id"></p>
            <input type="number" name="amount" id="amount" placeholder="ကုန်ကျငွေ" class="mb-3" v-model="form.amount">
            <p class="text-red-500 mb-3" v-text="form.errors.amount"></p>
            <input type="text" name="remark" id="remark" placeholder="မှတ်ချက်" class="mb-3" v-model="form.remark">
            <p class="text-red-500 mb-3" v-text="form.errors.remark"></p>
            <button type="submit" class="submit-btn">Submit</button>
        </form>
    </AppLayout>
</template>