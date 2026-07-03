<script setup>

import AppLayout from '@/layouts/AppLayout.vue';

defineProps({
    employee: Object,
})

</script>

<template>
    <AppLayout>
        <h1>Detail of Employee</h1>
        <div class="flex mb-3">
            <span class="min-w-32 text-gray-700">Name:</span>
            <p class="font-medium">{{ employee.name }}</p>
        </div>
        <div class="flex mb-3">
            <span class="min-w-32 text-gray-700">DOB:</span>
            <p class="font-medium">{{ employee.dob }}</p>
        </div>
        <div class="flex mb-3">
            <span class="min-w-32 text-gray-700">Base Salary:</span>
            <p class="font-medium">{{ employee.latest_salary?.base_salary }}</p>
        </div>
        <div class="flex mb-3">
            <span class="min-w-32 text-gray-700">Join Date:</span>
            <p class="font-medium">{{ employee.join_date }}</p>
        </div>
        <div class="flex mb-3">
            <span class="min-w-32 text-gray-700">Leave Date:</span>
            <p class="font-medium">{{ employee.leave_date }}</p>
        </div>
        <div class="shadow p-5">
            <h2 class="underline">Salary History</h2>
            <table class="w-full">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Date</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="salary in employee.salary_histories" :key="salary.id">
                        <td>{{ salary.id }}</td>
                        <td>{{ salary.created_at }}</td>
                        <td class="text-right">{{ salary.base_salary }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AppLayout>
</template>