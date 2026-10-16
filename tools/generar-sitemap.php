<?php
/**
 * Regenera sitemap.xml a partir de las páginas del sitio.
 * Uso (PHP 8.0+): php tools/generar-sitemap.php
 *   o con el contenedor local: docker exec php80 php /var/www/lisandrozenon/tools/generar-sitemap.php
 * lastmod = fecha de modificación del archivo de la página (o de includes/contenido.php para patologías/tratamientos).
 * Al agregar una página fija nueva (no de contenido), agregarla a $fijas.
 */
require_once __DIR__ . '/../includes/functions.php';
$root = dirname(__DIR__);
$cont = contenido();
$contMtime = filemtime($root . '/includes/contenido.php');

$urls = [];
$fijas = ['/' => 'index.php', '/sobre-mi/' => 'sobre-mi/index.php', '/patologias/' => 'patologias/index.php',
    '/tratamientos/' => 'tratamientos/index.php', '/cirugia-sin-huellas/' => 'cirugia-sin-huellas/index.php',
    '/equipamiento/' => 'equipamiento/index.php', '/contacto/' => 'contacto/index.php'];
foreach ($fijas as $path => $file) {
    $urls[$path] = max(filemtime($root . '/' . $file), $path === '/patologias/' || $path === '/tratamientos/' ? $contMtime : 0);
}
foreach (['patologias', 'tratamientos'] as $tipo) {
    foreach (array_keys($cont[$tipo]) as $slug) {
        $urls["/$tipo/$slug/"] = $contMtime;
    }
}
$xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n" . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
foreach ($urls as $path => $mtime) {
    $xml .= "  <url>\n    <loc>" . htmlspecialchars(url_abs($path), ENT_XML1) . "</loc>\n    <lastmod>" . date('Y-m-d', $mtime) . "</lastmod>\n  </url>\n";
}
$xml .= "</urlset>\n";
file_put_contents($root . '/sitemap.xml', $xml);
echo count($urls) . " URLs escritas en sitemap.xml\n";
