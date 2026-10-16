<?php
require_once __DIR__ . '/../../includes/functions.php';
$torre = require __DIR__ . '/../../includes/torre-hd.php';
$title = 'Videoendoscopia de alta definición en Goya | Dr. Lisandro Zenón';
$description = 'Nueva torre de videoendoscopia SonoScape HD-500: imagen HD, cromoendoscopia virtual VIST e insuflación con CO₂. Dr. Lisandro Zenón, Goya, Corrientes.';
$canonical = $torre['url'];
$nav = 'equipamiento';
$ogImage = $torre['foto'][0];
$crumbs = [['Inicio', '/'], ['Equipamiento', '/equipamiento/'], ['Videoendoscopia de alta definición', $canonical]];
$jsonLd = [schema_breadcrumb($crumbs)];
$preload = ['/assets/img/equipamiento/torre-hd-dr-zenon.webp'];
require __DIR__ . '/../../includes/head.php';
require __DIR__ . '/../../includes/header.php';
?>
  <main id="main">
<?php require __DIR__ . '/../../includes/breadcrumb.php'; ?>
    <section class="section">
      <div class="container">
        <div class="row align-items-center g-4 g-lg-5">
          <div class="col-md-7">
            <p class="eyebrow"><?= icono('stars') ?> Nuevo equipamiento</p>
            <h1 class="page-title text-start"><?= h($torre['titulo']) ?></h1>
            <p class="lead"><?= h($torre['intro']) ?></p>
            <a class="btn-wa btn-wa-lg" href="<?= h(wa_url('Hola Dr. Zenón, quisiera solicitar un turno para una videoendoscopia.')) ?>" target="_blank" rel="noopener noreferrer"><?= icono('whatsapp') ?> Pedir turno para un estudio</a>
          </div>
          <div class="col-md-5">
            <?= picture($torre['foto'][0], $torre['foto'][1], ['class' => 'img-fluid rounded-card img-hd', 'priority' => true]) ?>
          </div>
        </div>
      </div>
    </section>

    <section class="section section-alt">
      <div class="container">
        <h2 class="section-title center">Qué aporta el nuevo equipo</h2>
        <div class="row g-4 align-items-start">
          <div class="col-lg-4">
            <figure class="m-0 hd-figure">
              <?= picture($torre['foto_torre'][0], $torre['foto_torre'][1], ['class' => 'img-fluid rounded-card img-4x5']) ?>
              <figcaption class="figure-note"><?= h($torre['foto_torre'][2]) ?></figcaption>
            </figure>
          </div>
          <div class="col-lg-8">
            <div class="row g-4">
<?php foreach ($torre['caracteristicas'] as [$ico, $tit, $txt]): ?>
              <div class="col-md-6">
                <div class="pillar">
                  <?= icono($ico, 'card-ico') ?>
                  <h3><?= h($tit) ?></h3>
                  <p><?= h($txt) ?></p>
                </div>
              </div>
<?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="section">
      <div class="container">
        <h2 class="section-title center">Estudios que se realizan</h2>
        <div class="row g-3 justify-content-center">
          <div class="col-sm-6 col-lg-4">
            <a class="card-link" href="/tratamientos/videoendoscopia-digestiva-alta/"><?= icono('camera-video', 'card-ico') ?><span><small>Tratamiento</small><strong>Videoendoscopia digestiva alta</strong></span></a>
          </div>
          <div class="col-sm-6 col-lg-4">
            <a class="card-link" href="/tratamientos/videoendoscopia-digestiva-baja/"><?= icono('camera-video', 'card-ico') ?><span><small>Tratamiento</small><strong>Videoendoscopia digestiva baja</strong></span></a>
          </div>
        </div>
        <p class="center mt-4"><a href="/equipamiento/">Ver todo el equipamiento <?= icono('arrow-right') ?></a></p>
<?php $ctaTexto = '¿Necesita un estudio de videoendoscopia?'; require __DIR__ . '/../../includes/cta-turno.php'; ?>
      </div>
    </section>
  </main>
<?php require __DIR__ . '/../../includes/footer.php'; ?>
