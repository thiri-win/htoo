<script setup>

import AppLayout from '@/layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import dayjs from 'dayjs';
import { EyeIcon, Pencil, Printer, Trash } from 'lucide-vue-next';

defineProps({
    records: Array,
    vouchers: Array,
})

onMounted(() => {
    $('table').DataTable({
        order: [[0, 'desc']],
        autoWidth: false,
        // scrollX: true,
    });
})


</script>

<template>
    <AppLayout>
        <Link :href="route('records.create')" class="btn new-btn">+ စာရင်းအသစ်ထည့်ရန်</Link>
        <table>
            <thead class="border-0">
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Amount</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="record in records" v-bind:key="record.id">
                    <td>{{ record.id }}</td>
                    <td>{{ dayjs(record.date).format('DD-MM-YYYY') }}</td>
                    <td>{{ record.description }}</td>
                    <td>{{ record.category.title }}</td>
                    <td>{{ record.grand_total.toLocaleString() }}</td>
                    <td>
                        <a :href="route('records.show', record)" class="btn show-btn inline-block mr-1 text-xs">
                            <EyeIcon class="inline-block w-4 xl:w-3 xl:mr-1" />
                            <span class="hidden xl:inline-block">View</span>
                        </a>
                        <div v-if="record.category.id == 1" class="inline-block">
                            <a :href="route('vouchers.edit', record)" class="btn edit-btn inline-block mr-1 text-xs">
                                <Pencil class="inline-block w-4 xl:w-3 xl:mr-1" />
                                <span class="hidden xl:inline-block">Edit</span>
                            </a>
                        </div>
                        <div v-else-if="record.category.id == 2" class="inline-block">
                            <a :href="route('expenses.edit', record)" class="btn edit-btn inline-block mr-1 text-xs">
                                <Pencil class="inline-block w-4 xl:w-3 xl:mr-1" />
                                <span class="hidden xl:inline-block">Edit</span>
                            </a>
                        </div>
                        <div v-else class="inline-block">
                            <a :href="route('records.edit', record)" class="btn edit-btn inline-block mr-1 text-xs">
                                <Pencil class="inline-block w-4 xl:w-3 xl:mr-1" />
                                <span class="hidden xl:inline-block">Edit</span>
                            </a>
                        </div>
                        <a :href="route('vouchers.print', record)" class="btn print-btn inline-block mr-1 text-xs">
                            <Printer class="inline-block w-4 xl:w-3 xl:mr-1" />
                            <span class="hidden xl:inline-block">Print</span>
                        </a>
                        <Link method="delete" as="button" :href="route('records.destroy', record)" class="btn delete-btn inline-block mr-1 text-xs">
                            <Trash class="inline-block w-4 xl:w-3 xl:mr-1" />
                            <span class="hidden xl:inline-block">Delete</span>
                        </Link>
                    </td>
                </tr>
            </tbody>
        </table>
    </AppLayout>
</template>