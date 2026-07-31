<script setup lang="ts">
import { Head, Link } from "@inertiajs/vue3";

interface PaginatedPosts {
    data: { id: number; published_at: string; title: string; excerpt: string; slug: string }[];
    links: { url: string | null; label: string; active: boolean }[];
    meta: { current_page: number; last_page: number; total: number; per_page: number };
    total: number;
}

interface Props {
    posts: PaginatedPosts;
}
const props = defineProps<Props>();
</script>

<template>
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
            v-for="post in props.posts.data"
            :key="post.id"
            class="mb-5 max-w-md overflow-hidden rounded-xl bg-white shadow-md md:max-w-4xl"
        >
            <article class="md:flex">
                <section class="md:shrink-0">
                    <img
                        class="h-48 w-full object-cover md:h-full md:w-48"
                        src="https://loremflickr.com/320/240/kitten"
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
        <div class="mt-8 flex justify-center gap-4">
            <Link
                v-if="props.posts.prev_page_url"
                :href="props.posts.prev_page_url"
                class="rounded bg-white px-4 py-2 shadow hover:bg-gray-50"
            >
                Previous
            </Link>
            <Link
                v-if="props.posts.next_page_url"
                :href="props.posts.next_page_url"
                class="rounded bg-white px-4 py-2 shadow hover:bg-gray-50"
            >
                Next
            </Link>
        </div>
    </ul>
</template>
