<script setup lang="ts">
import { Head, usePage, Form } from '@inertiajs/vue3';
import AppLayout from '../Layouts/AppLayout.vue';

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
    <AppLayout>
        <Head title="Post" />
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
                <img src="https://loremflickr.com/g/1280/720/team" alt="Featured image" class="mb-8 h-auto w-full"/>
                <div class="prose max-w-none mx-auto" v-html="props.post.body_html"></div>
            </div>
        </div>

        <div class="mx-auto max-w-3xl my-8">
            <h3 class="font-bold">Comments ({{ props.post.comments.length }})</h3>
            <Form action="/comments" method="post" preserve-scroll #default="{ processing }">
                <article v-for="comment in props.post.comments" :key="comment.id" class="flex flex-col">
                    <div class="border border-gray-200 rounded-md p-2 my-1.5">
                        <div class="flex gap-2 items-center">
                            <img class="object-cover w-8 h-8 rounded-full border-2 border-emerald-400  shadow-emerald-400">
                            <h3 class="font-bold">
                                {{ comment.user?.name }}
                            </h3>
                        </div>
                        <p class="text-gray-600 mt-2">
                            {{ comment.body }}
                        </p>
                    </div>
                </article>

                <section v-if="user">
                    <div class="w-full my-2">
                        <input type="hidden" name="post_id" :value="props.post.id" />
                        <textarea name="body" placeholder='Write a comment...' required class="bg-gray-100 rounded border border-gray-300 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-400 focus:outline-none focus:bg-gray-50"></textarea>
                    </div>
                    <div class="w-full flex justify-end">
                        <button type="submit" :disabled="processing"
                            class="px-2.5 py-1.5 rounded-md text-white text-sm bg-indigo-500">
                            {{ processing ? 'Posting...' : 'Post Comment' }}
                        </button>
                    </div>
                </section>
            </Form>
        </div>
    </AppLayout>
</template>
