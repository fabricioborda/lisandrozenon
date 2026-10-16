<?php
/** Tarjetas de los consultorios. Variable: $mapas (bool) para ofrecer mapa "click para cargar". */
$mapas = $mapas ?? false;
$hc = $cardHeading ?? 'h3';
?>
        <div class="row g-4">
<?php foreach (cfg('consultorios') as $c): ?>
          <div class="col-lg-6">
            <article class="office-card">
              <<?= $hc ?>><?= h($c['nombre']) ?></<?= $hc ?>>
              <ul class="office-list">
                <li><?= icono('geo-alt') ?><span><?= h($c['direccion']) ?> - <?= h($c['localidad']) ?>, <?= h($c['provincia']) ?></span></li>
                <li><?= icono('telephone') ?><a href="tel:<?= h($c['tel']) ?>"><?= h($c['telefono']) ?></a></li>
                <li><?= icono('calendar3') ?><span>Dr. Zenón: <?= h($c['horario']) ?></span></li>
              </ul>
              <div class="office-actions">
                <a class="btn-outline" href="<?= h($c['como_llegar']) ?>" target="_blank" rel="noopener noreferrer"><?= icono('signpost-2') ?> Cómo llegar</a>
                <a class="btn-outline" href="tel:<?= h($c['tel']) ?>"><?= icono('telephone') ?> Llamar</a>
              </div>
<?php if ($mapas): ?>
              <div class="map-box ratio ratio-4x3" data-map="<?= h($c['mapa']) ?>" data-map-title="Mapa de <?= h($c['nombre']) ?>">
                <button type="button" class="map-load"><?= icono('map') ?><span>Ver mapa</span></button>
              </div>
<?php endif; ?>
            </article>
          </div>
<?php endforeach; ?>
        </div>
