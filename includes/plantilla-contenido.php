<?php
/**
 * Plantilla de página de patología/tratamiento.
 * La página que la incluye define: $tipo ('patologias'|'tratamientos') y $slug (clave en includes/contenido.php).
 * Título, descripción, canonical y JSON-LD se arman acá a partir del contenido.
 */
require_once __DIR__ . '/functions.php';
$cont = contenido();
if (!isset($cont[$tipo][$slug])) {
    responder_404();
    require __DIR__ . '/../404.php';
    exit;
}
$d = $cont[$tipo][$slug];
$esPat = $tipo === 'patologias';
$base = '/' . $tipo . '/';
$canonical = $base . $slug . '/';
$nav = $tipo;
$title = $d['titulo'] . ' | Dr. Lisandro Zenón, Goya'; // ≤ 65 caracteres para que Google no lo recorte
$description = $d['desc'];
$ogTitle = $d['titulo'] . ' - Dr. Lisandro Zenón';
$crumbs = [['Inicio', '/'], [$esPat ? 'Patologías' : 'Tratamientos', $base], [$d['titulo'], $canonical]];
$jsonLd = [
    schema_breadcrumb($crumbs),
    [
        '@context' => 'https://schema.org',
        '@type' => $esPat ? 'MedicalCondition' : 'MedicalProcedure',
        'name' => $d['titulo'],
        'description' => $d['desc'],
        'url' => url_abs($canonical),
    ],
];
require __DIR__ . '/head.php';
require __DIR__ . '/header.php';
?>
  <main id="main">
<?php require __DIR__ . '/breadcrumb.php'; ?>
    <section class="page-content">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-9 col-xl-8 prose">
            <h1><?= h($d['titulo']) ?></h1>
<?php if (!empty($d['video'])): ?>
            <figure class="video-box">
              <div class="ratio ratio-16x9">
                <video controls preload="none" playsinline poster="/assets/video/<?= h($d['video']) ?>.jpg" aria-label="<?= h($d['video_titulo'] ?? $d['titulo']) ?>">
                  <source src="/assets/video/<?= h($d['video']) ?>.mp4" type="video/mp4">
                  Su navegador no admite la reproducción de video. <a href="/assets/video/<?= h($d['video']) ?>.mp4">Descargar el video</a>.
                </video>
              </div>
            </figure>
<?php endif; ?>
<?php foreach ($d['secciones'] as [$h2, $html]): ?>
<?php if ($h2): ?>
            <h2><?= h($h2) ?></h2>
<?php endif; ?>
            <?= $html . "\n" ?>
<?php endforeach; ?>
<?php if (!empty($d['imagen'])): ?>
            <figure class="figure-img-box">
              <?= picture($d['imagen'][0], $d['imagen'][1], ['class' => 'img-fluid']) ?>
              <figcaption><?= h($d['imagen'][2]) ?></figcaption>
            </figure>
<?php endif; ?>
<?php if (!empty($d['equipo_hd'])): $torre = require __DIR__ . '/torre-hd.php'; ?>
            <a class="equip-feature" href="<?= h($torre['url']) ?>">
              <?= picture($torre['foto_torre'][0], $torre['foto_torre'][1]) ?>
              <span><small>Equipamiento</small><strong><?= h($torre['equipo']) ?></strong>Imagen en alta definición, cromoendoscopia virtual e insuflación con CO₂. Ver el equipo <?= icono('arrow-right') ?></span>
            </a>
<?php endif; ?>
<?php require __DIR__ . '/cta-turno.php'; ?>
          </div>
        </div>

<?php
$rel = [];
foreach ($d['rel_pat'] as $s) { $rel[] = ['/patologias/' . $s . '/', $cont['patologias'][$s]['titulo'], 'Patología', $cont['patologias'][$s]['icono']]; }
foreach ($d['rel_trat'] as $s) { $rel[] = ['/tratamientos/' . $s . '/', $cont['tratamientos'][$s]['titulo'], 'Tratamiento', $cont['tratamientos'][$s]['icono']]; }
if ($rel):
?>
        <div class="row justify-content-center">
          <div class="col-lg-9 col-xl-8">
            <h2 class="related-title">Contenido relacionado</h2>
            <div class="row g-3">
<?php foreach ($rel as [$href, $tit, $kind, $ico]): ?>
              <div class="col-sm-6">
                <a class="card-link" href="<?= h($href) ?>">
                  <?= icono($ico, 'card-ico') ?>
                  <span><small><?= h($kind) ?></small><strong><?= h($tit) ?></strong></span>
                </a>
              </div>
<?php endforeach; ?>
            </div>
          </div>
        </div>
<?php endif; ?>
      </div>
    </section>
  </main>
<?php require __DIR__ . '/footer.php'; ?>
