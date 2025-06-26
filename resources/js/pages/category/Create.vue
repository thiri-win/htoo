<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    category: Object
})

const form = useForm({
    'title': props.category.title || '',
    'status': props.category.status || '',
    'remark': props.category.remark || '',
});

const submit = () => {
    if(props.category.id) {
        form.put(route('categories.update', props.category.id));
    } else {
        form.post(route('categories.store'));
    }
}

</script>
<template>
    <AppLayout>
        <h1>{{ category.id ? 'အမျိုးအစားကို ပြုပြင်ရန်' : 'အမျိုးအစား အသစ်ထည့်မယ်'}}</h1>
        <form action="" method="post" v-on:submit.prevent="submit">
            <input type="text" name="title" id="title" placeholder="အကြောင်းအရာ" class="my-3" v-model="form.title" autofocus>
            <p class="text-sm text-red-500" v-text="form.errors.title"></p>
            <label for="sum" class="mr-2"><input type="radio" name="status" value="sum" id="sum" class="me-2" v-model="form.status">ပေါင်းရန်</label>
            <label for="sub"><input type="radio" name="status" value="sub" id="sub" class="me-2" v-model="form.status">နှုတ်ရန်</label>
            <p class="text-sm text-red-500" v-text="form.errors.status"></p>
            <input type="text" name="remark" id="remark" placeholder="မှတ်ချက်" class="my-3" v-model="form.remark">
            <p class="text-sm text-red-500" v-text="form.errors.remark"></p>
            <button type="submit" class="submit-btn">Submit</button>
        </form>
    </AppLayout>
</template>