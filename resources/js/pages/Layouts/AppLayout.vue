<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();
const user = page.props.auth?.user ?? null;
const flash = computed(() => usePage().props.flash);
</script>

<template>
    <div class="bg-gray-700">
        <nav class="bg-gray-900 shadow-sm border-b border-gray-800">
            <Link href="/" class="text-xl font-bold text-gray-100 px-2">Mir</Link>
            <Link href="/about" class="text-gray-300 px-2">About</Link>
            <Link v-if="!user" href="/login" class="text-gray-300 px-2">Login</Link>
            <Link v-if="!user" href="/register" class="text-gray-300 px-2">Register</Link>
            <form v-if="user" method="POST" action="/logout">
                <button type="submit" class="text-gray-300">Logout</button>
            </form>
        </nav>
        <main>
            <slot />
        </main>
    </div>
</template>
