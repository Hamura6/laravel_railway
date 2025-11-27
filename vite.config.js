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
    base: process.env.NODE_ENV === 'production' ? process.env.APP_URL + '/' : '/',
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
    },build: {
        rollupOptions: {
            output: {
                assetFileNames: assetInfo => {
                    // Copiar fuentes al folder /assets
                    if (/\.(woff2?|ttf|eot|svg)$/.test(assetInfo.name)) {
                        return 'assets/[name][extname]';
                    }
                    return 'assets/[name]-[hash][extname]';
                },
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
