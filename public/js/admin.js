/**
 * ADMIN CRUD ENGINE — Ong Azis Saliem
 * Operasi RESTful API Terproteksi via Laravel Sanctum Bearer Token
 */

const token = localStorage.getItem('admin_token');
const adminName = localStorage.getItem('admin_name');

if (!token) {
    window.location.href = '/admin/login';
}

if (adminName && document.getElementById('admin-greeting')) {
    document.getElementById('admin-greeting').innerText = `Halo, ${adminName}`;
}

// 1. Logout
document.getElementById('btn-logout').addEventListener('click', async () => {
    try {
        await fetch('/api/logout', {
            method: 'POST',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json'
            }
        });
    } catch (e) {
        console.warn('Logout network error');
    } finally {
        localStorage.removeItem('admin_token');
        localStorage.removeItem('admin_name');
        window.location.href = '/admin/login';
    }
});

// Helper Toast / SweetAlert2
function showDashboardAlert(type, message) {
    const alertBox = document.getElementById('dashboard-alert');
    if (alertBox) {
        alertBox.className = 'mb-6 p-4 rounded-xl text-sm font-medium block ' +
            (type === 'success'
                ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/30'
                : 'bg-red-500/10 text-red-400 border border-red-500/30');
        alertBox.innerHTML = message;
        setTimeout(() => alertBox.classList.add('hidden'), 4000);
    }

    if (typeof Swal !== 'undefined') {
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: type === 'success' ? 'success' : 'error',
            title: message,
            showConfirmButton: false,
            timer: 3000,
            background: '#18181b',
            color: '#f4f4f5'
        });
    }
}

// 2. Read: Memuat Daftar Proyek ke Tabel Admin
async function fetchAdminProjects() {
    const tableBody = document.getElementById('projects-table-body');
    if (!tableBody) return;

    try {
        const response = await fetch('/api/admin/projects', {
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json'
            }
        });

        if (response.status === 401) {
            localStorage.clear();
            window.location.href = '/admin/login';
            return;
        }

        const resData = await response.json();
        const projects = resData.data || [];

        if (projects.length === 0) {
            tableBody.innerHTML = `<tr><td colspan="5" class="text-center py-8 text-zinc-500">Belum ada proyek. Klik tombol + Tambah Proyek Baru.</td></tr>`;
            return;
        }

        tableBody.innerHTML = projects.map(proj => {
            const skillNames = (proj.skills || []).map(s => s.name).join(', ') || '-';
            const thumb = proj.thumbnail_url || `https://placehold.co/120x68/09090b/0ea5e9?text=Project`;

            return `
                <tr class="hover:bg-zinc-800/40 transition-colors">
                    <td class="py-3.5 px-4">
                        <img src="${thumb}" alt="${proj.title}" class="w-16 h-10 object-cover rounded-lg border border-zinc-700">
                    </td>
                    <td class="py-3.5 px-4">
                        <div class="font-semibold text-white">${proj.title}</div>
                        <div class="text-xs text-zinc-400 line-clamp-1 max-w-md">${proj.summary || ''}</div>
                    </td>
                    <td class="py-3.5 px-4 text-xs text-sky-400 font-medium">${skillNames}</td>
                    <td class="py-3.5 px-4 text-center">
                        <span class="px-2.5 py-0.5 text-[11px] rounded-full font-semibold ${proj.is_featured ? 'bg-sky-500/15 text-sky-400' : 'bg-zinc-800 text-zinc-400'}">
                            ${proj.is_featured ? 'Featured' : 'Standard'}
                        </span>
                    </td>
                    <td class="py-3.5 px-4 text-right space-x-2 whitespace-nowrap">
                        <button onclick="openEditModal(${proj.id})" class="px-3 py-1.5 bg-sky-500/10 text-sky-400 border border-sky-500/30 hover:bg-sky-500/20 text-xs font-semibold rounded-lg transition-colors">
                            Edit
                        </button>
                        <button onclick="openDeleteModal(${proj.id})" class="px-3 py-1.5 bg-red-500/10 text-red-400 border border-red-500/30 hover:bg-red-500/20 text-xs font-semibold rounded-lg transition-colors">
                            Hapus
                        </button>
                    </td>
                </tr>
            `;
        }).join('');
    } catch (err) {
        console.error(err);
        tableBody.innerHTML = `<tr><td colspan="5" class="text-center py-6 text-red-400">Gagal memuat data dari server.</td></tr>`;
    }
}

// 3. Live Image Preview pada Input Thumbnail
const thumbInput = document.getElementById('thumbnail_url');
const previewWrapper = document.getElementById('image-preview-wrapper');
const previewImg = document.getElementById('image-preview');

function updateImagePreview(url) {
    if (url && url.trim().startsWith('http')) {
        previewImg.src = url.trim();
        previewWrapper.classList.remove('hidden');
    } else {
        previewWrapper.classList.add('hidden');
    }
}

if (thumbInput) {
    thumbInput.addEventListener('input', (e) => updateImagePreview(e.target.value));
}

// 4. Modal Management (Create & Edit)
const projectModal = document.getElementById('project-modal');
const formProject = document.getElementById('form-project');
const modalTitle = document.getElementById('modal-title');

document.getElementById('btn-open-create-modal').addEventListener('click', () => {
    formProject.reset();
    document.getElementById('project-id').value = '';
    document.getElementById('is_featured').checked = true;
    updateImagePreview('');
    modalTitle.innerText = 'Tambah Proyek Baru';
    projectModal.classList.remove('hidden');
});

document.getElementById('btn-close-modal').addEventListener('click', () => {
    projectModal.classList.add('hidden');
});

window.openEditModal = async function (id) {
    try {
        const response = await fetch(`/api/admin/projects/${id}`, {
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json'
            }
        });
        const res = await response.json();
        const p = res.data;

        document.getElementById('project-id').value = p.id;
        document.getElementById('title').value = p.title;
        document.getElementById('skills').value = (p.skills || []).map(s => s.name).join(', ');
        document.getElementById('summary').value = p.summary || '';
        document.getElementById('thumbnail_url').value = p.thumbnail_url || '';
        document.getElementById('demo_url').value = p.demo_url || '';
        document.getElementById('github_url').value = p.github_url || '';
        document.getElementById('is_featured').checked = Boolean(p.is_featured);

        updateImagePreview(p.thumbnail_url || '');
        modalTitle.innerText = 'Edit Proyek: ' + p.title;
        projectModal.classList.remove('hidden');
    } catch (e) {
        showDashboardAlert('error', 'Gagal memuat detail proyek untuk diedit.');
    }
};

// 5. Submit Create / Update
formProject.addEventListener('submit', async (e) => {
    e.preventDefault();
    const projectId = document.getElementById('project-id').value;
    const isEdit = Boolean(projectId);

    const payload = {
        title:         document.getElementById('title').value.trim(),
        skills:        document.getElementById('skills').value.trim(),
        summary:       document.getElementById('summary').value.trim(),
        thumbnail_url: document.getElementById('thumbnail_url').value.trim() || null,
        demo_url:      document.getElementById('demo_url').value.trim() || null,
        github_url:    document.getElementById('github_url').value.trim() || null,
        is_featured:   document.getElementById('is_featured').checked
    };

    const url = isEdit ? `/api/admin/projects/${projectId}` : '/api/admin/projects';
    const method = isEdit ? 'PUT' : 'POST';

    try {
        const response = await fetch(url, {
            method: method,
            headers: {
                'Authorization': `Bearer ${token}`,
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(payload)
        });

        const res = await response.json();

        if (response.ok) {
            projectModal.classList.add('hidden');
            showDashboardAlert('success', res.message || 'Data proyek berhasil disimpan!');
            fetchAdminProjects();
        } else {
            const firstError = res.errors ? Object.values(res.errors)[0][0] : res.message;
            showDashboardAlert('error', firstError || 'Gagal menyimpan proyek.');
        }
    } catch (e) {
        showDashboardAlert('error', 'Terjadi kesalahan jaringan.');
    }
});

// 6. Modal Konfirmasi Hapus Aman
let targetDeleteId = null;
const deleteModal = document.getElementById('delete-modal');

window.openDeleteModal = function (id) {
    targetDeleteId = id;
    deleteModal.classList.remove('hidden');
};

document.getElementById('btn-cancel-delete').addEventListener('click', () => {
    deleteModal.classList.add('hidden');
    targetDeleteId = null;
});

document.getElementById('btn-confirm-delete').addEventListener('click', async () => {
    if (!targetDeleteId) return;

    try {
        const response = await fetch(`/api/admin/projects/${targetDeleteId}`, {
            method: 'DELETE',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json'
            }
        });

        const res = await response.json();

        if (response.ok) {
            deleteModal.classList.add('hidden');
            showDashboardAlert('success', res.message || 'Proyek berhasil dihapus.');
            fetchAdminProjects();
        } else {
            showDashboardAlert('error', res.message || 'Gagal menghapus proyek.');
        }
    } catch (e) {
        showDashboardAlert('error', 'Gagal terhubung ke server saat menghapus.');
    } finally {
        targetDeleteId = null;
    }
});

// Inisialisasi
fetchAdminProjects();
