<script setup lang="ts">
import { computed } from 'vue';

const props = defineProps<{ status: number }>();

const title = computed(
    () =>
        ({
            503: '503: Service Unavailable',
            500: '500: Server Error',
            404: '404: Page Not Found',
            403: '403: Forbidden',
        })[props.status] ?? 'Error',
);

const description = computed(
    () =>
        ({
            503: 'Sorry, we are doing some maintenance. Please check back soon.',
            500: 'Whoops, something went wrong on our servers.',
            404: 'Sorry, the page you are looking for could not be found.',
            403: 'Sorry, you are forbidden from accessing this page.',
        })[props.status] ?? 'An unexpected error occurred.',
);
</script>

<template>
    <div class="flex flex-col items-center justify-center min-h-[50vh]">
        <h1 class="text-6xl font-bold text-surface-300 dark:text-surface-600">{{ status }}</h1>
        <h2 class="text-2xl font-bold mt-4 text-surface-900 dark:text-surface-100">{{ title }}</h2>
        <p class="text-surface-600 mt-2 dark:text-surface-400">{{ description }}</p>
        <a href="/" class="mt-6 text-accent-600 underline dark:text-accent-400">Go home</a>
    </div>
</template>
