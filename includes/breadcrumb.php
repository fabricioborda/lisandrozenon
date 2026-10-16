<?php
/** Migas de pan visibles. Variable: $crumbs = [[nombre, ruta], ...] (el último es la página actual). */
$last = count($crumbs) - 1;
?>
    <nav class="breadcrumbs" aria-label="Migas de pan">
      <div class="container">
        <ol>
<?php foreach ($crumbs as $i => $c): ?>
<?php if ($i === $last): ?>
          <li aria-current="page"><?= h($c[0]) ?></li>
<?php else: ?>
          <li><a href="<?= h($c[1]) ?>"><?= h($c[0]) ?></a></li>
<?php endif; ?>
<?php endforeach; ?>
        </ol>
      </div>
    </nav>
