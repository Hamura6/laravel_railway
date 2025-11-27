import {
    defineConfig
} from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.js',
                'resources/sass/app.scss',
                // 'resources/js/landing-pages.js'
            ],
            refresh: true,
        }),
    ],
    base: '/',
    server: {
        cors: true,
    },
    css: {
        preprocessorOptions: {
            scss: {
                silenceDeprecations: [
                    'import',
                    'mixed-decls',
                    'color-functions',
                    'global-builtin',
                ],
            },
        },
    },

});
// build: {
//     rollupOptions: {
//         output: {
//             manualChunks: {
//                 sweetalert2: ['sweetalert2'],
//                 fontawesome: ['@fortawesome/fontawesome-free'],
//             },
//         },
//     },
// },
