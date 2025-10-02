import { defineConfig } from 'vite';

export default defineConfig({
    root: 'src',
    build: {
        outDir: '../dist',
        emptyOutDir: true,
        rollupOptions: {
            input: {
                style: './scss/style.scss',
                app: './js/app.js'
            }
        }
    }
});
