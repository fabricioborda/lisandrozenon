<?php /** Bloque de llamada a la acción para pedir turno. Variable opcional: $ctaTexto. */ ?>
      <aside class="cta-turno">
        <div>
          <p class="cta-title"><?= h($ctaTexto ?? '¿Necesita una consulta?') ?></p>
          <p class="cta-sub">Escríbame por WhatsApp para coordinar su turno.</p>
        </div>
        <a class="btn-wa btn-wa-lg" href="<?= h(wa_url()) ?>" target="_blank" rel="noopener noreferrer"><?= icono('whatsapp') ?> Pedir turno por WhatsApp</a>
      </aside>
