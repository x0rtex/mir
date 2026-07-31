<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import PostForm from '@/components/PostForm.vue';

interface Props {
    post: {
        id: number;
        title: string;
        slug: string;
        body: string;
        excerpt: string | null;
        published_at: string | null;
    };
}

defineProps<Props>();
</script>

<template>
    <Head :title="`Edit ${post.title}`" />
    <h1 class="mb-6 text-3xl font-bold">Edit Post</h1>
    <PostForm :post="post" />
</template>
