import { defineConfig } from "vite";
import vue from "@vitejs/plugin-vue";
import { ViteImageOptimizer } from "vite-plugin-image-optimizer";
import eslint from "vite-plugin-eslint";

export default defineConfig({
  base: "/wp-content/themes/goholboxtransfers/dist",
  server: {
    port: 5275,
    host: "0.0.0.0",
    origin: "http://localhost:5275",
    cors: true,
  },
  build: {
    manifest: true,
    rollupOptions: {
      input: {
        index: "./assets/index.js",
        login: "./assets/login.js",
      },
    },
    outDir: "./public/wp-content/themes/goholboxtransfers/dist",
    copyPublicDir: false,
    assetsDir: "assets",
    cssCodeSplit: true,
    sourcemap: true,
  },
  plugins: [ViteImageOptimizer({}), vue(), eslint()],
});
