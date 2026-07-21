<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';

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
    <div>
        <h1>Register</h1>
        <form method="POST" @submit.prevent="submit">
            <input type="text" v-model="form.name" placeholder="Name" />
            <input type="email" v-model="form.email" placeholder="Email" />
            <p v-if="form.errors.email" class="text-red-500 text-sm">{{ form.errors.email }}</p>
            <input type="password" v-model="form.password" placeholder="Password" />
            <p v-if="form.errors.password" class="text-red-500 text-sm">{{ form.errors.password }}</p>
            <input type="password" v-model="form.password_confirmation" placeholder="Confirm Password" />
            <p v-if="form.errors.password_confirmation" class="text-red-500 text-sm">{{ form.errors.password_confirmation }}</p>
            <button type="submit" :disabled="form.processing">
                {{ form.processing ? 'Registering...' : 'Register' }}
            </button>
        </form>
    </div>
</template>
