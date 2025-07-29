import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [laravel({
        input: [
            'resources/css/app.css',
            'resources/js/app.js',
            'resources/js/ckeditor.js',
            'resources/css/style_all.css',
            'resources/css/style_auth.css',
        ],
        refresh: true,
    })],
    define: {
        global: 'globalThis',
    }
});
