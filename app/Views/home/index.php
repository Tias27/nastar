<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>


<section class="relative bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-24">
        <div class="flex flex-col lg:flex-row items-center gap-12">
            
            <div class="flex-1 text-center lg:text-left space-y-8 animate-fade-in-up">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-primary-light text-primary rounded-full font-bold text-xs uppercase tracking-widest border border-green-100">
                    <i data-lucide="sparkles" class="w-4 h-4"></i>
                    Terlaris #1 Nastar Premium
                </div>
                <h1 class="text-4xl lg:text-6xl font-extrabold font-display leading-tight text-gray-900">
                    Sentuhan <span class="text-primary italic">Manis</span> di Setiap Gigitan
                </h1>
                <p class="text-lg text-text-muted leading-relaxed max-w-2xl mx-auto lg:mx-0">
                    Kue nastar legendaris dengan resep warisan. Selai nanas asli yang melimpah berlapis adonan butter premium yang lumer di mulut.
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                    <a href="<?= base_url('produk') ?>" class="w-full sm:w-auto px-8 py-4 bg-primary text-white font-bold rounded-2xl shadow-lg shadow-green-200 hover:bg-primary-dark hover:-translate-y-1 transition-all flex items-center justify-center gap-2">
                        <i data-lucide="shopping-bag" class="w-5 h-5"></i>
                        Belanja Sekarang
                    </a>
                    <a href="#featured" class="w-full sm:w-auto px-8 py-4 bg-white text-gray-700 font-bold rounded-2xl border border-gray-200 hover:bg-gray-50 transition-all flex items-center justify-center gap-2">
                        <i data-lucide="star" class="w-5 h-5 text-accent"></i>
                        Produk Unggulan
                    </a>
                </div>
                <div class="flex items-center justify-center lg:justify-start gap-8 pt-4">
                    <div class="text-center lg:text-left">
                        <p class="text-2xl font-bold text-gray-900">5k+</p>
                        <p class="text-xs text-text-muted">Terjual</p>
                    </div>
                    <div class="w-px h-8 bg-gray-200"></div>
                    <div class="text-center lg:text-left">
                        <p class="text-2xl font-bold text-gray-900">4.9/5</p>
                        <p class="text-xs text-text-muted">Rating</p>
                    </div>
                    <div class="w-px h-8 bg-gray-200"></div>
                    <div class="text-center lg:text-left">
                        <p class="text-2xl font-bold text-gray-900">100%</p>
                        <p class="text-xs text-text-muted">Halal</p>
                    </div>
                </div>
            </div>

            
            <div class="flex-1 relative animate-fade-in-up" style="animation-delay: 0.2s">
                <div class="absolute -z-10 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[120%] h-[120%] bg-primary-light rounded-full blur-3xl opacity-50"></div>
                <div class="relative rounded-[2.5rem] overflow-hidden shadow-elegant bg-white p-3 border border-gray-100">
                    <img src="https://images.unsplash.com/photo-1558961363-fa8fdf82db35?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80" 
                         alt="Nastar Premium" 
                         class="rounded-[2rem] w-full aspect-[4/3] object-cover">
                    
                    
                    <div class="absolute bottom-8 left-4 lg:-left-6 bg-white p-4 rounded-2xl shadow-elegant border border-gray-100 flex items-center gap-4 animate-bounce z-10">
                        <div class="w-12 h-12 bg-accent rounded-xl flex items-center justify-center text-white">
                            <i data-lucide="award" class="w-6 h-6"></i>
                        </div>
                        <div class="pr-4">
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Kualitas</p>
                            <p class="text-sm font-bold text-gray-900">Bahan Premium</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-8 rounded-3xl shadow-soft border border-gray-100 flex flex-col items-center text-center space-y-4 hover:shadow-elegant transition-shadow animate-fade-in-up" style="animation-delay: 0.1s">
                <div class="w-16 h-16 bg-orange-50 text-orange-500 rounded-2xl flex items-center justify-center mb-2">
                    <i data-lucide="leaf" class="w-8 h-8"></i>
                </div>
                <h3 class="text-xl font-bold font-display text-gray-900">Bahan Alami</h3>
                <p class="text-sm text-text-muted">Menggunakan nanas asli 100% dan butter Wijsman tanpa pengawet.</p>
            </div>
            <div class="bg-white p-8 rounded-3xl shadow-soft border border-gray-100 flex flex-col items-center text-center space-y-4 hover:shadow-elegant transition-shadow animate-fade-in-up" style="animation-delay: 0.2s">
                <div class="w-16 h-16 bg-blue-50 text-blue-500 rounded-2xl flex items-center justify-center mb-2">
                    <i data-lucide="truck" class="w-8 h-8"></i>
                </div>
                <h3 class="text-xl font-bold font-display text-gray-900">Pengiriman Aman</h3>
                <p class="text-sm text-text-muted">Packaging bubble wrap berlapis untuk memastikan kue sampai dengan utuh.</p>
            </div>
            <div class="bg-white p-8 rounded-3xl shadow-soft border border-gray-100 flex flex-col items-center text-center space-y-4 hover:shadow-elegant transition-shadow animate-fade-in-up" style="animation-delay: 0.3s">
                <div class="w-16 h-16 bg-green-50 text-green-500 rounded-2xl flex items-center justify-center mb-2">
                    <i data-lucide="heart" class="w-8 h-8"></i>
                </div>
                <h3 class="text-xl font-bold font-display text-gray-900">Dibuat Dengan Cinta</h3>
                <p class="text-sm text-text-muted">Setiap butir nastar dibentuk secara manual untuk menjaga tekstur terbaik.</p>
            </div>
        </div>
    </div>
</section>


<section id="featured" class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
            <div class="space-y-4">
                <h2 class="text-3xl lg:text-4xl font-extrabold font-display text-gray-900">
                    Rekomendasi <span class="text-primary italic">Spesial</span>
                </h2>
                <p class="text-text-muted">Pilihan kue terfavorit pelanggan kami yang wajib Anda coba.</p>
            </div>
            <a href="<?= base_url('produk') ?>" class="text-primary font-bold flex items-center gap-2 hover:gap-3 transition-all group">
                Lihat Semua Produk 
                <i data-lucide="arrow-right" class="w-5 h-5"></i>
            </a>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-8">
            <?php foreach ($featured_products as $i => $product): ?>
                <div class="group bg-white rounded-3xl border border-gray-100 shadow-soft hover:shadow-elegant transition-all duration-500 flex flex-col overflow-hidden animate-fade-in-up" style="animation-delay: <?= ($i % 4) * 0.1 ?>s">
                    
                    <div class="relative aspect-square overflow-hidden bg-gray-50">
                        <?php if (!empty($product['gambar']) && file_exists(ROOTPATH . 'public/uploads/products/' . $product['gambar'])): ?>
                            <img src="<?= base_url('uploads/products/' . $product['gambar']) ?>" 
                                 alt="<?= esc($product['nama_product']) ?>"
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <?php else: ?>
                            <img src="<?= base_url('assets/images/product.png') ?>" 
                                 alt="Placeholder"
                                 class="w-full h-full object-cover opacity-50 group-hover:scale-110 transition-transform duration-700">
                        <?php endif; ?>
                        
                        <div class="absolute top-4 left-4">
                            <span class="px-3 py-1 bg-white/90 backdrop-blur-sm text-primary text-[10px] font-bold rounded-full shadow-sm flex items-center gap-1 border border-primary/10">
                                <i data-lucide="star" class="w-3 h-3 fill-primary"></i> Unggulan
                            </span>
                        </div>

                        
                        <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-3">
                            <a href="<?= base_url('produk/' . $product['id_product']) ?>" 
                               class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-gray-900 shadow-xl hover:bg-primary hover:text-white transition-all transform translate-y-4 group-hover:translate-y-0 duration-300">
                                <i data-lucide="eye" class="w-5 h-5"></i>
                            </a>
                        </div>
                    </div>

                    
                    <div class="p-3 sm:p-5 flex-grow flex flex-col">
                        <div class="flex-grow">
                            <h3 class="text-sm sm:text-base font-bold text-gray-900 mb-1 group-hover:text-primary transition-colors line-clamp-1">
                                <?= esc($product['nama_product']) ?>
                            </h3>
                            <p class="text-[10px] sm:text-xs text-text-muted line-clamp-2 mb-2 sm:mb-4">
                                <?= esc($product['deskripsi']) ?>
                            </p>
                        </div>
                        
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between mt-auto pt-4 border-t border-gray-50 gap-3">
                            <div>
                                <p class="text-[10px] text-text-muted font-bold uppercase mb-0.5">Harga</p>
                                <p class="text-sm sm:text-lg font-extrabold text-primary">
                                    <span class="text-[10px] sm:text-xs">Rp</span><?= number_format($product['harga'], 0, ',', '.') ?>
                                </p>
                            </div>
                            
                            <?php if (session()->get('logged_in') && session()->get('role') !== 'admin'): ?>
                                <div class="flex items-center gap-2">
                                    <form action="<?= base_url('keranjang/tambah') ?>" method="POST" class="m-0 flex-1 sm:flex-none">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="id_product" value="<?= $product['id_product'] ?>">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="w-full sm:w-10 sm:h-10 h-9 rounded-xl border border-primary text-primary hover:bg-primary-light flex items-center justify-center transition-all" title="Tambah ke Keranjang">
                                            <i data-lucide="shopping-cart" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                                        </button>
                                    </form>
                                    <form action="<?= base_url('keranjang/tambah') ?>" method="POST" class="m-0 flex-1 sm:flex-none">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="id_product" value="<?= $product['id_product'] ?>">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" name="buy_now" value="1" class="w-full sm:w-10 sm:h-10 h-9 rounded-xl bg-primary text-white hover:bg-primary-dark flex items-center justify-center transition-all shadow-md shadow-green-100" title="Beli Sekarang">
                                            <i data-lucide="zap" class="w-4 h-4 sm:w-5 sm:h-5 fill-white"></i>
                                        </button>
                                    </form>
                                </div>
                            <?php else: ?>
                                <a href="<?= base_url('produk/' . $product['id_product']) ?>" class="w-full sm:w-10 sm:h-10 h-9 rounded-xl bg-gray-50 text-gray-400 hover:bg-primary-light hover:text-primary flex items-center justify-center transition-all">
                                    <i data-lucide="chevron-right" class="w-5 h-5"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="mt-16 text-center">
             <a href="<?= base_url('produk') ?>" class="inline-flex items-center gap-3 px-10 py-4 bg-gray-900 text-white font-bold rounded-2xl hover:bg-black transition-all shadow-xl">
                Lihat Semua Koleksi
                <i data-lucide="grid" class="w-5 h-5 text-primary"></i>
            </a>
        </div>
    </div>
</section>


<section class="py-24 bg-primary-light/30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center space-y-4 mb-16">
            <h2 class="text-3xl lg:text-4xl font-extrabold font-display text-gray-900 italic">Kata Mereka</h2>
            <p class="text-text-muted">Pengalaman manis dari pelanggan setia kami.</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <div class="bg-white p-8 rounded-3xl shadow-soft border border-gray-100 space-y-6">
                <div class="flex text-accent">
                    <i data-lucide="star" class="w-5 h-5 fill-current"></i>
                    <i data-lucide="star" class="w-5 h-5 fill-current"></i>
                    <i data-lucide="star" class="w-5 h-5 fill-current"></i>
                    <i data-lucide="star" class="w-5 h-5 fill-current"></i>
                    <i data-lucide="star" class="w-5 h-5 fill-current"></i>
                </div>
                <p class="text-sm text-gray-700 italic leading-relaxed">
                    "Nastarnya bener-bener lumer di mulut! Selai nanasnya kerasa banget asli, nggak cuma gula. Cocok banget buat hampers lebaran kemaren."
                </p>
                <div class="flex items-center gap-4 pt-4 border-t border-gray-50">
                    <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center text-gray-400">
                        <i data-lucide="user" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-900">Sarah Wijaya</p>
                        <p class="text-[10px] text-text-muted">Pelanggan Setia</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white p-8 rounded-3xl shadow-soft border border-gray-100 space-y-6">
                <div class="flex text-accent">
                    <i data-lucide="star" class="w-5 h-5 fill-current"></i>
                    <i data-lucide="star" class="w-5 h-5 fill-current"></i>
                    <i data-lucide="star" class="w-5 h-5 fill-current"></i>
                    <i data-lucide="star" class="w-5 h-5 fill-current"></i>
                    <i data-lucide="star" class="w-5 h-5 fill-current"></i>
                </div>
                <p class="text-sm text-gray-700 italic leading-relaxed">
                    "Packagingnya mantap banget, kirim ke luar kota tetap utuh. Rasa kejunya juga nggak pelit. Recommended bgt buat pecinta kue kering!"
                </p>
                <div class="flex items-center gap-4 pt-4 border-t border-gray-50">
                    <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center text-gray-400">
                        <i data-lucide="user" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-900">Budi Santoso</p>
                        <p class="text-[10px] text-text-muted">Verified Buyer</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white p-8 rounded-3xl shadow-soft border border-gray-100 space-y-6">
                <div class="flex text-accent">
                    <i data-lucide="star" class="w-5 h-5 fill-current"></i>
                    <i data-lucide="star" class="w-5 h-5 fill-current"></i>
                    <i data-lucide="star" class="w-5 h-5 fill-current"></i>
                    <i data-lucide="star" class="w-5 h-5 fill-current"></i>
                    <i data-lucide="star" class="w-5 h-5 fill-current"></i>
                </div>
                <p class="text-sm text-gray-700 italic leading-relaxed">
                    "Udah langganan dari tahun lalu. Kualitasnya nggak pernah berubah, selalu premium. Adminnya juga ramah dan fast response."
                </p>
                <div class="flex items-center gap-4 pt-4 border-t border-gray-50">
                    <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center text-gray-400">
                        <i data-lucide="user" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-900">Linda Lestari</p>
                        <p class="text-[10px] text-text-muted">Customer</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>