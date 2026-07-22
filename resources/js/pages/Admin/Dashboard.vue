<script setup lang="ts">
import { Head, usePage } from '@inertiajs/vue3';
import AppLayout from '../Layouts/AppLayout.vue';

interface Props {
    stats: { posts: number; comments: number; users: number };
}

const page = usePage();
const user = page.props.auth?.user ?? null;
const props = defineProps<Props>();
</script>

<template>
    <AppLayout>
        <Head title="Admin Dashboard"/>
        <div class="space-y-6">
            <header>
                <h1 class="text-3xl font-bold text-gray-800">Welcome Back, {{ user.name }}.</h1>
                <p class="text-gray-600 mt-1">Here's what's going on.</p>
            </header>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="bg-white p-4 rounded-lg shadow-md">
                    <h2 class="text-lg font-semibold text-gray-700">Total Users</h2>
                    <p class="text-2xl font-bold text-green-600">{{ props.stats.users }}</p>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-md">
                    <h2 class="text-lg font-semibold text-gray-700">Total Posts</h2>
                    <p class="text-2xl font-bold text-yellow-600">{{ props.stats.posts }}</p>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-md">
                    <h2 class="text-lg font-semibold text-gray-700">Total Comments</h2>
                    <p class="text-2xl font-bold text-blue-600">{{ props.stats.comments }}</p>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
