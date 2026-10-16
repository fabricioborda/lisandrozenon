#!/usr/bin/env bash
# Comprime un video a MP4 H.264 720p (CRF 27, AAC 96k, faststart) y genera un poster JPG.
# Uso: tools/comprimir-videos.sh "original.mov" nombre-en-kebab-case   -> assets/video/nombre.mp4 y .jpg
# Requiere ffmpeg. Verificar luego con ffprobe que la duración coincide con la del original.
set -euo pipefail
in="$1"; name="$2"; out="$(dirname "$0")/../assets/video"
ffmpeg -y -i "$in" -vf "scale='min(1280,iw)':-2" -c:v libx264 -preset medium -crf 27 -pix_fmt yuv420p \
  -c:a aac -b:a 96k -movflags +faststart "$out/$name.mp4"
ffmpeg -y -ss 5 -i "$in" -frames:v 1 -vf scale=1280:-2 -q:v 4 "$out/$name.jpg"
