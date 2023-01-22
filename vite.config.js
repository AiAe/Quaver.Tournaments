import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';

const path = require('path');

export default defineConfig({
    server: {
        host: '0.0.0.0',
        hmr: {
            host: 'localhost'
        }
    },
    plugins: [
        laravel({
            input: [
                'resources/scss/theme.scss',
                'resources/scss/app.scss',
                'resources/js/app.js'
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
        }
    },
});
