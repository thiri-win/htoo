<script setup>

import AppLayout from '@/layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import dayjs from 'dayjs';
import { onMounted } from 'vue';

defineProps({
    category: Object
})

onMounted(()=> {
    $("table").DataTable({
        autoWidth: false,
    })
})

</script>
<template>
    <AppLayout>
        <h1>{{ category.title }}</h1>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>အကြောင်းအရာ</th>
                    <th>ပမာဏ</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="record in category.records" :key="record.id">
                    <td class="text-right">{{ dayjs(record.date).format('DD-MM-YYYY') }}</td>
                    <td>{{ record.description }}</td>
                    <td class="text-right">{{ record.grand_total.toLocaleString() }}</td>
                    <td>
                        <Link :href="route('records.show', record)" class="show-btn">Show</Link>
                    </td>
                </tr>
            </tbody>
        </table>
    </AppLayout>
</template>