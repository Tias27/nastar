<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>


<div class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-12">
        <nav class="flex mb-4 text-xs font-bold uppercase tracking-widest text-text-muted" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2">
                <li><a href="<?= base_url('/') ?>" class="hover:text-primary transition-colors">Beranda</a></li>
                <li><i data-lucide="chevron-right" class="w-3 h-3"></i></li>
                <li><a href="<?= base_url('customer/dashboard') ?>" class="hover:text-primary transition-colors">Dashboard</a></li>
                <li><i data-lucide="chevron-right" class="w-3 h-3"></i></li>
                <li class="text-primary">Pesanan Saya</li>
            </ol>
        </nav>
        <h1 class="text-3xl lg:text-4xl font-extrabold font-display text-gray-900">Riwayat <span class="text-primary italic">Pesanan</span></h1>
    </div>
</div>

<section class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-8">
            
            
            <aside class="w-full lg:w-72 flex-shrink-0 space-y-6">
                <div class="bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-soft text-center space-y-6">
                    <div class="flex flex-col items-center gap-4 mb-6">
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
                        <a href="<?= base_url('customer/dashboard') ?>" class="flex items-center gap-3 px-4 py-3 text-text-muted hover:bg-gray-50 hover:text-primary rounded-2xl font-bold text-sm transition-all group">
                            <i data-lucide="layout-grid" class="w-5 h-5"></i>
                            <span>Dashboard</span>
                        </a>
                        <a href="<?= base_url('customer/pesanan') ?>" class="flex items-center gap-3 px-4 py-3 bg-primary-light text-primary rounded-2xl font-bold text-sm transition-all group">
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

            
            <div class="flex-1 space-y-8 animate-fade-in-up">
                
                <div class="bg-white p-4 rounded-3xl border border-gray-100 shadow-soft overflow-x-auto no-scrollbar">
                    <div class="flex items-center gap-4 min-w-max">
                        <a href="#" class="px-6 py-2.5 bg-primary text-white text-sm font-bold rounded-xl shadow-md shadow-green-100">Semua</a>
                        <a href="#" class="px-6 py-2.5 text-text-muted hover:bg-gray-50 text-sm font-bold rounded-xl transition-colors">Belum Bayar</a>
                        <a href="#" class="px-6 py-2.5 text-text-muted hover:bg-gray-50 text-sm font-bold rounded-xl transition-colors">Diproses</a>
                        <a href="#" class="px-6 py-2.5 text-text-muted hover:bg-gray-50 text-sm font-bold rounded-xl transition-colors">Dikirim</a>
                        <a href="#" class="px-6 py-2.5 text-text-muted hover:bg-gray-50 text-sm font-bold rounded-xl transition-colors">Selesai</a>
                    </div>
                </div>

                
                <div class="space-y-6">
                    <?php if (empty($orders)): ?>
                        <div class="bg-white py-20 rounded-[3rem] border border-gray-100 shadow-soft flex flex-col items-center text-center space-y-4">
                            <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center text-gray-300">
                                <i data-lucide="shopping-bag" class="w-12 h-12"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">Belum Ada Pesanan</h3>
                            <p class="text-sm text-text-muted max-w-xs">Anda belum pernah melakukan pemesanan. Yuk, cari nastar favorit Anda sekarang!</p>
                            <a href="<?= base_url('produk') ?>" class="px-10 py-4 bg-primary text-white font-bold rounded-2xl shadow-lg shadow-green-100 hover:bg-primary-dark transition-all">Mulai Belanja</a>
                        </div>
                    <?php else: ?>
                        <?php foreach ($orders as $i => $order): ?>
                            <div class="bg-white p-6 sm:p-8 rounded-[2.5rem] border border-gray-100 shadow-soft hover:shadow-elegant transition-all animate-fade-in-up" style="animation-delay: <?= $i * 0.1 ?>s">
                                
                                <div class="flex flex-wrap items-center justify-between gap-4 border-b border-gray-50 pb-6 mb-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-gray-50 rounded-2xl flex items-center justify-center text-primary shadow-sm">
                                            <i data-lucide="package" class="w-6 h-6"></i>
                                        </div>
                                        <div>
                                            <div class="flex items-center gap-2">
                                                <span class="text-lg font-black text-gray-900">#<?= $order['id_order'] ?></span>
                                                <span class="text-xs text-text-muted font-bold">• <?= date('d M Y, H:i', strtotime($order['created_at'])) ?></span>
                                            </div>
                                            <div class="flex items-center gap-2 mt-1">
                                                <?php
                                                $status_color = 'bg-yellow-50 text-yellow-600 border-yellow-100';
                                                $status_icon = 'clock';
                                                if ($order['status'] == 'processing') { $status_color = 'bg-blue-50 text-blue-600 border-blue-100'; $status_icon = 'loader'; }
                                                if ($order['status'] == 'shipped') { $status_color = 'bg-orange-50 text-orange-600 border-orange-100'; $status_icon = 'truck'; }
                                                if ($order['status'] == 'delivered') { $status_color = 'bg-green-50 text-green-600 border-green-100'; $status_icon = 'check-circle'; }
                                                if ($order['status'] == 'cancelled') { $status_color = 'bg-red-50 text-red-600 border-red-100'; $status_icon = 'x-circle'; }
                                                ?>
                                                <span class="px-3 py-1 text-[10px] font-black uppercase tracking-widest rounded-full border flex items-center gap-1.5 <?= $status_color ?>">
                                                    <i data-lucide="<?= $status_icon ?>" class="w-3 h-3"></i> <?= $order['status'] ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="text-right">
                                        <p class="text-[10px] font-bold text-text-muted uppercase mb-1">Total Pembayaran</p>
                                        <p class="text-2xl font-black text-primary tracking-tighter">Rp <?= number_format($order['total_price'], 0, ',', '.') ?></p>
                                    </div>
                                </div>

                                
                                <div class="flex flex-wrap items-center justify-between gap-4 pt-2">
                                    <div class="flex items-center gap-3">
                                        <div class="flex -space-x-3 overflow-hidden">
                                            
                                            <div class="inline-block h-8 w-8 rounded-full ring-2 ring-white bg-primary-light flex items-center justify-center text-primary text-[10px] font-bold">
                                                <i data-lucide="box" class="w-4 h-4"></i>
                                            </div>
                                        </div>
                                        <span class="text-xs font-bold text-text-muted uppercase">Pengecekan Pesanan</span>
                                    </div>

                                    <div class="flex items-center gap-3 w-full sm:w-auto">
                                        <?php if ($order['status'] == 'pending'): ?>
                                            <a href="<?= base_url('pesanan/bayar/' . $order['order_token']) ?>" class="flex-1 sm:flex-none px-6 py-3 bg-primary text-white text-xs font-bold rounded-xl shadow-lg shadow-green-100 hover:bg-primary-dark transition-all text-center">
                                                Bayar Sekarang
                                            </a>
                                        <?php endif; ?>
                                        <a href="<?= base_url('customer/pesanan/' . $order['order_token']) ?>" class="flex-1 sm:flex-none px-6 py-3 bg-white text-gray-700 text-xs font-bold rounded-xl border border-gray-200 hover:bg-gray-50 transition-all text-center">
                                            Detail Pesanan
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
