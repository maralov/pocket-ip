"use strict";

import gulp from "gulp";

const requireDir = require("require-dir"),
    paths = {
        views: {
            src: [
                "./src/views/**/*.html",
                "./src/views/*.html"
            ],
            dist: "./dist/",
            public: "../public/assets/views/",
            watch: [
                "./src/components/blocks/**/*.html",
                "./src/components/modules/**/*.html",
                "./src/views/**/*.html"
            ]
        },
        styles: {
            src: "./src/components/styles/main.{scss,sass}",
            dist: "./dist/css/",
            public: "../public/assets/css/",
            watch: [
                "./src/components/**/*.{scss,sass}",
                "./src/components/**/*.{scss,sass}"
            ]
        },
        scripts: {
            src: "./src/js/index.js",
            dist: "./dist/js/",
            public: "../public/assets/js/",
            watch: [
                "./src/components/blocks/**/*.js",
                "./src/components/modules/**/*.js",
                "./src/js/**/*.js"
            ]
        },
        images: {
            src: [ "./src/img/**/*.{jpg,jpeg,png,gif,tiff,svg}", "!./src/img/favicon/*.{jpg,jpeg,png,gif,tiff}" ],
            dist: "./dist/img/",
            public: "../public/assets/img/",
            watch: "./src/img/**/*.{jpg,jpeg,png,gif,svg,tiff}"
        },
        fonts: {
            src: "./src/fonts/**/*.{woff,woff2}",
            dist: "./dist/fonts/",
            public: "../public/assets/fonts/",
            watch: "./src/fonts/**/*.{woff,woff2}"
        },
        favicons: {
            src: "./src/img/favicon/*.{jpg,jpeg,png,gif}",
            dist: "./dist/img/favicons/",
            public: "../public/assets/img/favicons/",
        },
        gzip: {
            src: "./src/.htaccess",
            dist: "./dist/",
            public: "../public/",
        }
    };

requireDir("./gulp-tasks/");

export { paths };

export const development = gulp.series("clean",
    gulp.parallel(["views", "styles", "scripts", "images", "fonts", "favicons"]),
    gulp.parallel("serve"));

export const prod = gulp.series("clean",
    gulp.parallel(["views", "styles", "scripts", "images", "fonts", "favicons", "gzip"]));

export default development;
