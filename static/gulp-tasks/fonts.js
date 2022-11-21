"use strict";

import { paths } from "../gulpfile.babel";
import gulp from "gulp";
import debug from "gulp-debug";
import gulpif from "gulp-if";
import yargs from "yargs";

const argv = yargs.argv;
const production = !!argv.production;

gulp.task("fonts", () => {
    return gulp.src(paths.fonts.src)
        .pipe(gulp.dest(paths.fonts.dist))
        .pipe(gulpif(production, gulp.dest(paths.fonts.public)))
        .pipe(debug({
            "title": "Fonts"
        }));
});
