/**
 * Interactividad del sitio del Dr. Lisandro Zenón.
 * JavaScript propio sin dependencias; Swiper y GLightbox se cargan solo en las páginas que los usan
 * y cada bloque se inicializa únicamente si existe su elemento.
 */
(function () {
  'use strict';

  var reducedMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var $ = function (sel, root) { return (root || document).querySelector(sel); };
  var $$ = function (sel, root) { return Array.prototype.slice.call((root || document).querySelectorAll(sel)); };

  /* ---------- Menú móvil y submenús ---------- */
  var toggle = $('.nav-toggle');
  var nav = $('#navbar');

  function setMenu(open) {
    if (!toggle || !nav) return;
    nav.classList.toggle('is-open', open);
    toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    toggle.setAttribute('aria-label', open ? 'Cerrar menú' : 'Abrir menú');
    var icon = $('i', toggle);
    if (icon) { icon.className = 'bi ' + (open ? 'bi-x-lg' : 'bi-list'); }
    document.body.style.overflow = open && window.innerWidth < 992 ? 'hidden' : '';
  }

  if (toggle && nav) {
    toggle.addEventListener('click', function () { setMenu(!nav.classList.contains('is-open')); });
    nav.addEventListener('click', function (e) {
      var a = e.target.closest('a');
      if (a && nav.classList.contains('is-open')) { setMenu(false); }
    });
    window.addEventListener('resize', function () { if (window.innerWidth >= 992) { setMenu(false); } });
  }

  $$('.sub-toggle').forEach(function (btn) {
    btn.addEventListener('click', function () {
      var li = btn.closest('.has-sub');
      var open = !li.classList.contains('is-open');
      $$('.has-sub.is-open').forEach(function (o) {
        if (o !== li) { o.classList.remove('is-open'); $('.sub-toggle', o).setAttribute('aria-expanded', 'false'); }
      });
      li.classList.toggle('is-open', open);
      btn.setAttribute('aria-expanded', open ? 'true' : 'false');
    });
  });

  document.addEventListener('keydown', function (e) {
    if (e.key !== 'Escape') return;
    if (nav && nav.classList.contains('is-open')) { setMenu(false); if (toggle) toggle.focus(); }
    $$('.has-sub.is-open').forEach(function (li) { li.classList.remove('is-open'); $('.sub-toggle', li).setAttribute('aria-expanded', 'false'); });
  });

  /* ---------- Botón "volver arriba" ---------- */
  var backToTop = $('.back-to-top');
  if (backToTop) {
    var onScroll = function () { backToTop.classList.toggle('active', window.scrollY > 300); };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  }

  /* ---------- Hero: fondo rotativo (se detiene con prefers-reduced-motion o al interactuar) ---------- */
  var hero = $('[data-hero]');
  if (hero) {
    var slides = $$('.hero-slide', hero);
    var dots = $$('.hero-dot', hero);
    var current = 0;
    var timer = null;
    var show = function (i) {
      current = (i + slides.length) % slides.length;
      slides.forEach(function (s, n) { s.classList.toggle('is-active', n === current); });
      dots.forEach(function (d, n) { d.classList.toggle('is-active', n === current); d.setAttribute('aria-pressed', n === current ? 'true' : 'false'); });
    };
    var stop = function () { if (timer) { clearInterval(timer); timer = null; } };
    var start = function () { if (!reducedMotion && slides.length > 1) { stop(); timer = setInterval(function () { show(current + 1); }, 6000); } };
    dots.forEach(function (d, n) { d.addEventListener('click', function () { show(n); stop(); }); });
    hero.addEventListener('mouseenter', stop);
    hero.addEventListener('mouseleave', start);
    document.addEventListener('visibilitychange', function () { document.hidden ? stop() : start(); });
    start();
  }

  /* ---------- Mapas: se cargan al hacer clic ---------- */
  $$('[data-map]').forEach(function (box) {
    var btn = $('.map-load', box);
    if (!btn) return;
    btn.addEventListener('click', function () {
      var iframe = document.createElement('iframe');
      iframe.src = box.getAttribute('data-map');
      iframe.title = box.getAttribute('data-map-title') || 'Mapa';
      iframe.loading = 'lazy';
      iframe.setAttribute('allowfullscreen', '');
      iframe.referrerPolicy = 'no-referrer-when-downgrade';
      box.replaceChildren(iframe);
    });
  });

  /* ---------- Sliders y lightbox (solo si la librería y el elemento existen) ---------- */
  function sliderOptions(root, breakpoints) {
    var opts = {
      speed: 400,
      loop: true,
      slidesPerView: 1,
      spaceBetween: 20,
      pagination: { el: root.querySelector('.swiper-pagination'), type: 'bullets', clickable: true },
      navigation: { nextEl: root.querySelector('.swiper-btn-next'), prevEl: root.querySelector('.swiper-btn-prev') },
      breakpoints: breakpoints
    };
    if (!reducedMotion) { opts.autoplay = { delay: 5000, disableOnInteraction: true, pauseOnMouseEnter: true }; }
    return opts;
  }

  window.addEventListener('DOMContentLoaded', function () {
    if (typeof Swiper !== 'undefined') {
      var g = $('.gallery-slider');
      if (g) { new Swiper(g, sliderOptions(g, { 640: { slidesPerView: 2 }, 992: { slidesPerView: 3 } })); }
      var e = $('.gallery-equipamiento2');
      if (e) { new Swiper(e, sliderOptions(e, { 640: { slidesPerView: 2 }, 992: { slidesPerView: 3 } })); }
    }
    if (typeof GLightbox !== 'undefined' && $('.gallery-lightbox')) {
      GLightbox({ selector: '.gallery-lightbox' });
    }
  });

  /* ---------- Eventos de conversión en Google Analytics ---------- */
  document.addEventListener('click', function (e) {
    var a = e.target.closest('a[href]');
    if (!a || typeof window.gtag !== 'function') return;
    var href = a.getAttribute('href');
    var method = null;
    if (href.indexOf('https://wa.me') === 0) { method = 'whatsapp'; }
    else if (href.indexOf('tel:') === 0) { method = 'telefono'; }
    else if (href.indexOf('mailto:') === 0) { method = 'email'; }
    if (method) { window.gtag('event', 'contact', { method: method }); }
  });
})();
