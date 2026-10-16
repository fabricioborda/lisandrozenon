<?php
/**
 * Franja destacada de la torre de videoendoscopia HD (home y página de Equipamiento).
 * Variable opcional: $destacadoTag ('h2' por defecto).
 */
$torre = require __DIR__ . '/torre-hd.php';
$dt = $destacadoTag ?? 'h2';
?>
    <section id="videoendoscopia-hd" class="section section-brand">
      <div class="container">
        <div class="row align-items-center g-4 g-lg-5">
          <div class="col-md-7">
            <p class="eyebrow eyebrow-light"><?= icono('stars') ?> Nuevo equipamiento</p>
            <<?= $dt ?> class="brand-title">Nueva torre de videoendoscopia de alta definición</<?= $dt ?>>
            <p class="brand-lead"><?= h($torre['bajada']) ?></p>
            <ul class="brand-list">
<?php foreach (array_slice($torre['caracteristicas'], 0, 4) as [$ico, $tit]): ?>
              <li><?= icono($ico) ?><span><?= h($tit) ?></span></li>
<?php endforeach; ?>
            </ul>
            <a class="btn-light-solid" href="<?= h($torre['url']) ?>">Conocer el equipo <?= icono('arrow-right') ?></a>
          </div>
          <div class="col-md-5">
            <?= picture($torre['foto'][0], $torre['foto'][1], ['class' => 'img-fluid rounded-card img-hd']) ?>
          </div>
        </div>
      </div>
    </section>
