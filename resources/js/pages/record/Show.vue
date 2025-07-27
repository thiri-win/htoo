<script setup>

import AppLayout from '@/layouts/AppLayout.vue';
defineProps({
    'record' : Object
})

</script>
<template>
    <AppLayout>
        <h1>စာရင်းအသေးစိတ်</h1>
        <table>
            <tr>
                <td>Date :</td>
                <td>{{ record.date }}</td>
            </tr>
            <tr>
                <td>အကြောင်းအရာ :</td>
                <td>{{ record.title }}</td>
            </tr>
            <tr>
                <td>အမျိုးအစား :</td>
                <td>{{ record.category.title }}</td>
            </tr>
            <tr>
                <td>ပမာဏ :</td>
                <td>{{ record.amount }}</td>
            </tr>
            <tr>
                <td>မှတ်ချက် :</td>
                <td>{{ record.remark }}</td>
            </tr>
        </table>
        <a :href="route('records.edit', record)" class="edit-btn my-5 inline-block mr-2">Edit</a>
        <a href="/dashboard" class="new-btn my-5 inline-block">Back to Dashboard</a>
    </AppLayout>
</template>