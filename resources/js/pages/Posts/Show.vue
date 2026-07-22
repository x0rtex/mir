<script setup lang="ts">
import { Head, usePage, Form } from '@inertiajs/vue3';

interface Props {
    post: {
        id: number;
        title: string;
        user: {
            id: number;
            name: string;
        } | null;
        published_at: string;
        body_html: string;
        excerpt: string;
        comments: {
            id: number;
            body: string;
            created_at: string;
            user_id: number;
            user: {
                id: number;
                name: string;
            } | null;
        }[];
    };
}
const props = defineProps<Props>();
const user = usePage().props.auth?.user ?? null;
</script>

<template>
    <Head :title="props.post.title" />
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-3xl">
            <div class="py-8">
                <h1 class="mb-2 text-3xl font-bold">
                    {{ props.post.title }}
                </h1>
                <p class="text-sm text-gray-500">
                    Published on
                    <time datetime="">
                        {{ props.post.published_at }}
                    </time>
                </p>
            </div>
            <img
                src="https://loremflickr.com/g/1280/720/team"
                alt="Featured image"
                class="mb-8 h-auto w-full"
            />
            <div class="mx-auto prose max-w-none" v-html="props.post.body_html"></div>
        </div>
    </div>

    <div class="mx-auto my-8 max-w-3xl">
        <h3 class="font-bold">Comments ({{ props.post.comments.length }})</h3>
        <Form action="/comments" method="post" preserve-scroll resetOnSuccess #default="{ processing }">
            <article
                v-for="comment in props.post.comments"
                :key="comment.id"
                class="flex flex-col"
            >
                <div class="my-1.5 rounded-md border border-gray-200 p-2">
                    <div class="flex items-center gap-2">
                        <img
                            class="h-8 w-8 rounded-full border-2 border-emerald-400 object-cover shadow-emerald-400"
                        />
                        <h3 class="font-bold">
                            {{ comment.user?.name }}
                        </h3>
                    </div>
                    <p class="mt-2 text-gray-600">
                        {{ comment.body }}
                    </p>
                </div>
            </article>

            <section v-if="user">
                <div class="my-2 w-full">
                    <input type="hidden" name="post_id" :value="props.post.id" />
                    <textarea
                        name="body"
                        placeholder="Write a comment..."
                        required
                        class="h-20 w-full resize-none rounded border border-gray-300 bg-gray-100 px-3 py-2 leading-normal font-medium placeholder-gray-400 focus:bg-gray-50 focus:outline-none"
                    ></textarea>
                </div>
                <div class="flex w-full justify-end">
                    <button
                        type="submit"
                        :disabled="processing"
                        class="rounded-md bg-indigo-500 px-2.5 py-1.5 text-sm text-white"
                    >
                        {{ processing ? 'Posting...' : 'Post Comment' }}
                    </button>
                </div>
            </section>
        </Form>
    </div>
</template>
