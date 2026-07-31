<script setup lang="ts">
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import { onMounted, onUnmounted, ref, watch } from 'vue';
import { destroy, edit } from '@/routes/posts';

interface Props {
    post: {
        id: number;
        title: string;
        slug: string;
        user: {
            id: number;
            name: string;
        } | null;
        published_at: string;
        body_html: string;
        excerpt: string;
    };
}
const props = defineProps<Props>();
const giscusContainer = ref<HTMLElement | null>(null);

const can = usePage().props.can ?? {};

const deletePost = () => {
    if (confirm(`Delete "${props.post.title}"?`)) {
        router.delete(destroy(props.post.slug).url);
    }
};

const formatDate = (date: string) =>
    new Date(date).toLocaleDateString('en-GB', { year: 'numeric', month: 'short', day: 'numeric' });

const loadGiscus = () => {
    // teardown previous instance (SPA navigation between posts)
    document.getElementById('giscus-script')?.remove();
    if (giscusContainer.value) {
        giscusContainer.value.innerHTML = '';
    }

    // fresh mount point
    const container = document.createElement('div');
    container.className = 'giscus';
    giscusContainer.value?.appendChild(container);

    // fresh loader script
    const script = document.createElement('script');
    script.id = 'giscus-script';
    script.async = true;
    script.src = 'https://giscus.app/client.js';
    script.setAttribute('data-repo', 'x0rtex/mir');
    script.setAttribute('data-repo-id', 'R_kgDOTeIZTw');
    script.setAttribute('data-category', 'Blog');
    script.setAttribute('data-category-id', 'DIC_kwDOTeIZT84DCZY-');
    script.setAttribute('data-mapping', 'pathname');
    script.setAttribute('data-strict', '0');
    script.setAttribute('data-reactions-enabled', '1');
    script.setAttribute('data-emit-metadata', '0');
    script.setAttribute('data-input-position', 'top');
    script.setAttribute('data-theme', 'light');
    script.setAttribute('data-lang', 'en');
    script.setAttribute('data-loading', 'lazy');
    script.setAttribute('crossorigin', 'anonymous');
    document.head.appendChild(script);
};

onMounted(loadGiscus);

watch(() => props.post.id, loadGiscus);

onUnmounted(() => {
    document.getElementById('giscus-script')?.remove();
    if (giscusContainer.value) giscusContainer.value.innerHTML = '';
});
</script>

<template>
    <Head :title="props.post.title" />
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-3xl">
            <div class="pt-4 pb-8">
                <div class="mb-2 flex items-start justify-between gap-4">
                    <h1 class="text-3xl font-bold">
                        {{ props.post.title }}
                    </h1>
                    <div v-if="can.editPosts || can.deletePosts" class="flex shrink-0 gap-2">
                        <Link
                            v-if="can.editPosts"
                            :href="edit(props.post.slug).url"
                            class="rounded bg-gray-200 px-3 py-1.5 text-sm hover:bg-gray-300"
                        >
                            Edit
                        </Link>
                        <button
                            v-if="can.deletePosts"
                            @click="deletePost"
                            type="button"
                            class="cursor-pointer rounded bg-red-100 px-3 py-1.5 text-sm text-red-600 hover:bg-red-200"
                        >
                            Delete
                        </button>
                    </div>
                </div>
                <p class="text-sm text-gray-500">
                    Published on
                    <time :datetime="props.post.published_at">
                        {{ formatDate(props.post.published_at) }}
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

    <div ref="giscusContainer" class="mx-auto my-8 max-w-3xl"></div>
</template>
