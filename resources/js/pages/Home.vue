<script setup lang="ts">
import { Head, usePage, router } from '@inertiajs/vue3';
import AppLayout from './Layouts/AppLayout.vue';

const page = usePage();
const auth = page.props.auth;
const user = auth ? auth.user : null;
console.log(auth);
</script>

<template>
    <AppLayout>
        <Head title="Home"/>
        <h1 class="text-3xl font-bold text-gray-900">Welcome aboard!</h1>
    </AppLayout>
</template>
