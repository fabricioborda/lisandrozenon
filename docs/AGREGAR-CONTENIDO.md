# Cómo agregar contenido

El sitio usa **PHP includes** (sin build). Header, menú y footer están en `includes/`; los datos de contacto/horarios en `includes/config.php`; el texto de patologías y tratamientos en `includes/contenido.php`.

## Nueva patología o tratamiento

1. **Imágenes**: copiar el JPG a `assets/img/...` con nombre kebab-case y ejecutar `tools/optimizar-imagenes.sh assets/img/ruta/imagen.jpg` (genera el `.webp`, achica a 1200/1600 px máx.). Los originales de cámara se guardan fuera del repo (`~/proyectos/lisandrozenon-originales/`).
2. **Video** (opcional): `tools/comprimir-videos.sh "original.mov" nombre-en-kebab` → deja `assets/video/nombre.mp4` y `nombre.jpg` (poster). Requiere ffmpeg.
3. **Texto**: en `includes/contenido.php`, dentro de `'patologias'` o `'tratamientos'`, agregar una entrada nueva (copiar una existente). Clave = slug de la URL (kebab-case, sin tildes). Campos: `titulo`, `icono` (de Bootstrap Icons), `resumen` (1-2 líneas para la tarjeta), `desc` (meta description, ≤ 155 caracteres, con “Goya, Corrientes”), `secciones` (`[titulo-h2|null, html]`), `video` / `imagen` (opcionales), `rel_pat` / `rel_trat` (slugs relacionados para el enlazado cruzado).
4. **Página**: crear la carpeta `patologias/<slug>/` (o `tratamientos/<slug>/`) con un `index.php` de 4 líneas, copiando uno existente y cambiando `$slug`:
   ```php
   <?php
   $tipo = 'patologias';
   $slug = 'mi-nueva-patologia';
   require __DIR__ . '/../../includes/plantilla-contenido.php';
   ```
5. El **índice, la home y el menú** se actualizan solos (leen `contenido.php`).
6. **Sitemap**: `docker exec php80 php /var/www/lisandrozenon/tools/generar-sitemap.php` (o `php tools/generar-sitemap.php` si hay PHP local).
7. **Verificar**: abrir la URL en http://lisandrozenon.local, correr `tools/validar.sh /patologias/<slug>/` (0 errores) y revisar la consola.

> Contenido médico: no cambiar el significado de textos existentes sin revisión del Dr. Zenón; anotar dudas en `docs/REVISION-MEDICA.md`.

## Página nueva (no de patología/tratamiento)

Copiar `contacto/index.php` como base: define `$title`, `$description`, `$canonical`, `$nav`, `$jsonLd`, incluye `head.php`, `header.php`, el contenido y `footer.php`. Agregar el link en `includes/header.php` y la URL en `$fijas` de `tools/generar-sitemap.php`.

## Cambiar teléfono, horario, email, redes

Solo en `includes/config.php`. Se refleja en home, contacto, footer y datos estructurados.

## Herramientas (`tools/`, no se suben al servidor)

| Herramienta | Uso |
|---|---|
| `capturas.cjs` | Capturas 375/768/1440 + errores de consola con Playwright. Instalar `playwright` **fuera del repo** (`npm i playwright` en un directorio temporal) y ejecutar `NODE_MODULES_DIR=/tmp/x/node_modules node tools/capturas.cjs docs/capturas/xxx /ruta/ ...`. |
| `validar.sh` | Valida el HTML renderizado con el validador W3C: `tools/validar.sh / /contacto/`. |
| `lighthouse.sh` | Lighthouse móvil (lighthouse instalado fuera del repo; definir `NODE_MODULES_DIR` y `CHROME_PATH`). |
| `optimizar-imagenes.sh` | JPG → WebP y reducción de tamaño (ImageMagick + cwebp). |
| `comprimir-videos.sh` | Comprime video a MP4 720p + poster (ffmpeg). |
| `generar-sitemap.php` | Regenera `sitemap.xml`. |

Links rotos: `npx --yes linkinator http://lisandrozenon.local/ --recurse --skip '^(?!http://lisandrozenon\.local)'`.
