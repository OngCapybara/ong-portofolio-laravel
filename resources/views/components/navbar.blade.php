<header
    x-data="{
        scrolled: false,
        isDark: document.documentElement.classList.contains('dark'),
        clicks: 0,
        registerSecretClick() {
            this.clicks++;
            if (this.clicks === 5) {
                console.log('3 klik lagi menuju Admin Mode...');
            }
            if (this.clicks >= 8) {
                this.clicks = 0;
                window.location.href = '/admin/dashboard';
            }
        }
    }"
    x-init="
        window.addEventListener('scroll', () => { scrolled = window.scrollY > 20 });
    "
    :class="scrolled
        ? 'bg-white/90 dark:bg-zinc-950/90 backdrop-blur-md shadow-sm shadow-black/5 h-16'
        : 'bg-transparent h-20'"
    class="fixed inset-x-0 top-0 z-50 transition-all duration-300"
>
    <nav class="max-w-6xl mx-auto px-6 h-full flex items-center justify-between" aria-label="Main navigation">

        <!-- Brand / Logo -->
        <a
            href="#hero"
            class="text-xl font-bold tracking-tight text-zinc-800 dark:text-zinc-100 hover:text-sky-500 transition-colors select-none"
        >
            Ong
            <!-- Hanya kata 'Azis' yang jadi trigger 8x klik rahasia -->
            <span
                @click.prevent.stop="registerSecretClick()"
                class="text-sky-500 cursor-pointer hover:underline"
                title="Secret Trigger"
            >
                Azis
            </span>
            Saliem
        </a>

        <!-- Navigation Links -->
        <ul class="hidden md:flex items-center gap-8 text-sm" role="list">
            <li>
                <a href="#services" class="nl text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white transition-colors">Services</a>
            </li>
            <li>
                <a href="#Project" class="nl text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white transition-colors">Work</a>
            </li>
            <li>
                <a href="#about" class="nl text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white transition-colors">About</a>
            </li>
            <li>
                <a href="#reviews" class="nl text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white transition-colors">Reviews</a>
            </li>
            <li>
                <a href="#blog" class="nl text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white transition-colors">Blog</a>
            </li>
            <li>
                <a href="#Contact" class="nl text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white transition-colors">Contact</a>
            </li>
        </ul>

        <!-- Action Button & Dark Mode Toggle -->
        <div class="flex items-center gap-3">
            <button
                @click="toggleDarkMode()"
                type="button"
                class="w-9 h-9 flex items-center justify-center rounded-full border border-zinc-200 dark:border-zinc-800 hover:bg-zinc-100 dark:hover:bg-zinc-900 transition-colors text-zinc-700 dark:text-zinc-300"
            >
                <svg x-show="isDark" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707M17.657 17.657l-.707-.707M6.343 6.343l-.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z"/>
                </svg>
                <svg x-show="!isDark" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/>
                </svg>
            </button>

            <a href="#Contact" class="hidden md:inline-flex items-center gap-2 shimmer bg-sky-500 text-white text-sm font-medium px-5 py-2 rounded-full hover:bg-sky-600 transition-colors">
                Hire me
            </a>
        </div>
    </nav>
</header>
