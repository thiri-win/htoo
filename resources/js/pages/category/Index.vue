<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import { MinusCircleIcon, PlusCircleIcon } from 'lucide-vue-next';
import { onMounted } from 'vue';

defineProps({
    categories: Array
})

onMounted(() => {
    $('table').DataTable({
        order: [[0, 'asc']],
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
                    <td>
                        <a :href="route('categories.show', category)">{{ category.title }}</a>
                    </td>
                    <td>
                        <PlusCircleIcon v-if="category.status == 'sum'" class="inline-block text-green-500" />
                        <MinusCircleIcon v-else class="inline-block text-red-500" />
                        {{ category.status }}
                    </td>
                    <td>{{ category.remark }}</td>
                    <td>
                        <Link :href="route('categories.show', category)" class="show-btn text-sm me-2">Show</Link>
                        <Link :href="route('categories.edit', category)" class="edit-btn text-sm">Edit</Link>
                    </td>
                </tr>
            </tbody>
        </table>
    </AppLayout>
</template>