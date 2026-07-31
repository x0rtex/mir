<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';
import { login } from '@/routes';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post('register');
};
</script>

<template>
    <Head title="Register" />
    <div class="mx-auto max-w-md">
        <h1 class="mb-4 text-2xl font-bold text-surface-900 dark:text-surface-100">Register</h1>
        <form method="POST" @submit.prevent="submit">
            <input
                type="text"
                v-model="form.name"
                placeholder="Name"
                autoComplete="username"
                class="mb-2 w-full rounded border border-surface-300 bg-surface-200 p-2 text-surface-900 shadow-sm dark:border-surface-700 dark:bg-surface-800 dark:text-surface-100"
            />
            <p v-if="form.errors.name" class="text-sm text-red-500">{{ form.errors.name }}</p>
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
                autoComplete="new-password"
                class="mb-2 w-full rounded border border-surface-300 bg-surface-200 p-2 text-surface-900 shadow-sm dark:border-surface-700 dark:bg-surface-800 dark:text-surface-100"
            />
            <p v-if="form.errors.password" class="text-sm text-red-500">
                {{ form.errors.password }}
            </p>
            <input
                type="password"
                v-model="form.password_confirmation"
                placeholder="Confirm Password"
                autoComplete="new-password"
                class="mb-2 w-full rounded border border-surface-300 bg-surface-200 p-2 text-surface-900 shadow-sm dark:border-surface-700 dark:bg-surface-800 dark:text-surface-100"
            />
            <p v-if="form.errors.password_confirmation" class="text-sm text-red-500">
                {{ form.errors.password_confirmation }}
            </p>
            <button
                type="submit"
                :disabled="form.processing"
                class="w-full cursor-pointer rounded border border-transparent bg-accent-600 p-2 font-semibold text-surface-50 shadow-sm hover:bg-accent-500 dark:bg-accent-500 dark:text-surface-950 dark:hover:bg-accent-400"
            >
                {{ form.processing ? 'Registering...' : 'Register' }}
            </button>
        </form>
        <p class="p-2 text-sm text-surface-600 dark:text-surface-400">
            Already have an account?
            <Link :href="login()" view-transition class="text-accent-600 underline dark:text-accent-400"
                >Login here</Link
            >
        </p>
    </div>
</template>
