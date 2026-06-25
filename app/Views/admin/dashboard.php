<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>


<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    
    <div class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-soft hover:shadow-elegant transition-all group">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-primary-light text-primary rounded-2xl flex items-center justify-center transition-transform group-hover:scale-110">
                <i data-lucide="package" class="w-6 h-6"></i>
            </div>
            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Inventory</span>
        </div>
        <div>
            <p class="text-3xl font-black font-display text-gray-900 tracking-tight"><?= $total_products ?></p>
            <p class="text-xs font-bold text-text-muted mt-1 uppercase tracking-wider">Total Produk</p>
        </div>
    </div>

    
    <div class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-soft hover:shadow-elegant transition-all group">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-blue-50 text-blue-500 rounded-2xl flex items-center justify-center transition-transform group-hover:scale-110">
                <i data-lucide="shopping-cart" class="w-6 h-6"></i>
            </div>
            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Sales</span>
        </div>
        <div>
            <p class="text-3xl font-black font-display text-gray-900 tracking-tight"><?= $total_orders ?></p>
            <p class="text-xs font-bold text-text-muted mt-1 uppercase tracking-wider">Total Pesanan</p>
        </div>
    </div>

    
    <div class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-soft hover:shadow-elegant transition-all group">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-orange-50 text-orange-500 rounded-2xl flex items-center justify-center transition-transform group-hover:scale-110">
                <i data-lucide="banknote" class="w-6 h-6"></i>
            </div>
            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Revenue</span>
        </div>
        <div>
            <p class="text-2xl font-black font-display text-primary tracking-tight">Rp <?= number_format($total_revenue, 0, ',', '.') ?></p>
            <p class="text-xs font-bold text-text-muted mt-1 uppercase tracking-wider">Total Pendapatan</p>
        </div>
    </div>

    
    <div class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-soft hover:shadow-elegant transition-all group">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-purple-50 text-purple-500 rounded-2xl flex items-center justify-center transition-transform group-hover:scale-110">
                <i data-lucide="users" class="w-6 h-6"></i>
            </div>
            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Community</span>
        </div>
        <div>
            <p class="text-3xl font-black font-display text-gray-900 tracking-tight"><?= $total_customers ?></p>
            <p class="text-xs font-bold text-text-muted mt-1 uppercase tracking-wider">Total Pelanggan</p>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    
    <div class="lg:col-span-2 bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-soft space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-gray-50 pb-6">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-gray-50 rounded-2xl flex items-center justify-center text-gray-400">
                    <i data-lucide="clock" class="w-6 h-6"></i>
                </div>
                <div>
                    <h4 class="text-xl font-bold text-gray-900 font-display">Pesanan Terbaru</h4>
                    <p class="text-xs text-text-muted">Aktivitas transaksi terkini masuk ke sistem</p>
                </div>
            </div>
            <a href="<?= base_url('admin/pesanan') ?>" class="inline-flex items-center gap-2 px-6 py-2.5 bg-gray-50 text-primary font-bold text-sm rounded-xl hover:bg-primary-light transition-all">
                Lihat Semua <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>
        </div>

        <div class="overflow-x-auto no-scrollbar">
            <table class="w-full text-left border-separate border-spacing-y-3">
                <thead>
                    <tr class="text-[10px] font-black text-gray-400 uppercase tracking-widest px-4">
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Pelanggan</th>
                        <th class="px-4 py-2">Total</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach (array_slice($recent_orders, 0, 8) as $order): ?>
                    <tr class="group hover:bg-gray-50/50 transition-all rounded-2xl border border-transparent hover:border-gray-100">
                        <td class="px-4 py-4 align-middle">
                            <span class="text-sm font-black text-gray-900 tracking-tight">#<?= $order['id_order'] ?></span>
                        </td>
                        <td class="px-4 py-4 align-middle">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center text-[10px] font-bold text-gray-500">
                                    <?= strtoupper(substr($order['nama'], 0, 1)) ?>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-900 leading-none"><?= esc($order['nama']) ?></p>
                                    <p class="text-[10px] text-text-muted mt-1">@<?= esc($order['username']) ?></p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-4 align-middle">
                            <span class="text-sm font-black text-primary tracking-tight">Rp <?= number_format($order['total_price'], 0, ',', '.') ?></span>
                        </td>
                        <td class="px-4 py-4 align-middle">
                            <?php
                            $badge = 'bg-yellow-50 text-yellow-600 border-yellow-100';
                            if ($order['status'] == 'processing') $badge = 'bg-blue-50 text-blue-600 border-blue-100';
                            if ($order['status'] == 'shipped') $badge = 'bg-orange-50 text-orange-600 border-orange-100';
                            if ($order['status'] == 'delivered') $badge = 'bg-green-50 text-green-600 border-green-100';
                            if ($order['status'] == 'cancelled') $badge = 'bg-red-50 text-red-600 border-red-100';
                            ?>
                            <span class="px-3 py-1 text-[10px] font-bold uppercase tracking-widest rounded-full border <?= $badge ?>">
                                <?= $order['status'] ?>
                            </span>
                        </td>
                        <td class="px-4 py-4 align-middle text-right">
                            <a href="<?= base_url('admin/pesanan/' . $order['id_order']) ?>" class="w-9 h-9 inline-flex items-center justify-center bg-white border border-gray-100 rounded-xl text-gray-400 hover:text-primary hover:border-primary transition-all shadow-sm">
                                <i data-lucide="eye" class="w-4 h-4"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    
    <div class="space-y-8">
        
        <div class="bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-soft space-y-6">
            <h5 class="text-lg font-bold text-gray-900 font-display flex items-center gap-3">
                <i data-lucide="pie-chart" class="w-5 h-5 text-primary"></i> Ringkasan Status
            </h5>
            
            <div class="space-y-4">
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl border border-gray-100">
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 rounded-full bg-yellow-400"></div>
                        <span class="text-sm font-bold text-gray-600">Pending</span>
                    </div>
                    <span class="text-sm font-black text-gray-900"><?= $pending_orders ?></span>
                </div>
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl border border-gray-100">
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 rounded-full bg-blue-400"></div>
                        <span class="text-sm font-bold text-gray-600">Diproses</span>
                    </div>
                    <span class="text-sm font-black text-gray-900"><?= $processing_orders ?></span>
                </div>
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl border border-gray-100">
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 rounded-full bg-orange-400"></div>
                        <span class="text-sm font-bold text-gray-600">Dikirim</span>
                    </div>
                    <span class="text-sm font-black text-gray-900">0</span>
                </div>
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl border border-gray-100">
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 rounded-full bg-green-400"></div>
                        <span class="text-sm font-bold text-gray-600">Selesai</span>
                    </div>
                    <span class="text-sm font-black text-gray-900">0</span>
                </div>
            </div>
        </div>

        
        <div class="bg-primary p-8 rounded-[2.5rem] text-white shadow-xl shadow-green-100 space-y-6 relative overflow-hidden">
            <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
            <h5 class="text-lg font-bold font-display flex items-center gap-3">
                <i data-lucide="zap" class="w-5 h-5 fill-white"></i> Aksi Cepat
            </h5>
            <div class="grid gap-3 relative z-10">
                <a href="<?= base_url('admin/produk/tambah') ?>" class="flex items-center gap-3 px-4 py-3 bg-white/10 hover:bg-white/20 rounded-2xl transition-all font-bold text-sm">
                    <i data-lucide="plus-circle" class="w-5 h-5"></i> Tambah Produk
                </a>
                <a href="<?= base_url('admin/laporan') ?>" class="flex items-center gap-3 px-4 py-3 bg-white/10 hover:bg-white/20 rounded-2xl transition-all font-bold text-sm">
                    <i data-lucide="file-text" class="w-5 h-5"></i> Cetak Laporan
                </a>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
