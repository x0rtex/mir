<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();
const user = page.props.auth?.user ?? null;
const flash = computed(() => usePage().props.flash);
</script>

<template>
    <div class="px-4 mx-auto max-w-7xl sm:px-6">
        <div class="relative pt-4 pb-4 sm:pb-4">
            <nav class="relative flex items-center justify-between sm:h-10 md:justify-center" aria-label="Global">
                <div class="flex items-center flex-1 md:absolute md:inset-y-0 md:left-0">
                    <div class="flex items-center justify-between w-full md:w-auto">
                        <a href="#"><span class="sr-only">Mir</span>
                            <img class="w-auto h-8 sm:h-10" src="https://www.svgrepo.com/show/448244/pack.svg" loading="lazy" width="202" height="40">
                        </a>
                        <div class="flex items-center -mr-2 md:hidden">
                            <button class="inline-flex items-center justify-center p-2 text-gray-400 bg-gray-50 rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-gray-50"  type="button" aria-expanded="false">
                                <span class="sr-only">Open main menu</span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="hidden md:flex md:space-x-10 list-none">
                    <Link href="/" class="text-base font-normal text-gray-500 list-none hover:text-gray-900">
                        Mir
                    </Link>
                    <Link href="/blog" class="text-base font-normal text-gray-500 list-none hover:text-gray-900">
                        Blog
                    </Link>
                    <Link href="/about" class="text-base font-normal text-gray-500 list-none hover:text-gray-900">
                        About
                    </Link>
                </div>
                <div class="hidden md:absolute md:flex md:items-center md:justify-end md:inset-y-0 md:right-0">
                    <div class="inline-flex rounded-full shadow mx-2">
                        <Link v-if="!user" href="/login" class="inline-flex items-center px-4 py-2 text-base text-gray-900 bg-white border border-transparent rounded-full cursor-pointer font-base hover:bg-gray-50 ">
                            Sign in
                        </Link>
                    </div>
                    <div class="inline-flex rounded-full shadow mx-2">
                        <Link v-if="!user" href="/register" class="inline-flex items-center px-4 py-2 text-base text-gray-900 bg-white border border-transparent rounded-full cursor-pointer font-base hover:bg-gray-50 ">
                            Register
                        </Link>
                    </div>
                    <div class="inline-flex rounded-full shadow mx-2">
                        <Link v-if="$page.props.can?.accessDashboard" href="/admin" class="inline-flex items-center px-4 py-2 text-base text-gray-900 bg-white border border-transparent rounded-full cursor-pointer font-base hover:bg-gray-50 ">
                            Admin
                        </Link>
                    </div>
                    <div class="inline-flex rounded-full shadow mx-2">
                        <form v-if="user" method="POST" action="/logout" class="inline-flex items-center px-4 py-2 text-base text-gray-900 bg-white border border-transparent rounded-full cursor-pointer font-base hover:bg-gray-50">
                            <button type="submit">Logout</button>
                        </form>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <main class="container px-4 mx-auto max-w-7xl sm:px-6">
        <slot />
    </main>
</template>
