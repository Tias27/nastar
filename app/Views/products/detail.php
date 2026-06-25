<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>


<div class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <nav class="flex text-xs font-bold uppercase tracking-widest text-text-muted" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2">
                <li><a href="<?= base_url('/') ?>" class="hover:text-primary transition-colors">Beranda</a></li>
                <li><i data-lucide="chevron-right" class="w-3 h-3"></i></li>
                <li><a href="<?= base_url('produk') ?>" class="hover:text-primary transition-colors">Produk</a></li>
                <li><i data-lucide="chevron-right" class="w-3 h-3"></i></li>
                <li class="text-primary truncate max-w-[150px]"><?= esc($product['nama_product']) ?></li>
            </ol>
        </nav>
    </div>
</div>

<section class="py-12 lg:py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-12">
            
            
            <div class="flex-1 space-y-4 animate-fade-in-up">
                <div class="bg-white p-4 rounded-[2.5rem] shadow-elegant border border-gray-100 overflow-hidden relative group">
                    <?php if (!empty($product['gambar']) && file_exists(ROOTPATH . 'public/uploads/products/' . $product['gambar'])): ?>
                        <img src="<?= base_url('uploads/products/' . $product['gambar']) ?>" 
                             alt="<?= esc($product['nama_product']) ?>"
                             class="w-full aspect-square object-cover rounded-[2rem] transition-transform duration-700 group-hover:scale-105">
                    <?php else: ?>
                        <div class="w-full aspect-square bg-primary-light flex flex-col items-center justify-center text-primary rounded-[2rem]">
                            <i data-lucide="cookie" class="w-32 h-32 mb-4"></i>
                            <span class="text-sm font-bold uppercase tracking-widest">No Image available</span>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (isset($product['is_featured']) && $product['is_featured']): ?>
                        <div class="absolute top-8 left-8">
                            <span class="px-4 py-2 bg-accent text-white text-xs font-bold rounded-full shadow-lg flex items-center gap-2">
                                <i data-lucide="award" class="w-4 h-4"></i> Produk Unggulan
                            </span>
                        </div>
                    <?php endif; ?>
                </div>

                
                <div class="grid grid-cols-4 gap-4">
                    <div class="aspect-square bg-white rounded-2xl border-2 border-primary p-1 shadow-sm">
                         <img src="<?= base_url('uploads/products/' . $product['gambar']) ?>" class="w-full h-full object-cover rounded-xl opacity-100 transition-opacity hover:opacity-100 cursor-pointer">
                    </div>
                </div>
            </div>

            
            <div class="flex-1 space-y-8 animate-fade-in-up" style="animation-delay: 0.1s">
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <?php if (isset($product['nama_category'])): ?>
                            <span class="px-4 py-1.5 bg-primary-light text-primary text-[10px] font-bold uppercase tracking-widest rounded-full border border-green-100">
                                <?= esc($product['nama_category']) ?>
                            </span>
                        <?php endif; ?>
                        <div class="flex items-center gap-1 text-accent">
                            <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                            <span class="text-sm font-bold text-gray-900">4.9</span>
                            <span class="text-xs text-text-muted">(200+ Penjualan)</span>
                        </div>
                    </div>
                    
                    <h1 class="text-3xl lg:text-5xl font-extrabold font-display text-gray-900 leading-tight">
                        <?= esc($product['nama_product']) ?>
                    </h1>
                    
                    <div class="flex items-baseline gap-2">
                        <span class="text-sm font-bold text-primary">Rp</span>
                        <span class="text-4xl lg:text-5xl font-black text-primary tracking-tight">
                            <?= number_format($product['harga'], 0, ',', '.') ?>
                        </span>
                        <span class="text-sm font-medium text-text-muted">/ toples</span>
                    </div>
                </div>

                <div class="p-6 bg-white rounded-3xl border border-gray-100 shadow-soft space-y-6">
                    <div class="space-y-2">
                        <h3 class="text-sm font-bold text-gray-900 uppercase tracking-widest flex items-center gap-2">
                            <i data-lucide="align-left" class="w-4 h-4 text-primary"></i> Deskripsi
                        </h3>
                        <p class="text-sm text-text-muted leading-relaxed">
                            <?= nl2br(esc($product['deskripsi'] ?? 'Produk nastar berkualitas premium dengan resep turun temurun. Dibuat dengan bahan-bahan pilihan terbaik untuk rasa yang tak terlupakan.')) ?>
                        </p>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="p-4 bg-gray-50 rounded-2xl flex items-center gap-4">
                            <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-primary shadow-sm">
                                <i data-lucide="box" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-text-muted uppercase">Stok</p>
                                <p class="text-sm font-bold <?= $product['stok'] > 5 ? 'text-green-600' : 'text-red-600' ?>">
                                    <?= $product['stok'] ?> Pcs
                                </p>
                            </div>
                        </div>
                        <?php if (isset($product['berat'])): ?>
                        <div class="p-4 bg-gray-50 rounded-2xl flex items-center gap-4">
                            <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-primary shadow-sm">
                                <i data-lucide="weight" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-text-muted uppercase">Berat</p>
                                <p class="text-sm font-bold text-gray-900"><?= $product['berat'] ?> gram</p>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                
                <div class="space-y-6">
                    <?php if (session()->get('logged_in') && session()->get('role') !== 'admin'): ?>
                        <form action="<?= base_url('keranjang/tambah') ?>" method="POST" class="space-y-6" x-data="{ qty: 1, max: <?= $product['stok'] ?> }">
                            <?= csrf_field() ?>
                            <input type="hidden" name="id_product" value="<?= $product['id_product'] ?>">
                            
                            <div class="flex items-center gap-6">
                                <span class="text-sm font-bold text-gray-900 uppercase tracking-widest">Jumlah</span>
                                <div class="flex items-center bg-white border border-gray-200 rounded-2xl p-1 shadow-sm">
                                    <button type="button" @click="if(qty > 1) qty--" 
                                            class="w-10 h-10 rounded-xl flex items-center justify-center text-gray-500 hover:bg-gray-50 transition-colors">
                                        <i data-lucide="minus" class="w-4 h-4"></i>
                                    </button>
                                    <input type="number" name="quantity" x-model="qty" readonly
                                           class="w-12 text-center bg-transparent border-none text-lg font-bold text-gray-900 outline-none focus:ring-0">
                                    <button type="button" @click="if(qty < max) qty++" 
                                            class="w-10 h-10 rounded-xl flex items-center justify-center text-primary hover:bg-primary-light transition-colors">
                                        <i data-lucide="plus" class="w-4 h-4"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="flex flex-col sm:flex-row gap-4">
                                <button type="submit" class="flex-1 py-4 bg-white text-primary border-2 border-primary font-bold rounded-[1.5rem] hover:bg-primary-light transition-all flex items-center justify-center gap-2">
                                    <i data-lucide="shopping-cart" class="w-5 h-5"></i>
                                    Masukkan Keranjang
                                </button>
                                <button type="submit" name="buy_now" value="1" class="flex-[1.5] py-4 bg-primary text-white font-bold rounded-[1.5rem] shadow-lg shadow-green-100 hover:bg-primary-dark hover:-translate-y-1 transition-all flex items-center justify-center gap-2">
                                    <i data-lucide="zap" class="w-5 h-5 fill-white"></i>
                                    Beli Sekarang
                                </button>
                            </div>
                        </form>
                    <?php elseif (!session()->get('logged_in')): ?>
                        <div class="p-6 bg-primary-light/50 border-2 border-dashed border-primary/20 rounded-3xl flex flex-col sm:flex-row items-center justify-between gap-4">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-primary shadow-sm">
                                    <i data-lucide="lock" class="w-6 h-6"></i>
                                </div>
                                <p class="text-sm text-gray-700 leading-tight">
                                    Silakan <a href="<?= base_url('login') ?>" class="text-primary font-bold hover:underline">Masuk</a> atau <a href="<?= base_url('register') ?>" class="text-primary font-bold hover:underline">Daftar</a><br>
                                    untuk melakukan pemesanan.
                                </p>
                            </div>
                            <a href="<?= base_url('login') ?>" class="w-full sm:w-auto px-8 py-3 bg-primary text-white font-bold rounded-2xl hover:bg-primary-dark transition-all">
                                Masuk Sekarang
                            </a>
                        </div>
                    <?php endif; ?>

                    
                    <div class="flex flex-wrap items-center gap-8 pt-8 border-t border-gray-100">
                        <div class="flex items-center gap-3 text-text-muted">
                            <i data-lucide="truck" class="w-5 h-5 text-primary"></i>
                            <span class="text-xs font-bold uppercase tracking-widest">Pengiriman Cepat</span>
                        </div>
                        <div class="flex items-center gap-3 text-text-muted">
                            <i data-lucide="shield-check" class="w-5 h-5 text-primary"></i>
                            <span class="text-xs font-bold uppercase tracking-widest">Jaminan Mutu</span>
                        </div>
                        <div class="flex items-center gap-3 text-text-muted">
                            <i data-lucide="package-check" class="w-5 h-5 text-primary"></i>
                            <span class="text-xs font-bold uppercase tracking-widest">Kondisi Aman</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <?php if (!empty($related)): ?>
            <div class="mt-24 space-y-12">
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                    <div class="space-y-4">
                        <h2 class="text-3xl font-extrabold font-display text-gray-900 italic">
                            Mungkin Anda <span class="text-primary">Suka</span>
                        </h2>
                        <div class="w-24 h-1.5 bg-primary rounded-full"></div>
                    </div>
                    <a href="<?= base_url('produk') ?>" class="text-primary font-bold flex items-center gap-2 group">
                        Lihat Semua 
                        <i data-lucide="arrow-right" class="w-5 h-5 transition-transform group-hover:translate-x-1"></i>
                    </a>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-8">
                    <?php foreach (array_slice($related, 0, 4) as $rel): ?>
                        <?php if ($rel['id_product'] !== $product['id_product']): ?>
                            <a href="<?= base_url('produk/' . $rel['id_product']) ?>" class="group bg-white p-4 rounded-3xl border border-gray-100 shadow-soft hover:shadow-elegant transition-all">
                                <div class="aspect-square rounded-2xl overflow-hidden bg-gray-50 mb-4">
                                    <img src="<?= base_url('uploads/products/' . $rel['gambar']) ?>" class="w-full h-full object-cover group-hover:scale-110 transition-all duration-700">
                                </div>
                                <h4 class="text-sm font-bold text-gray-900 truncate"><?= esc($rel['nama_product']) ?></h4>
                                <p class="text-primary font-black mt-1">Rp <?= number_format($rel['harga'], 0, ',', '.') ?></p>
                            </a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<?= $this->endSection() ?>