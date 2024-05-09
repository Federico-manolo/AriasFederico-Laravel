import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/crud.css',
                'resources/css/dashboard.css',
                'resources/css/base.css',
                'resources/js/app.js',
                'resources/js/crud.js',
            ],
            refresh: true,
        }),
    ],
});
