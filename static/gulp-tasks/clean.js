"use strict";

import gulp from "gulp";
import del from "del";
import yargs from "yargs";

const argv = yargs.argv;
const production = !!argv.production;

gulp.task("clean", () => {
    return production
        ? del(["../public/wp-content/themes/pocketip/{css,js,img}/**"], {force: true})
        : Promise.resolve();
});
