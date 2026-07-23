<script setup lang="ts">
import { Head, usePage, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import { update, password, destroy } from '@/routes/profile';

const user = usePage().props.auth?.user ?? null;

const profileForm = useForm({
    name: user?.name ?? '',
    email: user?.email ?? '',
    avatar: null as File | null,
});

const avatarPreview = ref<string | null>(null);

const selectAvatar = (e: Event) => {
    const file = (e.target as HTMLInputElement).files?.[0];

    if (file) {
        profileForm.avatar = file;
        avatarPreview.value = URL.createObjectURL(file);
    }
};

const updateProfile = () => {
    profileForm.post(update().url, {
        preserveScroll: true,
        onSuccess: () => profileForm.reset('avatar'),
    });
};

const passwordForm = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const updatePassword = () => {
    passwordForm.put(password().url, {
        preserveScroll: true,
        onSuccess: () => passwordForm.reset(),
    });
};

const deleteForm = useForm({});
const confirmDelete = () => {
    if (confirm('Are you sure you want to delete your account? This cannot be undone.')) {
        deleteForm.delete(destroy().url);
    }
};
</script>

<template>
    <Head title="My Profile" />
    <h1 class="text-3xl font-bold">My Profile</h1>

    <!-- Personal Information -->
    <section class="mt-8">
        <h2 class="mb-2 text-2xl font-bold">Personal Information</h2>
        <div class="flex gap-4">
            <form @submit.prevent="updateProfile" class="flex-3/4">
                <label
                    >Name<input
                        type="text"
                        autocomplete="name"
                        :placeholder="user.name"
                        class="mb-2 w-full rounded border p-2 shadow-sm"
                        v-model="profileForm.name"
                /></label>
                <p v-if="profileForm.errors.name" class="text-red-500">
                    {{ profileForm.errors.name }}
                </p>
                <label
                    >Email<input
                        type="email"
                        autocomplete="email"
                        :placeholder="user.email"
                        class="mb-2 w-full rounded border p-2 shadow-sm"
                        v-model="profileForm.email"
                /></label>
                <p v-if="profileForm.errors.email" class="text-red-500">
                    {{ profileForm.errors.email }}
                </p>
                <button
                    type="submit"
                    :disabled="profileForm.processing"
                    class="mt-2 w-full cursor-pointer rounded border p-2 shadow-sm"
                >
                    {{ profileForm.processing ? 'Saving...' : 'Save' }}
                </button>
            </form>

            <div class="flex grow flex-col items-center">
                <img
                    :src="avatarPreview ?? user?.avatar_url ?? 'https://placehold.co/36x36'"
                    alt="PFP"
                    class="mx-auto mb-3 h-36 w-36 rounded-full"
                />
                <label class="w-full justify-center rounded border p-2 text-center shadow-sm">
                    Upload Avatar
                    <input type="file" accept="image/*" class="hidden" @change="selectAvatar" />
                </label>
            </div>
        </div>
    </section>

    <!-- Change Password -->
    <section class="mt-8">
        <h2 class="mb-2 text-2xl font-bold">Change Password</h2>
        <form @submit.prevent="updatePassword">
            <label
                >Current Password<input
                    type="password"
                    autocomplete="current-password"
                    class="mb-2 w-full rounded border p-2 shadow-sm"
                    v-model="passwordForm.current_password"
            /></label>
            <p v-if="passwordForm.errors.current_password" class="text-red-500">
                {{ passwordForm.errors.current_password }}
            </p>
            <label
                >New Password<input
                    type="password"
                    autocomplete="new-password"
                    class="mb-2 w-full rounded border p-2 shadow-sm"
                    v-model="passwordForm.password"
            /></label>
            <p v-if="passwordForm.errors.password" class="text-red-500">
                {{ passwordForm.errors.password }}
            </p>
            <label
                >Confirm Password<input
                    type="password"
                    autocomplete="new-password"
                    class="mb-2 w-full rounded border p-2 shadow-sm"
                    v-model="passwordForm.password_confirmation"
            /></label>
            <p v-if="passwordForm.errors.password_confirmation" class="text-red-500">
                {{ passwordForm.errors.password_confirmation }}
            </p>
            <button
                type="submit"
                :disabled="passwordForm.processing"
                class="mt-2 w-full rounded border p-2 shadow-sm"
            >
                {{ passwordForm.processing ? 'Updating...' : 'Update Password' }}
            </button>
        </form>
    </section>

    <!-- Danger Zone -->
    <section class="my-8">
        <h2 class="mb-2 text-2xl font-bold text-red-600">Danger Zone</h2>
        <p class="mb-4 text-sm text-red-500">
            Once you delete your account, there is no going back.
        </p>
        <button
            @click="confirmDelete"
            :disabled="deleteForm.processing"
            class="rounded bg-red-600 px-4 py-2 text-white hover:bg-red-700 disabled:opacity-50"
        >
            {{ deleteForm.processing ? 'Deleting...' : 'Delete Account' }}
        </button>
    </section>
</template>
