import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import collectModuleAssetsPaths from "./vite-module-loader.js";
import vue from "@vitejs/plugin-vue";
async function getConfig() {
    const paths = ["resources/css/app.css", "resources/js/app.js"];
    const allPaths = await collectModuleAssetsPaths(paths, "Modules");

    return defineConfig({
        plugins: [
            vue({
                template: {
                    transformAssetUrls: {
                        base: null,
                        includeAbsolute: false,
                    },
                },
            }),
            laravel({
                input: allPaths,
                refresh: true,
            }),
        ],
        resolve: {
            alias: {
                "@": "/resources/js",
                vue: "vue/dist/vue.esm-bundler.js",
            },
        },
    });
}

export default getConfig();
