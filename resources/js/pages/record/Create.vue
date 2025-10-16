<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    categories: Array,
    // record: Object
})

const form = useForm({
    "date": props.record?.date ? new Date(props.record.date).toISOString().split('T')[0] : new Date().toISOString().split('T')[0],
    'records': props.records || [
        {
            'id': 1,
            'description': '',
            'category_id': '',
            'grand_total': '',
            'remark': '',
        }
    ],
})

const addRecord = () => {
    form.records.push({
        id: Date.now(),
        description: form.records.description,
        category_id: form.records.category_id || 1,
        grand_total: form.records.grand_total,
        remark: form.records.remark,
    });
};

const removeRecord = (record) => {
    form.records = form.records.filter(r => r.id != record.id)
}

const submit = () => {
    form.post(route('records.store'), {
        onSuccess: () => {
            form.reset()
        }
    })
}

</script>
<template>
    <AppLayout>
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
    </AppLayout>
</template>