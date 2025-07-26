<script setup>
import { ref, nextTick } from 'vue';

const printSection = ref(null);

defineProps({
    voucher: Object
})

const formatNumber = (value) => {
    if (value === null || value === undefined) return 0;
    return new Intl.NumberFormat().format(value);
}

// ✅ Preview in new tab
const previewPDF = async () => {
    const { default: html2pdf } = await import('html2pdf.js');
    await nextTick();
    const element = printSection.value;
    if (!element) return;

    const options = {
        margin: 0,
        filename: 'invoice.pdf',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' }
    };

    const worker = html2pdf().set(options).from(element);
    const blobUrl = await worker.outputPdf('bloburl');
    window.open(blobUrl);
};

// ✅ Direct download
const downloadPDF = async () => {
    const { default: html2pdf } = await import('html2pdf.js');
    await nextTick();
    const element = printSection.value;
    if (!element) return;

    html2pdf()
        .set({
            margin: 0,
            filename: 'invoice.pdf',
            image: { type: 'pdf', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' }
        })
        .from(element)
        .save();
};
</script>

<template>
    <div>
        <div class="p-5 text-right">
            <button @click="previewPDF" class="print-btn text-black font-bold mr-3">Preview PDF</button>
            <button @click="downloadPDF" class="print-btn text-black font-bold">Download PDF</button>
        </div>
        <div ref="printSection" id="invoice" class="flex flex-col px-5 py-10" style="background-color: green !important; height: 296.8mm; box-sizing: border-box;">
            <div class="flex-grow">
                <header class="text-center mb-5" style="color: white;">
                    <img src="/image/htoo_logo_white.png" alt="" class="mx-auto w-50">
                    <h1 style="font-weight: 500;" class="leading-16">
                        <span class="myanmar text-5xl">ထူး</span><br>
                        <span style="font-family: 'Poppins';">Automobile Service</span>
                    </h1>
                    <p>
                        (၂၉/၁ခ)၊ ရွှေတံခါးလမ်း၊ ရွှေပြည်သာကွေ့အကျော်၊ <br>
                        ဂိတ်ဟောင်းမှတ်တိုင်၊ ရွှေပြည့်သာမြို့နယ်။
                    </p>
                    <p>
                        09443067898, 09795355487
                    </p>
                </header>

                <table class="w-full my-3" style="color: white;">
                    <tr>
                        <td>
                            <label for="#" style="color: #cecece;" class="mr-2 fw-lighter">Customer Name:</label>
                            <span class="pyidaungsu">{{ voucher.customer_name }}</span>
                        </td>
                        <td>
                            <label for="#" style="color: #cecece;" class="mr-2 fw-lighter">Phone:</label>
                            <span>{{ voucher.customer_phone }}</span>
                        </td>
                        <td>
                            <label for="#" style="color: #cecece;" class="mr-2 fw-lighter">Date:</label>
                            <span>{{ voucher.date }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="#" style="color: #cecece;" class="mr-2 fw-lighter">Car Brand:</label>
                            <span>{{ voucher.car_brand }}</span>
                        </td>
                        <td>
                            <label for="#" style="color: #cecece;" class="mr-2 fw-lighter">Car Model:</label>
                            <span>{{ voucher.car_model }}</span>
                        </td>
                        <td>
                            <label for="#" style="color: #cecece;" class="mr-2 fw-lighter">Car No:</label>
                            <span>{{ voucher.car_number }}</span>
                        </td>
                    </tr>
                </table>

                <table class="w-full" style="color: white;">
                    <thead style="border-bottom: 2px solid white;">
                        <tr>
                            <th class="text-left">No</th>
                            <th class="text-left">Description</th>
                            <th class="text-right">Qty</th>
                            <th class="text-right">Unit Price</th>
                            <th class="text-right">Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(sale, index) in voucher.sales" :key="sale.id">
                            <td class="!p-5">{{ index + 1 }}</td>
                            <td class="!p-5">{{ sale.description }}</td>
                            <td class="!p-5 text-right">{{ sale.quantity }}</td>
                            <td class="!p-5 text-right">{{ formatNumber(sale.unit_price) }}</td>
                            <td class="!p-5 text-right">{{ formatNumber(sale.sub_total) }}</td>
                        </tr>
                    </tbody>
                    <tfoot style="border-top: 2px solid white;">
                        <tr>
                            <td colspan="4" class="text-right poppins">Discount</td>
                            <td class="text-right">{{ formatNumber(voucher.discount) }}</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-right poppins">Total</td>
                            <td class="text-right">{{ formatNumber(voucher.total) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <footer class="mt-auto my-2" style="color: white;">
                <div class="mb-2">
                    <p>မှတ်ချက်</p>
                    <p v-if="voucher.note">{{ voucher.note }}</p>
                    <p v-else> - </p>
                </div>
                <table class="w-full">
                    <tbody>
                        <tr>
                            <td class="w-2/3 !p-0">
                                အားပေးမှုအတွက် ကျေးဇူးတင်ပါသည်။
                            </td>
                            <td class="border-b-2 border-white w-1/3 border-dashed"></td>
                        </tr>
                    </tbody>
                </table>
            </footer>
        </div>


    </div>
</template>
