# Plan de trabajo — lisandrozenon.com.ar

> Documento para ser ejecutado por un agente (Claude Sonnet) en Claude Code.
> Auditoría realizada el 2026-10-16 sobre el commit `1dc0c31` (el sitio en producción es idéntico a `index.html` de ese commit).
> Leer también `CLAUDE.md` en la raíz antes de empezar.

---

## 0. Reglas para el agente ejecutor

1. **Trabajar por tareas, en orden.** Cada tarea tiene un ID (`F1.3`, etc.). Hacer un commit por tarea (o por grupo pequeño de tareas de la misma fase) con mensaje `F1.3: <descripción>` en español.
2. **Nunca hacer deploy** a producción ni tocar `.vscode/sftp.json`. No reiniciar ni modificar el contenedor Docker `php80` (lo comparten otros proyectos).
3. **Verificar cada cambio en http://lisandrozenon.local** (el repo está montado en vivo en el contenedor; basta recargar). Mínimo: `curl -s -o /dev/null -w '%{http_code}\n' http://lisandrozenon.local/` y revisar que no haya errores en la consola del navegador (ver §8 "Herramientas").
4. **Contenido médico: no cambiar el significado.** Se permite corregir ortografía, tildes, gramática y HTML. Cualquier cambio de contenido clínico (definiciones, indicaciones, afirmaciones) se **lista para revisión del Dr. Zenón** en `docs/REVISION-MEDICA.md`, no se aplica.
5. **Puntos marcados con 🛑 DECISIÓN** requieren preguntar al usuario antes de ejecutar. Presentar la recomendación indicada y esperar respuesta.
6. **No editar `assets/vendor/`** (librerías de terceros). Si hay que eliminar una librería no usada, se borra la carpeta completa y su `<link>/<script>`.
7. No introducir frameworks, npm ni build steps salvo que se apruebe en la decisión F4.1.
8. Mantener el idioma del sitio en **español (Argentina)**: voseo/“usted” consistente con lo existente (el sitio usa “usted”).
9. Al terminar cada fase, actualizar `CLAUDE.md` si cambió algo de la arquitectura, y marcar las tareas completas en este archivo (`- [x]`).

---

## 1. Hallazgos de la auditoría (resumen)

### Errores de HTML / código
| # | Ubicación | Problema |
|---|---|---|
| E1 | `index.html:2-6` | Tres `<html>` de apertura (uno con `⚡`, comentarios condicionales de IE). Solo el de la línea 6 tiene `lang="es"`. |
| E2 | `index.html:2,6,49,53` | Marcado AMP (`⚡`, `amp-boilerplate`, `v0.js`) en una página que **no es AMP válida** (usa JS propio, Bootstrap, iframes). El boilerplate oculta el `body` hasta 8 s si falla el runtime de AMP. Hay que eliminarlo. |
| E3 | `index.html:114` | `<h2>Tratamientos</span></h2>` — `</span>` huérfano. |
| E4 | `index.html:303-308`, `327-330` | `<ul>` que contienen `<p>` en vez de `<li>`. |
| E5 | `index.html:494-501` | `<ol>` con `<p>` entre los `<li>` (inválido). El `<p>` debe ir dentro del `<li>`. |
| E6 | `index.html:277…457` | Disparadores de acordeón son `<div data-bs-toggle="collapse" href=…>`: no son focusables con teclado, `href` no es válido en `div`, sin `aria-expanded`/`aria-controls`. |
| E7 | `index.html:377` | Video `.mov` declarado como `type="video/mp4"`. |
| E8 | `index.html:376-409` | Videos sin `preload`, `poster`, ni `playsinline`; texto de fallback en inglés. |
| E9 | `index.html:703` | Carga `php-email-form/validate.js` sin que exista ningún formulario. |
| E10 | `index.html:35-36` | Carga Font Awesome (completo) y animate.css: **no se usan** en el HTML. |
| E11 | `index.html:32` | Google Fonts carga 3 familias × ~14 pesos (Open Sans, Roboto, Poppins); se usan pocos. |
| E12 | `assets/css/style.css:929` | `font-family: #4378f4;` (valor inválido; debería ser una fuente). |
| E13 | `style.css` | Secciones del template sin uso: Breadcrumbs, Featured Services, Cta, Counts, Features, Appointments, equipamiento (v1), Testimonials, Doctors, Pricing, Frequently Asked Questions, Contact (revisar cuáles aplican). Estilos de `.patologias` y `.tratamientos` duplicados casi idénticos. |
| E14 | `assets/js/main.js:189-194` | Inicialización del carrusel fuera de la indentación del IIFE, y duplicada con `data-bs-ride="carousel"` + `data-ride="carousel"` (atributo de Bootstrap 4). |
| E15 | `main.js:201` | `new Swiper('.testimonials-slider')` sin markup correspondiente. `new PureCounter()` sin contadores en la página. Bloque comentado de `#inicioCarousel`. |
| E16 | `main.js` swipers | `pagination.el: '.swiper-pagination'` es un selector global; ambos sliders deben usar un selector acotado a su contenedor. `.gallery-equipamiento2` declara `navigation` con botones que no existen en el HTML. |
| E17 | `index.html:64,67,602,607,612` | `target="_blank"` sin `rel="noopener"`. |
| E18 | `index.html:70,597` | `mailto:dr.lisandro.zenon@gmail.com` pero el texto visible dice `dr.lisandrozenon@gmail.com` (en Gmail los puntos son equivalentes, así que llega igual, pero es inconsistente). |
| E19 | `index.html:628,657` | Teléfonos como texto plano; no son links `tel:`. |
| E20 | `index.html:253` | iframe de Facebook con `width="700"` fijo → desborde horizontal en móvil; sin `title`, sin `loading="lazy"`. Atributos obsoletos (`scrolling`, `frameborder`). |
| E21 | `index.html:638,668` | iframes de Google Maps sin `title`. |
| E22 | `index.html:174,232-244,539-575` | Imágenes con `alt=""` o `alt="..."` (carrusel), sin `width/height` (CLS), sin `loading="lazy"`. |
| E23 | `index.html:82` | El `<h1>` es el logo del header (“Dr. Lisandro Zenón \| MÉDICO CIRUJANO”). Jerarquía de headings saltea niveles (`h2` → `h5`, `h6`). |
| E24 | `index.html:118,129,140` | `d-md-none d-sm-block` redundante. |

### Errores de texto (ortografía; NO cambian significado)
“Facultad de **Madicina**” (194) · “Diagnostica” → “Diagnóstica” (185) · “**Ultimas** tendencias” → “Últimas” (136) · “Laparoscopica” → “Laparoscópica” (115, 552) · “Laparosc**í**pica” (548) · “Acuscopica” → “Acuscópica” e “Insiciones mas” → “Incisiones más” (576) · “Pólipos **Colorectales**” → “Colorrectales” (339) · “Cirugía **Anorectal**” → “Anorrectal” (432) · “el protrusión” → “la protrusión” (315) · “pueden prolapso” → “pueden prolapsar” (328) · “Gastrostomias endoscopicas percutanea” → “Gastrostomías endoscópicas percutáneas” (440) · “Yeyunostomias” (444) · “cateter permanante” → “catéter permanente” (452) · “cateter … administar” (453) · “percutanea” (441) · “ecografíca” / “Ecografia” / “tomografia” (460-468) · “para para colocar una cateter” → “para colocar un catéter” (464) · “Qué es la cirugía sin huellas?” → “¿Qué es…?” (491) · “Acerca de Mi” → “Acerca de mí” (87) · “Envia” → “Envía” (70, 73, 597) · “Medico Cirujano” en `<title>` → “Médico” · “Zenon” → “Zenón” (20-21, 631, 660) · “Imágenes Medicas” → “Médicas” (621) · espacios dobles y antes de puntos (453, 460, 464).

### Para revisión médica (NO aplicar; listar en `docs/REVISION-MEDICA.md`)
- `index.html:315`: “Las eventraciones, también conocidas como hernias incisionales **recurrentes**” — la hernia incisional y la eventración suelen considerarse sinónimos; “recurrentes” parece incorrecto. Además, `faq3` define “Hernia incisional” por separado.
- `index.html:416`: “Cirugía de pared abdominal … incluye … diverticulitis complicada y tumores abdominales” — revisar si corresponde a pared abdominal.
- `index.html:434`: “Cirugía anorrectal … técnicas abiertas o laparoscópicas” — revisar.
- `index.html:438-454`: “Cirugía Oncológica” lista gastrostomías, yeyunostomías, biopsias y catéteres; revisar título/agrupación.
- `index.html:428`: usa “nosotros/nuestros pacientes” mientras el resto del sitio está en primera persona del singular.
- Patologías: Apendicitis, Hernias y otros párrafos parecen texto genérico (posible copia de fuentes externas: riesgo de contenido duplicado para SEO). Sugerir que el Dr. personalice.
- Datos a confirmar: horarios, teléfonos, direcciones y si sigue atendiendo en ambos lugares; cuál email mostrar.

### SEO
| # | Problema |
|---|---|
| S1 | Sin Open Graph ni Twitter Cards (al compartir por WhatsApp/Facebook no hay imagen ni descripción). |
| S2 | Sin datos estructurados (schema.org `Physician` / `MedicalClinic`, `MedicalProcedure`, `FAQPage`). |
| S3 | `<meta name="keywords">` (ignorado por Google) y `<meta name="title">` (no estándar) — se pueden eliminar. |
| S4 | `<meta name="description">` débil (“Pagina web perteneciente…”), sin ubicación. Debería incluir “Goya, Corrientes”. |
| S5 | `<title>` sin tildes ni ubicación. |
| S6 | `sitemap.xml` tiene una URL basura (`https://www.lisandrozenon.com.ar/.`), `lastmod` de 2024 y comentario del generador. |
| S7 | Producción: `http://lisandrozenon.com.ar/` y `https://lisandrozenon.com.ar/` responden **200 sin redirigir** a `https://www.` → contenido duplicado. Se corrige con `.htaccess` (si el hosting es Apache) **o** en Cloudflare (regla de redirección). |
| S8 | `robots.txt` en producción lo genera Cloudflare (señales de contenido para IA); no referencia el sitemap. Crear `robots.txt` propio con `Sitemap:`. 🛑 Confirmar con el usuario si Cloudflare lo sobrescribe. |
| S9 | Single page: todas las patologías/tratamientos comparten una sola URL. Para crecer en contenido y posicionar búsquedas tipo “cirugía de vesícula Goya”, cada patología/tratamiento necesita **su propia página** (ver Fase 4). |
| S10 | Contenido dentro de acordeones colapsados y el `<h1>` no describe la página. |
| S11 | Sin página 404 propia. |
| S12 | Sin `apple-touch-icon` enlazado (existe el archivo), sin `theme-color`, sin `manifest`. |
| S13 | Videos e imágenes sin nombres/alt descriptivos. |

### Rendimiento
| # | Problema |
|---|---|
| P1 | **Videos: 193 MB** en `assets/video/` (dos de ~80 MB, uno `.mov` que Chrome/Firefox no siempre reproducen). Servidos directo desde el hosting, sin `preload="none"`. |
| P2 | **`assets/img/bck/`: ~30 MB** de originales de cámara (IMG_*.jpg, WhatsApp…) versionados en git y publicados. Copias “`* - copia.jpg`” en `slide/` y `gallery/`. |
| P3 | Imágenes del template sin uso: `about.jpg`, `departments-5.jpg`, `features.jpg`, `tratamiento-1..4.jpg`, `doctors/`, `testimonials/`, `logo.png` (verificar con grep antes de borrar). |
| P4 | Sin WebP/AVIF ni `srcset`; galería carga 13 imágenes de 100-250 KB de una. |
| P5 | 9 hojas CSS + 6 scripts bloqueantes en `<head>`/fin de body; dos librerías de íconos (Bootstrap Icons y Boxicons) usadas en simultáneo; Font Awesome cargado sin uso. |
| P6 | Preloader de pantalla completa que bloquea el contenido hasta `window.load` (incluye iframe de Facebook y mapas). |

### Usabilidad / Accesibilidad
| # | Problema |
|---|---|
| U1 | En móvil, el carrusel oculta títulos y textos (`d-none d-md-block`): solo queda un botón. |
| U2 | No hay CTA principal claro para **pedir turno** (WhatsApp). El WhatsApp del topbar se oculta en desktop (`d-md-none`). Falta botón flotante de WhatsApp. |
| U3 | Acordeones no operables con teclado (E6). |
| U4 | Contraste: texto `#4378f4` sobre blanco ≈ 3.9:1 (no cumple AA para texto normal). Verificar el resto. |
| U5 | El autoplay del carrusel y sliders no se pausa con `prefers-reduced-motion`. |
| U6 | Feed de Facebook embebido: pesado, rompe layout en móvil, y depende de cookies de terceros. |
| U7 | Sección "Cirugía sin huellas" ocupa `col-md-8` sin imagen; se ve vacía a la derecha. |
| U8 | Footer mínimo: sin datos de contacto, matrícula, links ni año. |
| U9 | Sección "Acerca de mí": CV en lista de `h5`/`p` con mucho texto; la foto no tiene alt. |

---

## 2. Fase 1 — Limpieza y normalización del código (sin cambios visuales)

Objetivo: HTML válido, sin código muerto, sin cambios visibles para el usuario final. Al terminar, el sitio debe verse **igual** que antes (comparar capturas antes/después, ver §8).

- [x] **F1.0 Línea base.** Antes de tocar nada: tomar capturas de pantalla de http://lisandrozenon.local a 375 px, 768 px y 1440 px de ancho (ver §8), guardarlas en `docs/capturas/antes/` (agregar `docs/capturas/` a `.gitignore`). Correr el validador HTML y Lighthouse y guardar los resultados en `docs/auditoria/antes/` para comparar al final.
- [x] **F1.1 Encabezado HTML.** Reemplazar líneas 1-6 por `<!doctype html>` + `<html lang="es-AR">`. Eliminar comentarios condicionales de IE y la clase `no-js`.
- [x] **F1.2 Quitar AMP.** Eliminar `⚡`, el `<style amp-boilerplate>`, su `<noscript>` y `<script src="https://cdn.ampproject.org/v0.js">`.
- [x] **F1.3 Orden del `<head>`.** `meta charset` debe ser lo primero dentro de `<head>`, luego `viewport` (`width=device-width, initial-scale=1`), `title`, `description`, `canonical`, preconnects, CSS, y el gtag al final del head. Eliminar `<meta name="title">` y `<meta name="keywords">`.
- [x] **F1.4 Corregir HTML inválido.** E3 (`</span>` huérfano), E4 (`<ul>` con `<p>` → `<li>` con `<strong>` en vez de `<b>`), E5 (`<p>` dentro de cada `<li>` del `<ol>`), E24. Reemplazar los `<br/>` de separación entre bloques de tratamientos por margen CSS.
- [x] **F1.5 Acordeones accesibles (E6).** Convertir cada disparador en: (hecho de otra forma: los acordeones se reemplazaron por páginas propias por patología/tratamiento, Fase 4; ya no hay acordeones).
  ```html
  <button class="question collapsed" type="button" data-bs-toggle="collapse"
          data-bs-target="#faq1" aria-expanded="false" aria-controls="faq1">
    Apendicitis <i class="bi bi-chevron-down icon-show" aria-hidden="true"></i><i class="bi bi-chevron-up icon-close" aria-hidden="true"></i>
  </button>
  ```
  Ajustar CSS para que el `<button>` se vea igual que el `div` (reset: `background:none; border:0; width:100%; text-align:left; padding…`). Probar que abre/cierra con Enter/Espacio y que solo uno queda abierto (`data-bs-parent`).
- [x] **F1.6 Links externos.** Agregar `rel="noopener noreferrer"` a todo `target="_blank"`. Unificar el email (🛑 DECISIÓN menor: preguntar qué dirección mostrar; por defecto usar `dr.lisandrozenon@gmail.com` en `href` y texto). Convertir teléfonos en `<a href="tel:+543777246631">03777 24-6631</a>` y `<a href="tel:+543777421756">03777 42-1756</a>`.
- [x] **F1.7 iframes.** Agregar `title` descriptivo a los 3 iframes y `loading="lazy"`. Facebook: quitar `scrolling`/`frameborder`, usar `width="100%"`/contenedor responsive (o ver F3.8).
- [x] **F1.8 Texto y ortografía.** Aplicar la lista de "Errores de texto" del §1. Fallback de `<video>` en español. Corregir comentarios HTML (“Cigia”, “formacion Us”, “End Gallery Section” en equipamiento).
- [x] **F1.9 `docs/REVISION-MEDICA.md`.** Crear el archivo con los puntos de "Para revisión médica", cada uno con línea, texto actual y la duda. No modificar esos textos.
- [x] **F1.10 Dependencias no usadas.** Verificar con `grep` y luego eliminar: Font Awesome (`assets/vendor/fontawesome-free`), animate.css, PureCounter, `php-email-form/validate.js` (sacar el `<script>`; la carpeta queda por si se usan los forms). Unificar íconos en **Bootstrap Icons**: reemplazar los `bx bx-*` / `bx bxl-*` de la sección contacto por equivalentes (`bi-envelope`, `bi-facebook`, `bi-instagram`, `bi-whatsapp`, `bi-geo-alt`, `bi-telephone`, `bi-calendar`) y luego eliminar Boxicons.
- [x] **F1.11 Google Fonts.** Reducir a lo que realmente se usa (revisar `font-family` y `font-weight` en `style.css`). Usar la API `css2` con `display=swap` y `<link rel="preconnect">` a `fonts.googleapis.com` y `fonts.gstatic.com` (crossorigin).
- [x] **F1.12 Limpieza de `main.js`.** Eliminar: slider de testimonios, `PureCounter`, bloque comentado de `#inicioCarousel`, `navigation` del swiper de equipamiento (o agregar los botones si se decide en F3). Mover la inicialización del carrusel dentro del IIFE (o eliminarla y dejar solo `data-bs-ride="carousel" data-bs-interval="5000"`; sacar `data-ride`). Acotar `pagination.el` a cada contenedor (`'.gallery-slider .swiper-pagination'`, `'.gallery-equipamiento2 .swiper-pagination'`). Agregar al principio un guard para inicializar cada librería solo si existe su elemento (necesario para Fase 4, páginas sin galería). (main.js reescrito desde cero: sin Bootstrap JS ni AOS; hero propio; sliders con guards).
- [x] **F1.13 Limpieza de `style.css`.** (a) Corregir `font-family: #4378f4` (línea 929) → la fuente correspondiente (probablemente `"Poppins", sans-serif`; comparar con `.tratamientos .question`). (b) Eliminar secciones de estilos del template que no corresponden a ningún selector usado en `index.html`/`inner-page.html` (verificar cada una con grep). (c) Unificar estilos duplicados de `.patologias`/`.tratamientos` en una clase común (p. ej. `.accordion-list`). (d) Introducir **variables CSS** en `:root` para colores y fuentes (`--color-primary: #4378f4; --color-accent: #65c9cd; --color-text: #444; --font-body; --font-heading`…) y reemplazar los valores hardcodeados (hay 66 ocurrencias de `#4378f4`). Ordenar el archivo por sección del sitio con encabezados de comentario. (style.css reescrito con variables CSS y solo los estilos usados).
- [x] **F1.14 Archivos huérfanos.** Con el usuario (🛑 DECISIÓN: confirmar que se pueden borrar), eliminar del repo: `index_copy.html`, `inner-page.html` (o conservar como base para Fase 4), `assets/img/bck/` (**mover los originales a un lugar fuera del repo antes**, ej. `~/proyectos/lisandrozenon-originales/`), los `* - copia.jpg`, imágenes del template sin uso (P3), `assets/scss/` (solo tiene un readme). Nota: borrarlos del árbol no reduce el historial de git; no reescribir historial sin permiso. (bck movido a ~/proyectos/lisandrozenon-originales/; resto borrado).
- [x] **F1.15 Formato.** Indentación consistente de 2 espacios en `index.html`, `main.js` y `style.css`. Agregar `.editorconfig` (utf-8, lf, 2 espacios, final newline). No reformatear vendor.
- [x] **F1.16 Verificación de fase.** Validador HTML sin errores (warnings aceptables documentados). Consola del navegador sin errores. Capturas comparadas con F1.0: sin diferencias visibles salvo íconos de contacto (cambio de librería) y foco visible en acordeones.

---

## 3. Fase 2 — SEO técnico y de contenido

- [x] **F2.1 Title y description.**
  - `<title>Dr. Lisandro Zenón | Cirujano General y Laparoscópico en Goya, Corrientes</title>` (≤ 60-65 caracteres; ajustar).
  - `<meta name="description" content="Cirujano general en Goya, Corrientes. Cirugía laparoscópica, cirugía sin huellas, videoendoscopia digestiva y cirugía colorrectal. Consultorios en Sanatorio San Roque e Imágenes Médicas Dr. Danura.">` (≤ 155-160 caracteres; ajustar).
- [x] **F2.2 Headings.** Un solo `<h1>` con contenido descriptivo. Opción recomendada: el logo del header pasa a ser `<a class="logo">` (no heading) y el `<h1>` va en el hero: “Dr. Lisandro Zenón — Médico Cirujano en Goya, Corrientes” (visible en móvil también). Jerarquía: `h2` por sección, `h3` para subtítulos (CV: “Médico (2004/2009)” etc. pasan de `h5` a `h3`/`h4` con estilos que mantengan el tamaño), `h6` de cirugía sin huellas → `h3`.
- [x] **F2.3 Open Graph / Twitter.** `og:type=website`, `og:locale=es_AR`, `og:site_name`, `og:title`, `og:description`, `og:url`, `og:image` (crear una imagen 1200×630 a partir de `slide-5.jpg` o la foto del CV con ImageMagick, guardarla en `assets/img/og-image.jpg`, <300 KB), `twitter:card=summary_large_image`.
- [x] **F2.4 Datos estructurados (JSON-LD)** en `<head>`: (FAQPage omitido a propósito; JSON-LD generado y con sintaxis válida, pero NO se pegó en validator.schema.org: verificar con Rich Results Test tras el deploy).
  - `Physician` (o `["Physician","MedicalBusiness"]`) con `name`, `url`, `image`, `email`, `telephone`, `medicalSpecialty: "Surgical"`, `sameAs` (Facebook, Instagram), `address` y `areaServed` (Goya, Corrientes, AR).
  - Dos `hospitalAffiliation`/`location` (`MedicalClinic`) con dirección, teléfono, `openingHoursSpecification` (Lun-Vie 08-12 San Roque; Lun-Vie 16-20 Danura) y `geo` (coordenadas de los iframes de Maps: San Roque ≈ -29.1399, -59.2674; Danura ≈ -29.1532, -59.2625 — verificar).
  - `FAQPage` **solo** si el contenido de patologías se reformula como preguntas; si no, omitir.
  - Validar con https://validator.schema.org (pegar el JSON-LD) y dejar constancia en el commit.
- [x] **F2.5 Imágenes.** `alt` descriptivo en español en todas las imágenes de contenido (carrusel, foto CV: “Dr. Lisandro Zenón”, galería, equipamiento — usar el pie de foto como base). Renombrar archivos con nombres descriptivos en kebab-case (ej. `torre-laparoscopia.jpg`) actualizando referencias.
- [x] **F2.6 Videos.** Renombrar a kebab-case sin espacios ni tildes (`videoendoscopia-digestiva-alta.mp4`…). Ver P1 en Fase 3 para compresión. Agregar `poster`.
- [x] **F2.7 `sitemap.xml`.** Reescribir limpio: solo URLs canónicas reales, `lastmod` actual, sin `priority` inventada ni comentario del generador. Se regenera en Fase 4 con cada página nueva.
- [x] **F2.8 `robots.txt`.** Crear en la raíz:
  ```
  User-agent: *
  Allow: /
  Disallow: /forms/
  Sitemap: https://www.lisandrozenon.com.ar/sitemap.xml
  ```
  🛑 DECISIÓN: avisar al usuario que hoy Cloudflare sirve un `robots.txt` gestionado; debe revisar en el panel de Cloudflare (“Managed robots.txt”) si se combina o reemplaza.
- [x] **F2.9 Redirecciones canónicas (S7).** Crear `.htaccess` (el contenedor local tiene `AllowOverride All`, se puede probar): (.htaccess creado; redirección solo para el dominio de producción; alternativa Cloudflare en docs/DEPLOY.md).
  - Forzar `https` y `www` con 301 (en local, condicionar para no romper `lisandrozenon.local`: aplicar solo si `HTTP_HOST` es `lisandrozenon.com.ar` o `www.lisandrozenon.com.ar`; respetar `X-Forwarded-Proto`/`CF-Visitor` por Cloudflare para evitar bucles).
  - `ErrorDocument 404 /404.html`.
  - Cache headers para assets estáticos (`mod_expires`: imágenes/videos/fuentes 1 año, CSS/JS 1 mes — si se versionan con `?v=`), compresión (`mod_deflate`) y `Options -Indexes`.
  - 🛑 DECISIÓN: preguntar al usuario si el hosting de producción es Apache con `.htaccess` habilitado; si no, documentar la alternativa en Cloudflare (Redirect Rules) en `docs/DEPLOY.md`.
- [x] **F2.10 Página 404.** `404.html` con el mismo header/footer, mensaje y links a inicio/contacto; `<meta name="robots" content="noindex">`.
- [x] **F2.11 Íconos.** Enlazar `apple-touch-icon.png`, agregar `<meta name="theme-color" content="#4378f4">`. Opcional: `site.webmanifest` mínimo.
- [x] **F2.12 Analytics.** Mantener gtag `G-041SV6FCC1`. Agregar eventos de conversión: clic en WhatsApp, `tel:`, `mailto:` (`gtag('event','contact',{method:'whatsapp'})`) desde `main.js` usando delegación de eventos sobre `a[href^="https://wa.me"]`, `a[href^="tel:"]`, `a[href^="mailto:"]`.
- [x] **F2.13 Verificación.** Lighthouse SEO ≥ 95. Revisar con `curl` que `<title>`, `description`, OG y JSON-LD estén en el HTML servido. Dejar una lista para el usuario: dar de alta/verificar el sitio en **Google Search Console** y enviar el sitemap; crear/reclamar el **Perfil de Empresa de Google** (Google Business Profile) para cada consultorio — es lo que más pesa para búsquedas locales (“cirujano en Goya”).

---

## 4. Fase 3 — Rendimiento, estética y usabilidad

### Rendimiento
- [x] **F3.1 Videos (P1).** 🛑 DECISIÓN: opciones — (opción b, ffmpeg: 193 MB -> 24 MB; ver tools/comprimir-videos.sh).
  (a) **Recomendada:** subir los videos a YouTube (canal del Dr., “no listado” o público) y embeber con *lite embed* (thumbnail + iframe al hacer clic, `youtube-nocookie.com`). Ventajas: streaming adaptativo, 0 MB en el hosting, SEO en YouTube.
  (b) Comprimir con ffmpeg a H.264 720p, CRF 26-28, `-movflags +faststart`, audio AAC 96k o sin audio (objetivo < 10-15 MB c/u); convertir el `.mov` a `.mp4`; `preload="none"` + `poster`. Requiere instalar `ffmpeg` (no está instalado: pedirle al usuario `sudo apt install ffmpeg`).
- [x] **F3.2 Imágenes (P4).** Con ImageMagick/cwebp (instalados): generar WebP (calidad ~80) y redimensionar a un máximo de 1600 px (slides) / 1200 px (galería y equipamiento); servir con `<picture>` + fallback JPG, `width`/`height` reales, `loading="lazy"` y `decoding="async"` en todo lo que no sea la primera slide (la primera slide: `fetchpriority="high"`, sin lazy). Guardar el script usado en `tools/optimizar-imagenes.sh` para reutilizar al agregar contenido. (WebP + `<picture>` + width/height + lazy; sin srcset múltiples porque las fuentes ya son ≤ 1024 px).
- [x] **F3.3 Preloader (P6).** Eliminar el preloader de pantalla completa (o limitarlo a `DOMContentLoaded`). Con el sitio optimizado no hace falta.
- [x] **F3.4 Carga de JS/CSS.** Scripts con `defer` en `<head>` (o al final del body). Cargar GLightbox/Swiper solo donde se usan. Agregar `?v=AAAAMMDD` a `style.css` y `main.js` para cache busting.
- [x] **F3.5 Verificación.** Lighthouse móvil: Performance ≥ 90, CLS < 0.1, LCP < 2.5 s (en local es optimista; anotar).

### Estética
Mantener la identidad actual (azul `#4378f4` + turquesa `#65c9cd`, tipografías existentes) pero modernizar. Proponer, no imponer: implementar en una rama `rediseno` y mostrar capturas al usuario antes de mergear (🛑 DECISIÓN).
- [x] **F3.6 Sistema visual.** Usar las variables CSS de F1.13. Definir escala tipográfica (`clamp()` para títulos), espaciados consistentes entre secciones (`section { padding-block: clamp(48px, 8vw, 96px) }`), alternar fondo blanco / `#f7fcfc` entre secciones, bordes redondeados y sombras suaves uniformes en cards.
- [x] **F3.7 Hero.** Mostrar título y subtítulo también en móvil (con overlay oscuro degradado para contraste sobre la foto). Agregar el `<h1>` (F2.2) y **dos CTA**: “Pedir turno por WhatsApp” (primario) y “Ver tratamientos” (secundario). Pausar autoplay con `prefers-reduced-motion`. Evaluar reemplazar el carrusel por un hero estático con una sola imagen (mejor LCP y conversión) — proponer al usuario. (se mantuvo el carrusel como fondo rotativo con h1, overlay y 2 CTA; sin flechas, con puntos accesibles; respeta prefers-reduced-motion).
- [x] **F3.8 Acerca de mí.** Convertir el CV en una línea de tiempo (timeline vertical con año + título + institución) y bloques “Docencia” y “Sociedades” como listas con íconos. Alt en la foto. Reemplazar el iframe de Facebook (U6) por botones/links a Facebook e Instagram (o una grilla estática de 3-6 imágenes), 🛑 confirmar con el usuario.
- [x] **F3.9 Patologías y tratamientos.** Mantener acordeón, pero con mejor estilo: cada ítem como card con ícono, título en `--color-primary`, chevron animado, foco visible. Videos dentro de un contenedor `ratio ratio-16x9`. En tratamientos que tienen sub-procedimientos (Oncológica, Percutánea), usar `h4` + lista. (los acordeones pasaron a páginas propias; cards con ícono en índices; videos en ratio 16x9).
- [x] **F3.10 Cirugía sin huellas.** Layout de dos columnas: texto + imagen (`sin_huellas_1.jpg`). Los tres pilares como 3 cards con ícono numerado; beneficios como lista con checks (`bi-check-circle`).
- [x] **F3.11 Equipamiento.** Mostrar el pie de foto siempre legible (debajo de la imagen, no superpuesto). Agregar flechas prev/next accesibles al slider.
- [x] **F3.12 Contacto.** Cards de cada consultorio con: nombre, dirección (link a Google Maps), teléfono (`tel:`), horario, botón “Cómo llegar”. Mapas con *click-to-load* (imagen estática + botón) para no cargar 2 iframes de Google al inicio.
- [x] **F3.13 Footer.** Tres columnas: identidad (nombre, especialidad, **matrícula profesional** — 🛑 pedir el número al usuario; en Argentina es recomendable mostrarla), contacto rápido, redes. Año dinámico o fijo y aviso “La información de este sitio no reemplaza la consulta médica”. (omitido parcialmente: SIN matrícula por decisión del usuario; resto hecho).

### Usabilidad / accesibilidad
- [x] **F3.14 Botón flotante de WhatsApp** visible en todas las resoluciones (abajo a la derecha, por encima del back-to-top; mover back-to-top a la izquierda o arriba). `aria-label="Escribir por WhatsApp"`. Mensaje prellenado: “Hola Dr. Zenón, quisiera solicitar un turno.”
- [x] **F3.15 Navegación.** Link “Saltar al contenido” (`.visually-hidden-focusable`). `aria-label` en el botón de menú móvil (hoy es un `<i>`: convertir a `<button>` con `aria-expanded`). Cerrar el menú móvil con Escape. `scroll-margin-top` en secciones para que el header fijo no tape los títulos.
- [x] **F3.16 Contraste y foco.** Verificar contraste AA de todos los textos (oscurecer el azul para texto, p. ej. `#2f5fd0`, y dejar `#4378f4` para fondos/íconos grandes). Estilo `:focus-visible` claro en links y botones.
- [x] **F3.17 Movimiento.** Respetar `prefers-reduced-motion`: desactivar AOS, autoplay de carrusel y sliders.
- [x] **F3.18 Verificación.** Lighthouse Accesibilidad ≥ 95. Navegar todo el sitio solo con teclado. Capturas en 375/768/1440 px guardadas en `docs/capturas/despues/` y mostradas al usuario. (Lighthouse a11y 100; teclado verificado en menú, submenús, Escape y sliders con pruebas automáticas; capturas en docs/capturas/despues/, no versionadas).

---

## 5. Fase 4 — Estructura para crecer en contenido

El usuario anticipó que el sitio va a crecer. Una sola página no escala (ni para SEO ni para mantenimiento). Esta fase prepara una estructura multipágina.

- [x] **F4.1 🛑 DECISIÓN: tecnología para compartir header/footer entre páginas.** Presentar al usuario: (decisión del usuario: PHP includes; URLs como directorios con index.php).
  1. **PHP includes (recomendada si el hosting de producción ejecuta PHP).** `includes/head.php`, `includes/header.php`, `includes/footer.php`; páginas `.php` con variables `$title`, `$description`, `$canonical`. Funciona igual en el contenedor local (PHP 8.0) sin build. Producción: verificar que `/forms/contact.php` se ejecuta (hoy responde 200; confirmar que no devuelve el código fuente).
  2. **Generador estático (Eleventy)**: plantillas + Markdown, genera HTML plano en `_site/`. Requiere `npm` y un paso de build antes del deploy; el docroot del vhost local debería apuntar a `_site/`.
  3. **HTML duplicado a mano**: no recomendado (cada cambio de menú implica editar N archivos).
- [x] **F4.2 Estructura de URLs** (amigables, sin extensión vía `.htaccess`):
  ```
  /                                   Inicio (resumen de cada sección + CTA)
  /sobre-mi/                          CV completo
  /patologias/                        índice
  /patologias/apendicitis/
  /patologias/calculos-en-la-vesicula/
  /patologias/hernias/
  /patologias/eventraciones/
  /patologias/hemorroides/
  /patologias/polipos-colorrectales/
  /patologias/cancer-de-colon-y-recto/
  /tratamientos/                      índice
  /tratamientos/videoendoscopia-digestiva-alta/
  /tratamientos/videoendoscopia-digestiva-baja/
  /tratamientos/apendicectomia-laparoscopica/
  /tratamientos/colecistectomia-laparoscopica/
  /tratamientos/cirugia-de-pared-abdominal/
  /tratamientos/cirugia-laparoscopica-colorrectal/
  /tratamientos/cirugia-anorrectal/
  /tratamientos/cirugia-oncologica/
  /tratamientos/cirugia-percutanea/
  /cirugia-sin-huellas/
  /equipamiento/
  /contacto/
  ```
  Las anclas actuales (`/#patologias`, etc.) deben seguir funcionando en la home (links externos existentes).
- [x] **F4.3 Plantilla de página de contenido** (patología/tratamiento): breadcrumb (con JSON-LD `BreadcrumbList`), `h1`, intro, secciones (`¿Qué es?`, `Síntomas`, `Diagnóstico`, `Tratamiento`, `Recuperación`), video/imagen si hay, bloque “Patologías/Tratamientos relacionados” (enlazado cruzado: p. ej. Cálculos en la vesícula ↔ Colecistectomía laparoscópica), CTA de turno, fecha de “Última revisión médica”. JSON-LD `MedicalCondition` o `MedicalProcedure` por página. Title/description/canonical/OG propios. (sin “Última revisión médica” ni secciones sin texto existente: no se inventó contenido; ver docs/REVISION-MEDICA.md).
- [x] **F4.4 Migrar contenido existente** de los acordeones a cada página (sin cambiar el texto médico). En la home, los acordeones se reemplazan por grillas de cards con título + resumen de 1-2 líneas + “Leer más”.
- [x] **F4.5 Menú.** Navegación con dropdown en Patologías y Tratamientos; estado activo por página.
- [x] **F4.6 Sitemap.** Regenerar con todas las URLs (si es PHP: script `tools/generar-sitemap.php` o mantener a mano; si es Eleventy: plantilla `sitemap.njk`).
- [x] **F4.7 Guía para agregar contenido.** `docs/AGREGAR-CONTENIDO.md`: paso a paso para crear una nueva patología/tratamiento (copiar plantilla, completar metadatos, optimizar imágenes con `tools/optimizar-imagenes.sh`, agregar al índice, al menú y al sitemap). Actualizar `CLAUDE.md` con la nueva arquitectura.
- [x] **F4.8 Ideas de contenido a futuro** (solo listar en el doc para el usuario, no crear): preguntas frecuentes de pacientes (preparación para endoscopía, qué llevar a la consulta, recuperación post-colecistectomía), obras sociales/prepagas que atiende, testimonios (con consentimiento), novedades/blog.

---

## 6. Fase 5 — Formulario de contacto (opcional)

- [x] **F5.1 🛑 DECISIÓN.** Preguntar si se quiere un formulario de turnos. Los PHP actuales dependen de una librería paga ausente. Alternativas: (a) no tener formulario y priorizar WhatsApp (recomendado para este público); (b) formulario PHP propio con `mail()`/SMTP + honeypot + validación server-side; (c) servicio externo (Formspree, etc.). Si no se quiere, eliminar `forms/` y `assets/vendor/php-email-form/`. (decisión del usuario: opción a, sin formulario; forms/ se conserva bloqueado vía .htaccess y robots.txt).

---

## 7. Orden sugerido y estimación

| Fase | Riesgo | Dependencias |
|---|---|---|
| F1 Limpieza | Bajo (sin cambios visuales) | — |
| F2 SEO | Bajo | F1 |
| F3 Rendimiento | Bajo | F1; decisiones F3.1 |
| F3 Estética/usabilidad | Medio (cambio visual) | F1, F2; aprobación del usuario |
| F4 Multipágina | Alto (cambio de arquitectura) | F1-F3; decisión F4.1 |
| F5 Formulario | Bajo | Decisión F5.1 |

Recomendación: ejecutar F1 completa → mostrar resultado → F2 → F3 (rendimiento) → pedir aprobación del rediseño → F3 (estética) → F4.

---

## 8. Herramientas y verificación

Disponibles en la máquina: `node` 22 / `npx`, ImageMagick 7 (`magick`), `cwebp`, `curl`, `docker`. **No** disponibles: `ffmpeg`, Chrome/Chromium local (se puede usar el que descarga Playwright/Puppeteer vía `npx`).

```bash
# Sitio arriba
curl -s -o /dev/null -w '%{http_code}\n' http://lisandrozenon.local/

# Validación HTML (no requiere instalar nada en el proyecto)
npx --yes html-validate index.html
# o el validador del W3C (sube el HTML a un servicio externo; está bien, el sitio es público)
curl -s -H 'Content-Type: text/html; charset=utf-8' --data-binary @index.html \
  'https://validator.w3.org/nu/?out=gnu'

# Links rotos (internos)
npx --yes linkinator http://lisandrozenon.local/ --skip '^(?!http://lisandrozenon\.local)'

# Lighthouse (descarga Chromium si hace falta)
npx --yes lighthouse http://lisandrozenon.local/ --only-categories=performance,accessibility,best-practices,seo \
  --form-factor=mobile --output=html --output-path=docs/auditoria/lighthouse.html --chrome-flags="--headless"

# Capturas y errores de consola: script con Playwright en tools/capturas.mjs
#   - viewports 375, 768, 1440; fullPage: true
#   - registrar page.on('console') y page.on('pageerror'); fallar si hay errores
npx --yes playwright install chromium
node tools/capturas.mjs docs/capturas/antes
```

Notas:
- `lisandrozenon.local` debe resolver desde el navegador headless; si Chromium no resuelve el host, usar `--host-resolver-rules="MAP lisandrozenon.local 127.0.0.1"`.
- No agregar `node_modules/` ni `package.json` al repo para estas herramientas (usar `npx --yes`). Si hace falta Playwright como dependencia del script, instalarlo en un directorio fuera del repo o agregar `node_modules/` a `.gitignore`.
- Si se agregan herramientas en `tools/`, excluirlas del deploy (documentar en `docs/DEPLOY.md`).

---

## 9. Checklist de entrega por fase

Al cerrar cada fase el agente debe reportar al usuario:
1. Lista de tareas completadas y omitidas (con motivo).
2. Resultados del validador HTML y Lighthouse antes/después.
3. Capturas móvil y desktop.
4. Decisiones pendientes (🛑) que bloquean la siguiente fase.
5. Recordatorio: los cambios están solo en local; el deploy lo hace el usuario.
