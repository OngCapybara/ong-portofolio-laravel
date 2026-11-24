<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin — Kelola Proyek</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-zinc-950 text-zinc-100 min-h-screen">
    <!-- Navbar Atas -->
    <header class="bg-zinc-900/90 backdrop-blur-md border-b border-zinc-800 sticky top-0 z-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <span class="w-8 h-8 rounded-lg bg-sky-500/15 text-sky-400 flex items-center justify-center font-bold">⚡</span>
                <span class="font-bold text-white text-base sm:text-lg">Panel Portofolio</span>
                <span class="bg-sky-500/15 text-sky-400 border border-sky-500/30 text-xs px-2.5 py-0.5 rounded-full font-semibold">Admin</span>
            </div>
            <div class="flex items-center gap-4">
                <a href="/" target="_blank" class="text-xs text-zinc-400 hover:text-sky-400 transition-colors hidden sm:inline">Lihat Web ↗</a>
                <span id="admin-greeting" class="text-xs text-zinc-400 hidden md:inline">Halo, Admin</span>
                <button id="btn-logout" class="text-xs px-3.5 py-1.5 bg-red-500/10 text-red-400 border border-red-500/30 hover:bg-red-500/20 font-semibold rounded-xl transition-colors">
                    Keluar (Logout)
                </button>
            </div>
        </div>
    </header>

    <!-- Konten Utama Dashboard -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-bold text-white">Kelola Koleksi Proyek</h1>
                <p class="text-xs sm:text-sm text-zinc-400 mt-1">Tambah, ubah, atau hapus proyek yang tampil di website portofolio publik.</p>
            </div>
            <button id="btn-open-create-modal" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-sky-500 hover:bg-sky-600 text-white text-sm font-semibold rounded-xl shadow-lg shadow-sky-500/20 transition-colors">
                <span>+ Tambah Proyek Baru</span>
            </button>
        </div>

        <!-- Notifikasi Alert Dashboard -->
        <div id="dashboard-alert" class="hidden mb-6 p-4 rounded-xl text-sm font-medium"></div>

        <!-- Tabel Data Proyek -->
        <div class="bg-zinc-900 rounded-2xl shadow-xl border border-zinc-800 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="bg-zinc-950/60 border-b border-zinc-800 text-zinc-400 text-xs uppercase tracking-wider">
                            <th class="py-3.5 px-4">Thumbnail</th>
                            <th class="py-3.5 px-4">Judul Proyek</th>
                            <th class="py-3.5 px-4">Teknologi (Skills)</th>
                            <th class="py-3.5 px-4 text-center">Featured</th>
                            <th class="py-3.5 px-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="projects-table-body" class="divide-y divide-zinc-800">
                        <tr>
                            <td colspan="5" class="text-center py-8 text-zinc-500">Memuat data proyek dari server...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- MODAL FORM (TAMBAH / EDIT PROYEK + LIVE IMAGE PREVIEW) -->
    <div id="project-modal" class="fixed inset-0 bg-black/70 backdrop-blur-sm z-30 hidden flex items-center justify-center p-4 overflow-y-auto">
        <div class="bg-zinc-900 rounded-2xl shadow-2xl max-w-lg w-full p-6 border border-zinc-800 my-8">
            <h2 id="modal-title" class="text-xl font-bold text-white mb-4">Tambah Proyek Baru</h2>
            <form id="form-project" class="space-y-4">
                <input type="hidden" id="project-id">

                <div>
                    <label class="block text-xs font-semibold text-zinc-400 mb-1">Judul Proyek *</label>
                    <input type="text" id="title" required placeholder="Contoh: WakeBeam Smart Desk Alarm" class="w-full px-3.5 py-2 bg-zinc-800 border border-zinc-700 text-white rounded-xl text-sm focus:border-sky-500 focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-zinc-400 mb-1">Teknologi / Skills (Pisahkan dengan koma) *</label>
                    <input type="text" id="skills" required placeholder="ESP32, FreeRTOS, Flutter, C++" class="w-full px-3.5 py-2 bg-zinc-800 border border-zinc-700 text-white rounded-xl text-sm focus:border-sky-500 focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-zinc-400 mb-1">Ringkasan Singkat (Summary) *</label>
                    <textarea id="summary" rows="2" required placeholder="Deskripsi singkat proyek minimal 10 karakter..." class="w-full px-3.5 py-2 bg-zinc-800 border border-zinc-700 text-white rounded-xl text-sm focus:border-sky-500 focus:outline-none"></textarea>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-zinc-400 mb-1">URL Gambar Thumbnail (Opsional)</label>
                    <input type="url" id="thumbnail_url" placeholder="https://placehold.co/640x360/09090b/0ea5e9?text=Preview" class="w-full px-3.5 py-2 bg-zinc-800 border border-zinc-700 text-white rounded-xl text-sm focus:border-sky-500 focus:outline-none">
                    <!-- Live Image Preview -->
                    <div id="image-preview-wrapper" class="mt-2 hidden">
                        <span class="text-[11px] text-zinc-500 block mb-1">Pratinjau Gambar:</span>
                        <img id="image-preview" src="" alt="Preview" class="w-full h-32 object-cover rounded-xl border border-zinc-700">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-zinc-400 mb-1">URL Link Demo</label>
                        <input type="url" id="demo_url" placeholder="https://..." class="w-full px-3.5 py-2 bg-zinc-800 border border-zinc-700 text-white rounded-xl text-sm focus:border-sky-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-zinc-400 mb-1">URL Link GitHub</label>
                        <input type="url" id="github_url" placeholder="https://github.com/OngCapybara/..." class="w-full px-3.5 py-2 bg-zinc-800 border border-zinc-700 text-white rounded-xl text-sm focus:border-sky-500 focus:outline-none">
                    </div>
                </div>

                <div class="flex items-center gap-2 pt-1">
                    <input type="checkbox" id="is_featured" checked class="w-4 h-4 rounded accent-sky-500">
                    <label for="is_featured" class="text-xs text-zinc-300">Tampilkan badge <strong>Featured</strong> pada kartu proyek</label>
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-zinc-800">
                    <button type="button" id="btn-close-modal" class="px-4 py-2 text-zinc-400 hover:bg-zinc-800 rounded-xl text-sm font-medium">Batal</button>
                    <button type="submit" id="btn-save-project" class="px-5 py-2 bg-sky-500 hover:bg-sky-600 text-white rounded-xl text-sm font-semibold shadow-sm">Simpan Proyek</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL KONFIRMASI HAPUS AMAN -->
    <div id="delete-modal" class="fixed inset-0 bg-black/70 backdrop-blur-sm z-40 hidden flex items-center justify-center p-4">
        <div class="bg-zinc-900 rounded-2xl shadow-2xl max-w-sm w-full p-6 border border-zinc-800 text-center">
            <div class="w-12 h-12 bg-red-500/15 text-red-400 rounded-full flex items-center justify-center mx-auto mb-3 font-bold text-xl">
                ⚠️
            </div>
            <h3 class="text-lg font-bold text-white mb-2">Konfirmasi Hapus</h3>
            <p class="text-xs text-zinc-400 mb-6">Apakah Anda yakin ingin menghapus proyek ini? Tindakan ini tidak dapat dibatalkan.</p>
            <div class="flex justify-center gap-3">
                <button type="button" id="btn-cancel-delete" class="px-4 py-2 text-zinc-400 hover:bg-zinc-800 rounded-xl text-xs font-semibold">Batal</button>
                <button type="button" id="btn-confirm-delete" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-xl text-xs font-semibold shadow-sm">Ya, Hapus Sekarang</button>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/admin.js') }}"></script>
</body>
</html>
