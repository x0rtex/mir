<script setup lang="ts">
import { Head, usePage } from '@inertiajs/vue3';

interface Props {
    stats: { posts: number; users: number };
}

const page = usePage();
const user = page.props.auth?.user ?? null;
const props = defineProps<Props>();
</script>

<template>
    <Head title="Admin Dashboard" />
    <div class="space-y-6">
        <header>
            <h1 class="text-3xl font-bold text-surface-900 dark:text-surface-100">Welcome Back, {{ user.name }}.</h1>
            <p class="mt-1 text-surface-600 dark:text-surface-400">Here's what's going on.</p>
        </header>
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
            <div class="rounded-lg bg-surface-200 p-4 shadow-md dark:bg-surface-800">
                <h2 class="text-lg font-semibold text-surface-800 dark:text-surface-200">Total Users</h2>
                <p class="text-2xl font-bold text-accent-700 dark:text-accent-400">{{ props.stats.users }}</p>
            </div>
            <div class="rounded-lg bg-surface-200 p-4 shadow-md dark:bg-surface-800">
                <h2 class="text-lg font-semibold text-surface-800 dark:text-surface-200">Total Posts</h2>
                <p class="text-2xl font-bold text-accent-700 dark:text-accent-400">{{ props.stats.posts }}</p>
            </div>
        </div>
    </div>
</template>
