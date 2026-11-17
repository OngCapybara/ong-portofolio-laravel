<section id="hero" class="relative min-h-screen flex items-center pt-16 overflow-hidden bg-white dark:bg-zinc-950">
    <div class="absolute top-1/4 right-0 w-96 h-96 bg-sky-500/10 rounded-full blur-3xl pointer-events-none" aria-hidden="true"></div>
    <div class="absolute bottom-1/4 left-0 w-64 h-64 bg-zinc-200/50 dark:bg-zinc-800/30 rounded-full blur-3xl pointer-events-none" aria-hidden="true"></div>

    <div class="relative z-10 max-w-6xl mx-auto px-6 py-24 w-full">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div>
                <p class="text-sm font-medium text-sky-500 tracking-widest uppercase mb-3">Available for work</p>
                <h1 class="font-display font-bold text-5xl md:text-6xl lg:text-7xl leading-[1.05] tracking-tight text-zinc-900 dark:text-white mb-4">
                    Hi, I'm <br><span class="text-sky-500">Ong Azis Saliem</span>
                </h1>
                <p class="text-base md:text-lg font-semibold text-zinc-700 dark:text-zinc-200 mb-4">
                    Informatics Student | Full-Stack &amp; Robotics Developer
                </p>
                <p class="text-base md:text-lg text-zinc-500 dark:text-zinc-400 font-light leading-relaxed max-w-lg mb-8">
                    Mahasiswa S1 Informatika Universitas Teknokrat Indonesia yang berfokus membangun produk digital berbasis web &amp; mobile yang cepat, bersih, serta sistem otonom berbasis mikrokontroler dan robotika.
                </p>

                <!-- Tombol CTA -->
                <div class="flex flex-wrap gap-4 mb-8">
                    <a href="#projects" class="shimmer inline-flex items-center gap-2 bg-zinc-900 dark:bg-white text-white dark:text-zinc-900 font-medium px-7 py-3.5 rounded-full hover:bg-zinc-700 dark:hover:bg-zinc-200 transition-colors text-sm">
                        View my work
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </a>
                    <a href="{{ asset('CV_Ong.pdf') }}" target="_blank" class="inline-flex items-center gap-2 border border-zinc-300 dark:border-zinc-700 text-zinc-700 dark:text-zinc-300 font-medium px-7 py-3.5 rounded-full hover:bg-zinc-50 dark:hover:bg-zinc-900 transition-colors text-sm">
                        Download CV
                    </a>
                </div>

                <!-- Ikon Sosial Media -->
                <div class="flex items-center gap-3 mb-10">
                    <a href="https://github.com/OngCapybara" target="_blank" rel="noopener noreferrer" aria-label="GitHub" class="w-10 h-10 flex items-center justify-center rounded-full border border-zinc-200 dark:border-zinc-800 text-zinc-600 dark:text-zinc-400 hover:border-sky-500 hover:text-sky-500 transition-colors">
                        <i class="fa-brands fa-github text-lg" aria-hidden="true"></i>
                    </a>
                    <a href="https://linkedin.com/in/ong-azis-saliem" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn" class="w-10 h-10 flex items-center justify-center rounded-full border border-zinc-200 dark:border-zinc-800 text-zinc-600 dark:text-zinc-400 hover:border-sky-500 hover:text-sky-500 transition-colors">
                        <i class="fa-brands fa-linkedin-in text-lg" aria-hidden="true"></i>
                    </a>
                    <a href="mailto:ongazissaliem.sama@gmail.com" aria-label="Email" class="w-10 h-10 flex items-center justify-center rounded-full border border-zinc-200 dark:border-zinc-800 text-zinc-600 dark:text-zinc-400 hover:border-sky-500 hover:text-sky-500 transition-colors">
                        <i class="fa-solid fa-envelope text-base" aria-hidden="true"></i>
                    </a>
                </div>

                <!-- Statistik -->
                <div class="flex gap-8 pt-8 border-t border-zinc-100 dark:border-zinc-900">
                    <div>
                        <p class="font-display font-bold text-3xl text-zinc-900 dark:text-white">10+</p>
                        <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">Projects done</p>
                    </div>
                    <div>
                        <p class="font-display font-bold text-3xl text-zinc-900 dark:text-white">2+</p>
                        <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">Collaborations</p>
                    </div>
                </div>
            </div>

            <!-- Foto Profil Lingkaran -->
            <div class="flex justify-center md:justify-end">
                <div class="relative w-72 h-72 md:w-80 md:h-80 lg:w-96 lg:h-96">
                    <div class="pf w-full h-full rounded-full overflow-hidden bg-zinc-200 ring-4 ring-sky-500/20 shadow-2xl">
                        <img src="{{ asset('assets/atmin/ongganteng.JPG') }}" alt="Ong Azis Saliem" loading="eager" class="w-full h-full object-cover" />
                    </div>
                    <div class="absolute bottom-2 left-2 bg-sky-500 text-white font-display font-bold text-sm px-4 py-2 rounded-full shadow-lg">
                        Open to projects
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
