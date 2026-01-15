<script setup lang="ts">

import { QuillEditor } from '@vueup/vue-quill';
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import AppLayout from '@/layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    content: '',
})

const editorOptions = {
    modules: {
        toolbar: [
            ['bold', 'italic', 'underline', 'strike'],        // customized button groups
            [{ 'header': 1 }, { 'header': 2 }],
            [{ 'list': 'ordered' }, { 'list': 'bullet' }],
            [{ 'indent': '-1' }, { 'indent': '+1' }],          // outdent/indent
            [{ 'direction': 'rtl' }],                         // text direction
            [{ 'size': ['small', false, 'large', 'huge'] }],  // font size
            [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults
            [{ 'font': [] }],
            [{ 'align': [] }],
            ['clean']                                         // remove formatting button
        ]
    },
    placeholder: 'Content ကို စတင် ရေးသားပါ...',
    theme: 'bubble' // or 'snow'
};

</script>

<template>
    <AppLayout>
        <div>
            <form :action="route('pdf-note')" method="post" >

                <!-- QuillEditor ထဲက data ကို form submit လုပ်ရာတွင် ပါသွားစေရန် hidden input ကိုသုံးခြင်း -->
                <input type="hidden" name="content" :value="form.content">

                <QuillEditor v-model:content="form.content" :options="editorOptions" contentType="html" class="bg-white dark:bg-gray-800 rounded-lg shadow-sm min-h-50" />

                <button type="submit" class="btn print-btn">
                    Print to PDF
                </button>
            </form>

            <!-- <h3 class="mt-4">Content Output:</h3>
            <div class="border p-4 mt-2 whitespace-pre-wrap">{{ content }}</div> -->
        </div>
    </AppLayout>
</template>

<style scoped>
/* Tailwind CSS utilities များကို Quill Editor ၏ toolbar/container များတွင် သုံးနိုင်သည် */

/* ဥပမာ: Editor Area ရဲ့ အမြင့်ကို သတ်မှတ်ခြင်း */
.ql-container {
    min-height: 500px;
}
</style>