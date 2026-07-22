<script setup lang="ts">
import AppLayout from '../Layouts/AppLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { login } from '@/routes';


const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post("register")
};
</script>

<template>
    <AppLayout>
        <Head title="Register"/>
        <div class="max-w-md mx-auto">
            <h1 class="text-2xl font-bold mb-4">Register</h1>
            <form method="POST" @submit.prevent="submit">
                <input type="text" v-model="form.name" placeholder="Name" autoComplete="username" class="w-full mb-2 p-2 border rounded shadow-sm" />
                <p v-if="form.errors.name" class="text-red-500 text-sm">{{ form.errors.name }}</p>
                <input type="email" v-model="form.email" placeholder="Email" autoComplete="email" class="w-full mb-2 p-2 border rounded shadow-sm" />
                <p v-if="form.errors.email" class="text-red-500 text-sm">{{ form.errors.email }}</p>
                <input type="password" v-model="form.password" placeholder="Password" autoComplete="new-password" class="w-full mb-2 p-2 border rounded shadow-sm" />
                <p v-if="form.errors.password" class="text-red-500 text-sm">{{ form.errors.password }}</p>
                <input type="password" v-model="form.password_confirmation" placeholder="Confirm Password" autoComplete="new-password" class="w-full mb-2 p-2 border rounded shadow-sm" />
                <p v-if="form.errors.password_confirmation" class="text-red-500 text-sm">{{ form.errors.password_confirmation }}</p>
                <button type="submit" :disabled="form.processing" class="w-full p-2 border rounded shadow-sm">
                    {{ form.processing ? 'Registering...' : 'Register' }}
                </button>
            </form>
            <p class="p-2 text-sm">Already have an account? <Link :href="login()" view-transition>Login here</Link></p>
        </div>
    </AppLayout>
</template>
