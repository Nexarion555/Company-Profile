<!DOCTYPE html>
<html lang="id">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $branding['short_name'] }} Admin Panel</title>
    @if(!empty($branding['favicon_url']))
    <link rel="icon" href="{{ $branding['favicon_url'] }}">
    <link rel="shortcut icon" href="{{ $branding['favicon_url'] }}">
    <link rel="apple-touch-icon" href="{{ $branding['favicon_url'] }}">
    @endif
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Montserrat:ital,wght@0,500;0,600;0,700;0,800;1,600;1,700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script>
        tailwind.config={
            theme:{
                extend:{
                    fontFamily:{
                        sans:['Inter','sans-serif'],
                        serif:['Montserrat','sans-serif']},
                        colors:{
                            navy:{
                                50:'#f4f8ff',
                                100:'#e6efff',
                                200:'#c9dcff',
                                300:'#9fc0ff',
                                400:'#6f9eff',
                                500:'#3478e5',
                                600:'#0b5fdc',
                                700:'#185a9d',
                                800:'#124777',
                                900:'#0d355d'
                                },
                                gold:{
                                    50:'#fff5f5',
                                    100:'#ffe3e3',
                                    200:'#ffcaca',
                                    300:'#ff9b9b',
                                    400:'#ff6060',
                                    500:'#e90000',
                                    600:'#d10000',
                                    700:'#b00000',
                                    800:'#8a0000',
                                    900:'#650000'
                                    },
                                    stone:{
                                        50:'#fafafa',
                                        100:'#f5f5f5',
                                        200:'#e5e7eb',
                                        300:'#d1d5db',
                                        400:'#9ca3af',
                                        500:'#6b7280',
                                        600:'#4b5563',
                                        700:'#374151',
                                        800:'#1f2937',
                                        900:'#111827'
                                        }
                                    }
                                }
                            }
                        }
</script>
<style>
*{margin:0;padding:0;box-sizing:border-box}
::-webkit-scrollbar{width:5px}::-webkit-scrollbar-track{background:#0d355d}::-webkit-scrollbar-thumb{background:#3478e5;border-radius:3px}::-webkit-scrollbar-thumb:hover{background:#e90000}
::selection{background:#0b5fdc;color:#fff}
.gradient-text{background:linear-gradient(135deg,#0b5fdc 0%,#2563eb 48%,#e90000 100%);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
.tilt-card{transform-style:preserve-3d;transition:transform .15s ease-out,box-shadow .3s ease}.tilt-card:hover{box-shadow:0 10px 30px rgba(0,0,0,.15)}
.reveal{opacity:0;transform:translateY(20px);transition:opacity .5s ease,transform .5s ease}.reveal.rv{opacity:1;transform:translateY(0)}
@keyframes float{0%,100%{transform:translateY(0)}50%{transform:translateY(-8px)}}.float-a{animation:float 4s ease-in-out infinite}
.sidebar-link{display:flex;align-items:center;gap:12px;padding:10px 16px;border-radius:12px;font-size:.875rem;color:#9ca3af;transition:all .2s ease;cursor:pointer}.sidebar-link:hover{background:rgba(255,255,255,.05);color:#e5e7eb}.sidebar-link.active{background:rgba(233,0,0,.14);color:#ff7a7a;font-weight:500}
.stat-card{transition:transform .2s ease}.stat-card:hover{transform:translateY(-4px)}
.table-row{transition:background .15s ease}.table-row:hover{background:rgba(255,255,255,.03)}
.modal-overlay{position:fixed;inset:0;z-index:100;background:rgba(3,10,18,.82);backdrop-filter:blur(8px);opacity:0;pointer-events:none;transition:opacity .3s}.modal-overlay.show{opacity:1;pointer-events:auto}
.modal-box{position:fixed;top:50%;left:50%;transform:translate(-50%,-50%) scale(.95);z-index:101;width:95%;max-width:640px;max-height:90vh;overflow-y:auto;background:#124777;border:1px solid rgba(159,192,255,.18);box-shadow:0 24px 70px rgba(0,0,0,.45);border-radius:16px;opacity:0;pointer-events:none;transition:all .3s}.modal-box.show{opacity:1;pointer-events:auto;transform:translate(-50%,-50%) scale(1)}
.toast-c{position:fixed;bottom:24px;right:24px;z-index:200;background:#0b5fdc;color:#fff;padding:14px 20px;border-radius:12px;box-shadow:0 15px 35px rgba(0,0,0,.3);transform:translateY(100px);opacity:0;transition:all .4s ease;font-size:.85rem;max-width:380px}.toast-c.show{transform:translateY(0);opacity:1}
.badge{display:inline-flex;align-items:center;padding:2px 10px;border-radius:20px;font-size:.65rem;font-weight:600;letter-spacing:.05em;text-transform:uppercase}
.badge-done{background:rgba(16,185,129,.15);color:#10b981}.badge-active{background:rgba(59,130,246,.15);color:#3b82f6}.badge-pending{background:rgba(168,162,158,.15);color:#9ca3af}.badge-cancelled{background:rgba(239,68,68,.15);color:#ef4444}
.line-clamp-2{display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
.line-clamp-3{display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden}
input:focus,select:focus,textarea:focus{outline:none;border-color:#3478e5!important;box-shadow:0 0 0 3px rgba(52,120,229,.18)!important}

/* ===== ADMIN BLUE BACKGROUND THEME ===== */
body{
  background:
    radial-gradient(circle at 88% 8%,rgba(52,120,229,.24),transparent 30%),
    radial-gradient(circle at 8% 92%,rgba(11,95,220,.18),transparent 32%),
    linear-gradient(145deg,#0f3d68 0%,#154f82 52%,#103b66 100%)!important;
  background-attachment:fixed!important;
}
#admin-layout{background:transparent!important}
.main-area{
  background:
    linear-gradient(180deg,rgba(255,255,255,.035),transparent 300px),
    transparent;
}
.sidebar{
  background:linear-gradient(180deg,rgba(18,71,119,.985) 0%,rgba(13,53,93,.99) 100%)!important;
  border-right-color:rgba(159,192,255,.18)!important;
  box-shadow:12px 0 36px rgba(7,36,69,.18);
}
.main-area>header{
  background:rgba(13,53,93,.90)!important;
  border-bottom-color:rgba(159,192,255,.16)!important;
  box-shadow:0 8px 28px rgba(7,36,69,.13);
}
#pages .bg-navy-800{
  background-color:#124777!important;
  box-shadow:0 12px 28px rgba(7,36,69,.15);
}
#pages .bg-navy-800:hover{
  box-shadow:0 16px 34px rgba(7,36,69,.20);
}
#pages .bg-navy-900\/50{background-color:rgba(13,53,93,.58)!important}
#pages .bg-navy-900\/60{background-color:rgba(13,53,93,.66)!important}
#pages input.bg-navy-900\/60,#pages select.bg-navy-900\/60,#pages textarea.bg-navy-900\/60{
  background:rgba(13,53,93,.72)!important;
}
#login-screen .bg-navy-800\/80{
  background:rgba(18,71,119,.90)!important;
}
@media(max-width:1023px){.sidebar{transform:translateX(-100%);position:fixed;z-index:90;transition:transform .3s ease}.sidebar.open{transform:translateX(0)}.main-area{margin-left:0!important}}


/* ===== ADMIN LIGHT BACKGROUND THEME ===== */
html,body{
  background:#f5f7fb!important;
}
body{
  color:#374151!important;
}
::-webkit-scrollbar-track{background:#eef2f7!important}
::-webkit-scrollbar-thumb{background:#c7d2e0!important}
::-webkit-scrollbar-thumb:hover{background:#94a3b8!important}

#admin-layout{
  background:
    radial-gradient(circle at 92% 4%,rgba(11,95,220,.055),transparent 25%),
    linear-gradient(180deg,#f8fafc 0%,#f4f7fb 100%)!important;
}
.main-area{
  background:transparent!important;
}

/* Sidebar putih */
.sidebar{
  background:rgba(255,255,255,.985)!important;
  border-right:1px solid #e5e7eb!important;
  box-shadow:8px 0 28px rgba(15,23,42,.055)!important;
}
.sidebar>div:first-child,
.sidebar>div:last-child{
  border-color:#e5e7eb!important;
}
.sidebar .text-white{color:#111827!important}
.sidebar .text-stone-500{color:#6b7280!important}
.sidebar .text-stone-600{color:#94a3b8!important}
.sidebar-link{
  color:#64748b!important;
}
.sidebar-link:hover{
  background:#f3f6fa!important;
  color:#0f172a!important;
}
.sidebar-link.active{
  background:#fff1f2!important;
  color:#d10000!important;
  box-shadow:inset 3px 0 0 #e90000;
}
.sidebar-link.active iconify-icon{color:#e90000!important}

/* Header putih */
.main-area>header{
  background:rgba(255,255,255,.94)!important;
  border-bottom:1px solid #e5e7eb!important;
  box-shadow:0 8px 24px rgba(15,23,42,.045)!important;
}
.main-area>header .text-white{color:#111827!important}
.main-area>header .text-stone-500{color:#64748b!important}
.main-area>header button{color:#64748b!important}
.main-area>header button:hover{color:#0f172a!important}

/* Area konten dan kartu */
#pages .bg-navy-800,
#pages .bg-navy-800\/95,
#pages .bg-navy-800\/80{
  background:#ffffff!important;
  box-shadow:0 10px 28px rgba(15,23,42,.055)!important;
}
#pages .bg-navy-900\/50,
#pages .bg-navy-900\/60{
  background:#f8fafc!important;
}
#pages .bg-navy-700\/50,
#pages .bg-navy-700\/30{
  background:#f1f5f9!important;
}
#pages [class*="border-navy-"]{
  border-color:#e5e7eb!important;
}
#pages .bg-gradient-to-r{
  background-image:linear-gradient(135deg,#ffffff 0%,#f7faff 100%)!important;
}
#pages .text-white{color:#111827!important}
#pages .text-stone-300{color:#475569!important}
#pages .text-stone-400{color:#64748b!important}
#pages .text-stone-500{color:#6b7280!important}
#pages .text-stone-600{color:#94a3b8!important}
#pages .table-row:hover{background:#f8fafc!important}

/* Form */
#pages input,
#pages select,
#pages textarea,
.modal-box input,
.modal-box select,
.modal-box textarea{
  background:#ffffff!important;
  color:#111827!important;
  border-color:#dbe2ea!important;
}
#pages input::placeholder,
#pages textarea::placeholder,
.modal-box input::placeholder,
.modal-box textarea::placeholder{
  color:#9ca3af!important;
}
#pages input:focus,
#pages select:focus,
#pages textarea:focus,
.modal-box input:focus,
.modal-box select:focus,
.modal-box textarea:focus{
  border-color:#0b5fdc!important;
  box-shadow:0 0 0 3px rgba(11,95,220,.10)!important;
}

/* Modal putih */
.modal-overlay{
  background:rgba(15,23,42,.36)!important;
  backdrop-filter:blur(5px)!important;
}
.modal-box{
  background:#ffffff!important;
  border:1px solid #e5e7eb!important;
  box-shadow:0 24px 70px rgba(15,23,42,.18)!important;
}
.modal-box .text-white{color:#111827!important}
.modal-box .text-stone-300{color:#475569!important}
.modal-box .text-stone-400{color:#64748b!important}
.modal-box .text-stone-500{color:#6b7280!important}
.modal-box .text-stone-600{color:#94a3b8!important}
.modal-box [class*="border-navy-"]{border-color:#e5e7eb!important}
.modal-box .bg-navy-900\/50,
.modal-box .bg-navy-900\/60,
.modal-box .bg-navy-700\/50{
  background:#f8fafc!important;
}

/* Tombol berwarna tetap kontras */
#pages .bg-gold-500.text-white,
#pages .bg-gold-600.text-white,
#pages .bg-red-500.text-white,
#pages .bg-blue-500.text-white,
#pages .bg-emerald-500.text-white,
.modal-box .bg-gold-500.text-white,
.modal-box .bg-red-500.text-white,
.modal-box .bg-blue-500.text-white,
.modal-box .bg-emerald-500.text-white{
  color:#ffffff!important;
}

/* Login dibuat terang dan bersih */
#login-screen{
  background:#f5f7fb!important;
}
#login-screen>div:first-child{
  opacity:.10!important;
  filter:grayscale(.15) saturate(.7) brightness(1.45)!important;
}
#login-screen>div:nth-child(2){
  background:linear-gradient(135deg,rgba(255,255,255,.94),rgba(245,247,251,.90))!important;
}
#login-screen .bg-navy-800\/80{
  background:rgba(255,255,255,.96)!important;
  border-color:#e5e7eb!important;
  box-shadow:0 24px 60px rgba(15,23,42,.10)!important;
}
#login-screen .text-white{color:#111827!important}
#login-screen .text-stone-400{color:#64748b!important}
#login-screen .text-stone-500{color:#6b7280!important}
#login-screen .text-stone-600{color:#94a3b8!important}
#login-screen input{
  background:#ffffff!important;
  color:#111827!important;
  border-color:#dbe2ea!important;
}
#login-screen input:focus{
  border-color:#0b5fdc!important;
  box-shadow:0 0 0 3px rgba(11,95,220,.10)!important;
}
#login-screen .bg-gold-500.text-white{color:#ffffff!important}

/* Toast tetap tegas */
.toast-c{
  background:#ffffff!important;
  color:#111827!important;
  border:1px solid #e5e7eb!important;
  box-shadow:0 18px 40px rgba(15,23,42,.16)!important;
}


/* ===== APPOINTMENT ADMIN CALENDAR ===== */
.appointment-calendar-card{
  background:#fff;
  border:1px solid #e5e7eb;
  border-radius:18px;
  box-shadow:0 10px 28px rgba(15,23,42,.055);
}
.appointment-calendar-grid{display:grid;grid-template-columns:repeat(7,minmax(0,1fr));gap:6px}
.appointment-cal-head{padding:7px 2px;text-align:center;font-size:10px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:#94a3b8}
.appointment-cal-day{
  position:relative;min-height:68px;padding:8px;border:1px solid #eef2f7;border-radius:12px;background:#fff;
  text-align:left;transition:all .18s ease;cursor:pointer;color:#334155;
}
.appointment-cal-day:hover{border-color:#bfd3f4;background:#f8fbff;transform:translateY(-1px);box-shadow:0 6px 16px rgba(15,23,42,.06)}
.appointment-cal-day.empty{background:transparent;border-color:transparent;cursor:default;box-shadow:none;transform:none}
.appointment-cal-day.today{border-color:#0b5fdc;box-shadow:inset 0 0 0 1px rgba(11,95,220,.12)}
.appointment-cal-day.selected{background:#eef5ff;border-color:#0b5fdc;box-shadow:0 6px 18px rgba(11,95,220,.10)}
.appointment-cal-day.has-events .appointment-day-number{font-weight:700;color:#0f172a}
.appointment-day-number{font-size:12px;font-weight:600;line-height:1;color:#64748b}
.appointment-day-count{position:absolute;top:7px;right:7px;min-width:19px;height:19px;padding:0 5px;border-radius:999px;background:#0b5fdc;color:#fff;font-size:9px;font-weight:700;display:flex;align-items:center;justify-content:center}
.appointment-status-dots{position:absolute;left:8px;bottom:8px;display:flex;gap:4px;align-items:center;flex-wrap:wrap}
.appointment-status-dot{width:6px;height:6px;border-radius:999px;display:inline-block}
.appointment-status-dot.pending{background:#f59e0b}.appointment-status-dot.confirmed{background:#10b981}.appointment-status-dot.cancelled{background:#ef4444}.appointment-status-dot.done{background:#3b82f6}
.appointment-calendar-nav{width:38px;height:38px;border:1px solid #e2e8f0;border-radius:11px;background:#fff;color:#64748b;display:flex;align-items:center;justify-content:center;transition:all .18s ease}
.appointment-calendar-nav:hover{border-color:#0b5fdc;color:#0b5fdc;background:#f8fbff}
.appointment-calendar-today{padding:9px 13px;border-radius:11px;background:#f1f5f9;color:#475569;font-size:11px;font-weight:700;transition:all .18s ease}
.appointment-calendar-today:hover{background:#e7eef7;color:#0f172a}
.appointment-calendar-legend{display:flex;flex-wrap:wrap;gap:12px;color:#64748b;font-size:10px}
.appointment-calendar-legend span{display:inline-flex;align-items:center;gap:5px}
.appointment-day-list{max-height:375px;overflow-y:auto;padding-right:3px}
.appointment-day-item{border:1px solid #e8edf3;background:#f8fafc;border-radius:13px;padding:12px;transition:all .18s ease}
.appointment-day-item:hover{border-color:#d8e3f1;background:#fff;box-shadow:0 6px 16px rgba(15,23,42,.05)}
@media(max-width:640px){
  .appointment-calendar-grid{gap:4px}.appointment-cal-day{min-height:54px;padding:6px}.appointment-status-dots{left:6px;bottom:6px}.appointment-day-count{top:5px;right:5px}.appointment-calendar-card{border-radius:16px}
}

</style>
</head>
<body class="font-sans bg-navy-900 text-stone-300 min-h-screen">

<!-- LOGIN -->
<div id="login-screen" class="min-h-screen flex items-center justify-center px-6 relative overflow-hidden">
  <div class="absolute inset-0" style="background-image:url('https://picsum.photos/seed/construction-skyline/1920/1080');background-size:cover;background-position:center;filter:brightness(.42) saturate(.9) blur(2px)"></div>
  <div class="absolute inset-0 bg-gradient-to-br from-navy-900/95 via-navy-800/90 to-navy-900/95"></div>
  <div class="relative z-10 w-full max-w-md">
    <div class="text-center mb-10 reveal rv">
      @if(!empty($branding['logo_url']))
        <div class="w-16 h-16 mx-auto rounded-2xl overflow-hidden flex items-center justify-center bg-white ring-1 ring-white/20 mb-4 shadow-lg"><img src="{{ $branding['logo_url'] }}" alt="{{ $branding['short_name'] }}" class="w-full h-full object-contain"></div>
      @else
        <div class="w-16 h-16 mx-auto bg-gold-500 rounded-2xl flex items-center justify-center text-white font-serif font-bold text-2xl mb-4 shadow-lg shadow-gold-500/20">{{ $branding['logo_letter'] }}</div>
      @endif
      <h1 class="font-serif text-2xl text-white">Admin Panel</h1>
      <p class="text-stone-500 text-sm mt-1">{{ $branding['company'] }}</p>
    </div>
    <div class="bg-navy-800/80 backdrop-blur-xl rounded-2xl p-8 border border-navy-700/50 shadow-2xl reveal rv" style="transition-delay:.1s">
      <h2 class="font-serif text-xl text-white mb-6">Masuk ke Dashboard</h2>
      <div class="space-y-4">
        <div><label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Email</label><input type="email" id="login-email" value="admin@ksn.co.id" class="w-full mt-1.5 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm placeholder:text-stone-600 transition-all"></div>
        <div><label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Password</label><input type="password" id="login-pass" value="admin123" class="w-full mt-1.5 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm placeholder:text-stone-600 transition-all"></div>
        <button onclick="doLogin()" class="w-full py-3.5 bg-gold-500 text-white text-xs font-semibold tracking-[.15em] uppercase rounded-xl hover:bg-gold-400 transition-all hover:shadow-lg hover:shadow-gold-500/20 hover:-translate-y-0.5 mt-2">Masuk</button>
      </div>
      <p class="text-[10px] text-stone-600 text-center mt-6">Demo: admin@ksn.co.id / admin123</p>
    </div>
  </div>
</div>


<!-- ADMIN LAYOUT -->
<div id="admin-layout" class="hidden min-h-screen">
  <!-- Sidebar -->
  <aside class="sidebar fixed top-0 left-0 bottom-0 w-64 bg-navy-800/95 backdrop-blur-xl border-r border-navy-700/50 z-50 flex flex-col">
    <div class="p-5 border-b border-navy-700/50">
      <div class="flex items-center gap-3">
        @if(!empty($branding['logo_url']))
          <div class="w-10 h-10 rounded-lg overflow-hidden flex items-center justify-center bg-white ring-1 ring-white/20 flex-shrink-0"><img src="{{ $branding['logo_url'] }}" alt="{{ $branding['short_name'] }}" class="w-full h-full object-contain"></div>
        @else
          <div class="w-10 h-10 bg-gold-500 rounded-lg flex items-center justify-center text-white font-serif font-bold text-lg flex-shrink-0">{{ $branding['logo_letter'] }}</div>
        @endif
        <div><div class="text-sm font-semibold text-white leading-tight">{{ $branding['short_name'] }} Admin</div><div class="text-[10px] text-stone-500 tracking-wider">Management Panel</div></div>
      </div>
    </div>
    <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
      <div class="text-[10px] font-semibold tracking-[.15em] uppercase text-stone-600 px-4 mb-2 mt-2">Menu Utama</div>
      <div class="sidebar-link active" onclick="goPage('dashboard')" data-p="dashboard"><iconify-icon icon="lucide:layout-dashboard" width="18"></iconify-icon> Dashboard</div>
      <div class="sidebar-link" onclick="goPage('portfolio')" data-p="portfolio"><iconify-icon icon="lucide:images" width="18"></iconify-icon> Update Portfolio</div>
      <div class="sidebar-link" onclick="goPage('certifications')" data-p="certifications"><iconify-icon icon="lucide:badge-check" width="18"></iconify-icon> Sertifikasi</div>
      <div class="sidebar-link" onclick="goPage('appointments')" data-p="appointments"><iconify-icon icon="lucide:calendar-check" width="18"></iconify-icon> Jadwal Temu</div>
      <div class="sidebar-link" onclick="goPage('messages')" data-p="messages"><iconify-icon icon="lucide:mail" width="18"></iconify-icon> Pesan <span id="msg-badge" class="ml-auto bg-red-500 text-white text-[10px] w-5 h-5 rounded-full flex items-center justify-center font-bold hidden">3</span></div>
      <div class="text-[10px] font-semibold tracking-[.15em] uppercase text-stone-600 px-4 mb-2 mt-6">Pengaturan</div>
      <div class="sidebar-link" onclick="goPage('team')" data-p="team"><iconify-icon icon="lucide:user-cog" width="18"></iconify-icon> Tim</div>
      <div class="sidebar-link" onclick="goPage('settings')" data-p="settings"><iconify-icon icon="lucide:settings" width="18"></iconify-icon> Pengaturan</div>
    </nav>
    <div class="p-4 border-t border-navy-700/50">
      <button onclick="doLogout()" class="sidebar-link text-red-400 hover:!text-red-300 hover:!bg-red-500/10 w-full"><iconify-icon icon="lucide:log-out" width="18"></iconify-icon> Keluar</button>
    </div>
  </aside>

  <!-- Main -->
  <div class="main-area" style="margin-left:256px;min-height:100vh">
    <header class="sticky top-0 z-40 bg-navy-900/90 backdrop-blur-xl border-b border-navy-700/30 px-6 h-16 flex items-center justify-between">
      <button onclick="document.querySelector('.sidebar').classList.toggle('open')" class="lg:hidden text-stone-400 hover:text-white p-1"><iconify-icon icon="lucide:menu" width="22"></iconify-icon></button>
      <h2 id="page-title" class="font-serif text-lg text-white">Dashboard</h2>
      <div class="flex items-center gap-4">
        <div class="hidden sm:flex items-center gap-2 text-xs text-stone-500"><iconify-icon icon="lucide:clock" width="14"></iconify-icon><span id="live-clock"></span></div>
        <div class="w-9 h-9 rounded-full bg-gold-500/20 flex items-center justify-center text-gold-400 font-semibold text-sm">A</div>
      </div>
    </header>
    <div id="pages" class="p-6"></div>
  </div>
</div>

<!-- Modal & Toast -->
<div class="modal-overlay" id="modal-ov" onclick="closeModal()"></div>
<div class="modal-box" id="modal-box"></div>
<div class="toast-c" id="toast-c"></div>

<script>
    var DB={portfolios:[],appointments:[],messages:[],team:[],certifications:[],settings:{}};
    var ADMIN_AUTHENTICATED = @json($authenticated);

async function doLogin(){
    var email=document.getElementById('login-email').value.trim();
    var password=document.getElementById('login-pass').value;
    try{
      await apiRequest('/admin/login',{method:'POST',body:JSON.stringify({email:email,password:password})});
      await loadAdminData();
      document.getElementById('login-screen').classList.add('hidden');
      document.getElementById('admin-layout').classList.remove('hidden');
      goPage('dashboard');
    }catch(err){toast('❌ '+err.message);}
}
async function doLogout(){
    try{await apiRequest('/admin/logout',{method:'POST'});}catch(e){}
    document.getElementById('login-screen').classList.remove('hidden');
    document.getElementById('admin-layout').classList.add('hidden');
}
setInterval(
    function(){
        var n=new Date();
        var el=document.getElementById('live-clock');
        if(el)el.textContent=n.toLocaleTimeString('id-ID',{hour:'2-digit',minute:'2-digit'})
    },1000);

var curPage='dashboard';
function goPage(p){
  curPage=p;
  document.querySelectorAll('.sidebar-link').forEach(function(l){l.classList.toggle('active',l.dataset.p===p)});
  var titles={dashboard:'Dashboard',portfolio:'Update Portfolio',certifications:'Sertifikasi',appointments:'Jadwal Pertemuan',messages:'Pesan Masuk',team:'Manajemen Tim',settings:'Pengaturan'};
  document.getElementById('page-title').textContent=titles[p]||p;
  var fn={dashboard:pgDashboard,portfolio:pgPortfolio,certifications:pgCertifications,appointments:pgAppointments,messages:pgMessages,team:pgTeam,settings:pgSettings};
  if(fn[p])fn[p](document.getElementById('pages'));
  setTimeout(function(){document.querySelectorAll('.reveal').forEach(function(el,i){setTimeout(function(){el.classList.add('rv')},i*50)})},50);
  document.querySelector('.sidebar').classList.remove('open');
}

function pgDashboard(c){
    var categories=[];
    DB.portfolios.forEach(function(p){if(categories.indexOf(p.category)<0)categories.push(p.category)});
    var unread=DB.messages.filter(function(m){return!m.read}).length;
    var latestUpdate=DB.portfolios.length?DB.portfolios[0].updated:'-';
    if(unread>0){var b=document.getElementById('msg-badge');b.textContent=unread;b.classList.remove('hidden')}
    c.innerHTML=`
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
            <div class="stat-card bg-navy-800 rounded-2xl p-6 border border-navy-700/30 hover:border-gold-500/30 transition-colors"><div class="flex items-center justify-between mb-4"><div class="w-11 h-11 rounded-xl bg-blue-500/15 flex items-center justify-center text-blue-400"><iconify-icon icon="lucide:images" width="20"></iconify-icon></div><span class="text-xs text-stone-500">Total</span></div><div class="text-3xl font-serif text-white">${DB.portfolios.length}</div><div class="text-xs text-stone-500 mt-1">Item Portfolio</div></div>
            <div class="stat-card bg-navy-800 rounded-2xl p-6 border border-navy-700/30 hover:border-gold-500/30 transition-colors"><div class="flex items-center justify-between mb-4"><div class="w-11 h-11 rounded-xl bg-gold-500/15 flex items-center justify-center text-gold-400"><iconify-icon icon="lucide:tags" width="20"></iconify-icon></div><span class="text-xs text-stone-500">Kategori</span></div><div class="text-3xl font-serif gradient-text">${categories.length}</div><div class="text-xs text-stone-500 mt-1">Jenis Karya</div></div>
            <div class="stat-card bg-navy-800 rounded-2xl p-6 border border-navy-700/30 hover:border-blue-500/30 transition-colors"><div class="flex items-center justify-between mb-4"><div class="w-11 h-11 rounded-xl bg-blue-500/15 flex items-center justify-center text-blue-400"><iconify-icon icon="lucide:history" width="20"></iconify-icon></div><span class="text-xs text-stone-500">Terbaru</span></div><div class="text-lg font-serif text-white mt-2">${escapeHtml(latestUpdate)}</div><div class="text-xs text-stone-500 mt-2">Update Portfolio</div></div>
        </div>
        <div class="grid lg:grid-cols-3 gap-6 mb-8">
            <div class="bg-navy-800 rounded-2xl p-6 border border-navy-700/30 reveal"><h3 class="text-sm font-medium text-white mb-4 flex items-center gap-2"><iconify-icon icon="lucide:calendar-clock" width="16" class="text-gold-400"></iconify-icon> Janji Temu Mendatang</h3><div class="space-y-3">${DB.appointments.filter(function(a){return a.status==='pending'}).slice(0,4).map(function(a){return '<div class="flex items-center gap-3 p-3 bg-navy-900/50 rounded-xl"><div class="w-9 h-9 rounded-lg bg-gold-500/15 flex items-center justify-center text-gold-400 flex-shrink-0"><iconify-icon icon="lucide:user" width="14"></iconify-icon></div><div class="flex-1 min-w-0"><div class="text-sm text-white font-medium truncate">'+a.name+'</div><div class="text-[11px] text-stone-500">'+a.type+' · '+a.date+' '+a.time+'</div></div></div>';}).join('')||'<p class="text-sm text-stone-600 py-8 text-center">Tidak ada janji menunggu.</p>'}</div></div>
            <div class="bg-navy-800 rounded-2xl p-6 border border-navy-700/30 reveal" style="transition-delay:.1s"><h3 class="text-sm font-medium text-white mb-4 flex items-center gap-2"><iconify-icon icon="lucide:mail" width="16" class="text-gold-400"></iconify-icon> Pesan Terbaru</h3><div class="space-y-3">${DB.messages.slice(0,3).map(function(m){return '<div class="flex items-start gap-3 p-3 bg-navy-900/50 rounded-xl'+(m.read?' opacity-50':'')+'"><div class="w-9 h-9 rounded-lg '+(m.read?'bg-stone-700/50':'bg-red-500/15 text-red-400')+' flex items-center justify-center flex-shrink-0 mt-0.5"><iconify-icon icon="lucide:mail" width="14"></iconify-icon></div><div class="flex-1 min-w-0"><div class="text-sm text-white font-medium truncate">'+m.name+'</div><div class="text-[11px] text-stone-500 truncate">'+m.subject+'</div></div></div>';}).join('')}</div></div>
            <div class="bg-navy-800 rounded-2xl p-6 border border-navy-700/30 reveal" style="transition-delay:.2s"><div class="flex items-center justify-between mb-4"><h3 class="text-sm font-medium text-white flex items-center gap-2"><iconify-icon icon="lucide:images" width="16" class="text-gold-400"></iconify-icon> Portfolio Terbaru</h3><button onclick="goPage('portfolio')" class="text-[10px] text-gold-400 hover:text-gold-300">Kelola</button></div><div class="space-y-3">${DB.portfolios.slice(0,4).map(function(p){return '<div class="flex items-center gap-3 p-3 bg-navy-900/50 rounded-xl"><img src="'+safeAttr(p.image)+'" alt="" class="w-11 h-11 rounded-lg object-cover flex-shrink-0"><div class="flex-1 min-w-0"><div class="text-sm text-white font-medium truncate">'+escapeHtml(p.title)+'</div><div class="text-[11px] text-stone-500">'+escapeHtml(p.category)+' · '+escapeHtml(p.updated)+'</div></div><button onclick="previewPortfolio('+p.id+')" class="text-blue-400 hover:text-blue-300 p-1" title="Pratinjau"><iconify-icon icon="lucide:eye" width="15"></iconify-icon></button></div>';}).join('')}</div></div>
        </div>`;
}

function pgPortfolio(c){
  c.innerHTML=`
  <div class="bg-gradient-to-r from-navy-800 to-navy-700 rounded-2xl p-6 border border-navy-600/40 mb-6 reveal">
    <div class="flex items-center gap-2 text-gold-400 text-xs font-semibold tracking-[.18em] uppercase"><iconify-icon icon="lucide:database" width="15"></iconify-icon> Manajemen Portfolio</div>
    <h3 class="font-serif text-2xl text-white mt-2">Kelola data portfolio perusahaan</h3>
    <p class="text-sm text-stone-400 mt-2 max-w-2xl">Tambahkan, perbarui, pratinjau, dan hapus data portfolio langsung dari admin panel.</p>
  </div>
  <div class="flex flex-wrap gap-2 mb-6 reveal"><div class="flex-1 min-w-[240px] flex items-center gap-2"><iconify-icon icon="lucide:search" width="16" class="text-stone-500"></iconify-icon><input type="text" id="portfolio-search" placeholder="Cari judul, klien, atau kategori..." oninput="filterPortfolioTable()" class="flex-1 bg-navy-800 border border-navy-700/50 rounded-xl px-4 py-2.5 text-sm text-white placeholder:text-stone-600"></div><button onclick="openPortfolioModal()" class="px-5 py-2.5 bg-gold-500 text-white text-xs font-semibold tracking-wider uppercase rounded-xl hover:bg-gold-400 transition-all hover:-translate-y-0.5 flex items-center gap-2 whitespace-nowrap"><iconify-icon icon="lucide:plus" width="14"></iconify-icon> Tambah Portfolio</button></div>
  <div class="overflow-x-auto reveal" style="transition-delay:.1s"><table class="w-full text-sm"><thead><tr class="border-b border-navy-700/50"><th class="text-left py-3 px-4 text-xs font-semibold tracking-wider uppercase text-stone-500">Portfolio</th><th class="text-left py-3 px-4 text-xs font-semibold tracking-wider uppercase text-stone-500">Kategori</th><th class="text-left py-3 px-4 text-xs font-semibold tracking-wider uppercase text-stone-500">Lokasi / Tahun</th><th class="text-left py-3 px-4 text-xs font-semibold tracking-wider uppercase text-stone-500">Terakhir Update</th><th class="text-right py-3 px-4 text-xs font-semibold tracking-wider uppercase text-stone-500">Aksi</th></tr></thead><tbody id="portfolio-tbody"></tbody></table></div>`;
  filterPortfolioTable();
}

function filterPortfolioTable(){
  var q=(document.getElementById('portfolio-search')||{}).value||'';
  var ql=q.toLowerCase();
  var h='';
  DB.portfolios.forEach(function(p){
    var haystack=(p.title+' '+p.client+' '+p.category+' '+p.location).toLowerCase();
    if(ql && haystack.indexOf(ql)<0) return;
    h += '<tr class="table-row border-b border-navy-700/20"><td class="py-3 px-4"><div class="flex items-center gap-3"><img src="'+safeAttr(p.image)+'" alt="" class="w-14 h-12 rounded-xl object-cover flex-shrink-0"><div class="min-w-0"><div class="text-white font-medium truncate max-w-[250px]">'+escapeHtml(p.title)+'</div><div class="text-[11px] text-stone-500 line-clamp-2 max-w-[300px]">'+escapeHtml(p.description)+'</div></div></div></td><td class="py-3 px-4"><span class="px-2 py-0.5 rounded-full bg-navy-700/50 text-[10px] text-stone-400">'+escapeHtml(p.category)+'</span></td><td class="py-3 px-4 text-stone-400"><div>'+escapeHtml(p.location)+'</div><div class="text-[10px] text-stone-600">'+escapeHtml(p.year)+'</div></td><td class="py-3 px-4 text-stone-400">'+escapeHtml(p.updated)+'</td><td class="py-3 px-4 text-right whitespace-nowrap"><button onclick="previewPortfolio('+p.id+')" class="text-blue-400 hover:text-blue-300 transition-colors p-1" title="Pratinjau"><iconify-icon icon="lucide:eye" width="16"></iconify-icon></button><button onclick="openPortfolioModal('+p.id+')" class="text-gold-400 hover:text-gold-300 transition-colors p-1 ml-1" title="Edit"><iconify-icon icon="lucide:pencil" width="16"></iconify-icon></button><button onclick="deletePortfolio('+p.id+')" class="text-red-400 hover:text-red-300 transition-colors p-1 ml-1" title="Hapus"><iconify-icon icon="lucide:trash-2" width="16"></iconify-icon></button></td></tr>';
  });
  document.getElementById('portfolio-tbody').innerHTML = h || '<tr><td colspan="5" class="py-10 text-center text-stone-600">Tidak ada data portfolio.</td></tr>';
}

function openPortfolioModal(id){
  var p=id?DB.portfolios.find(function(x){return x.id===id}):null;
  var isEdit=!!p;
  var imageSrc=isEdit&&p.image?p.image:'';

  var h=`
    <div class="p-6">
      <div class="flex items-center justify-between mb-6">
        <h3 class="font-serif text-xl text-white">${isEdit?'Edit':'Tambah'} Portfolio</h3>
        <button onclick="closeModal()" class="text-stone-500 hover:text-white transition-colors p-1">
          <iconify-icon icon="lucide:x" width="18"></iconify-icon>
        </button>
      </div>

      <form onsubmit="savePortfolio(event,${id||0})" class="space-y-4" enctype="multipart/form-data">
        <div>
          <label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Judul Portfolio *</label>
          <input name="title" value="${safeAttr(isEdit?p.title:'')}" required placeholder="Contoh: Rumah Modern Minimalis" class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm placeholder:text-stone-600">
        </div>

        <div class="grid sm:grid-cols-2 gap-4">
          <div>
            <label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Klien</label>
            <input name="client" value="${safeAttr(isEdit?p.client||'':'')}" placeholder="Nama perusahaan / klien" class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm placeholder:text-stone-600">
          </div>
          <div>
            <label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Kategori *</label>
            <input name="category" value="${safeAttr(isEdit?p.category:'')}" required placeholder="Gedung, Interior, Landscape..." class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm placeholder:text-stone-600">
          </div>
        </div>

        <div class="grid sm:grid-cols-2 gap-4">
          <div>
            <label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Lokasi</label>
            <input name="location" value="${safeAttr(isEdit?p.location||'':'')}" placeholder="Jakarta" class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm placeholder:text-stone-600">
          </div>
          <div>
            <label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Tahun</label>
            <input name="year" type="number" min="1900" max="2100" value="${safeAttr(isEdit?p.year:new Date().getFullYear())}" class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm">
          </div>
        </div>

        <div>
          <label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Luas / Area</label>
          <input name="area" value="${safeAttr(isEdit?p.area||'':'')}" placeholder="Contoh: 1.250 m²" class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm placeholder:text-stone-600">
        </div>

        <div>
          <label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Foto Portfolio ${isEdit?'':'*'}</label>

          <div class="mt-2 overflow-hidden rounded-xl border border-navy-700 bg-navy-900/50">
            <div class="h-44 relative flex items-center justify-center">
              <img id="portfolio-image-preview" src="${safeAttr(imageSrc)}" alt="Preview Portfolio" class="w-full h-full object-cover ${imageSrc?'':'hidden'}">
              <div id="portfolio-image-empty" class="${imageSrc?'hidden':''} text-center text-stone-600">
                <iconify-icon icon="lucide:image-plus" width="34"></iconify-icon>
                <div class="text-xs mt-2">Preview foto portfolio</div>
              </div>
            </div>
          </div>

          <input
            name="portfolio_image"
            type="file"
            accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
            ${isEdit?'':'required'}
            onchange="previewPortfolioImage(this)"
            class="w-full mt-3 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-stone-300 text-sm file:mr-4 file:rounded-lg file:border-0 file:bg-gold-500 file:px-3 file:py-2 file:text-xs file:font-semibold file:text-white hover:file:bg-gold-400"
          >

          <p class="text-[10px] text-stone-600 mt-1">
            JPG, JPEG, PNG, atau WebP. Maksimal 10 MB.
            ${isEdit?' Kosongkan jika foto lama tidak ingin diganti.':' Foto wajib dipilih saat menambah portfolio.'}
          </p>
        </div>

        <div>
          <label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Deskripsi *</label>
          <textarea name="description" rows="4" required placeholder="Jelaskan konsep, hasil pekerjaan, dan keunggulan portfolio..." class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm placeholder:text-stone-600 resize-none">${escapeHtml(isEdit?p.description:'')}</textarea>
        </div>

        <button id="portfolio-submit-btn" type="submit" class="w-full py-3 bg-gold-500 text-white text-xs font-semibold tracking-wider uppercase rounded-xl hover:bg-gold-400 transition-all hover:-translate-y-0.5">
          ${isEdit?'Simpan Perubahan':'Tambah Portfolio'}
        </button>
      </form>
    </div>`;

  showModal(h);
}

function previewPortfolioImage(input){
  var preview=document.getElementById('portfolio-image-preview');
  var empty=document.getElementById('portfolio-image-empty');

  if(!preview||!input||!input.files||!input.files[0])return;

  var file=input.files[0];

  if(!file.type.match(/^image\/(jpeg|png|webp)$/)){
    input.value='';
    toast('❌ File harus berupa JPG, JPEG, PNG, atau WebP.');
    return;
  }

  if(file.size>10*1024*1024){
    input.value='';
    toast('❌ Ukuran foto maksimal 10 MB.');
    return;
  }

  var reader=new FileReader();
  reader.onload=function(e){
    preview.src=e.target.result;
    preview.classList.remove('hidden');
    if(empty)empty.classList.add('hidden');
  };
  reader.readAsDataURL(file);
}

async function savePortfolio(e,id){
  e.preventDefault();

  var f=e.target;
  var btn=document.getElementById('portfolio-submit-btn');
  var oldText=btn?btn.innerHTML:'';

  if(btn){
    btn.disabled=true;
    btn.innerHTML='<iconify-icon icon="lucide:loader-circle" width="15"></iconify-icon> Menyimpan...';
  }

  var formData=new FormData(f);

  if(id){
    formData.append('_method','PUT');
  }

  try{
    await apiRequest(
      id?'/admin/portfolios/'+id:'/admin/portfolios',
      {method:'POST',body:formData}
    );

    await loadAdminData();
    toast(id?'✅ Portfolio berhasil diperbarui':'✅ Portfolio berhasil ditambahkan');
    closeModal();
    goPage('portfolio');
  }catch(err){
    toast('❌ '+err.message);
    if(btn){
      btn.disabled=false;
      btn.innerHTML=oldText;
    }
  }
}

async function deletePortfolio(id){
  if(!confirm('Hapus portfolio ini? Foto portfolio yang tersimpan di server juga akan dihapus.'))return;

  try{
    await apiRequest('/admin/portfolios/'+id,{method:'DELETE'});
    await loadAdminData();
    toast('🗑️ Portfolio dihapus');
    goPage('portfolio');
  }catch(err){
    toast('❌ '+err.message);
  }
}

function previewPortfolio(id){
  var p=DB.portfolios.find(function(x){return x.id===id});
  if(!p)return;

  var h='<div class="overflow-hidden"><div class="relative h-64"><img src="'+safeAttr(p.image)+'" alt="'+safeAttr(p.title)+'" class="w-full h-full object-cover"><div class="absolute inset-0 bg-gradient-to-t from-navy-900 via-transparent to-transparent"></div><button onclick="closeModal()" class="absolute top-4 right-4 w-9 h-9 rounded-full bg-navy-900/70 text-white flex items-center justify-center hover:bg-navy-900"><iconify-icon icon="lucide:x" width="18"></iconify-icon></button><div class="absolute bottom-5 left-6 right-6"><div class="text-[10px] text-gold-400 uppercase tracking-[.18em] font-semibold">Pratinjau Admin</div><h3 class="font-serif text-3xl text-white mt-2">'+escapeHtml(p.title)+'</h3></div></div><div class="p-6"><div class="flex flex-wrap gap-x-6 gap-y-2 text-xs text-stone-400 mb-5"><span class="flex items-center gap-1"><iconify-icon icon="lucide:tag" width="13"></iconify-icon>'+escapeHtml(p.category)+'</span><span class="flex items-center gap-1"><iconify-icon icon="lucide:map-pin" width="13"></iconify-icon>'+escapeHtml(p.location||'-')+'</span><span class="flex items-center gap-1"><iconify-icon icon="lucide:calendar" width="13"></iconify-icon>'+escapeHtml(p.year||'-')+'</span>'+(p.area?'<span class="flex items-center gap-1"><iconify-icon icon="lucide:ruler" width="13"></iconify-icon>'+escapeHtml(p.area)+'</span>':'')+'</div><p class="text-sm text-stone-300 leading-relaxed">'+escapeHtml(p.description)+'</p>'+(p.client?'<div class="mt-5 pt-5 border-t border-navy-700/50"><div class="text-[10px] text-stone-500 uppercase tracking-wider">Klien</div><div class="text-sm text-white mt-1">'+escapeHtml(p.client)+'</div></div>':'')+'</div></div>';

  showModal(h);
}

function persistPortfolios(){}
function loadPortfolios(){}
function escapeHtml(value){
  return String(value==null?'':value).replace(/[&<>"']/g,function(ch){return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'}[ch]});
}
function safeAttr(value){return escapeHtml(value);}

function certificationIsPdf(cert){
  var type=(cert&&cert.file_type?cert.file_type:'').toLowerCase();
  var name=(cert&&cert.file_name?cert.file_name:'').toLowerCase();
  var url=(cert&&cert.file_url?cert.file_url:'').toLowerCase();
  return type==='application/pdf' || name.endsWith('.pdf') || url.indexOf('.pdf')>-1;
}

function certificationMediaThumb(cert){
  if(!cert || !cert.file_url){
    return '<div class="w-14 h-14 rounded-xl bg-gold-500/15 text-gold-400 flex items-center justify-center flex-shrink-0"><iconify-icon icon="lucide:badge-check" width="20"></iconify-icon></div>';
  }

  if(certificationIsPdf(cert)){
    return '<a href="'+safeAttr(cert.file_url)+'" target="_blank" rel="noopener" class="w-14 h-14 rounded-xl bg-red-500/10 text-red-400 flex flex-col items-center justify-center flex-shrink-0 hover:bg-red-500/20 transition-colors" title="Buka PDF"><iconify-icon icon="lucide:file-text" width="20"></iconify-icon><span class="text-[8px] font-bold mt-1">PDF</span></a>';
  }

  return '<a href="'+safeAttr(cert.file_url)+'" target="_blank" rel="noopener" class="w-14 h-14 rounded-xl overflow-hidden bg-navy-900/60 border border-navy-700 flex-shrink-0" title="Lihat gambar"><img src="'+safeAttr(cert.file_url)+'" alt="'+safeAttr(cert.name)+'" class="w-full h-full object-cover"></a>';
}

function pgCertifications(c){
  c.innerHTML=`
  <div class="bg-gradient-to-r from-navy-800 to-navy-700 rounded-2xl p-6 border border-navy-600/40 mb-6 reveal">
    <div class="flex items-center gap-2 text-gold-400 text-xs font-semibold tracking-[.18em] uppercase"><iconify-icon icon="lucide:badge-check" width="15"></iconify-icon> Manajemen Sertifikasi</div>
    <h3 class="font-serif text-2xl text-white mt-2">Kelola data sertifikasi perusahaan</h3>
    <p class="text-sm text-stone-400 mt-2 max-w-3xl">Tambahkan data sertifikasi sekaligus file sertifikat dalam format JPG, JPEG, PNG, WebP, atau PDF. File yang diunggah akan ditampilkan pada section Certification di halaman Tentang.</p>
  </div>
  <div class="flex justify-end mb-6 reveal">
    <button onclick="openCertificationModal()" class="px-5 py-2.5 bg-gold-500 text-white text-xs font-semibold tracking-wider uppercase rounded-xl hover:bg-gold-400 transition-all hover:-translate-y-0.5 flex items-center gap-2"><iconify-icon icon="lucide:plus" width="14"></iconify-icon> Tambah Sertifikasi</button>
  </div>
  <div class="overflow-x-auto reveal" style="transition-delay:.1s">
    <table class="w-full text-sm">
      <thead><tr class="border-b border-navy-700/50">
        <th class="text-left py-3 px-4 text-xs font-semibold tracking-wider uppercase text-stone-500">Sertifikasi</th>
        <th class="text-left py-3 px-4 text-xs font-semibold tracking-wider uppercase text-stone-500">Penerbit / Nomor</th>
        <th class="text-left py-3 px-4 text-xs font-semibold tracking-wider uppercase text-stone-500">File</th>
        <th class="text-left py-3 px-4 text-xs font-semibold tracking-wider uppercase text-stone-500">Tahun</th>
        <th class="text-left py-3 px-4 text-xs font-semibold tracking-wider uppercase text-stone-500">Urutan</th>
        <th class="text-right py-3 px-4 text-xs font-semibold tracking-wider uppercase text-stone-500">Aksi</th>
      </tr></thead>
      <tbody>${DB.certifications.map(function(cert){
        var fileCell = cert.file_url
          ? '<a href="'+safeAttr(cert.file_url)+'" target="_blank" rel="noopener" class="inline-flex items-center gap-1.5 text-xs '+(certificationIsPdf(cert)?'text-red-400 hover:text-red-300':'text-blue-400 hover:text-blue-300')+' transition-colors"><iconify-icon icon="'+(certificationIsPdf(cert)?'lucide:file-text':'lucide:image')+'" width="14"></iconify-icon>'+escapeHtml(cert.file_name||'Lihat file')+'</a>'
          : '<span class="text-xs text-stone-600">Belum ada file</span>';
        return '<tr class="table-row border-b border-navy-700/20">' +
          '<td class="py-3 px-4"><div class="flex items-start gap-3">'+certificationMediaThumb(cert)+'<div><div class="text-white font-medium">'+escapeHtml(cert.name)+'</div><div class="text-[11px] text-stone-500 line-clamp-2 max-w-[300px] mt-1">'+escapeHtml(cert.description||'')+'</div></div></div></td>' +
          '<td class="py-3 px-4 text-stone-400"><div>'+escapeHtml(cert.issuer||'-')+'</div><div class="text-[10px] text-stone-600 mt-1">'+escapeHtml(cert.certificate_number||'-')+'</div></td>' +
          '<td class="py-3 px-4 max-w-[220px] break-all">'+fileCell+'</td>' +
          '<td class="py-3 px-4 text-stone-400">'+escapeHtml(cert.issued_year||'-')+'</td>' +
          '<td class="py-3 px-4"><span class="px-2 py-0.5 rounded-full bg-navy-700/50 text-[10px] text-stone-400">'+escapeHtml(cert.display_order||0)+'</span></td>' +
          '<td class="py-3 px-4 text-right whitespace-nowrap">'+
            (cert.file_url?'<a href="'+safeAttr(cert.file_url)+'" target="_blank" rel="noopener" class="text-blue-400 hover:text-blue-300 transition-colors p-1 inline-block" title="Lihat Sertifikat"><iconify-icon icon="lucide:eye" width="16"></iconify-icon></a>':'')+
            '<button onclick="openCertificationModal('+cert.id+')" class="text-gold-400 hover:text-gold-300 transition-colors p-1 ml-1" title="Edit"><iconify-icon icon="lucide:pencil" width="16"></iconify-icon></button><button onclick="deleteCertification('+cert.id+')" class="text-red-400 hover:text-red-300 transition-colors p-1 ml-1" title="Hapus"><iconify-icon icon="lucide:trash-2" width="16"></iconify-icon></button></td>' +
        '</tr>';
      }).join('') || '<tr><td colspan="6" class="py-10 text-center text-stone-600">Belum ada data sertifikasi.</td></tr>'}</tbody>
    </table>
  </div>`;
}

function openCertificationModal(id){
  var cert=id?DB.certifications.find(function(x){return x.id===id}):null;
  var isEdit=!!cert;
  var currentFile='';

  if(isEdit && cert.file_url){
    if(certificationIsPdf(cert)){
      currentFile=
        '<div class="mb-4 p-4 rounded-xl bg-navy-900/50 border border-navy-700/60">'+
          '<div class="flex items-center gap-3">'+
            '<div class="w-12 h-12 rounded-xl bg-red-500/10 text-red-400 flex items-center justify-center flex-shrink-0"><iconify-icon icon="lucide:file-text" width="22"></iconify-icon></div>'+
            '<div class="flex-1 min-w-0"><div class="text-xs text-stone-500 uppercase tracking-wider">File saat ini</div><div class="text-sm text-white truncate mt-1">'+escapeHtml(cert.file_name||'Sertifikat PDF')+'</div></div>'+
            '<a href="'+safeAttr(cert.file_url)+'" target="_blank" rel="noopener" class="text-blue-400 hover:text-blue-300 text-xs flex items-center gap-1"><iconify-icon icon="lucide:external-link" width="14"></iconify-icon> Buka</a>'+
          '</div>'+
        '</div>';
    }else{
      currentFile=
        '<div class="mb-4 rounded-xl overflow-hidden bg-navy-900/50 border border-navy-700/60">'+
          '<img src="'+safeAttr(cert.file_url)+'" alt="'+safeAttr(cert.name)+'" class="w-full h-44 object-contain bg-white/5">'+
          '<div class="p-3 flex items-center justify-between gap-3"><div class="text-xs text-stone-500 truncate">'+escapeHtml(cert.file_name||'Gambar sertifikat')+'</div><a href="'+safeAttr(cert.file_url)+'" target="_blank" rel="noopener" class="text-blue-400 hover:text-blue-300 text-xs flex items-center gap-1"><iconify-icon icon="lucide:external-link" width="14"></iconify-icon> Buka</a></div>'+
        '</div>';
    }
  }

  var removeFile=(isEdit && cert.file_url)
    ? '<label class="mt-3 flex items-center gap-2 text-xs text-red-300 cursor-pointer"><input type="checkbox" name="remove_file" value="1" class="rounded border-navy-600 bg-navy-900"> Hapus file sertifikat saat menyimpan</label>'
    : '';

  var h='<div class="p-6"><div class="flex items-center justify-between mb-6"><h3 class="font-serif text-xl text-white">'+(isEdit?'Edit':'Tambah')+' Sertifikasi</h3><button onclick="closeModal()" class="text-stone-500 hover:text-white transition-colors p-1"><iconify-icon icon="lucide:x" width="18"></iconify-icon></button></div><form onsubmit="saveCertification(event,'+(id||0)+')" class="space-y-4" enctype="multipart/form-data">' +
    currentFile +
    '<div><label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Nama Sertifikasi *</label><input name="name" value="'+safeAttr(isEdit?cert.name:'')+'" required placeholder="Contoh: ISO 9001:2015" class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm placeholder:text-stone-600"></div>' +
    '<div><label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Penerbit</label><input name="issuer" value="'+safeAttr(isEdit?cert.issuer||'':'')+'" placeholder="Nama lembaga penerbit (opsional)" class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm placeholder:text-stone-600"></div>' +
    '<div><label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Nomor Sertifikat</label><input name="certificate_number" value="'+safeAttr(isEdit?cert.certificate_number||'':'')+'" placeholder="Nomor sertifikat (opsional)" class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm placeholder:text-stone-600"></div>' +
    '<div class="grid sm:grid-cols-2 gap-4"><div><label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Tahun Terbit</label><input name="issued_year" type="number" min="1900" max="2100" value="'+safeAttr(isEdit?(cert.issued_year||''):'')+'" placeholder="2026" class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm placeholder:text-stone-600"></div><div><label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Urutan Tampil</label><input name="display_order" type="number" min="0" max="9999" value="'+safeAttr(isEdit?(cert.display_order||0):(DB.certifications.length+1))+'" class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm"></div></div>' +
    '<div><label class="text-xs font-medium text-stone-400 tracking-wider uppercase">File Sertifikat</label><input name="certificate_file" type="file" accept=".jpg,.jpeg,.png,.webp,.pdf,image/jpeg,image/png,image/webp,application/pdf" class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-stone-300 text-sm file:mr-4 file:rounded-lg file:border-0 file:bg-gold-500 file:px-3 file:py-2 file:text-xs file:font-semibold file:text-white hover:file:bg-gold-400"><p class="text-[10px] text-stone-600 mt-1">JPG, JPEG, PNG, WebP, atau PDF. Maksimal 10 MB.'+(isEdit&&cert.file_url?' Kosongkan jika file lama tidak ingin diganti.':'')+'</p>'+removeFile+'</div>' +
    '<div><label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Deskripsi</label><textarea name="description" rows="4" placeholder="Deskripsi singkat sertifikasi..." class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm placeholder:text-stone-600 resize-none">'+escapeHtml(isEdit?cert.description||'':'')+'</textarea></div>' +
    '<button type="submit" class="w-full py-3 bg-gold-500 text-white text-xs font-semibold tracking-wider uppercase rounded-xl hover:bg-gold-400 transition-all hover:-translate-y-0.5">'+(isEdit?'Simpan Perubahan':'Tambah Sertifikasi')+'</button></form></div>';
  showModal(h);
}

async function saveCertification(e,id){
  e.preventDefault();
  var f=e.target;
  var formData=new FormData(f);

  if(id){
    formData.append('_method','PUT');
  }

  try{
    await apiRequest(
      id?'/admin/certifications/'+id:'/admin/certifications',
      {method:'POST',body:formData}
    );
    await loadAdminData();
    toast(id?'✅ Sertifikasi berhasil diperbarui':'✅ Sertifikasi berhasil ditambahkan');
    closeModal();
    goPage('certifications');
  }catch(err){
    toast('❌ '+err.message);
  }
}

async function deleteCertification(id){
  if(!confirm('Hapus sertifikasi ini beserta file sertifikatnya?'))return;
  try{
    await apiRequest('/admin/certifications/'+id,{method:'DELETE'});
    await loadAdminData();
    toast('🗑️ Sertifikasi dihapus');
    goPage('certifications');
  }catch(err){toast('❌ '+err.message);}
}

var appointmentCalendarMonth = null;
var appointmentSelectedDate = null;

function appointmentIsoDate(y,m,d){
  return String(y)+'-'+String(m+1).padStart(2,'0')+'-'+String(d).padStart(2,'0');
}

function appointmentDateLabel(iso){
  if(!iso)return 'Semua jadwal';
  var p=iso.split('-').map(Number);
  var d=new Date(p[0],p[1]-1,p[2]);
  return d.toLocaleDateString('id-ID',{weekday:'long',day:'numeric',month:'long',year:'numeric'});
}

function appointmentStatusMeta(status){
  if(status==='confirmed')return {label:'Dikonfirmasi / ACC',badge:'active',dot:'confirmed'};
  if(status==='done')return {label:'Selesai',badge:'done',dot:'done'};
  if(status==='cancelled')return {label:'Dibatalkan',badge:'cancelled',dot:'cancelled'};
  return {label:'Menunggu Validasi',badge:'pending',dot:'pending'};
}

function appointmentCalendarMove(step){
  if(!appointmentCalendarMonth)appointmentCalendarMonth=new Date();
  appointmentCalendarMonth=new Date(appointmentCalendarMonth.getFullYear(),appointmentCalendarMonth.getMonth()+step,1);
  renderAppointmentCalendar();
}

function appointmentCalendarToday(){
  var now=new Date();
  appointmentCalendarMonth=new Date(now.getFullYear(),now.getMonth(),1);
  appointmentSelectedDate=appointmentIsoDate(now.getFullYear(),now.getMonth(),now.getDate());
  renderAppointmentCalendar();
  renderAppointmentTable();
  renderAppointmentDaySummary();
}

function selectAppointmentDate(iso){
  appointmentSelectedDate = appointmentSelectedDate===iso ? null : iso;
  renderAppointmentCalendar();
  renderAppointmentTable();
  renderAppointmentDaySummary();
}

function clearAppointmentDateFilter(){
  appointmentSelectedDate=null;
  renderAppointmentCalendar();
  renderAppointmentTable();
  renderAppointmentDaySummary();
}

function renderAppointmentCalendar(){
  var grid=document.getElementById('appointment-calendar-grid');
  var title=document.getElementById('appointment-calendar-title');
  if(!grid||!title)return;

  if(!appointmentCalendarMonth){
    var now=new Date();
    appointmentCalendarMonth=new Date(now.getFullYear(),now.getMonth(),1);
  }

  var y=appointmentCalendarMonth.getFullYear();
  var m=appointmentCalendarMonth.getMonth();
  var first=new Date(y,m,1);
  var days=new Date(y,m+1,0).getDate();
  var offset=(first.getDay()+6)%7;
  var today=new Date();
  var todayIso=appointmentIsoDate(today.getFullYear(),today.getMonth(),today.getDate());

  title.textContent=first.toLocaleDateString('id-ID',{month:'long',year:'numeric'});

  var byDate={};
  DB.appointments.forEach(function(a){
    if(!byDate[a.date])byDate[a.date]=[];
    byDate[a.date].push(a);
  });

  var html='';
  for(var i=0;i<offset;i++)html+='<div class="appointment-cal-day empty" aria-hidden="true"></div>';

  for(var day=1;day<=days;day++){
    var iso=appointmentIsoDate(y,m,day);
    var list=byDate[iso]||[];
    var classes='appointment-cal-day';
    if(list.length)classes+=' has-events';
    if(iso===todayIso)classes+=' today';
    if(iso===appointmentSelectedDate)classes+=' selected';

    var statuses=[];
    list.forEach(function(a){
      var dot=appointmentStatusMeta(a.status).dot;
      if(statuses.indexOf(dot)<0)statuses.push(dot);
    });

    html+='<button type="button" class="'+classes+'" onclick="selectAppointmentDate(\''+iso+'\')" title="'+(list.length?list.length+' jadwal':'Tidak ada jadwal')+'">'+
      '<span class="appointment-day-number">'+day+'</span>'+
      (list.length?'<span class="appointment-day-count">'+list.length+'</span>':'')+
      (statuses.length?'<span class="appointment-status-dots">'+statuses.map(function(s){return '<i class="appointment-status-dot '+s+'"></i>';}).join('')+'</span>':'')+
    '</button>';
  }
  grid.innerHTML=html;

  var filter=document.getElementById('appointment-filter-label');
  if(filter)filter.textContent=appointmentSelectedDate ? 'Menampilkan: '+appointmentDateLabel(appointmentSelectedDate) : 'Menampilkan semua jadwal';
  var clear=document.getElementById('appointment-clear-filter');
  if(clear)clear.classList.toggle('hidden',!appointmentSelectedDate);
}

function renderAppointmentDaySummary(){
  var box=document.getElementById('appointment-day-summary');
  var title=document.getElementById('appointment-day-title');
  if(!box||!title)return;

  if(!appointmentSelectedDate){
    title.textContent='Jadwal Harian';
    box.innerHTML='<div class="h-full min-h-[220px] flex flex-col items-center justify-center text-center px-6"><div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center mb-3"><iconify-icon icon="lucide:calendar-search" width="21"></iconify-icon></div><p class="text-sm font-semibold text-slate-700">Pilih tanggal pada kalender</p><p class="text-xs text-slate-500 mt-1 max-w-xs">Klik tanggal untuk melihat seluruh jadwal pertemuan pada hari tersebut dan memfilter tabel di bawah.</p></div>';
    return;
  }

  title.textContent=appointmentDateLabel(appointmentSelectedDate);
  var list=DB.appointments.filter(function(a){return a.date===appointmentSelectedDate}).sort(function(a,b){return a.time.localeCompare(b.time)});
  if(!list.length){
    box.innerHTML='<div class="h-full min-h-[220px] flex flex-col items-center justify-center text-center px-6"><div class="w-12 h-12 rounded-2xl bg-slate-100 text-slate-500 flex items-center justify-center mb-3"><iconify-icon icon="lucide:calendar-x" width="21"></iconify-icon></div><p class="text-sm font-semibold text-slate-700">Tidak ada jadwal</p><p class="text-xs text-slate-500 mt-1">Belum ada permintaan pertemuan pada tanggal ini.</p></div>';
    return;
  }

  box.innerHTML='<div class="appointment-day-list space-y-2">'+list.map(function(a){
    var meta=appointmentStatusMeta(a.status);
    return '<div class="appointment-day-item"><div class="flex items-start justify-between gap-3"><div class="min-w-0"><div class="flex items-center gap-2"><span class="text-sm font-bold text-slate-800">'+escapeHtml(a.time)+' WIB</span><span class="badge badge-'+meta.badge+'">'+meta.label+'</span></div><div class="text-sm font-semibold text-slate-700 mt-2 truncate">'+escapeHtml(a.name)+'</div><div class="text-[11px] text-slate-500 mt-0.5 truncate">'+escapeHtml(a.type)+'</div></div><iconify-icon icon="lucide:user-round" width="17" class="text-slate-400 flex-shrink-0 mt-1"></iconify-icon></div></div>';
  }).join('')+'</div>';
}

function appointmentActions(a){
  var actions='';
  if(a.status==='pending'){
    actions='<button onclick="openAppointmentDecision('+a.id+',\'confirmed\')" class="px-2.5 py-1.5 rounded-lg bg-emerald-500/10 text-emerald-500 hover:bg-emerald-500/20 transition-colors text-[11px] font-semibold" title="ACC dan kirim email">ACC</button>'+
            '<button onclick="openAppointmentDecision('+a.id+',\'cancelled\')" class="px-2.5 py-1.5 rounded-lg bg-red-500/10 text-red-500 hover:bg-red-500/20 transition-colors text-[11px] font-semibold ml-1" title="Batalkan dan kirim email">Batalkan</button>';
  }else if(a.status==='confirmed'){
    actions='<button onclick="updApp('+a.id+',\'done\')" class="text-blue-500 hover:text-blue-600 transition-colors p-1" title="Tandai selesai"><iconify-icon icon="lucide:check-circle-2" width="17"></iconify-icon></button>'+
            '<button onclick="resendAppointmentEmail('+a.id+')" class="text-emerald-500 hover:text-emerald-600 transition-colors p-1 ml-1" title="Kirim ulang email"><iconify-icon icon="lucide:send" width="17"></iconify-icon></button>';
  }else if(a.status==='cancelled'){
    actions='<button onclick="resendAppointmentEmail('+a.id+')" class="text-emerald-500 hover:text-emerald-600 transition-colors p-1" title="Kirim ulang email"><iconify-icon icon="lucide:send" width="17"></iconify-icon></button>';
  }else{
    actions='<span class="text-stone-500 text-xs">-</span>';
  }
  return actions;
}

function renderAppointmentTable(){
  var tbody=document.getElementById('appointment-tbody');
  if(!tbody)return;
  var list=DB.appointments.filter(function(a){return !appointmentSelectedDate || a.date===appointmentSelectedDate});

  tbody.innerHTML=list.map(function(a){
    var meta=appointmentStatusMeta(a.status);
    var mailInfo='<span class="text-[11px] text-stone-500">Belum ada keputusan</span>';
    if(a.status==='confirmed'||a.status==='cancelled'){
      mailInfo=a.email_notified
        ? '<div class="flex items-center gap-1 text-emerald-500 text-[11px] font-medium"><iconify-icon icon="lucide:mail-check" width="13"></iconify-icon>Email terkirim</div><div class="text-[10px] text-stone-500 mt-1">'+escapeHtml(a.notification_sent_at||'')+'</div>'
        : '<div class="flex items-center gap-1 text-amber-500 text-[11px] font-medium"><iconify-icon icon="lucide:mail-warning" width="13"></iconify-icon>Belum terkirim</div>';
    }

    return '<tr class="table-row border-b border-navy-700/20 align-top">'+
      '<td class="py-3 px-4"><div class="text-white font-medium">'+escapeHtml(a.name)+'</div><div class="text-[11px] text-stone-500 mt-1">'+escapeHtml(a.email)+'</div><div class="text-[10px] text-stone-500">'+escapeHtml(a.phone)+'</div></td>'+
      '<td class="py-3 px-4 text-stone-400"><div>'+escapeHtml(a.type)+'</div>'+(a.notes?'<div class="text-[10px] text-stone-500 mt-1 max-w-[220px] line-clamp-2">Agenda: '+escapeHtml(a.notes)+'</div>':'')+'</td>'+
      '<td class="py-3 px-4 text-stone-400"><div>'+escapeHtml(a.date)+'</div><div class="text-[11px] mt-1">'+escapeHtml(a.time)+' WIB</div></td>'+
      '<td class="py-3 px-4"><span class="badge badge-'+meta.badge+'">'+meta.label+'</span>'+(a.admin_note?'<div class="text-[10px] text-stone-500 mt-2 max-w-[220px] line-clamp-2">Catatan admin: '+escapeHtml(a.admin_note)+'</div>':'')+'</td>'+
      '<td class="py-3 px-4">'+mailInfo+'</td>'+
      '<td class="py-3 px-4 text-right whitespace-nowrap">'+appointmentActions(a)+'</td>'+
    '</tr>';
  }).join('') || '<tr><td colspan="6" class="py-12 text-center text-stone-500">'+(appointmentSelectedDate?'Tidak ada jadwal pada tanggal yang dipilih.':'Belum ada jadwal pertemuan.')+'</td></tr>';
}

function pgAppointments(c){
  var counts={confirmed:0,pending:0,done:0,cancelled:0};
  DB.appointments.forEach(function(a){if(counts[a.status]!==undefined)counts[a.status]++});

  c.innerHTML=`
    <div class="grid sm:grid-cols-2 lg:grid-cols-5 gap-4 mb-6 reveal">
      <div class="stat-card bg-navy-800 rounded-2xl p-5 border border-navy-700/30"><div class="text-2xl font-serif text-gold-400">${DB.appointments.length}</div><div class="text-xs text-stone-500">Total</div></div>
      <div class="stat-card bg-navy-800 rounded-2xl p-5 border border-blue-500/30"><div class="text-2xl font-serif text-blue-400">${counts.pending}</div><div class="text-xs text-stone-500">Menunggu Validasi</div></div>
      <div class="stat-card bg-navy-800 rounded-2xl p-5 border border-emerald-500/30"><div class="text-2xl font-serif text-emerald-400">${counts.confirmed}</div><div class="text-xs text-stone-500">Dikonfirmasi / ACC</div></div>
      <div class="stat-card bg-navy-800 rounded-2xl p-5 border border-red-500/30"><div class="text-2xl font-serif text-red-400">${counts.cancelled}</div><div class="text-xs text-stone-500">Dibatalkan</div></div>
      <div class="stat-card bg-navy-800 rounded-2xl p-5 border border-gold-500/30"><div class="text-2xl font-serif text-gold-400">${counts.done}</div><div class="text-xs text-stone-500">Selesai</div></div>
    </div>

    <div class="bg-navy-800 rounded-2xl border border-navy-700/30 p-5 mb-6 reveal">
      <div class="flex items-start gap-3"><div class="w-10 h-10 rounded-xl bg-blue-500/15 text-blue-500 flex items-center justify-center flex-shrink-0"><iconify-icon icon="lucide:mail-check" width="18"></iconify-icon></div><div><h3 class="text-sm font-semibold text-white">Validasi Jadwal & Notifikasi Email</h3><p class="text-xs text-stone-500 mt-1 leading-relaxed">Jadwal dari user masuk dengan status <b>Menunggu Validasi</b>. Saat admin memilih <b>ACC</b> atau <b>Batalkan</b>, sistem menyimpan keputusan dan mengirim informasi hasil validasi ke email user.</p></div></div>
    </div>

    <div class="grid lg:grid-cols-5 gap-6 mb-6 reveal" style="transition-delay:.06s">
      <div class="appointment-calendar-card lg:col-span-3 p-5 md:p-6">
        <div class="flex flex-wrap items-center justify-between gap-3 mb-5">
          <div><div class="text-[10px] font-bold tracking-[.15em] uppercase text-blue-600">Kalender Jadwal</div><h3 id="appointment-calendar-title" class="font-serif text-lg text-slate-800 mt-1"></h3></div>
          <div class="flex items-center gap-2"><button class="appointment-calendar-today" onclick="appointmentCalendarToday()">Hari Ini</button><button class="appointment-calendar-nav" onclick="appointmentCalendarMove(-1)" title="Bulan sebelumnya"><iconify-icon icon="lucide:chevron-left" width="17"></iconify-icon></button><button class="appointment-calendar-nav" onclick="appointmentCalendarMove(1)" title="Bulan berikutnya"><iconify-icon icon="lucide:chevron-right" width="17"></iconify-icon></button></div>
        </div>
        <div class="appointment-calendar-grid mb-1"><div class="appointment-cal-head">Sen</div><div class="appointment-cal-head">Sel</div><div class="appointment-cal-head">Rab</div><div class="appointment-cal-head">Kam</div><div class="appointment-cal-head">Jum</div><div class="appointment-cal-head">Sab</div><div class="appointment-cal-head">Min</div></div>
        <div id="appointment-calendar-grid" class="appointment-calendar-grid"></div>
        <div class="flex flex-wrap items-center justify-between gap-3 mt-5 pt-4 border-t border-slate-100">
          <div class="appointment-calendar-legend"><span><i class="appointment-status-dot pending"></i>Menunggu</span><span><i class="appointment-status-dot confirmed"></i>ACC</span><span><i class="appointment-status-dot cancelled"></i>Dibatalkan</span><span><i class="appointment-status-dot done"></i>Selesai</span></div>
          <button id="appointment-clear-filter" class="hidden text-[11px] font-semibold text-blue-600 hover:text-blue-700" onclick="clearAppointmentDateFilter()">Tampilkan Semua</button>
        </div>
      </div>

      <div class="appointment-calendar-card lg:col-span-2 p-5 md:p-6">
        <div class="flex items-center gap-2 mb-4"><div class="w-9 h-9 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center"><iconify-icon icon="lucide:calendar-days" width="17"></iconify-icon></div><div><div class="text-[10px] font-bold tracking-[.12em] uppercase text-slate-400">Detail Hari</div><h3 id="appointment-day-title" class="text-sm font-semibold text-slate-800">Jadwal Harian</h3></div></div>
        <div id="appointment-day-summary"></div>
      </div>
    </div>

    <div class="flex flex-wrap items-center justify-between gap-3 mb-3 reveal" style="transition-delay:.08s"><div><h3 class="text-sm font-semibold text-white">Daftar Jadwal Pertemuan</h3><p id="appointment-filter-label" class="text-xs text-stone-500 mt-0.5">Menampilkan semua jadwal</p></div></div>

    <div class="overflow-x-auto reveal" style="transition-delay:.1s">
      <table class="w-full text-sm"><thead><tr class="border-b border-navy-700/50"><th class="text-left py-3 px-4 text-xs font-semibold tracking-wider uppercase text-stone-500">User</th><th class="text-left py-3 px-4 text-xs font-semibold tracking-wider uppercase text-stone-500">Jenis</th><th class="text-left py-3 px-4 text-xs font-semibold tracking-wider uppercase text-stone-500">Jadwal</th><th class="text-left py-3 px-4 text-xs font-semibold tracking-wider uppercase text-stone-500">Status</th><th class="text-left py-3 px-4 text-xs font-semibold tracking-wider uppercase text-stone-500">Email</th><th class="text-right py-3 px-4 text-xs font-semibold tracking-wider uppercase text-stone-500">Aksi</th></tr></thead><tbody id="appointment-tbody"></tbody></table>
    </div>`;

  renderAppointmentCalendar();
  renderAppointmentDaySummary();
  renderAppointmentTable();
}

function openAppointmentDecision(id, status){
  var a = DB.appointments.find(function(x){return x.id===id});
  if(!a)return;

  var isConfirm = status === 'confirmed';
  var title = isConfirm ? 'ACC Jadwal Pertemuan' : 'Batalkan Jadwal Pertemuan';
  var buttonText = isConfirm ? 'ACC & Kirim Email' : 'Batalkan & Kirim Email';
  var buttonClass = isConfirm ? 'bg-emerald-600 hover:bg-emerald-500' : 'bg-red-600 hover:bg-red-500';
  var noteLabel = isConfirm ? 'Catatan untuk user (opsional)' : 'Alasan pembatalan *';
  var notePlaceholder = isConfirm ? 'Contoh: Mohon hadir 10 menit sebelum jadwal...' : 'Tuliskan alasan pembatalan yang akan diterima user melalui email...';

  var h = '<div class="p-6">' +
    '<div class="flex items-center justify-between mb-6"><div><h3 class="font-serif text-xl text-white">'+title+'</h3><p class="text-xs text-stone-500 mt-1">Keputusan ini akan dikirim ke '+escapeHtml(a.email)+'</p></div><button onclick="closeModal()" class="text-stone-500 hover:text-stone-700 transition-colors p-1"><iconify-icon icon="lucide:x" width="18"></iconify-icon></button></div>' +
    '<div class="grid sm:grid-cols-2 gap-3 mb-5">' +
      '<div class="rounded-xl bg-navy-900/40 border border-navy-700/30 p-4"><div class="text-[10px] uppercase tracking-wider text-stone-500">Nama</div><div class="text-sm text-white font-medium mt-1">'+escapeHtml(a.name)+'</div></div>' +
      '<div class="rounded-xl bg-navy-900/40 border border-navy-700/30 p-4"><div class="text-[10px] uppercase tracking-wider text-stone-500">Jenis</div><div class="text-sm text-white font-medium mt-1">'+escapeHtml(a.type)+'</div></div>' +
      '<div class="rounded-xl bg-navy-900/40 border border-navy-700/30 p-4"><div class="text-[10px] uppercase tracking-wider text-stone-500">Tanggal</div><div class="text-sm text-white font-medium mt-1">'+escapeHtml(a.date)+'</div></div>' +
      '<div class="rounded-xl bg-navy-900/40 border border-navy-700/30 p-4"><div class="text-[10px] uppercase tracking-wider text-stone-500">Waktu</div><div class="text-sm text-white font-medium mt-1">'+escapeHtml(a.time)+' WIB</div></div>' +
    '</div>' +
    '<form onsubmit="saveAppointmentDecision(event,'+id+',\''+status+'\')" class="space-y-4">' +
      '<div><label class="text-xs font-medium text-stone-500 tracking-wider uppercase">'+noteLabel+'</label><textarea name="admin_note" rows="4" '+(!isConfirm?'required':'')+' placeholder="'+notePlaceholder+'" class="w-full mt-2 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm placeholder:text-stone-500 resize-none">'+escapeHtml(a.admin_note || '')+'</textarea></div>' +
      '<div class="p-3 rounded-xl bg-blue-500/10 border border-blue-500/20 text-xs text-stone-500 leading-relaxed"><iconify-icon icon="lucide:info" width="14" class="mr-1"></iconify-icon>Setelah disimpan, sistem akan langsung mencoba mengirim email hasil validasi kepada user.</div>' +
      '<div class="flex justify-end gap-2"><button type="button" onclick="closeModal()" class="px-5 py-2.5 rounded-xl border border-navy-700 text-stone-500 text-xs font-semibold hover:bg-navy-700/20 transition-colors">Batal</button><button type="submit" class="px-5 py-2.5 '+buttonClass+' text-white text-xs font-semibold rounded-xl transition-all flex items-center gap-2"><iconify-icon icon="lucide:send" width="14"></iconify-icon>'+buttonText+'</button></div>' +
    '</form>' +
  '</div>';

  showModal(h);
}

async function saveAppointmentDecision(e, id, status){
  e.preventDefault();
  var form = e.target;
  var adminNote = form.admin_note.value.trim();

  try{
    var result = await apiRequest('/admin/appointments/'+id+'/status',{
      method:'PATCH',
      body:JSON.stringify({status:status,admin_note:adminNote})
    });
    await loadAdminData();
    closeModal();

    if(result.mail_sent === true){
      toast('✅ '+result.message);
    }else if(result.mail_sent === false){
      toast('⚠️ '+result.message);
    }else{
      toast('✅ '+result.message);
    }

    goPage('appointments');
  }catch(err){
    toast('❌ '+err.message);
  }
}

async function resendAppointmentEmail(id){
  if(!confirm('Kirim ulang email informasi jadwal ke user?'))return;
  try{
    var result = await apiRequest('/admin/appointments/'+id+'/notify',{method:'POST'});
    await loadAdminData();
    toast(result.mail_sent ? '✅ '+result.message : '⚠️ '+result.message);
    goPage('appointments');
  }catch(err){toast('❌ '+err.message);}
}

async function updApp(id, status){
  try{
    var result = await apiRequest('/admin/appointments/'+id+'/status',{method:'PATCH',body:JSON.stringify({status:status})});
    await loadAdminData();
    toast('✅ '+result.message);
    goPage('appointments');
  }catch(err){toast('❌ '+err.message);}
}

function pgMessages(c){
  c.innerHTML = '<div class="space-y-3">' + DB.messages.map(function(m, i) {
    return '<div class="bg-navy-800 rounded-2xl p-6 border border-navy-500/30 reveal ' + (m.read ? 'opacity-60' : '') + '" style="transition-delay:' + (i*0.05) + 's"><div class="flex items-start justify-between gap-4"><div class="w-10 h-10 rounded-full ' + (m.read ? 'bg-stone-700/50' : 'bg-gold-500/20') + ' flex items-center justify-center flex-shrink-0 ' + (m.read ? 'text-stone-500' : 'text-gold-400') + '"><iconify-icon icon="lucide:mail" width="16"></iconify-icon></div><div class="flex-1 min-w-0"><div class="flex items-center justify-between gap-2"><div><span class="text-white font-medium text-sm">' + m.name + '</span><span class="text-[10px] text-stone-500">' + m.email + '</span></div><span class="text-[10px] text-stone-600 whitespace-nowrap">' + m.date + '</span></div>' +
      '<div class="text-sm text-stone-400 mt-1">' + m.subject + '</div>' +
      '<p class="text-stone-500 text-xs mt-2 leading-relaxed">' + m.msg + '</p>' +
      (m.read ? '<span class="text-[10px] text-stone-600 mt-3 inline-block">Sudah dibaca</span>' : '<button onclick="markRead(' + m.id + ')" class="mt-3 text-gold-500 text-xs font-medium hover:text-gold-400 transition-colors flex items-center gap-1">Tandai dibaca <iconify-icon icon="lucide:check" width="12"></iconify-icon></button>') +
    '</div></div></div>';
  }).join('') + (DB.messages.length === 0 ? '<div class="text-center py-16 text-stone-600 reveal">Tidak ada pesan.</div>' : '') + '</div>';
}

async function markRead(id){
  try{
    await apiRequest('/admin/messages/'+id+'/read',{method:'PATCH'});
    await loadAdminData();
    var b=document.getElementById('msg-badge');
    var uc=DB.messages.filter(function(x){return !x.read}).length;
    if(uc>0){b.textContent=uc;b.classList.remove('hidden');}else{b.classList.add('hidden');}
    toast('✅ Ditandai dibaca');
    goPage('messages');
  }catch(err){toast('❌ '+err.message);}
}

function pgTeam(c){
  c.innerHTML = `
  <div class="bg-gradient-to-r from-navy-800 to-navy-700 rounded-2xl p-6 border border-navy-600/40 mb-6 reveal">
    <div class="flex items-center gap-2 text-gold-400 text-xs font-semibold tracking-[.18em] uppercase"><iconify-icon icon="lucide:users-round" width="15"></iconify-icon> Manajemen Tim</div>
    <h3 class="font-serif text-2xl text-white mt-2">Kelola tim perusahaan</h3>
    <p class="text-sm text-stone-400 mt-2 max-w-3xl">Tambah, edit, hapus, atur urutan tampil, status publik, dan foto anggota tim. Data aktif otomatis tampil pada section Tim Kami di landing page.</p>
  </div>

  <div class="flex flex-wrap gap-2 mb-6 reveal">
    <div class="flex-1 min-w-[240px] flex items-center gap-2">
      <iconify-icon icon="lucide:search" width="16" class="text-stone-500"></iconify-icon>
      <input type="text" id="team-search" placeholder="Cari nama, jabatan, email..." oninput="filterTeamTable()" class="flex-1 bg-navy-800 border border-navy-700/50 rounded-xl px-4 py-2.5 text-sm text-white placeholder:text-stone-600">
    </div>
    <button onclick="openTeamModal()" class="px-5 py-2.5 bg-gold-500 text-white text-xs font-semibold tracking-wider uppercase rounded-xl hover:bg-gold-400 transition-all hover:-translate-y-0.5 flex items-center gap-2 whitespace-nowrap">
      <iconify-icon icon="lucide:user-plus" width="14"></iconify-icon> Tambah Anggota
    </button>
  </div>

  <div class="overflow-x-auto reveal" style="transition-delay:.1s">
    <table class="w-full text-sm">
      <thead>
        <tr class="border-b border-navy-700/50">
          <th class="text-left py-3 px-4 text-xs font-semibold tracking-wider uppercase text-stone-500">Anggota</th>
          <th class="text-left py-3 px-4 text-xs font-semibold tracking-wider uppercase text-stone-500">Kontak</th>
          <th class="text-left py-3 px-4 text-xs font-semibold tracking-wider uppercase text-stone-500">Urutan</th>
          <th class="text-left py-3 px-4 text-xs font-semibold tracking-wider uppercase text-stone-500">Status</th>
          <th class="text-right py-3 px-4 text-xs font-semibold tracking-wider uppercase text-stone-500">Aksi</th>
        </tr>
      </thead>
      <tbody id="team-tbody"></tbody>
    </table>
  </div>`;
  filterTeamTable();
}

function filterTeamTable(){
  var q=((document.getElementById('team-search')||{}).value||'').toLowerCase();
  var rows='';
  DB.team.forEach(function(t){
    var hay=((t.name||'')+' '+(t.role||'')+' '+(t.email||'')+' '+(t.phone||'')).toLowerCase();
    if(q && hay.indexOf(q)<0)return;
    var image=t.img
      ? '<img src="'+safeAttr(t.img)+'" alt="'+safeAttr(t.name)+'" class="w-14 h-14 rounded-xl object-cover flex-shrink-0">'
      : '<div class="w-14 h-14 rounded-xl bg-navy-700/40 flex items-center justify-center text-stone-400 flex-shrink-0"><iconify-icon icon="lucide:user" width="22"></iconify-icon></div>';
    rows += '<tr class="table-row border-b border-navy-700/20">'+
      '<td class="py-3 px-4"><div class="flex items-center gap-3">'+image+'<div class="min-w-0"><div class="text-white font-medium">'+escapeHtml(t.name||'-')+'</div><div class="text-xs text-gold-400 mt-0.5">'+escapeHtml(t.role||'-')+'</div><div class="text-[11px] text-stone-500 line-clamp-2 max-w-[360px] mt-1">'+escapeHtml(t.bio||'Belum ada deskripsi profil.')+'</div></div></div></td>'+
      '<td class="py-3 px-4 text-stone-400"><div>'+escapeHtml(t.email||'-')+'</div><div class="text-xs mt-1">'+escapeHtml(t.phone||'-')+'</div></td>'+
      '<td class="py-3 px-4 text-stone-400">'+escapeHtml(String(t.display_order??0))+'</td>'+
      '<td class="py-3 px-4">'+(t.is_active?'<span class="badge badge-done">Tampil</span>':'<span class="badge badge-pending">Disembunyikan</span>')+'</td>'+
      '<td class="py-3 px-4 text-right whitespace-nowrap"><button onclick="openTeamModal('+t.id+')" class="text-gold-400 hover:text-gold-300 transition-colors p-1" title="Edit"><iconify-icon icon="lucide:pencil" width="16"></iconify-icon></button><button onclick="deleteTeamMember('+t.id+')" class="text-red-400 hover:text-red-300 transition-colors p-1 ml-1" title="Hapus"><iconify-icon icon="lucide:trash-2" width="16"></iconify-icon></button></td>'+
    '</tr>';
  });
  document.getElementById('team-tbody').innerHTML=rows||'<tr><td colspan="5" class="py-10 text-center text-stone-600">Tidak ada data tim.</td></tr>';
}

function openTeamModal(id){
  var t=id?DB.team.find(function(x){return x.id===id}):null;
  var edit=!!t;
  var preview=t&&t.img
    ? '<img id="team-image-preview" src="'+safeAttr(t.img)+'" alt="Preview" class="w-full h-48 rounded-xl object-cover">'
    : '<div id="team-image-preview-placeholder" class="h-40 rounded-xl bg-navy-900/40 border border-navy-700/40 flex flex-col items-center justify-center text-stone-500"><iconify-icon icon="lucide:image" width="28"></iconify-icon><span class="text-xs mt-2">Belum ada foto</span></div>';
  var h='<div class="p-6"><div class="flex items-center justify-between mb-6"><div><h3 class="font-serif text-xl text-white">'+(edit?'Edit':'Tambah')+' Anggota Tim</h3><p class="text-xs text-stone-500 mt-1">Data aktif akan tampil pada landing page.</p></div><button onclick="closeModal()" class="text-stone-500 hover:text-white transition-colors p-1"><iconify-icon icon="lucide:x" width="18"></iconify-icon></button></div>'+
    '<form onsubmit="saveTeamMember(event,'+(id||0)+')" class="space-y-4">'+
      '<div>'+preview+'</div>'+
      '<div><label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Foto Anggota</label><input type="file" name="member_image" accept=".jpg,.jpeg,.png,.webp" onchange="previewTeamImage(this)" class="w-full mt-2 text-xs text-stone-400 file:mr-3 file:px-3 file:py-2 file:rounded-lg file:border-0 file:bg-gold-500 file:text-white file:font-semibold"><p class="text-[10px] text-stone-600 mt-1">JPG, PNG, WebP. Maks. 5 MB.</p>'+(edit&&t.img?'<label class="mt-2 flex items-center gap-2 text-xs text-red-300"><input type="checkbox" name="remove_image" value="1"> Hapus foto saat disimpan</label>':'')+'</div>'+
      '<div><label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Nama Lengkap *</label><input name="name" required value="'+safeAttr(edit?t.name:'')+'" placeholder="Contoh: Ir. Budi Santoso, M.T." class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm placeholder:text-stone-600"></div>'+
      '<div><label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Jabatan *</label><input name="role" required value="'+safeAttr(edit?t.role:'')+'" placeholder="Contoh: Direktur Utama" class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm placeholder:text-stone-600"></div>'+
      '<div class="grid sm:grid-cols-2 gap-4"><div><label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Email</label><input type="email" name="email" value="'+safeAttr(edit?(t.email||''):'')+'" placeholder="nama@perusahaan.com" class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm placeholder:text-stone-600"></div><div><label class="text-xs font-medium text-stone-400 tracking-wider uppercase">No. Telepon</label><input name="phone" value="'+safeAttr(edit?(t.phone||''):'')+'" placeholder="+62 812..." class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm placeholder:text-stone-600"></div></div>'+
      '<div><label class="text-xs font-medium text-stone-400 tracking-wider uppercase">LinkedIn</label><input type="url" name="linkedin_url" value="'+safeAttr(edit?(t.linkedin_url||''):'')+'" placeholder="https://linkedin.com/in/..." class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm placeholder:text-stone-600"></div>'+
      '<div><label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Deskripsi / Profil Singkat</label><textarea name="bio" rows="4" placeholder="Pengalaman, keahlian, pendidikan, atau profil singkat anggota tim..." class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm placeholder:text-stone-600 resize-none">'+escapeHtml(edit?(t.bio||''):'')+'</textarea></div>'+
      '<div class="grid sm:grid-cols-2 gap-4"><div><label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Urutan Tampil</label><input type="number" name="display_order" min="0" max="9999" value="'+safeAttr(edit?String(t.display_order??0):String(DB.team.length+1))+'" class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm"></div><div class="flex items-end"><label class="w-full flex items-center gap-3 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-sm text-stone-300"><input type="checkbox" name="is_active" value="1" '+(!edit||t.is_active?'checked':'')+'> Tampilkan di website</label></div></div>'+
      '<div class="flex justify-end gap-3 pt-2"><button type="button" onclick="closeModal()" class="px-5 py-2.5 rounded-xl border border-navy-600 text-stone-400 hover:text-white transition-colors text-xs">Batal</button><button type="submit" class="px-5 py-2.5 rounded-xl bg-gold-500 text-white font-semibold text-xs hover:bg-gold-400 transition-colors flex items-center gap-2"><iconify-icon icon="lucide:save" width="14"></iconify-icon> '+(edit?'Simpan Perubahan':'Tambah Anggota')+'</button></div>'+
    '</form></div>';
  showModal(h);
}

function previewTeamImage(input){
  var file=input.files&&input.files[0];
  if(!file)return;
  var url=URL.createObjectURL(file);
  var img=document.getElementById('team-image-preview');
  var ph=document.getElementById('team-image-preview-placeholder');
  if(img){img.src=url;return;}
  if(ph){ph.outerHTML='<img id="team-image-preview" src="'+safeAttr(url)+'" alt="Preview" class="w-full h-48 rounded-xl object-cover">';}
}

async function saveTeamMember(e,id){
  e.preventDefault();
  var f=e.target;
  var fd=new FormData(f);
  fd.set('is_active',f.is_active&&f.is_active.checked?'1':'0');
  if(id)fd.append('_method','PUT');
  try{
    await apiRequest(id?'/admin/team/'+id:'/admin/team',{method:'POST',body:fd});
    await loadAdminData();
    toast(id?'✅ Anggota tim berhasil diperbarui':'✅ Anggota tim berhasil ditambahkan');
    closeModal();
    goPage('team');
  }catch(err){toast('❌ '+err.message);}
}

async function deleteTeamMember(id){
  var t=DB.team.find(function(x){return x.id===id});
  if(!confirm('Hapus anggota tim'+(t?' "'+t.name+'"':'')+'?'))return;
  try{
    await apiRequest('/admin/team/'+id,{method:'DELETE'});
    await loadAdminData();
    toast('🗑️ Anggota tim dihapus');
    goPage('team');
  }catch(err){toast('❌ '+err.message);}
}

function pgSettings(c){
  var s = DB.settings || {};
  var logoPreview = s.logo_url
    ? '<img src="'+safeAttr(s.logo_url)+'" alt="Logo" class="h-20 max-w-full object-contain mx-auto">'
    : '<div class="h-20 flex items-center justify-center text-stone-600 text-xs">Belum ada logo</div>';
  var faviconPreview = s.favicon_url
    ? '<img src="'+safeAttr(s.favicon_url)+'" alt="Favicon" class="w-16 h-16 object-contain mx-auto">'
    : '<div class="h-16 flex items-center justify-center text-stone-600 text-xs">Belum ada favicon</div>';
  var heroPreview = s.hero_image_url
    ? '<img src="'+safeAttr(s.hero_image_url)+'" alt="Hero" class="w-full h-32 object-cover rounded-xl">'
    : '<div class="h-32 flex items-center justify-center text-stone-600 text-xs">Belum ada hero image</div>';

  c.innerHTML = `
  <div class="max-w-6xl mx-auto space-y-6">
    <div class="bg-gradient-to-r from-navy-800 to-navy-700 rounded-2xl p-6 border border-navy-600/40 reveal">
      <div class="flex items-center gap-2 text-gold-400 text-xs font-semibold tracking-[.18em] uppercase"><iconify-icon icon="lucide:sliders-horizontal" width="15"></iconify-icon> Pengaturan Website</div>
      <h3 class="font-serif text-2xl text-white mt-2">Kelola identitas dan tampilan website</h3>
      <p class="text-sm text-stone-400 mt-2 max-w-3xl">Nama perusahaan, logo, kontak, hero, statistik, media sosial, SEO, dan footer dapat diubah dari halaman ini tanpa mengedit source code.</p>
    </div>

    <form id="settings-form" onsubmit="saveSettings(event)" class="space-y-6">
      <div class="bg-navy-800 rounded-2xl p-6 md:p-8 border border-navy-700/30 reveal">
        <h3 class="font-serif text-xl text-white mb-6 flex items-center gap-2"><iconify-icon icon="lucide:building-2" width="20" class="text-gold-400"></iconify-icon> Identitas Perusahaan</h3>
        <div class="grid sm:grid-cols-2 gap-4">
          <div><label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Nama Perusahaan *</label><input name="company" required value="${safeAttr(s.company||'')}" class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm"></div>
          <div><label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Nama Singkat *</label><input name="short_name" required value="${safeAttr(s.short_name||'')}" placeholder="KSN" class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm"></div>
          <div><label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Jenis Usaha *</label><input name="business_type" required value="${safeAttr(s.business_type||'')}" placeholder="Konstruksi" class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm"></div>
          <div><label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Tagline *</label><input name="tagline" required value="${safeAttr(s.tagline||'')}" class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm"></div>
        </div>
      </div>

      <div class="bg-navy-800 rounded-2xl p-6 md:p-8 border border-navy-700/30 reveal">
        <h3 class="font-serif text-xl text-white mb-6 flex items-center gap-2"><iconify-icon icon="lucide:image" width="20" class="text-gold-400"></iconify-icon> Logo & Media Website</h3>
        <div class="grid lg:grid-cols-3 gap-5">
          <div class="rounded-2xl border border-navy-700/40 bg-navy-900/40 p-5">
            <div class="bg-white/5 rounded-xl p-3 mb-4">${logoPreview}</div>
            <label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Logo</label>
            <input type="file" name="logo_file" accept=".jpg,.jpeg,.png,.webp" class="w-full mt-2 text-xs text-stone-400 file:mr-3 file:px-3 file:py-2 file:rounded-lg file:border-0 file:bg-gold-500 file:text-white file:font-semibold">
            <p class="text-[10px] text-stone-600 mt-2">JPG, PNG, WebP. Maks. 5 MB.</p>
            ${s.logo_url?'<label class="mt-3 flex items-center gap-2 text-xs text-red-300"><input type="checkbox" name="remove_logo" value="1"> Hapus logo saat disimpan</label>':''}
          </div>
          <div class="rounded-2xl border border-navy-700/40 bg-navy-900/40 p-5">
            <div class="bg-white/5 rounded-xl p-3 mb-4">${faviconPreview}</div>
            <label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Favicon</label>
            <input type="file" name="favicon_file" accept=".ico,.jpg,.jpeg,.png,.webp" class="w-full mt-2 text-xs text-stone-400 file:mr-3 file:px-3 file:py-2 file:rounded-lg file:border-0 file:bg-gold-500 file:text-white file:font-semibold"><p class="text-[10px] text-stone-500 mt-2">Opsional. Jika tidak diisi, icon tab browser otomatis menggunakan logo website.</p>
            <p class="text-[10px] text-stone-600 mt-2">ICO/PNG/JPG/WebP. Disarankan persegi.</p>
            ${s.favicon_url?'<label class="mt-3 flex items-center gap-2 text-xs text-red-300"><input type="checkbox" name="remove_favicon" value="1"> Hapus favicon saat disimpan</label>':''}
          </div>
          <div class="rounded-2xl border border-navy-700/40 bg-navy-900/40 p-5">
            <div class="mb-4">${heroPreview}</div>
            <label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Background Hero</label>
            <input type="file" name="hero_image_file" accept=".jpg,.jpeg,.png,.webp" class="w-full mt-2 text-xs text-stone-400 file:mr-3 file:px-3 file:py-2 file:rounded-lg file:border-0 file:bg-gold-500 file:text-white file:font-semibold">
            <p class="text-[10px] text-stone-600 mt-2">Disarankan 1920×1080. Maks. 10 MB.</p>
            ${s.hero_image_path?'<label class="mt-3 flex items-center gap-2 text-xs text-red-300"><input type="checkbox" name="remove_hero_image" value="1"> Hapus gambar hero saat disimpan</label>':''}
          </div>
        </div>
      </div>

      <div class="bg-navy-800 rounded-2xl p-6 md:p-8 border border-navy-700/30 reveal">
        <h3 class="font-serif text-xl text-white mb-6 flex items-center gap-2"><iconify-icon icon="lucide:contact" width="20" class="text-gold-400"></iconify-icon> Kontak & Lokasi</h3>
        <div class="grid sm:grid-cols-2 gap-4">
          <div><label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Email Resmi *</label><input type="email" name="email" required value="${safeAttr(s.email||'')}" class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm"></div>
          <div><label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Email Marketing</label><input type="email" name="marketing_email" value="${safeAttr(s.marketing_email||'')}" class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm"></div>
          <div><label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Telepon *</label><input name="phone" required value="${safeAttr(s.phone||'')}" class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm"></div>
          <div><label class="text-xs font-medium text-stone-400 tracking-wider uppercase">WhatsApp *</label><input name="whatsapp" required value="${safeAttr(s.whatsapp||'')}" class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm"></div>
          <div><label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Jam Senin - Jumat *</label><input name="office_hours_weekday" required value="${safeAttr(s.office_hours_weekday||'')}" class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm"></div>
          <div><label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Jam Sabtu</label><input name="office_hours_saturday" value="${safeAttr(s.office_hours_saturday||'')}" class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm"></div>
          <div class="sm:col-span-2"><label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Alamat *</label><textarea name="address" required rows="3" class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm resize-none">${escapeHtml(s.address||'')}</textarea></div>
          <div class="sm:col-span-2"><label class="text-xs font-medium text-stone-400 tracking-wider uppercase">URL Google Maps</label><input type="url" name="map_url" value="${safeAttr(s.map_url||'')}" placeholder="https://maps.google.com/..." class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm"></div>
        </div>
      </div>

      <div class="bg-navy-800 rounded-2xl p-6 md:p-8 border border-navy-700/30 reveal">
        <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-4 mb-6">
          <div>
            <h3 class="font-serif text-xl text-white flex items-center gap-2"><iconify-icon icon="lucide:mail-cog" width="20" class="text-gold-400"></iconify-icon> Email Pengirim & SMTP</h3>
            <p class="text-xs text-stone-500 mt-2 max-w-3xl leading-relaxed">Atur akun email yang digunakan untuk notifikasi jadwal temu. Untuk Gmail gunakan <b>smtp.gmail.com</b>, port <b>587</b>, dan <b>Google App Password</b> — bukan password login Gmail biasa.</p>
          </div>
          <span class="px-3 py-1.5 rounded-full text-[10px] font-semibold ${s.mail_enabled?'bg-emerald-500/10 text-emerald-500':'bg-stone-500/10 text-stone-500'}">${s.mail_enabled?'EMAIL AKTIF':'EMAIL NONAKTIF'}</span>
        </div>

        <div class="grid sm:grid-cols-2 gap-4">
          <div>
            <label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Status Pengiriman</label>
            <select name="mail_enabled" class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm">
              <option value="0" ${!s.mail_enabled?'selected':''}>Nonaktif</option>
              <option value="1" ${s.mail_enabled?'selected':''}>Aktif</option>
            </select>
          </div>
          <div>
            <label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Keamanan SMTP</label>
            <select name="mail_security" class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm">
              <option value="starttls" ${(s.mail_security||'starttls')==='starttls'?'selected':''}>STARTTLS / Port 587 (Gmail disarankan)</option>
              <option value="ssl" ${s.mail_security==='ssl'?'selected':''}>SSL/TLS / Port 465</option>
            </select>
          </div>
          <div><label class="text-xs font-medium text-stone-400 tracking-wider uppercase">SMTP Host</label><input name="mail_smtp_host" value="${safeAttr(s.mail_smtp_host||'smtp.gmail.com')}" placeholder="smtp.gmail.com" class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm"></div>
          <div><label class="text-xs font-medium text-stone-400 tracking-wider uppercase">SMTP Port</label><input type="number" min="1" max="65535" name="mail_smtp_port" value="${safeAttr(s.mail_smtp_port||587)}" class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm"></div>
          <div><label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Username / Akun Gmail</label><input name="mail_smtp_username" value="${safeAttr(s.mail_smtp_username||'')}" placeholder="perusahaan@gmail.com" class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm"></div>
          <div>
            <label class="text-xs font-medium text-stone-400 tracking-wider uppercase">App Password / Password SMTP</label>
            <input type="password" name="mail_smtp_password" value="" autocomplete="new-password" placeholder="${s.mail_smtp_password_set?'Tersimpan — kosongkan untuk mempertahankan':'Masukkan Google App Password'}" class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm">
            <div class="flex items-center justify-between mt-2 gap-3"><span class="text-[10px] ${s.mail_smtp_password_set?'text-emerald-500':'text-amber-500'}">${s.mail_smtp_password_set?'Password SMTP sudah tersimpan terenkripsi.':'Password SMTP belum diisi.'}</span>${s.mail_smtp_password_set?'<label class="text-[10px] text-red-400 flex items-center gap-1"><input type="checkbox" name="remove_mail_smtp_password" value="1"> Hapus password</label>':''}</div>
          </div>
          <div><label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Email Pengirim (From)</label><input type="email" name="mail_from_address" value="${safeAttr(s.mail_from_address||s.mail_smtp_username||'')}" placeholder="perusahaan@gmail.com" class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm"></div>
          <div><label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Nama Pengirim</label><input name="mail_from_name" value="${safeAttr(s.mail_from_name||s.company||'')}" placeholder="${safeAttr(s.company||'Nama Perusahaan')}" class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm"></div>
        </div>

        <div class="mt-5 p-4 rounded-xl bg-blue-500/10 border border-blue-500/20 text-xs text-stone-500 leading-relaxed">
          <div class="flex gap-2"><iconify-icon icon="lucide:info" width="16" class="text-blue-500 flex-shrink-0 mt-0.5"></iconify-icon><div><b>Catatan Gmail:</b> alamat Email Pengirim sebaiknya sama dengan Username/Akun Gmail. Jika berbeda, alamat tersebut harus sudah dibuat sebagai alias <i>Send mail as</i> dan diverifikasi di Gmail; jika tidak, Gmail dapat mengganti atau menolak alamat From.</div></div>
        </div>

        <div class="mt-5 grid sm:grid-cols-[1fr_auto] gap-3 items-end">
          <div><label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Kirim Tes Ke</label><input type="email" id="mail-test-recipient" placeholder="emailanda@gmail.com" class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm"></div>
          <button type="button" id="mail-test-btn" onclick="saveSettingsAndTestEmail()" class="px-5 py-3 bg-blue-600 text-white text-xs font-semibold tracking-wider uppercase rounded-xl hover:bg-blue-500 transition-all flex items-center justify-center gap-2"><iconify-icon icon="lucide:send" width="14"></iconify-icon> Simpan & Tes Email</button>
        </div>
      </div>

      <div class="bg-navy-800 rounded-2xl p-6 md:p-8 border border-navy-700/30 reveal">
        <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-4 mb-6">
          <div>
            <h3 class="font-serif text-xl text-white flex items-center gap-2"><iconify-icon icon="lucide:mail-open" width="20" class="text-gold-400"></iconify-icon> Template Kalimat Email</h3>
            <p class="text-xs text-stone-500 mt-2 max-w-3xl leading-relaxed">Atur subjek dan isi kalimat email yang diterima user. Placeholder di dalam kurung kurawal akan otomatis diganti dengan data jadwal/perusahaan saat email dikirim.</p>
          </div>
          <button type="button" onclick="resetEmailTemplates()" class="px-4 py-2.5 border border-navy-700 text-stone-400 text-[10px] font-semibold tracking-wider uppercase rounded-xl hover:border-blue-500 hover:text-blue-500 transition-all whitespace-nowrap"><iconify-icon icon="lucide:rotate-ccw" width="13"></iconify-icon> Template Default</button>
        </div>

        <div class="p-4 rounded-xl bg-blue-500/10 border border-blue-500/20 mb-6">
          <div class="text-[10px] font-semibold tracking-wider uppercase text-blue-500 mb-3">Placeholder yang tersedia</div>
          <div class="flex flex-wrap gap-2 text-[10px]">
            <code class="px-2 py-1 rounded bg-white/5 text-stone-400">{nama}</code>
            <code class="px-2 py-1 rounded bg-white/5 text-stone-400">{email}</code>
            <code class="px-2 py-1 rounded bg-white/5 text-stone-400">{telepon}</code>
            <code class="px-2 py-1 rounded bg-white/5 text-stone-400">{jenis}</code>
            <code class="px-2 py-1 rounded bg-white/5 text-stone-400">{tanggal}</code>
            <code class="px-2 py-1 rounded bg-white/5 text-stone-400">{waktu}</code>
            <code class="px-2 py-1 rounded bg-white/5 text-stone-400">{catatan_user}</code>
            <code class="px-2 py-1 rounded bg-white/5 text-stone-400">{catatan_admin}</code>
            <code class="px-2 py-1 rounded bg-white/5 text-stone-400">{status}</code>
            <code class="px-2 py-1 rounded bg-white/5 text-stone-400">{nama_perusahaan}</code>
            <code class="px-2 py-1 rounded bg-white/5 text-stone-400">{nama_singkat}</code>
            <code class="px-2 py-1 rounded bg-white/5 text-stone-400">{email_perusahaan}</code>
            <code class="px-2 py-1 rounded bg-white/5 text-stone-400">{telepon_perusahaan}</code>
            <code class="px-2 py-1 rounded bg-white/5 text-stone-400">{alamat_perusahaan}</code>
            <code class="px-2 py-1 rounded bg-white/5 text-stone-400">{nama_pengirim}</code>
            <code class="px-2 py-1 rounded bg-white/5 text-stone-400">{email_pengirim}</code>
          </div>
          <p class="text-[10px] text-stone-500 mt-3">Contoh: <b>Halo {nama}</b> akan menjadi nama user yang mengisi form. Jangan mengubah nama placeholder di dalam <b>{ }</b>.</p>
        </div>

        <div class="grid lg:grid-cols-2 gap-5">
          <div class="rounded-2xl border border-navy-700/40 bg-navy-900/30 p-5">
            <div class="flex items-center gap-2 mb-4"><div class="w-9 h-9 rounded-lg bg-amber-500/10 text-amber-500 flex items-center justify-center"><iconify-icon icon="lucide:clock-3" width="16"></iconify-icon></div><div><h4 class="text-sm font-semibold text-white">Jadwal Diterima</h4><p class="text-[10px] text-stone-500">Dikirim setelah user mengisi form.</p></div></div>
            <div class="space-y-4">
              <div><label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Subjek Email *</label><input name="mail_received_subject" required maxlength="255" value="${safeAttr(s.mail_received_subject||'')}" class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm"></div>
              <div><label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Isi Email *</label><textarea name="mail_received_body" required maxlength="8000" rows="8" class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm resize-y leading-relaxed">${escapeHtml(s.mail_received_body||'')}</textarea></div>
            </div>
          </div>

          <div class="rounded-2xl border border-navy-700/40 bg-navy-900/30 p-5">
            <div class="flex items-center gap-2 mb-4"><div class="w-9 h-9 rounded-lg bg-emerald-500/10 text-emerald-500 flex items-center justify-center"><iconify-icon icon="lucide:circle-check-big" width="16"></iconify-icon></div><div><h4 class="text-sm font-semibold text-white">Jadwal Di-ACC</h4><p class="text-[10px] text-stone-500">Dikirim saat admin mengonfirmasi jadwal.</p></div></div>
            <div class="space-y-4">
              <div><label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Subjek Email *</label><input name="mail_confirmed_subject" required maxlength="255" value="${safeAttr(s.mail_confirmed_subject||'')}" class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm"></div>
              <div><label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Isi Email *</label><textarea name="mail_confirmed_body" required maxlength="8000" rows="8" class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm resize-y leading-relaxed">${escapeHtml(s.mail_confirmed_body||'')}</textarea></div>
            </div>
          </div>

          <div class="rounded-2xl border border-navy-700/40 bg-navy-900/30 p-5">
            <div class="flex items-center gap-2 mb-4"><div class="w-9 h-9 rounded-lg bg-red-500/10 text-red-500 flex items-center justify-center"><iconify-icon icon="lucide:circle-x" width="16"></iconify-icon></div><div><h4 class="text-sm font-semibold text-white">Jadwal Dibatalkan</h4><p class="text-[10px] text-stone-500">Dikirim saat admin membatalkan jadwal.</p></div></div>
            <div class="space-y-4">
              <div><label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Subjek Email *</label><input name="mail_cancelled_subject" required maxlength="255" value="${safeAttr(s.mail_cancelled_subject||'')}" class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm"></div>
              <div><label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Isi Email *</label><textarea name="mail_cancelled_body" required maxlength="8000" rows="8" class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm resize-y leading-relaxed">${escapeHtml(s.mail_cancelled_body||'')}</textarea></div>
            </div>
          </div>

          <div class="rounded-2xl border border-navy-700/40 bg-navy-900/30 p-5">
            <div class="flex items-center gap-2 mb-4"><div class="w-9 h-9 rounded-lg bg-blue-500/10 text-blue-500 flex items-center justify-center"><iconify-icon icon="lucide:send" width="16"></iconify-icon></div><div><h4 class="text-sm font-semibold text-white">Email Tes SMTP</h4><p class="text-[10px] text-stone-500">Dipakai tombol Simpan & Tes Email.</p></div></div>
            <div class="space-y-4">
              <div><label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Subjek Email *</label><input name="mail_test_subject" required maxlength="255" value="${safeAttr(s.mail_test_subject||'')}" class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm"></div>
              <div><label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Isi Email *</label><textarea name="mail_test_body" required maxlength="8000" rows="8" class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm resize-y leading-relaxed">${escapeHtml(s.mail_test_body||'')}</textarea></div>
            </div>
          </div>
        </div>
      </div>

      <div class="bg-navy-800 rounded-2xl p-6 md:p-8 border border-navy-700/30 reveal">
        <h3 class="font-serif text-xl text-white mb-6 flex items-center gap-2"><iconify-icon icon="lucide:share-2" width="20" class="text-gold-400"></iconify-icon> Media Sosial</h3>
        <div class="grid sm:grid-cols-2 gap-4">
          <div><label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Instagram</label><input type="url" name="instagram_url" value="${safeAttr(s.instagram_url||'')}" placeholder="https://instagram.com/..." class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm"></div>
          <div><label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Facebook</label><input type="url" name="facebook_url" value="${safeAttr(s.facebook_url||'')}" placeholder="https://facebook.com/..." class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm"></div>
          <div><label class="text-xs font-medium text-stone-400 tracking-wider uppercase">LinkedIn</label><input type="url" name="linkedin_url" value="${safeAttr(s.linkedin_url||'')}" placeholder="https://linkedin.com/company/..." class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm"></div>
          <div><label class="text-xs font-medium text-stone-400 tracking-wider uppercase">YouTube</label><input type="url" name="youtube_url" value="${safeAttr(s.youtube_url||'')}" placeholder="https://youtube.com/..." class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm"></div>
        </div>
      </div>

      <div class="bg-navy-800 rounded-2xl p-6 md:p-8 border border-navy-700/30 reveal">
        <h3 class="font-serif text-xl text-white mb-6 flex items-center gap-2"><iconify-icon icon="lucide:panel-top" width="20" class="text-gold-400"></iconify-icon> Hero Beranda</h3>
        <div class="grid sm:grid-cols-2 gap-4">
          <div class="sm:col-span-2"><label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Badge Hero *</label><input name="hero_badge" required value="${safeAttr(s.hero_badge||'')}" class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm"></div>
          <div><label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Judul Baris 1 *</label><input name="hero_title_primary" required value="${safeAttr(s.hero_title_primary||'')}" class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm"></div>
          <div><label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Judul Highlight *</label><input name="hero_title_highlight" required value="${safeAttr(s.hero_title_highlight||'')}" class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm"></div>
          <div><label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Judul Baris 3 *</label><input name="hero_title_secondary" required value="${safeAttr(s.hero_title_secondary||'')}" class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm"></div>
          <div><label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Tahun Berdiri *</label><input type="number" min="1900" max="2100" name="founded_year" required value="${safeAttr(s.founded_year||'')}" class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm"></div>
          <div class="sm:col-span-2"><label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Deskripsi Hero *</label><textarea name="hero_description" required rows="4" class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm resize-none">${escapeHtml(s.hero_description||'')}</textarea></div>
        </div>
      </div>

      <div class="bg-navy-800 rounded-2xl p-6 md:p-8 border border-navy-700/30 reveal">
        <h3 class="font-serif text-xl text-white mb-6 flex items-center gap-2"><iconify-icon icon="lucide:chart-no-axes-column-increasing" width="20" class="text-gold-400"></iconify-icon> Statistik Beranda</h3>
        <div class="grid md:grid-cols-2 gap-4">
          <div class="grid grid-cols-[120px_1fr] gap-3"><input type="number" min="0" name="stat_projects" required value="${safeAttr(s.stat_projects??0)}" class="px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm"><input name="stat_projects_label" required value="${safeAttr(s.stat_projects_label||'')}" class="px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm"></div>
          <div class="grid grid-cols-[120px_1fr] gap-3"><input type="number" min="0" name="stat_clients" required value="${safeAttr(s.stat_clients??0)}" class="px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm"><input name="stat_clients_label" required value="${safeAttr(s.stat_clients_label||'')}" class="px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm"></div>
          <div class="grid grid-cols-[120px_1fr] gap-3"><input type="number" min="0" name="stat_experience" required value="${safeAttr(s.stat_experience??0)}" class="px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm"><input name="stat_experience_label" required value="${safeAttr(s.stat_experience_label||'')}" class="px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm"></div>
          <div class="grid grid-cols-[120px_1fr] gap-3"><input type="number" min="0" name="stat_team" required value="${safeAttr(s.stat_team??0)}" class="px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm"><input name="stat_team_label" required value="${safeAttr(s.stat_team_label||'')}" class="px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm"></div>
        </div>
        <p class="text-[10px] text-stone-600 mt-3">Kolom kiri = angka, kolom kanan = label yang tampil di website.</p>
      </div>

      <div class="bg-navy-800 rounded-2xl p-6 md:p-8 border border-navy-700/30 reveal">
        <h3 class="font-serif text-xl text-white mb-6 flex items-center gap-2"><iconify-icon icon="lucide:search-check" width="20" class="text-gold-400"></iconify-icon> SEO</h3>
        <div class="space-y-4">
          <div><label class="text-xs font-medium text-stone-400 tracking-wider uppercase">SEO Title *</label><input name="seo_title" required value="${safeAttr(s.seo_title||'')}" class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm"></div>
          <div><label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Meta Description *</label><textarea name="seo_description" required rows="3" class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm resize-none">${escapeHtml(s.seo_description||'')}</textarea></div>
          <div><label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Meta Keywords</label><textarea name="seo_keywords" rows="2" class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm resize-none">${escapeHtml(s.seo_keywords||'')}</textarea></div>
        </div>
      </div>

      <div class="bg-navy-800 rounded-2xl p-6 md:p-8 border border-navy-700/30 reveal">
        <h3 class="font-serif text-xl text-white mb-6 flex items-center gap-2"><iconify-icon icon="lucide:panel-bottom" width="20" class="text-gold-400"></iconify-icon> Footer</h3>
        <div class="space-y-4">
          <div><label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Deskripsi Footer *</label><textarea name="footer_description" required rows="3" class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm resize-none">${escapeHtml(s.footer_description||'')}</textarea></div>
          <div><label class="text-xs font-medium text-stone-400 tracking-wider uppercase">Teks Hak Cipta *</label><input name="copyright_text" required value="${safeAttr(s.copyright_text||'')}" class="w-full mt-1 px-4 py-3 rounded-xl bg-navy-900/60 border border-navy-700 text-white text-sm"></div>
        </div>
      </div>

      <div class="flex justify-end reveal">
        <button type="submit" id="settings-submit" class="px-8 py-3.5 bg-gold-500 text-white text-xs font-semibold tracking-[.15em] uppercase rounded-xl hover:bg-gold-400 transition-all hover:-translate-y-0.5 flex items-center gap-2"><iconify-icon icon="lucide:save" width="15"></iconify-icon> Simpan Semua Pengaturan</button>
      </div>
    </form>
  </div>`;
}

function resetEmailTemplates(){
  if(!confirm('Kembalikan seluruh template email ke kalimat default? Perubahan baru tersimpan setelah tombol Simpan Semua Pengaturan ditekan.'))return;
  var f=document.getElementById('settings-form');
  if(!f)return;
  var defaults={
    mail_received_subject:'Permintaan Jadwal Diterima - {nama_singkat}',
    mail_received_body:'Halo {nama},\n\nPermintaan jadwal pertemuan Anda telah kami terima dan saat ini masih MENUNGGU VALIDASI ADMIN.\n\nJenis: {jenis}\nTanggal: {tanggal}\nWaktu: {waktu} WIB\n\nAdmin akan memeriksa jadwal tersebut. Setelah jadwal DIKONFIRMASI atau DIBATALKAN, sistem akan mengirimkan informasi hasil validasi ke email ini.\n\nTerima kasih,\n{nama_perusahaan}',
    mail_confirmed_subject:'Jadwal Pertemuan Dikonfirmasi - {nama_singkat}',
    mail_confirmed_body:'Halo {nama}, permintaan jadwal pertemuan Anda telah diperiksa dan DIKONFIRMASI oleh admin {nama_singkat}.\n\nMohon hadir sesuai jadwal yang tercantum pada email ini. Jika ada perubahan mendesak, silakan hubungi kami melalui {telepon_perusahaan} atau {email_perusahaan}.',
    mail_cancelled_subject:'Jadwal Pertemuan Dibatalkan - {nama_singkat}',
    mail_cancelled_body:'Halo {nama}, setelah ditinjau oleh admin {nama_singkat}, jadwal pertemuan Anda belum dapat dilaksanakan dan telah DIBATALKAN.\n\nSilakan perhatikan catatan admin pada email ini. Anda dapat mengajukan jadwal pertemuan baru melalui website kami pada waktu yang tersedia.',
    mail_test_subject:'Tes Email - {nama_singkat}',
    mail_test_body:'Tes pengiriman email berhasil.\n\nJika Anda menerima email ini, konfigurasi SMTP pada Admin Panel sudah benar.\n\nPengirim: {nama_pengirim} <{email_pengirim}>'
  };
  Object.keys(defaults).forEach(function(name){if(f.elements[name])f.elements[name].value=defaults[name];});
  toast('↩️ Template default dimuat. Tekan Simpan untuk menerapkan.');
}

async function saveSettings(e){
  e.preventDefault();
  var f=e.target;
  var btn=document.getElementById('settings-submit');
  var oldText=btn?btn.innerHTML:'';
  if(btn){btn.disabled=true;btn.innerHTML='<iconify-icon icon="lucide:loader-circle" width="15"></iconify-icon> Menyimpan...';}

  try{
    var formData=new FormData(f);
    await apiRequest('/admin/settings',{method:'POST',body:formData});
    await loadAdminData();
    toast('✅ Semua pengaturan website berhasil disimpan');
    goPage('settings');
  }catch(err){
    toast('❌ '+err.message);
    if(btn){btn.disabled=false;btn.innerHTML=oldText;}
  }
}

async function saveSettingsAndTestEmail(){
  var f=document.getElementById('settings-form');
  var recipient=(document.getElementById('mail-test-recipient')||{}).value||'';
  recipient=recipient.trim();
  var btn=document.getElementById('mail-test-btn');
  var oldText=btn?btn.innerHTML:'';

  if(!recipient){
    toast('⚠️ Isi alamat email tujuan tes terlebih dahulu');
    return;
  }

  if(btn){btn.disabled=true;btn.innerHTML='<iconify-icon icon="lucide:loader-circle" width="15"></iconify-icon> Menguji...';}

  try{
    var formData=new FormData(f);
    await apiRequest('/admin/settings',{method:'POST',body:formData});
    var result=await apiRequest('/admin/settings/test-email',{method:'POST',body:JSON.stringify({email:recipient})});
    await loadAdminData();
    toast(result.mail_sent?'✅ '+result.message:'⚠️ '+result.message);
    goPage('settings');
  }catch(err){
    toast('❌ '+err.message);
    if(btn){btn.disabled=false;btn.innerHTML=oldText;}
  }
}

// ===== MODAL & TOAST =====
function showModal(h){document.getElementById('modal-box').innerHTML = h; document.getElementById('modal-ov').classList.add('show'); document.getElementById('modal-box').classList.add('show')}
function closeModal(){document.getElementById('modal-ov').classList.remove('show'); document.getElementById('modal-box').classList.remove('show')}
function toast(msg){var t = document.getElementById('toast-c'); t.textContent = msg; t.classList.add('show'); setTimeout(function(){t.classList.remove('show')}, 3500)}

// ===== BACKEND / API =====
function csrfToken(){var el=document.querySelector('meta[name="csrf-token"]');return el?el.getAttribute('content'):'';}
async function apiRequest(url,options){
  options=options||{};
  var isFormData=(typeof FormData!=='undefined' && options.body instanceof FormData);
  var baseHeaders={'Accept':'application/json','X-CSRF-TOKEN':csrfToken()};
  if(!isFormData)baseHeaders['Content-Type']='application/json';
  options.headers=Object.assign(baseHeaders,options.headers||{});
  options.credentials='same-origin';
  var res=await fetch(url,options);
  var data={};
  try{data=await res.json();}catch(e){}
  if(!res.ok){
    var msg=data.message||'Permintaan gagal.';
    if(data.errors){var first=Object.keys(data.errors)[0];if(first&&data.errors[first]&&data.errors[first][0])msg=data.errors[first][0];}
    throw new Error(msg);
  }
  return data;
}
async function loadAdminData(){DB=await apiRequest('/admin/data');return DB;}
async function bootAdmin(){
  if(!ADMIN_AUTHENTICATED)return;
  try{
    await loadAdminData();
    document.getElementById('login-screen').classList.add('hidden');
    document.getElementById('admin-layout').classList.remove('hidden');
    goPage('dashboard');
  }catch(e){ADMIN_AUTHENTICATED=false;}
}
bootAdmin();
</script></body>
</html>