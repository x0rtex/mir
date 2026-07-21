<script setup lang="ts">
import AppLayout from '../Layouts/AppLayout.vue';
import { Head, useForm, usePage, Link } from '@inertiajs/vue3';

interface Props {
    post: { id: number; title: string; user: { name: string } | null; published_at: string; body: string; excerpt: string; comments: { id: number; body: string; created_at: string; user_id: number; user: { id: number; name: string } | null; }[]; };
}
const props = defineProps<Props>();

const form = useForm({
    body: '',
    post_id: props.post.id,
});

const user = usePage().props.auth?.user ?? null;

const submit = () => {
    form.post('/comments', {
        preserveScroll: true,
        onSuccess: () => form.reset(),
    });
};
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
                <img
                    src="https://images.unsplash.com/photo-1493723843671-1d655e66ac1c"
                    alt="Featured image"
                    class="mb-8 h-auto w-full"
                />
                <div class="prose prose-sm sm:prose lg:prose-lg xl:prose-xl mx-auto">
                    <p>
                        {{ props.post.body }}
                    </p>
                </div>
            </div>
        </div>

        <div class="mx-auto max-w-3xl my-8">
            <h3 class="font-bold">Comments ({{ props.post.comments.length }})</h3>
            <form @submit.prevent="submit">
                <article v-for="comment in props.post.comments" :key="comment.id" class="flex flex-col">
                    <div class="border border-gray-200 rounded-md p-2 my-1.5">
                        <div class="flex gap-2 items-center">
                            <img v-if="comment.user?.avatar" :src="comment.user.avatar" class="object-cover w-8 h-8 rounded-full border-2 border-emerald-400  shadow-emerald-400">
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
                        <textarea v-model="form.body" class="bg-gray-100 rounded border border-gray-300 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-400 focus:outline-none focus:bg-gray-50" name="body" placeholder='Write a comment...' required></textarea>
                    </div>
                    <div class="w-full flex justify-end">
                        <input type='submit' class="px-2.5 py-1.5 rounded-md text-white text-sm bg-indigo-500" value='Post Comment'>
                    </div>
                </section>
            </form>

        </div>
    </AppLayout>
</template>
