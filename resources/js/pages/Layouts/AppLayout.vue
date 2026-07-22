<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import { login, register, logout, about, blog, home } from '@/routes';
import { dashboard } from '@/routes/admin';

const flash = computed(() => usePage().props.flash);
const page = usePage();
const user = computed(() => page.props.auth?.user ?? null);
</script>

<template>
    <header
        class="relative mx-auto border-b border-gray-200 px-4 pt-4 pb-4 shadow-2xs sm:px-6 sm:pb-4"
    >
        <nav
            class="relative flex items-center justify-between sm:h-10 md:justify-center"
            aria-label="Global"
        >
            <div class="flex flex-1 items-center md:absolute md:inset-y-0 md:left-0">
                <div class="flex w-full items-center justify-between md:w-auto">
                    <a href="/">
                        <span class="sr-only">Mir</span>
                        <img
                            class="h-8 w-auto sm:h-10"
                            src="https://www.svgrepo.com/show/470685/space-station.svg"
                            loading="lazy"
                            width="202"
                            height="40"
                        />
                    </a>
                    <div class="-mr-2 flex items-center md:hidden">
                        <button
                            class="inline-flex items-center justify-center rounded-md bg-gray-50 p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:ring-2 focus:ring-gray-50 focus:outline-none focus:ring-inset"
                            type="button"
                            aria-expanded="false"
                        >
                            <span class="sr-only">Open main menu</span>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="2"
                                stroke="currentColor"
                                aria-hidden="true"
                                class="h-6 w-6"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M4 6h16M4 12h16M4 18h16"
                                ></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <div class="hidden list-none md:flex md:space-x-10">
                <Link
                    :href="home()"
                    view-transition
                    class="list-none text-base font-normal text-gray-500 hover:text-gray-900"
                    :class="{ 'font-semibold text-gray-700': $page.url === '/' }"
                >
                    Mir
                </Link>
                <Link
                    :href="blog()"
                    view-transition
                    class="list-none text-base font-normal text-gray-500 hover:text-gray-900"
                    :class="{ 'font-semibold text-gray-700': $page.url.startsWith('/blog') }"
                >
                    Blog
                </Link>
                <Link
                    :href="about()"
                    view-transition
                    class="list-none text-base font-normal text-gray-500 hover:text-gray-900"
                    :class="{ 'font-semibold text-gray-700': $page.url.startsWith('/about') }"
                >
                    About
                </Link>
            </div>
            <div
                class="hidden md:absolute md:inset-y-0 md:right-0 md:flex md:items-center md:justify-end"
            >
                <Link
                    v-if="!user"
                    :href="login()"
                    view-transition
                    class="font-base mx-2 inline-flex cursor-pointer items-center rounded-full border border-transparent bg-white px-4 py-2 text-base text-gray-900 shadow hover:bg-gray-50"
                    :class="{ 'font-semibold text-gray-700': $page.url.startsWith('/login') }"
                >
                    Sign in
                </Link>
                <Link
                    v-if="!user"
                    :href="register()"
                    view-transition
                    class="font-base mx-2 inline-flex cursor-pointer items-center rounded-full border border-transparent bg-white px-4 py-2 text-base text-gray-900 shadow hover:bg-gray-50"
                    :class="{ 'font-semibold text-gray-700': $page.url.startsWith('/register') }"
                >
                    Register
                </Link>
                <Link
                    v-if="$page.props.can?.accessDashboard"
                    :href="dashboard()"
                    view-transition
                    class="font-base mx-2 inline-flex cursor-pointer items-center rounded-full border border-transparent bg-white px-4 py-2 text-base text-gray-900 shadow hover:bg-gray-50"
                    :class="{ 'font-semibold text-gray-700': $page.url.startsWith('/admin') }"
                >
                    Admin
                </Link>
                <Link
                    v-if="user"
                    :href="logout()"
                    method="post"
                    as="button"
                    view-transition
                    class="mx-2 inline-flex cursor-pointer items-center rounded-full border border-transparent bg-white px-4 py-2 text-base text-gray-900 shadow hover:bg-gray-50"
                >
                    Logout
                </Link>
            </div>
        </nav>
    </header>
    <main class="container mx-auto min-h-[calc(100vh-72px)] max-w-4xl p-4 shadow-sm sm:px-6">
        <aside
            v-if="flash?.message || flash?.error"
            class="mb-4 rounded px-4 py-2 shadow-lg"
            :class="flash?.message ? 'bg-green-500 text-white' : 'bg-red-500 text-white'"
        >
            {{ flash?.message || flash?.error }}
        </aside>
        <slot />
    </main>
    <footer class="bg-gray-900 p-4 text-center text-white">
        <a
            href="#"
            class="mb-5 flex items-center justify-center text-2xl font-semibold text-gray-500 hover:text-gray-400"
        >
            <img
                src="https://www.svgrepo.com/show/470685/space-station.svg"
                class="mr-3 h-12 sm:h-9"
                alt="Mir Logo"
            />
            Mir
        </a>
        <ul class="mt-5 flex justify-center space-x-5">
            <li>
                <a href="#" class="text-gray-500 hover:text-gray-400">
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path
                            fill-rule="evenodd"
                            d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                            clip-rule="evenodd"
                        ></path>
                    </svg>
                </a>
            </li>
            <li>
                <a href="#" class="text-gray-500 hover:text-gray-400">
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path
                            fill-rule="evenodd"
                            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10c5.51 0 10-4.48 10-10S17.51 2 12 2zm6.605 4.61a8.502 8.502 0 011.93 5.314c-.281-.054-3.101-.629-5.943-.271-.065-.141-.12-.293-.184-.445a25.416 25.416 0 00-.564-1.236c3.145-1.28 4.577-3.124 4.761-3.362zM12 3.475c2.17 0 4.154.813 5.662 2.148-.152.216-1.443 1.941-4.48 3.08-1.399-2.57-2.95-4.675-3.189-5A8.687 8.687 0 0112 3.475zm-3.633.803a53.896 53.896 0 013.167 4.935c-3.992 1.063-7.517 1.04-7.896 1.04a8.581 8.581 0 014.729-5.975zM3.453 12.01v-.26c.37.01 4.512.065 8.775-1.215.25.477.477.965.694 1.453-.109.033-.228.065-.336.098-4.404 1.42-6.747 5.303-6.942 5.629a8.522 8.522 0 01-2.19-5.705zM12 20.547a8.482 8.482 0 01-5.239-1.8c.152-.315 1.888-3.656 6.703-5.337.022-.01.033-.01.054-.022a35.318 35.318 0 011.823 6.475 8.4 8.4 0 01-3.341.684zm4.761-1.465c-.086-.52-.542-3.015-1.659-6.084 2.679-.423 5.022.271 5.314.369a8.468 8.468 0 01-3.655 5.715z"
                            clip-rule="evenodd"
                        ></path>
                    </svg>
                </a>
            </li>
        </ul>
    </footer>
</template>
