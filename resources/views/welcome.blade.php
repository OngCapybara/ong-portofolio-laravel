<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portofolio - Ong Azis Saliem</title>
    @vite('resources/css/app.css')
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-900 text-gray-100 font-sans antialiased">

    @php
        // Data Statis untuk looping Blade
        $skills = [
            'frontend' => [
                ['name' => 'HTML5', 'icon' => 'fa-brands fa-html5', 'color' => 'text-orange-500'],
                ['name' => 'CSS3 / Tailwind', 'icon' => 'fa-solid fa-wind', 'color' => 'text-teal-400'],
                ['name' => 'JavaScript / React', 'icon' => 'fa-brands fa-react', 'color' => 'text-blue-400'],
                ['name' => 'Flutter', 'icon' => 'fa-solid fa-mobile-screen', 'color' => 'text-sky-400'],
            ],
            'backend' => [
                ['name' => 'PHP / Laravel', 'icon' => 'fa-brands fa-laravel', 'color' => 'text-red-500'],
                ['name' => 'Golang', 'icon' => 'fa-brands fa-golang', 'color' => 'text-cyan-400'],
                ['name' => 'MySQL / PostgreSQL', 'icon' => 'fa-solid fa-database', 'color' => 'text-blue-500'],
                ['name' => 'Python / PyTorch', 'icon' => 'fa-brands fa-python', 'color' => 'text-yellow-400'],
            ],
            'tools' => [
                ['name' => 'ROS2 / Linux', 'icon' => 'fa-brands fa-linux', 'color' => 'text-yellow-500'],
                ['name' => 'Git / GitHub', 'icon' => 'fa-brands fa-github', 'color' => 'text-white'],
                ['name' => 'SolidWorks / EasyEDA', 'icon' => 'fa-solid fa-microchip', 'color' => 'text-purple-400'],
                ['name' => 'Docker / Edge TPU', 'icon' => 'fa-brands fa-docker', 'color' => 'text-blue-400'],
            ]
        ];

        $projects = [
            [
                'title' => 'Self-Balancing & Hexapod Autonomous SAR Robot',
                'desc' => 'Pengembangan robotik berbasis ROS2, sensor IMU MPU6050, PID control, dan kamera RealSense D435 untuk pemetaan & SAR.',
                'tags' => ['ROS2', 'C++', 'PID Control', 'Computer Vision'],
                'image' => 'https://images.unsplash.com/photo-1485827404703-89b55fcc595e?auto=format&fit=crop&q=80&w=600',
                'demo' => '#',
                'github' => '#'
            ],
            [
                'title' => 'Kost-Life Financial Logging',
                'desc' => 'Aplikasi web pencatatan keuangan khusus anak kos dengan visualisasi riwayat transaksi dan pengelompokan anggaran.',
                'tags' => ['Laravel', 'Tailwind CSS', 'MySQL'],
                'image' => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?auto=format&fit=crop&q=80&w=600',
                'demo' => '#',
                'github' => '#'
            ],
            [
                'title' => 'Wholesale Inventory Mobile App',
                'desc' => 'Aplikasi inventaris grosir berbasis mobile dengan integrasi autentikasi, Firestore CRUD, dan Firebase Storage.',
                'tags' => ['Flutter', 'Firebase', 'Mobile App'],
                'image' => 'https://images.unsplash.com/photo-1526498460520-4c246339dccb?auto=format&fit=crop&q=80&w=600',
                'demo' => '#',
                'github' => '#'
            ]
        ];

        $experiences = [
            [
                'role' => 'Instruktur & Mentor Organisasi',
                'org' => 'UKM Robotika Universitas Teknokrat Indonesia',
                'period' => '2025 - Sekarang',
                'desc' => 'Membimbing mahasiswa dan siswa sekolah menengah dalam pemrograman mikrokontroler, logika sistem tertanam, dan perakitan mekanik robot.'
            ],
            [
                'role' => 'Mahasiswa S1 Informatika',
                'org' => 'Universitas Teknokrat Indonesia',
                'period' => '2023 - Sekarang',
                'desc' => 'Fokus pada pengembangan perangkat lunak, sistem tertanam (embedded system), Computer Vision, dan arsitektur Web/Mobile.'
            ]
        ];

        $certificates = [
            ['title' => 'Pelatihan & Sertifikasi Computer Vision with YOLO', 'issuer' => 'Online Platform', 'year' => '2026'],
            ['title' => 'Web Security & Vulnerability Analysis CTF', 'issuer' => 'Komunitas Cybersecurity', 'year' => '2026']
        ];
    @endphp

    <!-- 1. NAVBAR -->
    <nav class="fixed top-0 w-full bg-gray-900/80 backdrop-blur-md z-50 border-b border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <span class="text-xl font-bold bg-gradient-to-r from-blue-400 to-teal-400 bg-clip-text text-transparent">
                Ong Azis Saliem
            </span>
            <div class="hidden md:flex space-x-8 text-sm font-medium text-gray-300">
                <a href="#about" class="hover:text-blue-400 transition">Tentang</a>
                <a href="#skills" class="hover:text-blue-400 transition">Skill</a>
                <a href="#projects" class="hover:text-blue-400 transition">Proyek</a>
                <a href="#experience" class="hover:text-blue-400 transition">Pengalaman</a>
                <a href="#contact" class="hover:text-blue-400 transition">Kontak</a>
            </div>
        </div>
    </nav>

    <!-- 2. HERO SECTION -->
    <section id="about" class="min-h-screen flex items-center justify-center pt-20 px-4 max-w-7xl mx-auto">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div class="space-y-6">
                <span class="px-3 py-1 bg-blue-500/10 text-blue-400 border border-blue-500/20 rounded-full text-sm font-semibold">
                    👋 Halo Semua!
                </span>
                <h1 class="text-4xl sm:text-6xl font-extrabold text-white leading-tight">
                    Ong Azis Saliem
                </h1>
                <h2 class="text-xl sm:text-2xl text-blue-400 font-medium">
                    Informatics Student | Robotics & Full-Stack Developer
                </h2>
                <p class="text-gray-400 text-base leading-relaxed">
                    Mahasiswa Informatika yang berfokus pada pengembangan Embedded Systems, Robotics (ROS2), Computer Vision, serta pembangunan aplikasi Web & Mobile modern yang responsif.
                </p>
                <!-- CTA & Sosmed -->
                <div class="flex flex-wrap gap-4 items-center">
                    <a href="#contact" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-lg shadow-blue-500/25 transition">
                        Kontak Saya
                    </a>
                    <a href="#" class="px-6 py-3 border border-gray-700 hover:bg-gray-800 text-gray-300 font-medium rounded-lg transition">
                        <i class="fa-solid fa-download mr-2"></i>Download CV
                    </a>
                    <div class="flex space-x-4 text-xl text-gray-400 ml-2">
                        <a href="https://github.com" target="_blank" class="hover:text-white transition"><i class="fa-brands fa-github"></i></a>
                        <a href="https://linkedin.com" target="_blank" class="hover:text-blue-400 transition"><i class="fa-brands fa-linkedin"></i></a>
                        <a href="mailto:ong@example.com" class="hover:text-red-400 transition"><i class="fa-solid fa-envelope"></i></a>
                    </div>
                </div>
            </div>
            <!-- Foto Profil -->
            <div class="flex justify-center">
                <div class="relative w-64 h-64 sm:w-80 sm:h-80 rounded-full p-2 bg-gradient-to-tr from-blue-500 to-teal-400 shadow-2xl">
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&q=80&w=500" alt="Ong Azis Saliem" class="w-full h-full object-cover rounded-full">
                </div>
            </div>
        </div>
    </section>

    <!-- 3. ABOUT & SKILLS SECTION -->
    <section id="skills" class="py-20 bg-gray-800/50">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 text-white">Keahlian & Teknologi</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Frontend -->
                <div class="bg-gray-900 p-6 rounded-xl border border-gray-800 space-y-4">
                    <h3 class="text-xl font-semibold text-blue-400 flex items-center gap-2">
                        <i class="fa-solid fa-code"></i> Frontend & Mobile
                    </h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($skills['frontend'] as $s)
                            <span class="px-3 py-1.5 bg-gray-800 text-gray-300 rounded-md text-sm flex items-center gap-2">
                                <i class="{{ $s['icon'] }} {{ $s['color'] }}"></i> {{ $s['name'] }}
                            </span>
                        @endforeach
                    </div>
                </div>
                <!-- Backend -->
                <div class="bg-gray-900 p-6 rounded-xl border border-gray-800 space-y-4">
                    <h3 class="text-xl font-semibold text-teal-400 flex items-center gap-2">
                        <i class="fa-solid fa-server"></i> Backend & Database
                    </h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($skills['backend'] as $s)
                            <span class="px-3 py-1.5 bg-gray-800 text-gray-300 rounded-md text-sm flex items-center gap-2">
                                <i class="{{ $s['icon'] }} {{ $s['color'] }}"></i> {{ $s['name'] }}
                            </span>
                        @endforeach
                    </div>
                </div>
                <!-- Tools -->
                <div class="bg-gray-900 p-6 rounded-xl border border-gray-800 space-y-4">
                    <h3 class="text-xl font-semibold text-purple-400 flex items-center gap-2">
                        <i class="fa-solid fa-microchip"></i> Hardware, ROS & Tools
                    </h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($skills['tools'] as $s)
                            <span class="px-3 py-1.5 bg-gray-800 text-gray-300 rounded-md text-sm flex items-center gap-2">
                                <i class="{{ $s['icon'] }} {{ $s['color'] }}"></i> {{ $s['name'] }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. PROJECTS SECTION -->
    <section id="projects" class="py-20 max-w-7xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12 text-white">Katalog Proyek</h2>
        <div class="grid md:grid-cols-3 gap-8">
            @foreach ($projects as $item)
                <div class="bg-gray-800/40 border border-gray-800 rounded-xl overflow-hidden hover:border-gray-700 transition flex flex-col justify-between">
                    <div>
                        <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" class="w-full aspect-video object-cover">
                        <div class="p-6 space-y-3">
                            <h3 class="text-xl font-bold text-white">{{ $item['title'] }}</h3>
                            <p class="text-gray-400 text-sm leading-relaxed">{{ $item['desc'] }}</p>
                            <div class="flex flex-wrap gap-2 pt-2">
                                @foreach ($item['tags'] as $tag)
                                    <span class="text-xs font-semibold px-2.5 py-0.5 rounded bg-blue-900/50 text-blue-300">#{{ $tag }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="px-6 pb-6 pt-2 flex gap-4">
                        <a href="{{ $item['demo'] }}" class="text-sm font-medium text-blue-400 hover:underline flex items-center gap-1">
                            <i class="fa-solid fa-arrow-up-right-from-square"></i> Live Demo
                        </a>
                        <a href="{{ $item['github'] }}" class="text-sm font-medium text-gray-400 hover:text-white flex items-center gap-1">
                            <i class="fa-brands fa-github"></i> Repository
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- 5. EXPERIENCE & EDUCATION TIMELINE -->
    <section id="experience" class="py-20 bg-gray-800/50">
        <div class="max-w-4xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 text-white">Pengalaman & Pendidikan</h2>
            <div class="relative border-l-2 border-gray-700 ml-4 space-y-8">
                @foreach ($experiences as $exp)
                    <div class="mb-10 ml-6">
                        <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-600 rounded-full -left-3 ring-8 ring-gray-900">
                            <i class="fa-solid fa-briefcase text-xs text-white"></i>
                        </span>
                        <h3 class="flex items-center mb-1 text-lg font-semibold text-white">{{ $exp['role'] }} — <span class="text-blue-400 ml-1">{{ $exp['org'] }}</span></h3>
                        <time class="block mb-2 text-sm font-normal text-gray-500">{{ $exp['period'] }}</time>
                        <p class="text-base font-normal text-gray-400">{{ $exp['desc'] }}</p>
                    </div>
                @endforeach
            </div>

            <!-- Sertifikasi -->
            <div class="mt-16">
                <h3 class="text-2xl font-bold text-white mb-6 text-center">Sertifikasi & Penghargaan</h3>
                <div class="grid sm:grid-cols-2 gap-4">
                    @foreach ($certificates as $cert)
                        <div class="p-4 bg-gray-900 rounded-lg border border-gray-800 flex items-start gap-3">
                            <i class="fa-solid fa-award text-yellow-500 text-2xl mt-1"></i>
                            <div>
                                <h4 class="font-semibold text-white text-sm">{{ $cert['title'] }}</h4>
                                <p class="text-xs text-gray-400">{{ $cert['issuer'] }} • {{ $cert['year'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- 6. CONTACT FORM -->
    <section id="contact" class="py-20 max-w-3xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-4 text-white">Hubungi Saya</h2>
        <p class="text-gray-400 text-center mb-8">Punya pertanyaan atau tertarik untuk berkolaborasi? Kirim pesan di bawah ini!</p>

        <form class="space-y-6 bg-gray-800/40 p-8 rounded-xl border border-gray-800" onsubmit="event.preventDefault(); alert('Pesan berhasil terkirim!');">
            <div class="grid sm:grid-cols-2 gap-6">
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-300">Nama Lengkap</label>
                    <input type="text" class="w-full p-3 bg-gray-900 border border-gray-700 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="Masukkan nama anda" required>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-300">Alamat Email</label>
                    <input type="email" class="w-full p-3 bg-gray-900 border border-gray-700 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="nama@email.com" required>
                </div>
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-300">Subjek</label>
                <input type="text" class="w-full p-3 bg-gray-900 border border-gray-700 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="Judul pesan" required>
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-300">Isi Pesan</label>
                <textarea rows="4" class="w-full p-3 bg-gray-900 border border-gray-700 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="Tuliskan pesan anda..." required></textarea>
            </div>
            <button type="submit" class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition shadow-lg shadow-blue-500/20">
                Kirim Pesan
            </button>
        </form>
    </section>

    <!-- FOOTER -->
    <footer class="py-8 border-t border-gray-800 text-center text-gray-500 text-sm">
        <p>&copy; 2026 Ong Azis Saliem. All rights reserved.</p>
    </footer>

</body>
</html>
