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

    <!-- Kartu Identitas Mahasiswa & Verifikasi Database (Latihan 4a) -->
    <div style="position:fixed; bottom:20px; right:20px; background: #1e40af; color:white; padding: 16px 24px; border-radius: 12px; font-family: sans-serif; font-size:14px; box-shadow: 0 4px 20px rgba(0,0,0,0.3); z-index: 50;">
        <strong>Identitas Pengembang</strong><br>
        Nama &nbsp;: Ong Azis Saliem<br>
        NIM &nbsp; &nbsp;: 24312043<br>
        Kelas &nbsp;: IF 24 CX<br>
        ✔ Status: Laravel {{ app()->version() }} Berjalan<br>
        ✔ DB &nbsp; &nbsp; &nbsp;: {{ DB::connection()->getDatabaseName() }} Terhubung
    </div>

</body>
</html>
