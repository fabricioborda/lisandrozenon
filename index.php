<?php
require_once __DIR__ . '/includes/functions.php';
$cont = contenido();
$title = 'Dr. Lisandro Zenón | Cirujano General en Goya, Corrientes';
$description = 'Cirujano general en Goya, Corrientes. Cirugía laparoscópica, cirugía sin huellas y videoendoscopia digestiva. Atiende en Sanatorio San Roque y en Dr. Danura.';
$canonical = '/';
$nav = 'home';
$jsonLd = [schema_medico()];
$preload = ['/assets/img/slide/quirofano-laparoscopia.webp'];
$mapas = false;
$equip = require __DIR__ . '/includes/equipamiento.php';
$slides = [
    ['/assets/img/slide/quirofano-laparoscopia.jpg', 'Dr. Lisandro Zenón operando en quirófano con equipo de cirugía laparoscópica'],
    ['/assets/img/slide/formacion-cencil.jpg', 'Grupo de médicos y residentes en el Centro de Entrenamiento en Laparoscopia'],
    ['/assets/img/slide/congreso-cirugia.jpg', 'Dr. Lisandro Zenón en el 90° Congreso Argentino de Cirugía'],
];
require __DIR__ . '/includes/head.php';
require __DIR__ . '/includes/header.php';
?>
  <main id="main">

    <!-- Inicio -->
    <section id="inicio" class="hero" data-hero>
      <div class="hero-slides" aria-hidden="true">
<?php foreach ($slides as $i => [$src, $alt]): ?>
        <div class="hero-slide<?= $i === 0 ? ' is-active' : '' ?>"><?= picture($src, '', ['priority' => $i === 0, 'class' => 'hero-img']) ?></div>
<?php endforeach; ?>
      </div>
      <div class="hero-overlay"></div>
      <div class="container hero-content">
        <h1>Dr. Lisandro Zenón <span>Médico Cirujano</span></h1>
        <p>Cirugía general, Cirugía sin Huellas, laparoscópica y videoendoscopia digestiva en Goya, Corrientes.</p>
        <div class="hero-cta">
          <a class="btn-wa btn-wa-lg" href="<?= h(wa_url()) ?>" target="_blank" rel="noopener noreferrer"><?= icono('whatsapp') ?> Pedir turno por WhatsApp</a>
          <a class="btn-light-outline" href="#tratamientos">Ver tratamientos</a>
        </div>
      </div>
      <div class="hero-dots" role="group" aria-label="Imágenes de portada">
<?php foreach ($slides as $i => [$src, $alt]): ?>
        <button type="button" class="hero-dot<?= $i === 0 ? ' is-active' : '' ?>" aria-label="Mostrar imagen <?= $i + 1 ?>: <?= h($alt) ?>" aria-pressed="<?= $i === 0 ? 'true' : 'false' ?>"></button>
<?php endforeach; ?>
      </div>
    </section>

    <!-- Acerca de mí -->
    <section id="acercademi" class="section">
      <div class="container">
        <div class="row align-items-center g-4 g-lg-5">
          <div class="col-md-5 col-lg-4">
            <?= picture('/assets/img/dr-lisandro-zenon.jpg', 'Retrato del Dr. Lisandro Zenón', ['class' => 'img-fluid rounded-card']) ?>
          </div>
          <div class="col-md-7 col-lg-8">
            <h2 class="section-title">Dr. Lisandro Benjamín Zenón</h2>
            <p class="lead">Médico, especialista en Cirugía General.</p>
            <ul class="check-list">
              <li>Médico (2004/2009), Facultad de Medicina de la Universidad Nacional del Nordeste. Corrientes.</li>
              <li>Residente de Cirugía General (2010/2014), Hospital Escuela “Gral. José F. De San Martín”. Corrientes.</li>
              <li>Miembro titular de la Asociación Argentina de Cirugía (desde octubre de 2015).</li>
              <li>Director del Curso “Cirugía sin Huellas” – CENCIL UNNE, Corrientes.</li>
            </ul>
            <a class="btn-primary-x" href="/sobre-mi/">Ver formación completa <?= icono('arrow-right') ?></a>
          </div>
        </div>
      </div>
    </section>

    <!-- Patologías -->
    <section id="patologias" class="section section-alt">
      <div class="container">
        <h2 class="section-title center">Patologías frecuentes</h2>
        <div class="row g-4">
<?php foreach ($cont['patologias'] as $slug => $d): ?>
          <div class="col-md-6 col-lg-4">
            <a class="topic-card" href="/patologias/<?= h($slug) ?>/">
              <?= icono($d['icono'], 'card-ico') ?>
              <h3><?= h($d['titulo']) ?></h3>
              <p><?= h($d['resumen']) ?></p>
              <span class="more">Leer más <?= icono('arrow-right') ?></span>
            </a>
          </div>
<?php endforeach; ?>
        </div>
      </div>
    </section>

    <!-- Tratamientos -->
    <section id="tratamientos" class="section">
      <div class="container">
        <h2 class="section-title center">Tratamientos que realizo</h2>
        <div class="row g-4">
<?php foreach ($cont['tratamientos'] as $slug => $d): ?>
          <div class="col-md-6 col-lg-4">
            <a class="topic-card" href="/tratamientos/<?= h($slug) ?>/">
              <?= icono($d['icono'], 'card-ico') ?>
              <h3><?= h($d['titulo']) ?></h3>
              <p><?= h($d['resumen']) ?></p>
              <span class="more">Leer más <?= icono('arrow-right') ?></span>
            </a>
          </div>
<?php endforeach; ?>
        </div>
      </div>
    </section>

<?php require __DIR__ . '/includes/torre-hd-destacado.php'; ?>

    <!-- Cirugía sin huellas -->
    <section id="cirugiasinhuellas" class="section section-alt">
      <div class="container">
        <div class="row align-items-center g-4 g-lg-5">
          <div class="col-md-7">
            <h2 class="section-title">Cirugía sin Huellas</h2>
            <h3 class="h5">¿Qué es la cirugía sin huellas?</h3>
            <p>La cirugía sin huellas es una técnica quirúrgica mínimamente invasiva de última generación, que busca obtener los mejores resultados estéticos y funcionales con el menor trauma posible para el paciente.</p>
            <a class="btn-primary-x" href="/cirugia-sin-huellas/">Conocer la técnica <?= icono('arrow-right') ?></a>
          </div>
          <div class="col-md-5">
            <?= picture('/assets/img/equipamiento/instrumental-cirugia-sin-huellas-1.jpg', 'Instrumental de 3 mm para cirugía sin huellas', ['class' => 'img-fluid rounded-card img-4x3']) ?>
          </div>
        </div>
      </div>
    </section>

    <!-- Equipamiento -->
    <section id="equipamiento2" class="section">
      <div class="container">
        <h2 class="section-title center">Equipamiento e instrumental utilizado</h2>
        <div class="equip-grid">
<?php
// La torre nueva va destacada en vertical (foto original 3:4, se ven monitor y equipos); las otras 4 en 2x2.
$fotosHome = ['equipamiento-laparoscopia', 'ligasure-valleylab-ls10', 'camara-full-hd', 'torre-laparoscopia'];
$equipHome = array_merge([['torre-hd-instalada', 'Torre de videoendoscopia de alta definición SonoScape HD-500', '']],
    array_values(array_filter($equip, fn($e) => in_array($e[0], $fotosHome, true))));
foreach ($equipHome as $i => [$f, $alt, $cap]): ?>
          <figure class="equip-thumb<?= $i === 0 ? ' is-featured' : '' ?>">
            <?= picture('/assets/img/equipamiento/' . $f . '.jpg', $alt, ['class' => 'img-fluid']) ?>
<?php if ($i === 0): ?>
            <figcaption>Nueva torre de videoendoscopia HD</figcaption>
<?php endif; ?>
          </figure>
<?php endforeach; ?>
        </div>
        <p class="center mt-4"><a class="btn-primary-x" href="/equipamiento/">Ver todo el equipamiento <?= icono('arrow-right') ?></a></p>
      </div>
    </section>

    <!-- Contacto -->
    <section id="contacto" class="section section-alt">
      <div class="container">
        <h2 class="section-title center">Canales de contacto y lugares de atención</h2>
        <div class="contact-links">
          <a href="<?= h(wa_url()) ?>" target="_blank" rel="noopener noreferrer"><?= icono('whatsapp') ?> WhatsApp</a>
          <a href="mailto:<?= h(cfg('email')) ?>"><?= icono('envelope') ?> <?= h(cfg('email')) ?></a>
          <a href="<?= h(cfg('facebook')) ?>" target="_blank" rel="noopener noreferrer"><?= icono('facebook') ?> <?= h(cfg('redes_user')) ?></a>
          <a href="<?= h(cfg('instagram')) ?>" target="_blank" rel="noopener noreferrer"><?= icono('instagram') ?> <?= h(cfg('redes_user')) ?></a>
        </div>
<?php require __DIR__ . '/includes/contacto-cards.php'; ?>
        <p class="center mt-4"><a class="btn-outline" href="/contacto/">Ver mapas y más información</a></p>
      </div>
    </section>

  </main>
<?php require __DIR__ . '/includes/footer.php'; ?>
