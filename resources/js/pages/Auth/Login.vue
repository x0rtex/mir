<script setup lang="ts">
import { Link, useForm } from '@inertiajs/vue3';
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
        <h1 class="mb-4 text-2xl font-bold">Login</h1>
        <form @submit.prevent="submit">
            <input
                type="email"
                v-model="form.email"
                placeholder="Email"
                autoComplete="email"
                class="mb-2 w-full rounded border p-2 shadow-sm"
            />
            <p v-if="form.errors.email" class="text-sm text-red-500">{{ form.errors.email }}</p>
            <input
                type="password"
                v-model="form.password"
                placeholder="Password"
                autoComplete="current-password"
                class="mb-2 w-full rounded border p-2 shadow-sm"
            />
            <p v-if="form.errors.password" class="text-sm text-red-500">
                {{ form.errors.password }}
            </p>
            <input type="checkbox" v-model="form.remember" class="mb-2" /> Remember Me
            <button type="submit" :disabled="form.processing" class="w-full rounded border p-2 shadow-sm">
                {{ form.processing ? "Logging in..." : "Login" }}
            </button>
        </form>
        <p class="p-2 text-sm">Don't have an account? <Link :href="register()" view-transition>Register here</Link></p>
    </div>
</template>
