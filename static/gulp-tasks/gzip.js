"use strict";

import { paths } from "../gulpfile.babel";
import gulp from "gulp";
import debug from "gulp-debug";
import gulpif from "gulp-if";
import yargs from "yargs";

const argv = yargs.argv;
const production = !!argv.production;

gulp.task("gzip", () => {
    return gulp.src(paths.gzip.src)
        .pipe(gulp.dest(paths.gzip.dist))
        .pipe(gulpif(production, gulp.dest(paths.gzip.public)))
        .pipe(debug({
            "title": "GZIP config"
        }));
});
