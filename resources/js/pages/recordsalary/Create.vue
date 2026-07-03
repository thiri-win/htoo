<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import { ref, computed, watch } from 'vue';

const props = defineProps({
    employees: Array
})

const date = ref(new Date().toISOString().split('T')[0]);
const employeeName = ref('');
const baseSalary = ref(0);
const allowedLeave = ref(2);

watch(employeeName, (newId) => {
    const selectedEmployee = props.employees?.find(e => e.id == newId);
    if (selectedEmployee) {
        baseSalary.value = selectedEmployee.latest_salary?.base_salary || 0;
    } else {
        baseSalary.value = 0;
    }
})

const attendanceData = ref<Record<string, string>>({});

const attendanceStatuses = {
    off: { label: 'နားရက်', color: 'gray', rate: 0 },
    approved_leave: { label: 'ခွင့်ပျက်', color: 'green', rate: 1 },
    unapproved_leave: { label: 'ခွင့်မဲ့ပျက်', color: 'red', rate: 2 },
    late: { label: 'နောက်ကျ', color: 'yellow', rate: 0.25 }
};

const selectedDate = ref(new Date());

const getFormattedDate = (date: Date) => {
    return date.toISOString().split('T')[0];
};

const calendarAttributes = computed(() => {
    return Object.entries(attendanceData.value).map(([dateStr, status]) => ({
        key: dateStr,
        highlight: (attendanceStatuses as any)[status]?.color,
        dates: new Date(dateStr),
        popover: { label: (attendanceStatuses as any)[status]?.label }
    }));
});

const setStatusForSelectedDate = (status: string) => {

    const dateKey = getFormattedDate(selectedDate.value);

    if (status === 'normal') {
        delete attendanceData.value[dateKey];
    } else {
        attendanceData.value[dateKey] = status;
    }
};

const salarySummary = computed(() => {

    let offCount = 0;
    let offWorkCount = 0
    let approvedLeaveCount = 0;
    let unapprovedLeaveCount = 0;
    let lateCount = 0;

    Object.values(attendanceData.value).forEach(status => {
        if (status === 'off') offCount++;
        if (status === 'approved_leave') approvedLeaveCount++;
        if (status === 'unapproved_leave') unapprovedLeaveCount++;
        if (status === 'late') lateCount++;
    });

    const activeDate = selectedDate.value ? new Date(selectedDate.value) : new Date();
    const year = activeDate.getFullYear();
    const month = activeDate.getMonth();

    const totalDaysInMonth = new Date(year, month + 1, 0).getDate();
    const dailyRate = baseSalary.value / totalDaysInMonth;

    offWorkCount = offCount < allowedLeave.value ? (allowedLeave.value - offCount) : 0;
    const totalOffWorkEarn = offWorkCount * (dailyRate * 1.5);

    const isPrefectAttendence = offCount == 0 && approvedLeaveCount == 0 && unapprovedLeaveCount == 0 && lateCount == 0;
    const totalAttendanceFullEarn = isPrefectAttendence ? baseSalary.value * 0.03 : 0;

    const totalApprovedDeduct = approvedLeaveCount * (dailyRate * attendanceStatuses.approved_leave.rate);
    const totalUnapprovedDeduct = unapprovedLeaveCount * (dailyRate * attendanceStatuses.unapproved_leave.rate);
    const totalLateDeduct = lateCount * (dailyRate * attendanceStatuses.late.rate);

    const netSalary = baseSalary.value + totalAttendanceFullEarn + totalOffWorkEarn - totalApprovedDeduct - totalUnapprovedDeduct - totalLateDeduct;

    return {
        dailyRate,
        offCount,
        offWorkCount,
        approvedLeaveCount,
        unapprovedLeaveCount,
        lateCount,
        totalOffWorkEarn,
        totalAttendanceFullEarn,
        totalApprovedDeduct,
        totalUnapprovedDeduct,
        totalLateDeduct,
        netSalary,
    };
});

const save = () => {

    router.post(route('salary.store'), {
        'employee_id': employeeName.value,
        'date': date.value,
        'base_salary': baseSalary.value,
        'allowed_leave': allowedLeave.value,
        'net_salary': salarySummary.value.netSalary,
        'off_count': salarySummary.value.offCount,
        'off_work_count': salarySummary.value.offWorkCount,
        'approved_leave_count': salarySummary.value.approvedLeaveCount,
        'unapproved_leave_count': salarySummary.value.unapprovedLeaveCount,
        'late_count': salarySummary.value.lateCount,
        'attendance_details': attendanceData.value
    }, {
        onSuccess: () => {
            alert("လစာစာရင်းကို ဒေတာဘေ့စ်ထဲ အောင်မြင်စွာ သိမ်းဆည်းပြီးပါပြီဗျာ!");
        },
        onError: (errors) => {
            console.log(errors);
            alert('ဒေတာသိမ်းဆည်းရာတွင် အမှားအယွင်းတစ်ခု ရှိနေပါသည်!')
        }
    });
}

</script>

<template>
    <Head title="Salary Calculator" />
    <AppLayout>
        <div>
            <h1>လုပ်အားခတွက်ရန်</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="border p-4 rounded-lg shadow">
                    <div>
                        <div class="mb-4 flex">
                            <label for="date" class="min-w-1/3 text-nowrap">Date : </label>
                            <input type="date" name="date" id="date" v-model="date" class="!border">
                        </div>

                        <div class="mb-4 flex">
                            <label for="employeeName" class="min-w-1/3 text-nowrap">ဝန်ထမ်းအမည် : </label>
                            <select name="employeename" id="employee" v-model="employeeName" class="!border">
                                <option v-for="employee in props.employees" :key="employee.id" :value="employee.id">{{ employee.name }}</option>
                            </select>
                        </div>

                        <div class="mb-4 flex">
                            <label for="baseSalary" class="min-w-1/3 text-nowrap">အခြေခံလုပ်အားခ : </label>
                            <input type="number" name="baseSalary" id="baseSalary" v-model="baseSalary" class="!border">
                        </div>

                        <div class="mb-4 flex">
                            <label for="allowedLeave" class="min-w-1/3">ခွင့်ပြုထားသောနားရက်စုစုပေါင်း : </label>
                            <input type="number" name="allowedLeave" id="allowLeave" v-model="allowedLeave" class="!border">
                        </div>

                        <div class="space-y-3 text-sm border-t pt-3">
                            <div class="flex justify-between">
                                <span>၁ ရက်စာလုပ်အားခ:</span>
                                <span class="font-medium">{{ Math.round(salarySummary.dailyRate).toLocaleString() }} ကျပ်</span>
                            </div>
                            <div class="flex justify-between" :style="{ color: attendanceStatuses.off.color }">
                                <span>{{ attendanceStatuses.off.label }}({{ salarySummary.offCount }} ရက်):</span>
                                <span>-0 ကျပ်</span>
                            </div>
                            <div class="flex justify-between text-blue-600">
                                <span>နားရက်အလုပ်ဆင်း ({{ salarySummary.offWorkCount }} ရက်):</span>
                                <span>+{{ salarySummary.totalOffWorkEarn.toLocaleString() }} ကျပ်</span>
                            </div>
                            <div class="flex justify-between" :style="{ color: attendanceStatuses.approved_leave.color }">
                                <span>{{ attendanceStatuses.approved_leave.label }} ({{ salarySummary.approvedLeaveCount }} ရက်):</span>
                                <span>-{{ salarySummary.totalApprovedDeduct.toLocaleString() }} ကျပ်</span>
                            </div>
                            <div class="flex justify-between" :style="{ color: attendanceStatuses.unapproved_leave.color }">
                                <span>{{ attendanceStatuses.unapproved_leave.label }} ({{ salarySummary.unapprovedLeaveCount }} ရက်):</span>
                                <span>-{{ salarySummary.totalUnapprovedDeduct.toLocaleString() }} ကျပ်</span>
                            </div>
                            <div class="flex justify-between" :style="{ color: attendanceStatuses.late.color }">
                                <span>{{ attendanceStatuses.late.label }} ({{ salarySummary.lateCount }} ရက်):</span>
                                <span>-{{ salarySummary.totalLateDeduct.toLocaleString() }} ကျပ်</span>
                            </div>
                            <div class="flex justify-between text-orange-600">
                                <span>ရက်မှန်ကြေး :</span>
                                <span>-{{ salarySummary.totalAttendanceFullEarn.toLocaleString() }} ကျပ်</span>
                            </div>
                        </div>
                    </div>

                    <div class="border-t pt-4 mt-4">
                        <div class="flex justify-between items-center p-3 bg-blue-50 rounded-lg">
                            <span class="text-blue-900 font-bold">အသားတင်လစာ:</span>
                            <span class="text-xl font-black text-blue-700">{{ Math.round(salarySummary.netSalary).toLocaleString() }} ကျပ်</span>
                        </div>
                    </div>

                    <div>
                        <button @click="save()" class="btn submit-btn">Save to Database</button>
                    </div>
                </div>

                <div class="border p-4 rounded-lg bg-white shadow">
                    <h2 class="text-lg font-semibold mb-3">ပြက္ခဒိန်တွင် ရက်ရွေးပြီး စာရင်းသွင်းပါ</h2>

                    <VDatePicker v-model="selectedDate" :attributes="calendarAttributes" expanded borderless />

                    <div class="mt-4 p-3 bg-gray-50 rounded">

                        <p class="text-sm font-medium text-gray-700 mb-2">
                            ရွေးချယ်ထားသောရက်စွဲ: <span class="text-blue-600 font-bold">{{ getFormattedDate(selectedDate) }}</span>
                        </p>

                        <div class="flex flex-wrap gap-2">

                            <button @click="setStatusForSelectedDate(key)" v-for="(status, key) in attendanceStatuses" :key="key" :style="{ background: status.color }" class="px-3 py-1 text-sm font-medium rounded">{{ status.label }} ( * {{ status.rate }})</button>

                            <button @click="setStatusForSelectedDate('normal')" class="px-3 py-1.5 bg-blue-200 text-sm font-medium rounded hover:bg-blue-300">Clear</button>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </AppLayout>
</template>