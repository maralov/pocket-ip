"use strict";

import gulp from "gulp";

const requireDir = require("require-dir");

export const paths = {
    views: {
        src: [
            "./src/views/**/*.html",
            "./src/views/*.html"
        ],
        public: "../public/wp-content/themes/pocketip/template-parts/",
        watch: [
            "./src/components/blocks/**/*.html",
            "./src/components/modules/**/*.html",
            "./src/views/**/*.html"
        ]
    },
    styles: {
        src: "./src/components/styles/main.{scss,sass}",
        public: "../public/wp-content/themes/pocketip/css/",
        watch: [
            "./src/components/**/*.{scss,sass}"
        ]
    },
    scripts: {
        src: "./src/js/index.js",
        public: "../public/wp-content/themes/pocketip/js/",
        watch: [
            "./src/components/blocks/**/*.js",
            "./src/components/modules/**/*.js",
            "./src/js/**/*.js"
        ]
    },
    images: {
        src: ["./src/img/**/*.{jpg,jpeg,png,gif,tiff,svg}", "!./src/img/favicon/*.{jpg,jpeg,png,gif,tiff}"],
        public: "../public/wp-content/themes/pocketip/img/",
        watch: "./src/img/**/*.{jpg,jpeg,png,gif,svg,tiff}"
    },
    fonts: {
        src: "./src/fonts/**/*.{woff,woff2}",
        public: "../public/wp-content/themes/pocketip/fonts/",
        watch: "./src/fonts/**/*.{woff,woff2}"
    },
    favicons: {
        src: "./src/img/favicon/*.{jpg,jpeg,png,gif}",
        public: "../public/wp-content/themes/pocketip/img/favicons/"
    },
    gzip: {
        src: "./src/.htaccess",
        public: "../public/wp-content/themes/pocketip/"
    }
};

requireDir("./gulp-tasks/");

export const development = gulp.series(
    "clean",
    gulp.parallel([ "styles", "scripts", "images", "fonts", "favicons"]),
    gulp.parallel("watch", "serve")
);

export const prod = gulp.series("clean",
    gulp.parallel(["styles", "scripts", "images", "fonts", "favicons"])
);

export default development;
