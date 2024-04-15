import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: 'resources/js/app.js',
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        
    ],
    test: {
        globals: true,
        environmentMatchGlobs:[
            ['tests/testJS/Ajax/**','node'],['tests/testJS/dom/**','jsdom']
        ],   
      },
});
