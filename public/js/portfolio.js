/**
 * PORTFOLIO FETCH ENGINE — Ong Azis Saliem
 * Asynchronous Data Integrator & DOM Renderer (Latihan 6)
 */

const API_BASE_URL = '/api/portfolio';

// 1. Helper Loading Skeleton (Shimmer UI)
function renderSkeleton(containerId, count = 3, cardType = 'project') {
    const container = document.getElementById(containerId);
    if (!container) return;

    let skeletonHTML = '';
    for (let i = 0; i < count; i++) {
        if (cardType === 'skill') {
            skeletonHTML += `
                <div class="animate-pulse bg-white dark:bg-slate-800 p-4 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 flex items-center space-x-3">
                    <div class="rounded-lg bg-slate-200 dark:bg-slate-700 h-10 w-10"></div>
                    <div class="flex-1 space-y-2">
                        <div class="h-4 bg-slate-200 dark:bg-slate-700 rounded w-3/4"></div>
                        <div class="h-3 bg-slate-100 dark:bg-slate-600 rounded w-1/2"></div>
                    </div>
                </div>
            `;
        } else {
            skeletonHTML += `
                <div class="animate-pulse bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
                    <div class="bg-slate-200 dark:bg-slate-700 h-44 w-full"></div>
                    <div class="p-5 space-y-3">
                        <div class="h-5 bg-slate-200 dark:bg-slate-700 rounded w-2/3"></div>
                        <div class="h-3 bg-slate-100 dark:bg-slate-600 rounded w-full"></div>
                        <div class="h-3 bg-slate-100 dark:bg-slate-600 rounded w-4/5"></div>
                        <div class="pt-2 flex gap-2">
                            <div class="h-6 bg-slate-200 dark:bg-slate-700 rounded-full w-14"></div>
                            <div class="h-6 bg-slate-200 dark:bg-slate-700 rounded-full w-16"></div>
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

    renderSkeleton('skills-container', 8, 'skill');

    try {
        const response = await fetch(`${API_BASE_URL}/skills`, {
            headers: { 'Accept': 'application/json' }
        });
        if (!response.ok) throw new Error(`HTTP Error: ${response.status}`);

        const result = await response.json();
        const skills = result.data || [];

        if (skills.length === 0) {
            container.innerHTML = `<p class="col-span-full text-center text-slate-500 py-6">Belum ada keahlian yang ditambahkan ke database.</p>`;
            return;
        }

        container.innerHTML = skills.map(skill => `
            <div class="bg-white dark:bg-slate-800 p-4 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 hover:shadow-md transition-all duration-300 flex items-center space-x-3 group">
                <div class="w-10 h-10 rounded-lg bg-indigo-50 dark:bg-indigo-950 text-indigo-600 dark:text-indigo-400 flex items-center justify-center font-bold text-lg group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                    ${skill.icon ? `<i class="${skill.icon}"></i>` : skill.name.charAt(0).toUpperCase()}
                </div>
                <div>
                    <h3 class="font-semibold text-slate-800 dark:text-slate-100 text-sm sm:text-base">${skill.name}</h3>
                    <div class="flex items-center gap-1.5 mt-0.5">
                        <span class="text-[11px] text-slate-500 dark:text-slate-400">${skill.category}</span>
                        <span class="text-slate-300 dark:text-slate-600">•</span>
                        <span class="inline-block px-2 py-0.5 text-[11px] rounded-full font-medium ${
                            skill.level === 'Advanced' ? 'bg-indigo-100 text-indigo-700 dark:bg-indigo-900/60 dark:text-indigo-300' :
                            'bg-blue-100 text-blue-700 dark:bg-blue-900/60 dark:text-blue-300'
                        }">
                            ${skill.level || 'Intermediate'}
                        </span>
                    </div>
                </div>
            </div>
        `).join('');
    } catch (error) {
        console.error('Gagal memuat skills:', error);
        container.innerHTML = `
            <div class="col-span-full bg-red-50 dark:bg-red-950/50 border border-red-200 dark:border-red-800 text-red-600 dark:text-red-400 p-4 rounded-lg text-center text-sm">
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
            <div class="col-span-full text-center py-12 bg-white dark:bg-slate-800 rounded-xl border border-dashed border-slate-300 dark:border-slate-700">
                <p class="text-slate-500 dark:text-slate-400 font-medium">Tidak ada proyek yang sesuai dengan kriteria pencarian.</p>
            </div>
        `;
        return;
    }

    const fallbackImg = 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=640&q=80';

    container.innerHTML = projects.map(project => {
        const skillsList = Array.isArray(project.skills) ? project.skills : [];
        const projectImg = project.thumbnail_url || fallbackImg;

        return `
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden hover:shadow-lg transition-all duration-300 flex flex-col group">
                <div class="relative overflow-hidden h-48 bg-slate-100 dark:bg-slate-900">
                    <img
                        src="${projectImg}"
                        alt="${project.title}"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                        onerror="this.onerror=null;this.src='${fallbackImg}';"
                    >
                    ${project.is_featured ? `
                        <div class="absolute top-3 right-3 bg-indigo-600/95 backdrop-blur-sm px-2.5 py-1 rounded-md text-xs font-semibold text-white shadow-sm">
                            Featured
                        </div>
                    ` : ''}
                </div>
                <div class="p-6 flex-1 flex flex-col justify-between">
                    <div>
                        <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100 mb-2 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                            ${project.title}
                        </h3>
                        <p class="text-slate-600 dark:text-slate-300 text-sm line-clamp-3 mb-4 leading-relaxed">
                            ${project.summary || project.description || 'Deskripsi proyek belum diisi.'}
                        </p>
                    </div>
                    <div>
                        <div class="flex flex-wrap gap-1.5 mb-5">
                            ${skillsList.map(skill => `
                                <span class="px-2.5 py-0.5 bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-200 text-xs rounded-md font-medium">
                                    ${skill.name}
                                </span>
                            `).join('')}
                        </div>
                        <div class="flex items-center gap-3 pt-3 border-t border-slate-100 dark:border-slate-700">
                            ${project.demo_url ? `
                                <a href="${project.demo_url}" target="_blank" rel="noopener noreferrer" class="flex-1 text-center py-2 px-3 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold rounded-lg transition-colors">
                                    Lihat Demo
                                </a>
                            ` : ''}
                            ${project.github_url ? `
                                <a href="${project.github_url}" target="_blank" rel="noopener noreferrer" class="flex-1 text-center py-2 px-3 border border-slate-200 dark:border-slate-600 hover:border-slate-400 rounded-lg text-slate-700 dark:text-slate-200 text-xs font-semibold transition-colors inline-flex items-center justify-center gap-1.5">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/></svg>
                                    Source Code
                                </a>
                            ` : ''}
                        </div>
                    </div>
                </div>
            </div>
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

    renderSkeleton('certificates-container', 2, 'project');

    try {
        const response = await fetch(`${API_BASE_URL}/certificates`, {
            headers: { 'Accept': 'application/json' }
        });
        if (!response.ok) throw new Error(`HTTP Error: ${response.status}`);

        const result = await response.json();
        const certs = result.data || [];

        if (certs.length === 0) {
            container.innerHTML = `<p class="col-span-full text-center text-slate-500 py-6">Belum ada sertifikat.</p>`;
            return;
        }

        container.innerHTML = certs.map(cert => `
            <div class="bg-white dark:bg-slate-800 p-5 rounded-xl border border-slate-200 dark:border-slate-700 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-start justify-between gap-3 mb-2">
                    <h3 class="font-bold text-slate-800 dark:text-slate-100">${cert.title}</h3>
                    <span class="text-xs px-2.5 py-1 bg-amber-50 dark:bg-amber-950/60 text-amber-700 dark:text-amber-300 font-semibold rounded shrink-0">
                        ${cert.issued_date || 'Terverifikasi'}
                    </span>
                </div>
                <p class="text-sm font-medium text-indigo-600 dark:text-indigo-400 mb-2">${cert.issuer}</p>
                <p class="text-xs text-slate-600 dark:text-slate-300 mb-3">${cert.description || ''}</p>
                ${cert.credential_url ? `
                    <a href="${cert.credential_url}" target="_blank" rel="noopener noreferrer" class="text-xs text-indigo-600 dark:text-indigo-400 hover:underline font-semibold inline-flex items-center gap-1">
                        Lihat Kredensial ↗
                    </a>
                ` : ''}
            </div>
        `).join('');
    } catch (error) {
        console.error('Gagal memuat sertifikat:', error);
        container.innerHTML = `<p class="col-span-full text-center text-red-500 py-4 text-sm">Gagal memuat data sertifikat.</p>`;
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
