<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post("/login")
};
</script>

<template>
    <div>
        <h1>Login</h1>
        <form @submit.prevent="submit">
            <input type="email" v-model="form.email" placeholder="Email" />
            <p v-if="form.errors.email" class="text-red-500 text-sm">{{ form.errors.email }}</p>
            <input type="password" v-model="form.password" placeholder="Password" />
            <p v-if="form.errors.password" class="text-red-500 text-sm">{{ form.errors.password }}</p>
            <input type="checkbox" v-model="form.remember" /> Remember Me
            <button type="submit" :disabled="form.processing">
                {{ form.processing ? 'Logging in...' : 'Login' }}
            </button>
        </form>
    </div>
</template>
