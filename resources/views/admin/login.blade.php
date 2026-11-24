<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrator — Ong Azis Saliem</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-zinc-950 text-zinc-100 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full bg-zinc-900 rounded-3xl shadow-2xl p-8 border border-zinc-800">
        <div class="text-center mb-8">
            <div class="w-12 h-12 bg-sky-500 text-white rounded-2xl flex items-center justify-center mx-auto mb-3 font-bold text-xl shadow-lg shadow-sky-500/20">
                🛡️
            </div>
            <h1 class="text-2xl font-bold text-white">Login Administrator</h1>
            <p class="text-zinc-400 text-xs mt-1.5">Masuk menggunakan akun admin untuk mengelola proyek portofolio</p>
        </div>

        <div id="login-error" class="hidden mb-4 p-3.5 bg-red-500/10 border border-red-500/30 text-red-400 text-xs rounded-xl font-medium"></div>

        <form id="form-login" class="space-y-5">
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-zinc-400 mb-1.5">Email Administrator</label>
                <input type="email" id="email" required value="admin@demo.com" class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 text-white rounded-xl text-sm focus:border-sky-500 focus:ring-2 focus:ring-sky-500/20 focus:outline-none" placeholder="admin@demo.com">
            </div>
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-zinc-400 mb-1.5">Kata Sandi</label>
                <input type="password" id="password" required value="password123" class="w-full px-4 py-2.5 bg-zinc-800 border border-zinc-700 text-white rounded-xl text-sm focus:border-sky-500 focus:ring-2 focus:ring-sky-500/20 focus:outline-none" placeholder="••••••••">
            </div>
            <button type="submit" id="btn-login" class="w-full py-3 bg-sky-500 hover:bg-sky-600 text-white font-semibold rounded-xl shadow-lg shadow-sky-500/20 transition-all duration-200 text-sm">
                Masuk ke Dashboard →
            </button>
        </form>

        <div class="mt-6 text-center">
            <a href="/" class="text-xs text-zinc-500 hover:text-sky-400 transition-colors">← Kembali ke Halaman Utama Portofolio</a>
        </div>
    </div>

    <script>
        if (localStorage.getItem('admin_token')) {
            window.location.href = '/admin/dashboard';
        }

        const formLogin = document.getElementById('form-login');
        const loginError = document.getElementById('login-error');
        const btnLogin = document.getElementById('btn-login');

        formLogin.addEventListener('submit', async (e) => {
            e.preventDefault();
            loginError.classList.add('hidden');
            btnLogin.disabled = true;
            btnLogin.innerText = 'Memverifikasi...';

            try {
                const response = await fetch('/api/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        email: document.getElementById('email').value,
                        password: document.getElementById('password').value
                    })
                });

                const data = await response.json();

                if (response.ok && data.status === 'success') {
                    localStorage.setItem('admin_token', data.data.token);
                    localStorage.setItem('admin_name', data.data.user.name);
                    window.location.href = '/admin/dashboard';
                } else {
                    loginError.innerText = data.message || 'Login gagal. Periksa kembali email dan kata sandi.';
                    loginError.classList.remove('hidden');
                }
            } catch (err) {
                loginError.innerText = 'Gagal terhubung ke server backend.';
                loginError.classList.remove('hidden');
            } finally {
                btnLogin.disabled = false;
                btnLogin.innerText = 'Masuk ke Dashboard →';
            }
        });
    </script>
</body>
</html>
