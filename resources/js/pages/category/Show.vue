<script setup>

import AppLayout from '@/layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
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
        <h1>{{ category.title }} အသုံးပြုမှုများ</h1>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>အကြောင်းအရာ</th>
                    <th>ပမာဏ</th>
                    <th>Remark</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="record in category.records">
                    <td>{{ record.date }}</td>
                    <td>{{ record.title }}</td>
                    <td>{{ record.amount }}</td>
                    <td>{{ record.remark }}</td>
                    <td>
                        <Link href="route(records.show, record)" class="show-btn">Show</Link>
                    </td>
                </tr>
            </tbody>
        </table>
    </AppLayout>
</template>