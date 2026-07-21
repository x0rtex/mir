<script setup lang="ts">
import AppLayout from '../Layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

interface Props { posts: { id: number; published_at: string; title: string; excerpt: string; slug: string; }[] }
const props = defineProps<Props>();
</script>

<template>
    <AppLayout>
        <Head title="Posts" />
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Posts</h1>
            <Link href="/posts/create" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md transition duration-200 shadow-sm">
                Create New Post
            </Link>
        </div>
        <ul><li v-for="post in props.posts" :key="post.id" class="max-w-md bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl mb-5">
            <article class="md:flex">
                <section class="md:shrink-0">
                    <img class="h-48 w-full object-cover md:h-full md:w-48" src="https://loremflickr.com/g/320/240/team">
                </section>
                <section class="p-8">
                    <time class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">
                        {{ post.published_at }}
                    </time>
                    <a :href="`/blog/${post.slug}`" class="block mt-1 text-lg leading-tight font-medium text-black hover:underline">
                        {{ post.title }}
                    </a>
                    <p class="mt-2 text-slate-500">
                        {{ post.excerpt }}
                    </p>
                </section>
            </article>
        </li></ul>
    </AppLayout>
</template>
