<script setup lang="ts">
import { usePage } from "@inertiajs/vue3";

interface Props {
    stats: { posts: number; comments: number; users: number };
}

const page = usePage();
const user = page.props.auth?.user ?? null;
const props = defineProps<Props>();
</script>

<template>
    <Head title="Admin Dashboard" />
    <div class="space-y-6">
        <header>
            <h1 class="text-3xl font-bold text-gray-800">Welcome Back, {{ user.name }}.</h1>
            <p class="mt-1 text-gray-600">Here's what's going on.</p>
        </header>
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
            <div class="rounded-lg bg-white p-4 shadow-md">
                <h2 class="text-lg font-semibold text-gray-700">Total Users</h2>
                <p class="text-2xl font-bold text-green-600">{{ props.stats.users }}</p>
            </div>
            <div class="rounded-lg bg-white p-4 shadow-md">
                <h2 class="text-lg font-semibold text-gray-700">Total Posts</h2>
                <p class="text-2xl font-bold text-yellow-600">{{ props.stats.posts }}</p>
            </div>
            <div class="rounded-lg bg-white p-4 shadow-md">
                <h2 class="text-lg font-semibold text-gray-700">Total Comments</h2>
                <p class="text-2xl font-bold text-blue-600">{{ props.stats.comments }}</p>
            </div>
        </div>
    </div>
</template>
