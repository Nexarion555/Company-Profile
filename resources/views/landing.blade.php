<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ $settings['company'] }} — Membangun Masa Depan</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,500;0,600;1,400&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
<script>
tailwind.config = {
  theme: {
    extend: {
      fontFamily: { sans: ['Inter','sans-serif'], serif: ['Playfair Display','serif'] },
      colors: {
        navy: { 50:'#eef2f7', 100:'#d4dce8', 200:'#a9b9d1', 300:'#7e96ba', 400:'#5373a3', 500:'#2d5287', 600:'#1b3a6b', 700:'#142d55', 800:'#0d1f3f', 900:'#061228' },
        gold: { 50:'#fdf8ef', 100:'#f9edcf', 200:'#f3db9f', 300:'#edc96f', 400:'#e7b73f', 500:'#c9a044', 600:'#b88a2a', 700:'#8f6b1f', 800:'#664c17', 900:'#3d2e0e' },
        stone: { 50:'#fafaf9', 100:'#f5f5f4', 200:'#e7e5e4', 300:'#d6d3d1', 400:'#a8a29e', 500:'#78716c', 600:'#57534e', 700:'#44403c', 800:'#292524', 900:'#1c1917' }
      }
    }
  }
}
</script>
<style>
*{margin:0;padding:0;box-sizing:border-box;scroll-behavior:smooth}
::selection{background:#1b3a6b;color:#fff}
::-webkit-scrollbar{width:6px}
::-webkit-scrollbar-track{background:#f5f5f4}
::-webkit-scrollbar-thumb{background:#a8a29e;border-radius:3px}
::-webkit-scrollbar-thumb:hover{background:#78716c}

#loader{position:fixed;inset:0;z-index:9999;background:#0d1f3f;display:flex;align-items:center;justify-content:center;flex-direction:column;transition:opacity .6s ease,visibility .6s ease}
#loader.hidden{opacity:0;visibility:hidden;pointer-events:none}
.loader-logo{font-family:'Playfair Display',serif;font-size:2rem;color:#c9a044;letter-spacing:.15em;animation:loaderPulse 1.5s ease-in-out infinite}
.loader-bar{width:200px;height:2px;background:rgba(255,255,255,.15);margin-top:1.5rem;border-radius:2px;overflow:hidden}
.loader-bar-inner{height:100%;width:0;background:linear-gradient(90deg,#c9a044,#e7b73f);border-radius:2px;animation:loaderFill 1.8s ease forwards}
@keyframes loaderPulse{0%,100%{opacity:.6}50%{opacity:1}}
@keyframes loaderFill{to{width:100%}}

.page{display:none;opacity:0;transform:translateY(40px);transition:opacity .5s cubic-bezier(.4,0,.2,1),transform .5s cubic-bezier(.4,0,.2,1)}
.page.active{display:block;opacity:1;transform:translateY(0)}
.page.page-exit{opacity:0;transform:translateY(-40px)}
.page.page-enter{opacity:0;transform:translateY(40px)}

.parallax-hero{position:relative;min-height:100vh;display:flex;align-items:center;overflow:hidden}
.parallax-hero .bg-layer{position:absolute;inset:0;background-size:cover;background-position:center;will-change:transform}
.parallax-hero .overlay{position:absolute;inset:0;background:linear-gradient(135deg,rgba(13,31,63,.85) 0%,rgba(27,58,107,.7) 50%,rgba(13,31,63,.85) 100%)}
.parallax-hero .content{position:relative;z-index:2}

.reveal{opacity:0;transform:translateY(30px);transition:opacity .7s ease,transform .7s ease}
.reveal.revealed{opacity:1;transform:translateY(0)}
.reveal-left{opacity:0;transform:translateX(-40px);transition:opacity .7s ease,transform .7s ease}
.reveal-left.revealed{opacity:1;transform:translateX(0)}
.reveal-right{opacity:0;transform:translateX(40px);transition:opacity .7s ease,transform .7s ease}
.reveal-right.revealed{opacity:1;transform:translateX(0)}
.reveal-scale{opacity:0;transform:scale(.9);transition:opacity .7s ease,transform .7s ease}
.reveal-scale.revealed{opacity:1;transform:scale(1)}

.tilt-card{transform-style:preserve-3d;transition:transform .15s ease-out,box-shadow .3s ease}
.tilt-card .tilt-inner{transform:translateZ(30px)}
.tilt-card:hover{box-shadow:0 25px 50px -12px rgba(0,0,0,.25)}

.flip-card{perspective:1000px;cursor:pointer}
.flip-card-inner{transition:transform .6s cubic-bezier(.4,0,.2,1);transform-style:preserve-3d;position:relative}
.flip-card:hover .flip-card-inner{transform:rotateY(180deg)}
.flip-card-front,.flip-card-back{backface-visibility:hidden;-webkit-backface-visibility:hidden}
.flip-card-back{position:absolute;inset:0;transform:rotateY(180deg)}

.parallax-scroll{will-change:transform}
.gradient-text{background:linear-gradient(135deg,#c9a044,#e7b73f,#c9a044);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
.glass{background:rgba(255,255,255,.08);backdrop-filter:blur(16px);-webkit-backdrop-filter:blur(16px);border:1px solid rgba(255,255,255,.12)}

@keyframes float{0%,100%{transform:translateY(0)}50%{transform:translateY(-10px)}}
.float-anim{animation:float 4s ease-in-out infinite}
.float-anim-delay{animation:float 4s ease-in-out 1s infinite}
.float-anim-delay2{animation:float 4s ease-in-out 2s infinite}

.counter-num{font-variant-numeric:tabular-nums}
.portfolio-item{transition:opacity .5s ease,transform .5s ease}
.portfolio-item.hidden-item{opacity:0;transform:scale(.8);position:absolute;pointer-events:none}
.portfolio-item.show-item{opacity:1;transform:scale(1);position:relative;pointer-events:auto}

#scroll-progress{position:fixed;top:0;left:0;height:3px;background:linear-gradient(90deg,#c9a044,#e7b73f);z-index:100;transition:width .1s linear;width:0}
.mobile-menu{transform:translateX(100%);transition:transform .4s cubic-bezier(.4,0,.2,1)}
.mobile-menu.open{transform:translateX(0)}
.grain::after{content:'';position:absolute;inset:0;opacity:.03;background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)'/%3E%3C/svg%3E");pointer-events:none;z-index:1}
.toast{position:fixed;bottom:2rem;right:2rem;z-index:9998;background:#1b3a6b;color:#fff;padding:1rem 1.5rem;border-radius:.75rem;box-shadow:0 20px 40px rgba(0,0,0,.3);transform:translateY(120%);opacity:0;transition:all .4s ease;font-size:.875rem}
.toast.show{transform:translateY(0);opacity:1}

/* ===== TRACKING ANIMATIONS ===== */
@keyframes shakeError{
  0%,100%{transform:translateX(0)}
  10%,30%,50%,70%,90%{transform:translateX(-8px)}
  20%,40%,60%,80%{transform:translateX(8px)}
}
.shake-error{animation:shakeError .6s ease}

@keyframes successPulse{
  0%{transform:scale(0);opacity:0}
  50%{transform:scale(1.15)}
  100%{transform:scale(1);opacity:1}
}
.success-pulse{animation:successPulse .6s cubic-bezier(.4,0,.2,1) forwards}

@keyframes successRing{
  0%{transform:scale(.5);opacity:1}
  100%{transform:scale(2.5);opacity:0}
}
.success-ring{animation:successRing .8s ease-out forwards}

@keyframes trackSlideUp{
  0%{opacity:0;transform:translateY(40px)}
  100%{opacity:1;transform:translateY(0)}
}
.track-slide-up{animation:trackSlideUp .6s cubic-bezier(.4,0,.2,1) forwards}

@keyframes stepReveal{
  0%{opacity:0;transform:translateX(-20px)}
  100%{opacity:1;transform:translateX(0)}
}

@keyframes progressFill{
  0%{width:0}
  100%{width:var(--fill)}
}
.progress-fill-anim{animation:progressFill 1.2s cubic-bezier(.4,0,.2,1) forwards}

@keyframes confetti{
  0%{transform:translateY(0) rotate(0deg);opacity:1}
  100%{transform:translateY(-120px) rotate(720deg);opacity:0}
}
.confetti-particle{
  position:absolute;width:8px;height:8px;border-radius:2px;
  animation:confetti 1s ease-out forwards;
}

@keyframes errorFadeIn{
  0%{opacity:0;transform:translateY(-8px)}
  100%{opacity:1;transform:translateY(0)}
}
.error-fade-in{animation:errorFadeIn .4s ease forwards}

@keyframes inputErrorGlow{
  0%,100%{box-shadow:0 0 0 0 rgba(239,68,68,0)}
  50%{box-shadow:0 0 0 6px rgba(239,68,68,.2)}
}
.input-error-glow{animation:inputErrorGlow .6s ease}

@keyframes shimmer{
  0%{background-position:-200% 0}
  100%{background-position:200% 0}
}
.shimmer-bg{
  background:linear-gradient(90deg,transparent 30%,rgba(255,255,255,.08) 50%,transparent 70%);
  background-size:200% 100%;
  animation:shimmer 2s ease-in-out infinite;
}

@media(max-width:768px){
  .parallax-hero{min-height:100svh}
  .flip-card:hover .flip-card-inner{transform:none}
}

/* ===== SCHEDULING / CALENDAR ===== */
.cal-day{width:100%;aspect-ratio:1;display:flex;align-items:center;justify-content:center;border-radius:12px;font-size:.875rem;font-weight:500;cursor:pointer;transition:all .2s ease;position:relative}
.cal-day:not(.disabled):not(.empty):hover{background:#eef2f7;color:#1b3a6b;transform:scale(1.08)}
.cal-day.selected{background:#1b3a6b!important;color:#fff!important;transform:scale(1.08);box-shadow:0 4px 14px rgba(27,58,107,.3)}
.cal-day.today:not(.selected){border:2px solid #c9a044;color:#c9a044}
.cal-day.disabled{color:#d6d3d1;cursor:not-allowed;pointer-events:none}
.cal-day.empty{cursor:default}
.cal-day.sunday{color:#fca5a5;cursor:not-allowed;pointer-events:none}

.time-slot{padding:10px 8px;border-radius:12px;border:2px solid #e7e5e4;text-align:center;cursor:pointer;transition:all .2s ease;font-size:.8rem;font-weight:500}
.time-slot:not(.taken):hover{border-color:#1b3a6b;color:#1b3a6b;background:#eef2f7;transform:translateY(-2px)}
.time-slot.selected{border-color:#1b3a6b;background:#1b3a6b;color:#fff;transform:translateY(-2px);box-shadow:0 4px 14px rgba(27,58,107,.25)}
.time-slot.taken{background:#f5f5f4;color:#d6d3d1;border-color:#f5f5f4;cursor:not-allowed;text-decoration:line-through}
.time-slot.disabled-slot{opacity:.4;cursor:not-allowed;pointer-events:none}

@keyframes bookingSuccess{
  0%{transform:scale(0) rotate(-10deg);opacity:0}
  60%{transform:scale(1.1) rotate(2deg)}
  100%{transform:scale(1) rotate(0);opacity:1}
}
.booking-success-anim{animation:bookingSuccess .6s cubic-bezier(.4,0,.2,1) forwards}

@keyframes bookingSlideIn{
  0%{opacity:0;transform:translateY(20px)}
  100%{opacity:1;transform:translateY(0)}
}
.booking-slide-in{animation:bookingSlideIn .5s ease forwards}

@keyframes calFadeIn{
  0%{opacity:0;transform:translateY(8px)}
  100%{opacity:1;transform:translateY(0)}
}
.cal-fade-in{animation:calFadeIn .3s ease forwards}

.summary-pulse{transition:all .3s ease}
.summary-pulse.updated{background:#142d55!important;box-shadow:0 0 0 3px rgba(201,160,68,.3)}

</style>
</head>
<body class="font-sans text-stone-800 bg-stone-50 overflow-x-hidden">

<div id="scroll-progress"></div>

<div id="loader">
  <div class="loader-logo">KSN</div>
  <p class="text-stone-400 text-xs tracking-[.3em] uppercase mt-3">Karya Struktur Nusantara</p>
  <div class="loader-bar"><div class="loader-bar-inner"></div></div>
</div>

<nav id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-500">
  <div class="max-w-7xl mx-auto px-6 flex items-center justify-between h-20">
    <a href="#" onclick="navigateTo('home');return false" class="flex items-center gap-3 group">
      <div class="w-10 h-10 bg-gold-500 rounded-lg flex items-center justify-center text-navy-900 font-serif font-semibold text-lg group-hover:scale-110 transition-transform duration-300">K</div>
      <div class="hidden sm:block">
        <div class="text-sm font-semibold tracking-wide text-white">KSN</div>
        <div class="text-[10px] tracking-[.2em] uppercase text-stone-400">Konstruksi</div>
      </div>
    </a>
    <div class="hidden lg:flex items-center gap-8">
      <a href="#" onclick="navigateTo('home');return false" class="nav-link text-sm font-medium text-stone-300 hover:text-gold-500 transition-colors duration-300" data-page="home">Beranda</a>
      <a href="#" onclick="navigateTo('about');return false" class="nav-link text-sm font-medium text-stone-300 hover:text-gold-500 transition-colors duration-300" data-page="about">Tentang</a>
      <a href="#" onclick="navigateTo('services');return false" class="nav-link text-sm font-medium text-stone-300 hover:text-gold-500 transition-colors duration-300" data-page="services">Layanan</a>
      <a href="#" onclick="navigateTo('categories');return false" class="nav-link text-sm font-medium text-stone-300 hover:text-gold-500 transition-colors duration-300" data-page="categories">Kategori</a>
      <a href="#" onclick="navigateTo('portfolio');return false" class="nav-link text-sm font-medium text-stone-300 hover:text-gold-500 transition-colors duration-300" data-page="portfolio">Portofolio</a>
      <!-- <a href="#" onclick="navigateTo('tracking');return false" class="nav-link text-sm font-medium text-stone-300 hover:text-gold-500 transition-colors duration-300" data-page="tracking">Tracking</a> -->
      <a href="#" onclick="navigateTo('contact');return false" class="px-5 py-2.5 bg-gold-500 text-navy-900 text-xs font-semibold tracking-wider uppercase rounded-lg hover:bg-gold-400 transition-all duration-300 hover:shadow-lg hover:shadow-gold-500/20 hover:-translate-y-0.5">Hubungi Kami</a>
    </div>
    <button onclick="toggleMobile()" class="lg:hidden text-white p-2">
      <iconify-icon icon="lucide:menu" width="24" id="menu-icon"></iconify-icon>
    </button>
  </div>
</nav>

<div class="mobile-menu fixed inset-0 z-[60] bg-navy-900/98 backdrop-blur-xl flex flex-col" id="mobile-menu">
  <div class="flex items-center justify-between px-6 h-20">
    <div class="flex items-center gap-3">
      <div class="w-10 h-10 bg-gold-500 rounded-lg flex items-center justify-center text-navy-900 font-serif font-semibold text-lg">K</div>
      <span class="text-white font-semibold">KSN</span>
    </div>
    <button onclick="toggleMobile()" class="text-white p-2"><iconify-icon icon="lucide:x" width="24"></iconify-icon></button>
  </div>
  <div class="flex-1 flex flex-col justify-center items-center gap-6">
    <a href="#" onclick="navigateTo('home');toggleMobile();return false" class="text-2xl font-light text-white hover:text-gold-500 transition-colors">Beranda</a>
    <a href="#" onclick="navigateTo('about');toggleMobile();return false" class="text-2xl font-light text-white hover:text-gold-500 transition-colors">Tentang</a>
    <a href="#" onclick="navigateTo('services');toggleMobile();return false" class="text-2xl font-light text-white hover:text-gold-500 transition-colors">Layanan</a>
    <a href="#" onclick="navigateTo('categories');toggleMobile();return false" class="text-2xl font-light text-white hover:text-gold-500 transition-colors">Kategori</a>
    <a href="#" onclick="navigateTo('portfolio');toggleMobile();return false" class="text-2xl font-light text-white hover:text-gold-500 transition-colors">Portofolio</a>
    <!-- <a href="#" onclick="navigateTo('tracking');toggleMobile();return false" class="text-2xl font-light text-white hover:text-gold-500 transition-colors">Tracking</a> -->
    <a href="#" onclick="navigateTo('contact');toggleMobile();return false" class="mt-4 px-8 py-3 bg-gold-500 text-navy-900 text-sm font-semibold tracking-wider uppercase rounded-lg">Hubungi Kami</a>
  </div>
</div>

<!-- ==================== PAGE: HOME ==================== -->
<div id="page-home" class="page active" style="display:block;opacity:1;transform:translateY(0)">
  <section class="parallax-hero grain">
    <div class="bg-layer" style="background-image:url('https://picsum.photos/seed/construction-skyline/1920/1080')"></div>
    <div class="overlay"></div>
    <div class="content w-full max-w-7xl mx-auto px-6 pt-32 pb-20">
      <div class="max-w-3xl">
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full glass text-gold-400 text-xs tracking-[.15em] uppercase mb-8 reveal">
          <iconify-icon icon="lucide:award" width="14"></iconify-icon>
          Terpercaya Sejak 2008
        </div>
        <h1 class="font-serif text-4xl sm:text-5xl md:text-6xl lg:text-7xl text-white leading-[1.1] tracking-tight reveal" style="transition-delay:.1s">
          Membangun<br><span class="gradient-text">Masa Depan</span>,<br>Merancang Keindahan
        </h1>
        <p class="mt-6 text-stone-300 text-base sm:text-lg font-light leading-relaxed max-w-xl reveal" style="transition-delay:.2s">
          {{ $settings['company'] }} menghadirkan solusi konstruksi, arsitektur, dan desain interior terdepan yang menggabungkan estetika, fungsi, dan keberlanjutan.
        </p>
        <div class="flex flex-wrap gap-4 mt-10 reveal" style="transition-delay:.3s">
          <a href="#" onclick="navigateTo('portfolio');return false" class="px-8 py-3.5 bg-gold-500 text-navy-900 text-xs font-semibold tracking-[.15em] uppercase rounded-lg hover:bg-gold-400 transition-all duration-300 hover:shadow-xl hover:shadow-gold-500/20 hover:-translate-y-1 flex items-center gap-2">
            Lihat Portofolio <iconify-icon icon="lucide:arrow-right" width="14"></iconify-icon>
          </a>
          <a href="#" onclick="navigateTo('services');return false" class="px-8 py-3.5 glass text-white text-xs font-semibold tracking-[.15em] uppercase rounded-lg hover:bg-white/15 transition-all duration-300 hover:-translate-y-1">
            Layanan Kami
          </a>
        </div>
      </div>
      <div class="absolute bottom-10 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 text-stone-400 float-anim">
        <span class="text-[10px] tracking-[.2em] uppercase">Scroll</span>
        <iconify-icon icon="lucide:chevron-down" width="16"></iconify-icon>
      </div>
    </div>
  </section>

  <section class="relative -mt-16 z-10 px-6">
    <div class="max-w-5xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-4">
      <div class="tilt-card bg-white rounded-2xl p-6 text-center shadow-lg reveal-scale" style="transition-delay:.1s">
        <div class="text-3xl md:text-4xl font-serif font-medium text-navy-700 counter-num" data-target="350">0</div>
        <div class="text-xs text-stone-500 mt-2 tracking-wider uppercase">Proyek Selesai</div>
      </div>
      <div class="tilt-card bg-white rounded-2xl p-6 text-center shadow-lg reveal-scale" style="transition-delay:.2s">
        <div class="text-3xl md:text-4xl font-serif font-medium text-navy-700 counter-num" data-target="180">0</div>
        <div class="text-xs text-stone-500 mt-2 tracking-wider uppercase">Klien Puas</div>
      </div>
      <div class="tilt-card bg-white rounded-2xl p-6 text-center shadow-lg reveal-scale" style="transition-delay:.3s">
        <div class="text-3xl md:text-4xl font-serif font-medium text-navy-700 counter-num" data-target="16">0</div>
        <div class="text-xs text-stone-500 mt-2 tracking-wider uppercase">Tahun Pengalaman</div>
      </div>
      <div class="tilt-card bg-white rounded-2xl p-6 text-center shadow-lg reveal-scale" style="transition-delay:.4s">
        <div class="text-3xl md:text-4xl font-serif font-medium text-navy-700 counter-num" data-target="45">0</div>
        <div class="text-xs text-stone-500 mt-2 tracking-wider uppercase">Tim Profesional</div>
      </div>
    </div>
  </section>

  <section class="py-24 px-6">
    <div class="max-w-7xl mx-auto">
      <div class="text-center mb-16">
        <span class="text-xs font-semibold tracking-[.2em] uppercase text-gold-600 reveal">Layanan Kami</span>
        <h2 class="font-serif text-3xl sm:text-4xl md:text-5xl tracking-tight mt-4 reveal" style="transition-delay:.1s">Solusi Konstruksi <em class="text-navy-600">Terintegrasi</em></h2>
        <p class="text-stone-500 mt-4 max-w-2xl mx-auto font-light reveal" style="transition-delay:.2s">Dari konsep hingga realisasi, kami menangani setiap tahap dengan presisi dan dedikasi tinggi.</p>
      </div>
      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div class="tilt-card group bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-500 reveal" style="transition-delay:.1s">
          <div class="relative h-56 overflow-hidden">
            <img src="https://picsum.photos/seed/interior-luxury/800/600" alt="Desain Interior" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
            <div class="absolute inset-0 bg-gradient-to-t from-navy-900/60 to-transparent"></div>
            <div class="absolute bottom-4 left-4 w-12 h-12 rounded-xl bg-gold-500/90 flex items-center justify-center text-navy-900">
              <iconify-icon icon="lucide:sofa" width="22"></iconify-icon>
            </div>
          </div>
          <div class="p-6">
            <h3 class="font-serif text-xl font-medium">Desain Interior</h3>
            <p class="text-stone-500 text-sm font-light mt-2 leading-relaxed">Merancang ruang hidup dan kerja yang fungsional, estetis, dan mencerminkan identitas pemiliknya.</p>
            <a href="#" onclick="navigateTo('services');return false" class="inline-flex items-center gap-1 text-gold-600 text-sm font-medium mt-4 group/link">
              Selengkapnya <iconify-icon icon="lucide:arrow-right" width="14" class="group-hover/link:translate-x-1 transition-transform"></iconify-icon>
            </a>
          </div>
        </div>
        <div class="tilt-card group bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-500 reveal" style="transition-delay:.2s">
          <div class="relative h-56 overflow-hidden">
            <img src="https://picsum.photos/seed/building-arch/800/600" alt="Desain Gedung" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
            <div class="absolute inset-0 bg-gradient-to-t from-navy-900/60 to-transparent"></div>
            <div class="absolute bottom-4 left-4 w-12 h-12 rounded-xl bg-gold-500/90 flex items-center justify-center text-navy-900">
              <iconify-icon icon="lucide:building-2" width="22"></iconify-icon>
            </div>
          </div>
          <div class="p-6">
            <h3 class="font-serif text-xl font-medium">Desain Gedung</h3>
            <p class="text-stone-500 text-sm font-light mt-2 leading-relaxed">Arsitektur inovatif untuk gedung komersial, residensial, dan publik dengan standar internasional.</p>
            <a href="#" onclick="navigateTo('services');return false" class="inline-flex items-center gap-1 text-gold-600 text-sm font-medium mt-4 group/link">
              Selengkapnya <iconify-icon icon="lucide:arrow-right" width="14" class="group-hover/link:translate-x-1 transition-transform"></iconify-icon>
            </a>
          </div>
        </div>
        <div class="tilt-card group bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-500 reveal" style="transition-delay:.3s">
          <div class="relative h-56 overflow-hidden">
            <img src="https://picsum.photos/seed/construction-crane/800/600" alt="Konstruksi" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
            <div class="absolute inset-0 bg-gradient-to-t from-navy-900/60 to-transparent"></div>
            <div class="absolute bottom-4 left-4 w-12 h-12 rounded-xl bg-gold-500/90 flex items-center justify-center text-navy-900">
              <iconify-icon icon="lucide:hard-hat" width="22"></iconify-icon>
            </div>
          </div>
          <div class="p-6">
            <h3 class="font-serif text-xl font-medium">Konstruksi Bangunan</h3>
            <p class="text-stone-500 text-sm font-light mt-2 leading-relaxed">Pelaksanaan pembangunan dari pondasi hingga finishing dengan kualitas dan ketepatan waktu terjamin.</p>
            <a href="#" onclick="navigateTo('services');return false" class="inline-flex items-center gap-1 text-gold-600 text-sm font-medium mt-4 group/link">
              Selengkapnya <iconify-icon icon="lucide:arrow-right" width="14" class="group-hover/link:translate-x-1 transition-transform"></iconify-icon>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="relative py-32 overflow-hidden">
    <div class="absolute inset-0 parallax-scroll" style="background-image:url('https://picsum.photos/seed/architect-drawing/1920/800');background-size:cover;background-position:center;background-attachment:fixed"></div>
    <div class="absolute inset-0 bg-navy-900/90"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-6">
      <div class="text-center mb-16">
        <span class="text-xs font-semibold tracking-[.2em] uppercase text-gold-400 reveal">Mengapa Kami</span>
        <h2 class="font-serif text-3xl sm:text-4xl text-white tracking-tight mt-4 reveal" style="transition-delay:.1s">Keunggulan yang <em>Membedakan</em></h2>
      </div>
      <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
        <div class="text-center reveal" style="transition-delay:.1s">
          <div class="w-16 h-16 mx-auto rounded-2xl bg-gold-500/15 flex items-center justify-center text-gold-400 mb-4 float-anim">
            <iconify-icon icon="lucide:shield-check" width="28"></iconify-icon>
          </div>
          <h3 class="text-white font-medium mb-2">Bergaransi</h3>
          <p class="text-stone-400 text-sm font-light">Setiap proyek dilindungi garansi struktural hingga 10 tahun.</p>
        </div>
        <div class="text-center reveal" style="transition-delay:.2s">
          <div class="w-16 h-16 mx-auto rounded-2xl bg-gold-500/15 flex items-center justify-center text-gold-400 mb-4 float-anim-delay">
            <iconify-icon icon="lucide:clock" width="28"></iconify-icon>
          </div>
          <h3 class="text-white font-medium mb-2">Tepat Waktu</h3>
          <p class="text-stone-400 text-sm font-light">Komitmen penyelesaian proyek sesuai jadwal yang disepakati.</p>
        </div>
        <div class="text-center reveal" style="transition-delay:.3s">
          <div class="w-16 h-16 mx-auto rounded-2xl bg-gold-500/15 flex items-center justify-center text-gold-400 mb-4 float-anim-delay2">
            <iconify-icon icon="lucide:ruler" width="28"></iconify-icon>
          </div>
          <h3 class="text-white font-medium mb-2">Presisi Tinggi</h3>
          <p class="text-stone-400 text-sm font-light">Menggunakan teknologi BIM dan laser scanning untuk akurasi maksimal.</p>
        </div>
        <div class="text-center reveal" style="transition-delay:.4s">
          <div class="w-16 h-16 mx-auto rounded-2xl bg-gold-500/15 flex items-center justify-center text-gold-400 mb-4 float-anim">
            <iconify-icon icon="lucide:leaf" width="28"></iconify-icon>
          </div>
          <h3 class="text-white font-medium mb-2">Ramah Lingkungan</h3>
          <p class="text-stone-400 text-sm font-light">Menerapkan prinsip green building dan material berkelanjutan.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="py-24 px-6 bg-stone-100">
    <div class="max-w-7xl mx-auto">
      <div class="text-center mb-16">
        <span class="text-xs font-semibold tracking-[.2em] uppercase text-gold-600 reveal">Testimoni</span>
        <h2 class="font-serif text-3xl sm:text-4xl tracking-tight mt-4 reveal" style="transition-delay:.1s">Apa Kata <em class="text-navy-600">Klien Kami</em></h2>
      </div>
      <div class="grid md:grid-cols-3 gap-8">
        <div class="tilt-card bg-white rounded-2xl p-8 shadow-md reveal" style="transition-delay:.1s">
          <div class="flex gap-1 text-gold-500 mb-4">
            <iconify-icon icon="lucide:star" width="16"></iconify-icon><iconify-icon icon="lucide:star" width="16"></iconify-icon><iconify-icon icon="lucide:star" width="16"></iconify-icon><iconify-icon icon="lucide:star" width="16"></iconify-icon><iconify-icon icon="lucide:star" width="16"></iconify-icon>
          </div>
          <p class="text-stone-600 text-sm font-light leading-relaxed italic">"KSN berhasil mewujudkan visi kami untuk kantor pusat yang modern dan efisien. Prosesnya profesional dari awal hingga akhir."</p>
          <div class="flex items-center gap-3 mt-6">
            <img src="https://picsum.photos/seed/ceo-man/100/100" alt="" class="w-10 h-10 rounded-full object-cover">
            <div><div class="text-sm font-medium">Hendra Wijaya</div><div class="text-xs text-stone-400">CEO, PT Maju Bersama</div></div>
          </div>
        </div>
        <div class="tilt-card bg-white rounded-2xl p-8 shadow-md reveal" style="transition-delay:.2s">
          <div class="flex gap-1 text-gold-500 mb-4">
            <iconify-icon icon="lucide:star" width="16"></iconify-icon><iconify-icon icon="lucide:star" width="16"></iconify-icon><iconify-icon icon="lucide:star" width="16"></iconify-icon><iconify-icon icon="lucide:star" width="16"></iconify-icon><iconify-icon icon="lucide:star" width="16"></iconify-icon>
          </div>
          <p class="text-stone-600 text-sm font-light leading-relaxed italic">"Desain interior rumah kami luar biasa. Tim KSN sangat mendengarkan kebutuhan dan menghasilkan sesuatu yang melebihi ekspektasi."</p>
          <div class="flex items-center gap-3 mt-6">
            <img src="https://picsum.photos/seed/woman-elegant/100/100" alt="" class="w-10 h-10 rounded-full object-cover">
            <div><div class="text-sm font-medium">Diana Kusuma</div><div class="text-xs text-stone-400">Pemilik, Residensi Permata</div></div>
          </div>
        </div>
        <div class="tilt-card bg-white rounded-2xl p-8 shadow-md reveal" style="transition-delay:.3s">
          <div class="flex gap-1 text-gold-500 mb-4">
            <iconify-icon icon="lucide:star" width="16"></iconify-icon><iconify-icon icon="lucide:star" width="16"></iconify-icon><iconify-icon icon="lucide:star" width="16"></iconify-icon><iconify-icon icon="lucide:star" width="16"></iconify-icon><iconify-icon icon="lucide:star" width="16"></iconify-icon>
          </div>
          <p class="text-stone-600 text-sm font-light leading-relaxed italic">"Renovasi hotel kami selesai 2 minggu lebih cepat dari jadwal dengan kualitas yang sangat memuaskan. Sangat merekomendasikan KSN."</p>
          <div class="flex items-center gap-3 mt-6">
            <img src="https://picsum.photos/seed/hotel-manager/100/100" alt="" class="w-10 h-10 rounded-full object-cover">
            <div><div class="text-sm font-medium">Rizal Pratama</div><div class="text-xs text-stone-400">GM, Hotel Grand Nusantara</div></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="py-24 px-6 bg-navy-800">
    <div class="max-w-4xl mx-auto text-center">
      <h2 class="font-serif text-3xl sm:text-4xl text-white tracking-tight reveal">Siap Memulai Proyek <em class="gradient-text">Impian</em> Anda?</h2>
      <p class="text-stone-400 mt-4 font-light reveal" style="transition-delay:.1s">Konsultasikan kebutuhan konstruksi dan desain Anda bersama tim ahli kami. Gratis, tanpa komitmen.</p>
      <div class="flex flex-wrap justify-center gap-4 mt-10 reveal" style="transition-delay:.2s">
        <a href="#" onclick="navigateTo('contact');return false" class="px-8 py-3.5 bg-gold-500 text-navy-900 text-xs font-semibold tracking-[.15em] uppercase rounded-lg hover:bg-gold-400 transition-all duration-300 hover:shadow-xl hover:shadow-gold-500/20 hover:-translate-y-1">Konsultasi Gratis</a>
        <a href="{{ $settings['phone_href'] }}" class="px-8 py-3.5 border border-stone-600 text-white text-xs font-semibold tracking-[.15em] uppercase rounded-lg hover:border-gold-500 hover:text-gold-500 transition-all duration-300 hover:-translate-y-1 flex items-center gap-2">
          <iconify-icon icon="lucide:phone" width="14"></iconify-icon> {{ $settings['phone'] }}
        </a>
      </div>
    </div>
  </section>
</div>

<!-- ==================== PAGE: ABOUT ==================== -->
<div id="page-about" class="page">
  <section class="parallax-hero grain" style="min-height:60vh">
    <div class="bg-layer" style="background-image:url('https://picsum.photos/seed/team-meeting/1920/900')"></div>
    <div class="overlay"></div>
    <div class="content w-full max-w-7xl mx-auto px-6 pt-32 pb-20">
      <span class="text-xs font-semibold tracking-[.2em] uppercase text-gold-400 reveal">Tentang Kami</span>
      <h1 class="font-serif text-4xl sm:text-5xl md:text-6xl text-white tracking-tight mt-4 reveal" style="transition-delay:.1s">Membangun Kepercayaan,<br><em class="gradient-text">Mewujudkan Visi</em></h1>
      <p class="text-stone-300 font-light mt-6 max-w-xl reveal" style="transition-delay:.2s">Mengenal lebih dekat {{ $settings['company'] }} — mitra terpercaya Anda dalam dunia konstruksi dan desain.</p>
    </div>
  </section>
  <section class="py-24 px-6">
    <div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-16 items-center">
      <div class="reveal-left">
        <img src="https://picsum.photos/seed/architect-plan/800/600" alt="Company" class="w-full h-[400px] object-cover rounded-2xl shadow-xl">
      </div>
      <div class="reveal-right">
        <span class="text-xs font-semibold tracking-[.2em] uppercase text-gold-600">Cerita Kami</span>
        <h2 class="font-serif text-3xl sm:text-4xl tracking-tight mt-4">Dari Visi Menjadi <em class="text-navy-600">Realitas</em></h2>
        <p class="text-stone-600 font-light leading-relaxed mt-6">{{ $settings['company'] }} didirikan pada tahun 2008 oleh Ir. Budi Santoso dengan visi sederhana namun ambisius: menciptakan ruang dan bangunan yang tidak hanya indah secara visual, tetapi juga fungsional, berkelanjutan, dan bernilai tinggi.</p>
        <p class="text-stone-600 font-light leading-relaxed mt-4">Berawal dari sebuah studio kecil di Jakarta Selatan dengan 5 orang tim, kini KSN telah berkembang menjadi perusahaan konstruksi terintegrasi dengan lebih dari 45 profesional yang telah menyelesaikan 350+ proyek di seluruh Indonesia.</p>
        <div class="grid grid-cols-2 gap-6 mt-8">
          <div class="flex items-start gap-3">
            <div class="w-10 h-10 rounded-lg bg-navy-50 flex items-center justify-center text-navy-600 flex-shrink-0"><iconify-icon icon="lucide:target" width="18"></iconify-icon></div>
            <div><div class="text-sm font-medium">Bersertifikasi</div><div class="text-xs text-stone-400">ISO 9001, ISO 14001, OHSAS</div></div>
          </div>
          <div class="flex items-start gap-3">
            <div class="w-10 h-10 rounded-lg bg-navy-50 flex items-center justify-center text-navy-600 flex-shrink-0"><iconify-icon icon="lucide:map-pin" width="18"></iconify-icon></div>
            <div><div class="text-sm font-medium">Nasional</div><div class="text-xs text-stone-400">Proyek di 15+ kota</div></div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="py-24 px-6 bg-stone-100">
    <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-8">
      <div class="tilt-card bg-white rounded-2xl p-10 shadow-md reveal" style="transition-delay:.1s">
        <div class="w-14 h-14 rounded-xl bg-navy-700 flex items-center justify-center text-gold-400 mb-6"><iconify-icon icon="lucide:eye" width="24"></iconify-icon></div>
        <h3 class="font-serif text-2xl mb-4">Visi</h3>
        <p class="text-stone-600 font-light leading-relaxed">Menjadi perusahaan konstruksi dan desain terdepan di Indonesia yang dikenal karena inovasi, kualitas, dan keberlanjutan, serta menjadi pilihan utama dalam mewujudkan bangunan dan ruang yang menginspirasi.</p>
      </div>
      <div class="tilt-card bg-white rounded-2xl p-10 shadow-md reveal" style="transition-delay:.2s">
        <div class="w-14 h-14 rounded-xl bg-gold-500 flex items-center justify-center text-navy-900 mb-6"><iconify-icon icon="lucide:compass" width="24"></iconify-icon></div>
        <h3 class="font-serif text-2xl mb-4">Misi</h3>
        <ul class="text-stone-600 font-light leading-relaxed space-y-3">
          <li class="flex items-start gap-2"><iconify-icon icon="lucide:check-circle-2" width="16" class="text-gold-500 mt-1 flex-shrink-0"></iconify-icon>Menyediakan layanan konstruksi dan desain berkualitas internasional</li>
          <li class="flex items-start gap-2"><iconify-icon icon="lucide:check-circle-2" width="16" class="text-gold-500 mt-1 flex-shrink-0"></iconify-icon>Mengadopsi teknologi terkini dalam setiap proses kerja</li>
          <li class="flex items-start gap-2"><iconify-icon icon="lucide:check-circle-2" width="16" class="text-gold-500 mt-1 flex-shrink-0"></iconify-icon>Membangun tim profesional yang terus berkembang</li>
          <li class="flex items-start gap-2"><iconify-icon icon="lucide:check-circle-2" width="16" class="text-gold-500 mt-1 flex-shrink-0"></iconify-icon>Berkontribusi pada pembangunan berkelanjutan Indonesia</li>
        </ul>
      </div>
    </div>
  </section>
  <section class="py-24 px-6">
    <div class="max-w-7xl mx-auto">
      <div class="text-center mb-16">
        <span class="text-xs font-semibold tracking-[.2em] uppercase text-gold-600 reveal">Nilai-Nilai Kami</span>
        <h2 class="font-serif text-3xl sm:text-4xl tracking-tight mt-4 reveal" style="transition-delay:.1s">Prinsip yang <em class="text-navy-600">Kami Pegang</em></h2>
      </div>
      <div class="grid sm:grid-cols-2 lg:grid-cols-5 gap-6">
        <div class="tilt-card text-center p-6 bg-white rounded-2xl shadow-sm hover:shadow-lg transition-shadow duration-500 reveal" style="transition-delay:.05s"><div class="text-3xl mb-3">🏆</div><h4 class="font-medium text-sm">Integritas</h4><p class="text-xs text-stone-400 mt-2 font-light">Jujur dan transparan dalam setiap aspek pekerjaan</p></div>
        <div class="tilt-card text-center p-6 bg-white rounded-2xl shadow-sm hover:shadow-lg transition-shadow duration-500 reveal" style="transition-delay:.1s"><div class="text-3xl mb-3">💡</div><h4 class="font-medium text-sm">Inovasi</h4><p class="text-xs text-stone-400 mt-2 font-light">Selalu mencari solusi kreatif dan terkini</p></div>
        <div class="tilt-card text-center p-6 bg-white rounded-2xl shadow-sm hover:shadow-lg transition-shadow duration-500 reveal" style="transition-delay:.15s"><div class="text-3xl mb-3">🤝</div><h4 class="font-medium text-sm">Kolaborasi</h4><p class="text-xs text-stone-400 mt-2 font-light">Bekerja sama sebagai satu tim dengan klien</p></div>
        <div class="tilt-card text-center p-6 bg-white rounded-2xl shadow-sm hover:shadow-lg transition-shadow duration-500 reveal" style="transition-delay:.2s"><div class="text-3xl mb-3">📐</div><h4 class="font-medium text-sm">Presisi</h4><p class="text-xs text-stone-400 mt-2 font-light">Perhatian mendalam terhadap setiap detail</p></div>
        <div class="tilt-card text-center p-6 bg-white rounded-2xl shadow-sm hover:shadow-lg transition-shadow duration-500 reveal" style="transition-delay:.25s"><div class="text-3xl mb-3">🌱</div><h4 class="font-medium text-sm">Keberlanjutan</h4><p class="text-xs text-stone-400 mt-2 font-light">Bertanggung jawab terhadap lingkungan</p></div>
      </div>
    </div>
  </section>
  <section class="py-24 px-6 bg-navy-800">
    <div class="max-w-7xl mx-auto">
      <div class="text-center mb-16">
        <span class="text-xs font-semibold tracking-[.2em] uppercase text-gold-400 reveal">Tim Kami</span>
        <h2 class="font-serif text-3xl sm:text-4xl text-white tracking-tight mt-4 reveal" style="transition-delay:.1s">Para <em class="gradient-text">Ahli</em> di Balik KSN</h2>
      </div>
      <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
        <div class="flip-card h-[420px] reveal" style="transition-delay:.1s">
          <div class="flip-card-inner w-full h-full">
            <div class="flip-card-front rounded-2xl overflow-hidden"><img src="https://picsum.photos/seed/director-man/400/500" alt="Budi Santoso" class="w-full h-full object-cover"><div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-navy-900 to-transparent p-6"><h3 class="text-white font-medium">Ir. Budi Santoso, M.T.</h3><p class="text-gold-400 text-xs">Direktur Utama</p></div></div>
            <div class="flip-card-back rounded-2xl bg-navy-700 p-6 flex flex-col justify-center items-center text-center"><div class="w-16 h-16 rounded-full bg-gold-500/20 flex items-center justify-center text-gold-400 mb-4"><iconify-icon icon="lucide:crown" width="24"></iconify-icon></div><h3 class="text-white font-medium">Ir. Budi Santoso, M.T.</h3><p class="text-gold-400 text-xs mb-4">Direktur Utama</p><p class="text-stone-400 text-sm font-light leading-relaxed">25 tahun pengalaman di industri konstruksi. Alumni ITB dengan spesialisasi struktur beton bertulang.</p><div class="flex gap-3 mt-4"><a href="#" class="text-stone-400 hover:text-gold-400 transition-colors"><iconify-icon icon="lucide:linkedin" width="18"></iconify-icon></a><a href="#" class="text-stone-400 hover:text-gold-400 transition-colors"><iconify-icon icon="lucide:mail" width="18"></iconify-icon></a></div></div>
          </div>
        </div>
        <div class="flip-card h-[420px] reveal" style="transition-delay:.2s">
          <div class="flip-card-inner w-full h-full">
            <div class="flip-card-front rounded-2xl overflow-hidden"><img src="https://picsum.photos/seed/architect-woman/400/500" alt="Siti Rahayu" class="w-full h-full object-cover"><div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-navy-900 to-transparent p-6"><h3 class="text-white font-medium">Ar. Siti Rahayu, S.T.</h3><p class="text-gold-400 text-xs">Lead Architect</p></div></div>
            <div class="flip-card-back rounded-2xl bg-navy-700 p-6 flex flex-col justify-center items-center text-center"><div class="w-16 h-16 rounded-full bg-gold-500/20 flex items-center justify-center text-gold-400 mb-4"><iconify-icon icon="lucide:pen-tool" width="24"></iconify-icon></div><h3 class="text-white font-medium">Ar. Siti Rahayu, S.T.</h3><p class="text-gold-400 text-xs mb-4">Lead Architect</p><p class="text-stone-400 text-sm font-light leading-relaxed">Ahli arsitektur sustainable design. Pemenang IAI Award 2020 dan pengajar tamu di UGM.</p><div class="flex gap-3 mt-4"><a href="#" class="text-stone-400 hover:text-gold-400 transition-colors"><iconify-icon icon="lucide:linkedin" width="18"></iconify-icon></a><a href="#" class="text-stone-400 hover:text-gold-400 transition-colors"><iconify-icon icon="lucide:mail" width="18"></iconify-icon></a></div></div>
          </div>
        </div>
        <div class="flip-card h-[420px] reveal" style="transition-delay:.3s">
          <div class="flip-card-inner w-full h-full">
            <div class="flip-card-front rounded-2xl overflow-hidden"><img src="https://picsum.photos/seed/engineer-guy/400/500" alt="Ahmad Fauzi" class="w-full h-full object-cover"><div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-navy-900 to-transparent p-6"><h3 class="text-white font-medium">Ir. Ahmad Fauzi, S.E.</h3><p class="text-gold-400 text-xs">Structural Engineer</p></div></div>
            <div class="flip-card-back rounded-2xl bg-navy-700 p-6 flex flex-col justify-center items-center text-center"><div class="w-16 h-16 rounded-full bg-gold-500/20 flex items-center justify-center text-gold-400 mb-4"><iconify-icon icon="lucide:hard-hat" width="24"></iconify-icon></div><h3 class="text-white font-medium">Ir. Ahmad Fauzi, S.E.</h3><p class="text-gold-400 text-xs mb-4">Structural Engineer</p><p class="text-stone-400 text-sm font-light leading-relaxed">Spesialis struktur baja dan rekayasa gempa. Bersertifikasi SEI dan memiliki 18 tahun pengalaman.</p><div class="flex gap-3 mt-4"><a href="#" class="text-stone-400 hover:text-gold-400 transition-colors"><iconify-icon icon="lucide:linkedin" width="18"></iconify-icon></a><a href="#" class="text-stone-400 hover:text-gold-400 transition-colors"><iconify-icon icon="lucide:mail" width="18"></iconify-icon></a></div></div>
          </div>
        </div>
        <div class="flip-card h-[420px] reveal" style="transition-delay:.4s">
          <div class="flip-card-inner w-full h-full">
            <div class="flip-card-front rounded-2xl overflow-hidden"><img src="https://picsum.photos/seed/designer-lady/400/500" alt="Dian Permata" class="w-full h-full object-cover"><div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-navy-900 to-transparent p-6"><h3 class="text-white font-medium">Dian Permata, S.Ds.</h3><p class="text-gold-400 text-xs">Interior Designer</p></div></div>
            <div class="flip-card-back rounded-2xl bg-navy-700 p-6 flex flex-col justify-center items-center text-center"><div class="w-16 h-16 rounded-full bg-gold-500/20 flex items-center justify-center text-gold-400 mb-4"><iconify-icon icon="lucide:palette" width="24"></iconify-icon></div><h3 class="text-white font-medium">Dian Permata, S.Ds.</h3><p class="text-gold-400 text-xs mb-4">Interior Designer</p><p class="text-stone-400 text-sm font-light leading-relaxed">Lulusan Institut Teknologi Bandung dengan keahlian di bidang hospitality dan residential interior design.</p><div class="flex gap-3 mt-4"><a href="#" class="text-stone-400 hover:text-gold-400 transition-colors"><iconify-icon icon="lucide:linkedin" width="18"></iconify-icon></a><a href="#" class="text-stone-400 hover:text-gold-400 transition-colors"><iconify-icon icon="lucide:mail" width="18"></iconify-icon></a></div></div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="py-24 px-6">
    <div class="max-w-4xl mx-auto">
      <div class="text-center mb-16">
        <span class="text-xs font-semibold tracking-[.2em] uppercase text-gold-600 reveal">Perjalanan Kami</span>
        <h2 class="font-serif text-3xl sm:text-4xl tracking-tight mt-4 reveal" style="transition-delay:.1s">Milestone <em class="text-navy-600">Perusahaan</em></h2>
      </div>
      <div class="relative">
        <div class="absolute left-4 md:left-1/2 top-0 bottom-0 w-px bg-stone-200 md:-translate-x-px"></div>
        <div class="space-y-12">
          <div class="relative flex items-start gap-8 md:gap-0 reveal"><div class="absolute left-4 md:left-1/2 w-3 h-3 bg-gold-500 rounded-full -translate-x-1.5 mt-2 z-10 ring-4 ring-gold-100"></div><div class="md:w-1/2 md:pr-12 md:text-right pl-12 md:pl-0"><span class="text-gold-600 font-semibold text-sm">2008</span><h4 class="font-medium mt-1">Pendirian KSN</h4><p class="text-stone-500 text-sm font-light mt-1">Didirikan di Jakarta Selatan dengan 5 orang tim inti.</p></div></div>
          <div class="relative flex items-start gap-8 md:gap-0 reveal"><div class="absolute left-4 md:left-1/2 w-3 h-3 bg-gold-500 rounded-full -translate-x-1.5 mt-2 z-10 ring-4 ring-gold-100"></div><div class="md:w-1/2 md:ml-auto md:pl-12 pl-12"><span class="text-gold-600 font-semibold text-sm">2012</span><h4 class="font-medium mt-1">Proyek Pertama Skala Besar</h4><p class="text-stone-500 text-sm font-light mt-1">Menyelesaikan pembangunan gedung perkantoran 12 lantai pertama.</p></div></div>
          <div class="relative flex items-start gap-8 md:gap-0 reveal"><div class="absolute left-4 md:left-1/2 w-3 h-3 bg-gold-500 rounded-full -translate-x-1.5 mt-2 z-10 ring-4 ring-gold-100"></div><div class="md:w-1/2 md:pr-12 md:text-right pl-12 md:pl-0"><span class="text-gold-600 font-semibold text-sm">2016</span><h4 class="font-medium mt-1">Sertifikasi ISO</h4><p class="text-stone-500 text-sm font-light mt-1">Meraih ISO 9001:2015 dan mulai ekspansi ke luar Jakarta.</p></div></div>
          <div class="relative flex items-start gap-8 md:gap-0 reveal"><div class="absolute left-4 md:left-1/2 w-3 h-3 bg-gold-500 rounded-full -translate-x-1.5 mt-2 z-10 ring-4 ring-gold-100"></div><div class="md:w-1/2 md:ml-auto md:pl-12 pl-12"><span class="text-gold-600 font-semibold text-sm">2020</span><h4 class="font-medium mt-1">Penghargaan IAI</h4><p class="text-stone-500 text-sm font-light mt-1">Menerima penghargaan arsitektur terbaik dari Ikatan Arsitek Indonesia.</p></div></div>
          <div class="relative flex items-start gap-8 md:gap-0 reveal"><div class="absolute left-4 md:left-1/2 w-3 h-3 bg-gold-500 rounded-full -translate-x-1.5 mt-2 z-10 ring-4 ring-gold-100"></div><div class="md:w-1/2 md:pr-12 md:text-right pl-12 md:pl-0"><span class="text-gold-600 font-semibold text-sm">2024</span><h4 class="font-medium mt-1">350+ Proyek</h4><p class="text-stone-500 text-sm font-light mt-1">Mencapai milestone 350 proyek dengan operasi di 15+ kota Indonesia.</p></div></div>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- ==================== PAGE: SERVICES ==================== -->
<div id="page-services" class="page">
  <section class="parallax-hero grain" style="min-height:60vh">
    <div class="bg-layer" style="background-image:url('https://picsum.photos/seed/blueprint-plan/1920/900')"></div>
    <div class="overlay"></div>
    <div class="content w-full max-w-7xl mx-auto px-6 pt-32 pb-20">
      <span class="text-xs font-semibold tracking-[.2em] uppercase text-gold-400 reveal">Layanan</span>
      <h1 class="font-serif text-4xl sm:text-5xl md:text-6xl text-white tracking-tight mt-4 reveal" style="transition-delay:.1s">Layanan <em class="gradient-text">Komprehensif</em></h1>
      <p class="text-stone-300 font-light mt-6 max-w-xl reveal" style="transition-delay:.2s">Solusi end-to-end untuk setiap kebutuhan konstruksi, arsitektur, dan desain Anda.</p>
    </div>
  </section>
  <section class="py-24 px-6">
    <div class="max-w-7xl mx-auto space-y-20">
      <div class="grid lg:grid-cols-2 gap-12 items-center">
        <div class="reveal-left"><div class="relative rounded-2xl overflow-hidden group"><img src="https://picsum.photos/seed/interior-modern-room/800/600" alt="Desain Interior" class="w-full h-[400px] object-cover group-hover:scale-105 transition-transform duration-700"><div class="absolute top-4 left-4 w-14 h-14 rounded-xl bg-gold-500 flex items-center justify-center text-navy-900"><iconify-icon icon="lucide:sofa" width="24"></iconify-icon></div></div></div>
        <div class="reveal-right"><span class="text-gold-600 font-semibold text-sm">01</span><h2 class="font-serif text-3xl tracking-tight mt-2">Desain Interior</h2><p class="text-stone-600 font-light leading-relaxed mt-4">Kami merancang interior yang menggabungkan estetika, kenyamanan, dan fungsionalitas. Dari ruang tamu minimalis hingga lobi hotel mewah, setiap detail dirancang dengan presisi tinggi menggunakan software 3D rendering terkini.</p><ul class="mt-6 space-y-3"><li class="flex items-center gap-3 text-sm text-stone-600"><iconify-icon icon="lucide:check" width="16" class="text-gold-500"></iconify-icon>Desain ruang residensial & komersial</li><li class="flex items-center gap-3 text-sm text-stone-600"><iconify-icon icon="lucide:check" width="16" class="text-gold-500"></iconify-icon>3D visualisasi & rendering fotorealistik</li><li class="flex items-center gap-3 text-sm text-stone-600"><iconify-icon icon="lucide:check" width="16" class="text-gold-500"></iconify-icon>Pemilihan material & furniture custom</li><li class="flex items-center gap-3 text-sm text-stone-600"><iconify-icon icon="lucide:check" width="16" class="text-gold-500"></iconify-icon>Lighting design & penataan warna</li></ul></div>
      </div>
      <div class="grid lg:grid-cols-2 gap-12 items-center">
        <div class="order-2 lg:order-1 reveal-left"><span class="text-gold-600 font-semibold text-sm">02</span><h2 class="font-serif text-3xl tracking-tight mt-2">Desain Gedung & Arsitektur</h2><p class="text-stone-600 font-light leading-relaxed mt-4">Layanan arsitektur lengkap dari konsep hingga dokumen gambar kerja (DED). Kami mengintegrasikan prinsip sustainable design, efisiensi energi, dan kepatuhan terhadap regulasi bangunan Indonesia.</p><ul class="mt-6 space-y-3"><li class="flex items-center gap-3 text-sm text-stone-600"><iconify-icon icon="lucide:check" width="16" class="text-gold-500"></iconify-icon>Perencanaan arsitektur & master plan</li><li class="flex items-center gap-3 text-sm text-stone-600"><iconify-icon icon="lucide:check" width="16" class="text-gold-500"></iconify-icon>Desain gedung tinggi & kompleks</li><li class="flex items-center gap-3 text-sm text-stone-600"><iconify-icon icon="lucide:check" width="16" class="text-gold-500"></iconify-icon>BIM (Building Information Modeling)</li><li class="flex items-center gap-3 text-sm text-stone-600"><iconify-icon icon="lucide:check" width="16" class="text-gold-500"></iconify-icon>Pengurusan IMB/PBG & sertifikasi</li></ul></div>
        <div class="order-1 lg:order-2 reveal-right"><div class="relative rounded-2xl overflow-hidden group"><img src="https://picsum.photos/seed/tall-building-design/800/600" alt="Desain Gedung" class="w-full h-[400px] object-cover group-hover:scale-105 transition-transform duration-700"><div class="absolute top-4 right-4 w-14 h-14 rounded-xl bg-gold-500 flex items-center justify-center text-navy-900"><iconify-icon icon="lucide:building-2" width="24"></iconify-icon></div></div></div>
      </div>
      <div class="grid lg:grid-cols-2 gap-12 items-center">
        <div class="reveal-left"><div class="relative rounded-2xl overflow-hidden group"><img src="https://picsum.photos/seed/renovation-work/800/600" alt="Renovasi" class="w-full h-[400px] object-cover group-hover:scale-105 transition-transform duration-700"><div class="absolute top-4 left-4 w-14 h-14 rounded-xl bg-gold-500 flex items-center justify-center text-navy-900"><iconify-icon icon="lucide:wrench" width="24"></iconify-icon></div></div></div>
        <div class="reveal-right"><span class="text-gold-600 font-semibold text-sm">03</span><h2 class="font-serif text-3xl tracking-tight mt-2">Renovasi & Restorasi</h2><p class="text-stone-600 font-light leading-relaxed mt-4">Memberikan kehidupan baru pada bangunan yang sudah ada. Kami menangani renovasi skala kecil hingga restorasi bangunan heritage dengan menjaga karakter asli sekaligus memodernisasi fasilitas.</p><ul class="mt-6 space-y-3"><li class="flex items-center gap-3 text-sm text-stone-600"><iconify-icon icon="lucide:check" width="16" class="text-gold-500"></iconify-icon>Assessment struktural & visual</li><li class="flex items-center gap-3 text-sm text-stone-600"><iconify-icon icon="lucide:check" width="16" class="text-gold-500"></iconify-icon>Renovasi interior & eksterior</li><li class="flex items-center gap-3 text-sm text-stone-600"><iconify-icon icon="lucide:check" width="16" class="text-gold-500"></iconify-icon>Restorasi bangunan cagar budaya</li><li class="flex items-center gap-3 text-sm text-stone-600"><iconify-icon icon="lucide:check" width="16" class="text-gold-500"></iconify-icon>Perkuatan struktur & retrofit</li></ul></div>
      </div>
      <div class="grid lg:grid-cols-2 gap-12 items-center">
        <div class="order-2 lg:order-1 reveal-left"><span class="text-gold-600 font-semibold text-sm">04</span><h2 class="font-serif text-3xl tracking-tight mt-2">Konstruksi Bangunan Baru</h2><p class="text-stone-600 font-light leading-relaxed mt-4">Pelaksanaan proyek konstruksi dari ground-breaking hingga serah terima. Didukung oleh tim site manager berpengalaman dan supply chain yang terintegrasi untuk memastikan kualitas dan ketepatan waktu.</p><ul class="mt-6 space-y-3"><li class="flex items-center gap-3 text-sm text-stone-600"><iconify-icon icon="lucide:check" width="16" class="text-gold-500"></iconify-icon>Konstruksi residensial, komersial & industri</li><li class="flex items-center gap-3 text-sm text-stone-600"><iconify-icon icon="lucide:check" width="16" class="text-gold-500"></iconify-icon>Manajemen proyek & quality control</li><li class="flex items-center gap-3 text-sm text-stone-600"><iconify-icon icon="lucide:check" width="16" class="text-gold-500"></iconify-icon>Health, Safety & Environment (HSE)</li><li class="flex items-center gap-3 text-sm text-stone-600"><iconify-icon icon="lucide:check" width="16" class="text-gold-500"></iconify-icon>Commissioning & serah terima</li></ul></div>
        <div class="order-1 lg:order-2 reveal-right"><div class="relative rounded-2xl overflow-hidden group"><img src="https://picsum.photos/seed/new-construction/800/600" alt="Konstruksi" class="w-full h-[400px] object-cover group-hover:scale-105 transition-transform duration-700"><div class="absolute top-4 right-4 w-14 h-14 rounded-xl bg-gold-500 flex items-center justify-center text-navy-900"><iconify-icon icon="lucide:hard-hat" width="24"></iconify-icon></div></div></div>
      </div>
      <div class="grid lg:grid-cols-2 gap-12 items-center">
        <div class="reveal-left"><div class="relative rounded-2xl overflow-hidden group"><img src="https://picsum.photos/seed/garden-landscape/800/600" alt="Landscape" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" style="height:400px"><div class="absolute top-4 left-4 w-14 h-14 rounded-xl bg-gold-500 flex items-center justify-center text-navy-900"><iconify-icon icon="lucide:trees" width="24"></iconify-icon></div></div></div>
        <div class="reveal-right"><span class="text-gold-600 font-semibold text-sm">05</span><h2 class="font-serif text-3xl tracking-tight mt-2">Desain Landscape</h2><p class="text-stone-600 font-light leading-relaxed mt-4">Menciptakan ruang terbuka hijau yang harmonis dengan bangunan dan lingkungan sekitar. Mulai dari taman pribadi, rooftop garden, hingga masterplan landscape kawasan.</p><ul class="mt-6 space-y-3"><li class="flex items-center gap-3 text-sm text-stone-600"><iconify-icon icon="lucide:check" width="16" class="text-gold-500"></iconify-icon>Taman & garden design</li><li class="flex items-center gap-3 text-sm text-stone-600"><iconify-icon icon="lucide:check" width="16" class="text-gold-500"></iconify-icon>Rooftop & vertical garden</li><li class="flex items-center gap-3 text-sm text-stone-600"><iconify-icon icon="lucide:check" width="16" class="text-gold-500"></iconify-icon>Hardscape & softscape planning</li><li class="flex items-center gap-3 text-sm text-stone-600"><iconify-icon icon="lucide:check" width="16" class="text-gold-500"></iconify-icon>Irigasi & pencahayaan taman</li></ul></div>
      </div>
      <div class="grid lg:grid-cols-2 gap-12 items-center">
        <div class="order-2 lg:order-1 reveal-left"><span class="text-gold-600 font-semibold text-sm">06</span><h2 class="font-serif text-3xl tracking-tight mt-2">Manajemen Proyek & Konsultansi</h2><p class="text-stone-600 font-light leading-relaxed mt-4">Layanan pengelolaan proyek profesional untuk memastikan setiap aspek konstruksi berjalan sesuai rencana, anggaran, dan jadwal. Termasuk pengawasan independen dan manajemen risiko.</p><ul class="mt-6 space-y-3"><li class="flex items-center gap-3 text-sm text-stone-600"><iconify-icon icon="lucide:check" width="16" class="text-gold-500"></iconify-icon>Project management & scheduling</li><li class="flex items-center gap-3 text-sm text-stone-600"><iconify-icon icon="lucide:check" width="16" class="text-gold-500"></iconify-icon>Cost estimation & budget control</li><li class="flex items-center gap-3 text-sm text-stone-600"><iconify-icon icon="lucide:check" width="16" class="text-gold-500"></iconify-icon>Pengawasan & quality assurance</li><li class="flex items-center gap-3 text-sm text-stone-600"><iconify-icon icon="lucide:check" width="16" class="text-gold-500"></iconify-icon>Laporan progres & dokumentasi</li></ul></div>
        <div class="order-1 lg:order-2 reveal-right"><div class="relative rounded-2xl overflow-hidden group"><img src="https://picsum.photos/seed/project-meeting/800/600" alt="Manajemen Proyek" class="w-full h-[400px] object-cover group-hover:scale-105 transition-transform duration-700"><div class="absolute top-4 right-4 w-14 h-14 rounded-xl bg-gold-500 flex items-center justify-center text-navy-900"><iconify-icon icon="lucide:clipboard-list" width="24"></iconify-icon></div></div></div>
      </div>
    </div>
  </section>
  <section class="py-24 px-6 bg-stone-100">
    <div class="max-w-5xl mx-auto">
      <div class="text-center mb-16">
        <span class="text-xs font-semibold tracking-[.2em] uppercase text-gold-600 reveal">Proses Kerja</span>
        <h2 class="font-serif text-3xl sm:text-4xl tracking-tight mt-4 reveal" style="transition-delay:.1s">Bagaimana Kami <em class="text-navy-600">Bekerja</em></h2>
      </div>
      <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="tilt-card bg-white rounded-2xl p-8 text-center shadow-sm hover:shadow-lg transition-shadow duration-500 reveal" style="transition-delay:.1s"><div class="w-12 h-12 mx-auto rounded-full bg-navy-700 text-gold-400 flex items-center justify-center text-lg font-serif mb-4">1</div><h4 class="font-medium">Konsultasi</h4><p class="text-stone-500 text-sm font-light mt-2">Diskusi kebutuhan, visi, anggaran, dan timeline proyek Anda.</p></div>
        <div class="tilt-card bg-white rounded-2xl p-8 text-center shadow-sm hover:shadow-lg transition-shadow duration-500 reveal" style="transition-delay:.2s"><div class="w-12 h-12 mx-auto rounded-full bg-navy-700 text-gold-400 flex items-center justify-center text-lg font-serif mb-4">2</div><h4 class="font-medium">Perencanaan</h4><p class="text-stone-500 text-sm font-light mt-2">Studi kelayakan, desain konseptual, dan penyusunan RAB.</p></div>
        <div class="tilt-card bg-white rounded-2xl p-8 text-center shadow-sm hover:shadow-lg transition-shadow duration-500 reveal" style="transition-delay:.3s"><div class="w-12 h-12 mx-auto rounded-full bg-navy-700 text-gold-400 flex items-center justify-center text-lg font-serif mb-4">3</div><h4 class="font-medium">Eksekusi</h4><p class="text-stone-500 text-sm font-light mt-2">Pelaksanaan proyek dengan pengawasan ketat dan laporan berkala.</p></div>
        <div class="tilt-card bg-white rounded-2xl p-8 text-center shadow-sm hover:shadow-lg transition-shadow duration-500 reveal" style="transition-delay:.4s"><div class="w-12 h-12 mx-auto rounded-full bg-gold-500 text-navy-900 flex items-center justify-center text-lg font-serif mb-4">4</div><h4 class="font-medium">Serah Terima</h4><p class="text-stone-500 text-sm font-light mt-2">Final inspection, dokumentasi, dan garansi pemeliharaan.</p></div>
      </div>
    </div>
  </section>
</div>

<!-- ==================== PAGE: CATEGORIES ==================== -->
<div id="page-categories" class="page">
  <section class="parallax-hero grain" style="min-height:60vh">
    <div class="bg-layer" style="background-image:url('https://picsum.photos/seed/design-styles/1920/900')"></div>
    <div class="overlay"></div>
    <div class="content w-full max-w-7xl mx-auto px-6 pt-32 pb-20">
      <span class="text-xs font-semibold tracking-[.2em] uppercase text-gold-400 reveal">Kategori Desain</span>
      <h1 class="font-serif text-4xl sm:text-5xl md:text-6xl text-white tracking-tight mt-4 reveal" style="transition-delay:.1s">Temukan Gaya <em class="gradient-text">Desain</em> Anda</h1>
      <p class="text-stone-300 font-light mt-6 max-w-xl reveal" style="transition-delay:.2s">Berbagai kategori tema desain dari interior hingga arsitektur gedung yang bisa kami wujudkan.</p>
    </div>
  </section>
  <section class="py-24 px-6">
    <div class="max-w-7xl mx-auto grid md:grid-cols-2 lg:grid-cols-3 gap-8">
      <div class="tilt-card group bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-500 reveal" style="transition-delay:.05s"><div class="relative h-64 overflow-hidden"><img src="https://picsum.photos/seed/minimalist-white/800/600" alt="Minimalis Modern" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"><div class="absolute inset-0 bg-gradient-to-t from-navy-900/80 via-navy-900/20 to-transparent"></div><div class="absolute bottom-4 left-4 right-4"><span class="text-[10px] tracking-[.15em] uppercase text-gold-400 font-semibold">Interior • Arsitektur</span><h3 class="text-white font-serif text-xl mt-1">Minimalis Modern</h3></div></div><div class="p-6"><p class="text-stone-500 text-sm font-light leading-relaxed">Gaya yang menekankan kesederhanaan, garis bersih, dan ruang terbuka. Menggunakan palet warna netral dengan aksen material alami seperti kayu dan batu.</p><div class="flex flex-wrap gap-2 mt-4"><span class="px-3 py-1 bg-stone-100 text-stone-600 text-[10px] tracking-wider uppercase rounded-full">Clean Lines</span><span class="px-3 py-1 bg-stone-100 text-stone-600 text-[10px] tracking-wider uppercase rounded-full">Netral</span><span class="px-3 py-1 bg-stone-100 text-stone-600 text-[10px] tracking-wider uppercase rounded-full">Fungsional</span></div></div></div>
      <div class="tilt-card group bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-500 reveal" style="transition-delay:.1s"><div class="relative h-64 overflow-hidden"><img src="https://picsum.photos/seed/industrial-loft/800/600" alt="Industrial" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"><div class="absolute inset-0 bg-gradient-to-t from-navy-900/80 via-navy-900/20 to-transparent"></div><div class="absolute bottom-4 left-4 right-4"><span class="text-[10px] tracking-[.15em] uppercase text-gold-400 font-semibold">Interior • Gedung</span><h3 class="text-white font-serif text-xl mt-1">Industrial</h3></div></div><div class="p-6"><p class="text-stone-500 text-sm font-light leading-relaxed">Terinspirasi dari pabrik dan gudang, menampilkan material mentah seperti beton ekspos, baja, dan pipa. Kesan maskulin, tegas, dan autentik.</p><div class="flex flex-wrap gap-2 mt-4"><span class="px-3 py-1 bg-stone-100 text-stone-600 text-[10px] tracking-wider uppercase rounded-full">Beton Ekspos</span><span class="px-3 py-1 bg-stone-100 text-stone-600 text-[10px] tracking-wider uppercase rounded-full">Baja</span><span class="px-3 py-1 bg-stone-100 text-stone-600 text-[10px] tracking-wider uppercase rounded-full">Brutalis</span></div></div></div>
      <div class="tilt-card group bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-500 reveal" style="transition-delay:.15s"><div class="relative h-64 overflow-hidden"><img src="https://picsum.photos/seed/scandi-bright/800/600" alt="Skandinavia" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"><div class="absolute inset-0 bg-gradient-to-t from-navy-900/80 via-navy-900/20 to-transparent"></div><div class="absolute bottom-4 left-4 right-4"><span class="text-[10px] tracking-[.15em] uppercase text-gold-400 font-semibold">Interior</span><h3 class="text-white font-serif text-xl mt-1">Skandinavia</h3></div></div><div class="p-6"><p class="text-stone-500 text-sm font-light leading-relaxed">Desain khas Nordik yang mengutamakan cahaya alami, kenyamanan (hygge), dan koneksi dengan alam. Material kayu terang dan warna pastel dominan.</p><div class="flex flex-wrap gap-2 mt-4"><span class="px-3 py-1 bg-stone-100 text-stone-600 text-[10px] tracking-wider uppercase rounded-full">Terang</span><span class="px-3 py-1 bg-stone-100 text-stone-600 text-[10px] tracking-wider uppercase rounded-full">Kayu</span><span class="px-3 py-1 bg-stone-100 text-stone-600 text-[10px] tracking-wider uppercase rounded-full">Cozy</span></div></div></div>
      <div class="tilt-card group bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-500 reveal" style="transition-delay:.2s"><div class="relative h-64 overflow-hidden"><img src="https://picsum.photos/seed/tropical-villa/800/600" alt="Tropical" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"><div class="absolute inset-0 bg-gradient-to-t from-navy-900/80 via-navy-900/20 to-transparent"></div><div class="absolute bottom-4 left-4 right-4"><span class="text-[10px] tracking-[.15em] uppercase text-gold-400 font-semibold">Arsitektur • Landscape</span><h3 class="text-white font-serif text-xl mt-1">Tropical Nusantara</h3></div></div><div class="p-6"><p class="text-stone-500 text-sm font-light leading-relaxed">Gaya yang mengadaptasi kekayaan arsitektur nusantara dengan sentuhan modern. Atap limasan, material lokal, dan ventilasi silang menjadi ciri khas.</p><div class="flex flex-wrap gap-2 mt-4"><span class="px-3 py-1 bg-stone-100 text-stone-600 text-[10px] tracking-wider uppercase rounded-full">Lokal</span><span class="px-3 py-1 bg-stone-100 text-stone-600 text-[10px] tracking-wider uppercase rounded-full">Hijau</span><span class="px-3 py-1 bg-stone-100 text-stone-600 text-[10px] tracking-wider uppercase rounded-full">Tradisional</span></div></div></div>
      <div class="tilt-card group bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-500 reveal" style="transition-delay:.25s"><div class="relative h-64 overflow-hidden"><img src="https://picsum.photos/seed/luxury-classic-room/800/600" alt="Luxury Classic" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"><div class="absolute inset-0 bg-gradient-to-t from-navy-900/80 via-navy-900/20 to-transparent"></div><div class="absolute bottom-4 left-4 right-4"><span class="text-[10px] tracking-[.15em] uppercase text-gold-400 font-semibold">Interior • Eksterior</span><h3 class="text-white font-serif text-xl mt-1">Luxury Classic</h3></div></div><div class="p-6"><p class="text-stone-500 text-sm font-light leading-relaxed">Kemewahan abadi dengan ornamen detail, marmer, crystal, dan furnitur ukir. Gaya ini cocok untuk hunian mewah, hotel bintang lima, dan ruang premium.</p><div class="flex flex-wrap gap-2 mt-4"><span class="px-3 py-1 bg-stone-100 text-stone-600 text-[10px] tracking-wider uppercase rounded-full">Marmer</span><span class="px-3 py-1 bg-stone-100 text-stone-600 text-[10px] tracking-wider uppercase rounded-full">Ornamen</span><span class="px-3 py-1 bg-stone-100 text-stone-600 text-[10px] tracking-wider uppercase rounded-full">Mewah</span></div></div></div>
      <div class="tilt-card group bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-500 reveal" style="transition-delay:.3s"><div class="relative h-64 overflow-hidden"><img src="https://picsum.photos/seed/green-sustainable/800/600" alt="Eco-Friendly" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"><div class="absolute inset-0 bg-gradient-to-t from-navy-900/80 via-navy-900/20 to-transparent"></div><div class="absolute bottom-4 left-4 right-4"><span class="text-[10px] tracking-[.15em] uppercase text-gold-400 font-semibold">Arsitektur • Interior • Landscape</span><h3 class="text-white font-serif text-xl mt-1">Eco-Friendly / Green Building</h3></div></div><div class="p-6"><p class="text-stone-500 text-sm font-light leading-relaxed">Desain berkelanjutan yang meminimalkan dampak lingkungan. Menggunakan material daur ulang, energi terbarukan, dan teknologi efisiensi air serta energi.</p><div class="flex flex-wrap gap-2 mt-4"><span class="px-3 py-1 bg-stone-100 text-stone-600 text-[10px] tracking-wider uppercase rounded-full">Sustainable</span><span class="px-3 py-1 bg-stone-100 text-stone-600 text-[10px] tracking-wider uppercase rounded-full">Solar</span><span class="px-3 py-1 bg-stone-100 text-stone-600 text-[10px] tracking-wider uppercase rounded-full">Recycled</span></div></div></div>
    </div>
  </section>
</div>

<!-- ==================== PAGE: PORTFOLIO ==================== -->
<div id="page-portfolio" class="page">
  <section class="parallax-hero grain" style="min-height:60vh">
    <div class="bg-layer" style="background-image:url('https://picsum.photos/seed/skyline-night/1920/900')"></div>
    <div class="overlay"></div>
    <div class="content w-full max-w-7xl mx-auto px-6 pt-32 pb-20">
      <span class="text-xs font-semibold tracking-[.2em] uppercase text-gold-400 reveal">Portofolio</span>
      <h1 class="font-serif text-4xl sm:text-5xl md:text-6xl text-white tracking-tight mt-4 reveal" style="transition-delay:.1s">Karya <em class="gradient-text">Terbaik</em> Kami</h1>
      <p class="text-stone-300 font-light mt-6 max-w-xl reveal" style="transition-delay:.2s">Setiap proyek adalah bukti komitmen kami terhadap kualitas dan inovasi.</p>
    </div>
  </section>
  <section class="py-24 px-6">
    <div class="max-w-7xl mx-auto">
      <div class="flex flex-wrap justify-center gap-3 mb-12 reveal">
        <button onclick="filterPortfolio('all')" class="filter-btn active px-5 py-2 text-xs font-semibold tracking-wider uppercase rounded-full border border-stone-300 transition-all duration-300" data-filter="all">Semua</button>
        <button onclick="filterPortfolio('interior')" class="filter-btn px-5 py-2 text-xs font-semibold tracking-wider uppercase rounded-full border border-stone-300 transition-all duration-300" data-filter="interior">Interior</button>
        <button onclick="filterPortfolio('gedung')" class="filter-btn px-5 py-2 text-xs font-semibold tracking-wider uppercase rounded-full border border-stone-300 transition-all duration-300" data-filter="gedung">Gedung</button>
        <button onclick="filterPortfolio('renovasi')" class="filter-btn px-5 py-2 text-xs font-semibold tracking-wider uppercase rounded-full border border-stone-300 transition-all duration-300" data-filter="renovasi">Renovasi</button>
        <button onclick="filterPortfolio('landscape')" class="filter-btn px-5 py-2 text-xs font-semibold tracking-wider uppercase rounded-full border border-stone-300 transition-all duration-300" data-filter="landscape">Landscape</button>
      </div>
      <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6" id="portfolio-grid">
@foreach($portfolios as $i => $p)
        <div class="portfolio-item show-item group cursor-pointer" data-cat="{{ $p['filter'] }}" onclick="openProjectModal({{ $i }})"><div class="relative rounded-2xl overflow-hidden h-72"><img src="{{ $p['img'] }}" alt="" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"><div class="absolute inset-0 bg-navy-900/0 group-hover:bg-navy-900/70 transition-all duration-500 flex items-end p-6"><div class="translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500"><span class="text-gold-400 text-[10px] tracking-wider uppercase">{{ $p['cat'] }}</span><h3 class="text-white font-serif text-lg">{{ $p['title'] }}</h3><p class="text-stone-400 text-sm font-light mt-1">{{ $p['loc'] }}, {{ $p['year'] }}</p></div></div></div></div>
@endforeach
      </div>
    </div>
  </section>
</div>

<!-- ==================== PAGE: TRACKING ==================== -->
<!-- <div id="page-tracking" class="page">
  <section class="parallax-hero grain" style="min-height:50vh">
    <div class="bg-layer" style="background-image:url('https://picsum.photos/seed/tracking-map-route/1920/900')"></div>
    <div class="overlay"></div>
    <div class="content w-full max-w-7xl mx-auto px-6 pt-32 pb-20">
      <span class="text-xs font-semibold tracking-[.2em] uppercase text-gold-400 reveal">Tracking Proyek</span>
      <h1 class="font-serif text-4xl sm:text-5xl md:text-6xl text-white tracking-tight mt-4 reveal" style="transition-delay:.1s">Pantau <em class="gradient-text">Progres</em> Proyek Anda</h1>
      <p class="text-stone-300 font-light mt-6 max-w-xl reveal" style="transition-delay:.2s">Masukkan token proyek yang telah diberikan tim kami untuk melihat status terkini proyek Anda secara real-time.</p>
    </div>
  </section> -->

  <!-- <section class="py-24 px-6">
    <div class="max-w-3xl mx-auto"> -->

      <!-- Token Input Card -->
      <!-- <div id="track-input-card" class="reveal-scale">
        <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12">
          <div class="text-center mb-8">
            <div class="w-16 h-16 mx-auto rounded-2xl bg-navy-50 flex items-center justify-center text-navy-600 mb-4">
              <iconify-icon icon="lucide:search" width="28"></iconify-icon>
            </div>
            <h2 class="font-serif text-2xl tracking-tight">Masukkan Token Proyek</h2>
            <p class="text-stone-500 text-sm font-light mt-2">Token berformat <span class="font-mono text-navy-600 bg-navy-50 px-2 py-0.5 rounded">KSN-XXXX-XXX</span> dan diberikan saat kontrak ditandatangani.</p>
          </div>
          <div class="relative" id="token-input-wrapper">
            <div class="flex gap-3">
              <input type="text" id="token-input" placeholder="Contoh: KSN-2024-001" class="flex-1 px-5 py-4 rounded-xl border-2 border-stone-200 text-center text-lg font-mono tracking-wider uppercase focus:outline-none focus:border-navy-500 focus:ring-4 focus:ring-navy-50 transition-all duration-300" onkeydown="if(event.key==='Enter')validateToken()" autocomplete="off" spellcheck="false">
              <button onclick="validateToken()" id="track-btn" class="px-8 py-4 bg-navy-700 text-white text-xs font-semibold tracking-[.15em] uppercase rounded-xl hover:bg-navy-600 transition-all duration-300 hover:shadow-lg hover:-translate-y-0.5 flex items-center gap-2 whitespace-nowrap">
                <iconify-icon icon="lucide:radar" width="16"></iconify-icon> Lacak
              </button>
            </div> -->
            <!-- Error message -->
            <!-- <div id="token-error" class="hidden mt-4 flex items-center justify-center gap-2 text-red-500 text-sm font-medium">
              <iconify-icon icon="lucide:alert-circle" width="16"></iconify-icon>
              <span>Token tidak ditemukan. Pastikan token yang Anda masukkan sudah benar.</span>
            </div>
          </div>
          <div class="mt-6 pt-6 border-t border-stone-100 text-center">
            <p class="text-xs text-stone-400">Lupa token Anda? <a href="#" onclick="navigateTo('contact');return false" class="text-navy-600 font-medium hover:text-gold-600 transition-colors">Hubungi tim kami</a></p>
          </div>
        </div> -->

        <!-- Demo Tokens Info -->
        <!-- <div class="mt-6 bg-stone-100 rounded-2xl p-6">
          <p class="text-xs font-semibold tracking-[.15em] uppercase text-stone-500 mb-3 text-center">🔥 Token Demo (Coba Salah Satu)</p>
          <div class="grid grid-cols-2 sm:grid-cols-3 gap-2">
            <button onclick="document.getElementById('token-input').value='KSN-2024-001';validateToken()" class="px-3 py-2 bg-white rounded-lg text-xs font-mono text-navy-700 hover:bg-navy-700 hover:text-white transition-all duration-300 border border-stone-200 hover:border-navy-700">KSN-2024-001</button>
            <button onclick="document.getElementById('token-input').value='KSN-2024-002';validateToken()" class="px-3 py-2 bg-white rounded-lg text-xs font-mono text-navy-700 hover:bg-navy-700 hover:text-white transition-all duration-300 border border-stone-200 hover:border-navy-700">KSN-2024-002</button>
            <button onclick="document.getElementById('token-input').value='KSN-2024-003';validateToken()" class="px-3 py-2 bg-white rounded-lg text-xs font-mono text-navy-700 hover:bg-navy-700 hover:text-white transition-all duration-300 border border-stone-200 hover:border-navy-700">KSN-2024-003</button>
            <button onclick="document.getElementById('token-input').value='KSN-2024-004';validateToken()" class="px-3 py-2 bg-white rounded-lg text-xs font-mono text-navy-700 hover:bg-navy-700 hover:text-white transition-all duration-300 border border-stone-200 hover:border-navy-700">KSN-2024-004</button>
            <button onclick="document.getElementById('token-input').value='KSN-2024-005';validateToken()" class="px-3 py-2 bg-white rounded-lg text-xs font-mono text-navy-700 hover:bg-navy-700 hover:text-white transition-all duration-300 border border-stone-200 hover:border-navy-700">KSN-2024-005</button>
          </div>
        </div>
      </div> -->

      <!-- Success Overlay (confetti + checkmark) -->
      <!-- <div id="track-success-overlay" class="hidden fixed inset-0 z-[80] flex items-center justify-center pointer-events-none">
        <div id="confetti-container" class="absolute inset-0 overflow-hidden pointer-events-none"></div>
        <div class="relative">
          <div id="success-ring" class="absolute inset-0 w-24 h-24 rounded-full border-2 border-emerald-400 mx-auto" style="top:50%;left:50%;transform:translate(-50%,-50%) scale(.5)"></div>
          <div id="success-check" class="w-24 h-24 rounded-full bg-emerald-500 flex items-center justify-center" style="opacity:0;transform:scale(0)">
            <iconify-icon icon="lucide:check" width="40" class="text-white"></iconify-icon>
          </div>
        </div>
      </div> -->

      <!-- Tracking Result -->
      <!-- <div id="track-result" class="hidden"></div> -->

      <!-- Back Button -->
      <!-- <div id="track-back-btn" class="hidden mt-8 text-center">
        <button onclick="resetTracking()" class="px-8 py-3 border-2 border-stone-300 text-stone-600 text-xs font-semibold tracking-[.15em] uppercase rounded-xl hover:border-navy-700 hover:text-navy-700 transition-all duration-300 hover:-translate-y-0.5 inline-flex items-center gap-2">
          <iconify-icon icon="lucide:arrow-left" width="14"></iconify-icon> Lacak Proyek Lain
        </button>
      </div>

    </div>
  </section>
</div> -->

<!-- Project Modal -->
<div id="project-modal" class="fixed inset-0 z-[70] flex items-center justify-center p-4 opacity-0 pointer-events-none transition-opacity duration-400">
  <div class="absolute inset-0 bg-navy-900/80 backdrop-blur-sm" onclick="closeProjectModal()"></div>
  <div class="relative bg-white rounded-2xl max-w-3xl w-full max-h-[90vh] overflow-y-auto transform scale-95 transition-transform duration-400" id="modal-content">
    <button onclick="closeProjectModal()" class="absolute top-4 right-4 z-10 w-10 h-10 bg-white/90 rounded-full flex items-center justify-center text-stone-600 hover:text-stone-900 shadow-md hover:shadow-lg transition-all"><iconify-icon icon="lucide:x" width="18"></iconify-icon></button>
    <div id="modal-body"></div>
  </div>
</div>

<!-- ==================== PAGE: CONTACT ==================== -->
<div id="page-contact" class="page">
  <section class="parallax-hero grain" style="min-height:60vh">
    <div class="bg-layer" style="background-image:url('https://picsum.photos/seed/city-aerial/1920/900')"></div>
    <div class="overlay"></div>
    <div class="content w-full max-w-7xl mx-auto px-6 pt-32 pb-20">
      <span class="text-xs font-semibold tracking-[.2em] uppercase text-gold-400 reveal">Kontak</span>
      <h1 class="font-serif text-4xl sm:text-5xl md:text-6xl text-white tracking-tight mt-4 reveal" style="transition-delay:.1s">Mari <em class="gradient-text">Berdiskusi</em></h1>
      <p class="text-stone-300 font-light mt-6 max-w-xl reveal" style="transition-delay:.2s">Hubungi kami untuk konsultasi gratis mengenai proyek konstruksi dan desain Anda.</p>
    </div>
  </section>
  <section class="py-24 px-6">
    <div class="max-w-7xl mx-auto grid lg:grid-cols-5 gap-12">
      <div class="lg:col-span-2 space-y-8">
        <div class="tilt-card bg-white rounded-2xl p-6 shadow-md reveal" style="transition-delay:.1s"><div class="flex items-start gap-4"><div class="w-12 h-12 rounded-xl bg-navy-50 flex items-center justify-center text-navy-600 flex-shrink-0"><iconify-icon icon="lucide:map-pin" width="20"></iconify-icon></div><div><h4 class="font-medium text-sm">Kantor Pusat</h4><p class="text-stone-500 text-sm font-light mt-1">{{ $settings['address'] }}</p></div></div></div>
        <div class="tilt-card bg-white rounded-2xl p-6 shadow-md reveal" style="transition-delay:.15s"><div class="flex items-start gap-4"><div class="w-12 h-12 rounded-xl bg-navy-50 flex items-center justify-center text-navy-600 flex-shrink-0"><iconify-icon icon="lucide:phone" width="20"></iconify-icon></div><div><h4 class="font-medium text-sm">Telepon</h4><p class="text-stone-500 text-sm font-light mt-1">{{ $settings['phone'] }}<br>{{ $settings['whatsapp'] }} (WhatsApp)</p></div></div></div>
        <div class="tilt-card bg-white rounded-2xl p-6 shadow-md reveal" style="transition-delay:.2s"><div class="flex items-start gap-4"><div class="w-12 h-12 rounded-xl bg-navy-50 flex items-center justify-center text-navy-600 flex-shrink-0"><iconify-icon icon="lucide:mail" width="20"></iconify-icon></div><div><h4 class="font-medium text-sm">Email</h4><p class="text-stone-500 text-sm font-light mt-1">{{ $settings['email'] }}<br>marketing@ksn-konstruksi.co.id</p></div></div></div>
        <div class="tilt-card bg-white rounded-2xl p-6 shadow-md reveal" style="transition-delay:.25s"><div class="flex items-start gap-4"><div class="w-12 h-12 rounded-xl bg-navy-50 flex items-center justify-center text-navy-600 flex-shrink-0"><iconify-icon icon="lucide:clock" width="20"></iconify-icon></div><div><h4 class="font-medium text-sm">Jam Operasional</h4><p class="text-stone-500 text-sm font-light mt-1">Senin - Jumat: 08.00 - 17.00 WIB<br>Sabtu: 08.00 - 12.00 WIB</p></div></div></div>
        <div class="flex gap-3 reveal" style="transition-delay:.3s">
          <a href="#" class="w-11 h-11 rounded-xl bg-navy-700 flex items-center justify-center text-white hover:bg-gold-500 hover:text-navy-900 transition-all duration-300 hover:-translate-y-1"><iconify-icon icon="lucide:instagram" width="18"></iconify-icon></a>
          <a href="#" class="w-11 h-11 rounded-xl bg-navy-700 flex items-center justify-center text-white hover:bg-gold-500 hover:text-navy-900 transition-all duration-300 hover:-translate-y-1"><iconify-icon icon="lucide:facebook" width="18"></iconify-icon></a>
          <a href="#" class="w-11 h-11 rounded-xl bg-navy-700 flex items-center justify-center text-white hover:bg-gold-500 hover:text-navy-900 transition-all duration-300 hover:-translate-y-1"><iconify-icon icon="lucide:linkedin" width="18"></iconify-icon></a>
          <a href="#" class="w-11 h-11 rounded-xl bg-navy-700 flex items-center justify-center text-white hover:bg-gold-500 hover:text-navy-900 transition-all duration-300 hover:-translate-y-1"><iconify-icon icon="lucide:youtube" width="18"></iconify-icon></a>
        </div>
      </div>
      <div class="lg:col-span-3 reveal-right">
        <div class="bg-white rounded-2xl p-8 md:p-10 shadow-lg">
          <h3 class="font-serif text-2xl mb-2">Kirim Pesan</h3>
          <p class="text-stone-500 text-sm font-light mb-8">Isi formulir di bawah dan tim kami akan menghubungi Anda dalam 1x24 jam.</p>
          <form id="contact-form" onsubmit="handleFormSubmit(event)" class="space-y-5">
            <div class="grid sm:grid-cols-2 gap-5">
              <div><label class="text-xs font-medium text-stone-600 tracking-wider uppercase">Nama Lengkap *</label><input type="text" required class="w-full mt-2 px-4 py-3 rounded-xl border border-stone-200 text-sm focus:outline-none focus:border-navy-500 focus:ring-2 focus:ring-navy-100 transition-all" placeholder="John Doe"></div>
              <div><label class="text-xs font-medium text-stone-600 tracking-wider uppercase">Email *</label><input type="email" required class="w-full mt-2 px-4 py-3 rounded-xl border border-stone-200 text-sm focus:outline-none focus:border-navy-500 focus:ring-2 focus:ring-navy-100 transition-all" placeholder="john@email.com"></div>
            </div>
            <div class="grid sm:grid-cols-2 gap-5">
              <div><label class="text-xs font-medium text-stone-600 tracking-wider uppercase">No. Telepon *</label><input type="tel" required class="w-full mt-2 px-4 py-3 rounded-xl border border-stone-200 text-sm focus:outline-none focus:border-navy-500 focus:ring-2 focus:ring-navy-100 transition-all" placeholder="+62 812-xxxx-xxxx"></div>
              <div><label class="text-xs font-medium text-stone-600 tracking-wider uppercase">Layanan</label><select class="w-full mt-2 px-4 py-3 rounded-xl border border-stone-200 text-sm focus:outline-none focus:border-navy-500 focus:ring-2 focus:ring-navy-100 transition-all text-stone-600"><option value="">Pilih layanan...</option><option>Desain Interior</option><option>Desain Gedung / Arsitektur</option><option>Renovasi & Restorasi</option><option>Konstruksi Bangunan Baru</option><option>Desain Landscape</option><option>Manajemen Proyek</option><option>Lainnya</option></select></div>
            </div>
            <div><label class="text-xs font-medium text-stone-600 tracking-wider uppercase">Estimasi Anggaran</label><select class="w-full mt-2 px-4 py-3 rounded-xl border border-stone-200 text-sm focus:outline-none focus:border-navy-500 focus:ring-2 focus:ring-navy-100 transition-all text-stone-600"><option value="">Pilih range anggaran...</option><option>< Rp 500 Juta</option><option>Rp 500 Juta - 1 Miliar</option><option>Rp 1 - 5 Miliar</option><option>Rp 5 - 20 Miliar</option><option>> Rp 20 Miliar</option></select></div>
            <div><label class="text-xs font-medium text-stone-600 tracking-wider uppercase">Detail Proyek *</label><textarea required rows="5" class="w-full mt-2 px-4 py-3 rounded-xl border border-stone-200 text-sm focus:outline-none focus:border-navy-500 focus:ring-2 focus:ring-navy-100 transition-all resize-none" placeholder="Ceritakan tentang proyek Anda, lokasi, luas bangunan, timeline yang diharapkan, dll."></textarea></div>
            <button type="submit" class="w-full py-3.5 bg-navy-700 text-white text-xs font-semibold tracking-[.15em] uppercase rounded-xl hover:bg-navy-600 transition-all duration-300 hover:shadow-lg hover:-translate-y-0.5 flex items-center justify-center gap-2">Kirim Pesan <iconify-icon icon="lucide:send" width="14"></iconify-icon></button>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- Scheduling Section -->
  <section class="py-24 px-6 bg-stone-50">
    <div class="max-w-7xl mx-auto">
      <div class="text-center mb-14 reveal">
        <span class="text-xs font-semibold tracking-[.2em] uppercase text-gold-600">Penjadwalan</span>
        <h2 class="font-serif text-3xl sm:text-4xl tracking-tight mt-4">Jadwalkan <em class="text-navy-600">Pertemuan</em> Anda</h2>
        <p class="text-stone-500 mt-4 max-w-2xl mx-auto font-light">Pilih tanggal dan waktu yang nyaman untuk konsultasi langsung dengan tim ahli kami, baik secara tatap muka maupun virtual.</p>
      </div>

      <div class="grid lg:grid-cols-2 gap-8">
        <!-- LEFT: Calendar + Time -->
        <div class="space-y-6">
          <!-- Calendar -->
          <div class="bg-white rounded-2xl shadow-md p-6 md:p-8 reveal-left" style="transition-delay:.1s">
            <div class="flex items-center justify-between mb-6">
              <button onclick="changeMonth(-1)" class="w-10 h-10 rounded-xl border border-stone-200 flex items-center justify-center text-stone-500 hover:bg-navy-700 hover:text-white hover:border-navy-700 transition-all duration-300">
                <iconify-icon icon="lucide:chevron-left" width="18"></iconify-icon>
              </button>
              <h3 id="cal-title" class="font-serif text-lg"></h3>
              <button onclick="changeMonth(1)" class="w-10 h-10 rounded-xl border border-stone-200 flex items-center justify-center text-stone-500 hover:bg-navy-700 hover:text-white hover:border-navy-700 transition-all duration-300">
                <iconify-icon icon="lucide:chevron-right" width="18"></iconify-icon>
              </button>
            </div>
            <!-- Day headers -->
            <div class="grid grid-cols-7 gap-1 mb-2">
              <div class="text-center text-[10px] font-semibold tracking-wider uppercase text-stone-400 py-2">Sen</div>
              <div class="text-center text-[10px] font-semibold tracking-wider uppercase text-stone-400 py-2">Sel</div>
              <div class="text-center text-[10px] font-semibold tracking-wider uppercase text-stone-400 py-2">Rab</div>
              <div class="text-center text-[10px] font-semibold tracking-wider uppercase text-stone-400 py-2">Kam</div>
              <div class="text-center text-[10px] font-semibold tracking-wider uppercase text-stone-400 py-2">Jum</div>
              <div class="text-center text-[10px] font-semibold tracking-wider uppercase text-red-300 py-2">Sab</div>
              <div class="text-center text-[10px] font-semibold tracking-wider uppercase text-red-300 py-2">Min</div>
            </div>
            <!-- Day grid -->
            <div id="cal-grid" class="grid grid-cols-7 gap-1 cal-fade-in"></div>
          </div>

          <!-- Time Slots -->
          <div id="time-section" class="bg-white rounded-2xl shadow-md p-6 md:p-8 reveal-left" style="transition-delay:.2s;opacity:.5;pointer-events:none;transition:opacity .3s ease, transform .3s ease">
            <h3 class="font-medium text-sm tracking-wider uppercase text-stone-500 mb-1 flex items-center gap-2">
              <iconify-icon icon="lucide:clock" width="16" class="text-navy-600"></iconify-icon> Pilih Waktu
            </h3>
            <p id="time-subtitle" class="text-xs text-stone-400 mb-5">Pilih tanggal terlebih dahulu</p>
            <!-- Morning -->
            <div class="mb-4">
              <div class="text-[10px] font-semibold tracking-wider uppercase text-stone-400 mb-2">Pagi</div>
              <div id="time-morning" class="grid grid-cols-4 gap-2"></div>
            </div>
            <!-- Afternoon -->
            <div>
              <div class="text-[10px] font-semibold tracking-wider uppercase text-stone-400 mb-2">Siang</div>
              <div id="time-afternoon" class="grid grid-cols-4 gap-2"></div>
            </div>
          </div>
        </div>

        <!-- RIGHT: Form + Summary -->
        <div class="space-y-6">
          <!-- Booking Form -->
          <div id="booking-form-card" class="bg-white rounded-2xl shadow-md p-6 md:p-8 reveal-right" style="transition-delay:.15s">
            <h3 class="font-serif text-lg mb-6 flex items-center gap-2">
              <iconify-icon icon="lucide:user-check" width="20" class="text-navy-600"></iconify-icon> Detail Pertemuan
            </h3>
            <form id="booking-form" onsubmit="handleBooking(event)" class="space-y-5">
              <div>
                <label class="text-xs font-medium text-stone-600 tracking-wider uppercase">Jenis Pertemuan *</label>
                <select id="bk-type" required class="w-full mt-2 px-4 py-3 rounded-xl border border-stone-200 text-sm focus:outline-none focus:border-navy-500 focus:ring-2 focus:ring-navy-100 transition-all text-stone-600">
                  <option value="">Pilih jenis pertemuan...</option>
                  <option>Konsultasi Proyek Baru</option>
                  <option>Review Desain</option>
                  <option>Serah Terima Proyek</option>
                  <option>Site Visit / Inspeksi</option>
                  <option>Meeting Virtual (Zoom/Google Meet)</option>
                  <option>Lainnya</option>
                </select>
              </div>
              <div class="grid sm:grid-cols-2 gap-4">
                <div>
                  <label class="text-xs font-medium text-stone-600 tracking-wider uppercase">Nama Lengkap *</label>
                  <input type="text" id="bk-name" required class="w-full mt-2 px-4 py-3 rounded-xl border border-stone-200 text-sm focus:outline-none focus:border-navy-500 focus:ring-2 focus:ring-navy-100 transition-all" placeholder="Nama Anda">
                </div>
                <div>
                  <label class="text-xs font-medium text-stone-600 tracking-wider uppercase">No. Telepon *</label>
                  <input type="tel" id="bk-phone" required class="w-full mt-2 px-4 py-3 rounded-xl border border-stone-200 text-sm focus:outline-none focus:border-navy-500 focus:ring-2 focus:ring-navy-100 transition-all" placeholder="+62 812-xxxx-xxxx">
                </div>
              </div>
              <div>
                <label class="text-xs font-medium text-stone-600 tracking-wider uppercase">Email *</label>
                <input type="email" id="bk-email" required class="w-full mt-2 px-4 py-3 rounded-xl border border-stone-200 text-sm focus:outline-none focus:border-navy-500 focus:ring-2 focus:ring-navy-100 transition-all" placeholder="email@anda.com">
              </div>
              <div>
                <label class="text-xs font-medium text-stone-600 tracking-wider uppercase">Agenda / Catatan</label>
                <textarea id="bk-notes" rows="3" class="w-full mt-2 px-4 py-3 rounded-xl border border-stone-200 text-sm focus:outline-none focus:border-navy-500 focus:ring-2 focus:ring-navy-100 transition-all resize-none" placeholder="Topik yang ingin dibahas, pertanyaan, dll. (opsional)"></textarea>
              </div>
            </form>
          </div>

          <!-- Summary Card -->
          <div id="booking-summary" class="summary-pulse bg-navy-800 rounded-2xl p-6 md:p-8 text-white reveal-right" style="transition-delay:.25s">
            <h4 class="text-xs font-semibold tracking-[.15em] uppercase text-gold-400 mb-4 flex items-center gap-2">
              <iconify-icon icon="lucide:calendar-check" width="14"></iconify-icon> Ringkasan Jadwal
            </h4>
            <div class="space-y-3">
              <div class="flex items-center justify-between py-2 border-b border-navy-700">
                <span class="text-stone-400 text-sm">Tanggal</span>
                <span id="sum-date" class="text-sm font-medium text-stone-500">—</span>
              </div>
              <div class="flex items-center justify-between py-2 border-b border-navy-700">
                <span class="text-stone-400 text-sm">Waktu</span>
                <span id="sum-time" class="text-sm font-medium text-stone-500">—</span>
              </div>
              <div class="flex items-center justify-between py-2 border-b border-navy-700">
                <span class="text-stone-400 text-sm">Jenis</span>
                <span id="sum-type" class="text-sm font-medium text-stone-500">—</span>
              </div>
              <div class="flex items-center justify-between py-2">
                <span class="text-stone-400 text-sm">Lokasi</span>
                <span class="text-sm font-medium">Kantor Pusat KSN</span>
              </div>
            </div>
            <button onclick="handleBooking(null)" id="bk-submit-btn" class="w-full mt-6 py-3.5 bg-gold-500 text-navy-900 text-xs font-semibold tracking-[.15em] uppercase rounded-xl hover:bg-gold-400 transition-all duration-300 hover:shadow-lg hover:shadow-gold-500/20 hover:-translate-y-0.5 flex items-center justify-center gap-2 disabled:opacity-40 disabled:cursor-not-allowed disabled:hover:transform-none disabled:hover:shadow-none" disabled>
              <iconify-icon icon="lucide:send" width="14"></iconify-icon> Konfirmasi Jadwal
            </button>
            <p class="text-[10px] text-stone-500 text-center mt-3">Konfirmasi akan dikirim ke email Anda</p>
          </div>

          <!-- Booking Success State (hidden) -->
          <div id="booking-success" class="hidden"></div>
        </div>
      </div>
    </div>
  </section>

  <section class="h-80 bg-stone-200 relative">
    <div class="absolute inset-0 flex items-center justify-center bg-navy-900/5">
      <div class="text-center">
        <iconify-icon icon="lucide:map" width="48" class="text-stone-400"></iconify-icon>
        <p class="text-stone-500 text-sm mt-3">{{ $settings['address'] }}</p>
        <a href="https://maps.google.com" target="_blank" class="inline-flex items-center gap-1 text-navy-600 text-sm font-medium mt-2 hover:text-gold-600 transition-colors">Buka di Google Maps <iconify-icon icon="lucide:external-link" width="14"></iconify-icon></a>
      </div>
    </div>
  </section>
</div>

<!-- ==================== FOOTER ==================== -->
<footer class="bg-stone-900 text-stone-400 pt-20 pb-8 px-6">
  <div class="max-w-7xl mx-auto">
    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-12 pb-16 border-b border-stone-800">
      <div>
        <div class="flex items-center gap-3 mb-6"><div class="w-10 h-10 bg-gold-500 rounded-lg flex items-center justify-center text-navy-900 font-serif font-semibold text-lg">K</div><div><div class="text-white font-semibold text-sm">KSN</div><div class="text-[10px] tracking-[.2em] uppercase text-stone-500">Karya Struktur Nusantara</div></div></div>
        <p class="text-sm font-light leading-relaxed">Membangun masa depan dengan inovasi, kualitas, dan keberlanjutan. Mitra terpercaya Anda dalam konstruksi dan desain sejak 2008.</p>
        <div class="flex gap-3 mt-6"><a href="#" class="w-9 h-9 rounded-lg bg-stone-800 flex items-center justify-center hover:bg-gold-500 hover:text-navy-900 transition-all duration-300"><iconify-icon icon="lucide:instagram" width="16"></iconify-icon></a><a href="#" class="w-9 h-9 rounded-lg bg-stone-800 flex items-center justify-center hover:bg-gold-500 hover:text-navy-900 transition-all duration-300"><iconify-icon icon="lucide:facebook" width="16"></iconify-icon></a><a href="#" class="w-9 h-9 rounded-lg bg-stone-800 flex items-center justify-center hover:bg-gold-500 hover:text-navy-900 transition-all duration-300"><iconify-icon icon="lucide:linkedin" width="16"></iconify-icon></a><a href="#" class="w-9 h-9 rounded-lg bg-stone-800 flex items-center justify-center hover:bg-gold-500 hover:text-navy-900 transition-all duration-300"><iconify-icon icon="lucide:youtube" width="16"></iconify-icon></a></div>
      </div>
      <div>
        <h4 class="text-white font-medium text-sm tracking-wider uppercase mb-6">Layanan</h4>
        <ul class="space-y-3 text-sm font-light">
          <li><a href="#" onclick="navigateTo('services');return false" class="hover:text-gold-500 transition-colors">Desain Interior</a></li>
          <li><a href="#" onclick="navigateTo('services');return false" class="hover:text-gold-500 transition-colors">Desain Gedung</a></li>
          <li><a href="#" onclick="navigateTo('services');return false" class="hover:text-gold-500 transition-colors">Renovasi & Restorasi</a></li>
          <li><a href="#" onclick="navigateTo('services');return false" class="hover:text-gold-500 transition-colors">Konstruksi Bangunan</a></li>
          <li><a href="#" onclick="navigateTo('services');return false" class="hover:text-gold-500 transition-colors">Desain Landscape</a></li>
          <li><a href="#" onclick="navigateTo('services');return false" class="hover:text-gold-500 transition-colors">Manajemen Proyek</a></li>
        </ul>
      </div>
      <div>
        <h4 class="text-white font-medium text-sm tracking-wider uppercase mb-6">Perusahaan</h4>
        <ul class="space-y-3 text-sm font-light">
          <li><a href="#" onclick="navigateTo('about');return false" class="hover:text-gold-500 transition-colors">Tentang Kami</a></li>
          <li><a href="#" onclick="navigateTo('portfolio');return false" class="hover:text-gold-500 transition-colors">Portofolio</a></li>
          <li><a href="#" onclick="navigateTo('categories');return false" class="hover:text-gold-500 transition-colors">Kategori Desain</a></li>
          <li><a href="#" onclick="navigateTo('tracking');return false" class="hover:text-gold-500 transition-colors">Tracking Proyek</a></li>
          <li><a href="#" onclick="navigateTo('contact');return false" class="hover:text-gold-500 transition-colors">Karir</a></li>
          <li><a href="#" class="hover:text-gold-500 transition-colors">Blog & Berita</a></li>
        </ul>
      </div>
      <div>
        <h4 class="text-white font-medium text-sm tracking-wider uppercase mb-6">Kontak</h4>
        <ul class="space-y-3 text-sm font-light">
          <li class="flex items-start gap-2"><iconify-icon icon="lucide:map-pin" width="14" class="mt-1 flex-shrink-0 text-gold-500"></iconify-icon>{{ $settings['address'] }}</li>
          <li class="flex items-center gap-2"><iconify-icon icon="lucide:phone" width="14" class="flex-shrink-0 text-gold-500"></iconify-icon>{{ $settings['phone'] }}</li>
          <li class="flex items-center gap-2"><iconify-icon icon="lucide:mail" width="14" class="flex-shrink-0 text-gold-500"></iconify-icon>{{ $settings['email'] }}</li>
        </ul>
        <div class="mt-6 p-4 rounded-xl bg-stone-800">
          <p class="text-xs text-stone-500">Sertifikasi:</p>
          <div class="flex gap-3 mt-2">
            <span class="px-2 py-1 bg-stone-700 rounded text-[10px] text-stone-400">ISO 9001</span>
            <span class="px-2 py-1 bg-stone-700 rounded text-[10px] text-stone-400">ISO 14001</span>
            <span class="px-2 py-1 bg-stone-700 rounded text-[10px] text-stone-400">OHSAS</span>
            <span class="px-2 py-1 bg-stone-700 rounded text-[10px] text-stone-400">SIUJK</span>
          </div>
        </div>
      </div>
    </div>
    <div class="flex flex-col md:flex-row justify-between items-center pt-8 gap-4">
      <p class="text-xs font-light">&copy; 2024 {{ $settings['company'] }}. Seluruh hak cipta dilindungi.</p>
      <div class="flex gap-6 text-xs font-light">
        <a href="#" class="hover:text-gold-500 transition-colors">Kebijakan Privasi</a>
        <a href="#" class="hover:text-gold-500 transition-colors">Syarat & Ketentuan</a>
      </div>
    </div>
  </div>
</footer>

<button id="back-to-top" onclick="window.scrollTo({top:0,behavior:'smooth'})" class="fixed bottom-6 right-6 z-50 w-12 h-12 bg-navy-700 text-white rounded-xl shadow-lg flex items-center justify-center opacity-0 translate-y-4 pointer-events-none transition-all duration-300 hover:bg-gold-500 hover:text-navy-900 hover:-translate-y-1"><iconify-icon icon="lucide:chevron-up" width="20"></iconify-icon></button>
<div id="toast" class="toast"></div>

<script>
// ========== DATA ==========
const projectData = @json($portfolios);

const trackingData = {
  'KSN-2024-001': {
    project: 'Tower Nusantara', client: 'PT Nusantara Development', pm: 'Ir. Ahmad Fauzi, S.E.',
    location: 'Jl. Gatot Subroto, Jakarta Pusat', contract: 'Rp 45.000.000.000',
    start: '15 Januari 2024', estEnd: '20 Desember 2025', currentStep: 5, totalSteps: 8, progress: 62,
    steps: [
      { name: 'Konsultasi & Perencanaan', status: 'done', date: '15 Jan 2024', note: 'Survei lokasi, analisis kebutuhan, dan feasibility study selesai.' },
      { name: 'Desain & Visualisasi', status: 'done', date: '28 Feb 2024', note: 'Desain arsitektur, struktur, MEP, dan 3D rendering disetujui klien.' },
      { name: 'Persetujuan & Kontrak', status: 'done', date: '15 Mar 2024', note: 'Kontrak ditandatangani. PBG dan IMB telah terbit.' },
      { name: 'Pengadaan Material', status: 'done', date: '10 Apr 2024', note: 'Material struktural utama telah dipesan dan sebagian tiba di site.' },
      { name: 'Pelaksanaan Konstruksi', status: 'active', date: 'Sedang berjalan', note: 'Struktur lantai 1-12 selesai. Saat ini pekerjaan lantai 13-16.' },
      { name: 'Finishing & Detail', status: 'pending', date: 'Estimasi: Agu 2025', note: 'Pekerjaan interior, eksterior finishing, dan instalasi fasad.' },
      { name: 'Quality Check & Inspeksi', status: 'pending', date: 'Estimasi: Nov 2025', note: 'Pengujian struktural, MEP commissioning.' },
      { name: 'Serah Terima', status: 'pending', date: 'Estimasi: Des 2025', note: 'Serah terima proyek, dokumentasi as-built, dan garansi.' }
    ],
    updates: [
      { date: '18 Jun 2025', text: 'Pekerjaan kolom struktur lantai 15 selesai 100%. Progress cor lantai 16 mencapai 60%.', type: 'progress' },
      { date: '12 Jun 2025', text: 'Delivery glass curtain wall batch 3 tiba di site. Kualitas material di-inspect dan disetujui.', type: 'info' },
      { date: '05 Jun 2025', text: 'Meeting progres mingguan dengan klien. Semua milestone bulan Mei tercapai.', type: 'progress' },
      { date: '28 Mei 2025', text: 'Instalasi elevator shaft lantai 1-10 selesai. Sertifikasi safety inspection lulus.', type: 'info' }
    ]
  },
  'KSN-2024-002': {
    project: 'Residensi Harmoni', client: 'Dr. Andi & Family', pm: 'Dian Permata, S.Ds.',
    location: 'Jl. Kemang Raya, Jakarta Selatan', contract: 'Rp 2.800.000.000',
    start: '10 Maret 2024', estEnd: '15 September 2024', currentStep: 8, totalSteps: 8, progress: 100,
    steps: [
      { name: 'Konsultasi & Perencanaan', status: 'done', date: '10 Mar 2024', note: 'Diskusi kebutuhan dan pengukuran lokasi selesai.' },
      { name: 'Desain & Visualisasi', status: 'done', date: '25 Mar 2024', note: '3D rendering 360° disetujui. Revisi minor pada palet warna.' },
      { name: 'Persetujuan & Kontrak', status: 'done', date: '05 Apr 2024', note: 'Kontrak ditandatangani. DP 50% diterima.' },
      { name: 'Pengadaan Material', status: 'done', date: '20 Apr 2024', note: 'Seluruh material interior dipesan. Lead time 3-4 minggu.' },
      { name: 'Demolisi & Persiapan', status: 'done', date: '15 Mei 2024', note: 'Pembongkaran interior lama dan persiapan struktur.' },
      { name: 'Pemasangan & Finishing', status: 'done', date: '20 Agu 2024', note: 'Instalasi furniture, lighting, dan seluruh finishing.' },
      { name: 'Quality Check & Inspeksi', status: 'done', date: '05 Sep 2024', note: 'Final inspection lulus. Semua detail sesuai spesifikasi.' },
      { name: 'Serah Terima', status: 'done', date: '15 Sep 2024', note: 'Serah terima berhasil. Klien sangat puas. Garansi 2 tahun aktif.' }
    ],
    updates: [
      { date: '15 Sep 2024', text: 'SERAH TERIMA PROYEK — Klien menyatakan kepuasan penuh. Proyek selesai tepat waktu.', type: 'success' },
      { date: '05 Sep 2024', text: 'Final inspection selesai. Seluruh checklist terpenuhi tanpa catatan signifikan.', type: 'progress' },
      { date: '22 Agu 2024', text: 'Pemasangan kitchen set custom dan lighting layer selesai.', type: 'info' },
      { date: '10 Agu 2024', text: 'Wallpaper, curtain, dan decorative elements terpasang.', type: 'info' }
    ]
  },
  'KSN-2024-003': {
    project: 'Villa Pantai Indah', client: 'Mr. & Mrs. Tanaka', pm: 'Ar. Siti Rahayu, S.T.',
    location: 'Jl. Pantai Senggigi, Lombok', contract: 'Rp 8.500.000.000',
    start: '01 Juni 2024', estEnd: '30 Juni 2025', currentStep: 4, totalSteps: 8, progress: 45,
    steps: [
      { name: 'Konsultasi & Perencanaan', status: 'done', date: '01 Jun 2024', note: 'Site survey, soil test, dan konsep desain tropical modern selesai.' },
      { name: 'Desain & Visualisasi', status: 'done', date: '15 Jul 2024', note: 'Desain arsitektur + interior + landscape disetujui. 3D walkthrough dipresentasikan.' },
      { name: 'Persetujuan & Kontrak', status: 'done', date: '01 Agu 2024', note: 'Kontrak ditandatangani. IMB villa diterbitkan.' },
      { name: 'Pengadaan Material', status: 'active', date: 'Sedang berjalan', note: 'Kayu ulin dan bambu custom sedang dipesan. Pengiriman batch 1 tiba.' },
      { name: 'Pelaksanaan Konstruksi', status: 'pending', date: 'Estimasi: Okt 2024', note: 'Pondasi, struktur, dan dinding.' },
      { name: 'Finishing & Detail', status: 'pending', date: 'Estimasi: Feb 2025', note: 'Interior, infinity pool, dan landscape.' },
      { name: 'Quality Check & Inspeksi', status: 'pending', date: 'Estimasi: Mei 2025', note: 'Pengujian struktural dan finishing.' },
      { name: 'Serah Terima', status: 'pending', date: 'Estimasi: Jun 2025', note: 'Serah terima dan dokumentasi.' }
    ],
    updates: [
      { date: '20 Jun 2025', text: 'Pengiriman kayu ulin batch 2 dalam perjalanan. Estimasi tiba 5 hari lagi.', type: 'info' },
      { date: '14 Jun 2025', text: 'Koordinasi dengan supplier bambu untuk spesifikasi custom ukiran.', type: 'info' },
      { date: '01 Jun 2025', text: 'Progress pengadaan material mencapai 70%. Batch 1 material struktural sudah di site.', type: 'progress' }
    ]
  },
  'KSN-2024-004': {
    project: 'Sekolah Cerdas Bangsa', client: 'Yayasan Cerdas Bangsa', pm: 'Ir. Ahmad Fauzi, S.E.',
    location: 'Jl. Gejayan, Yogyakarta', contract: 'Rp 28.000.000.000',
    start: '01 Februari 2024', estEnd: '15 Januari 2025', currentStep: 7, totalSteps: 8, progress: 88,
    steps: [
      { name: 'Konsultasi & Perencanaan', status: 'done', date: '01 Feb 2024', note: 'Studi kelayakan dan master plan selesai.' },
      { name: 'Desain & Visualisasi', status: 'done', date: '15 Mar 2024', note: 'Desain green building dengan GREENSHIP target Gold.' },
      { name: 'Persetujuan & Kontrak', status: 'done', date: '01 Apr 2024', note: 'Kontrak dan PBG selesai.' },
      { name: 'Pengadaan Material', status: 'done', date: '20 Apr 2024', note: 'Material sustainable dan solar panel dipesan.' },
      { name: 'Pelaksanaan Konstruksi', status: 'done', date: '01 Nov 2024', note: 'Seluruh struktur, atap, dan dinding selesai.' },
      { name: 'Finishing & Detail', status: 'done', date: '15 Des 2024', note: 'Interior kelas, lab, dan area administrasi selesai.' },
      { name: 'Quality Check & Inspeksi', status: 'active', date: 'Sedang berjalan', note: 'Pengujian MEP, solar panel output, dan air quality. Progress 75%.' },
      { name: 'Serah Terima', status: 'pending', date: 'Estimasi: 15 Jan 2025', note: 'Serah terima dan sertifikasi GREENSHIP.' }
    ],
    updates: [
      { date: '20 Jun 2025', text: 'Pengujian solar panel output mencapai 98% dari target. GREENSHIP assessment berjalan baik.', type: 'progress' },
      { date: '15 Jun 2025', text: 'Air quality test di 12 ruang kelas lulus standar. HVAC system performa excellent.', type: 'info' },
      { date: '08 Jun 2025', text: 'Fire safety inspection lulus tanpa catatan. Sertifikat diterbitkan.', type: 'success' }
    ]
  },
  'KSN-2024-005': {
    project: 'Restorasi Gedung Heritage', client: 'Dinas Kebudayaan Jateng', pm: 'Ar. Siti Rahayu, S.T.',
    location: 'Jl. Semarang Tengah, Semarang', contract: 'Rp 12.000.000.000',
    start: '01 Mei 2025', estEnd: '30 April 2026', currentStep: 2, totalSteps: 8, progress: 15,
    steps: [
      { name: 'Konsultasi & Perencanaan', status: 'done', date: '01 Mei 2025', note: 'Dokumentasi heritage, analisis struktural, dan koordinasi dengan BPK selesai.' },
      { name: 'Desain & Restorasi', status: 'active', date: 'Sedang berjalan', note: 'Pembuatan detail gambar restorasi ornamen dan desain MEP modern. Progress 60%.' },
      { name: 'Persetujuan & Kontrak', status: 'pending', date: 'Estimasi: Jul 2025', note: 'Persetujuan tim ahli cagar budaya.' },
      { name: 'Pengadaan Material', status: 'pending', date: 'Estimasi: Agu 2025', note: 'Material restorasi khusus dan material MEP.' },
      { name: 'Pelaksanaan Restorasi', status: 'pending', date: 'Estimasi: Sep 2025', note: 'Pekerjaan restorasi ornamen, struktur, dan MEP.' },
      { name: 'Finishing & Detail', status: 'pending', date: 'Estimasi: Jan 2026', note: 'Interior museum dan finishing akhir.' },
      { name: 'Quality Check & Inspeksi', status: 'pending', date: 'Estimasi: Mar 2026', note: 'Inspeksi heritage compliance dan safety.' },
      { name: 'Serah Terima', status: 'pending', date: 'Estimasi: Apr 2026', note: 'Serah terima museum dan dokumentasi.' }
    ],
    updates: [
      { date: '18 Jun 2025', text: 'Pemindaian 3D laser scanning ornamen fasad utama selesai. Model point cloud diproses.', type: 'progress' },
      { date: '10 Jun 2025', text: 'Koordinasi dengan BPK (Balai Pelestarian Kebudayaan) untuk approval metode restorasi.', type: 'info' },
      { date: '02 Jun 2025', text: 'Tim ahli kimia material melakukan analisis komposisi cat dan plester asli.', type: 'info' }
    ]
  }
};

// ========== LOADING ==========
window.addEventListener('load', function() {
  setTimeout(function() {
    document.getElementById('loader').classList.add('hidden');
    initReveal();
  }, 2200);
});

// ========== NAVIGATION ==========
var currentPage = 'home';

function navigateTo(pageId) {
  if (currentPage === pageId) return;
  var cur = document.getElementById('page-' + currentPage);
  var next = document.getElementById('page-' + pageId);
  if (!cur || !next) return;

  cur.classList.add('page-exit');
  cur.classList.remove('active');

  setTimeout(function() {
    cur.classList.remove('page-exit');
    cur.style.display = 'none';
    next.style.display = 'block';
    next.classList.add('page-enter');
    window.scrollTo({ top: 0, behavior: 'instant' });

    requestAnimationFrame(function() {
      requestAnimationFrame(function() {
        next.classList.add('active');
        next.classList.remove('page-enter');
        currentPage = pageId;
        updateNavLinks();
        initReveal();
        if (pageId === 'home') animateCounters();
        if (pageId === 'tracking') resetTracking();
      });
    });
  }, 450);
}

function updateNavLinks() {
  document.querySelectorAll('.nav-link').forEach(function(link) {
    if (link.dataset.page === currentPage) {
      link.classList.add('text-gold-500');
      link.classList.remove('text-stone-300');
    } else {
      link.classList.remove('text-gold-500');
      link.classList.add('text-stone-300');
    }
  });
}

// ========== MOBILE MENU ==========
function toggleMobile() {
  document.getElementById('mobile-menu').classList.toggle('open');
}

// ========== NAVBAR SCROLL ==========
window.addEventListener('scroll', function() {
  var nav = document.getElementById('navbar');
  var btt = document.getElementById('back-to-top');
  var prog = document.getElementById('scroll-progress');
  var st = window.scrollY;

  if (st > 80) {
    nav.style.background = 'rgba(13,31,63,.95)';
    nav.style.backdropFilter = 'blur(12px)';
    nav.style.boxShadow = '0 4px 30px rgba(0,0,0,.15)';
  } else {
    nav.style.background = 'transparent';
    nav.style.backdropFilter = 'none';
    nav.style.boxShadow = 'none';
  }

  if (st > 600) {
    btt.style.opacity = '1';
    btt.style.transform = 'translateY(0)';
    btt.style.pointerEvents = 'auto';
  } else {
    btt.style.opacity = '0';
    btt.style.transform = 'translateY(16px)';
    btt.style.pointerEvents = 'none';
  }

  var docH = document.documentElement.scrollHeight - window.innerHeight;
  prog.style.width = (st / docH * 100) + '%';
});

// ========== SCROLL REVEAL ==========
function initReveal() {
  var observer = new IntersectionObserver(function(entries) {
    entries.forEach(function(entry) {
      if (entry.isIntersecting) {
        entry.target.classList.add('revealed');
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

  document.querySelectorAll('.reveal:not(.revealed), .reveal-left:not(.revealed), .reveal-right:not(.revealed), .reveal-scale:not(.revealed)').forEach(function(el) {
    observer.observe(el);
  });
}

// ========== COUNTER ANIMATION ==========
function animateCounters() {
  document.querySelectorAll('.counter-num').forEach(function(counter) {
    var target = parseInt(counter.dataset.target);
    var duration = 2000;
    var start = performance.now();
    counter.textContent = '0';
    function update(now) {
      var elapsed = now - start;
      var progress = Math.min(elapsed / duration, 1);
      var eased = 1 - Math.pow(1 - progress, 3);
      counter.textContent = Math.floor(eased * target) + '+';
      if (progress < 1) requestAnimationFrame(update);
    }
    requestAnimationFrame(update);
  });
}

var counterObserver = new IntersectionObserver(function(entries) {
  entries.forEach(function(entry) {
    if (entry.isIntersecting) {
      animateCounters();
      counterObserver.disconnect();
    }
  });
}, { threshold: 0.3 });
document.querySelectorAll('.counter-num').forEach(function(el) { counterObserver.observe(el); });

// ========== 3D TILT ==========
document.addEventListener('mousemove', function(e) {
  document.querySelectorAll('.tilt-card').forEach(function(card) {
    var rect = card.getBoundingClientRect();
    var x = e.clientX - rect.left;
    var y = e.clientY - rect.top;
    if (x >= 0 && x <= rect.width && y >= 0 && y <= rect.height) {
      var cx = rect.width / 2;
      var cy = rect.height / 2;
      var rx = ((y - cy) / cy) * -6;
      var ry = ((x - cx) / cx) * 6;
      card.style.transform = 'perspective(800px) rotateX(' + rx + 'deg) rotateY(' + ry + 'deg) scale3d(1.02,1.02,1.02)';
    }
  });
});
document.addEventListener('mouseleave', function() {
  document.querySelectorAll('.tilt-card').forEach(function(card) {
    card.style.transform = 'perspective(800px) rotateX(0) rotateY(0) scale3d(1,1,1)';
  });
}, true);
document.querySelectorAll('.tilt-card').forEach(function(card) {
  card.addEventListener('mouseleave', function() {
    card.style.transform = 'perspective(800px) rotateX(0) rotateY(0) scale3d(1,1,1)';
  });
});

// ========== PARALLAX ==========
window.addEventListener('scroll', function() {
  document.querySelectorAll('.parallax-hero .bg-layer').forEach(function(bg) {
    var hero = bg.parentElement;
    var rect = hero.getBoundingClientRect();
    bg.style.transform = 'translateY(' + (rect.top * 0.3) + 'px) scale(1.1)';
  });
  document.querySelectorAll('.parallax-scroll').forEach(function(el) {
    var rect = el.getBoundingClientRect();
    el.style.transform = 'translateY(' + (rect.top * 0.15) + 'px)';
  });
});

// ========== PORTFOLIO FILTER ==========
function filterPortfolio(cat) {
  document.querySelectorAll('.filter-btn').forEach(function(btn) {
    btn.classList.remove('bg-navy-700', 'text-white', 'border-navy-700');
    if (btn.dataset.filter === cat) {
      btn.classList.add('bg-navy-700', 'text-white', 'border-navy-700');
    }
  });
  document.querySelectorAll('.portfolio-item').forEach(function(item) {
    if (cat === 'all' || item.dataset.cat === cat) {
      item.classList.remove('hidden-item');
      item.classList.add('show-item');
    } else {
      item.classList.remove('show-item');
      item.classList.add('hidden-item');
    }
  });
}
document.querySelector('.filter-btn[data-filter="all"]').classList.add('bg-navy-700', 'text-white', 'border-navy-700');

// ========== PROJECT MODAL ==========
function openProjectModal(idx) {
  var p = projectData[idx];
  var modal = document.getElementById('project-modal');
  var content = document.getElementById('modal-content');
  document.getElementById('modal-body').innerHTML =
    '<img src="' + p.img + '" alt="' + p.title + '" class="w-full h-64 sm:h-80 object-cover rounded-t-2xl">' +
    '<div class="p-8">' +
      '<span class="text-gold-600 text-xs tracking-[.15em] uppercase font-semibold">' + p.cat + '</span>' +
      '<h2 class="font-serif text-2xl sm:text-3xl mt-2">' + p.title + '</h2>' +
      '<div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-6">' +
        '<div class="bg-stone-50 rounded-xl p-3 text-center"><div class="text-xs text-stone-400 uppercase tracking-wider">Lokasi</div><div class="text-sm font-medium mt-1">' + p.loc + '</div></div>' +
        '<div class="bg-stone-50 rounded-xl p-3 text-center"><div class="text-xs text-stone-400 uppercase tracking-wider">Tahun</div><div class="text-sm font-medium mt-1">' + p.year + '</div></div>' +
        '<div class="bg-stone-50 rounded-xl p-3 text-center"><div class="text-xs text-stone-400 uppercase tracking-wider">Luas</div><div class="text-sm font-medium mt-1">' + p.area + '</div></div>' +
        '<div class="bg-stone-50 rounded-xl p-3 text-center"><div class="text-xs text-stone-400 uppercase tracking-wider">Klien</div><div class="text-sm font-medium mt-1">' + p.client + '</div></div>' +
      '</div>' +
      '<p class="text-stone-600 font-light leading-relaxed mt-6">' + p.desc + '</p>' +
      '<a href="#" onclick="closeProjectModal();navigateTo(\'contact\');return false" class="inline-flex items-center gap-2 mt-6 px-6 py-3 bg-navy-700 text-white text-xs font-semibold tracking-wider uppercase rounded-xl hover:bg-navy-600 transition-all hover:-translate-y-0.5">Konsultasi Proyek Serupa <iconify-icon icon="lucide:arrow-right" width="14"></iconify-icon></a>' +
    '</div>';
  modal.classList.remove('opacity-0', 'pointer-events-none');
  modal.classList.add('opacity-100', 'pointer-events-auto');
  content.classList.remove('scale-95');
  content.classList.add('scale-100');
  document.body.style.overflow = 'hidden';
}

function closeProjectModal() {
  var modal = document.getElementById('project-modal');
  var content = document.getElementById('modal-content');
  modal.classList.add('opacity-0', 'pointer-events-none');
  modal.classList.remove('opacity-100', 'pointer-events-auto');
  content.classList.add('scale-95');
  content.classList.remove('scale-100');
  document.body.style.overflow = '';
}

// ========== CONTACT FORM ==========
async function handleFormSubmit(e) {
  e.preventDefault();
  var form=e.target;
  var inputs=form.querySelectorAll('input');
  var selects=form.querySelectorAll('select');
  var textarea=form.querySelector('textarea');
  var payload={
    name:inputs[0].value.trim(),
    email:inputs[1].value.trim(),
    phone:inputs[2].value.trim(),
    service:selects[0].value,
    budget:selects[1].value,
    detail:textarea.value.trim()
  };
  try{
    await publicApi('/messages',payload);
    showToast('✅ Pesan Anda berhasil terkirim! Tim kami akan menghubungi Anda dalam 1x24 jam.');
    form.reset();
  }catch(err){showToast('❌ '+err.message);}
}

function showToast(msg) {
  var toast = document.getElementById('toast');
  toast.innerHTML = msg;
  toast.classList.add('show');
  setTimeout(function() { toast.classList.remove('show'); }, 4000);
}

function publicCsrf(){var el=document.querySelector('meta[name="csrf-token"]');return el?el.getAttribute('content'):'';}
async function publicApi(url,payload){
  var res=await fetch(url,{method:'POST',credentials:'same-origin',headers:{'Accept':'application/json','Content-Type':'application/json','X-CSRF-TOKEN':publicCsrf()},body:JSON.stringify(payload)});
  var data={};
  try{data=await res.json();}catch(e){}
  if(!res.ok){
    var msg=data.message||'Permintaan gagal.';
    if(data.errors){var first=Object.keys(data.errors)[0];if(first&&data.errors[first]&&data.errors[first][0])msg=data.errors[first][0];}
    throw new Error(msg);
  }
  return data;
}

// ========== TRACKING: CONFETTI ==========
function spawnConfetti() {
  var container = document.getElementById('confetti-container');
  container.innerHTML = '';
  var colors = ['#c9a044','#e7b73f','#1b3a6b','#10b981','#f59e0b','#ef4444','#8b5cf6','#06b6d4'];
  for (var i = 0; i < 40; i++) {
    var particle = document.createElement('div');
    particle.className = 'confetti-particle';
    particle.style.left = (40 + Math.random() * 20) + '%';
    particle.style.top = (40 + Math.random() * 20) + '%';
    particle.style.background = colors[Math.floor(Math.random() * colors.length)];
    particle.style.animationDelay = (Math.random() * 0.3) + 's';
    particle.style.animationDuration = (0.6 + Math.random() * 0.6) + 's';
    particle.style.transform = 'rotate(' + (Math.random() * 360) + 'deg)';
    var angle = Math.random() * Math.PI * 2;
    var dist = 80 + Math.random() * 120;
    particle.style.setProperty('--tx', Math.cos(angle) * dist + 'px');
    particle.style.setProperty('--ty', Math.sin(angle) * dist - 60 + 'px');
    particle.style.animation = 'none';
    container.appendChild(particle);
    (function(p, a, d) {
      setTimeout(function() {
        p.style.transition = 'all ' + (0.6 + Math.random() * 0.5) + 's cubic-bezier(.2,.8,.3,1)';
        p.style.transform = 'translate(' + a.tx + ',' + a.ty + ') rotate(' + (Math.random()*720) + 'deg) scale(0)';
        p.style.opacity = '0';
      }, 10);
    })(particle, { tx: Math.cos(angle)*dist, ty: Math.sin(angle)*dist - 60 });
  }
}

// ========== TRACKING: VALIDATE TOKEN ==========
function validateToken() {
  var input = document.getElementById('token-input');
  var wrapper = document.getElementById('token-input-wrapper');
  var errorEl = document.getElementById('token-error');
  var btn = document.getElementById('track-btn');
  var token = input.value.trim().toUpperCase();

  // Reset states
  errorEl.classList.add('hidden');
  input.classList.remove('border-red-400', 'input-error-glow');
  wrapper.classList.remove('shake-error');

  if (!token) {
    showError();
    return;
  }

  // Disable button during animation
  btn.disabled = true;
  btn.innerHTML = '<iconify-icon icon="lucide:loader-2" width="16" class="animate-spin"></iconify-icon> Memverifikasi...';

  setTimeout(function() {
    var data = trackingData[token];
    if (data) {
      showSuccess(data, token);
    } else {
      showError();
    }
    btn.disabled = false;
    btn.innerHTML = '<iconify-icon icon="lucide:radar" width="16"></iconify-icon> Lacak';
  }, 1200);
}

function showError() {
  var input = document.getElementById('token-input');
  var wrapper = document.getElementById('token-input-wrapper');
  var errorEl = document.getElementById('token-error');

  wrapper.classList.add('shake-error');
  input.classList.add('border-red-400', 'input-error-glow');
  errorEl.classList.remove('hidden');
  errorEl.classList.add('error-fade-in');

  setTimeout(function() {
    wrapper.classList.remove('shake-error');
    input.classList.remove('input-error-glow');
  }, 700);

  setTimeout(function() {
    errorEl.classList.add('hidden');
    errorEl.classList.remove('error-fade-in');
  }, 4000);
}

function showSuccess(data, token) {
  // Show overlay with confetti + checkmark
  var overlay = document.getElementById('track-success-overlay');
  var check = document.getElementById('success-check');
  var ring = document.getElementById('success-ring');
  overlay.classList.remove('hidden');

  spawnConfetti();

  // Ring expand
  ring.style.opacity = '1';
  ring.style.animation = 'successRing .8s ease-out forwards';

  // Check appear
  setTimeout(function() {
    check.style.animation = 'successPulse .6s cubic-bezier(.4,0,.2,1) forwards';
  }, 300);

  // Hide overlay and show result
  setTimeout(function() {
    overlay.classList.add('hidden');
    ring.style.animation = 'none';
    ring.style.opacity = '0';
    check.style.animation = 'none';
    check.style.opacity = '0';
    check.style.transform = 'scale(0)';
    renderTrackingResult(data, token);
  }, 1500);
}

// ========== TRACKING: RENDER RESULT ==========
function renderTrackingResult(data, token) {
  document.getElementById('track-input-card').style.display = 'none';
  document.getElementById('track-back-btn').classList.remove('hidden');
  var resultEl = document.getElementById('track-result');
  resultEl.classList.remove('hidden');

  var statusLabel = '';
  var statusColor = '';
  var statusBg = '';
  if (data.progress === 100) {
    statusLabel = 'Selesai'; statusColor = 'text-emerald-700'; statusBg = 'bg-emerald-50 border-emerald-200';
  } else if (data.progress >= 50) {
    statusLabel = 'Dalam Pengerjaan'; statusColor = 'text-blue-700'; statusBg = 'bg-blue-50 border-blue-200';
  } else {
    statusLabel = 'Persiapan'; statusColor = 'text-amber-700'; statusBg = 'bg-amber-50 border-amber-200';
  }

  var progressColor = data.progress === 100 ? 'bg-emerald-500' : data.progress >= 50 ? 'bg-blue-500' : 'bg-amber-500';
  var progressTrack = data.progress === 100 ? 'bg-emerald-100' : data.progress >= 50 ? 'bg-blue-100' : 'bg-amber-100';

  // Build steps HTML
  var stepsHtml = '';
  data.steps.forEach(function(step, i) {
    var icon = '';
    var iconBg = '';
    var lineColor = '';
    var textColor = '';
    var cardBorder = '';

    if (step.status === 'done') {
      icon = '<iconify-icon icon="lucide:check-circle-2" width="22" class="text-emerald-500"></iconify-icon>';
      iconBg = 'bg-emerald-50 border-emerald-200';
      lineColor = 'bg-emerald-300';
      textColor = '';
      cardBorder = 'border-emerald-100';
    } else if (step.status === 'active') {
      icon = '<div class="w-5 h-5 rounded-full bg-blue-500 flex items-center justify-center"><div class="w-2.5 h-2.5 rounded-full bg-white animate-pulse"></div></div>';
      iconBg = 'bg-blue-50 border-blue-300 border-2';
      lineColor = 'bg-stone-200';
      textColor = '';
      cardBorder = 'border-blue-100 bg-blue-50/30';
    } else {
      icon = '<div class="w-5 h-5 rounded-full bg-stone-200"></div>';
      iconBg = 'bg-stone-50 border-stone-200';
      lineColor = 'bg-stone-200';
      textColor = 'text-stone-400';
      cardBorder = 'border-stone-100';
    }

    var isLast = (i === data.steps.length - 1);

    stepsHtml +=
      '<div class="flex gap-4 ' + (isLast ? '' : 'pb-2') + '" style="animation: stepReveal .5s ease ' + (i * 0.1) + 's both">' +
        '<div class="flex flex-col items-center">' +
          '<div class="w-11 h-11 rounded-xl ' + iconBg + ' border flex items-center justify-center flex-shrink-0">' + icon + '</div>' +
          (isLast ? '' : '<div class="w-0.5 flex-1 mt-2 ' + lineColor + '"></div>') +
        '</div>' +
        '<div class="flex-1 pb-8">' +
          '<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-1">' +
            '<h4 class="font-medium text-sm ' + textColor + '">' + step.name + '</h4>' +
            '<span class="text-xs ' + (step.status === 'done' ? 'text-emerald-600 font-medium' : step.status === 'active' ? 'text-blue-600 font-medium' : 'text-stone-400') + '">' +
              (step.status === 'done' ? '✓ Selesai' : step.status === 'active' ? '● Sedang Berjalan' : '○ Menunggu') +
            '</span>' +
          '</div>' +
          '<p class="text-xs text-stone-500 mt-0.5">' + step.date + '</p>' +
          '<p class="text-sm text-stone-600 font-light mt-2 leading-relaxed">' + step.note + '</p>' +
        '</div>' +
      '</div>';
  });

  // Build updates HTML
  var updatesHtml = '';
  data.updates.forEach(function(upd) {
    var dotColor = '';
    var badgeBg = '';
    var badgeText = '';
    if (upd.type === 'success') { dotColor = 'bg-emerald-500'; badgeBg = 'bg-emerald-50 text-emerald-700'; badgeText = 'Selesai'; }
    else if (upd.type === 'progress') { dotColor = 'bg-blue-500'; badgeBg = 'bg-blue-50 text-blue-700'; badgeText = 'Progres'; }
    else { dotColor = 'bg-stone-400'; badgeBg = 'bg-stone-100 text-stone-600'; badgeText = 'Info'; }

    updatesHtml +=
      '<div class="flex gap-3 pb-4 border-b border-stone-100 last:border-0 last:pb-0">' +
        '<div class="flex flex-col items-center pt-1.5">' +
          '<div class="w-2.5 h-2.5 rounded-full ' + dotColor + ' flex-shrink-0"></div>' +
        '</div>' +
        '<div class="flex-1">' +
          '<div class="flex items-center gap-2 flex-wrap">' +
            '<span class="text-xs text-stone-400">' + upd.date + '</span>' +
            '<span class="px-2 py-0.5 rounded-full text-[10px] font-medium tracking-wider uppercase ' + badgeBg + '">' + badgeText + '</span>' +
          '</div>' +
          '<p class="text-sm text-stone-600 font-light mt-1 leading-relaxed">' + upd.text + '</p>' +
        '</div>' +
      '</div>';
  });

  resultEl.innerHTML =
    '<div class="track-slide-up">' +
      /* Header Card */
      '<div class="bg-white rounded-2xl shadow-xl overflow-hidden">' +
        '<div class="bg-navy-800 px-8 py-6">' +
          '<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">' +
            '<div>' +
              '<div class="flex items-center gap-2 mb-1">' +
                '<span class="font-mono text-xs text-gold-400 tracking-wider">' + token + '</span>' +
                '<span class="px-2.5 py-0.5 rounded-full text-[10px] font-semibold tracking-wider uppercase border ' + statusBg + ' ' + statusColor + '">' + statusLabel + '</span>' +
              '</div>' +
              '<h2 class="font-serif text-2xl text-white">' + data.project + '</h2>' +
            '</div>' +
            '<div class="text-right">' +
              '<div class="text-3xl font-serif font-medium text-white">' + data.progress + '<span class="text-lg text-gold-400">%</span></div>' +
              '<div class="text-xs text-stone-400">Total Progres</div>' +
            '</div>' +
          '</div>' +
          '<div class="mt-5">' +
            '<div class="h-3 rounded-full ' + progressTrack + ' overflow-hidden">' +
              '<div class="h-full rounded-full ' + progressColor + ' progress-fill-anim shimmer-bg" style="--fill:' + data.progress + '%"></div>' +
            '</div>' +
          '</div>' +
        '</div>' +

        /* Info Grid */
        '<div class="grid grid-cols-2 md:grid-cols-4 divide-x divide-stone-100">' +
          '<div class="p-5 text-center"><div class="text-[10px] text-stone-400 uppercase tracking-wider">Klien</div><div class="text-sm font-medium mt-1 truncate">' + data.client + '</div></div>' +
          '<div class="p-5 text-center"><div class="text-[10px] text-stone-400 uppercase tracking-wider">PM</div><div class="text-sm font-medium mt-1 truncate">' + data.pm + '</div></div>' +
          '<div class="p-5 text-center"><div class="text-[10px] text-stone-400 uppercase tracking-wider">Mulai</div><div class="text-sm font-medium mt-1">' + data.start + '</div></div>' +
          '<div class="p-5 text-center"><div class="text-[10px] text-stone-400 uppercase tracking-wider">Est. Selesai</div><div class="text-sm font-medium mt-1">' + data.estEnd + '</div></div>' +
        '</div>' +
        '<div class="grid grid-cols-1 md:grid-cols-2 divide-y md:divide-y-0 md:divide-x divide-stone-100 border-t border-stone-100">' +
          '<div class="p-5"><div class="text-[10px] text-stone-400 uppercase tracking-wider">Lokasi</div><div class="text-sm font-medium mt-1">' + data.location + '</div></div>' +
          '<div class="p-5"><div class="text-[10px] text-stone-400 uppercase tracking-wider">Nilai Kontrak</div><div class="text-sm font-medium mt-1">Rp ' + data.contract.replace('Rp ','').replace(/\./g,',') + '</div></div>' +
        '</div>' +
      '</div>' +

      /* Steps & Updates Grid */
      '<div class="grid lg:grid-cols-5 gap-6 mt-6">' +
        /* Steps */
        '<div class="lg:col-span-3 bg-white rounded-2xl shadow-md p-6 md:p-8">' +
          '<h3 class="font-serif text-lg mb-6 flex items-center gap-2"><iconify-icon icon="lucide:list-checks" width="20" class="text-navy-600"></iconify-icon> Tahapan Proyek</h3>' +
          '<div>' + stepsHtml + '</div>' +
        '</div>' +
        /* Updates */
        '<div class="lg:col-span-2 bg-white rounded-2xl shadow-md p-6 md:p-8">' +
          '<h3 class="font-serif text-lg mb-6 flex items-center gap-2"><iconify-icon icon="lucide:bell-ring" width="20" class="text-navy-600"></iconify-icon> Update Terbaru</h3>' +
          '<div class="space-y-0">' + updatesHtml + '</div>' +
        '</div>' +
      '</div>' +
    '</div>';

  // Scroll to result
  setTimeout(function() {
    resultEl.scrollIntoView({ behavior: 'smooth', block: 'start' });
  }, 100);
}

// ========== TRACKING: RESET ==========
function resetTracking() {
  document.getElementById('track-input-card').style.display = 'block';
  document.getElementById('track-result').classList.add('hidden');
  document.getElementById('track-result').innerHTML = '';
  document.getElementById('track-back-btn').classList.add('hidden');
  document.getElementById('token-input').value = '';
  document.getElementById('token-error').classList.add('hidden');
  document.getElementById('token-input').classList.remove('border-red-400', 'input-error-glow');
  window.scrollTo({ top: 0, behavior: 'smooth' });
}

// ========== INIT ==========
updateNavLinks();
// ========== SCHEDULING / CALENDAR ==========
var bookedSlots = @json($bookedSlots);
var companyAddress = @json($settings['address']);
var calYear, calMonth, selectedDate = null, selectedTime = null;
var monthNames = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];

function initCalendar() {
  var now = new Date();
  calYear = now.getFullYear();
  calMonth = now.getMonth();
  renderCalendar();
}

function changeMonth(dir) {
  calMonth += dir;
  if (calMonth > 11) { calMonth = 0; calYear++; }
  if (calMonth < 0) { calMonth = 11; calYear--; }
  renderCalendar();
}

function renderCalendar() {
  var grid = document.getElementById('cal-grid');
  var title = document.getElementById('cal-title');
  if (!grid || !title) return;

  title.textContent = monthNames[calMonth] + ' ' + calYear;

  var firstDay = new Date(calYear, calMonth, 1).getDay();
  var daysInMonth = new Date(calYear, calMonth + 1, 0).getDate();
  var today = new Date();
  today.setHours(0,0,0,0);

  // Convert Sunday=0 to Monday-start (Mon=0, Sun=6)
  var startOffset = firstDay === 0 ? 6 : firstDay - 1;

  var html = '';
  // Empty cells
  for (var i = 0; i < startOffset; i++) {
    html += '<div class="cal-day empty"></div>';
  }
  // Day cells
  for (var d = 1; d <= daysInMonth; d++) {
    var date = new Date(calYear, calMonth, d);
    date.setHours(0,0,0,0);
    var dayOfWeek = date.getDay();
    var isSunday = dayOfWeek === 0;
    var isSaturday = dayOfWeek === 6;
    var isPast = date < today;
    var isToday = date.getTime() === today.getTime();
    var isSelected = selectedDate && date.getTime() === selectedDate.getTime();

    var classes = 'cal-day';
    if (isPast || isSunday) classes += ' disabled';
    if (isSaturday) classes += ' sunday';
    if (isToday) classes += ' today';
    if (isSelected) classes += ' selected';

    var onclick = '';
    if (!isPast && !isSunday && !isSaturday) {
      onclick = 'onclick="selectDate(' + calYear + ',' + calMonth + ',' + d + ')"';
    }

    html += '<div class="' + classes + '" ' + onclick + '>' + d + '</div>';
  }

  grid.innerHTML = html;
  grid.classList.remove('cal-fade-in');
  void grid.offsetWidth;
  grid.classList.add('cal-fade-in');
}

function selectDate(y, m, d) {
  selectedDate = new Date(y, m, d);
  selectedDate.setHours(0,0,0,0);
  selectedTime = null;
  renderCalendar();
  renderTimeSlots();
  updateTimeSection(true);
  updateSummary();
}

function renderTimeSlots() {
  var morningEl = document.getElementById('time-morning');
  var afternoonEl = document.getElementById('time-afternoon');
  if (!morningEl || !afternoonEl || !selectedDate) return;

  var morningTimes = ['08:00','09:00','10:00','11:00'];
  var afternoonTimes = ['13:00','14:00','15:00','16:00'];

  var dateStr = selectedDate.getFullYear() + '-' + (selectedDate.getMonth()+1) + '-' + selectedDate.getDate();

  var mHtml = '';
  morningTimes.forEach(function(t) {
    var taken = isSlotTaken(dateStr, t);
    var sel = selectedTime === t ? ' selected' : '';
    var cls = 'time-slot' + (taken ? ' taken' : '') + sel;
    var oc = taken ? '' : ' onclick="selectTime(\'' + t + '\')"';
    mHtml += '<div class="' + cls + '"' + oc + '>' + t + '</div>';
  });
  morningEl.innerHTML = mHtml;

  var aHtml = '';
  afternoonTimes.forEach(function(t) {
    var taken = isSlotTaken(dateStr, t);
    var sel = selectedTime === t ? ' selected' : '';
    var cls = 'time-slot' + (taken ? ' taken' : '') + sel;
    var oc = taken ? '' : ' onclick="selectTime(\'' + t + '\')"';
    aHtml += '<div class="' + cls + '"' + oc + '>' + t + '</div>';
  });
  afternoonEl.innerHTML = aHtml;
}

function isSlotTaken(dateStr, time) {
  return bookedSlots.indexOf(dateStr + '|' + time) >= 0;
}

function selectTime(t) {
  selectedTime = t;
  renderTimeSlots();
  updateSummary();
}

function updateTimeSection(enabled) {
  var section = document.getElementById('time-section');
  var subtitle = document.getElementById('time-subtitle');
  if (!section) return;
  if (enabled) {
    section.style.opacity = '1';
    section.style.pointerEvents = 'auto';
    if (subtitle && selectedDate) {
      var dayNames = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
      subtitle.textContent = dayNames[selectedDate.getDay()] + ', ' + selectedDate.getDate() + ' ' + monthNames[selectedDate.getMonth()] + ' ' + selectedDate.getFullYear();
    }
  } else {
    section.style.opacity = '.5';
    section.style.pointerEvents = 'none';
    if (subtitle) subtitle.textContent = 'Pilih tanggal terlebih dahulu';
  }
}

function updateSummary() {
  var sumDate = document.getElementById('sum-date');
  var sumTime = document.getElementById('sum-time');
  var sumType = document.getElementById('sum-type');
  var btn = document.getElementById('bk-submit-btn');
  var summary = document.getElementById('booking-summary');

  if (sumDate) {
    if (selectedDate) {
      var dayNames = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
      sumDate.textContent = dayNames[selectedDate.getDay()] + ', ' + selectedDate.getDate() + ' ' + monthNames[selectedDate.getMonth()] + ' ' + selectedDate.getFullYear();
      sumDate.classList.remove('text-stone-500');
      sumDate.classList.add('text-white');
    } else {
      sumDate.textContent = '—';
      sumDate.classList.add('text-stone-500');
      sumDate.classList.remove('text-white');
    }
  }

  if (sumTime) {
    if (selectedTime) {
      sumTime.textContent = selectedTime + ' WIB';
      sumTime.classList.remove('text-stone-500');
      sumTime.classList.add('text-white');
    } else {
      sumTime.textContent = '—';
      sumTime.classList.add('text-stone-500');
      sumTime.classList.remove('text-white');
    }
  }

  if (sumType) {
    var typeEl = document.getElementById('bk-type');
    if (typeEl && typeEl.value) {
      sumType.textContent = typeEl.value;
      sumType.classList.remove('text-stone-500');
      sumType.classList.add('text-white');
    } else {
      sumType.textContent = '—';
      sumType.classList.add('text-stone-500');
      sumType.classList.remove('text-white');
    }
  }

  // Enable/disable submit
  var canSubmit = selectedDate && selectedTime;
  if (btn) btn.disabled = !canSubmit;

  // Pulse animation on summary
  if (summary) {
    summary.classList.add('updated');
    setTimeout(function() { summary.classList.remove('updated'); }, 400);
  }
}

// Listen for type change
document.addEventListener('change', function(e) {
  if (e.target && e.target.id === 'bk-type') updateSummary();
});

async function handleBooking(e) {
  if (e) e.preventDefault();

  var name = document.getElementById('bk-name').value.trim();
  var phone = document.getElementById('bk-phone').value.trim();
  var email = document.getElementById('bk-email').value.trim();
  var type = document.getElementById('bk-type').value;

  // Validate
  if (!type || !name || !phone || !email) {
    // Trigger form validation
    var form = document.getElementById('booking-form');
    if (form) form.reportValidity();
    return;
  }

  if (!selectedDate || !selectedTime) {
    showToast('⚠️ Silakan pilih tanggal dan waktu terlebih dahulu.');
    return;
  }

  var notes = (document.getElementById('bk-notes')||{}).value || '';
  var dbDate = selectedDate.getFullYear() + '-' + String(selectedDate.getMonth()+1).padStart(2,'0') + '-' + String(selectedDate.getDate()).padStart(2,'0');
  try{
    await publicApi('/appointments',{name:name,phone:phone,email:email,type:type,date:dbDate,time:selectedTime,notes:notes.trim()});
    bookedSlots.push(selectedDate.getFullYear() + '-' + (selectedDate.getMonth()+1) + '-' + selectedDate.getDate() + '|' + selectedTime);
  }catch(err){showToast('❌ '+err.message);return;}

  // Show success
  var formCard = document.getElementById('booking-form-card');
  var summaryCard = document.getElementById('booking-summary');
  var successEl = document.getElementById('booking-success');

  if (formCard) formCard.style.display = 'none';
  if (summaryCard) summaryCard.style.display = 'none';
  if (successEl) {
    successEl.classList.remove('hidden');

    var dayNames = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
    var dateStr = dayNames[selectedDate.getDay()] + ', ' + selectedDate.getDate() + ' ' + monthNames[selectedDate.getMonth()] + ' ' + selectedDate.getFullYear();

    successEl.innerHTML =
      '<div class="bg-white rounded-2xl shadow-lg p-8 md:p-10 text-center booking-slide-in">' +
        '<div class="w-20 h-20 mx-auto rounded-full bg-emerald-50 flex items-center justify-center booking-success-anim mb-6">' +
          '<iconify-icon icon="lucide:calendar-check" width="36" class="text-emerald-500"></iconify-icon>' +
        '</div>' +
        '<h3 class="font-serif text-2xl mb-2">Jadwal Berhasil Dikonfirmasi!</h3>' +
        '<p class="text-stone-500 text-sm font-light mb-8">Detail konfirmasi telah dikirim ke <strong class="text-navy-600">' + email + '</strong></p>' +
        '<div class="bg-stone-50 rounded-2xl p-6 text-left max-w-sm mx-auto">' +
          '<div class="space-y-3">' +
            '<div class="flex items-center gap-3"><div class="w-8 h-8 rounded-lg bg-navy-50 flex items-center justify-center text-navy-600 flex-shrink-0"><iconify-icon icon="lucide:calendar" width="14"></iconify-icon></div><div><div class="text-[10px] text-stone-400 uppercase tracking-wider">Tanggal</div><div class="text-sm font-medium">' + dateStr + '</div></div></div>' +
            '<div class="flex items-center gap-3"><div class="w-8 h-8 rounded-lg bg-navy-50 flex items-center justify-center text-navy-600 flex-shrink-0"><iconify-icon icon="lucide:clock" width="14"></iconify-icon></div><div><div class="text-[10px] text-stone-400 uppercase tracking-wider">Waktu</div><div class="text-sm font-medium">' + selectedTime + ' WIB</div></div></div>' +
            '<div class="flex items-center gap-3"><div class="w-8 h-8 rounded-lg bg-navy-50 flex items-center justify-center text-navy-600 flex-shrink-0"><iconify-icon icon="lucide:briefcase" width="14"></iconify-icon></div><div><div class="text-[10px] text-stone-400 uppercase tracking-wider">Jenis</div><div class="text-sm font-medium">' + type + '</div></div></div>' +
            '<div class="flex items-center gap-3"><div class="w-8 h-8 rounded-lg bg-navy-50 flex items-center justify-center text-navy-600 flex-shrink-0"><iconify-icon icon="lucide:map-pin" width="14"></iconify-icon></div><div><div class="text-[10px] text-stone-400 uppercase tracking-wider">Lokasi</div><div class="text-sm font-medium">' + companyAddress + '</div></div></div>' +
            '<div class="flex items-center gap-3"><div class="w-8 h-8 rounded-lg bg-navy-50 flex items-center justify-center text-navy-600 flex-shrink-0"><iconify-icon icon="lucide:user" width="14"></iconify-icon></div><div><div class="text-[10px] text-stone-400 uppercase tracking-wider">Nama</div><div class="text-sm font-medium">' + name + '</div></div></div>' +
          '</div>' +
        '</div>' +
        '<div class="mt-6 p-4 bg-amber-50 rounded-xl flex items-start gap-3 max-w-sm mx-auto">' +
          '<iconify-icon icon="lucide:info" width="16" class="text-amber-600 mt-0.5 flex-shrink-0"></iconify-icon>' +
          '<p class="text-xs text-amber-700 text-left font-light">Tim kami akan menghubungi Anda 1 jam sebelum jadwal pertemuan sebagai pengingat.</p>' +
        '</div>' +
        '<button onclick="resetBooking()" class="mt-8 px-8 py-3 border-2 border-stone-300 text-stone-600 text-xs font-semibold tracking-[.15em] uppercase rounded-xl hover:border-navy-700 hover:text-navy-700 transition-all duration-300 hover:-translate-y-0.5 inline-flex items-center gap-2">' +
          '<iconify-icon icon="lucide:plus" width="14"></iconify-icon> Jadwalkan Pertemuan Lain' +
        '</button>' +
      '</div>';
  }

  showToast('✅ Jadwal pertemuan berhasil dikonfirmasi! Cek email Anda.');
}

function resetBooking() {
  selectedDate = null;
  selectedTime = null;

  var formCard = document.getElementById('booking-form-card');
  var summaryCard = document.getElementById('booking-summary');
  var successEl = document.getElementById('booking-success');

  if (formCard) formCard.style.display = 'block';
  if (summaryCard) summaryCard.style.display = 'block';
  if (successEl) { successEl.classList.add('hidden'); successEl.innerHTML = ''; }

  var form = document.getElementById('booking-form');
  if (form) form.reset();

  updateTimeSection(false);
  renderCalendar();
  updateSummary();

  // Reset summary text colors
  ['sum-date','sum-time','sum-type'].forEach(function(id) {
    var el = document.getElementById(id);
    if (el) { el.textContent = '—'; el.classList.add('text-stone-500'); el.classList.remove('text-white'); }
  });
}

// Init calendar when tracking/contact page becomes active
var origNavigateTo = navigateTo;
navigateTo = function(pageId) {
  origNavigateTo(pageId);
  if (pageId === 'contact') {
    setTimeout(function() { initCalendar(); }, 600);
  }
};
</script>
</body>
</html>