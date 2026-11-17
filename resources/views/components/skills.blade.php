@php
    $skillCategories = [
        [
            'category' => 'Frontend',
            'items' => [
                ['name' => 'HTML5 / CSS3', 'icon' => 'fa-brands fa-html5'],
                ['name' => 'Tailwind CSS', 'icon' => 'fa-solid fa-wind'],
                ['name' => 'JavaScript', 'icon' => 'fa-brands fa-js'],
                ['name' => 'ReactJS', 'icon' => 'fa-brands fa-react'],
                ['name' => 'Flutter', 'icon' => 'fa-solid fa-mobile-screen'],
            ],
        ],
        [
            'category' => 'Backend',
            'items' => [
                ['name' => 'Laravel (PHP)', 'icon' => 'fa-brands fa-laravel'],
                ['name' => 'Python', 'icon' => 'fa-brands fa-python'],
                ['name' => 'Golang', 'icon' => 'fa-solid fa-server'],
                ['name' => 'C++ / ROS 2', 'icon' => 'fa-solid fa-robot'],
            ],
        ],
        [
            'category' => 'Database',
            'items' => [
                ['name' => 'MySQL', 'icon' => 'fa-solid fa-database'],
                ['name' => 'PostgreSQL', 'icon' => 'fa-solid fa-table'],
                ['name' => 'Firebase Firestore', 'icon' => 'fa-solid fa-fire'],
            ],
        ],
        [
            'category' => 'Tools',
            'items' => [
                ['name' => 'Git / GitHub', 'icon' => 'fa-brands fa-git-alt'],
                ['name' => 'Linux Ubuntu', 'icon' => 'fa-brands fa-linux'],
                ['name' => 'OpenCV / YOLO', 'icon' => 'fa-solid fa-eye'],
                ['name' => 'Arduino / ESP32', 'icon' => 'fa-solid fa-microchip'],
                ['name' => 'Figma', 'icon' => 'fa-brands fa-figma'],
            ],
        ],
    ];
@endphp

<section id="about" class="py-24 bg-zinc-50 dark:bg-zinc-900/40 text-zinc-900 dark:text-zinc-100">
    <div class="max-w-6xl mx-auto px-6">
        <div class="grid md:grid-cols-2 gap-16 items-start">

            <!-- Sisi Kiri: Foto Profil -->
            <div class="order-2 md:order-1 md:sticky md:top-28">
                <div class="pf w-full aspect-square max-w-sm mx-auto rounded-3xl overflow-hidden bg-zinc-200 dark:bg-zinc-800 shadow-lg border border-zinc-200 dark:border-zinc-800">
                    <img
                        src="{{ asset('assets/atmin/ongsigma.JPG') }}"
                        alt="Ong Azis Saliem"
                        loading="lazy"
                        class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                    />
                </div>
            </div>

            <!-- Sisi Kanan: Deskripsi Profil & 4 Kategori Skill -->
            <div class="order-1 md:order-2">
                <p class="text-xs font-medium text-sky-500 tracking-widest uppercase mb-3">About me</p>
                <h2 class="font-display font-bold text-4xl md:text-5xl text-zinc-900 dark:text-white leading-tight mb-6">
                    A bit about<br />who I am
                </h2>
                <p class="text-zinc-500 dark:text-zinc-400 leading-relaxed mb-4">
                    Saya <strong class="text-zinc-900 dark:text-white">Ong Azis Saliem</strong>, seorang mahasiswa program studi S1 Informatika di Universitas Teknokrat Indonesia. Saya fokus bergerak di ranah rekayasa perangkat lunak (<strong class="text-zinc-900 dark:text-white">full-stack web development</strong>) serta pengembangan sistem tertanam (<strong class="text-zinc-900 dark:text-white">embedded systems</strong>) dan robotika.
                </p>
                <p class="text-zinc-500 dark:text-zinc-400 leading-relaxed mb-10">
                    Saya senang membangun produk digital yang bersih, efisien, dan fungsional—baik berupa sistem manajemen keuangan berbasis web seperti <strong class="text-zinc-900 dark:text-white">Kost Life</strong>, implementasi visi komputer AI, hingga merancang purwarupa sistem kontrol perangkat keras berbasis mikrokontroler.
                </p>

                <!-- Anchor khusus untuk link #skills -->
                <div id="skills" class="scroll-mt-24 pt-6 border-t border-zinc-200/80 dark:border-zinc-800 space-y-5">
                    <p class="text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-widest">
                        Technical Skills &amp; Tools
                    </p>

                    <div class="grid sm:grid-cols-2 gap-5">
                        @foreach ($skillCategories as $cat)
                            <div class="bg-white dark:bg-zinc-900/80 p-4 rounded-2xl border border-zinc-200/70 dark:border-zinc-800">
                                <span class="text-xs font-bold text-sky-500 uppercase tracking-wider block mb-3">
                                    {{ $cat['category'] }}
                                </span>
                                <div class="flex flex-wrap gap-2" role="list" aria-label="{{ $cat['category'] }} Skills">
                                    @foreach ($cat['items'] as $tech)
                                        <span
                                            role="listitem"
                                            class="stag inline-flex items-center gap-1.5 text-xs font-medium bg-zinc-50 dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 text-zinc-700 dark:text-zinc-300 px-3 py-1.5 rounded-full hover:border-sky-500 dark:hover:border-sky-500 transition-colors duration-200 cursor-default"
                                        >
                                            <i class="{{ $tech['icon'] }} text-sky-500 text-[11px]" aria-hidden="true"></i>
                                            {{ $tech['name'] }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
