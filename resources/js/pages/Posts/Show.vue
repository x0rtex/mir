<script setup lang="ts">
import { Form, Head, router, usePage } from "@inertiajs/vue3";
import { ref } from "vue";

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
                avatar_url?: string;
            } | null;
        }[];
    };
}
const props = defineProps<Props>();
const user = usePage().props.auth?.user ?? null;

const editingCommentId = ref<number | null>(null);
const editBody = ref("");

const startEdit = (comment: { id: number; body: string }) => {
    editingCommentId.value = comment.id;
    editBody.value = comment.body;
};

const cancelEdit = () => {
    editingCommentId.value = null;
    editBody.value = "";
};

const saveEdit = (commentId: number) => {
    router.put(
        `/comments/${commentId}`,
        { body: editBody.value },
        {
            preserveScroll: true,
            onSuccess: () => {
                editingCommentId.value = null;
                editBody.value = "";
            },
        },
    );
};

const deleteComment = (commentId: number) => {
    if (confirm("Delete this comment?")) {
        router.delete(`/comments/${commentId}`, { preserveScroll: true });
    }
};
</script>

<template>
    <Head :title="props.post.title" />
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-3xl">
            <div class="pt-4 pb-8">
                <h1 class="mb-2 text-3xl font-bold">
                    {{ props.post.title }}
                </h1>
                <p class="text-sm text-gray-500">
                    Published on
                    <time datetime="">
                        {{ props.post.published_at }}
                    </time>
                    by {{ props.post.user?.name ?? 'Unknown Author' }}
                </p>
            </div>
            <img
                src="https://loremflickr.com/1280/720/kitten"
                alt="Featured image"
                class="mb-8 h-auto w-full"
            />
            <div class="mx-auto prose max-w-none" v-html="props.post.body_html"></div>
        </div>
    </div>

    <div class="mx-auto my-8 max-w-3xl">
        <h3 class="font-bold">Comments ({{ props.post.comments.length }})</h3>
        <Form
            action="/comments"
            method="post"
            preserve-scroll
            resetOnSuccess
            #default="{ processing }"
        >
            <article v-for="comment in props.post.comments" :key="comment.id" class="flex flex-col">
                <div class="my-1.5 rounded-md border border-gray-200 p-2">
                    <div class="flex items-center gap-2">
                        <img
                            :src="comment.user?.avatar_url ?? 'https://placehold.co/32x32'"
                            class="h-8 w-8 rounded-full border object-cover"
                        />
                        <h3 class="font-bold">
                            {{ comment.user?.name }}
                        </h3>
                        <div class="ml-auto flex items-center gap-1">
                            <button
                                v-if="user?.id === comment.user_id"
                                @click="
                                    if (editingCommentId === comment.id) {
                                        cancelEdit();
                                    } else {
                                        startEdit(comment);
                                    }
                                "
                                type="button"
                                class="cursor-pointer px-1 text-gray-400 hover:text-gray-600"
                            >
                                ✎
                            </button>
                            <button
                                v-if="user?.id === comment.user_id"
                                @click="deleteComment(comment.id)"
                                type="button"
                                class="cursor-pointer px-1 text-red-400 hover:text-red-600"
                            >
                                X
                            </button>
                        </div>
                    </div>
                    <div v-if="editingCommentId === comment.id">
                        <textarea
                            v-model="editBody"
                            rows="3"
                            class="mt-2 w-full rounded border p-2 text-sm"
                        ></textarea>
                        <div class="mt-1 flex gap-2">
                            <button
                                @click="saveEdit(comment.id)"
                                type="button"
                                class="cursor-pointer rounded-md bg-indigo-500 px-2.5 py-1.5 text-sm text-white hover:bg-indigo-600"
                            >
                                Save Comment
                            </button>
                            <button
                                @click="cancelEdit"
                                class="cursor-pointer rounded-md bg-gray-200 px-2.5 py-1.5 text-sm hover:bg-gray-300"
                            >
                                Cancel
                            </button>
                        </div>
                    </div>
                    <p v-else class="mt-2 text-gray-600">{{ comment.body }}</p>
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
                        class="cursor-pointer rounded-md bg-indigo-500 px-2.5 py-1.5 text-sm text-white hover:bg-indigo-600"
                    >
                        {{ processing ? 'Posting...' : 'Post Comment' }}
                    </button>
                </div>
            </section>
        </Form>
    </div>
</template>
