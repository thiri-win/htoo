<script setup>

import AppLayout from '@/layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import { onMounted } from 'vue';

defineProps({
    records: Array
})

onMounted(()=> {
    $('table').DataTable({
    order: [[1, 'desc']],
    autoWidth: false,
    scrollX: true,
});
})


</script>

<template>
    <AppLayout>
        <Link :href="route('records.create')" class="new-btn">+ New</Link>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Amount</th>
                    <th>Remark</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="record in records" v-bind:key="record.id">
                    <td v-text="record.id"></td>
                    <td v-text="record.title"></td>
                    <td v-text="record.amount"></td>
                    <td v-text="record.remark"></td>
                    <td>
                        <Link :href="route('records.edit', record)" class="edit-btn text-sm">Edit</Link>
                    </td>
                </tr>
            </tbody>
        </table>
    </AppLayout>
</template>