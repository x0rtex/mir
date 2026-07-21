<script setup lang="ts">
import AppLayout from '../Layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';

interface Props { post: { id: number; title: string; user: { name: string } | null; published_at: string; body: string; excerpt: string } }
const props = defineProps<Props>();
</script>

<template>
    <AppLayout>
        <Head title="Post"/>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto">
                <div class="py-8">
                    <h1 class="text-3xl font-bold mb-2">
                        {{ props.post.title }}
                    </h1>
                    <p class="text-gray-500 text-sm">Published on <time datetime="">
                        {{ props.post.published_at }}
                    </time></p>
                </div>
                <img src="https://images.unsplash.com/photo-1493723843671-1d655e66ac1c" alt="Featured image" class="w-full h-auto mb-8">
                <div class="prose prose-sm sm:prose lg:prose-lg xl:prose-xl mx-auto">
                    <p>
                        {{ props.post.body }}
                    </p>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
