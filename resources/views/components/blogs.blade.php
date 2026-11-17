@props(['articles' => []])

<section id="blog" class="py-24 bg-zinc-50 dark:bg-zinc-900/40">
    <div class="max-w-6xl mx-auto px-6">

        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-14">
            <div>
                <p class="text-xs font-medium text-sky-500 tracking-widest uppercase mb-3">Thoughts</p>
                <h2 class="font-display font-bold text-4xl md:text-5xl text-zinc-900 dark:text-white">From the blog</h2>
            </div>
            <a
                href="/blog"
                class="text-sm font-medium text-zinc-500 dark:text-zinc-400 hover:text-sky-500 transition-colors self-start sm:self-auto nl"
            >
                All articles →
            </a>
        </div>

        <!-- Grid Articles -->
        <div class="grid md:grid-cols-3 gap-6">
            @forelse ($articles as $art)
                <article class="card-h group bg-white dark:bg-zinc-900 rounded-2xl overflow-hidden border border-zinc-100 dark:border-zinc-800 hover:border-sky-500 transition-all duration-300">

                    <!-- Image Container -->
                    <div class="pf w-full h-44 overflow-hidden bg-zinc-200">
                        <img
                            src="{{ $art->image_url }}"
                            alt="{{ $art->title }}"
                            loading="lazy"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                        />
                    </div>

                    <!-- Content Box -->
                    <div class="p-6">
                        <div class="flex items-center gap-3 mb-3">
                            <span class="text-xs bg-sky-50 dark:bg-zinc-800 text-sky-500 border border-sky-200 dark:border-zinc-700 px-2.5 py-1 rounded-full font-medium">
                                {{ $art->category }}
                            </span>
                            <span class="text-xs text-zinc-400">
                                {{ $art->date_published }}
                            </span>
                        </div>

                        <a href="/blog/{{ $art->slug }}">
                            <h3 class="font-display font-bold text-lg text-zinc-900 dark:text-white mb-2 group-hover:text-sky-500 transition-colors duration-200 leading-snug">
                                {{ $art->title }}
                            </h3>
                        </a>

                        <p class="text-sm text-zinc-500 dark:text-zinc-400 leading-relaxed mb-4 line-clamp-3">
                            {{ $art->description }}
                        </p>

                        <a
                            href="/blog/{{ $art->slug }}"
                            class="inline-flex items-center gap-1.5 text-sm font-medium text-zinc-900 dark:text-white nl"
                        >
                            Read more →
                        </a>
                    </div>
                </article>
            @empty
                <p class="text-zinc-500 col-span-3 text-center">Belum ada artikel blog yang diterbitkan.</p>
            @endforelse
        </div>

    </div>
</section>
