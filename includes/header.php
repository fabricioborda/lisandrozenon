<?php
/** Cabecera y menú. Usa $nav (clave activa) y $canonical (para aria-current). */
$nav = $nav ?? '';
$canonical = $canonical ?? '/';
$cont = contenido();
$item = function (string $href, string $label, string $key) use ($nav, $canonical) {
    $cur = ($canonical === $href) ? ' aria-current="page"' : '';
    return '<a class="nav-link' . ($nav === $key ? ' active' : '') . '" href="' . h($href) . '"' . $cur . '>' . h($label) . '</a>';
};
$sub = function (string $tipo, string $key, string $label, string $base) use ($cont, $nav, $canonical, $item) {
    $s = '<li class="has-sub' . ($nav === $key ? ' is-active' : '') . '">' . $item($base, $label, $key)
        . '<button type="button" class="sub-toggle" aria-expanded="false" aria-label="Mostrar opciones de ' . h($label) . '">' . icono('chevron-down') . '</button>'
        . '<ul class="submenu">';
    foreach ($cont[$tipo] as $slug => $d) {
        $href = $base . $slug . '/';
        $s .= '<li><a href="' . h($href) . '"' . ($canonical === $href ? ' aria-current="page"' : '') . '>' . h($d['titulo']) . '</a></li>';
    }
    return $s . '</ul></li>';
};
?>
<body class="<?= h($bodyClass ?? '') ?>">
  <a class="visually-hidden-focusable skip-link" href="#main">Saltar al contenido</a>

  <header id="header" class="site-header">
    <div class="container header-inner">
      <a class="logo" href="/" aria-label="Dr. Lisandro Zenón, Médico Cirujano: ir al inicio">
        <img class="logo-mark" src="/assets/img/logo/monograma-azul.png" alt="" width="55" height="120">
        <span class="logo-text">Dr. Lisandro Zenón <span>Médico Cirujano</span></span>
      </a>

      <button type="button" class="nav-toggle" aria-expanded="false" aria-controls="navbar" aria-label="Abrir menú"><?= icono('list') ?></button>

      <nav id="navbar" class="site-nav" aria-label="Principal">
        <ul>
          <li><?= $item('/', 'Inicio', 'home') ?></li>
          <li><?= $item('/sobre-mi/', 'Sobre mí', 'sobre-mi') ?></li>
          <?= $sub('patologias', 'patologias', 'Patologías', '/patologias/') ?>
          <?= $sub('tratamientos', 'tratamientos', 'Tratamientos', '/tratamientos/') ?>
          <li><?= $item('/cirugia-sin-huellas/', 'Cirugía sin huellas', 'sin-huellas') ?></li>
          <li><?= $item('/equipamiento/', 'Equipamiento', 'equipamiento') ?></li>
          <li><?= $item('/contacto/', 'Contacto', 'contacto') ?></li>
          <li class="nav-cta"><a class="btn-wa" href="<?= h(wa_url()) ?>" target="_blank" rel="noopener noreferrer"><?= icono('whatsapp') ?> Pedir turno</a></li>
        </ul>
      </nav>
    </div>
  </header>
