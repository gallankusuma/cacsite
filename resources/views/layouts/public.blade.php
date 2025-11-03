<!doctype html>
<html lang="en" x-data>
<head>
  <meta charset="utf-8">
  <title>{{ $title ?? 'CAC' }}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  @php
    $metaTitle = ($title ?? 'CAC');
    $metaDesc  = $meta_description ?? 'Cahaya Agro Chemical — Innovating Agriculture.';
    $metaImage = $og_image ?? '/assets/brand/cac-og-default.jpg';
  @endphp
  <meta name="description" content="{{ $metaDesc }}">
  <meta property="og:title" content="{{ $metaTitle }}">
  <meta property="og:description" content="{{ $metaDesc }}">
  <meta property="og:image" content="{{ $metaImage }}">
  <meta name="twitter:card" content="summary_large_image">

  @vite(['resources/css/app.css','resources/js/app.js'])
  @livewireStyles
  <style>
    :root{
      --leaf:#28C76F; --ever:#0E9F6E; --sky:#6EC1E4; --sun:#FDD36E;
      --mist:#F5FAF7; --text:#0F172A; --muted:#64748B;
    }
    .bg-mist{background:var(--mist)}
    .ap-input{border:1px solid #e5e7eb;border-radius:12px;padding:.75rem;width:100%}
    .ap-btn-primary{background:var(--ever);color:#fff;padding:.7rem 1rem;border-radius:12px}
    .ap-btn-primary:hover{filter:brightness(.95)}
    .ap-err{color:#b91c1c;font-size:.9rem}
  </style>
</head>
<body class="text-slate-800">
  <header class="border-b">
    <div class="container mx-auto px-4 h-16 flex items-center justify-between">
      <a href="{{ route('home') }}" class="flex items-center gap-2">
        <img src="/assets/brand/cac-logo.svg" class="h-8" alt="CAC">
        <span class="font-semibold">CAC</span>
      </a>
      <nav class="hidden md:flex items-center gap-6 text-sm">
        <a href="{{ route('page.show','about') }}">About</a>
        <a href="{{ route('page.show','advantages') }}">Advantages</a>
        <a href="{{ route('products.categories') }}">Products</a>
        <a href="{{ route('certificates.index') }}">Certificates</a>
        <a href="{{ route('contact') }}">Contact</a>
        <a href="{{ route('careers') }}">Work With Us</a>
      </nav>
    </div>
  </header>

  <main>@yield('content')</main>

  <footer class="mt-16 bg-mist">
    <div class="container mx-auto px-4 py-10 grid md:grid-cols-3 gap-6 text-sm">
      <div>
        <img src="/assets/brand/cac-logo.svg" class="h-8" alt="CAC">
        <p class="text-slate-600 mt-2">Cahaya Agro Chemical — Innovating Agriculture.</p>
      </div>
      <div>
        <div class="font-semibold mb-2">Products</div>
        <ul class="text-slate-600 space-y-1">
          <li><a href="{{ route('products.by-category','insecticides') }}">Insecticides</a></li>
          <li><a href="{{ route('products.by-category','herbicides') }}">Herbicides</a></li>
          <li><a href="{{ route('products.by-category','fungicides') }}">Fungicides</a></li>
        </ul>
      </div>
      <div>
        <div class="font-semibold mb-2">Contact</div>
        <p class="text-slate-600">hello@cac.example • +62-xxx</p>
      </div>
    </div>
    <div class="text-center text-xs text-slate-500 pb-6">© {{ date('Y') }} CAC</div>
  </footer>

  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
  @livewireScripts
</body>
</html>
