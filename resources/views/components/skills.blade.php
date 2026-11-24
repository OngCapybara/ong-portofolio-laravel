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

             <!-- Sisi Kanan: Deskripsi Profil & 4 Kategori Skill (Dinamis via Fetch API) -->
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

                    <!-- Target Kontainer Dinamis Fetch API -->
                    <div id="skills-container" class="grid sm:grid-cols-2 gap-5"></div>
                </div>
            </div>

        </div>
    </div>
</section>
