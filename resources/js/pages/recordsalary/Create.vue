<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import { computed, watch } from 'vue';

const form = useForm({
    'date': new Date().toISOString().split('T')[0],
    'description': '',
    'basic_salary': 0,
    'working_days': 31,
    'unpaid_leave_days': 0,
    'fine': 0,
    'bonus': 0,
    'grand_total': 0,
})

const dailySalary = computed(() => {
    // const basicSalary = parseInt(form.basic_salary);
    // const workingDays = parseInt(form.working_days);
    // if (!isNaN(parseInt(form.basic_salary)) && !isNaN(workingDays)) {
    return (parseInt(form.basic_salary) / parseInt(form.working_days)).toFixed(2);
    // } else {
    // return 0;
    // }
})

const unpaidAmount = computed(() => {
    // console.log(parseInt(dailySalary.value));
    // console.log(form.unpaid_leave_days);
    // console.log(!isNaN(dailySalary.value) && form.unpaid_leave_days ? 'hello' : 'no');
    // if (!isNaN(dailySalary.value) && form.unpaid_leave_days) {
    return (dailySalary.value * parseInt(form.unpaid_leave_days));
    // } else {
    // return 0;
    // }
})

const total = computed(() => {
    return form.basic_salary + form.bonus - unpaidAmount.value - form.fine;
})

const submit = () => {
    form.grand_total = total.value;
    form.post(route('salary.store'));
}

</script>

<template>
    <AppLayout>
        <h1>လုပ်အားခတွက်ချက်ရန်</h1>
        <form @submit.prevent="submit">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div>
                    <div class="mb-3">
                        <label for="date">Date:</label>
                        <input type="date" name="date" id="date" v-model="form.date">
                        <p class="text-sm text-red-500" v-text="form.errors.date"></p>
                    </div>
                    <div class="mb-3">
                        <label for="description">ဝန်ထမ်းအမည်</label>
                        <input type="text" name="description" id="description" placeholder="အမည်" v-model="form.description" autofocus>
                        <p class="text-sm text-red-500" v-text="form.errors.description"></p>
                    </div>
                    <div class="mb-3">
                        <label for="days">အခြေခံလစာ</label>
                        <input type="number" name="basic_salary" id="basic_salary" placeholder="လစာ" v-model="form.basic_salary">
                        <p class="text-sm text-red-500" v-text="form.errors.basic_salary"></p>
                    </div>
                    <div class="mb-3">
                        <label for="days">တလအတွင်း စုစုပေါင်းရှိရက်</label>
                        <input type="number" name="working_days" id="working_days" placeholder="30, 31 စသဖြင့် ဖြည့်ရန်" v-model="form.working_days">
                        <p class="text-sm text-red-500" v-text="form.errors.working_days"></p>
                    </div>
                    <div class="mb-3">
                        <label for="days">လစာမဲ့ခွင့်ရက်</label>
                        <input type="number" name="unpaid_leave_days" id="unpaid_leave_days" placeholder="ခွင့်မဲ့ပျက်ရက်" v-model="form.unpaid_leave_days">
                        <p class="text-sm text-red-500" v-text="form.errors.unpaid_leave_days"></p>
                    </div>
                    <div class="mb-3">
                        <label for="fine">ဒဏ်ကြေး</label>
                        <input type="number" name="fine" id="fine" placeholder="ဒဏ်ကြေး" v-model="form.fine">
                        <p class="text-sm text-red-500" v-text="form.errors.fine"></p>
                    </div>
                    <div class="mb-3">
                        <label for="bonus">ဆုကြေး</label>
                        <input type="number" name="bonus" id="bonus" placeholder="ဆုကြေး" v-model="form.bonus">
                        <p class="text-sm text-red-500" v-text="form.errors.bonus"></p>
                    </div>

                </div>
                <div class="md:col-span-2 shadow border rounded-xl p-3">
                    <div>
                        <table>
                            <tbody>
                                <tr>
                                    <td>Date</td>
                                    <td class="text-right min-w-50">{{ form.date }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>ဝန်ထမ်းအမည်</td>
                                    <td class="text-right min-w-50">{{ form.description }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>အခြေခံလစာ</td>
                                    <td v-if="form.basic_salary" class="text-right min-w-50">{{ form.basic_salary.toLocaleString() }}</td>
                                    <td v-else class="text-right min-w-50">0</td>
                                    <td v-if="form.basic_salary && form.working_days">{{ form.basic_salary }} / {{ form.working_days }} = {{ dailySalary }}/day</td>
                                </tr>
                                <tr>
                                    <td>လစာမဲ့ခွင့်</td>
                                    <td class="text-right min-w-50" v-if="form.unpaid_leave_days"> - {{ unpaidAmount.toLocaleString(undefined, {minimumFractionDigits: 0,maximumFractionDigits: 0}) }}</td>
                                    <td class="text-right min-w-50" v-else>0</td>
                                    <td v-if="form.unpaid_leave_days && dailySalary">{{ dailySalary }} x {{ form.unpaid_leave_days }} = {{ unpaidAmount.toLocaleString(undefined, {minimumFractionDigits: 2,maximumFractionDigits: 2}) }}</td>
                                </tr>
                                <tr>
                                    <td>ဒဏ်ကြေး</td>
                                    <td v-if="form.fine" class="text-right min-w-50">- {{ form.fine.toLocaleString(undefined, {minimumFractionDigits: 0,maximumFractionDigits: 0}) }}</td>
                                    <td v-else class="text-right">0</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>ဆုကြေး</td>
                                    <td v-if="form.bonus" class="text-right min-w-50">{{ form.bonus.toLocaleString(undefined, {minimumFractionDigits: 0,maximumFractionDigits: 0}) }}</td>
                                    <td v-else class="text-right">0</td>
                                    <td></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>စုစုပေါင်းရငွေ</td>
                                    <td class="text-right min-w-50">{{ total.toLocaleString(undefined, {minimumFractionDigits: 0,maximumFractionDigits: 0}) }}</td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div>
                        <button type="submit" class="px-3 py-2 mb-3 border rounded-lg shadow text-red-500" :disabled="form.processing">စာရင်းထဲသို့သိမ်းမည်</button>
                    </div>
                    <div class="mb-3 border p-3 rounded-lg shadow text-red-500">
                        <p>မှတ်ချက်</p>
                        <small><strong>စာရင်းထဲသို့သိမ်းမည်</strong> မနှိပ်ပါက database ထဲသို့ သိမ်းမည်မဟုတ်ပါ</small>
                    </div>
                </div>
            </div>
        </form>
    </AppLayout>
</template>
