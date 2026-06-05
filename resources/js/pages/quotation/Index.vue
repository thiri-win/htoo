<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import dayjs from 'dayjs';
import { Pencil, Printer } from 'lucide-vue-next';
import { onMounted } from 'vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Quotations',
        href: '/quotations',
    },
];

defineProps({
    quotations: Array,
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

    <Head title="Quotation" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <Link :href="route('quotations.create')" class="btn new-btn mr-2">+ New Quotation</Link>
        <table>
            <thead class="border-0">
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Subject</th>
                    <th>To</th>
                    <th>Grand Total</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="quotation in quotations">
                    <td>{{ quotation.id }}</td>
                    <td>{{ dayjs(quotation.date).format('DD-MM-YYYY') }}</td>
                    <td>{{ quotation.subject }}</td>
                    <td>{{ quotation.to }}</td>
                    <td>{{ quotation.grand_total.toLocaleString() }}</td>
                    <td>
                        <a :href="route('quotations.edit', quotation)" class="btn edit-btn inline-block mr-1 text-xs">
                            <Pencil class="inline-block w-4 xl:w-3 xl:mr-1" />
                            <span class="hidden xl:inline-block">Edit</span>
                        </a>
                        <a :href="route('quotations.print', quotation)" class="btn print-btn inline-block mr-1 text-xs">
                            <Printer class="inline-block w-4 xl:w-3 xl:mr-1" />
                            <span class="hidden xl:inline-block">Print</span>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </AppLayout>
</template>