<?php
/** Índice de patologías o tratamientos. La página define $tipo ('patologias'|'tratamientos'). */
require_once __DIR__ . '/functions.php';
$cont = contenido();
$esPat = $tipo === 'patologias';
$base = '/' . $tipo . '/';
$canonical = $base;
$nav = $tipo;
$nombre = $esPat ? 'Patologías frecuentes' : 'Tratamientos que realizo';
$title = $esPat ? 'Patologías frecuentes | Dr. Lisandro Zenón, cirujano en Goya' : 'Tratamientos y cirugías | Dr. Lisandro Zenón, cirujano en Goya';
$description = $esPat
    ? 'Patologías quirúrgicas frecuentes: apendicitis, vesícula, hernias, eventraciones, hemorroides, pólipos y cáncer colorrectal. Dr. Lisandro Zenón, Goya.'
    : 'Tratamientos: videoendoscopia digestiva, cirugía laparoscópica, pared abdominal, anorrectal, oncológica y percutánea. Dr. Lisandro Zenón, Goya, Corrientes.';
$crumbs = [['Inicio', '/'], [$esPat ? 'Patologías' : 'Tratamientos', $base]];
$jsonLd = [schema_breadcrumb($crumbs)];
require __DIR__ . '/head.php';
require __DIR__ . '/header.php';
?>
  <main id="main">
<?php require __DIR__ . '/breadcrumb.php'; ?>
    <section class="page-content">
      <div class="container">
        <h1 class="page-title"><?= h($nombre) ?></h1>
        <div class="row g-4">
<?php foreach ($cont[$tipo] as $slug => $d): ?>
          <div class="col-md-6 col-lg-4">
            <a class="topic-card" href="<?= h($base . $slug . '/') ?>">
              <?= icono($d['icono'], 'card-ico') ?>
              <h2><?= h($d['titulo']) ?></h2>
              <p><?= h($d['resumen']) ?></p>
              <span class="more">Leer más <?= icono('arrow-right') ?></span>
            </a>
          </div>
<?php endforeach; ?>
        </div>
<?php require __DIR__ . '/cta-turno.php'; ?>
      </div>
    </section>
  </main>
<?php require __DIR__ . '/footer.php'; ?>
