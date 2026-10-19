@php
    // Mengelompokkan skill ke dalam kategori wajib praktikum (Frontend, Backend & DB, Tools & Hardware)
    $skillCategories = [
        [
            'category' => 'Frontend & Mobile',
            'items' => ['ReactJS', 'Tailwind CSS', 'Flutter', 'HTML5 / CSS3', 'JavaScript']
        ],
        [
            'category' => 'Backend & Database',
            'items' => ['Laravel (PHP)', 'Golang', 'MySQL', 'Firebase', 'Python']
        ],
        [
            'category' => 'Tools, AI & Hardware',
            'items' => ['ROS2 / Linux', 'OpenCV / YOLO', 'Arduino / ESP32', 'SolidWorks', 'Git / GitHub']
        ]
    ];
@endphp

<section id="about" class="py-24 bg-zinc-50 dark:bg-zinc-900/40 text-zinc-900 dark:text-zinc-100">
    <div class="max-w-6xl mx-auto px-6">
        <div class="grid md:grid-cols-2 gap-16 items-center">

            <!-- Sisi Kiri: Foto Profil (order-2 di mobile, md:order-1 di desktop) -->
            <div class="order-2 md:order-1">
                <div class="pf w-full aspect-square max-w-sm mx-auto rounded-3xl overflow-hidden bg-zinc-200 dark:bg-zinc-800 shadow-lg border border-zinc-200 dark:border-zinc-800">
                    <img
                        src="{{ asset('assets/atmin/ongsigma.JPG') }}"
                        alt="Ong Azis Saliem"
                        loading="lazy"
                        class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                    />
                </div>
            </div>

            <!-- Sisi Kanan: Deskripsi Profil & Kategori Skill -->
            <div class="order-1 md:order-2">
                <p class="text-xs font-medium text-sky-500 tracking-widest uppercase mb-3">About me</p>
                <h2 class="font-display font-bold text-4xl md:text-5xl text-zinc-900 dark:text-white leading-tight mb-6">
                    A bit about<br />who I am
                </h2>
                <p class="text-zinc-500 dark:text-zinc-400 leading-relaxed mb-4">
                    Saya <strong class="text-zinc-900 dark:text-white">Ong Azis Saliem</strong>, seorang mahasiswa program studi S1 Informatika di Universitas Teknokrat Indonesia. Saya fokus bergerak di ranah rekayasa perangkat lunak (<strong class="text-zinc-900 dark:text-white">full-stack web development</strong>) serta pengembangan sistem tertanam (<strong class="text-zinc-900 dark:text-white">embedded systems</strong>) dan robotika.
                </p>
                <p class="text-zinc-500 dark:text-zinc-400 leading-relaxed mb-8">
                    Saya senang membangun produk digital yang bersih, efisien, dan fungsional—baik berupa sistem manajemen keuangan berbasis web seperti <strong class="text-zinc-900 dark:text-white">Kost Life</strong>, implementasi visi komputer AI, hingga merancang purwarupa sistem kontrol perangkat keras berbasis mikrokontroler.
                </p>

                <!-- List Tech Stack Dikelompokkan Per Kategori -->
                <div class="space-y-5">
                    <p class="text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-widest mb-3">
                        Stack &amp; tools
                    </p>

                    @foreach ($skillCategories as $cat)
                        <div>
                            <span class="text-xs font-semibold text-sky-500 block mb-2">{{ $cat['category'] }}</span>
                            <div class="flex flex-wrap gap-2" role="list" aria-label="Skills">
                                @foreach ($cat['items'] as $tech)
                                    <span
                                        role="listitem"
                                        class="stag text-sm bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 text-zinc-700 dark:text-zinc-300 px-3.5 py-1.5 rounded-full hover:border-sky-500 dark:hover:border-sky-500 transition-colors duration-200 cursor-default"
                                    >
                                        {{ $tech }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>
