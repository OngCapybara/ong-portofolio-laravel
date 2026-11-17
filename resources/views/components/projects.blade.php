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

        <!-- Section Header -->
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-14">
            <div>
                <p class="text-xs font-medium text-sky-500 tracking-widest uppercase mb-3">Selected Work</p>
                <h2 class="font-display font-bold text-4xl md:text-5xl text-zinc-900 dark:text-white">Featured Projects</h2>
            </div>
            <a
                href="https://github.com/OngCapybara"
                target="_blank"
                rel="noopener noreferrer"
                class="text-sm font-medium text-zinc-500 dark:text-zinc-400 hover:text-sky-500 transition-colors self-start sm:self-auto"
            >
                Explore GitHub →
            </a>
        </div>

        <!-- Grid Projects (1 col mobile, 2 cols tablet, 3 cols desktop) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($projects as $project)
                <article class="group bg-zinc-50 dark:bg-zinc-900 rounded-2xl overflow-hidden border border-zinc-100 dark:border-zinc-800 hover:border-sky-500 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col">

                    <!-- Thumbnail 16:9 -->
                    <div class="w-full aspect-video overflow-hidden bg-zinc-200 dark:bg-zinc-800">
                        <img
                            src="{{ $project['image'] }}"
                            alt="{{ $project['title'] }}"
                            loading="lazy"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                        />
                    </div>

                    <!-- Content -->
                    <div class="p-6 flex flex-col flex-1">
                        <h3 class="font-display font-bold text-xl text-zinc-900 dark:text-white mb-2.5 group-hover:text-sky-500 transition-colors">
                            {{ $project['title'] }}
                        </h3>

                        <p class="text-sm text-zinc-500 dark:text-zinc-400 leading-relaxed mb-5 line-clamp-3">
                            {{ $project['description'] }}
                        </p>

                        <!-- Tech Badges -->
                        <div class="flex flex-wrap gap-2 mb-6 mt-auto">
                            @foreach ($project['tags'] as $tag)
                                <span class="text-xs bg-sky-50 dark:bg-zinc-800 text-sky-600 dark:text-sky-400 border border-sky-200/70 dark:border-zinc-700 px-2.5 py-1 rounded-full font-medium">
                                    {{ $tag }}
                                </span>
                            @endforeach
                        </div>

                        <!-- Action Links -->
                        <div class="flex items-center gap-3 pt-4 border-t border-zinc-200/70 dark:border-zinc-800">
                            <a
                                href="{{ $project['demo_url'] }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="flex-1 inline-flex items-center justify-center gap-1.5 bg-sky-500 hover:bg-sky-600 text-white text-xs font-semibold py-2.5 px-4 rounded-xl transition-colors"
                            >
                                <i class="fa-solid fa-arrow-up-right-from-square text-[11px]" aria-hidden="true"></i>
                                Live Demo
                            </a>
                            <a
                                href="{{ $project['github_url'] }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="flex-1 inline-flex items-center justify-center gap-1.5 bg-white dark:bg-zinc-800 hover:bg-zinc-100 dark:hover:bg-zinc-700 text-zinc-800 dark:text-zinc-200 border border-zinc-200 dark:border-zinc-700 text-xs font-semibold py-2.5 px-4 rounded-xl transition-colors"
                            >
                                <i class="fa-brands fa-github text-sm" aria-hidden="true"></i>
                                GitHub
                            </a>
                        </div>
                    </div>

                </article>
            @endforeach
        </div>

    </div>
</section>
