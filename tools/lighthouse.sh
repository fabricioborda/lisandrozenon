#!/usr/bin/env bash
# Lighthouse móvil. Uso: NODE_MODULES_DIR=... CHROME_PATH=... tools/lighthouse.sh <directorio-salida> [ruta]
# (lighthouse se instala fuera del repo: npm i lighthouse en un directorio temporal)
out="$(realpath -m "${1:-docs/auditoria/tmp}")"; p="${2:-/}"; mkdir -p "$out"; cd "${TMPDIR:-/tmp}"  # evita que Lighthouse cree carpetas temporales dentro del repo
"${NODE_MODULES_DIR:?definir NODE_MODULES_DIR}/.bin/lighthouse" "http://lisandrozenon.local$p" \
  --only-categories=performance,accessibility,best-practices,seo --form-factor=mobile \
  --output=json --output=html --output-path="$out/lighthouse" \
  --chrome-flags="--headless=new --no-sandbox --host-resolver-rules='MAP lisandrozenon.local 127.0.0.1'" --quiet
node -e "const r=require(process.argv[1]);const c=r.categories;console.log(Object.entries(c).map(([k,v])=>k+'='+Math.round(v.score*100)).join('  '));const a=r.audits;console.log('LCP',a['largest-contentful-paint'].displayValue,'CLS',a['cumulative-layout-shift'].displayValue,'TBT',a['total-blocking-time'].displayValue,'peso',a['total-byte-weight'].displayValue)" "$(realpath $out/lighthouse.report.json)"
