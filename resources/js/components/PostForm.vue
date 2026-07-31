<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import { store as postsStore, update as postsUpdate } from '@/routes/posts';

const props = defineProps<{
    post?: {
        id: number;
        title: string;
        slug: string;
        body: string;
        excerpt: string | null;
        published_at: string | null;
    };
}>();

const toDatetimeLocal = (iso: string | null): string => {
    if (!iso) return '';
    const d = new Date(iso);
    const pad = (n: number) => String(n).padStart(2, '0');
    return `${d.getFullYear()}-${pad(d.getMonth() + 1)}-${pad(d.getDate())}T${pad(d.getHours())}:${pad(d.getMinutes())}`;
};

const form = useForm({
    title: props.post?.title ?? '',
    slug: props.post?.slug ?? '',
    body: props.post?.body ?? '',
    excerpt: props.post?.excerpt ?? '',
    published_at: props.post
        ? toDatetimeLocal(props.post.published_at)
        : toDatetimeLocal(new Date().toISOString()),
});

const updateSlug = () => {
    if (!props.post || form.slug === props.post.slug) {
        form.slug = form.title
            .toLowerCase()
            .replace(/[^\p{L}\p{N}\s-]+/gu, '')
            .replace(/[\s-]+/g, '-')
            .replace(/(^-|-$)/g, '');
    }
};

const submit = () => {
    if (props.post) {
        form.put(postsUpdate(props.post.slug).url, {
            preserveScroll: true,
        });
    } else {
        form.post(postsStore().url, {
            preserveScroll: true,
        });
    }
};
</script>

<template>
    <form @submit.prevent="submit" class="mx-auto max-w-3xl">
        <div class="mb-4">
            <label class="mb-1 block text-sm font-semibold">Title</label>
            <input
                v-model="form.title"
                type="text"
                @input="updateSlug"
                required
                class="w-full rounded border p-2 shadow-sm"
            />
            <p v-if="form.errors.title" class="mt-1 text-sm text-red-500">{{ form.errors.title }}</p>
        </div>

        <div class="mb-4">
            <label class="mb-1 block text-sm font-semibold">Slug</label>
            <input
                v-model="form.slug"
                type="text"
                class="w-full rounded border p-2 shadow-sm"
            />
            <p v-if="form.errors.slug" class="mt-1 text-sm text-red-500">{{ form.errors.slug }}</p>
        </div>

        <div class="mb-4">
            <label class="mb-1 block text-sm font-semibold">Body (markdown)</label>
            <textarea
                v-model="form.body"
                rows="16"
                required
                class="w-full rounded border p-2 font-mono text-sm shadow-sm"
            ></textarea>
            <p v-if="form.errors.body" class="mt-1 text-sm text-red-500">{{ form.errors.body }}</p>
        </div>

        <div class="mb-4">
            <label class="mb-1 block text-sm font-semibold">Excerpt</label>
            <textarea
                v-model="form.excerpt"
                rows="3"
                class="w-full rounded border p-2 shadow-sm"
            ></textarea>
            <p v-if="form.errors.excerpt" class="mt-1 text-sm text-red-500">{{ form.errors.excerpt }}</p>
        </div>

        <div class="mb-6">
            <label class="mb-1 block text-sm font-semibold">Publish date (leave empty for draft)</label>
            <input
                v-model="form.published_at"
                type="datetime-local"
                class="w-full rounded border p-2 shadow-sm"
            />
            <p v-if="form.errors.published_at" class="mt-1 text-sm text-red-500">
                {{ form.errors.published_at }}
            </p>
        </div>

        <button
            type="submit"
            :disabled="form.processing"
            class="rounded-md bg-blue-600 px-4 py-2 font-semibold text-white hover:bg-blue-700 disabled:opacity-50"
        >
            {{ form.processing ? 'Saving...' : props.post ? 'Update Post' : 'Create Post' }}
        </button>
    </form>
</template>
