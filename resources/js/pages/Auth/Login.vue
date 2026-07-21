<script setup lang="ts">
import AppLayout from '../Layouts/AppLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { register } from '@/routes';

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post("/login", { data: { redirect: window.location.pathname } })
};
</script>

<template>
    <AppLayout>
        <Head title="Login"/>
        <div class="max-w-md mx-auto">
            <h1 class="text-2xl font-bold mb-4">Login</h1>
            <form @submit.prevent="submit">
                <input type="email" v-model="form.email" placeholder="Email" autoComplete="email" class="w-full mb-2 p-2 border rounded shadow-sm" />
                <p v-if="form.errors.email" class="text-red-500 text-sm">{{ form.errors.email }}</p>
                <input type="password" v-model="form.password" placeholder="Password" autoComplete="current-password" class="w-full mb-2 p-2 border rounded shadow-sm" />
                <p v-if="form.errors.password" class="text-red-500 text-sm">{{ form.errors.password }}</p>
                <input type="checkbox" v-model="form.remember" class="mb-2" /> Remember Me
                <button type="submit" :disabled="form.processing" class="w-full p-2 border rounded shadow-sm">
                    {{ form.processing ? 'Logging in...' : 'Login' }}
                </button>
            </form>
            <p class="p-2 text-sm">Don't have an account? <Link :href="register()">Register here</Link></p>
        </div>
    </AppLayout>
</template>
