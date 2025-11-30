<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import { EyeIcon, Pencil } from 'lucide-vue-next';
import { onMounted } from 'vue';

defineProps({
    cars: Array
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
        <Link :href="route('cars.create')" class="new-btn">+New</Link>
        <table>
            <thead class="border-0">
                <tr>
                    <th>ID</th>
                    <th>Car No</th>
                    <th>Car Brand</th>
                    <th>Car Model</th>
                    <th>Customer Name</th>
                    <th>Phone Number</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="car in cars" v-bind:key="car.id">
                    <td>{{ car.id }}</td>
                    <td>{{ car.car_number }}</td>
                    <td>{{ car.car_brand }}</td>
                    <td>{{ car.car_model }}</td>
                    <td>{{ car.customer_name }}</td>
                    <td>{{ car.customer_phone }}</td>
                    <td>
                        <a :href="route('cars.show', car)" class="btn show-btn inline-block mr-1 text-xs">
                            <EyeIcon class="inline-block w-4 xl:w-3 xl:mr-1" />
                            <span class="hidden xl:inline-block">View</span>
                        </a>
                        <a :href="route('cars.edit', car)" class="btn edit-btn inline-block mr-1 text-xs">
                            <Pencil class="inline-block w-4 xl:w-3 xl:mr-1" />
                            <span class="hidden xl:inline-block">Edit</span>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </AppLayout>
</template>