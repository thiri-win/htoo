<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import { computed } from 'vue';

const form = useForm({
    date: new Date().toISOString().split('T')[0],
    description: '',
    basic_salary: 0,
    working_days: 31,
    unpaid_leave_days: 0,
    paid_leave_days: 0,
    fine_late_days: 0,
    bonus_work_leave_days: 0,
    bonus: 0,
    grand_total: 0,
});

const dailySalary = computed(() => {
    return (parseInt(form.basic_salary) / parseInt(form.working_days)).toFixed(2);
});

const unpaidLeaveDaysAmount = computed(() => {
    return dailySalary.value * 2 * parseInt(form.unpaid_leave_days);
});

const paidLeaveDaysAmount = computed(() => {
    return dailySalary.value * parseInt(form.paid_leave_days);
});

const fineLateDaysAmount = computed(() => {
    return (dailySalary.value / 2) * parseInt(form.fine_late_days);
});

const bonusWorkLeaveDaysAmount = computed(() => {
    return dailySalary.value * 1.5 * parseInt(form.bonus_work_leave_days);
});

const grandTotal = computed(() => {
    return (
        Number(form.basic_salary || 0) -
        Number(unpaidLeaveDaysAmount.value || 0) -
        Number(paidLeaveDaysAmount.value || 0) -
        Number(fineLateDaysAmount.value || 0) +
        Number(bonusWorkLeaveDaysAmount.value || 0) +
        Number(form.bonus || 0)
    );
});

const submit = () => {
    form.grand_total = grandTotal.value;
    form.post(route('salary.store'));
};
</script>

<template>
    <AppLayout>
        <h1>လုပ်အားခတွက်ချက်ရန်</h1>
        <form @submit.prevent="submit">
            <div class="grid grid-cols-1 gap-5 lg:grid-cols-2">
                <div>
                    <div class="mb-3 flex justify-between">
                        <label for="date" class="mr-3 text-nowrap">Date:</label>
                        <input
                            type="date"
                            name="date"
                            id="date"
                            v-model="form.date"
                            class="!w-auto"
                            :class="form.errors.date ? 'border-red-500' : ''"
                        />
                    </div>
                    <div class="mb-3 flex justify-between">
                        <label for="description" class="mr-3 text-nowrap">ဝန်ထမ်းအမည်</label>
                        <input
                            type="text"
                            name="description"
                            id="description"
                            placeholder="အမည်"
                            v-model="form.description"
                            class="!w-auto"
                            :class="form.errors.description ? 'border-red-500' : ''"
                            autofocus
                        />
                    </div>
                    <div class="mb-3 flex justify-between">
                        <label for="days" class="mr-3 text-nowrap">အခြေခံလစာ</label>
                        <input type="number" name="basic_salary" id="basic_salary" placeholder="လစာ" v-model="form.basic_salary" class="!w-auto" />
                    </div>
                    <div class="mb-3 flex justify-between">
                        <label for="days" class="mr-3 text-nowrap">တလအတွင်း စုစုပေါင်းရှိရက်</label>
                        <input
                            type="number"
                            name="working_days"
                            id="working_days"
                            placeholder="30, 31 စသဖြင့် ဖြည့်ရန်"
                            class="!w-auto"
                            v-model="form.working_days"
                        />
                    </div>

                    <div class="mb-3 flex justify-between">
                        <label for="days" class="mr-3 text-nowrap">ဒဏ်ကြေး(လစာမဲ့ခွင့်ရက်)</label>
                        <input
                            type="number"
                            name="unpaid_leave_days"
                            id="unpaid_leave_days"
                            placeholder="ခွင့်မဲ့ပျက်ရက်"
                            class="!w-auto"
                            v-model="form.unpaid_leave_days"
                        />
                    </div>
                    <div class="mb-3 flex justify-between">
                        <label for="paid_leave_days" class="mr-3 text-nowrap">ဒဏ်ကြေး(လစာပေးခွင့်ရက်)</label>
                        <input
                            type="number"
                            name="paid_leave_days"
                            id="paid_leave_days"
                            placeholder="ခွင့်ရှိပျက်ရက်"
                            class="!w-auto"
                            v-model="form.paid_leave_days"
                        />
                    </div>

                    <div class="mb-3 flex justify-between">
                        <label for="fine_late_days" class="mr-3 text-nowrap">ဒဏ်ကြေး(နောက်ကျသည့်ရက်)</label>
                        <input
                            type="number"
                            name="fine_late_days"
                            id="fine_late_days"
                            placeholder="နောက်ကျရက်ဒဏ်ကြေး"
                            class="!w-auto"
                            v-model="form.fine_late_days"
                        />
                    </div>

                    <div class="mb-3 flex justify-between">
                        <label for="bonus_work_leave_days" class="mr-3 text-nowrap">ဆုကြေး(နားရက်ဆင်းသည့်ရက်)</label>
                        <input
                            type="number"
                            name="bonus_work_leave_days"
                            id="bonus_work_leave_days"
                            placeholder="နားရက်ဆင်းသည့်ရက်"
                            class="!w-auto"
                            v-model="form.bonus_work_leave_days"
                        />
                    </div>
                    <div class="mb-3 flex justify-between">
                        <label for="bonus" class="mr-3 text-nowrap">ဘောနပ်စ်</label>
                        <input
                            type="number"
                            name="bonus"
                            id="bonus"
                            placeholder="ဆုကြေး"
                            v-model="form.bonus"
                            class="!w-auto"
                            :class="form.errors.bonus ? 'border-red-500' : ''"
                        />
                    </div>
                </div>

                <div class="rounded-xl border p-3 shadow">
                    <div>
                        <table>
                            <tbody>
                                <tr>
                                    <td>Date</td>
                                    <td class="min-w-50 text-right">{{ form.date }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>ဝန်ထမ်းအမည်</td>
                                    <td class="min-w-50 text-right">{{ form.description }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>အခြေခံလစာ</td>
                                    <td v-if="form.basic_salary" class="min-w-50 text-right">{{ form.basic_salary.toLocaleString() }}</td>
                                    <td v-else class="min-w-50 text-right">0</td>
                                    <td v-if="form.basic_salary && form.working_days" class="text-sm">
                                        {{ form.basic_salary }} / {{ form.working_days }}days = {{ dailySalary }}/day
                                    </td>
                                </tr>
                                <tr>
                                    <td>ဒဏ်ကြေး(လစာမဲ့ခွင့်)</td>
                                    <td class="min-w-50 text-right" v-if="form.unpaid_leave_days">- {{ unpaidLeaveDaysAmount.toLocaleString() }}</td>
                                    <td class="min-w-50 text-right" v-else>0</td>
                                    <td v-if="form.unpaid_leave_days && dailySalary">
                                        {{ dailySalary }} x {{ form.unpaid_leave_days }}days = {{ unpaidLeaveDaysAmount }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>ဒဏ်ကြေး(လစာပေးခွင့်ရက်)</td>
                                    <td class="min-w-50 text-right" v-if="form.unpaid_leave_days">- {{ paidLeaveDaysAmount.toLocaleString() }}</td>
                                    <td class="min-w-50 text-right" v-else>0</td>
                                    <td v-if="form.unpaid_leave_days && dailySalary">
                                        {{ dailySalary }} x {{ form.paid_leave_days }}days = {{ paidLeaveDaysAmount }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>ဒဏ်ကြေး(နောက်ကျသည့်ရက်)</td>
                                    <td class="min-w-50 text-right" v-if="form.fine_late_days">- {{ fineLateDaysAmount.toLocaleString() }}</td>
                                    <td class="min-w-50 text-right" v-else>0</td>
                                    <td v-if="form.fine_late_days && dailySalary">
                                        {{ dailySalary }}/2 x {{ form.fine_late_days }}days = {{ fineLateDaysAmount }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>ဆုကြေး(နားရက်ဆင်းသည့်ရက်)</td>
                                    <td class="min-w-50 text-right" v-if="form.bonus_work_leave_days">
                                        - {{ bonusWorkLeaveDaysAmount.toLocaleString() }}
                                    </td>
                                    <td class="min-w-50 text-right" v-else>0</td>
                                    <td v-if="form.bonus_work_leave_days && dailySalary">
                                        {{ dailySalary }} x 1.5 x {{ form.bonus_work_leave_days }}days = {{ bonusWorkLeaveDaysAmount }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>ဘောနပ်စ်</td>
                                    <td v-if="form.bonus" class="min-w-50 text-right">
                                        {{ form.bonus.toLocaleString() }}
                                    </td>
                                    <td v-else class="text-right">0</td>
                                    <td></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>စုစုပေါင်းရငွေ</td>
                                    <td class="min-w-50 text-right">
                                        {{ grandTotal.toLocaleString() }}
                                    </td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div>
                        <button type="submit" class="mb-3 rounded-lg border px-3 py-2 text-red-500 shadow" :disabled="form.processing">
                            စာရင်းထဲသို့သိမ်းမည်
                        </button>
                    </div>
                    <div class="mb-3 rounded-lg border p-3 text-red-500 shadow">
                        <p>မှတ်ချက်</p>
                        <small><strong>စာရင်းထဲသို့သိမ်းမည်</strong> မနှိပ်ပါက database ထဲသို့ သိမ်းမည်မဟုတ်ပါ</small>
                    </div>
                </div>
            </div>
        </form>
    </AppLayout>
</template>
