# Agent guide — Pocket-IP Website

Instructions for AI coding agents (Claude Code, Codex, Cursor, etc.) working in this repo. Read this before editing.

## Project shape

WordPress theme in `public/` + Gulp/Webpack asset pipeline in `static/`. Source lives in `static/src/`; compiled output is written into `public/css`, `public/js`, `public/img`, `public/fonts` and is **committed** to the repo.

See [README.md](./README.md) for the full stack and layout.

## Golden rules

1. **Never hand-edit compiled assets.** Files under `public/css`, `public/js`, `public/img/sprite`, `public/fonts` are build artifacts. Edit sources in `static/src/` and rebuild.
2. **Never commit `node_modules`, `.DS_Store`, `.idea/`, or `.env`.** They are gitignored; if you see one staged, unstage it.
3. **Do not bump dependencies** in `static/package.json` unless the user explicitly asks. This is a mature Gulp 4 / Yarn 3 setup and upgrades cascade.
4. **Preserve BEM.** New components go in `static/src/components/blocks/` or `static/src/components/modules/`. Prefer `yarn bem-c` / `yarn bem-m` to scaffold.
5. **Respect Polylang.** User-facing strings that must be translatable belong in Polylang string groups (`public/functions/polylang_strings.php`) or in template `pll__()` / `pll_e()` calls — not hardcoded.
6. **ACF is the source of truth for page content.** Layout is composed via `template-parts/flexible-content.php` + blocks under `template-parts/blocks/`. Add new sections as ACF flexible content layouts + a matching block template part, not as ad-hoc page templates.

## Where things live

| Task | Edit here |
| --- | --- |
| New page section / block | ACF field group + `public/template-parts/blocks/<name>.php` + `static/src/components/blocks/<name>/` |
| Global styles | `static/src/components/` (SCSS partials imported by the entry) |
| Global JS | `static/src/js/` |
| Custom post types | `public/functions/post_types.php` |
| Menus | `public/functions/menu.php` |
| ACF options page | `public/functions/options_page.php` |
| Polylang setup / strings | `public/functions/polylang_setting.php`, `polylang_strings.php` |
| Yoast tweaks | `public/functions/yoast_sittings.php` |
| Page templates | `public/page-*.php`, `single-*.php`, `taxonomy-*.php` |
| Header / footer | `public/header.php`, `public/footer.php` |

## Workflow for a typical change

1. Identify whether the change is **content** (ACF/PHP template) or **presentation** (SCSS/JS in `static/`).
2. Edit the source file(s).
3. If touching `static/`, run `cd static && yarn dev` (or `yarn build` for a production build) so `public/{css,js,img,fonts}` is updated.
4. Verify visually (BrowserSync via `yarn dev`) — do not claim UI work is done without opening it.
5. Stage only intentional files (`git add <paths>`, avoid `git add -A`).
6. Commit with a short, imperative message. Keep unrelated changes out.

## Commands cheat sheet

```bash
cd static
yarn install
yarn dev                    # watch + BrowserSync
yarn build                  # full production build
yarn lint:styles --fix
yarn lint:scripts --fix
yarn bem-c my-block         # scaffold BEM block
yarn bem-m my-module        # scaffold BEM module
```

## Git

- Default working branch: `dev`. Merge to `main` for production.
- Two remotes: `origin` (`maralov/pocket-ip`) and a mirror (`Crane-IP/pocket-website`). When pushing, keep both in sync if the user asks for a sync.
- Large pushes over HTTPS occasionally fail with `RPC failed; HTTP 400`. Retry with `git -c http.postBuffer=524288000 push …`.

## Things to avoid

- Introducing new build tools (Vite, esbuild, etc.) — stay on Gulp/Webpack unless the user asks for a migration.
- Adding a new page template file when an ACF flexible-content block would compose the same layout.
- Hardcoding user-facing copy in English/Ukrainian without wiring Polylang.
- Committing IDE, OS, or editor cruft.
