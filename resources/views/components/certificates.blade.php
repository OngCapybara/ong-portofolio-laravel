@php
    $certificates = [
        [
            'title' => 'Delegasi Proposal Kompetisi Robot SAR Nasional (KRSRI)',
            'issuer' => 'Universitas Diponegoro (UNDIP) / Kemendikbudristek',
            'year' => '2026',
            'icon' => 'fa-solid fa-robot',
        ],
        [
            'title' => 'Full-Stack Web & Mobile Application Development',
            'issuer' => 'Universitas Teknokrat Indonesia',
            'year' => '2025',
            'icon' => 'fa-solid fa-code',
        ],
        [
            'title' => 'Embedded Systems & Microcontroller Programming',
            'issuer' => 'Laboratorium Robotika & Elektronika',
            'year' => '2025',
            'icon' => 'fa-solid fa-microchip',
        ],
    ];
@endphp

<section id="certificates" class="py-24 bg-white dark:bg-zinc-950">
    <div class="max-w-6xl mx-auto px-6">

        <!-- Section Header -->
        <div class="mb-14">
            <p class="text-xs font-medium text-sky-500 tracking-widest uppercase mb-3">Achievements</p>
            <h2 class="font-display font-bold text-4xl md:text-5xl text-zinc-900 dark:text-white">Certificates &amp; Awards</h2>
        </div>

        <!-- Horizontal Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($certificates as $cert)
                <article class="group flex items-start gap-4 bg-zinc-50 dark:bg-zinc-900 rounded-2xl p-6 border border-zinc-200/70 dark:border-zinc-800 hover:border-sky-500 hover:shadow-lg transition-all duration-300">
                    <!-- Badge Icon -->
                    <div class="w-12 h-12 rounded-xl bg-sky-500/10 flex items-center justify-center text-sky-500 shrink-0 group-hover:bg-sky-500 group-hover:text-white transition-colors duration-300">
                        <i class="{{ $cert['icon'] }} text-lg" aria-hidden="true"></i>
                    </div>

                    <!-- Info -->
                    <div class="flex-1 min-w-0">
                        <span class="inline-block text-xs font-semibold text-sky-500 mb-1">
                            {{ $cert['year'] }}
                        </span>
                        <h3 class="font-display font-bold text-base text-zinc-900 dark:text-white leading-snug mb-1.5 group-hover:text-sky-500 transition-colors">
                            {{ $cert['title'] }}
                        </h3>
                        <p class="text-xs text-zinc-500 dark:text-zinc-400">
                            {{ $cert['issuer'] }}
                        </p>
                    </div>
                </article>
            @endforeach
        </div>

    </div>
</section>
