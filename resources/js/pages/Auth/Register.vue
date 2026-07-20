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
            <input type="password" v-model="form.password" placeholder="Password" />
            <input type="password" v-model="form.password_confirmation" placeholder="Confirm Password" />
            <button type="submit" :disabled="form.processing">
                {{ form.processing ? 'Registering...' : 'Register' }}
            </button>
        </form>
    </div>
</template>
