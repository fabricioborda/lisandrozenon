<?php
require_once __DIR__ . '/../includes/functions.php';
$title = 'Equipamiento e instrumental | Dr. Lisandro Zenón, Goya';
$description = 'Equipamiento e instrumental de cirugía laparoscópica, cirugía sin huellas y videoendoscopia digestiva utilizado por el Dr. Lisandro Zenón en Goya, Corrientes.';
$canonical = '/equipamiento/';
$nav = 'equipamiento';
$sliders = true;
$equip = require __DIR__ . '/../includes/equipamiento.php';
$crumbs = [['Inicio', '/'], ['Equipamiento', $canonical]];
$jsonLd = [schema_breadcrumb($crumbs)];
require __DIR__ . '/../includes/head.php';
require __DIR__ . '/../includes/header.php';
?>
  <main id="main">
<?php require __DIR__ . '/../includes/breadcrumb.php'; ?>
    <section id="equipamiento2" class="section">
      <div class="container">
        <h1 class="page-title">Equipamiento e instrumental utilizado</h1>
        <div class="gallery-equipamiento2 swiper" role="region" aria-label="Equipamiento e instrumental">
          <div class="swiper-wrapper">
<?php foreach ($equip as $i => [$f, $alt, $cap]): $src = '/assets/img/equipamiento/' . $f . '.jpg'; ?>
            <div class="swiper-slide">
              <a class="gallery-lightbox" href="<?= h($src) ?>" aria-label="Ampliar imagen: <?= h($alt) ?>"><?= picture($src, $alt, ['class' => 'img-fluid', 'priority' => $i < 1]) ?></a>
              <p class="equip-caption"><?= h($cap) ?></p>
            </div>
<?php endforeach; ?>
          </div>
          <div class="swiper-pagination"></div>
          <button type="button" class="swiper-btn swiper-btn-prev" aria-label="Anterior"><?= icono('chevron-left') ?></button>
          <button type="button" class="swiper-btn swiper-btn-next" aria-label="Siguiente"><?= icono('chevron-right') ?></button>
        </div>
<?php require __DIR__ . '/../includes/cta-turno.php'; ?>
      </div>
    </section>
  </main>
<?php require __DIR__ . '/../includes/footer.php'; ?>
