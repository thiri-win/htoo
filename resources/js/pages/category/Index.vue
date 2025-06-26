<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import { onMounted } from 'vue';

defineProps({
    categories: Array
})

onMounted(() => {
    $('table').DataTable({
        order: [[1, 'desc']],
        autoWidth: false,
        scrollX: true,
    });
})

</script>
<template>
    <AppLayout>
        <Link :href="route('categories.create')" class="new-btn">+New</Link>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>အကြောင်းအရာ</th>
                    <th>စာရင်းတွက်ရန်</th>
                    <th>မှတ်ချက်</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="category in categories" v-bind:key="category.id">
                    <td>{{ category.id }}</td>
                    <td>{{ category.title }}</td>
                    <td>{{ category.status }}</td>
                    <td>{{ category.remark }}</td>
                    <td>
                        <Link :href="route('categories.edit', category)" class="edit-btn text-sm me-2">Edit</Link>
                    </td>
                </tr>
            </tbody>
        </table>
    </AppLayout>
</template>