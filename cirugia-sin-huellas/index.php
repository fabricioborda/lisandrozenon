<?php
require_once __DIR__ . '/../includes/functions.php';
$title = 'Cirugía sin huellas en Goya, Corrientes | Dr. Lisandro Zenón';
$description = 'Cirugía sin huellas: técnica mínimamente invasiva con puerto único, agujas percutáneas y dispositivos magnéticos. Dr. Lisandro Zenón, Goya, Corrientes.';
$canonical = '/cirugia-sin-huellas/';
$nav = 'sin-huellas';
$crumbs = [['Inicio', '/'], ['Cirugía sin huellas', $canonical]];
$jsonLd = [schema_breadcrumb($crumbs), [
    '@context' => 'https://schema.org', '@type' => 'MedicalProcedure', 'name' => 'Cirugía sin huellas',
    'description' => 'Técnica quirúrgica mínimamente invasiva de última generación, que busca obtener los mejores resultados estéticos y funcionales con el menor trauma posible para el paciente.',
    'url' => url_abs($canonical),
]];
require __DIR__ . '/../includes/head.php';
require __DIR__ . '/../includes/header.php';
?>
  <main id="main">
<?php require __DIR__ . '/../includes/breadcrumb.php'; ?>
    <section id="cirugiasinhuellas" class="section">
      <div class="container">
        <h1 class="page-title">Cirugía sin huellas</h1>
        <div class="row g-4 g-lg-5 align-items-start">
          <div class="col-lg-7 prose">
            <h2>¿Qué es la cirugía sin huellas?</h2>
            <p>La cirugía sin huellas es una técnica quirúrgica mínimamente invasiva de última generación, que busca obtener los mejores resultados estéticos y funcionales con el menor trauma posible para el paciente.</p>
            <p>A diferencia de la laparoscopía convencional, esta técnica se basa en tres pilares fundamentales:</p>
          </div>
          <div class="col-lg-5">
            <?= picture('/assets/img/equipamiento/instrumental-cirugia-sin-huellas-2.jpg', 'Instrumental de 3 mm para cirugía sin huellas', ['class' => 'img-fluid rounded-card', 'priority' => true]) ?>
          </div>
        </div>

        <div class="row g-4 mt-1 pillars">
          <div class="col-md-4"><div class="pillar"><span class="pillar-n">1</span><h3>Puerto único</h3><p>Se accede al abdomen a través de una sola pequeña incisión oculta (generalmente en el ombligo), reduciendo al mínimo la visibilidad de cicatrices.</p></div></div>
          <div class="col-md-4"><div class="pillar"><span class="pillar-n">2</span><h3>Agujas percutáneas e instrumental mini</h3><p>Se utilizan instrumentos de solo 3 mm de diámetro, tan finos como agujas, que atraviesan la piel sin necesidad de cortes. Esto genera menos dolor, menor sangrado y una recuperación más rápida.</p></div></div>
          <div class="col-md-4"><div class="pillar"><span class="pillar-n">3</span><h3>Dispositivos magnéticos de tracción</h3><p>A través de imanes colocados por fuera del cuerpo, se manipulan tejidos internos (como el hígado o el intestino) sin usar pinzas externas. Este sistema reduce significativamente la lesión en la piel y permite una mejor visualización intraoperatoria.</p></div></div>
        </div>

        <div class="row g-4 mt-1">
          <div class="col-md-6">
            <h2 class="h4">Beneficios para el paciente</h2>
            <ul class="check-list">
              <li>Cicatrices casi invisibles</li>
              <li>Menor dolor postoperatorio</li>
              <li>Recuperación más rápida</li>
              <li>Menor uso de analgésicos</li>
              <li>Alta satisfacción estética y funcional</li>
            </ul>
          </div>
          <div class="col-md-6">
            <h2 class="h4">Procedimientos en los que está indicada</h2>
            <p>Esta técnica innovadora combina precisión quirúrgica, estética y tecnología, y está indicada para múltiples procedimientos, incluyendo:</p>
            <ul class="check-list">
              <li>Colecistectomía (vesícula)</li>
              <li>Apendicectomía</li>
              <li>Cirugía de hernias</li>
              <li>Cirugías colorrectales seleccionadas</li>
              <li>Cirugía bariátrica (en centros especializados)</li>
            </ul>
          </div>
        </div>
<?php require __DIR__ . '/../includes/cta-turno.php'; ?>
      </div>
    </section>
  </main>
<?php require __DIR__ . '/../includes/footer.php'; ?>
