<?php
/**
 * <head> común. Variables que define cada página ANTES de incluir:
 *   $title (obligatoria), $description (obligatoria), $canonical (ruta, ej. '/patologias/hernias/'),
 *   $ogImage (ruta, opcional), $ogType (website|article), $robots (opcional, ej. 'noindex'),
 *   $jsonLd (array de bloques JSON-LD, opcional), $preload (rutas de imágenes a precargar, opcional),
 *   $sliders (bool: carga Swiper y GLightbox), $nav (clave del menú activo).
 */
require_once __DIR__ . '/functions.php';
$canonical = $canonical ?? '/';
$ogImage   = $ogImage ?? cfg('og_image');
$ogType    = $ogType ?? 'website';
$jsonLd    = $jsonLd ?? [];
$preload   = $preload ?? [];
$sliders   = $sliders ?? false;
$ogTitle   = $ogTitle ?? $title;
if (es_test()) {
    // Sitio de prueba: que ningún buscador lo indexe
    $robots = 'noindex, nofollow';
    if (!headers_sent()) { header('X-Robots-Tag: noindex, nofollow'); }
}
?>
<!doctype html>
<html lang="es-AR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= h($title) ?></title>
  <meta name="description" content="<?= h($description) ?>">
<?php if (!empty($robots)): ?>
  <meta name="robots" content="<?= h($robots) ?>">
<?php else: ?>
  <link rel="canonical" href="<?= h(url_abs($canonical)) ?>">
<?php endif; ?>
  <meta name="theme-color" content="#05114d">

  <meta property="og:type" content="<?= h($ogType) ?>">
  <meta property="og:locale" content="es_AR">
  <meta property="og:site_name" content="<?= h(cfg('nombre')) ?>">
  <meta property="og:title" content="<?= h($ogTitle) ?>">
  <meta property="og:description" content="<?= h($description) ?>">
  <meta property="og:url" content="<?= h(url_abs($canonical)) ?>">
  <meta property="og:image" content="<?= h(url_abs($ogImage)) ?>">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="630">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?= h($ogTitle) ?>">
  <meta name="twitter:description" content="<?= h($description) ?>">
  <meta name="twitter:image" content="<?= h(url_abs($ogImage)) ?>">

  <link rel="icon" href="/favicon.ico" sizes="any">
  <link rel="icon" href="/assets/img/favicon.png" sizes="32x32" type="image/png">
  <link rel="apple-touch-icon" href="/assets/img/apple-touch-icon.png">
  <link rel="manifest" href="/site.webmanifest">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <!-- Fuentes sin bloquear el render (si falla JS, el noscript las carga normalmente) -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&amp;family=Roboto:wght@500;700&amp;display=swap" media="print" onload="this.media='all'">
  <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&amp;family=Roboto:wght@500;700&amp;display=swap"></noscript>
<?php foreach ($preload as $p): ?>
  <link rel="preload" as="image" href="<?= h($p) ?>" fetchpriority="high"<?= substr($p, -5) === '.webp' ? ' type="image/webp"' : '' ?>>
<?php endforeach; ?>

  <link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="/assets/vendor/bootstrap-icons/bootstrap-icons.min.css">
<?php if ($sliders): ?>
  <link rel="stylesheet" href="/assets/vendor/swiper/swiper-bundle.min.css">
  <link rel="stylesheet" href="/assets/vendor/glightbox/css/glightbox.min.css">
<?php endif; ?>
  <link rel="stylesheet" href="<?= h(asset('/assets/css/style.css')) ?>">

<?php foreach ($jsonLd as $block) { echo '  ' . json_ld($block); } ?>
<?php if (es_produccion()): ?>
  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=<?= h(cfg('ga_id')) ?>"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', '<?= h(cfg('ga_id')) ?>');
  </script>
<?php endif; ?>
</head>
