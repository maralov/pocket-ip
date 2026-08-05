# Pocket-IP Website

WordPress theme for the Pocket-IP website. The `public/` directory is the theme itself (PHP templates), and `static/` contains the Gulp + Webpack build pipeline that compiles source assets (SCSS, JS, images, fonts) into the theme.

## Stack

- **CMS**: WordPress
- **Templating**: PHP + ACF Flexible Content (`template-parts/flexible-content.php`)
- **i18n**: Polylang
- **SEO**: Yoast
- **Frontend**: Bootstrap 5, jQuery, Slick carousel
- **Build**: Gulp 4 + Webpack 5 (Babel, Sass, SVG sprites, image optimization, favicons)
- **Package manager**: Yarn 3

## Repository layout

```
public/                  WordPress theme (deployed as wp-content/themes/pocket-ip)
  functions.php          Theme bootstrap; includes files from functions/
  functions/             Menus, post types, ACF options page, Polylang & Yoast setup
  template-parts/        Reusable template parts, incl. ACF flexible content blocks
  views/                 Additional view partials
  css/ js/ img/ fonts/   Compiled assets (output of static/ build)
  *.php                  Page/archive/single templates

static/                  Source and build pipeline
  src/
    components/          BEM blocks & modules (SCSS + JS)
    views/               HTML prototypes (gulp-file-include)
    js/ img/ fonts/      Frontend source
  gulp-tasks/            Individual Gulp tasks (clean, styles, scripts, images, fonts,
                         favicons, views, serve, watch)
  gulpfile.babel.js      Task registration
  webpack.config.js      Webpack config used by the scripts task
```

## Branches

- `dev` — active development
- `main` — production
- `wp-dev` — WordPress-focused work

## Development

```bash
cd static
yarn install
yarn dev              # gulp watch + BrowserSync
```

### Production build

```bash
cd static
yarn build            # full production build (all assets)
```

Targeted builds: `yarn build:styles`, `build:scripts`, `build:images`, `build:fonts`, `build:favicons`, `build:views`, `build:gzip`.

### Linting

```bash
yarn lint:styles      # stylelint on src/**/*.scss
yarn lint:scripts     # eslint on src/js/**/*.js
```

Add `--fix` for auto-fix. `lint-staged` runs both on staged `*.scss` / `*.js`.

### BEM scaffolding

```bash
yarn bem-c <block>    # scaffold a BEM block in src/components/blocks/
yarn bem-m <module>   # scaffold a BEM module in src/components/modules/
```

## Deployment

The `public/` directory is the WordPress theme; deploy its contents to `wp-content/themes/pocket-ip/` on the server. Compiled assets under `public/css`, `public/js`, `public/img`, `public/fonts` are produced by the `static/` build and committed to the repo.

## Remotes

- `origin` — `github.com/maralov/pocket-ip`
- Mirror — `github.com/Crane-IP/pocket-website`
