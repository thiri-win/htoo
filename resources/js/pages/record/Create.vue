<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    record: Object,
    categories: Array,
})

const form = useForm({
    'date': props.record.date ? new Date(props.record.date).toISOString().split('T')[0] : new Date().toISOString().split('T')[0],
    'description': props.record.description || '',
    'category_id': props.record.category_id || '',
    'grand_total': props.record.grand_total || 0,
    'remark': props.record.remark || null
});

const submit = () => {
    form.post(route('records.store'));
}

</script>
<template>
    <AppLayout>
        <h1>အသုံးစာရင်းထည့်ရန်</h1>
        <form action="" method="" @submit.prevent="submit">
            <div class="bg-neutral-100 dark:bg-(--sidebar-background) p-5 rounded-lg mb-3">
                <div class="mb-3">
                    <label for="date">Date:</label>
                    <input type="date" name="date" id="date" v-model="form.date" :class="form.errors.date ? 'border-red-300' : ''">
                </div>
                <div class="mb-3">
                    <label for="description">Description:</label>
                    <input type="text" name="description" id="description" placeholder="အကြောင်းအရာ" v-model="form.description" :class="form.errors.description ? 'border-red-300' : ''">
                </div>
                <div class="mb-3">
                    <label for="category_id">Category:</label>
                    <select name="category_id" id="category_id" v-model="form.category_id" :class="form.errors.category_id ? 'border-red-300' : ''">
                        <option class="" value="" disabled hidden>-- Select Category --</option>
                        <option v-for="category in props.categories" :value="category.id" v-bind:key="category.id">
                            {{ category.title }}
                        </option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="grand_total">Total:</label>
                    <input type="number" name="grand_total" id="grand_total" placeholder="Total" v-model="form.grand_total" :class="form.errors.grand_total ? 'border-red-300' : ''">
                </div>
                <div class="mb-3">
                    <label for="remark">Note:</label>
                    <textarea name="remark" id="remark" v-model="form.remark" class="!border-0 !border-b" :class="form.errors.remark ? 'border-red-300' : ''"></textarea>
                </div>
            </div>
            <div class="text-right">
                <button type="submit" :class="props.record.id ? 'edit-btn' : 'submit-btn'">
                    {{ props.record.id ? 'Update' : 'Submit' }}
                </button>
            </div>
        </form>
    </AppLayout>
</template>