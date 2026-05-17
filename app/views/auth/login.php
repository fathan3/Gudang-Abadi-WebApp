<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Gudang Abadi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .bg-custom-hero {
            background-color: #050533;
            background-image: radial-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 1px);
            background-size: 30px 30px;
        }
        .input-custom {
            background-color: #F8FAFC;
            border: 1px solid #E2E8F0;
            transition: all 0.2s;
        }
        .input-custom:focus {
            background-color: #FFFFFF;
            border-color: #050533;
            outline: none;
            box-shadow: 0 0 0 3px rgba(5, 5, 51, 0.05);
        }
    </style>
</head>
<body class="bg-white min-h-screen">

    <div class="flex flex-col md:flex-row min-h-screen">
        
        <div class="hidden md:flex md:w-[45%] bg-custom-hero relative flex-col justify-center items-center px-12 lg:px-20 text-white text-center">
            <div class="bg-white p-4 rounded-xl shadow-xl mb-12">
                <img src="https://img.icons8.com/fluency/96/gas-cylinder.png" alt="Logo" class="w-12 h-12 object-contain">
            </div>
            
            <h1 class="text-4xl lg:text-5xl font-bold mb-6 leading-tight">
                Manajemen <br> Aset Industri <br> Terintegrasi
            </h1>
            <p class="text-sm lg:text-base opacity-70 mb-12 leading-relaxed max-w-sm">
                Pantau inventaris dan distribusi aset industri Anda secara real-time dengan akurasi tinggi.
            </p>

            <p class="absolute bottom-10 w-full text-center text-[10px] opacity-40 tracking-widest uppercase">
                © 2026 GUDANG ABADI SECURITY SYSTEM.
            </p>
        </div>

        <div class="w-full md:w-[55%] flex flex-col justify-center items-center px-6 sm:px-12 lg:px-24 py-16">
            <div class="w-full max-w-md">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Selamat Datang</h2>
                <p class="text-xs text-gray-500 mb-10 leading-relaxed">Silakan masuk ke akun Anda untuk mengelola inventaris.</p>

                <form action="#" method="POST" class="space-y-6">
                    <div>
                        <label class="block text-[11px] font-bold text-gray-700 mb-2 uppercase tracking-wider">Email atau ID Pengguna</label>
                        <input type="text" placeholder="Masukkan Email atau ID" class="w-full px-4 py-3 rounded-md input-custom text-sm">
                    </div>

                    <div>
                        <div class="flex justify-between mb-2">
                            <label class="text-[11px] font-bold text-gray-700 uppercase tracking-wider">Kata Sandi</label>
                            <a href="#" class="text-[11px] font-bold text-cyan-600 hover:underline">Lupa Sandi?</a>
                        </div>
                        <input type="password" placeholder="••••••••" class="w-full px-4 py-3 rounded-md input-custom text-sm">
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" id="remember" class="w-4 h-4 text-[#050533] border-gray-300 rounded focus:ring-[#050533]">
                        <label for="remember" class="ml-2 text-xs text-gray-600">Ingat Saya</label>
                    </div>

                    <button type="submit" class="w-full bg-[#050533] text-white py-3.5 rounded-md font-bold flex items-center justify-center gap-3 hover:bg-black transition-all active:scale-[0.98]">
                        Masuk Sekarang
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </button>
                </form>

                <p class="mt-10 text-center text-sm text-gray-500">
                    Belum punya akses? <a href="auth/register.php" class="text-black font-bold hover:underline">Daftar Admin</a>
                </p>
            </div>
        </div>
    </div>

</body>
</html>