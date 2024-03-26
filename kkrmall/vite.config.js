import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/owl.carousel.css',
                'resources/css/owl.theme.default.css',
                'resources/js/owl.carousel.js',
                'resources/js/owl.autoplay.js',
                'resources/js/owl.navigation.js',
                'resources/css/style.css',
                'resources/css/headers.css',
                'resources/css/app.css',
                'resources/css/admin.css',
                'resources/js/app.js',
                'resources/js/common.js',
            ],
            refresh: true,
        }),
    ],
});
