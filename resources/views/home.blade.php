<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portofolio - Ong Azis Saliem</title>

    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <!-- Alpine.js CDN -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @vite('resources/css/app.css')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-white dark:bg-zinc-950 text-zinc-900 dark:text-white font-sans antialiased">

    <x-navbar />

    <main>
        <x-hero />
        <x-service />
        <x-skills />
        <x-testimonials />
        <x-projects />
        <x-experience />
        <x-certificates />
        <x-blogs :articles="$blogs ?? []" />
        <x-contact />
    </main>

    <x-footer />

    <!-- Panel Status API — Bukti Pengerjaan Latihan 5a -->
    <div style="position:fixed; bottom:20px; right:20px; z-index:9999; background:#0f172a; color:#f1f5f9;
                padding:18px 22px; border-radius:12px; font-family:monospace; font-size:12px;
                border:1px solid #334155; box-shadow: 0 8px 28px rgba(0,0,0,0.45); max-width: 340px; line-height:1.7;">
        <div style="color:#38bdf8; font-weight:bold; font-size:13px; margin-bottom:6px;">
            🚀 API Status — Latihan 5a
        </div>
        <div>🎓 <strong>Ong Azis Saliem</strong></div>
        <div>🆔 NPM: <strong>24312043</strong></div>
        <div>📦 Laravel: <strong>{{ app()->version() }}</strong></div>
        <hr style="border-color:#334155; margin:8px 0;">
        <div style="color:#86efac; font-size:11px; font-weight:bold; margin-bottom:4px;">ENDPOINT AKTIF:</div>
        @foreach([
            '/api/portfolio/profile',
            '/api/portfolio/skills',
            '/api/portfolio/projects',
            '/api/portfolio/experiences',
            '/api/portfolio/certificates',
            '/api/portfolio/messages',
        ] as $endpoint)
        <div>
            <span style="color:#fbbf24;">GET</span>
            <a href="{{ url($endpoint) }}" target="_blank"
               style="color:#93c5fd; text-decoration:none;">{{ $endpoint }}</a>
        </div>
        @endforeach
    </div>

</body>
</html>
