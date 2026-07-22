import { createInertiaApp } from '@inertiajs/vue3';
import AppLayout from './pages/Layouts/AppLayout.vue';

const appName = import.meta.env.VITE_APP_NAME || 'Mir';

createInertiaApp({
    title: (title) => (title ? `${title} - ${appName}` : appName),
    progress: {
        color: '#4B5563',
    },
    layout: () => AppLayout,
});
