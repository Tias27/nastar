<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>


<div class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-12">
        <nav class="flex mb-4 text-xs font-bold uppercase tracking-widest text-text-muted" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2">
                <li><a href="<?= base_url('/') ?>" class="hover:text-primary transition-colors">Beranda</a></li>
                <li><i data-lucide="chevron-right" class="w-3 h-3"></i></li>
                <li class="text-primary">Dashboard</li>
            </ol>
        </nav>
        <h1 class="text-3xl lg:text-4xl font-extrabold font-display text-gray-900">Dashboard <span class="text-primary italic">Pelanggan</span></h1>
    </div>
</div>

<section class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-8">
            
            
            <aside class="w-full lg:w-72 flex-shrink-0">
                <div class="bg-white p-6 sm:p-8 rounded-[2rem] sm:rounded-[2.5rem] border border-gray-100 shadow-soft animate-fade-in-up">
                    <div class="flex flex-col items-center gap-4">
                        <div class="relative inline-block group">
                            <div class="w-20 h-20 bg-primary text-white rounded-[2rem] flex items-center justify-center text-3xl font-black shadow-lg shadow-green-100 transform transition-transform group-hover:rotate-12">
                                <?= strtoupper(substr(session()->get('nama'), 0, 1)) ?>
                            </div>
                        </div>
                        <div class="text-center">
                            <h5 class="text-lg font-bold text-gray-900 font-display"><?= session()->get('nama') ?></h5>
                            <p class="text-[10px] text-text-muted font-bold uppercase tracking-widest mt-1">Loyal Member</p>
                        </div>
                    </div>
                    <nav class="space-y-1 text-left pt-6 border-t border-gray-50">
                        <a href="<?= base_url('customer/dashboard') ?>" class="flex items-center gap-3 px-4 py-3 bg-primary-light text-primary rounded-2xl font-bold text-sm transition-all group">
                            <i data-lucide="layout-grid" class="w-5 h-5"></i>
                            <span>Dashboard</span>
                        </a>
                        <a href="<?= base_url('customer/pesanan') ?>" class="flex items-center gap-3 px-4 py-3 text-text-muted hover:bg-gray-50 hover:text-primary rounded-2xl font-bold text-sm transition-all group">
                            <i data-lucide="package" class="w-5 h-5"></i>
                            <span>Pesanan Saya</span>
                        </a>
                        <a href="<?= base_url('customer/profil') ?>" class="flex items-center gap-3 px-4 py-3 text-text-muted hover:bg-gray-50 hover:text-primary rounded-2xl font-bold text-sm transition-all group">
                            <i data-lucide="user" class="w-5 h-5"></i>
                            <span>Profil Saya</span>
                        </a>
                        <div class="pt-4 mt-4 border-t border-gray-50">
                            <a href="<?= base_url('logout') ?>" class="flex items-center gap-3 px-4 py-3 text-red-500 hover:bg-red-50 rounded-2xl font-bold text-sm transition-all group">
                                <i data-lucide="log-out" class="w-5 h-5"></i>
                                <span>Keluar Akun</span>
                            </a>
                        </div>
                    </nav>
                </div>
            </aside>

            
            <div class="flex-1 space-y-8 animate-fade-in-up" style="animation-delay: 0.1s">
                
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 sm:gap-6">
                    <div class="bg-primary p-5 sm:p-6 rounded-[2rem] text-white shadow-xl shadow-green-100 flex flex-col justify-between space-y-4 sm:space-y-6 relative overflow-hidden group">
                        <div class="absolute -right-4 -top-4 w-24 h-24 bg-white/10 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700"></div>
                        <div class="flex items-center justify-between">
                            <span class="text-[10px] sm:text-xs font-bold uppercase tracking-widest opacity-80">Total Pesanan</span>
                            <i data-lucide="shopping-bag" class="w-4 h-4 sm:w-5 sm:h-5 opacity-60"></i>
                        </div>
                        <div>
                            <p class="text-3xl sm:text-5xl font-black font-display tracking-tight"><?= $total_orders ?></p>
                            <p class="text-[10px] sm:text-xs font-medium opacity-80 mt-1 sm:mt-2 flex items-center gap-1">
                                <i data-lucide="trending-up" class="w-3 h-3"></i> Meningkat
                            </p>
                        </div>
                    </div>

                    <div class="bg-white p-5 sm:p-6 rounded-[2rem] border border-gray-100 shadow-soft flex flex-col justify-between space-y-4 sm:space-y-6 hover:shadow-elegant transition-all">
                        <div class="flex items-center justify-between">
                            <span class="text-[10px] sm:text-xs font-bold text-text-muted uppercase tracking-widest">Pesanan Aktif</span>
                            <i data-lucide="truck" class="w-4 h-4 sm:w-5 sm:h-5 text-primary"></i>
                        </div>
                        <div>
                            <p class="text-3xl sm:text-5xl font-black font-display text-gray-900 tracking-tight">
                                <?php
                                $active = 0;
                                foreach($orders as $o) if($o['status'] != 'delivered' && $o['status'] != 'cancelled') $active++;
                                echo $active;
                                ?>
                            </p>
                            <p class="text-[10px] sm:text-xs font-bold text-primary mt-1 sm:mt-2">Sedang dikirim</p>
                        </div>
                    </div> 
                </div>

                
                <div class="bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-soft space-y-8">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-gray-50 pb-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-gray-50 rounded-2xl flex items-center justify-center text-gray-400">
                                <i data-lucide="history" class="w-6 h-6"></i>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold text-gray-900 font-display">Aktivitas Terakhir</h4>
                                <p class="text-xs text-text-muted">Ringkasan riwayat belanja Anda</p>
                            </div>
                        </div>
                        <a href="<?= base_url('customer/pesanan') ?>" class="inline-flex items-center gap-2 px-6 py-2.5 bg-gray-50 text-primary font-bold text-sm rounded-xl hover:bg-primary-light transition-all">
                            Lihat Semua <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>

                    <?php if (empty($orders)): ?>
                        <div class="py-20 flex flex-col items-center text-center space-y-4">
                            <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center text-gray-300">
                                <i data-lucide="inbox" class="w-10 h-10"></i>
                            </div>
                            <p class="text-text-muted text-sm font-medium">Belum ada riwayat pesanan.</p>
                            <a href="<?= base_url('produk') ?>" class="px-8 py-3 bg-primary text-white font-bold rounded-2xl shadow-lg shadow-green-100 hover:bg-primary-dark transition-all">Mulai Belanja</a>
                        </div>
                    <?php else: ?>
                        <div class="overflow-x-auto no-scrollbar">
                            <table class="w-full text-left border-separate border-spacing-y-4">
                                <thead class="hidden sm:table-header-group">
                                    <tr class="text-[10px] font-black text-gray-400 uppercase tracking-widest">
                                        <th class="px-4 py-2">ID Pesanan</th>
                                        <th class="px-4 py-2">Tanggal</th>
                                        <th class="px-4 py-2">Total Harga</th>
                                        <th class="px-4 py-2">Status</th>
                                        <th class="px-4 py-2 text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach (array_slice($orders, 0, 5) as $order): ?>
                                    <tr class="group hover:bg-gray-50/50 transition-all rounded-3xl">
                                        <td class="px-4 py-4 align-middle">
                                            <span class="text-sm font-black text-gray-900">#<?= $order['id_order'] ?></span>
                                        </td>
                                        <td class="px-4 py-4 align-middle">
                                            <span class="text-sm text-text-muted font-medium"><?= date('d M Y', strtotime($order['created_at'])) ?></span>
                                        </td>
                                        <td class="px-4 py-4 align-middle">
                                            <span class="text-sm font-black text-primary tracking-tight">Rp <?= number_format($order['total_price'], 0, ',', '.') ?></span>
                                        </td>
                                        <td class="px-4 py-4 align-middle">
                                            <?php
                                            $badge_class = 'bg-yellow-50 text-yellow-600 border-yellow-100';
                                            if ($order['status'] == 'processing') $badge_class = 'bg-blue-50 text-blue-600 border-blue-100';
                                            if ($order['status'] == 'shipped') $badge_class = 'bg-orange-50 text-orange-600 border-orange-100';
                                            if ($order['status'] == 'delivered') $badge_class = 'bg-green-50 text-green-600 border-green-100';
                                            if ($order['status'] == 'cancelled') $badge_class = 'bg-red-50 text-red-600 border-red-100';
                                            ?>
                                            <span class="px-3 py-1 text-[10px] font-bold uppercase tracking-widest rounded-full border <?= $badge_class ?>">
                                                <?= $order['status'] ?>
                                            </span>
                                        </td>
                                        <td class="px-4 py-4 align-middle text-right">
                                            <a href="<?= base_url('customer/pesanan/' . $order['order_token']) ?>" class="w-10 h-10 inline-flex items-center justify-center bg-white border border-gray-100 rounded-xl text-text-muted hover:text-primary hover:border-primary transition-all shadow-sm">
                                                <i data-lucide="eye" class="w-5 h-5"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
