@php
    $reviews = [
        [
            'id' => 1,
            'name' => 'M. Reynaldi',
            'role' => 'Mahasiswa, Teknologi Informasi',
            'feedback' => '"Ong membantu saya menyelesaikan tugas akhir kuliah dengan cepat dan baik. Menggunakan teknologi PostgreSQL dan Prisma ORM. Saya dapat nilai A!"',
            'img' => 'https://i.pravatar.cc/80?img=11',
            'isHighlighted' => false,
        ],
        [
            'id' => 2,
            'name' => 'Astika',
            'role' => 'Mahasiswi, Teknik Komputer',
            'feedback' => '"Saya mendapatkan tugas akhir untuk membuat aplikasi mobile. Ong sangat membantu saya yang sedang keteteran. Good Job!"',
            'img' => 'https://i.pravatar.cc/80?img=5',
            'isHighlighted' => true,
        ],
    ];
@endphp

<section id="reviews" class="py-24 bg-white dark:bg-zinc-950">
    <div class="max-w-6xl mx-auto px-6">

        <!-- Section Header -->
        <div class="mb-14">
            <p class="text-xs font-medium text-sky-500 tracking-widest uppercase mb-3">Social proof</p>
            <h2 class="font-display font-bold text-4xl md:text-5xl text-zinc-900 dark:text-white">What clients say</h2>
        </div>

        <!-- Grid Testimonials -->
        <div class="grid md:grid-cols-3 gap-6">
            @foreach ($reviews as $rev)
                <blockquote
                    class="card-h rounded-2xl p-7 border transition-all duration-300 {{ $rev['isHighlighted'] ? 'bg-zinc-900 dark:bg-zinc-800 border-zinc-800 hover:border-sky-500' : 'bg-zinc-50 dark:bg-zinc-900 border-zinc-100 dark:border-zinc-800 hover:border-sky-500' }}"
                >
                    <!-- Rating Bintang 5 -->
                    <div class="flex gap-0.5 mb-5" aria-label="5 stars">
                        @for ($i = 0; $i < 5; $i++)
                            <svg
                                class="w-4 h-4 text-sky-500 fill-current"
                                viewBox="0 0 20 20"
                                aria-hidden="true"
                            >
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        @endfor
                    </div>

                    <!-- Isi Feedback -->
                    <p class="text-sm leading-relaxed mb-6 italic {{ $rev['isHighlighted'] ? 'text-zinc-400' : 'text-zinc-600 dark:text-zinc-400' }}">
                        {{ $rev['feedback'] }}
                    </p>

                    <!-- User Info / Footer Kartu -->
                    <footer class="flex items-center gap-3">
                        <div class="pf w-10 h-10 rounded-full shrink-0 overflow-hidden bg-zinc-200">
                            <img src="{{ $rev['img'] }}" alt="{{ $rev['name'] }}" loading="lazy" class="w-full h-full object-cover" />
                        </div>
                        <div>
                            <p class="font-medium text-sm {{ $rev['isHighlighted'] ? 'text-white' : 'text-zinc-900 dark:text-white' }}">
                                {{ $rev['name'] }}
                            </p>
                            <p class="text-xs text-zinc-500">
                                {{ $rev['role'] }}
                            </p>
                        </div>
                    </footer>
                </blockquote>
            @endforeach
        </div>

    </div>
</section>
