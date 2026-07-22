<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '../Layouts/AppLayout.vue';

interface Props {
    posts: { id: number; published_at: string; title: string; excerpt: string; slug: string }[];
}
const props = defineProps<Props>();
</script>

<template>
    <AppLayout>
        <Head title="Blog" />
        <div class="mb-6 flex items-center justify-between">
            <h1 class="text-3xl font-bold text-gray-900">All Posts</h1>
            <Link
                href="/posts/create"
                class="rounded-md bg-blue-600 px-4 py-2 font-semibold text-white shadow-sm transition duration-200 hover:bg-blue-700"
            >
                Create New Post
            </Link>
        </div>
        <ul>
            <li
                v-for="post in props.posts"
                :key="post.id"
                class="mb-5 max-w-md overflow-hidden rounded-xl bg-white shadow-md md:max-w-4xl"
            >
                <article class="md:flex">
                    <section class="md:shrink-0">
                        <img
                            class="h-48 w-full object-cover md:h-full md:w-48"
                            src="https://loremflickr.com/g/320/240/team"
                        />
                    </section>
                    <section class="p-8">
                        <time class="text-sm font-semibold tracking-wide text-indigo-500 uppercase">
                            {{ post.published_at }}
                        </time>
                        <a
                            :href="`/blog/${post.slug}`"
                            class="mt-1 block text-lg leading-tight font-medium text-black hover:underline"
                        >
                            {{ post.title }}
                        </a>
                        <p class="mt-2 text-slate-500">
                            {{ post.excerpt }}
                        </p>
                    </section>
                </article>
            </li>
        </ul>
    </AppLayout>
</template>
