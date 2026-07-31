<script setup lang="ts">
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import { create, destroy, edit } from '@/routes/posts';

interface PaginatedPosts {
    data: { id: number; published_at: string; title: string; excerpt: string; slug: string }[];
    links: { url: string | null; label: string; active: boolean }[];
    meta: { current_page: number; last_page: number; total: number; per_page: number };
    total: number;
    prev_page_url: string | null;
    next_page_url: string | null;
}

interface Props {
    posts: PaginatedPosts;
}
defineProps<Props>();

const can = usePage().props.can ?? {};

const deletePost = (post: { id: number; title: string; slug: string }) => {
    if (confirm(`Delete "${post.title}"?`)) {
        router.delete(destroy(post.slug).url);
    }
};

const formatDate = (date: string | null) =>
    date
        ? new Date(date).toLocaleDateString('en-GB', {
              year: 'numeric',
              month: 'short',
              day: 'numeric',
          })
        : '';
</script>

<template>
    <Head title="Blog" />
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-3xl font-bold text-surface-900 dark:text-surface-100">All Posts</h1>
        <Link
            v-if="can.createPosts"
            :href="create().url"
            class="cursor-pointer rounded-md bg-accent-600 px-4 py-2 font-semibold text-surface-50 shadow-sm transition duration-200 hover:bg-accent-500 dark:bg-accent-500 dark:text-surface-950 dark:hover:bg-accent-400"
        >
            Create New Post
        </Link>
    </div>
    <ul>
        <li
            v-for="post in posts.data"
            :key="post.id"
            class="mb-5 max-w-md overflow-hidden rounded-xl bg-surface-200 shadow-md md:max-w-4xl dark:bg-surface-800"
        >
            <article class="md:flex">
                <section class="md:shrink-0">
                    <img
                        class="h-48 w-full object-cover md:h-full md:w-48"
                        src="https://loremflickr.com/320/240/kitten"
                    />
                </section>
                <section class="p-8">
                    <time class="text-sm font-semibold tracking-wide text-accent-600 uppercase dark:text-accent-400">
                        {{ formatDate(post.published_at) }}
                    </time>
                    <a
                        :href="`/blog/${post.slug}`"
                        class="mt-1 block text-lg leading-tight font-medium text-surface-900 hover:underline dark:text-surface-100"
                    >
                        {{ post.title }}
                    </a>
                    <p class="mt-2 text-surface-600 dark:text-surface-400">
                        {{ post.excerpt }}
                    </p>
                    <div v-if="can.editPosts || can.deletePosts" class="mt-3 flex gap-2">
                        <Link
                            v-if="can.editPosts"
                            :href="edit(post.slug).url"
                            class="cursor-pointer rounded bg-surface-300 px-2 py-1 text-sm text-surface-900 hover:bg-accent-500 hover:text-surface-50 dark:bg-surface-700 dark:text-surface-100 dark:hover:bg-accent-600"
                        >
                            Edit
                        </Link>
                        <button
                            v-if="can.deletePosts"
                            @click="deletePost(post)"
                            type="button"
                            class="cursor-pointer rounded bg-red-100 px-2 py-1 text-sm text-red-600 hover:bg-red-200 dark:bg-red-900 dark:text-red-300 dark:hover:bg-red-800"
                        >
                            Delete
                        </button>
                    </div>
                </section>
            </article>
        </li>
        <div class="mt-8 flex justify-center gap-4">
            <Link
                v-if="posts.prev_page_url"
                :href="posts.prev_page_url"
                class="rounded bg-surface-200 px-4 py-2 text-surface-900 shadow hover:bg-surface-300 dark:bg-surface-800 dark:text-surface-100 dark:hover:bg-surface-700"
            >
                Previous
            </Link>
            <Link
                v-if="posts.next_page_url"
                :href="posts.next_page_url"
                class="rounded bg-surface-200 px-4 py-2 text-surface-900 shadow hover:bg-surface-300 dark:bg-surface-800 dark:text-surface-100 dark:hover:bg-surface-700"
            >
                Next
            </Link>
        </div>
    </ul>
</template>
