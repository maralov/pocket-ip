"use strict";

import { paths } from "../gulpfile.babel";
import gulp from "gulp";
import favicons from "gulp-favicons";
import debug from "gulp-debug";

import gulpif from "gulp-if";
import yargs from "yargs";

const argv = yargs.argv;
const production = !!argv.production;

gulp.task("favicons", () => {
    return gulp.src(paths.favicons.src)
        .pipe(favicons({
            icons: {
                appleIcon: true,
                favicons: true,
                online: false,
                appleStartup: false,
                android: false,
                firefox: false,
                yandex: false,
                windows: false,
                coast: false
            }
        }))
        .pipe(gulp.dest(paths.favicons.dist))
        .pipe(gulpif(production, gulp.dest(paths.favicons.public)))
        .pipe(debug({
            "title": "Favicons"
        }));
});
