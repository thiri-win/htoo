<script setup>

import AppLayout from '@/layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import { EyeIcon, Pencil } from 'lucide-vue-next';

defineProps({
    employees: Array
})

</script>

<template>
    <AppLayout>
        <Link :href="route('employees.create')" class="btn new-btn">+New</Link>
        <table class="w-full">
            <thead class="border-0">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Join_Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="employee in employees" :key="employee.id">
                    <td>{{ employee.id }}</td>
                    <td>{{ employee.name }}</td>
                    <td>{{ employee.join_date }}</td>
                    <td>
                        <Link :href="route('employees.show', employee)" class="btn show-btn inline-block mr-1 text-xs">
                            <EyeIcon class="inline-block w-4 xl:w-3 xl:mr-1" />
                            <span class="hidden xl:inline-block">View</span>
                        </Link>
                        <Link :href="route('employees.edit', employee)" class="btn edit-btn inline-block mr-1 text-xs">
                            <Pencil class="inline-block w-4 xl:w-3 xl:mr-1" />
                            <span class="hidden xl:inline-block">Edit</span>
                        </Link>
                    </td>
                </tr>
            </tbody>
        </table>
    </AppLayout>
</template>