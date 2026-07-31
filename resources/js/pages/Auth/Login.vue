<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';
import { register } from '@/routes';

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post('/login');
};
</script>

<template>
    <Head title="Login" />
    <div class="mx-auto max-w-md">
        <h1 class="mb-4 text-2xl font-bold text-surface-900 dark:text-surface-100">Login</h1>
        <form @submit.prevent="submit">
            <input
                type="email"
                v-model="form.email"
                placeholder="Email"
                autoComplete="email"
                class="mb-2 w-full rounded border border-surface-300 bg-surface-200 p-2 text-surface-900 shadow-sm dark:border-surface-700 dark:bg-surface-800 dark:text-surface-100"
            />
            <p v-if="form.errors.email" class="text-sm text-red-500">{{ form.errors.email }}</p>
            <input
                type="password"
                v-model="form.password"
                placeholder="Password"
                autoComplete="current-password"
                class="mb-2 w-full rounded border border-surface-300 bg-surface-200 p-2 text-surface-900 shadow-sm dark:border-surface-700 dark:bg-surface-800 dark:text-surface-100"
            />
            <p v-if="form.errors.password" class="text-sm text-red-500">
                {{ form.errors.password }}
            </p>
            <input type="checkbox" v-model="form.remember" class="mb-2" /> Remember Me
            <button
                type="submit"
                :disabled="form.processing"
                class="w-full cursor-pointer rounded border border-transparent bg-accent-600 p-2 font-semibold text-surface-50 shadow-sm hover:bg-accent-500 dark:bg-accent-500 dark:text-surface-950 dark:hover:bg-accent-400"
            >
                {{ form.processing ? "Logging in..." : "Login" }}
            </button>
        </form>
        <p class="p-2 text-sm text-surface-600 dark:text-surface-400">
            Don't have an account?
            <Link :href="register()" view-transition class="text-accent-600 underline dark:text-accent-400"
                >Register here</Link
            >
        </p>
    </div>
</template>
