<?php
/**
 * Datos del sitio en un solo lugar (contacto, horarios, redes, versión de assets).
 * Para cambiar un teléfono, horario o email, editar SOLO este archivo.
 */
return [
    'nombre'      => 'Dr. Lisandro Zenón',
    'titulo'      => 'Médico Cirujano',
    'base_url'    => 'https://www.lisandrozenon.com.ar',
    'ga_id'       => 'G-041SV6FCC1',
    'assets_v'    => '20261016n',          // cambiar al modificar style.css / main.js (cache busting)
    'email'       => 'dr.lisandro.zenon@gmail.com',
    'whatsapp'    => '5493777700025',
    'whatsapp_msg'=> 'Hola Dr. Zenón, quisiera solicitar un turno.',
    'facebook'    => 'https://www.facebook.com/drlisandrozenon',
    'instagram'   => 'https://www.instagram.com/drlisandrozenon',
    'redes_user'  => 'drlisandrozenon',
    'og_image'    => '/assets/img/og-image.jpg',
    'consultorios' => [
        [
            'id'       => 'danura',
            'nombre'   => 'Imágenes Médicas Dr. Danura',
            'direccion'=> 'Sargento Cabral 12',
            'localidad'=> 'Goya',
            'provincia'=> 'Corrientes',
            'telefono' => '03777 24-6631',
            'tel'      => '+543777246631',
            'horario'  => 'Lunes a Viernes de 16:00 a 20:00',
            'dias'     => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
            'abre'     => '16:00',
            'cierra'   => '20:00',
            'lat'      => -29.1532,
            'lng'      => -59.2625,
            'mapa'     => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3484.3891786403237!2d-59.26251922373446!3d-29.15320179052396!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x944e849eadf37741%3A0x6e309d794f622e1b!2sCabral%2012%2C%20W3450BGB%20Corrientes!5e0!3m2!1ses-419!2sar!4v1702748950131!5m2!1ses-419!2sar',
            'como_llegar' => 'https://www.google.com/maps/search/?api=1&query=Sargento+Cabral+12%2C+Goya%2C+Corrientes',
        ],
        [
            'id'       => 'san-roque',
            'nombre'   => 'Sanatorio San Roque',
            'direccion'=> 'José Gómez 643',
            'localidad'=> 'Goya',
            'provincia'=> 'Corrientes',
            'telefono' => '03777 42-1756',
            'tel'      => '+543777421756',
            'horario'  => 'Lunes a Viernes de 8:00 a 12:00',
            'dias'     => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
            'abre'     => '08:00',
            'cierra'   => '12:00',
            'lat'      => -29.1399,
            'lng'      => -59.2674,
            'mapa'     => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6969.681550480073!2d-59.26741456533198!3d-29.139886487242276!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x944e84945311006f%3A0xcdd6f94b02509d05!2sJos%C3%A9%20E.%20G%C3%B3mez%20643%2C%20W3450FZM%20Goya%2C%20Corrientes!5e0!3m2!1ses-419!2sar!4v1702743001664!5m2!1ses-419!2sar',
            'como_llegar' => 'https://www.google.com/maps/search/?api=1&query=Jos%C3%A9+G%C3%B3mez+643%2C+Goya%2C+Corrientes',
        ],
    ],
];
