<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>


<div class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-12">
        <nav class="flex mb-4 text-xs font-bold uppercase tracking-widest text-text-muted" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2">
                <li><a href="<?= base_url('/') ?>" class="hover:text-primary transition-colors">Beranda</a></li>
                <li><i data-lucide="chevron-right" class="w-3 h-3"></i></li>
                <li><a href="<?= base_url('customer/pesanan') ?>" class="hover:text-primary transition-colors">Pesanan Saya</a></li>
                <li><i data-lucide="chevron-right" class="w-3 h-3"></i></li>
                <li class="text-primary">Detail Pesanan #<?= $order['id_order'] ?></li>
            </ol>
        </nav>
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6">
            <div>
                <h1 class="text-3xl lg:text-4xl font-extrabold font-display text-gray-900">Detail <span class="text-primary italic">Pesanan</span></h1>
                <p class="text-xs text-text-muted font-bold uppercase tracking-widest mt-2 flex items-center gap-2">
                    <i data-lucide="calendar" class="w-3 h-3"></i>
                    Dipesan pada <?= date('d M Y, H:i', strtotime($order['created_at'])) ?>
                </p>
            </div>
            <div class="flex items-center gap-3">
                <a href="<?= base_url('customer/pesanan') ?>" class="px-6 py-3 bg-white text-gray-700 text-xs font-bold rounded-xl border border-gray-200 hover:bg-gray-50 transition-all flex items-center gap-2">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                    Kembali
                </a>
            </div>
        </div>
    </div>
</div>

<section class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            
            <div class="lg:col-span-8 space-y-8">
                
                <div class="bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-soft">
                    <div class="flex items-center gap-4 border-b border-gray-50 pb-6 mb-8">
                        <div class="w-12 h-12 bg-primary-light text-primary rounded-2xl flex items-center justify-center">
                            <i data-lucide="info" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-gray-900 font-display">Status Pesanan</h4>
                            <p class="text-xs text-text-muted">Informasi terbaru mengenai pesanan Anda</p>
                        </div>
                    </div>

                    <?php
                    $status_color = 'bg-yellow-50 text-yellow-600 border-yellow-100';
                    $status_text = 'Menunggu Pembayaran';
                    $status_icon = 'clock';
                    
                    if ($order['status'] == 'processing') {
                        $status_color = 'bg-blue-50 text-blue-600 border-blue-100';
                        $status_text = 'Sudah Bayar, Menunggu Pengiriman';
                        $status_icon = 'package';
                    } elseif ($order['status'] == 'shipped') {
                        $status_color = 'bg-orange-50 text-orange-600 border-orange-100';
                        $status_text = 'Barang Sedang Dikirim';
                        $status_icon = 'truck';
                    } elseif ($order['status'] == 'delivered') {
                        $status_color = 'bg-green-50 text-green-600 border-green-100';
                        $status_text = 'Pesanan Selesai';
                        $status_icon = 'check-circle';
                    } elseif ($order['status'] == 'cancelled') {
                        $status_color = 'bg-red-50 text-red-600 border-red-100';
                        $status_text = 'Pesanan Dibatalkan';
                        $status_icon = 'x-circle';
                    }
                    ?>

                    <div class="p-6 rounded-3xl border <?= $status_color ?> flex flex-col sm:flex-row items-center gap-6">
                        <div class="w-16 h-16 rounded-2xl bg-white flex items-center justify-center flex-shrink-0 shadow-sm">
                            <i data-lucide="<?= $status_icon ?>" class="w-8 h-8"></i>
                        </div>
                        <div class="text-center sm:text-left">
                            <h3 class="text-xl font-black font-display tracking-tight leading-none mb-1"><?= $status_text ?></h3>
                            <p class="text-[10px] font-bold uppercase tracking-widest opacity-70">Update terakhir: <?= date('d M Y, H:i', strtotime($order['updated_at'])) ?></p>
                        </div>
                        <?php if ($order['status'] == 'pending'): ?>
                            <div class="sm:ml-auto w-full sm:w-auto">
                                <a href="<?= base_url('pesanan/bayar/' . $order['order_token']) ?>" class="block px-8 py-4 bg-primary text-white text-sm font-black rounded-2xl shadow-lg shadow-green-100 hover:bg-primary-dark transition-all text-center">
                                    Bayar Sekarang
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                
                <div class="bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-soft">
                    <h4 class="text-xl font-bold text-gray-900 font-display mb-8">Item <span class="text-primary italic">Pesanan</span></h4>
                    
                    <div class="space-y-6">
                        <?php foreach ($items as $item): ?>
                        <div class="flex flex-col sm:flex-row sm:items-center gap-6 p-4 rounded-3xl border border-gray-50 hover:border-primary/20 transition-all group">
                            <div class="w-24 h-24 bg-gray-50 rounded-2xl overflow-hidden flex-shrink-0">
                                <?php if (!empty($item['gambar']) && file_exists(ROOTPATH . 'public/uploads/products/' . $item['gambar'])): ?>
                                    <img src="<?= base_url('uploads/products/' . $item['gambar']) ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                <?php else: ?>
                                    <div class="w-full h-full flex items-center justify-center text-3xl">🍪</div>
                                <?php endif; ?>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h5 class="text-lg font-bold text-gray-900 truncate group-hover:text-primary transition-colors"><?= esc($item['nama_product']) ?></h5>
                                <div class="flex items-center gap-3 mt-1">
                                    <p class="text-sm font-bold text-primary">Rp <?= number_format($item['price'], 0, ',', '.') ?></p>
                                    <span class="text-xs text-gray-300 font-black">×</span>
                                    <p class="text-sm font-bold text-gray-500"><?= $item['quantity'] ?> Toples</p>
                                </div>
                            </div>
                            <div class="text-left sm:text-right">
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Subtotal</p>
                                <p class="text-xl font-black text-gray-900 tracking-tighter">Rp <?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="mt-10 pt-10 border-t border-gray-50">
                        <div class="flex flex-col gap-3 max-w-xs ml-auto">
                            <div class="flex justify-between items-center text-sm font-bold text-text-muted">
                                <span>Subtotal Produk</span>
                                <span>Rp <?= number_format($order['total_price'], 0, ',', '.') ?></span>
                            </div>
                            <div class="flex justify-between items-center text-sm font-bold text-text-muted">
                                <span>Ongkos Kirim</span>
                                <span>Gratis</span>
                            </div>
                            <div class="h-px bg-gray-50 my-2"></div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm font-black text-gray-900 uppercase tracking-widest">Total Bayar</span>
                                <span class="text-2xl font-black text-primary tracking-tighter">Rp <?= number_format($order['total_price'], 0, ',', '.') ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="lg:col-span-4 space-y-8">
                
                <div class="bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-soft">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-10 h-10 bg-blue-50 text-blue-500 rounded-xl flex items-center justify-center">
                            <i data-lucide="user" class="w-5 h-5"></i>
                        </div>
                        <h4 class="text-sm font-black text-gray-900 uppercase tracking-widest">Penerima</h4>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm font-black text-gray-900"><?= esc($order['nama']) ?></p>
                            <p class="text-xs font-bold text-text-muted mt-1"><?= esc($order['phone']) ?></p>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100">
                            <p class="text-xs text-gray-600 leading-relaxed font-semibold">
                                <?= esc($order['alamat_kirim'] ?? $order['alamat']) ?>
                            </p>
                        </div>
                    </div>
                </div>

                
                <div class="bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-soft">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-10 h-10 bg-orange-50 text-orange-500 rounded-xl flex items-center justify-center">
                            <i data-lucide="truck" class="w-5 h-5"></i>
                        </div>
                        <h4 class="text-sm font-black text-gray-900 uppercase tracking-widest">Pengiriman</h4>
                    </div>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center py-2 border-b border-gray-50">
                            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Kurir</span>
                            <span class="text-xs font-black text-gray-900"><?= $shipping['kurir'] ?? 'Belum dipilih' ?></span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-50">
                            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Nomor Resi</span>
                            <span class="text-xs font-black text-primary select-all"><?= $shipping['resi'] ?? 'Proses Admin' ?></span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Status</span>
                            <span class="px-2 py-0.5 bg-gray-100 text-gray-500 text-[10px] font-black rounded-full uppercase tracking-widest">
                                <?= ucfirst($shipping['status'] ?? 'pending') ?>
                            </span>
                        </div>
                    </div>
                </div>

                
                <div class="bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-soft overflow-hidden relative">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-10 h-10 bg-purple-50 text-purple-500 rounded-xl flex items-center justify-center">
                            <i data-lucide="credit-card" class="w-5 h-5"></i>
                        </div>
                        <h4 class="text-sm font-black text-gray-900 uppercase tracking-widest">Pembayaran</h4>
                    </div>
                    
                    <div class="text-center py-4">
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Status Verifikasi</p>
                        <?php
                        $payment_status = $payment['status'] ?? 'UNPAID';
                        $pay_badge = 'bg-gray-100 text-gray-400';
                        if ($payment_status == 'paid') $pay_badge = 'bg-green-500 text-white shadow-lg shadow-green-100';
                        if ($payment_status == 'pending') $pay_badge = 'bg-blue-500 text-white shadow-lg shadow-blue-100';
                        ?>
                        <span class="px-6 py-2 <?= $pay_badge ?> text-xs font-black rounded-full uppercase tracking-widest inline-block">
                            <?= strtoupper($payment_status) ?>
                        </span>
                    </div>

                    <div class="mt-6 p-4 bg-gray-50 rounded-2xl border border-gray-100 space-y-2">
                        <div class="flex justify-between text-[10px]">
                            <span class="font-bold text-gray-400 uppercase">Metode</span>
                            <span class="font-black text-gray-900 uppercase tracking-tighter"><?= $payment['metode'] ?? 'Transfer' ?></span>
                        </div>
                        <div class="flex justify-between text-[10px]">
                            <span class="font-bold text-gray-400 uppercase">Waktu</span>
                            <span class="font-black text-gray-900"><?= $payment['payment_date'] ? date('d M Y, H:i', strtotime($payment['payment_date'])) : '-' ?></span>
                        </div>
                    </div>
                </div>
                
                
                <?php if (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false && $order['status'] == 'pending'): ?>
                    <div class="p-6 bg-yellow-50 rounded-[2.5rem] border border-yellow-100 text-center">
                        <p class="text-[10px] font-black text-yellow-600 uppercase tracking-widest mb-3">Developer Sandbox</p>
                        <a href="<?= base_url('pesanan/simulate/' . $order['order_token']) ?>" 
                           class="inline-flex items-center gap-2 px-6 py-3 bg-yellow-500 text-white font-black text-xs rounded-xl shadow-lg shadow-yellow-100 hover:scale-105 transition-all"
                           onclick="return confirm('Simulasikan pembayaran sukses?')">
                            <i data-lucide="bug" class="w-4 h-4"></i>
                            SIMULASI BAYAR
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
