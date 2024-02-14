import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        hmr: {
            host: "localhost",
        },
    },
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/calendar.css',
                'resources/js/app.js',
                'resources/js/calendar.js',
            ],
            refresh: true,
        }),
    ],
});
