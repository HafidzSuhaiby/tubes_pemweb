import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            input: ['resources/css/auth.css', 'resources/js/auth.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
