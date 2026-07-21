<script setup lang="ts">
import AppLayout from '../Layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';

interface Props { post: { id: number; title: string; user: { name: string } | null; published_at: string; body: string; excerpt: string } }
const props = defineProps<Props>();
</script>

<template>
    <AppLayout>
        <Head title="Post"/>
        <h1>{{ props.post.title }}</h1>
        <p>Published by {{ props.post.user?.name ?? 'Unknown' }} on {{ props.post.published_at }}</p>
        <p>{{ props.post.body }}</p>
        <p>{{ props.post.excerpt }}</p>
    </AppLayout>
</template>
