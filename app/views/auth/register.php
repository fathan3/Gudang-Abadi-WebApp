<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration - Gudang Abadi</title>
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
        
        <div class="hidden md:flex md:w-[45%] bg-custom-hero relative flex-col justify-center items-center px-12 lg:px-20 text-white text-center transition-all">
            <div class="relative w-fit mb-12">
                <div class="bg-white p-4 rounded-xl shadow-xl">
                    <img src="https://img.icons8.com/fluency/96/gas-cylinder.png" alt="Logo" class="w-12 h-12 object-contain">
                </div>
                <span class="absolute -top-2 -right-2 bg-cyan-400 text-[#050533] text-[9px] font-bold px-2 py-1 rounded-md tracking-tighter border-2 border-[#050533]">
                    ADMIN ACCESS
                </span>
            </div>
            
            <h1 class="text-4xl lg:text-5xl font-bold mb-6 leading-tight">
                Pendaftaran <br> Administrator <br> Sistem
            </h1>
            <p class="text-sm lg:text-base opacity-70 mb-12 leading-relaxed max-w-sm">
                Akses ini hanya diperuntukkan bagi personel yang berwenang untuk mengelola ekosistem inventaris.
            </p>

            <div class="w-full max-w-sm">
                <div class="bg-white/5 border border-white/10 p-4 rounded-xl flex items-center justify-center gap-4">
                    <div class="bg-red-500/20 p-2 rounded-lg shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <p class="text-xs opacity-90 text-left">Verifikasi identitas diperlukan untuk aktivasi akun.</p>
                </div>
            </div>

            <p class="absolute bottom-10 w-full text-center text-[10px] opacity-40 tracking-widest uppercase">
                © 2026 GUDANG ABADI SECURITY SYSTEM.
            </p>
        </div>

        <div class="w-full md:w-[55%] flex flex-col justify-center items-center px-6 sm:px-12 lg:px-24 py-16">
            <div class="w-full max-w-xl">
                <div class="flex items-center gap-2 mb-1">
                    <h2 class="text-2xl font-bold text-gray-900">Buat Akun Admin</h2>
                    <span class="bg-gray-100 text-gray-500 text-[10px] px-2 py-0.5 rounded font-bold uppercase">Internal Only</span>
                </div>
                <p class="text-xs text-gray-500 mb-8 leading-relaxed">Daftarkan hak akses kontrol sistem industri Anda.</p>

                <form action="#" method="POST" class="space-y-5">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[11px] font-bold text-gray-700 mb-2 uppercase tracking-wider">ID Admin / NIP</label>
                            <input type="text" placeholder="ID Pegawai" class="w-full px-4 py-3 rounded-md input-custom text-sm">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-gray-700 mb-2 uppercase tracking-wider">Nama Lengkap</label>
                            <input type="text" placeholder="Nama Admin" class="w-full px-4 py-3 rounded-md input-custom text-sm">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-gray-700 mb-2 uppercase tracking-wider">Email Resmi</label>
                        <input type="email" placeholder="admin@gudangabadi.com" class="w-full px-4 py-3 rounded-md input-custom text-sm">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[11px] font-bold text-gray-700 mb-2 uppercase tracking-wider">Kata Sandi</label>
                            <input type="password" placeholder="••••••••" class="w-full px-4 py-3 rounded-md input-custom text-sm">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-gray-700 mb-2 uppercase tracking-wider">Ulangi Sandi</label>
                            <input type="password" placeholder="••••••••" class="w-full px-4 py-3 rounded-md input-custom text-sm">
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-[#050533] text-white py-3.5 rounded-md font-bold flex items-center justify-center gap-3 hover:bg-black transition-all active:scale-[0.98] mt-4">
                        Daftarkan Admin
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                    </button>
                </form>

                <p class="mt-8 text-center text-sm text-gray-500">
                    Sudah Punya Akun? <a href="../" class="text-black font-bold hover:underline">Masuk Di Sini</a>
                </p>
            </div>
        </div>
    </div>

</body>
</html>