<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="space-y-8 animate-fade-in">
    
    <!-- Print Only Header -->
    <div class="hidden print:block mb-10 border-b-2 border-primary pb-6">
        <div class="flex justify-between items-start">
            <div>
                <h1 class="text-2xl font-black text-primary italic uppercase tracking-tighter">Bulan Cake & Cookies</h1>
                <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mt-1">Laporan Penjualan Resmi</p>
                <div class="mt-4 space-y-1">
                    <p class="text-xs font-medium text-gray-700">Periode: <span class="font-bold text-black"><?= date('d F Y', strtotime($start)) ?> - <?= date('d F Y', strtotime($end)) ?></span></p>
                    <p class="text-xs font-medium text-gray-700">Dicetak pada: <span class="font-bold text-black"><?= date('d/m/Y H:i') ?></span></p>
                </div>
            </div>
            <div class="text-right">
                <p class="text-xs font-black text-gray-900 uppercase">Super Admin Panel</p>
                <p class="text-[9px] font-bold text-gray-400">nastar.test/admin/laporan</p>
            </div>
        </div>
    </div>
    
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-sm relative overflow-hidden print:hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-primary/5 rounded-full -mr-16 -mt-16"></div>
        <div class="relative z-10">
            <h1 class="text-3xl font-black font-display text-gray-900 tracking-tight italic">Laporan <span class="text-primary">Penjualan</span></h1>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mt-1">Analisis performa bisnis Bulan Cake & Cookies</p>
        </div>
        
        
        <form action="" method="GET" class="flex flex-wrap md:flex-nowrap items-end gap-4 relative z-10">
            <div class="space-y-1.5">
                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Mulai</label>
                <input type="date" name="start" value="<?= $start ?>" 
                       class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-100 rounded-xl text-xs font-bold focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all">
            </div>
            <div class="space-y-1.5">
                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Selesai</label>
                <input type="date" name="end" value="<?= $end ?>" 
                       class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-100 rounded-xl text-xs font-bold focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all">
            </div>
            <button type="submit" class="h-[42px] px-6 bg-primary text-white font-black text-[10px] uppercase tracking-widest rounded-xl hover:bg-primary-dark shadow-lg shadow-green-100 transition-all flex items-center gap-2">
                <i data-lucide="filter" class="w-4 h-4"></i> Filter
            </button>
            <a href="<?= base_url('admin/laporan?start='.$start.'&end='.$end.'&export=csv') ?>" class="h-[42px] px-6 bg-white border border-gray-100 text-gray-500 font-black text-[10px] uppercase tracking-widest rounded-xl hover:bg-gray-50 hover:text-primary transition-all flex items-center gap-2 shadow-sm">
                <i data-lucide="file-spreadsheet" class="w-4 h-4 text-primary"></i> Excel
            </a>
            <button type="button" onclick="window.print()" class="h-[42px] px-6 bg-white border border-gray-100 text-gray-500 font-black text-[10px] uppercase tracking-widest rounded-xl hover:bg-gray-50 hover:text-primary transition-all flex items-center gap-2 shadow-sm">
                <i data-lucide="printer" class="w-4 h-4 text-primary"></i> Cetak / PDF
            </button>
        </form>
    </div>

    
    <!-- Summary Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 print:hidden">
        
        <div class="bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-sm relative group hover:-translate-y-1 transition-all duration-300">
            <div class="w-14 h-14 bg-blue-50 text-blue-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                <i data-lucide="shopping-bag" class="w-7 h-7"></i>
            </div>
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Total Pesanan</p>
            <h3 class="text-3xl font-black text-gray-900 font-display italic"><?= number_format($summary['total_orders'] ?? 0, 0, ',', '.') ?> <span class="text-xs font-bold text-gray-400 not-italic ml-1">Order</span></h3>
        </div>

        
        <div class="bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-sm relative group hover:-translate-y-1 transition-all duration-300">
            <div class="w-14 h-14 bg-amber-50 text-amber-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                <i data-lucide="package" class="w-7 h-7"></i>
            </div>
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Produk Terjual</p>
            <h3 class="text-3xl font-black text-gray-900 font-display italic"><?= number_format($items_sold, 0, ',', '.') ?> <span class="text-xs font-bold text-gray-400 not-italic ml-1">Toples</span></h3>
        </div>

        
        <div class="bg-primary p-8 rounded-[2.5rem] shadow-xl shadow-green-100 relative group hover:-translate-y-1 transition-all duration-300 overflow-hidden">
            <div class="absolute top-0 right-0 w-24 h-24 bg-white/10 rounded-full -mr-12 -mt-12"></div>
            <div class="w-14 h-14 bg-white/20 text-white rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform relative z-10">
                <i data-lucide="trending-up" class="w-7 h-7"></i>
            </div>
            <p class="text-[10px] font-black text-white/60 uppercase tracking-widest mb-1 relative z-10">Total Omzet</p>
            <h3 class="text-3xl font-black text-white font-display italic relative z-10 tracking-tight">Rp <?= number_format($summary['total_revenue'] ?? 0, 0, ',', '.') ?></h3>
        </div>
    </div>

    <!-- Print Only Summary Table -->
    <div class="hidden print:block mb-8">
        <table class="w-full border-collapse">
            <thead>
                <tr>
                    <th class="bg-gray-50 px-4 py-3 text-left text-[10px] font-black uppercase tracking-widest border border-gray-200">Total Pesanan</th>
                    <th class="bg-gray-50 px-4 py-3 text-left text-[10px] font-black uppercase tracking-widest border border-gray-200">Produk Terjual</th>
                    <th class="bg-primary px-4 py-3 text-left text-[10px] font-black uppercase tracking-widest border border-primary text-white">Total Omzet</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="px-4 py-4 text-xl font-black italic border border-gray-200"><?= number_format($summary['total_orders'] ?? 0, 0, ',', '.') ?> Order</td>
                    <td class="px-4 py-4 text-xl font-black italic border border-gray-200"><?= number_format($items_sold, 0, ',', '.') ?> Toples</td>
                    <td class="px-4 py-4 text-2xl font-black italic border border-primary text-primary">Rp <?= number_format($summary['total_revenue'] ?? 0, 0, ',', '.') ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    
    <div class="bg-white rounded-[2.5rem] border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-8 py-6 border-b border-gray-50 flex items-center justify-between">
            <h4 class="text-sm font-black text-gray-900 uppercase tracking-widest">Penjualan Per Produk</h4>
            <div class="flex items-center gap-2">
                <span class="w-2 h-2 bg-primary rounded-full"></span>
                <span class="text-[10px] font-bold text-gray-400 uppercase">Periode Aktif</span>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50">
                        <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest">Nama Produk</th>
                        <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest text-center">Jumlah Terjual</th>
                        <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest text-right">Total Pendapatan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <?php if(empty($product_sales)): ?>
                        <tr>
                            <td colspan="3" class="px-8 py-16 text-center text-gray-400 font-bold italic">Belum ada data penjualan.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach($product_sales as $row): ?>
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-8 py-5">
                                    <span class="text-sm font-bold text-gray-700"><?= esc($row['nama_product']) ?></span>
                                </td>
                                <td class="px-8 py-5 text-center">
                                    <span class="text-sm font-black text-gray-900"><?= number_format($row['total_qty'], 0, ',', '.') ?></span>
                                    <span class="text-[10px] font-bold text-gray-400 uppercase ml-1">Toples</span>
                                </td>
                                <td class="px-8 py-5 text-right">
                                    <span class="text-sm font-black text-primary italic">Rp <?= number_format($row['total_sales'], 0, ',', '.') ?></span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Print Only Signature -->
    <div class="hidden print:grid grid-cols-2 gap-12 mt-20">
        <div class="text-center">
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-16">Dibuat Oleh,</p>
            <div class="w-48 h-px bg-gray-300 mx-auto"></div>
            <p class="text-xs font-black text-gray-900 mt-2 uppercase">Super Admin Panel</p>
        </div>
        <div class="text-center">
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-16">Mengetahui,</p>
            <div class="w-48 h-px bg-gray-300 mx-auto"></div>
            <p class="text-xs font-black text-gray-900 mt-2 uppercase">Pemilik Bulan Cake & Cookies</p>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
