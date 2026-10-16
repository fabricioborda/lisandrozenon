<?php
require_once __DIR__ . '/../includes/functions.php';
$title = 'Contacto y lugares de atención | Dr. Lisandro Zenón, Goya';
$description = 'Contacto del Dr. Lisandro Zenón: WhatsApp, teléfonos, horarios y mapas de Imágenes Médicas Dr. Danura y Sanatorio San Roque, en Goya, Corrientes.';
$canonical = '/contacto/';
$nav = 'contacto';
$mapas = true;
$cardHeading = 'h2';
$crumbs = [['Inicio', '/'], ['Contacto', $canonical]];
$jsonLd = [schema_breadcrumb($crumbs), schema_medico()];
require __DIR__ . '/../includes/head.php';
require __DIR__ . '/../includes/header.php';
?>
  <main id="main">
<?php require __DIR__ . '/../includes/breadcrumb.php'; ?>
    <section id="contacto" class="section">
      <div class="container">
        <h1 class="page-title">Canales de contacto y lugares de atención</h1>
        <div class="contact-links">
          <a href="<?= h(wa_url()) ?>" target="_blank" rel="noopener noreferrer"><?= icono('whatsapp') ?> WhatsApp</a>
          <a href="mailto:<?= h(cfg('email')) ?>"><?= icono('envelope') ?> <?= h(cfg('email')) ?></a>
          <a href="<?= h(cfg('facebook')) ?>" target="_blank" rel="noopener noreferrer"><?= icono('facebook') ?> <?= h(cfg('redes_user')) ?></a>
          <a href="<?= h(cfg('instagram')) ?>" target="_blank" rel="noopener noreferrer"><?= icono('instagram') ?> <?= h(cfg('redes_user')) ?></a>
        </div>
<?php require __DIR__ . '/../includes/contacto-cards.php'; ?>
      </div>
    </section>
  </main>
<?php require __DIR__ . '/../includes/footer.php'; ?>
