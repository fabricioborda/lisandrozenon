<?php
/**
 * Contenido de patologías y tratamientos (única fuente de verdad).
 * Los textos médicos provienen del sitio original (solo se corrigió ortografía/HTML).
 * Cualquier duda clínica está listada en docs/REVISION-MEDICA.md: NO modificar el sentido sin revisión del Dr. Zenón.
 *
 * Campos: titulo, desc (meta description), resumen (tarjeta del índice), secciones [[h2|null, html]],
 *         video (nombre base en /assets/video/, opcional), imagen (opcional), rel_pat / rel_trat (slugs relacionados), icono.
 */
return [
    'patologias' => [
        'apendicitis' => [
            'titulo' => 'Apendicitis',
            'icono' => 'activity',
            'resumen' => 'La apendicitis es una inflamación del apéndice, una bolsa en forma de dedo que sobresale del colon.',
            'desc' => 'Apendicitis: inflamación del apéndice. Información y tratamiento con el Dr. Lisandro Zenón, cirujano en Goya, Corrientes.',
            'secciones' => [
                [null, '<p>La apendicitis es una inflamación del apéndice. El apéndice es una bolsa en forma de dedo que sobresale del colon en la parte inferior derecha del vientre, también llamada abdomen.</p>
<p>La apendicitis causa dolor en la parte inferior derecha del abdomen. Sin embargo, en la mayoría de las personas, el dolor comienza alrededor del ombligo y luego se desplaza. A medida que empeora la inflamación, suele aumentar el dolor de la apendicitis, y, con el tiempo, se agrava.</p>
<p>Aunque cualquier persona puede padecer apendicitis, lo más frecuente es que se produzca en personas de entre 10 y 30 años. El tratamiento de la apendicitis suele consistir en antibióticos y cirugía para extirpar el apéndice.</p>'],
            ],
            'rel_pat' => [],
            'rel_trat' => ['apendicectomia-laparoscopica'],
        ],
        'calculos-en-la-vesicula' => [
            'titulo' => 'Cálculos en la vesícula',
            'icono' => 'droplet',
            'resumen' => 'La litiasis vesicular, comúnmente conocida como cálculos o piedras en la vesícula, es una afección que afecta el sistema biliar.',
            'desc' => 'Cálculos en la vesícula (litiasis vesicular): qué es, síntomas, diagnóstico y tratamiento. Dr. Lisandro Zenón, cirujano en Goya, Corrientes.',
            'secciones' => [
                [null, '<p>La litiasis vesicular, comúnmente conocida como cálculos o piedras en la vesícula, es una afección que afecta el sistema biliar, específicamente la vesícula biliar. Se caracteriza por la formación de pequeñas masas sólidas, conocidas como cálculos biliares, dentro de la vesícula.</p>
<p>La vesícula biliar es un órgano en forma de pera ubicado debajo del hígado que almacena y concentra la bilis, un líquido producido por el hígado que ayuda en la digestión de las grasas. Los cálculos biliares pueden formarse cuando hay un desequilibrio en los componentes de la bilis, como el colesterol, los ácidos biliares y los pigmentos biliares. Estos cálculos pueden variar en tamaño y cantidad, desde pequeños cristales hasta piedras más grandes.</p>
<p>La litiasis vesicular es una afección frecuente y puede ser asintomática en algunos pacientes, lo que significa que los cálculos pueden estar presentes en la vesícula sin causar síntomas. Sin embargo, cuando los cálculos biliares se vuelven lo suficientemente grandes o migran a los conductos biliares, pueden provocar síntomas dolorosos y complicaciones.</p>'],
                ['Síntomas', '<p>Los síntomas comunes de la litiasis vesicular incluyen dolor en el abdomen superior derecho, especialmente después de comer alimentos grasos, náuseas, vómitos, hinchazón y fiebre en casos de infección.</p>'],
                ['Diagnóstico', '<p>El diagnóstico de la litiasis vesicular generalmente se realiza mediante pruebas de diagnóstico por imágenes, como la ecografía abdominal, que permite visualizar los cálculos biliares y evaluar la condición de la vesícula y los conductos biliares.</p>'],
                ['Tratamiento', '<p>El tratamiento de la litiasis vesicular puede variar según la presencia de síntomas y el riesgo de complicaciones. En muchos casos asintomáticos, no se requiere tratamiento. Sin embargo, cuando los cálculos biliares causan síntomas recurrentes o complicaciones graves, como la obstrucción de los conductos biliares, puede ser necesaria la cirugía para extirpar la vesícula biliar en un procedimiento conocido como colecistectomía.</p>'],
            ],
            'rel_pat' => [],
            'rel_trat' => ['colecistectomia-laparoscopica'],
        ],
        'hernias' => [
            'titulo' => 'Hernias',
            'icono' => 'circle-square',
            'resumen' => 'Las hernias se producen cuando un órgano o tejido protruye a través de una abertura o debilidad en la pared muscular.',
            'desc' => 'Hernias: tipos (inguinal, umbilical, hiatal e incisional) y tratamiento. Dr. Lisandro Zenón, cirujano en Goya, Corrientes.',
            'secciones' => [
                [null, '<p>Las hernias son una afección médica común que se produce cuando un órgano o tejido se desplaza de su lugar habitual y protruye a través de una abertura o debilidad en la pared muscular o el tejido conectivo que lo rodea. Las hernias pueden ocurrir en varias partes del cuerpo, pero son más frecuentes en la región abdominal y la ingle.</p>'],
                ['Tipos de hernias', '<p>Existen varios tipos de hernias, y algunas de las más comunes incluyen:</p>
<ul>
<li><strong>Hernia inguinal:</strong> Es la hernia más común y ocurre en la ingle cuando una porción del intestino delgado o tejido graso protruye a través de una debilidad en la pared abdominal.</li>
<li><strong>Hernia umbilical:</strong> Ocurre en el área del ombligo cuando una porción del intestino o tejido protruye a través de una debilidad en la pared abdominal cerca del ombligo.</li>
<li><strong>Hernia hiatal:</strong> Se produce cuando una parte del estómago protruye a través del diafragma hacia el tórax, a través de una abertura en el diafragma conocida como el hiato esofágico.</li>
<li><strong>Hernia incisional:</strong> Se desarrolla en el sitio de una incisión quirúrgica previa en la pared abdominal, donde el tejido protruye a través de la cicatriz.</li>
</ul>'],
            ],
            'rel_pat' => ['eventraciones'],
            'rel_trat' => ['cirugia-de-pared-abdominal'],
        ],
        'eventraciones' => [
            'titulo' => 'Eventraciones',
            'icono' => 'bandaid',
            'resumen' => 'Las eventraciones son una complicación común que ocurre después de una cirugía abdominal previa.',
            'desc' => 'Eventraciones: qué son, síntomas, diagnóstico y tratamiento. Dr. Lisandro Zenón, cirujano en Goya, Corrientes.',
            'secciones' => [
                [null, '<p>Las eventraciones, también conocidas como hernias incisionales recurrentes, son una complicación común que ocurre después de una cirugía abdominal previa. Se caracterizan por la protrusión de tejidos abdominales, como intestinos, grasa o vísceras, a través de una debilidad en la pared muscular y la fascia en el sitio de una incisión quirúrgica previa.</p>
<p>Las eventraciones ocurren cuando la cicatriz formada después de una cirugía abdominal no cicatriza adecuadamente o se debilita con el tiempo, lo que permite que los órganos o tejidos abdominales se abran paso a través de ella. Esta debilidad en la pared abdominal puede ser el resultado de factores como la tensión excesiva en la incisión quirúrgica original, la infección del sitio de la incisión, la mala cicatrización de heridas o la falta de cuidado en el proceso de recuperación.</p>'],
                ['Síntomas', '<p>Los síntomas de una eventración pueden variar según el tamaño y la ubicación de la protrusión, pero algunos de los síntomas comunes incluyen protuberancia o abultamiento en el área de la incisión quirúrgica previa, dolor o molestia, especialmente al realizar esfuerzos físicos, y sensación de presión en el área afectada.</p>'],
                ['Diagnóstico', '<p>El diagnóstico de una eventración generalmente se realiza mediante un examen físico realizado por un médico especializado. En algunos casos, pueden ser necesarios estudios de imagen, como la ecografía o la tomografía computarizada, para confirmar el diagnóstico y evaluar la extensión de la eventración.</p>'],
                ['Tratamiento', '<p>El tratamiento de las eventraciones generalmente implica cirugía para reparar la debilidad en la pared abdominal y colocar los tejidos protruidos nuevamente en su lugar. La cirugía para las eventraciones puede ser más compleja que para otras hernias, debido a la presencia de tejido cicatricial y la necesidad de reforzar la pared abdominal con mallas o suturas.</p>'],
            ],
            'rel_pat' => ['hernias'],
            'rel_trat' => ['cirugia-de-pared-abdominal'],
        ],
        'hemorroides' => [
            'titulo' => 'Hemorroides',
            'icono' => 'heart-pulse',
            'resumen' => 'Las hemorroides son una afección común que afecta las venas del área anal y el recto.',
            'desc' => 'Hemorroides internas y externas: síntomas, causas, diagnóstico y tratamiento. Dr. Lisandro Zenón, cirujano en Goya, Corrientes.',
            'secciones' => [
                [null, '<p>Las hemorroides son una afección común que afecta las venas del área anal y el recto. Se producen debido a la dilatación y la inflamación de estas venas, lo que puede causar molestias y síntomas incómodos. Las hemorroides pueden clasificarse en internas o externas, según su ubicación en el canal anal.</p>
<ul>
<li><strong>Hemorroides internas:</strong> Las hemorroides internas se forman dentro del recto, por lo que no son visibles desde el exterior. Pueden causar sangrado indoloro durante la defecación, lo que a menudo se nota como sangre roja brillante en las heces o en el papel higiénico. En algunos casos, las hemorroides internas pueden prolapsar, es decir, salir del ano durante las evacuaciones y regresar a su lugar por sí mismas.</li>
<li><strong>Hemorroides externas:</strong> Las hemorroides externas se forman en la parte externa del canal anal y son visibles desde el exterior. Pueden causar dolor, picazón e inflamación en el área anal. A menudo, se sienten como protuberancias duras y sensibles al tacto. Las hemorroides externas pueden sangrar si se irritan o se rompen.</li>
</ul>
<p>Las hemorroides pueden ser el resultado de diversos factores, como el estreñimiento crónico, el esfuerzo durante las evacuaciones, el embarazo, la obesidad y la falta de actividad física. Algunas personas pueden tener una predisposición genética a desarrollar hemorroides.</p>'],
                ['Diagnóstico', '<p>El diagnóstico de las hemorroides generalmente se realiza mediante un examen físico y una revisión de los síntomas por parte de un especialista en coloproctología. En algunos casos, se pueden realizar pruebas adicionales, como una sigmoidoscopia o una colonoscopia, para descartar otras afecciones intestinales.</p>'],
                ['Tratamiento', '<p>El tratamiento de las hemorroides depende de la gravedad de los síntomas. Para las hemorroides leves, se pueden recomendar cambios en el estilo de vida, como una dieta rica en fibra, la hidratación adecuada y evitar el esfuerzo durante las evacuaciones.</p>
<p>Para casos más severos, pueden utilizarse medicamentos tópicos para aliviar los síntomas o, en algunos casos, se puede requerir la cirugía para extirpar las hemorroides.</p>'],
            ],
            'rel_pat' => [],
            'rel_trat' => ['cirugia-anorrectal'],
        ],
        'polipos-colorrectales' => [
            'titulo' => 'Pólipos colorrectales',
            'icono' => 'record-circle',
            'resumen' => 'Los pólipos colorrectales son crecimientos anormales que se forman en el revestimiento interno del colon o el recto.',
            'desc' => 'Pólipos colorrectales: tipos, importancia de la detección y extirpación. Dr. Lisandro Zenón, cirujano en Goya, Corrientes.',
            'secciones' => [
                [null, '<p>Los pólipos colorrectales son crecimientos anormales que se forman en el revestimiento interno del colon o el recto, que son partes esenciales del sistema digestivo. Estas estructuras benignas pueden variar en forma y tamaño, desde pequeñas protuberancias hasta crecimientos más grandes y planos. Aunque la mayoría de los pólipos son inofensivos, algunos de ellos pueden volverse cancerosos con el tiempo si no se tratan adecuadamente.</p>
<p>Los pólipos colorrectales se clasifican en diferentes tipos, siendo los más comunes los pólipos hiperplásicos, adenomatosos y serrados. Los pólipos hiperplásicos suelen ser pequeños y generalmente no presentan un riesgo de cáncer. Por otro lado, los pólipos adenomatosos y serrados son más propensos a desarrollar células cancerosas y requieren una atención más cuidadosa.</p>
<p>La presencia de pólipos colorrectales puede no manifestar síntomas, lo que destaca la importancia de las pruebas de detección regulares para identificarlos. Las colonoscopias y otras pruebas permiten a los especialistas examinar el colon y recto en busca de pólipos, permitiendo la extirpación temprana de aquellos que puedan tener el potencial de volverse cancerosos.</p>'],
            ],
            'rel_pat' => ['cancer-de-colon-y-recto'],
            'rel_trat' => ['videoendoscopia-digestiva-baja'],
        ],
        'cancer-de-colon-y-recto' => [
            'titulo' => 'Cáncer de colon y recto',
            'icono' => 'shield-plus',
            'resumen' => 'El cáncer de colon y recto, también conocido como cáncer colorrectal, es una enfermedad maligna que se origina en el revestimiento interno del colon o el recto.',
            'desc' => 'Cáncer de colon y recto (colorrectal): detección temprana y tratamiento. Dr. Lisandro Zenón, cirujano en Goya, Corrientes.',
            'secciones' => [
                [null, '<p>El cáncer de colon y recto, también conocido como cáncer colorrectal, es una enfermedad maligna que se origina en el revestimiento interno del colon o el recto, que forman parte del sistema digestivo. Este tipo de cáncer se desarrolla a partir del crecimiento anormal y descontrolado de células en el tejido colónico o rectal. El cáncer colorrectal es uno de los cánceres más comunes y devastadores a nivel mundial. Afecta tanto a hombres como a mujeres, y su incidencia aumenta con la edad. A menudo, se desarrolla a partir de pólipos, pequeñas formaciones en forma de protuberancias en la pared del colon o recto, que con el tiempo pueden volverse cancerosas. Si bien algunos casos pueden ser hereditarios, muchos otros están relacionados con factores de riesgo modificables, como una dieta poco saludable, la falta de actividad física y el consumo de tabaco y alcohol.</p>'],
                ['Detección temprana', '<p>La detección temprana del cáncer de colon y recto es fundamental para un tratamiento exitoso y una mejor tasa de supervivencia. Los síntomas pueden variar, pero incluyen cambios en los hábitos intestinales, sangrado rectal, dolor abdominal y pérdida de peso inexplicada. Las pruebas de detección, como la colonoscopia y las pruebas de sangre oculta en heces, son herramientas cruciales para identificar la enfermedad en sus etapas iniciales, lo que aumenta significativamente las posibilidades de curación.</p>'],
                ['Tratamiento', '<p>El tratamiento del cáncer colorrectal es multidisciplinario y personalizado, dependiendo del estadio de la enfermedad, la salud general del paciente y otros factores. Las opciones de tratamiento pueden incluir cirugía para extirpar el tumor, quimioterapia, radioterapia y terapias dirigidas que atacan específicamente las células cancerosas.</p>
<p>Enfrentar el cáncer de colon y recto puede ser una experiencia desafiante, pero con el apoyo adecuado y la atención médica especializada, muchos pacientes pueden superar esta enfermedad y seguir adelante con una vida plena y saludable. La educación, la detección temprana y el acceso a tratamientos efectivos son esenciales en la lucha contra esta enfermedad.</p>'],
            ],
            'rel_pat' => ['polipos-colorrectales'],
            'rel_trat' => ['cirugia-laparoscopica-colorrectal', 'cirugia-oncologica'],
        ],
    ],

    'tratamientos' => [
        'videoendoscopia-digestiva-alta' => [
            'titulo' => 'Videoendoscopia digestiva alta',
            'icono' => 'camera-video',
            'resumen' => 'Video del procedimiento y equipamiento utilizado.',
            'desc' => 'Videoendoscopia digestiva alta con el Dr. Lisandro Zenón en Goya, Corrientes. Video del procedimiento y equipamiento.',
            'video' => 'videoendoscopia-digestiva-alta',
            'video_titulo' => 'Videoendoscopia digestiva alta',
            'equipo_hd' => true,
            'secciones' => [],
            'rel_pat' => [],
            'rel_trat' => ['videoendoscopia-digestiva-baja'],
        ],
        'videoendoscopia-digestiva-baja' => [
            'titulo' => 'Videoendoscopia digestiva baja',
            'icono' => 'camera-video',
            'resumen' => 'Video del procedimiento y equipamiento utilizado.',
            'desc' => 'Videoendoscopia digestiva baja con el Dr. Lisandro Zenón en Goya, Corrientes. Video del procedimiento y equipamiento.',
            'video' => 'videoendoscopia-digestiva-baja',
            'video_titulo' => 'Videoendoscopia digestiva baja',
            'equipo_hd' => true,
            'secciones' => [],
            'rel_pat' => ['polipos-colorrectales'],
            'rel_trat' => ['videoendoscopia-digestiva-alta'],
        ],
        'apendicectomia-laparoscopica' => [
            'titulo' => 'Cirugía laparoscópica de apéndice',
            'icono' => 'scissors',
            'resumen' => 'La apendicectomía es una intervención quirúrgica que se hace para extirpar el apéndice.',
            'desc' => 'Apendicectomía laparoscópica: qué es y por qué se realiza. Dr. Lisandro Zenón, cirujano laparoscópico en Goya, Corrientes.',
            'secciones' => [
                ['¿Qué es la apendicectomía laparoscópica?', '<p>La apendicectomía es una intervención quirúrgica que se hace para extirpar el apéndice. En la apendicectomía laparoscópica, se usa un instrumento quirúrgico llamado laparoscopio. Consiste en un tubo largo y delgado con una cámara diminuta y una luz. Este instrumento permite al cirujano hacer solo unas pocas incisiones pequeñas (cortes) para llevar a cabo la intervención, en lugar de hacer una única incisión larga. Las cicatrices que deja esta operación son más pequeñas y, en la mayoría de los casos, hay menos complicaciones y la recuperación es más rápida.</p>'],
                ['¿Por qué necesito una apendicectomía?', '<p>La apendicectomía es el tratamiento de la apendicitis. Dicha afección se presenta cuando el apéndice se infecta e inflama. La apendicectomía es casi siempre una operación de emergencia. Si el apéndice infectado no se extirpa de inmediato, puede romperse y causar una peritonitis generalizada e inclusive la muerte.</p>'],
            ],
            'rel_pat' => ['apendicitis'],
            'rel_trat' => ['colecistectomia-laparoscopica'],
        ],
        'colecistectomia-laparoscopica' => [
            'titulo' => 'Cirugía laparoscópica de vesícula',
            'icono' => 'scissors',
            'resumen' => 'La colecistectomía laparoscópica es un procedimiento quirúrgico mínimamente invasivo para extirpar la vesícula biliar.',
            'desc' => 'Colecistectomía laparoscópica (cirugía de vesícula): procedimiento mínimamente invasivo. Dr. Lisandro Zenón, Goya, Corrientes.',
            'video' => 'cirugia-laparoscopica-de-vesicula',
            'video_titulo' => 'Cirugía laparoscópica de vesícula',
            'secciones' => [
                [null, '<p>La cirugía laparoscópica de vesícula, o colecistectomía laparoscópica, es un procedimiento quirúrgico mínimamente invasivo para extirpar la vesícula biliar. Se realiza mediante pequeñas incisiones en el abdomen, utilizando una cámara y pequeños instrumentos quirúrgicos. Ofrece beneficios como una recuperación más rápida y menos dolor postoperatorio. Se utiliza para tratar afecciones de la vesícula biliar, como cálculos biliares y colecistitis.</p>'],
            ],
            'rel_pat' => ['calculos-en-la-vesicula'],
            'rel_trat' => ['apendicectomia-laparoscopica'],
        ],
        'cirugia-de-pared-abdominal' => [
            'titulo' => 'Cirugía laparoscópica de pared abdominal',
            'icono' => 'layers',
            'resumen' => 'La cirugía de paredes abdominales trata afecciones que afectan la estructura y función de la pared abdominal.',
            'desc' => 'Cirugía de pared abdominal: hernias, eventraciones y más, con técnicas abiertas o laparoscópicas. Dr. Lisandro Zenón, Goya, Corrientes.',
            'video' => 'cirugia-laparoscopica-de-pared-abdominal',
            'video_titulo' => 'Cirugía laparoscópica de pared abdominal',
            'secciones' => [
                [null, '<p>La cirugía de paredes abdominales trata afecciones que afectan la estructura y función de la pared abdominal. Incluye hernias abdominales, eventraciones, traumatismos, diverticulitis complicada y tumores abdominales. Se realizan procedimientos abiertos o laparoscópicos según la afección. El objetivo es reparar las debilidades y mejorar la función y calidad de vida del paciente.</p>'],
            ],
            'rel_pat' => ['hernias', 'eventraciones'],
            'rel_trat' => [],
        ],
        'cirugia-laparoscopica-colorrectal' => [
            'titulo' => 'Cirugía laparoscópica de colon y recto',
            'icono' => 'scissors',
            'resumen' => 'La cirugía colorrectal laparoscópica es un procedimiento mínimamente invasivo que trata diversas afecciones del colon y el recto.',
            'desc' => 'Cirugía colorrectal laparoscópica: procedimiento mínimamente invasivo para colon y recto. Dr. Lisandro Zenón, Goya, Corrientes.',
            'secciones' => [
                [null, '<p>La cirugía colorrectal laparoscópica es un procedimiento mínimamente invasivo que trata diversas afecciones del colon y el recto. Se realiza mediante pequeñas incisiones en el abdomen para introducir instrumentos quirúrgicos y una cámara de video de alta resolución. Los beneficios incluyen menor dolor postoperatorio, tiempo de internación reducido y recuperación más rápida. Se utiliza para tratar el cáncer colorrectal, diverticulitis, enfermedad inflamatoria intestinal, entre otras afecciones. Como especialistas en cirugía buscamos proporcionar un enfoque efectivo y compasivo para mejorar la calidad de vida de nuestros pacientes mediante tratamientos personalizados, incluida la cirugía laparoscópica colorrectal cuando sea adecuada.</p>'],
            ],
            'rel_pat' => ['cancer-de-colon-y-recto'],
            'rel_trat' => ['cirugia-anorrectal'],
        ],
        'cirugia-anorrectal' => [
            'titulo' => 'Cirugía anorrectal',
            'icono' => 'bandaid',
            'resumen' => 'La cirugía anorrectal se ocupa del diagnóstico y tratamiento de afecciones que afectan el ano y el recto.',
            'desc' => 'Cirugía anorrectal: fisuras, hemorroides, fístulas, abscesos y más. Dr. Lisandro Zenón, cirujano en Goya, Corrientes.',
            'secciones' => [
                [null, '<p>La cirugía anorrectal es una rama de la cirugía que se ocupa del diagnóstico y tratamiento de afecciones que afectan el ano y el recto. Esta cirugía abarca diversas condiciones como fisuras anales, hemorroides, fístulas, abscesos, pólipos rectales y cáncer colorrectal. Se pueden utilizar técnicas abiertas o laparoscópicas según las necesidades del paciente. El objetivo es aliviar los síntomas, resolver la enfermedad y mejorar la calidad de vida.</p>'],
            ],
            'rel_pat' => ['hemorroides'],
            'rel_trat' => ['cirugia-laparoscopica-colorrectal'],
        ],
        'cirugia-oncologica' => [
            'titulo' => 'Cirugía oncológica',
            'icono' => 'shield-plus',
            'resumen' => 'Gastrostomías endoscópicas percutáneas, yeyunostomías, laparoscopia exploradora con biopsia y catéteres para quimioterapia.',
            'desc' => 'Cirugía oncológica: gastrostomías, yeyunostomías, laparoscopia exploradora con biopsia y catéter para quimioterapia. Goya, Corrientes.',
            'secciones' => [
                ['Gastrostomías endoscópicas percutáneas', '<p>Colocación mediante endoscopia y cirugía percutánea de una sonda a través de la pared abdominal para alimentación enteral.</p>'],
                ['Yeyunostomías', '<p>Cirugía que se realiza para crear una abertura en el yeyuno (parte del intestino delgado) desde el exterior del cuerpo para colocar una sonda de alimentación.</p>'],
                ['Laparoscopia exploradora y toma de biopsia con tru-cut', '<p>Laparoscopia exploradora se recomienda para diagnosticar y estadificar algunas enfermedades oncológicas. La biopsia es un procedimiento que se realiza para extraer una muestra de tejido o de célula del cuerpo para ser analizado por el Anatomo Patólogo y determinar si la muestra es maligna o benigna.</p>'],
                ['Colocación de catéter permanente para quimioterapia', '<p>El catéter es un tubo flexible y delgado que va en el interior de la vena yugular o subclavia y sirve para administrar medicamentos que no son tolerados por una vena periférica de los miembros superiores.</p>'],
            ],
            'rel_pat' => ['cancer-de-colon-y-recto'],
            'rel_trat' => ['cirugia-percutanea'],
        ],
        'cirugia-percutanea' => [
            'titulo' => 'Cirugía percutánea',
            'icono' => 'bullseye',
            'resumen' => 'PAAF de tiroides guiado por ecografía, drenaje percutáneo guiado por tomografía y vía venosa central guiada por ecografía.',
            'desc' => 'Cirugía percutánea: PAAF de tiroides, drenaje guiado por tomografía y vía venosa central. Dr. Lisandro Zenón, Goya, Corrientes.',
            'secciones' => [
                ['PAAF de tiroides guiado por ecografía', '<p>Es un método sencillo que consiste en punzar con anestesia local y guía ecográfica un nódulo tiroideo para valorar el riesgo de malignidad. Para que la muestra sea representativa, se realiza con el Anatomo Patólogo presente en el mismo lugar.</p>'],
                ['Drenaje percutáneo guiado por tomografía', '<p>Se utiliza la guía por imágenes para colocar un catéter a través de la piel dentro del absceso o colección para drenar el líquido y poder estudiar la muestra con bioquímicos y anatomopatólogos.</p>'],
                ['Vía venosa central guiada por ecografía', '<p>Cuando no se pueden realizar accesos venosos periféricos en los miembros superiores, se recomienda realizar accesos venosos centrales guiados por ecografía para disminuir riesgos.</p>'],
            ],
            'rel_pat' => [],
            'rel_trat' => ['cirugia-oncologica'],
        ],
    ],
];
