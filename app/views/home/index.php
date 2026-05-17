<?php 
// Pastikan path ini sesuai dengan struktur folder kamu
include __DIR__ . '/../templates/header.php'; 
?>

<div class="flex">
    <?php include __DIR__ . '/../templates/sidebar.php'; ?>

    <main class="flex-1 min-w-0 md:ml-64 transition-all">
        <?php include __DIR__ . '/../templates/topbar.php'; ?>

        <div class="p-4 md:p-8 space-y-8">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                
                <div class="lg:col-span-8 bg-[#050533] rounded-3xl p-6 md:p-10 text-white relative overflow-hidden shadow-2xl shadow-blue-900/20">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-cyan-500/10 rounded-full -mr-20 -mt-20 blur-3xl"></div>
                    
                    <div class="relative z-10">
                        <h2 class="text-2xl md:text-3xl font-bold mb-2">Ikhtisar Operasional</h2>
                        <p class="text-sm opacity-60 mb-10 max-w-md">Pemantauan real-time sirkulasi tabung industri dan metrik keterlibatan mitra.</p>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 md:gap-12">
                            <div>
                                <p class="text-[10px] uppercase tracking-[0.2em] opacity-50 mb-2 font-bold">Mitra Aktif</p>
                                <div class="flex items-baseline gap-2">
                                    <h3 class="text-4xl font-bold font-mono">142</h3>
                                    <span class="text-[10px] text-green-400 font-bold">↗ +12%</span>
                                </div>
                                <p class="text-[9px] opacity-40 mt-1">vs tahun lalu</p>
                            </div>
                            <div>
                                <p class="text-[10px] uppercase tracking-[0.2em] opacity-50 mb-2 font-bold">Tabung Dipinjamkan</p>
                                <div class="flex items-baseline gap-2">
                                    <h3 class="text-4xl font-bold font-mono">3,892</h3>
                                    <span class="text-[10px] text-cyan-400 font-bold">● Sesuai Target</span>
                                </div>
                                <p class="text-[9px] opacity-40 mt-1">Kapasitas aman</p>
                            </div>
                            <div>
                                <p class="text-[10px] uppercase tracking-[0.2em] opacity-50 mb-2 font-bold">Laju Perputaran</p>
                                <div class="flex items-baseline gap-2">
                                    <h3 class="text-4xl font-bold font-mono">18.4<span class="text-xl">hr</span></h3>
                                    <span class="text-[10px] text-orange-400 font-bold">! Lambat</span>
                                </div>
                                <p class="text-[9px] opacity-40 mt-1">Butuh optimalisasi</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-4 bg-white rounded-3xl p-8 border border-gray-100 flex flex-col items-center justify-between shadow-sm">
                    <p class="text-[10px] font-extrabold text-gray-400 uppercase tracking-widest">Kapasitas Inventaris</p>
                    
                    <div class="relative flex items-center justify-center my-6">
                        <svg class="w-40 h-40 transform -rotate-90">
                            <circle cx="80" cy="80" r="65" stroke="#f3f4f6" stroke-width="14" fill="transparent" />
                            <circle cx="80" cy="80" r="65" stroke="#00F2FF" stroke-width="14" fill="transparent" 
                                    stroke-dasharray="408" stroke-dashoffset="102" stroke-linecap="round" />
                        </svg>
                        <div class="absolute text-center">
                            <p class="text-3xl font-black text-[#050533]">75%</p>
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-tighter">Terpakai</p>
                        </div>
                    </div>

                    <div class="text-center space-y-4 w-full">
                        <p class="text-xs text-gray-500">2.400 Unit tersedia di <span class="font-bold text-gray-800">Gudang Utama</span></p>
                        <button class="w-full py-3 border-2 border-cyan-100 text-cyan-600 rounded-xl text-xs font-bold hover:bg-cyan-50 transition-all active:scale-95">
                            Lihat Peta Gudang
                        </button>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                
                <div class="lg:col-span-9 bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="p-6 flex flex-col sm:flex-row justify-between items-center gap-4">
                        <h3 class="font-bold text-gray-800">Aktivitas Transaksi Terbaru</h3>
                        <div class="flex gap-2">
                            <button class="px-4 py-2 bg-gray-50 text-gray-600 rounded-xl text-xs font-bold border border-gray-100 hover:bg-gray-100 transition-all">Filter</button>
                            <button class="px-4 py-2 bg-[#050533] text-white rounded-xl text-xs font-bold shadow-lg shadow-blue-900/20">Ekspor CSV</button>
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto no-scrollbar">
                        <table class="w-full text-sm">
                            <thead class="bg-gray-50/50 text-[10px] uppercase text-gray-400 font-bold border-y border-gray-100">
                                <tr>
                                    <th class="px-6 py-4 text-left">Mitra</th>
                                    <th class="px-6 py-4 text-left">Tipe</th>
                                    <th class="px-6 py-4 text-left">Unit</th>
                                    <th class="px-6 py-4 text-left">Waktu</th>
                                    <th class="px-6 py-4 text-left">Status</th>
                                    <th class="px-6 py-4 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                <?php 
                                // Simulasi data dari database
                                $transactions = [
                                    ['name' => 'Apex Gas Solutions', 'id' => '#VND-8821', 'type' => 'Keluar (Pinjam)', 'unit' => '45 Tabung', 'time' => '14:22 - 08 Mei', 'status' => 'SELESAI', 'color' => 'bg-cyan-400'],
                                    ['name' => 'Titan Refineries', 'id' => '#VND-7712', 'type' => 'Masuk (Kembali)', 'unit' => '120 Tabung', 'time' => '12:05 - 08 Mei', 'status' => 'PROSES', 'color' => 'bg-amber-400'],
                                    ['name' => 'Oceanic Chemicals', 'id' => '#VND-9011', 'type' => 'Keluar (Pinjam)', 'unit' => '22 Tabung', 'time' => '10:45 - 08 Mei', 'status' => 'DITUNDA', 'color' => 'bg-rose-400'],
                                ];
                                
                                foreach($transactions as $trx): ?>
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="px-6 py-4 flex items-center gap-3">
                                        <div class="w-9 h-9 bg-gray-100 rounded-lg flex items-center justify-center font-bold text-[10px] text-gray-500">
                                            <?= substr($trx['name'], 0, 2) ?>
                                        </div>
                                        <div>
                                            <p class="font-bold text-xs text-gray-800"><?= $trx['name'] ?></p>
                                            <p class="text-[9px] text-gray-400 font-mono"><?= $trx['id'] ?></p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-xs text-gray-500"><?= $trx['type'] ?></td>
                                    <td class="px-6 py-4 font-bold text-gray-700"><?= $trx['unit'] ?></td>
                                    <td class="px-6 py-4 text-[10px] text-gray-400"><?= $trx['time'] ?></td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 <?= $trx['color'] ?> text-[9px] font-black text-white rounded-md tracking-tighter">
                                            <?= $trx['status'] ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <button class="text-cyan-600 font-bold text-xs hover:underline">Kelola</button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="lg:col-span-3 space-y-6">
                    <div class="bg-white rounded-3xl border border-gray-100 p-6 shadow-sm">
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-6">Pusat Aksi</p>
                        <div class="space-y-3">
                            <button class="w-full group flex items-center gap-4 p-4 bg-[#050533] text-white rounded-2xl hover:bg-black transition-all">
                                <div class="bg-white/10 p-2 rounded-lg group-hover:scale-110 transition-transform">
                                    <svg class="w-5 h-5 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                </div>
                                <div class="text-left">
                                    <p class="text-xs font-bold leading-none">Penyaluran Baru</p>
                                    <p class="text-[9px] opacity-50 mt-1">Pinjamkan unit ke mitra</p>
                                </div>
                            </button>
                            </div>
                    </div>

                    <div class="bg-rose-50 border border-rose-100 rounded-3xl p-6 relative overflow-hidden">
                        <div class="absolute top-0 right-0 p-2 opacity-10">
                            <svg class="w-12 h-12 text-rose-600" fill="currentColor" viewBox="0 0 20 20"><path d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" /></svg>
                        </div>
                        <p class="text-[10px] font-black text-rose-600 uppercase tracking-widest mb-4">Peringatan Kritis</p>
                        <div class="space-y-4">
                            <div class="pl-3 border-l-2 border-rose-400">
                                <p class="text-xs font-bold text-rose-800">Telat Kembali: Zenith Ltd</p>
                                <p class="text-[10px] text-rose-500 mt-0.5">15 unit oksigen terlambat 4 hari.</p>
                            </div>
                            <div class="pl-3 border-l-2 border-rose-400">
                                <p class="text-xs font-bold text-rose-800">Stok Rendah: Argon G2</p>
                                <p class="text-[10px] text-rose-500 mt-0.5">Stok < 8% di Gudang B.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pb-10">
                <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm">
                    <div class="flex justify-between items-start mb-4">
                        <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest">Pinjaman Aktif</p>
                        <svg class="w-5 h-5 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                    </div>
                    <h4 class="text-3xl font-black text-gray-800 mb-2">84 <span class="text-sm font-normal text-gray-400">Mitra</span></h4>
                    <div class="w-full bg-gray-100 h-1.5 rounded-full overflow-hidden">
                        <div class="bg-cyan-400 h-full w-[65%]"></div>
                    </div>
                    <p class="text-[9px] text-gray-400 mt-3 italic">42% armada sedang bersirkulasi hari ini.</p>
                </div>
                </div>

        </div>
    </main>
</div>

<div class="fixed bottom-6 right-6 md:hidden">
    <button class="bg-cyan-400 text-[#050533] p-4 rounded-2xl shadow-2xl shadow-cyan-400/50 active:scale-90 transition-all">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
    </button>
</div>

</body>
</html>