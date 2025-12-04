import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/auth.css',
                'resources/js/auth.js',
                'resources/css/daftar-jasa.css',
                'resources/js/daftar-jasa.js',
                'resources/css/home.css',
                'resources/js/home.js',
                'resources/css/jasa.css',
                'resources/js/jasa.js',
                'resources/js/admin.js',
                'resources/js/bootstrap.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
