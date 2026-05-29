import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        host: '127.0.0.1', //'0.0.0.0',
        port: 5173,
        strictPort: true,
        hmr: {
            host: '127.0.0.1',
            //'192.168.0.10', //'192.168.0.10',
        }
        //host: true, // exposes on network
    },
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});