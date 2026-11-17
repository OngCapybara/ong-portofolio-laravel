<header
    x-data="{
        scrolled: false,
        mobileOpen: false,
        isDark: document.documentElement.classList.contains('dark'),
        clicks: 0,
        toggleDarkMode() {
            this.isDark = !this.isDark;
            if (this.isDark) {
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            } else {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            }
        },
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
    :class="(scrolled || mobileOpen)
        ? 'bg-white/95 dark:bg-zinc-950/95 backdrop-blur-md shadow-sm shadow-black/5'
        : 'bg-transparent'"
    class="fixed inset-x-0 top-0 z-50 transition-all duration-300"
>
    <nav class="max-w-6xl mx-auto px-6 h-16 md:h-20 flex items-center justify-between" aria-label="Main navigation">

        <!-- Brand / Logo -->
        <a
            href="#hero"
            @click="mobileOpen = false"
            class="text-xl font-bold tracking-tight text-zinc-800 dark:text-zinc-100 hover:text-sky-500 transition-colors select-none"
        >
            Ong
            <span
                @click.prevent.stop="registerSecretClick()"
                class="text-sky-500 cursor-pointer hover:underline"
                title="Secret Trigger"
            >
                Azis
            </span>
            Saliem
        </a>

        <!-- Navigation Links (Desktop) -->
        <ul class="hidden md:flex items-center gap-7 text-sm" role="list">
            <li>
                <a href="#about" class="nl text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white transition-colors">About</a>
            </li>
            <li>
                <a href="#skills" class="nl text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white transition-colors">Skills</a>
            </li>
            <li>
                <a href="#projects" class="nl text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white transition-colors">Projects</a>
            </li>
            <li>
                <a href="#experience" class="nl text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white transition-colors">Experience</a>
            </li>
            <li>
                <a href="#certificates" class="nl text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white transition-colors">Certificates</a>
            </li>
            <li>
                <a href="#contact" class="nl text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white transition-colors">Contact</a>
            </li>
        </ul>

        <!-- Action Buttons: Theme Toggle, Hire Me & Mobile Hamburger -->
        <div class="flex items-center gap-3">
            <!-- Dark Mode Toggle -->
            <button
                @click="toggleDarkMode()"
                type="button"
                aria-label="Toggle Dark Mode"
                class="w-9 h-9 flex items-center justify-center rounded-full border border-zinc-200 dark:border-zinc-800 hover:bg-zinc-100 dark:hover:bg-zinc-900 transition-colors text-zinc-700 dark:text-zinc-300 cursor-pointer"
            >
                <svg x-show="isDark" class="w-4 h-4 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707M17.657 17.657l-.707-.707M6.343 6.343l-.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z"/>
                </svg>
                <svg x-show="!isDark" x-cloak class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/>
                </svg>
            </button>

            <!-- CTA Desktop -->
            <a href="#contact" class="hidden md:inline-flex items-center gap-2 shimmer bg-sky-500 text-white text-sm font-medium px-5 py-2 rounded-full hover:bg-sky-600 transition-colors">
                Hire me
            </a>

            <!-- Hamburger Button (Mobile Only) -->
            <button
                id="hamburger"
                @click="mobileOpen = !mobileOpen"
                :aria-expanded="mobileOpen"
                type="button"
                aria-label="Toggle navigation menu"
                class="md:hidden w-9 h-9 flex items-center justify-center rounded-full border border-zinc-200 dark:border-zinc-800 text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-900 transition-colors"
            >
                <svg x-show="!mobileOpen" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg x-show="mobileOpen" x-cloak class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </nav>

    <!-- Mobile Dropdown Menu -->
    <div
        x-show="mobileOpen"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        @click.outside="mobileOpen = false"
        x-cloak
        class="md:hidden bg-white dark:bg-zinc-950 border-b border-zinc-200 dark:border-zinc-800 px-6 py-5 shadow-xl"
    >
        <ul class="flex flex-col gap-4 text-sm font-medium">
            <li><a href="#about" @click="mobileOpen = false" class="block text-zinc-600 dark:text-zinc-300 hover:text-sky-500 transition-colors">About</a></li>
            <li><a href="#skills" @click="mobileOpen = false" class="block text-zinc-600 dark:text-zinc-300 hover:text-sky-500 transition-colors">Skills</a></li>
            <li><a href="#projects" @click="mobileOpen = false" class="block text-zinc-600 dark:text-zinc-300 hover:text-sky-500 transition-colors">Projects</a></li>
            <li><a href="#experience" @click="mobileOpen = false" class="block text-zinc-600 dark:text-zinc-300 hover:text-sky-500 transition-colors">Experience</a></li>
            <li><a href="#certificates" @click="mobileOpen = false" class="block text-zinc-600 dark:text-zinc-300 hover:text-sky-500 transition-colors">Certificates</a></li>
            <li><a href="#contact" @click="mobileOpen = false" class="block text-zinc-600 dark:text-zinc-300 hover:text-sky-500 transition-colors">Contact</a></li>
            <li class="pt-2 border-t border-zinc-100 dark:border-zinc-900">
                <a href="#contact" @click="mobileOpen = false" class="w-full inline-flex justify-center items-center bg-sky-500 text-white font-semibold py-2.5 rounded-xl hover:bg-sky-600 transition-colors">
                    Hire me
                </a>
            </li>
        </ul>
    </div>
</header>
