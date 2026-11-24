@php
    $projects = [
        [
            'title' => 'JagaNetra — AI Room Security CCTV',
            'description' => 'Sistem pemantauan keamanan ruangan real-time menggunakan YOLOv8 dan Python yang terintegrasi dengan aplikasi mobile Flutter serta notifikasi cloud Firebase Firestore.',
            'image' => 'https://placehold.co/640x360/09090b/0ea5e9?text=JagaNetra+AI+CCTV',
            'tags' => ['#Python', '#YOLOv8', '#Flutter', '#Firebase'],
            'demo_url' => 'https://github.com/OngCapybara',
            'github_url' => 'https://github.com/OngCapybara',
        ],
        [
            'title' => 'Kost Life — Student Expense Tracker',
            'description' => 'Aplikasi web manajemen keuangan khusus mahasiswa kos dengan fitur pencatatan transaksi harian, sinkronisasi pengeluaran, dan asisten AI untuk perencanaan anggaran.',
            'image' => 'https://placehold.co/640x360/09090b/0ea5e9?text=Kost+Life+Web+App',
            'tags' => ['#Laravel', '#TailwindCSS', '#MySQL', '#AlpineJS'],
            'demo_url' => 'https://github.com/OngCapybara',
            'github_url' => 'https://github.com/OngCapybara',
        ],
        [
            'title' => 'Autonomous 18-DOF Hexapod SAR Robot',
            'description' => 'Purwarupa robot berkaki enam otonom untuk misi pencarian dan penyelamatan (KRSRI) berbasis ROS 2, NVIDIA Jetson, Teensy, dan kamera depth Intel RealSense D435.',
            'image' => 'https://placehold.co/640x360/09090b/0ea5e9?text=Hexapod+SAR+ROS2',
            'tags' => ['#ROS2', '#C++', '#Jetson', '#OpenCV'],
            'demo_url' => 'https://github.com/OngCapybara',
            'github_url' => 'https://github.com/OngCapybara',
        ],
    ];
@endphp

<section id="projects" class="py-24 bg-white dark:bg-zinc-950">
    <div class="max-w-6xl mx-auto px-6">

        <!-- Section Header + Live Search Input -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-14">
            <div>
                <p class="text-xs font-medium text-sky-500 tracking-widest uppercase mb-3">Selected Work</p>
                <h2 class="font-display font-bold text-4xl md:text-5xl text-zinc-900 dark:text-white">Featured Projects</h2>
            </div>

            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-4">
                <!-- Input Pencarian Cepat (Debounced Live Search) -->
                <div class="relative">
                    <i class="fa-solid fa-magnifying-glass text-zinc-400 text-xs absolute left-3.5 top-1/2 -translate-y-1/2"></i>
                    <input
                        type="text"
                        id="search-project"
                        placeholder="Cari proyek atau teknologi..."
                        class="w-full sm:w-64 pl-9 pr-4 py-2 bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl text-xs text-zinc-800 dark:text-zinc-200 placeholder-zinc-400 focus:border-sky-500 focus:ring-2 focus:ring-sky-500/20 focus:outline-none transition-all"
                    />
                </div>

                <a
                    href="https://github.com/OngCapybara"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="text-sm font-medium text-zinc-500 dark:text-zinc-400 hover:text-sky-500 transition-colors self-start sm:self-auto shrink-0"
                >
                    Explore GitHub →
                </a>
            </div>
        </div>

        <!-- Target Kontainer Dinamis Fetch API -->
        <div id="projects-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"></div>

    </div>
</section>
