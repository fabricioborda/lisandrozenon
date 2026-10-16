// Capturas de pantalla y verificación de consola con Playwright.
// Uso: NODE_MODULES_DIR=/ruta/a/node_modules node tools/capturas.cjs <directorio-salida> [ruta ...]
// Las dependencias (playwright) se instalan FUERA del repo; ver docs/DEPLOY.md / docs/AGREGAR-CONTENIDO.md.
const path = require('path');
const fs = require('fs');
const base = process.env.NODE_MODULES_DIR || path.join(process.cwd(), 'node_modules');
const { chromium } = require(require.resolve('playwright', { paths: [path.dirname(base), base] }));

const HOST = process.env.SITE_HOST || 'lisandrozenon.local';
const out = process.argv[2] || 'docs/capturas/tmp';
const paths = process.argv.slice(3).length ? process.argv.slice(3) : ['/'];
const sizes = [[375, 812], [768, 1024], [1440, 900]];

(async () => {
  fs.mkdirSync(out, { recursive: true });
  const browser = await chromium.launch({ args: [`--host-resolver-rules=MAP ${HOST} 127.0.0.1`] });
  let errors = 0;
  for (const p of paths) {
    for (const [w, h] of sizes) {
      const ctx = await browser.newContext({ viewport: { width: w, height: h } });
      const page = await ctx.newPage();
      page.on('console', m => { if (m.type() === 'error') { errors++; console.log(`[consola ${w}] ${p}: ${m.text()}`); } });
      page.on('pageerror', e => { errors++; console.log(`[pageerror ${w}] ${p}: ${e.message}`); });
      page.on('requestfailed', r => { if (!/googletagmanager|google-analytics|facebook|google\.com\/maps|gstatic|googleapis/.test(r.url())) { errors++; console.log(`[requestfailed ${w}] ${p}: ${r.url()}`); } });
      page.on('response', r => { if (r.status() >= 400 && r.url().includes(HOST)) { errors++; console.log(`[http ${r.status()}] ${r.url()}`); } });
      await page.goto(`http://${HOST}${p}`, { waitUntil: 'load', timeout: 60000 });
      // recorrer la página para disparar AOS / lazy-loading
      await page.evaluate(async () => {
        const step = Math.max(300, innerHeight / 2);
        for (let y = 0; y < document.body.scrollHeight; y += step) { scrollTo(0, y); await new Promise(r => setTimeout(r, 120)); }
        scrollTo(0, 0);
        await new Promise(r => setTimeout(r, 400));
      });
      const name = (p === '/' ? 'home' : p.replace(/^\/|\/$/g, '').replace(/\//g, '_')) + `-${w}.png`;
      await page.screenshot({ path: path.join(out, name), fullPage: true });
      await ctx.close();
    }
  }
  await browser.close();
  console.log(errors ? `ERRORES: ${errors}` : 'Sin errores de consola');
  process.exit(errors ? 1 : 0);
})();
