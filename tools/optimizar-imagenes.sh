#!/usr/bin/env bash
# Genera versiones WebP (calidad 80) junto a cada JPG/PNG de contenido en assets/img/.
# - Redimensiona (sin agrandar) a un máximo de 1600 px (slide/) o 1200 px (resto).
# - Sobrescribe el JPG original SOLO si es más grande que el máximo (guardar los originales de cámara fuera del repo).
# - Imprime width/height de cada imagen para usar en el HTML (atributos width/height).
# Uso: tools/optimizar-imagenes.sh [archivo.jpg ...]   (sin argumentos procesa todo assets/img)
# Requiere ImageMagick (magick) y cwebp.
set -euo pipefail
cd "$(dirname "$0")/.."
if [ "$#" -gt 0 ]; then files=("$@"); else mapfile -t files < <(find assets/img -type f \( -iname '*.jpg' -o -iname '*.jpeg' -o -iname '*.png' \) ! -name 'favicon.png' ! -name 'apple-touch-icon.png' ! -name 'og-image.jpg' | sort); fi
for f in "${files[@]}"; do
  max=1200; [[ "$f" == *"/slide/"* ]] && max=1600
  magick "$f" -auto-orient -resize "${max}x${max}>" -strip -quality 85 "$f"
  cwebp -quiet -q 80 -m 6 "$f" -o "${f%.*}.webp"
  echo "$f $(identify -format '%wx%h' "$f") jpg=$(stat -c %s "$f") webp=$(stat -c %s "${f%.*}.webp")"
done
