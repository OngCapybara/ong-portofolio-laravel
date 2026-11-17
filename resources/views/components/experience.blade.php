@php
    $experiences = [
        [
            'role' => 'Robotics & Electronics Instructor',
            'organization' => 'Sekolah Menengah Kejuruan (SMK)',
            'period' => '2025 – Sekarang',
            'type' => 'Experience',
            'summary' => 'Membimbing siswa kejuruan dalam perakitan elektronika, pemrograman mikrokontroler (Arduino, ESP32, STM32), integrasi sensor ultrasonik & servo, serta pengembangan proyek robotika berbasis praktik.',
        ],
        [
            'role' => 'Autonomous Robotics & Drone Developer (KRSRI)',
            'organization' => 'Tim Robotika Universitas Teknokrat Indonesia',
            'period' => '2025 – Sekarang',
            'type' => 'Organization & Research',
            'summary' => 'Mengembangkan sistem navigasi otonom pada robot Hexapod 18-DOF dan UAV menggunakan ROS 2, NVIDIA Jetson, Teensy, serta kamera Intel RealSense untuk kompetisi robotika nasional.',
        ],
        [
            'role' => 'S1 Informatika (Bachelor of Science in Informatics)',
            'organization' => 'Universitas Teknokrat Indonesia — Bandar Lampung',
            'period' => '2024 – Sekarang',
            'type' => 'Education',
            'summary' => 'Fokus mendalami rekayasa perangkat lunak full-stack, pengembangan aplikasi mobile, kecerdasan buatan (Computer Vision & Deep Reinforcement Learning), serta sistem tertanam.',
        ],
    ];
@endphp

<section id="experience" class="py-24 bg-zinc-50 dark:bg-zinc-900/40">
    <div class="max-w-6xl mx-auto px-6">

        <!-- Section Header -->
        <div class="mb-14">
            <p class="text-xs font-medium text-sky-500 tracking-widest uppercase mb-3">Journey</p>
            <h2 class="font-display font-bold text-4xl md:text-5xl text-zinc-900 dark:text-white">Experience &amp; Education</h2>
        </div>

        <!-- Vertical Timeline -->
        <div class="relative border-l-2 border-sky-500/40 ml-3 md:ml-4 space-y-10">
            @foreach ($experiences as $item)
                <article class="relative pl-8 md:pl-10 group">
                    <!-- Timeline Dot -->
                    <span class="absolute -left-[9px] top-1.5 w-4 h-4 rounded-full bg-sky-500 ring-4 ring-zinc-50 dark:ring-zinc-950 group-hover:scale-125 transition-transform duration-300" aria-hidden="true"></span>

                    <!-- Card Content -->
                    <div class="bg-white dark:bg-zinc-900 rounded-2xl p-6 md:p-8 border border-zinc-200/70 dark:border-zinc-800 hover:border-sky-500 transition-all duration-300 shadow-sm">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-3">
                            <div class="flex flex-wrap items-center gap-2.5">
                                <span class="text-xs font-semibold px-3 py-1 rounded-full bg-sky-500/10 text-sky-500">
                                    {{ $item['type'] }}
                                </span>
                                <span class="text-xs font-medium text-zinc-500 dark:text-zinc-400">
                                    <i class="fa-regular fa-calendar mr-1 text-sky-500" aria-hidden="true"></i>
                                    {{ $item['period'] }}
                                </span>
                            </div>
                        </div>

                        <h3 class="font-display font-bold text-xl text-zinc-900 dark:text-white mb-1">
                            {{ $item['role'] }}
                        </h3>
                        <p class="text-sm font-medium text-sky-500 mb-3">
                            {{ $item['organization'] }}
                        </p>
                        <p class="text-sm text-zinc-600 dark:text-zinc-400 leading-relaxed">
                            {{ $item['summary'] }}
                        </p>
                    </div>
                </article>
            @endforeach
        </div>

    </div>
</section>
