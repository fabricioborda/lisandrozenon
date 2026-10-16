# Deploy y puesta en producción

El deploy lo hace el usuario (subida manual por SFTP). El agente nunca despliega.

## Requisitos del hosting

- **PHP 8.0 o superior** (el sitio usa `includes/*.php`; probado en PHP 8.0 / Apache 2.4). Sin PHP las páginas se verían como código fuente o vacías.
- Apache con `.htaccess` habilitado (`AllowOverride All`) y, de preferencia, `mod_rewrite`, `mod_expires`, `mod_deflate`, `mod_headers`. Todo el `.htaccess` está en bloques `<IfModule>`: si falta un módulo, simplemente se ignora esa parte.
- **Verificar después de subir** (en producción): que `https://www.lisandrozenon.com.ar/` muestre el sitio nuevo y que `index.html` **ya no exista** en el servidor (Debian/Apache sirven `index.html` antes que `index.php`; si queda el viejo, hay que borrarlo en el servidor).
- Si el hosting NO ejecuta PHP: avisar; habría que pasar a HTML estático generado (ver `docs/PLAN-DE-TRABAJO.md`, F4.1 opción 2).

## Qué subir y qué NO subir

Subir: `index.php`, `404.php`, `.htaccess`, `robots.txt`, `sitemap.xml`, `site.webmanifest`, `assets/`, `includes/`, `sobre-mi/`, `patologias/`, `tratamientos/`, `cirugia-sin-huellas/`, `equipamiento/`, `contacto/`, `forms/` (con su `.htaccess` que bloquea el acceso; ver abajo).

**NO subir:** `docs/`, `tools/`, `.git/`, `.vscode/`, `.claude/`, `CLAUDE.md`, `.gitignore`, `.editorconfig`, `docs/capturas/`. (El `.htaccess` devuelve 404 para esas rutas por si se suben por error.) Dentro de `assets/vendor/` basta con los archivos `.min.*` y `fonts/` de cada librería; los `.map`, `.rtl`, `.scss`, `.esm`, etc. no se usan.

Además hay que **borrar en el servidor** lo que ya no existe en local: `index.html`, `index_copy.html`, `inner-page.html`, `assets/img/bck/`, `assets/scss/`, `assets/vendor/{fontawesome-free,animate.css,purecounter,boxicons,aos}`, los videos y fotos con nombres viejos (`assets/video/*.mov`, `assets/video/Cirugía*`, `assets/video/Videoendoscopia*`, `assets/img/foto_cv.jpg`, `slide-*.jpg`, `gallery-NN.jpg`, `equipamiento-NN.jpg`, `sin_huellas_*.jpg`).

## Redirección https + www (S7)

`.htaccess` redirige 301 a `https://www.lisandrozenon.com.ar` **solo** cuando el host es `lisandrozenon.com.ar` o `www.lisandrozenon.com.ar` (en local no redirige) y reconoce el https detrás de Cloudflare (`X-Forwarded-Proto` / `CF-Visitor`) para evitar bucles. En Cloudflare usar SSL/TLS en modo **Full (strict)**: si está en “Flexible” el origen recibe http y puede haber bucles.

**Alternativa recomendada (sin tocar el servidor): Cloudflare Redirect Rules**
1. Rules → Redirect Rules → Create rule.
2. “Si el nombre de host es igual a `lisandrozenon.com.ar`” → Redirección dinámica: `concat("https://www.lisandrozenon.com.ar", http.request.uri.path)` (preservar query string), código 301.
3. Además activar “Always Use HTTPS” (SSL/TLS → Edge Certificates).
Si se usan las reglas de Cloudflare, el bloque de rewrite del `.htaccess` queda redundante pero inofensivo.

## robots.txt gestionado por Cloudflare

Hoy Cloudflare sirve un `robots.txt` **gestionado** (señales de contenido para IA) y no referencia el sitemap. El `robots.txt` del repo (con `Sitemap:` y `Disallow: /forms/`) solo se verá si Cloudflare no lo sobrescribe. Revisar en el panel: *Security → Settings → “Manage your robots.txt”* (o *AI Crawl Control*). Opciones: desactivar la gestión (se sirve el del origen) o dejar la gestionada con las directivas del repo agregadas. Verificar luego en `https://www.lisandrozenon.com.ar/robots.txt` que aparezca la línea `Sitemap:`.

## Cache

`style.css` y `main.js` se cargan con `?v=AAAAMMDD` (`includes/config.php` → `assets_v`). Al modificarlos, cambiar ese valor. Si Cloudflare cachea HTML o assets, purgar la caché después de subir.

## Formularios

No hay formulario (se prioriza WhatsApp). `forms/` queda con un `.htaccess` que bloquea el acceso (`Require all denied`) y `robots.txt` los excluye. `assets/vendor/php-email-form/` se conserva sin uso.

## Checklist de Google (después del deploy)

- [ ] **Search Console**: agregar la propiedad (dominio `lisandrozenon.com.ar` por DNS en Cloudflare) y **enviar `https://www.lisandrozenon.com.ar/sitemap.xml`**.
- [ ] Inspeccionar la URL de la home y pedir indexación; revisar “Páginas” e “Indexación” a la semana.
- [ ] **Perfil de Empresa de Google (Google Business Profile)**: crear/reclamar un perfil por consultorio (Imágenes Médicas Dr. Danura, Sanatorio San Roque) con dirección, teléfono, horarios y link al sitio. Es lo que más pesa en “cirujano en Goya”.
- [ ] Probar con https://search.google.com/test/rich-results la home y una página de patología (datos estructurados `Physician`, `MedicalCondition`, `BreadcrumbList`).
- [ ] Probar el enlace compartido en WhatsApp/Facebook (Open Graph; si no se actualiza, usar el depurador de Facebook para limpiar su caché).
- [ ] Google Analytics (`G-041SV6FCC1`): verificar que lleguen visitas y los eventos `contact` (WhatsApp, teléfono, email). En local el script de GA no se carga (solo en producción).
- [ ] Confirmar en https://www.lisandrozenon.com.ar/ruta-inexistente que responde **404** con la página propia.
