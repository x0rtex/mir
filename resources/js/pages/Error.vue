<script setup lang="ts">
import { computed, defineOptions } from "vue";

defineOptions({ layout: null });

const props = defineProps<{ status: number }>();

const title = computed(
    () =>
        ({
            503: "503: Service Unavailable",
            500: "500: Server Error",
            404: "404: Page Not Found",
            403: "403: Forbidden",
        })[props.status] ?? "Error",
);

const description = computed(
    () =>
        ({
            503: "Sorry, we are doing some maintenance. Please check back soon.",
            500: "Whoops, something went wrong on our servers.",
            404: "Sorry, the page you are looking for could not be found.",
            403: "Sorry, you are forbidden from accessing this page.",
        })[props.status] ?? "An unexpected error occurred.",
);
</script>

<template>
    <div class="flex flex-col items-center justify-center min-h-[50vh]">
        <h1 class="text-6xl font-bold text-gray-300">{{ status }}</h1>
        <h2 class="text-2xl font-bold mt-4">{{ title }}</h2>
        <p class="text-gray-500 mt-2">{{ description }}</p>
        <a href="/" class="mt-6 text-indigo-600 underline">Go home</a>
    </div>
</template>
