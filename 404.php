<?php
require_once __DIR__ . '/includes/functions.php';
responder_404();
$title = 'Página no encontrada | Dr. Lisandro Zenón';
$description = 'La página que busca no existe o fue movida.';
$canonical = '/';
$robots = 'noindex';
$nav = '';
require __DIR__ . '/includes/head.php';
require __DIR__ . '/includes/header.php';
?>
  <main id="main">
    <section class="section">
      <div class="container center not-found">
        <p class="nf-code">404</p>
        <h1 class="page-title">Página no encontrada</h1>
        <p>La página que busca no existe o fue movida.</p>
        <p class="nf-actions">
          <a class="btn-primary-x" href="/">Ir al inicio</a>
          <a class="btn-outline" href="/contacto/">Contacto</a>
        </p>
      </div>
    </section>
  </main>
<?php require __DIR__ . '/includes/footer.php'; ?>
