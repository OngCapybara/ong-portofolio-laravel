/**
 * PORTFOLIO FETCH ENGINE — Ong Azis Saliem
 * Asynchronous Data Integrator & DOM Renderer (Latihan 6)
 */

const API_BASE_URL = '/api/portfolio';

// 1. Helper Loading Skeleton (Shimmer UI)
// 1. Helper Loading Skeleton (Shimmer UI)
function renderSkeleton(containerId, count = 3, cardType = 'project') {
    const container = document.getElementById(containerId);
    if (!container) return;

    let skeletonHTML = '';
    for (let i = 0; i < count; i++) {
        if (cardType === 'skill') {
            skeletonHTML += `
                <div class="animate-pulse bg-white dark:bg-zinc-900/80 p-4 rounded-2xl border border-zinc-200/70 dark:border-zinc-800 space-y-3">
                    <div class="h-3 bg-zinc-200 dark:bg-zinc-700 rounded w-1/3"></div>
                    <div class="flex flex-wrap gap-2">
                        <div class="h-7 bg-zinc-200 dark:bg-zinc-700 rounded-full w-24"></div>
                        <div class="h-7 bg-zinc-200 dark:bg-zinc-700 rounded-full w-20"></div>
                        <div class="h-7 bg-zinc-200 dark:bg-zinc-700 rounded-full w-28"></div>
                    </div>
                </div>
            `;
        } else if (cardType === 'certificate') {
            skeletonHTML += `
                <div class="animate-pulse flex items-start gap-4 bg-zinc-50 dark:bg-zinc-900 rounded-2xl p-6 border border-zinc-200/70 dark:border-zinc-800">
                    <div class="w-12 h-12 rounded-xl bg-zinc-200 dark:bg-zinc-800 shrink-0"></div>
                    <div class="flex-1 space-y-2.5">
                        <div class="h-3 bg-zinc-200 dark:bg-zinc-800 rounded w-14"></div>
                        <div class="h-4 bg-zinc-200 dark:bg-zinc-800 rounded w-5/6"></div>
                        <div class="h-3 bg-zinc-200/70 dark:bg-zinc-800/70 rounded w-2/3"></div>
                    </div>
                </div>
            `;
        } else {
            skeletonHTML += `
                <div class="animate-pulse bg-zinc-50 dark:bg-zinc-900 rounded-2xl overflow-hidden border border-zinc-100 dark:border-zinc-800">
                    <div class="bg-zinc-200 dark:bg-zinc-800 aspect-video w-full"></div>
                    <div class="p-6 space-y-3">
                        <div class="h-5 bg-zinc-200 dark:bg-zinc-800 rounded w-3/4"></div>
                        <div class="h-3 bg-zinc-200/70 dark:bg-zinc-800/70 rounded w-full"></div>
                        <div class="h-3 bg-zinc-200/70 dark:bg-zinc-800/70 rounded w-5/6"></div>
                        <div class="pt-2 flex gap-2">
                            <div class="h-6 bg-zinc-200 dark:bg-zinc-800 rounded-full w-16"></div>
                            <div class="h-6 bg-zinc-200 dark:bg-zinc-800 rounded-full w-20"></div>
                        </div>
                    </div>
                </div>
            `;
        }
    }
    container.innerHTML = skeletonHTML;
}


// 2. Fetch & Render Skills (GET /api/portfolio/skills)
async function loadSkills() {
    const container = document.getElementById('skills-container');
    if (!container) return;

    renderSkeleton('skills-container', 4, 'skill');

    try {
        const response = await fetch(`${API_BASE_URL}/skills`, {
            headers: { 'Accept': 'application/json' }
        });
        if (!response.ok) throw new Error(`HTTP Error: ${response.status}`);

        const result = await response.json();
        const skills = result.data || [];

        if (skills.length === 0) {
            container.innerHTML = `<p class="col-span-full text-center text-zinc-500 py-6 text-sm">Belum ada keahlian yang ditambahkan ke database.</p>`;
            return;
        }

        // Kelompokkan skills berdasarkan kategori (Frontend, Backend, Database, Tools)
        const grouped = skills.reduce((acc, skill) => {
            const cat = skill.category || 'Lainnya';
            if (!acc[cat]) acc[cat] = [];
            acc[cat].push(skill);
            return acc;
        }, {});

        const categoryOrder = ['Frontend', 'Backend', 'Database', 'Tools'];
        const sortedCategories = Object.keys(grouped).sort((a, b) => {
            const idxA = categoryOrder.indexOf(a);
            const idxB = categoryOrder.indexOf(b);
            return (idxA === -1 ? 99 : idxA) - (idxB === -1 ? 99 : idxB);
        });

        container.innerHTML = sortedCategories.map(category => `
            <div class="bg-white dark:bg-zinc-900/80 p-4 rounded-2xl border border-zinc-200/70 dark:border-zinc-800">
                <span class="text-xs font-bold text-sky-500 uppercase tracking-wider block mb-3">
                    ${category}
                </span>
                <div class="flex flex-wrap gap-2" role="list" aria-label="${category} Skills">
                    ${grouped[category].map(tech => `
                        <span
                            role="listitem"
                            title="Level: ${tech.level || 'Intermediate'}"
                            class="stag inline-flex items-center gap-1.5 text-xs font-medium bg-zinc-50 dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 text-zinc-700 dark:text-zinc-300 px-3 py-1.5 rounded-full hover:border-sky-500 dark:hover:border-sky-500 transition-colors duration-200 cursor-default"
                        >
                            <i class="${tech.icon || 'fa-solid fa-code'} text-sky-500 text-[11px]" aria-hidden="true"></i>
                            <span>${tech.name}</span>
                            <span class="text-[10px] px-1.5 py-0.2 rounded-full ${
                                tech.level === 'Advanced'
                                    ? 'bg-sky-500/15 text-sky-500'
                                    : 'bg-zinc-200/70 dark:bg-zinc-700 text-zinc-500 dark:text-zinc-400'
                            }">${tech.level || 'Intermediate'}</span>
                        </span>
                    `).join('')}
                </div>
            </div>
        `).join('');
    } catch (error) {
        console.error('Gagal memuat skills:', error);
        container.innerHTML = `
            <div class="col-span-full bg-red-500/10 border border-red-500/30 text-red-500 p-4 rounded-xl text-center text-xs">
                Gagal memuat data keahlian dari server. Pastikan server Laravel aktif.
            </div>
        `;
    }
}

// 3. Fetch & Render Projects + Live Debounced Search (GET /api/portfolio/projects)
let allProjectsData = [];

async function loadProjects() {
    const container = document.getElementById('projects-container');
    if (!container) return;

    renderSkeleton('projects-container', 3, 'project');

    try {
        const response = await fetch(`${API_BASE_URL}/projects`, {
            headers: { 'Accept': 'application/json' }
        });
        if (!response.ok) throw new Error(`HTTP Error: ${response.status}`);

        const result = await response.json();
        allProjectsData = result.data || [];

        renderProjectCards(allProjectsData);
    } catch (error) {
        console.error('Gagal memuat projects:', error);
        container.innerHTML = `
            <div class="col-span-full bg-red-50 dark:bg-red-950/50 border border-red-200 dark:border-red-800 text-red-600 dark:text-red-400 p-4 rounded-lg text-center text-sm">
                Gagal memuat daftar proyek dari API.
            </div>
        `;
    }
}

function renderProjectCards(projects) {
    const container = document.getElementById('projects-container');
    if (!container) return;

    if (projects.length === 0) {
        container.innerHTML = `
            <div class="col-span-full text-center py-12 bg-zinc-50 dark:bg-zinc-900 rounded-2xl border border-dashed border-zinc-300 dark:border-zinc-800">
                <p class="text-zinc-500 dark:text-zinc-400 text-sm font-medium">Tidak ada proyek yang sesuai dengan kriteria pencarian.</p>
            </div>
        `;
        return;
    }

    container.innerHTML = projects.map(project => {
        const skillsList = Array.isArray(project.skills) ? project.skills : [];
        const fallbackImg = `https://placehold.co/640x360/09090b/0ea5e9?text=${encodeURIComponent(project.title)}`;
        const projectImg = project.thumbnail_url || fallbackImg;
        const demoUrl = project.demo_url || project.github_url || 'https://github.com/OngCapybara';
        const githubUrl = project.github_url || 'https://github.com/OngCapybara';

        return `
            <article class="group bg-zinc-50 dark:bg-zinc-900 rounded-2xl overflow-hidden border border-zinc-100 dark:border-zinc-800 hover:border-sky-500 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col">

                <!-- Thumbnail 16:9 + Fallback onerror -->
                <div class="relative w-full aspect-video overflow-hidden bg-zinc-200 dark:bg-zinc-800">
                    <img
                        src="${projectImg}"
                        alt="${project.title}"
                        loading="lazy"
                        onerror="this.onerror=null;this.src='${fallbackImg}';"
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                    />
                    ${project.is_featured ? `
                        <span class="absolute top-3 right-3 bg-sky-500/95 backdrop-blur-sm text-white text-[11px] font-semibold px-2.5 py-1 rounded-full shadow-sm">
                            Featured
                        </span>
                    ` : ''}
                </div>

                <!-- Content -->
                <div class="p-6 flex flex-col flex-1">
                    <h3 class="font-display font-bold text-xl text-zinc-900 dark:text-white mb-2.5 group-hover:text-sky-500 transition-colors">
                        ${project.title}
                    </h3>

                    <p class="text-sm text-zinc-500 dark:text-zinc-400 leading-relaxed mb-5 line-clamp-3">
                        ${project.summary || project.description || 'Deskripsi proyek belum diisi.'}
                    </p>

                    <!-- Tech Badges -->
                    <div class="flex flex-wrap gap-2 mb-6 mt-auto">
                        ${skillsList.map(skill => `
                            <span class="text-xs bg-sky-50 dark:bg-zinc-800 text-sky-600 dark:text-sky-400 border border-sky-200/70 dark:border-zinc-700 px-2.5 py-1 rounded-full font-medium">
                                #${skill.name.replace(/\s+/g, '')}
                            </span>
                        `).join('')}
                    </div>

                    <!-- Action Links -->
                    <div class="flex items-center gap-3 pt-4 border-t border-zinc-200/70 dark:border-zinc-800">
                        <a
                            href="${demoUrl}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="flex-1 inline-flex items-center justify-center gap-1.5 bg-sky-500 hover:bg-sky-600 text-white text-xs font-semibold py-2.5 px-4 rounded-xl transition-colors"
                        >
                            <i class="fa-solid fa-arrow-up-right-from-square text-[11px]" aria-hidden="true"></i>
                            Live Demo
                        </a>
                        <a
                            href="${githubUrl}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="flex-1 inline-flex items-center justify-center gap-1.5 bg-white dark:bg-zinc-800 hover:bg-zinc-100 dark:hover:bg-zinc-700 text-zinc-800 dark:text-zinc-200 border border-zinc-200 dark:border-zinc-700 text-xs font-semibold py-2.5 px-4 rounded-xl transition-colors"
                        >
                            <i class="fa-brands fa-github text-sm" aria-hidden="true"></i>
                            GitHub
                        </a>
                    </div>
                </div>

            </article>
        `;
    }).join('');
}

function debounce(func, wait = 400) {
    let timeout;
    return function executedFunction(...args) {
        clearTimeout(timeout);
        timeout = setTimeout(() => func(...args), wait);
    };
}

const searchInput = document.getElementById('search-project');
if (searchInput) {
    searchInput.addEventListener('input', debounce((e) => {
        const keyword = e.target.value.toLowerCase().trim();
        const filtered = allProjectsData.filter(proj => {
            const matchTitle = (proj.title || '').toLowerCase().includes(keyword);
            const matchSummary = (proj.summary || '').toLowerCase().includes(keyword);
            const matchTech = (proj.skills || []).some(s => (s.name || '').toLowerCase().includes(keyword));
            return matchTitle || matchSummary || matchTech;
        });
        renderProjectCards(filtered);
    }, 400));
}

// 4. Fetch & Render Certificates (GET /api/portfolio/certificates)
async function loadCertificates() {
    const container = document.getElementById('certificates-container');
    if (!container) return;

    renderSkeleton('certificates-container', 3, 'certificate');

    try {
        const response = await fetch(`${API_BASE_URL}/certificates`, {
            headers: { 'Accept': 'application/json' }
        });
        if (!response.ok) throw new Error(`HTTP Error: ${response.status}`);

        const result = await response.json();
        const certs = result.data || [];

        if (certs.length === 0) {
            container.innerHTML = `<p class="col-span-full text-center text-zinc-500 py-6 text-sm">Belum ada sertifikat yang ditambahkan.</p>`;
            return;
        }

        container.innerHTML = certs.map(cert => {
            const year = cert.issued_date ? String(cert.issued_date).substring(0, 4) : 'Terverifikasi';

            return `
                <article class="group flex items-start gap-4 bg-zinc-50 dark:bg-zinc-900 rounded-2xl p-6 border border-zinc-200/70 dark:border-zinc-800 hover:border-sky-500 hover:shadow-lg transition-all duration-300">
                    <!-- Badge Icon -->
                    <div class="w-12 h-12 rounded-xl bg-sky-500/10 flex items-center justify-center text-sky-500 shrink-0 group-hover:bg-sky-500 group-hover:text-white transition-colors duration-300">
                        <i class="fa-solid fa-award text-lg" aria-hidden="true"></i>
                    </div>

                    <!-- Info -->
                    <div class="flex-1 min-w-0">
                        <span class="inline-block text-xs font-semibold text-sky-500 mb-1">
                            ${year}
                        </span>
                        <h3 class="font-display font-bold text-base text-zinc-900 dark:text-white leading-snug mb-1.5 group-hover:text-sky-500 transition-colors">
                            ${cert.title}
                        </h3>
                        <p class="text-xs text-zinc-500 dark:text-zinc-400 mb-2">
                            ${cert.issuer}
                        </p>
                        ${cert.credential_url ? `
                            <a href="${cert.credential_url}" target="_blank" rel="noopener noreferrer" class="text-[11px] font-semibold text-sky-500 hover:underline inline-flex items-center gap-1">
                                Lihat Kredensial ↗
                            </a>
                        ` : ''}
                    </div>
                </article>
            `;
        }).join('');
    } catch (error) {
        console.error('Gagal memuat sertifikat:', error);
        container.innerHTML = `
            <div class="col-span-full bg-red-500/10 border border-red-500/30 text-red-500 p-4 rounded-xl text-center text-xs">
                Gagal memuat data sertifikat dari server.
            </div>
        `;
    }
}

// 5. Form Kontak POST Fetch + Inline Validation 422 + Toast Notification
const contactForm = document.getElementById('contact-form');
if (contactForm) {
    contactForm.addEventListener('submit', async function (e) {
        e.preventDefault();
        resetFormErrors();
        setSubmitLoading(true);

        const payload = {
            sender_name:  document.getElementById('sender_name').value.trim(),
            sender_email: document.getElementById('sender_email').value.trim(),
            subject:      document.getElementById('subject').value.trim(),
            body:         document.getElementById('body').value.trim(),
        };

        try {
            const response = await fetch(`${API_BASE_URL}/messages`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(payload)
            });

            const result = await response.json();

            if (response.status === 201 || response.ok) {
                showToast('success', result.message || 'Pesan Anda berhasil dikirim!');
                contactForm.reset();
            } else if (response.status === 422) {
                displayValidationErrors(result.errors || {});
                showToast('error', result.message || 'Mohon periksa kembali kolom formulir yang bertanda merah.');
            } else if (response.status === 429) {
                showToast('error', 'Terlalu banyak pesan dikirim dalam waktu singkat. Mohon tunggu 1 menit.');
            } else {
                showToast('error', result.message || 'Terjadi kesalahan pada server saat mengirim pesan.');
            }
        } catch (error) {
            console.error('Fetch error:', error);
            showToast('error', 'Gagal terhubung ke server. Periksa koneksi internet atau server backend.');
        } finally {
            setSubmitLoading(false);
        }
    });
}

function showToast(type, message) {
    const toast = document.getElementById('toast-notification');
    if (!toast) return;

    toast.className = 'mb-6 p-4 rounded-xl text-sm font-medium transition-all duration-300 block';
    if (type === 'success') {
        toast.classList.add('bg-emerald-50', 'dark:bg-emerald-950/60', 'text-emerald-700', 'dark:text-emerald-300', 'border', 'border-emerald-200', 'dark:border-emerald-800');
        toast.innerHTML = `✅ <strong>Berhasil!</strong> ${message}`;
    } else {
        toast.classList.add('bg-rose-50', 'dark:bg-rose-950/60', 'text-rose-700', 'dark:text-rose-300', 'border', 'border-rose-200', 'dark:border-rose-800');
        toast.innerHTML = `⚠️ <strong>Pemberitahuan:</strong> ${message}`;
    }
    toast.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
}

function displayValidationErrors(errors) {
    for (const [field, messages] of Object.entries(errors)) {
        const errorElement = document.getElementById(`error-${field}`);
        const inputElement = document.getElementById(field);

        if (errorElement) {
            errorElement.innerText = messages[0];
            errorElement.classList.remove('hidden');
        }
        if (inputElement) {
            inputElement.classList.add('border-red-500', 'focus:ring-red-400');
        }
    }
}

function resetFormErrors() {
    document.querySelectorAll('[id^="error-"]').forEach(el => {
        el.innerText = '';
        el.classList.add('hidden');
    });
    document.querySelectorAll('#contact-form input, #contact-form textarea').forEach(input => {
        input.classList.remove('border-red-500', 'focus:ring-red-400');
    });
    const toast = document.getElementById('toast-notification');
    if (toast) toast.classList.add('hidden');
}

function setSubmitLoading(isLoading) {
    const btn = document.getElementById('btn-submit-message');
    const text = document.getElementById('btn-text');
    const spinner = document.getElementById('btn-spinner');

    if (!btn) return;
    btn.disabled = isLoading;
    if (text) text.innerText = isLoading ? 'Mengirim Pesan...' : 'Kirim Pesan Sekarang';
    if (spinner) spinner.classList.toggle('hidden', !isLoading);
}

// 6. Integrasi API Publik Eksternal: GitHub REST API
async function loadGitHubStats(username = 'OngCapybara') {
    const container = document.getElementById('github-stats-container');
    if (!container) return;

    try {
        const response = await fetch(`https://api.github.com/users/${username}`);
        if (!response.ok) return;

        const data = await response.json();
        container.innerHTML = `
            <a href="${data.html_url}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-3 bg-slate-900 dark:bg-slate-800 text-white px-4 py-2.5 rounded-xl border border-slate-700 hover:bg-slate-800 transition-colors shadow-sm text-xs sm:text-sm">
                <img src="${data.avatar_url}" alt="GitHub Avatar" class="w-7 h-7 rounded-full border border-slate-600">
                <div class="flex flex-wrap items-center gap-2">
                    <span class="font-semibold text-sky-400">@${data.login}</span>
                    <span class="text-slate-500">•</span>
                    <span class="text-slate-200">${data.public_repos} Public Repos</span>
                    <span class="text-slate-500">•</span>
                    <span class="text-slate-200">${data.followers} Followers</span>
                </div>
            </a>
        `;
    } catch (e) {
        console.warn('Gagal memuat GitHub Stats:', e);
    }
}

// Inisialisasi Semua Module Saat DOM Siap
document.addEventListener('DOMContentLoaded', () => {
    loadSkills();
    loadProjects();
    loadCertificates();
    loadGitHubStats('OngCapybara');
});
