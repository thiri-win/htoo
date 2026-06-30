<script
    setup
    lang="ts"
>

defineProps<{
    title?: string;
    headers: string[];
    rows: Array<Record<string, string | number>>;
    highlightKey?: string | number;
    firstKeyName?: string;
}>();

</script>

<template>
    <div v-if="title" class="mb-4 text-center">
        <p class="text-xl font-bold text-gray-800 dark:text-white">
            {{ title }}
        </p>
    </div>

    <table class="w-full">
        <thead>
            <tr>
                <th v-for="(header, index) in headers" :key="header" class="px-6 py-3 border text-sm font-semibold text-gray-700 dark:text-gray-200" :class="index === 0 ? 'text-left' : 'text-right'">
                    {{ header }}
                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(row, key) in rows" :key="key" class="bg-gray-100 border border-white dark:bg-transparent" :class="{ 'bg-gray-200 dark:!bg-accent font-bold': highlightKey && (String(key) === String(highlightKey) || (typeof row === 'object' && String((row as any)[firstKeyName ?? '']) === String(highlightKey))) }">
                <td class="px-6 py-4 border text-left">{{ isNaN(Number(key)) ? key : row[firstKeyName] ?? key }}</td>

                <td v-for="(value, propKey) in row" :key="propKey" class="px-6 py-4 border text-sm text-right">
                    {{ typeof value === 'number' ? value.toLocaleString() : value }}
                </td>
            </tr>
        </tbody>
    </table>
</template>