<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';
import { login } from '@/routes';
import AppLayout from '../Layouts/AppLayout.vue';

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
    <AppLayout>
        <Head title="Register" />
        <div class="mx-auto max-w-md">
            <h1 class="mb-4 text-2xl font-bold">Register</h1>
            <form method="POST" @submit.prevent="submit">
                <input
                    type="text"
                    v-model="form.name"
                    placeholder="Name"
                    autoComplete="username"
                    class="mb-2 w-full rounded border p-2 shadow-sm"
                />
                <p v-if="form.errors.name" class="text-sm text-red-500">{{ form.errors.name }}</p>
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
                    autoComplete="new-password"
                    class="mb-2 w-full rounded border p-2 shadow-sm"
                />
                <p v-if="form.errors.password" class="text-sm text-red-500">
                    {{ form.errors.password }}
                </p>
                <input
                    type="password"
                    v-model="form.password_confirmation"
                    placeholder="Confirm Password"
                    autoComplete="new-password"
                    class="mb-2 w-full rounded border p-2 shadow-sm"
                />
                <p v-if="form.errors.password_confirmation" class="text-sm text-red-500">
                    {{ form.errors.password_confirmation }}
                </p>
                <button
                    type="submit"
                    :disabled="form.processing"
                    class="w-full rounded border p-2 shadow-sm"
                >
                    {{ form.processing ? 'Registering...' : 'Register' }}
                </button>
            </form>
            <p class="p-2 text-sm">
                Already have an account? <Link :href="login()" view-transition>Login here</Link>
            </p>
        </div>
    </AppLayout>
</template>
