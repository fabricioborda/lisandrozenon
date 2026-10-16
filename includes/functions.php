<?php
/** Funciones auxiliares compartidas por todas las páginas. */

/** Configuración (se carga una sola vez). */
function cfg(?string $key = null)
{
    static $c = null;
    if ($c === null) {
        $c = require __DIR__ . '/config.php';
    }
    return $key === null ? $c : ($c[$key] ?? null);
}

/** Escapa texto para HTML. */
function h($s): string
{
    return htmlspecialchars((string) $s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/** URL absoluta canónica de una ruta (/patologias/hernias/). */
function url_abs(string $path): string
{
    return rtrim(cfg('base_url'), '/') . $path;
}

/** Ruta de un asset con ?v= para cache busting (solo css/js propios). */
function asset(string $path): string
{
    return $path . '?v=' . cfg('assets_v');
}

/** Enlace de WhatsApp con mensaje prellenado. */
function wa_url(?string $msg = null): string
{
    return 'https://wa.me/' . cfg('whatsapp') . '?text=' . rawurlencode($msg ?? cfg('whatsapp_msg'));
}

/**
 * <picture> con WebP y JPG de respaldo.
 * $src es la ruta del JPG desde la raíz web (/assets/img/...). El .webp debe existir al lado (tools/optimizar-imagenes.sh).
 * $o: width, height, class, lazy (bool), priority (bool), sizes, attrs (string ya escapado)
 */
function picture(string $src, string $alt, array $o = []): string
{
    $root = dirname(__DIR__);
    $size = @getimagesize($root . $src);
    $w = $o['width'] ?? ($size[0] ?? null);
    $hgt = $o['height'] ?? ($size[1] ?? null);
    $webp = preg_replace('/\.(jpe?g|png)$/i', '.webp', $src);
    $hasWebp = is_file($root . $webp);
    $img = '<img src="' . h($src) . '" alt="' . h($alt) . '"'
        . ($w ? ' width="' . (int) $w . '" height="' . (int) $hgt . '"' : '')
        . (isset($o['class']) ? ' class="' . h($o['class']) . '"' : '')
        . (!empty($o['priority']) ? ' fetchpriority="high"' : ' loading="lazy" decoding="async"')
        . (isset($o['attrs']) ? ' ' . $o['attrs'] : '')
        . '>';
    if (!$hasWebp) {
        return $img;
    }
    return '<picture><source type="image/webp" srcset="' . h($webp) . '"'
        . '>' . $img . '</picture>';
}

/** Imprime un bloque JSON-LD. */
function json_ld(array $data): string
{
    return '<script type="application/ld+json">'
        . json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP)
        . '</script>' . "\n";
}

/** Texto corto que cabe en una meta description. */
function recortar(string $t, int $max = 158): string
{
    $t = trim(preg_replace('/\s+/u', ' ', strip_tags($t)));
    if (mb_strlen($t) <= $max) {
        return $t;
    }
    $t = mb_substr($t, 0, $max - 1);
    return rtrim(mb_substr($t, 0, (int) mb_strrpos($t, ' ')), " ,;:.") . '…';
}

/** Datos estructurados del médico (Physician) con sus consultorios. */
function schema_medico(): array
{
    $locs = [];
    $c = cfg('consultorios');
    foreach ($c as $o) {
        $locs[] = [
            '@type' => 'MedicalClinic',
            'name' => $o['nombre'],
            'telephone' => $o['tel'],
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => $o['direccion'],
                'addressLocality' => $o['localidad'],
                'addressRegion' => $o['provincia'],
                'addressCountry' => 'AR',
            ],
            'geo' => ['@type' => 'GeoCoordinates', 'latitude' => $o['lat'], 'longitude' => $o['lng']],
            'openingHoursSpecification' => [[
                '@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => $o['dias'],
                'opens' => $o['abre'],
                'closes' => $o['cierra'],
            ]],
        ];
    }
    return [
        '@context' => 'https://schema.org',
        '@type' => ['Physician', 'MedicalBusiness'],
        '@id' => url_abs('/#medico'),
        'name' => cfg('nombre'),
        'url' => url_abs('/'),
        'image' => url_abs('/assets/img/dr-lisandro-zenon.jpg'),
        'logo' => url_abs('/assets/img/icon-512.png'),
        'email' => cfg('email'),
        'telephone' => $c[1]['tel'],
        'medicalSpecialty' => 'Surgical',
        'description' => 'Médico especialista en Cirugía General en Goya, Corrientes: cirugía laparoscópica, cirugía sin huellas y videoendoscopia digestiva.',
        'sameAs' => [cfg('facebook'), cfg('instagram')],
        'address' => $locs[1]['address'],
        'areaServed' => ['@type' => 'City', 'name' => 'Goya, Corrientes, Argentina'],
        'location' => $locs,
    ];
}

/** BreadcrumbList a partir de [[nombre, ruta], ...]. */
function schema_breadcrumb(array $items): array
{
    $list = [];
    foreach ($items as $i => $it) {
        $list[] = ['@type' => 'ListItem', 'position' => $i + 1, 'name' => $it[0], 'item' => url_abs($it[1])];
    }
    return ['@context' => 'https://schema.org', '@type' => 'BreadcrumbList', 'itemListElement' => $list];
}

/** Ícono SVG-less: Bootstrap Icons. */
function icono(string $name, string $extra = ''): string
{
    return '<i class="bi bi-' . h($name) . ($extra ? ' ' . h($extra) : '') . '" aria-hidden="true"></i>';
}

/** Contenido de patologías y tratamientos (se carga una sola vez). */
function contenido(): array
{
    static $c = null;
    if ($c === null) {
        $c = require __DIR__ . '/contenido.php';
    }
    return $c;
}

/** ¿Estamos en el dominio de producción? (para no enviar estadísticas desde local). */
function es_produccion(): bool
{
    return (bool) preg_match('/(^|\.)lisandrozenon\.com\.ar$/i', $_SERVER['HTTP_HOST'] ?? '');
}

/** Registra la respuesta 404 y avisa a buscadores. */
function responder_404(): void
{
    http_response_code(404);
    header('X-Robots-Tag: noindex');
}
