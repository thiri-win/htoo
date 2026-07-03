<script setup>

import AppLayout from '@/layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    employee: Object,
})

const form = useForm({
    'name': props.employee.name || '',
    'dob': props.employee.dob || '',
    'join_date': props.employee.join_date || '',
    'leave_date': props.employee.leave_date || '',
    'base_salary': props.employee.salary_histories?.[0].base_salary || '',
})

console.log(props.employee.salary_histories);

const submit = () => {
    if (props.employee.id) {
        form.put(route('employees.update', props.employee.id));
    } else {
        form.post(route('employees.store'));
    }
}

</script>
<template>
    <AppLayout>
        <h1>{{ employee.id ? 'ဝန်ထမ်းအချက်အလက် ပြင်ဆင်ရန်' : 'ဝန်ထမ်:အချက်အလက် အသစ်ထည့်ရန်' }}</h1>
        <form method="post" v-on:submit.prevent="submit">
            <div>
                <label for="name">နာမည်</label>
                <input type="text" name="name" id="name" placeholder="Name" class="my-3" v-model="form.name" autofocus>
                <p class="text-sm text-red-500" v-text="form.errors.name"></p>
            </div>

            <div>
                <label for="dob">မွေးနေ့</label>
                <input type="date" name="dob" id="dob" class="my-3" v-model="form.dob" autofocus>
                <p class="text-sm text-red-500" v-text="form.errors.dob"></p>
            </div>

            <div>
                <label for="base_salary">အခြေခံလစာ</label>
                <input type="number" name="base_salary" id="base_salary" placeholder="Basic Salary" class="my-3 !text-left" v-model="form.base_salary" autofocus>
                <p class="text-sm text-red-500" v-text="form.errors.base_salary"></p>
            </div>

            <div>
                <label for="dob">အလုပ်ဝင်ရက်</label>
                <input type="date" name="join_date" id="join_date" class="my-3" v-model="form.join_date" autofocus>
                <p class="text-sm text-red-500" v-text="form.errors.join_date"></p>
            </div>

            <div>
                <label for="dob">အလုပ်ထွက်ရက်</label>
                <input type="date" name="leave_date" id="leave_date" class="my-3" v-model="form.leave_date" autofocus>
                <p class="text-sm text-red-500" v-text="form.errors.leave_date"></p>
            </div>

            <div>
                <button type="submit" class="btn submit-btn">Submit</button>
            </div>

        </form>
    </AppLayout>
</template>