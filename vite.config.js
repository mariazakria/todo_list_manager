import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        
    ],
    server: {
        proxy: {
          '/app': 'http://localhost',
        },
      },
      build: {
        outDir: 'public/build', 
      },
    });
    