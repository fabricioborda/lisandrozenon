#!/usr/bin/env bash
# Valida el HTML RENDERIZADO de una o más URLs con el validador W3C (Nu). Sube el HTML a validator.w3.org.
# Uso: tools/validar.sh / /patologias/apendicitis/ ...   (rutas relativas a http://lisandrozenon.local)
HOST="${SITE_URL:-http://lisandrozenon.local}"
total=0
for p in "${@:-/}"; do
  out=$(curl -s "$HOST$p" | curl -s -H 'Content-Type: text/html; charset=utf-8' --data-binary @- 'https://validator.w3.org/nu/?out=gnu')
  e=$(grep -c ': error' <<<"$out"); w=$(grep -c 'warning' <<<"$out")
  echo "$p  errores=$e  avisos=$w"; grep -E ': error|warning' <<<"$out" | head -${MAXLINES:-15}
  total=$((total+e)); sleep 1
done
exit $((total>0))
