<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import { computed, watch } from 'vue';

const form = useForm({
    'date': new Date().toISOString().split('T')[0],
    'description': '',
    'basic_salary': 0,
    'working_days': 31,
    'paid_leave_days': 0,
    'unpaid_leave_days': 0,
    'fine': 0,
    'bonus': 0,
    'grand_total': 0,
})

const dailySalary = computed(() => {
    const basicSalary = parseInt(form.basic_salary);
    const workingDays = parseInt(form.working_days);
    if (!isNaN(basicSalary) && !isNaN(workingDays)) {
        return (basicSalary / workingDays).toFixed(2);
    } else {
        return 0;
    }
})


const unpaidAmount = computed(() => {
    const unpaidDays = parseInt(form.unpaid_leave_days);
    if (!isNaN(dailySalary.value) && !isNaN(unpaidDays)) {
        return (dailySalary.value * unpaidDays).toLocaleString(undefined, { maximumFractionDigits: 0 });
    } else {
        return 0;
    }
})

const total = computed(() => {
    
    // to fixed here
    if (!isNaN(parseInt(form.basic_salary)) && !isNaN(parseInt(form.bonus)) && !isNaN(unpaidAmount.value) && !isNaN(parseInt(form.fine))) {
        return (form.basic_salary + form.bonus - unpaidAmount.value - form.fine).toLocaleString(undefined, { maximumFractionDigits: 0 });
    } else {
        return 0;
    }
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
                    <!-- <div class="mb-3">
                        <label for="days">လစာပြည့်ခွင့်</label>
                        <input type="number" name="paid_leave_days" id="paid_leave_days" placeholder="စုစုပေါင်းခွင့်ယူရက်" v-model="form.paid_leave_days">
                        <p class="text-sm text-red-500" v-text="form.errors.paid_leave_days"></p>
                    </div> -->
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
                                    <td class="text-right min-w-50">{{ form.name }}</td>
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
                                    <td class="text-right min-w-50" v-if="form.unpaid_leave_days"> - {{ unpaidAmount }}</td>
                                    <td class="text-right min-w-50" v-else>0</td>
                                    <td v-if="form.unpaid_leave_days && dailySalary">{{ dailySalary }} x {{ form.unpaid_leave_days.toLocaleString() }}</td>
                                </tr>
                                <tr>
                                    <td>ဒဏ်ကြေး</td>
                                    <td v-if="form.fine" class="text-right min-w-50">- {{ form.fine.toLocaleString() }}</td>
                                    <td v-else class="text-right">0</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>ဆုကြေး</td>
                                    <td v-if="form.bonus" class="text-right min-w-50">{{ form.bonus.toLocaleString() }}</td>
                                    <td v-else class="text-right">0</td>
                                    <td></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>စုစုပေါင်းရငွေ</td>
                                    <td class="text-right min-w-50">{{ total }}</td>
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
