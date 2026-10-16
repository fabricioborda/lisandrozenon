<?php
/** Pie de página, botón flotante de WhatsApp y scripts. Usa $sliders (bool). */
$sliders = $sliders ?? false;
$cons = cfg('consultorios');
?>
  <footer id="footer" class="site-footer">
    <div class="container">
      <div class="row gy-4">
        <div class="col-md-5">
          <img class="footer-logo" src="/assets/img/logo/logo-blanco.png" alt="Dr. Lisandro Benjamín Zenón, Médico Cirujano" width="403" height="260" loading="lazy" decoding="async">
          <p class="footer-role"><?= h(cfg('titulo')) ?> · Goya, Corrientes</p>
          <p class="footer-note">La información de este sitio no reemplaza la consulta médica.</p>
        </div>
        <div class="col-sm-6 col-md-4">
          <h2 class="footer-h">Contacto</h2>
          <ul class="footer-list">
            <li><?= icono('envelope') ?><a href="mailto:<?= h(cfg('email')) ?>"><?= h(cfg('email')) ?></a></li>
            <li><?= icono('whatsapp') ?><a href="<?= h(wa_url()) ?>" target="_blank" rel="noopener noreferrer">WhatsApp</a></li>
<?php foreach ($cons as $c): ?>
            <li><?= icono('telephone') ?><a href="tel:<?= h($c['tel']) ?>"><?= h($c['telefono']) ?></a> <span class="footer-small">(<?= h($c['nombre']) ?>)</span></li>
<?php endforeach; ?>
          </ul>
        </div>
        <div class="col-sm-6 col-md-3">
          <h2 class="footer-h">Redes sociales</h2>
          <ul class="footer-list">
            <li><?= icono('facebook') ?><a href="<?= h(cfg('facebook')) ?>" target="_blank" rel="noopener noreferrer">Facebook</a></li>
            <li><?= icono('instagram') ?><a href="<?= h(cfg('instagram')) ?>" target="_blank" rel="noopener noreferrer">Instagram</a></li>
          </ul>
        </div>
      </div>
      <p class="copyright">&copy; <?= date('Y') ?> <?= h(cfg('nombre')) ?> · <?= h(cfg('titulo')) ?></p>
    </div>
  </footer>

  <a class="wa-float" href="<?= h(wa_url()) ?>" target="_blank" rel="noopener noreferrer" aria-label="Escribir por WhatsApp"><?= icono('whatsapp') ?></a>
  <a href="#" class="back-to-top" aria-label="Volver arriba"><?= icono('arrow-up-short') ?></a>

<?php if ($sliders): ?>
  <script src="/assets/vendor/swiper/swiper-bundle.min.js" defer></script>
  <script src="/assets/vendor/glightbox/js/glightbox.min.js" defer></script>
<?php endif; ?>
  <script src="<?= h(asset('/assets/js/main.js')) ?>" defer></script>
</body>
</html>
