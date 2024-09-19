import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "node_modules/jquery/dist/jquery.min.js",
                "node_modules/datatables.net-dt/js/dataTables.dataTables.js",
                "node_modules/select2/dist/js/select2.full.min.js",
                "node_modules/select2/dist/css/select2.min.css",
                "node_modules/jquery-circle-progress/dist/circle-progress.min.js",
                "node_modules/jquery-ui/dist/jquery-ui.min.js",
            ],
            refresh: true,
        }),
    ],
});
