# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

Website for Dr. Lisandro Zenón, a surgeon in Goya, Corrientes, Argentina (domain: `www.lisandrozenon.com.ar`). All content is in Spanish (es-AR, "usted"). Multi-page PHP site (PHP includes, no build step, no database), styled with Bootstrap 5.3 grid/utilities plus a custom `assets/css/style.css`.

## Development

No build system, package manager, linter, or tests. **PHP 8.0 syntax only** (no 8.1+ features).

The site runs locally at **http://lisandrozenon.local** via the shared Docker container `php80` (Apache 2.4 + PHP 8.0, also serving other projects; do not restart or modify it). This repo is bind-mounted to `/var/www/lisandrozenon`, so edits are live on refresh. The vhost is `/home/fabricio/proyectos/apache-sites/lisandrozenon.conf` (`AllowOverride All`, so `.htaccess` works). There is no local `php`: use `docker exec php80 php /var/www/lisandrozenon/...` for CLI scripts and `php -l`.

Deployment is a manual upload by the user (VS Code SFTP, `.vscode/sftp.json`, gitignored). Never deploy. See `docs/DEPLOY.md` (what to upload / not upload, Cloudflare, Search Console checklist).

## Architecture

```
index.php                     Home (hero + summary of every section; keeps anchors #inicio #acercademi #patologias #tratamientos #cirugiasinhuellas #equipamiento2 #contacto)
404.php                       Not-found page (sends HTTP 404; .htaccess ErrorDocument)
sobre-mi/ cirugia-sin-huellas/ equipamiento/ contacto/   one index.php each (clean URLs = directories)
patologias/index.php, tratamientos/index.php             index pages (include plantilla-indice.php)
patologias/<slug>/index.php, tratamientos/<slug>/index.php   4-line stubs: set $tipo/$slug and include plantilla-contenido.php
includes/
  config.php                  contact data, hours, social links, GA id, assets_v (cache-busting version) — single source of truth
  functions.php               helpers: cfg(), h() (escape), picture() (webp + jpg), asset(), wa_url(), json-ld builders, contenido()
  contenido.php               ALL text of patologías/tratamientos (data array) — menu, home and index pages read it
  equipamiento.php            equipment captions/alts
  head.php header.php footer.php   shared layout; each page defines $title, $description, $canonical, $nav, $jsonLd, $sliders… BEFORE including
  plantilla-contenido.php plantilla-indice.php breadcrumb.php cta-turno.php contacto-cards.php   partials
  .htaccess                   denies direct access to includes/
assets/css/style.css          only stylesheet to edit (CSS variables in :root)
assets/js/main.js             vanilla JS: menu, hero rotation, click-to-load maps, Swiper/GLightbox init (guarded), GA contact events
assets/img/ assets/video/     webp next to every jpg; videos are compressed mp4 + jpg poster; kebab-case names
assets/vendor/                Bootstrap (css), Bootstrap Icons, Swiper, GLightbox, php-email-form (unused); don't edit
forms/                        legacy template PHP forms, unused and blocked by forms/.htaccess (no contact form: WhatsApp is the CTA)
tools/                        dev scripts, NOT deployed (see docs/AGREGAR-CONTENIDO.md)
docs/                         plan, REVISION-MEDICA.md, DEPLOY.md, AGREGAR-CONTENIDO.md, auditoria/ (docs/capturas is gitignored), NOT deployed
.htaccess robots.txt sitemap.xml site.webmanifest
```

Conventions: asset and internal links are **absolute from the root** (`/assets/...`, `/patologias/hernias/`); includes use `__DIR__`; every printed variable goes through `h()`; no `index.html` may exist (Apache would serve it before `index.php`). Email shown everywhere: `dr.lisandro.zenon@gmail.com`. No matrícula in the footer (user decision). GA (`G-041SV6FCC1`) is only emitted on the production host.

## Adding content

See `docs/AGREGAR-CONTENIDO.md` (new pathology/treatment = entry in `includes/contenido.php` + 4-line stub folder + `tools/generar-sitemap.php`). Run `tools/validar.sh <paths>` (HTML validator on the rendered page) and check the browser console before finishing.

## Work plan and rules

`docs/PLAN-DE-TRABAJO.md` (phases F1–F5, all executed; checkboxes mark status). Medical content: only fix spelling/HTML, never change meaning — put doubts in `docs/REVISION-MEDICA.md`. Pending items for the user are listed in `docs/DEPLOY.md` and `docs/REVISION-MEDICA.md`.

## Gotchas

- No AMP: the old AMP markup was removed; don't reintroduce it.
- `.htaccess` redirects to https+www only for hosts `lisandrozenon.com.ar` / `www.` (production is behind Cloudflare; uses `X-Forwarded-Proto` / `CF-Visitor`). Local never redirects. `<Directory>` is not allowed in `.htaccess`: use per-folder `.htaccess` files.
- After editing `style.css` or `main.js`, bump `assets_v` in `includes/config.php`.
- Headless tooling (Playwright, Lighthouse) must be installed outside the repo; Lighthouse/Chromium need `--host-resolver-rules="MAP lisandrozenon.local 127.0.0.1"`.
