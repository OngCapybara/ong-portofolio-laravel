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

        <!-- Target Kontainer Dinamis Fetch API -->
        <div id="certificates-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"></div>

    </div>
</section>
