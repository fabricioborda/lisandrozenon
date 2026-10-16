<?php
require_once __DIR__ . '/../includes/functions.php';
$title = 'Sobre mí: formación y trayectoria | Dr. Lisandro Zenón, Goya';
$description = 'Formación profesional y académica del Dr. Lisandro Zenón: Médico, especialista en Cirugía General, postgrado en Endoscopia Digestiva, docente de CENCIL UNNE.';
$canonical = '/sobre-mi/';
$nav = 'sobre-mi';
$sliders = true;
$crumbs = [['Inicio', '/'], ['Sobre mí', $canonical]];
$jsonLd = [schema_breadcrumb($crumbs), schema_medico()];
$galeria = [
    ['curso-cencil-grupo', 'Grupo del curso en el Centro de Entrenamiento en Laparoscopia'],
    ['lisandro-endoscopia-quirofano', 'Dr. Lisandro Zenón junto a una torre de endoscopia'],
    ['congreso-argentino-cirugia', 'Dr. Lisandro Zenón en el 90° Congreso Argentino de Cirugía'],
    ['equipo-cirugia-uniformes-bordo', 'Equipo de cirugía junto a cartelería de la facultad'],
    ['asistentes-congreso-cirugia', 'Asistentes a un congreso de cirugía'],
    ['cirujanos-en-jornada', 'Cirujanos durante una jornada de capacitación'],
    ['exposicion-videoendoscopia', 'Exposición con proyección de video de cirugía'],
    ['practica-endoscopia-cencil', 'Práctica de endoscopia en CENCIL'],
    ['sala-entrenamiento-laparoscopia', 'Sala de entrenamiento en laparoscopia'],
    ['equipo-practica-laparoscopia', 'Equipo en práctica de laparoscopia'],
    ['cencil-facultad-medicina', 'Centro de Entrenamiento de la Facultad de Medicina'],
    ['grupo-curso-cirugia', 'Grupo de participantes de un curso de cirugía'],
    ['clase-cirugia-pantalla', 'Clase de cirugía con proyección en pantalla'],
];
require __DIR__ . '/../includes/head.php';
require __DIR__ . '/../includes/header.php';
?>
  <main id="main">
<?php require __DIR__ . '/../includes/breadcrumb.php'; ?>
    <section id="acercademi" class="section">
      <div class="container">
        <h1 class="page-title">Dr. Lisandro Benjamín Zenón</h1>
        <p class="center lead">Formación profesional y académica</p>
        <div class="row g-4 g-lg-5 mt-1">
          <div class="col-md-5 col-lg-4">
            <?= picture('/assets/img/dr-lisandro-zenon.jpg', 'Retrato del Dr. Lisandro Zenón', ['class' => 'img-fluid rounded-card', 'priority' => true]) ?>
          </div>
          <div class="col-md-7 col-lg-8">
            <ol class="timeline">
              <li><span class="t-year">2004/2009</span><strong>Médico</strong><span>Facultad de Medicina de la Universidad Nacional del Nordeste. Corrientes.</span></li>
              <li><span class="t-year">2010/2014</span><strong>Residente de Cirugía General</strong><span>Hospital Escuela “Gral. José F. De San Martín”. Corrientes.</span></li>
              <li><span class="t-year">Agosto 2015</span><strong>Postgrado en Endoscopia Digestiva Diagnóstica y Terapéutica</strong><span>Federación Argentina de Asociaciones de Endoscopia Digestiva FAAED - Universidad Nacional de La Plata.</span></li>
            </ol>

            <h2 class="h4 mt-4">Docencia</h2>
            <ul class="icon-list">
              <li><?= icono('mortarboard') ?><span>Director del Curso “Cirugía sin Huellas” – CENCIL UNNE, Corrientes. Formación de cirujanos en técnicas mínimamente invasivas.</span></li>
              <li><?= icono('mortarboard') ?><span>Instructor de Endoscopía Digestiva, Cirugía Laparoscópica de Colon y Cirugía mínimamente invasiva en CENCIL UNNE Corrientes. Facultad de Medicina.</span></li>
              <li><?= icono('mortarboard') ?><span>Instructor de Residentes en la Especialidad de Cirugía General en Hospital Regional Goya.</span></li>
              <li><?= icono('mortarboard') ?><span>Jefe de Trabajos Prácticos en materia Instructor de Cirugía en la Universidad Barceló.</span></li>
            </ul>

            <h2 class="h4 mt-4">Sociedades científicas</h2>
            <ul class="icon-list">
              <li><?= icono('award') ?><span>Miembro titular de la Asociación Argentina de Cirugía (desde octubre de 2015). Avalado como Médico Especialista en “Cirugía General” por dicha institución.</span></li>
              <li><?= icono('award') ?><span>Miembro de la Sociedad Argentina de Coloproctología.</span></li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <section id="gallery" class="section section-alt">
      <div class="container">
        <h2 class="section-title center">Galería de imágenes</h2>
        <div class="gallery-slider swiper" role="region" aria-label="Galería de imágenes">
          <div class="swiper-wrapper">
<?php foreach ($galeria as $i => [$f, $alt]): $src = '/assets/img/gallery/' . $f . '.jpg'; ?>
            <div class="swiper-slide">
              <a class="gallery-lightbox" href="<?= h($src) ?>" aria-label="Ampliar imagen: <?= h($alt) ?>"><?= picture($src, $alt, ['class' => 'img-fluid']) ?></a>
            </div>
<?php endforeach; ?>
          </div>
          <div class="swiper-pagination"></div>
          <button type="button" class="swiper-btn swiper-btn-prev" aria-label="Imagen anterior"><?= icono('chevron-left') ?></button>
          <button type="button" class="swiper-btn swiper-btn-next" aria-label="Imagen siguiente"><?= icono('chevron-right') ?></button>
        </div>
      </div>
    </section>

    <section class="section">
      <div class="container">
        <h2 class="section-title center">Publicaciones y novedades</h2>
        <p class="center">Encuentre novedades y contenido del Dr. Lisandro Zenón en sus redes sociales.</p>
        <div class="social-buttons">
          <a class="btn-social btn-fb" href="<?= h(cfg('facebook')) ?>" target="_blank" rel="noopener noreferrer"><?= icono('facebook') ?> Facebook</a>
          <a class="btn-social btn-ig" href="<?= h(cfg('instagram')) ?>" target="_blank" rel="noopener noreferrer"><?= icono('instagram') ?> Instagram</a>
        </div>
<?php require __DIR__ . '/../includes/cta-turno.php'; ?>
      </div>
    </section>
  </main>
<?php require __DIR__ . '/../includes/footer.php'; ?>
