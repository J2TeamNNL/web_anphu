import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [laravel({
        input: [
            'resources/css/app.css',
            'resources/js/app.js',
            'resources/css/style_all.css',
            'resources/css/style_auth.css',
        ],
        refresh: true,
    })],
    base: '/build/',
    define: {
        global: 'globalThis',
    }
});
