# Puntos para revisión del Dr. Zenón

Estos textos **no se modificaron** (solo se corrigió ortografía y HTML). Los textos viven en `includes/contenido.php` (patologías y tratamientos) y en las páginas `sobre-mi/`, `cirugia-sin-huellas/`, `equipamiento/`.

## Contenido clínico a confirmar

| # | Dónde (hoy) | Texto actual | Duda |
|---|---|---|---|
| 1 | `contenido.php` → patologías → `eventraciones` (primer párrafo) | “Las eventraciones, también conocidas como hernias incisionales **recurrentes**…” | Hernia incisional y eventración suelen considerarse sinónimos; “recurrentes” parece incorrecto. Además, la página de Hernias define “Hernia incisional” por separado. |
| 2 | tratamientos → `cirugia-de-pared-abdominal` | “…incluye hernias abdominales, eventraciones, traumatismos, **diverticulitis complicada y tumores abdominales**.” | Revisar si diverticulitis complicada y tumores abdominales corresponden a “pared abdominal”. El título dice “Cirugía Laparoscópica de Pared Abdominal” pero el texto habla de técnicas abiertas o laparoscópicas. |
| 3 | tratamientos → `cirugia-anorrectal` | “Se pueden utilizar técnicas abiertas o laparoscópicas…” | Revisar si corresponde (cirugía anorrectal suele ser por vía perineal). |
| 4 | tratamientos → `cirugia-oncologica` | Lista gastrostomías, yeyunostomías, laparoscopia exploradora con biopsia y catéteres | Revisar título/agrupación (¿todo es “oncológica”?). Se mantiene “Anatomo Patólogo” tal cual. |
| 5 | tratamientos → `cirugia-laparoscopica-colorrectal` | “Como especialistas en cirugía buscamos… **nuestros pacientes**” | Usa plural (“nosotros”); el resto del sitio habla en primera persona del singular. |
| 6 | Patologías: Apendicitis, Hernias, Cálculos, Hemorroides, Pólipos, Cáncer colorrectal | Párrafos de estilo genérico | Posible texto tomado de fuentes externas: riesgo de **contenido duplicado** para Google. Se recomienda que el Dr. reescriba o personalice estos textos con su experiencia. |
| 7 | tratamientos → `videoendoscopia-digestiva-alta` y `-baja` | Solo tienen video + pie de foto del equipo | No existe texto descriptivo. Convendría agregar: qué es, para qué sirve, preparación, duración. (No se inventó contenido.) |
| 8 | Sin fecha de “última revisión médica” | — | Cuando el Dr. revise las páginas, se puede agregar esa fecha en la plantilla. |

## Torre de videoendoscopia HD (pendiente de aprobación antes de publicar)

Textos nuevos en `includes/torre-hd.php` (se muestran en la home, en Equipamiento, en `/equipamiento/videoendoscopia-alta-definicion/` y en las páginas de Videoendoscopia). Están redactados a partir del folleto y la web del fabricante (SonoScape HD-500) y del distribuidor. **El Dr. debe aprobar estas afirmaciones de beneficio para el paciente**:

| # | Dónde | Texto | Qué confirmar |
|---|---|---|---|
| T1 | `intro` | “…para realizar estudios más precisos y con mayor confort para el paciente.” | ¿Está de acuerdo con “más precisos” y “mayor confort”? |
| T2 | Cromoendoscopia virtual (VIST) | “…lo que ayuda a detectar lesiones en etapas tempranas.” | El fabricante habla de “detección de lesiones y predicción de tumores en etapas tempranas”. |
| T3 | Insuflación con CO₂ | “El CO₂ se absorbe más rápido que el aire, lo que reduce la distensión y las molestias después del estudio.” | No figura en el folleto: es un beneficio clínico general del CO₂ que agregué. Confirmar o quitar. |
| T4 | Imagen HD / water jet / LED / registro digital | Descripciones técnicas del equipo | Confirmar que coinciden con su equipo (monitor de 24”, endoscopios con water jet, estación DICOM). |

No se mencionan lugar de instalación ni modelos de endoscopios (decisión del usuario) y no se afirma exclusividad (“única en la región”). La torre Olympus CV-160 queda como equipo de respaldo en la galería de Equipamiento.

## Datos a confirmar (están en `includes/config.php`)

- Teléfonos, direcciones y **horarios** de ambos consultorios (Imágenes Médicas Dr. Danura: lunes a viernes 16-20; Sanatorio San Roque: lunes a viernes 8-12) y si sigue atendiendo en ambos lugares.
- WhatsApp `+54 9 3777 70-0025`.
- Email mostrado: `dr.lisandro.zenon@gmail.com` (antes el texto decía `dr.lisandrozenon@gmail.com`; llegaban al mismo buzón en Gmail).
- **Matrícula profesional**: no se muestra por ahora (decisión del usuario). Es recomendable agregarla en el pie.
- Los textos “Goya, Corrientes” de títulos y descripciones se tomaron de las direcciones de los consultorios; confirmar que es el posicionamiento deseado.

## Ideas de contenido a futuro (no creadas)

- Preguntas frecuentes de pacientes: preparación para endoscopía, qué llevar a la consulta, recuperación post-colecistectomía.
- Obras sociales/prepagas que atiende.
- Testimonios (con consentimiento por escrito).
- Novedades / blog.
- Textos propios para Videoendoscopia Digestiva Alta/Baja.
