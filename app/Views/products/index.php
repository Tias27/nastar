<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>


<div class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-12">
        <nav class="flex mb-4 text-xs font-bold uppercase tracking-widest text-text-muted" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2">
                <li><a href="<?= base_url('/') ?>" class="hover:text-primary transition-colors">Beranda</a></li>
                <li><i data-lucide="chevron-right" class="w-3 h-3"></i></li>
                <li class="text-primary">Katalog Produk</li>
            </ol>
        </nav>
        <h1 class="text-3xl lg:text-4xl font-extrabold font-display text-gray-900">Katalog <span class="text-primary italic">Produk</span></h1>
    </div>
</div>

<section class="py-12 bg-gray-50 min-h-screen" x-data="{ openFilter: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-8">
            
            
            <aside class="hidden lg:block w-72 flex-shrink-0 space-y-8">
                
                <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-soft">
                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4 flex items-center gap-2">
                        <i data-lucide="search" class="w-4 h-4 text-primary"></i> Cari Produk
                    </h3>
                    <div class="relative group">
                        <input type="text" id="searchInput" 
                               class="w-full pl-4 pr-10 py-3 bg-gray-50 border border-gray-200 rounded-2xl text-sm focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all"
                               placeholder="Cari nastar favorit...">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 group-focus-within:text-primary transition-colors">
                            <i data-lucide="search" class="w-5 h-5"></i>
                        </div>
                    </div>
                </div>

                
                <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-soft">
                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4 flex items-center gap-2">
                        <i data-lucide="filter" class="w-4 h-4 text-primary"></i> Kategori
                    </h3>
                    <div class="space-y-2" id="categoryContainer">
                        <button type="button" data-keyword="" class="category-filter-btn w-full text-left px-4 py-3 rounded-2xl text-sm font-semibold transition-all flex items-center justify-between group active bg-primary-light text-primary">
                            <span>Semua Produk</span>
                            <i data-lucide="chevron-right" class="w-4 h-4 opacity-0 group-hover:opacity-100 transition-opacity"></i>
                        </button>
                        <button type="button" data-keyword="nastar" class="category-filter-btn w-full text-left px-4 py-3 rounded-2xl text-sm font-semibold text-gray-600 hover:bg-gray-50 transition-all flex items-center justify-between group">
                            <span>Nastar Klasik</span>
                            <i data-lucide="chevron-right" class="w-4 h-4 opacity-0 group-hover:opacity-100 transition-opacity"></i>
                        </button>
                        <button type="button" data-keyword="premium" class="category-filter-btn w-full text-left px-4 py-3 rounded-2xl text-sm font-semibold text-gray-600 hover:bg-gray-50 transition-all flex items-center justify-between group">
                            <span>Edisi Premium</span>
                            <i data-lucide="chevron-right" class="w-4 h-4 opacity-0 group-hover:opacity-100 transition-opacity"></i>
                        </button>
                        <button type="button" data-keyword="keju" class="category-filter-btn w-full text-left px-4 py-3 rounded-2xl text-sm font-semibold text-gray-600 hover:bg-gray-50 transition-all flex items-center justify-between group">
                            <span>Rasa Keju</span>
                            <i data-lucide="chevron-right" class="w-4 h-4 opacity-0 group-hover:opacity-100 transition-opacity"></i>
                        </button>
                        <button type="button" data-keyword="hampers" class="category-filter-btn w-full text-left px-4 py-3 rounded-2xl text-sm font-semibold text-gray-600 hover:bg-gray-50 transition-all flex items-center justify-between group">
                            <span>Paket Hampers</span>
                            <i data-lucide="chevron-right" class="w-4 h-4 opacity-0 group-hover:opacity-100 transition-opacity"></i>
                        </button>
                    </div>
                </div>
            </aside>

            
            <div class="flex-1">
                
                <div class="bg-white p-4 lg:p-6 rounded-3xl border border-gray-100 shadow-soft mb-8 flex flex-col gap-4">
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                        <div class="flex items-center gap-3 w-full sm:w-auto">
                            <div class="w-10 h-10 bg-primary-light rounded-xl flex items-center justify-center text-primary">
                                <i data-lucide="grid" class="w-5 h-5"></i>
                            </div>
                            <p class="text-sm text-text-muted" id="productCount">
                                Menampilkan <strong><?= count($products) ?></strong> produk
                            </p>
                        </div>
                        
                        <div class="flex items-center gap-3 w-full sm:w-auto" x-data="{ openFilter: false }">
                            
                            <div class="relative flex-1 sm:flex-none lg:hidden">
                                <button @click="openFilter = !openFilter" @click.away="openFilter = false" class="w-full flex items-center justify-center gap-2 px-6 py-3 bg-gray-50 text-gray-700 font-bold rounded-2xl border border-gray-200">
                                    <i data-lucide="sliders-horizontal" class="w-4 h-4"></i> Filter
                                </button>
                                
                                <div x-show="openFilter" x-cloak 
                                     x-transition:enter="transition ease-out duration-100"
                                     x-transition:enter-start="opacity-0 scale-95"
                                     x-transition:enter-end="opacity-100 scale-100"
                                     class="absolute left-0 right-0 mt-2 p-2 bg-white rounded-2xl border border-gray-100 shadow-xl z-50 space-y-1 min-w-[200px]">
                                    <button type="button" data-keyword="" class="category-filter-btn w-full text-left px-4 py-3 rounded-xl text-sm font-bold bg-primary-light text-primary flex items-center justify-between" @click="openFilter = false">
                                        <span>Semua Produk</span>
                                    </button>
                                    <button type="button" data-keyword="nastar" class="category-filter-btn w-full text-left px-4 py-3 rounded-xl text-sm font-bold text-gray-600 hover:bg-gray-50" @click="openFilter = false">
                                        <span>Nastar Klasik</span>
                                    </button>
                                    <button type="button" data-keyword="premium" class="category-filter-btn w-full text-left px-4 py-3 rounded-xl text-sm font-bold text-gray-600 hover:bg-gray-50" @click="openFilter = false">
                                        <span>Edisi Premium</span>
                                    </button>
                                    <button type="button" data-keyword="keju" class="category-filter-btn w-full text-left px-4 py-3 rounded-xl text-sm font-bold text-gray-600 hover:bg-gray-50" @click="openFilter = false">
                                        <span>Rasa Keju</span>
                                    </button>
                                </div>
                            </div>
                            
                            <select class="flex-1 sm:flex-none px-6 py-3 bg-gray-50 border border-gray-200 rounded-2xl text-sm font-bold text-gray-700 outline-none focus:ring-4 focus:ring-primary/10 transition-all cursor-pointer">
                                <option value="newest">Terbaru</option>
                                <option value="price-low">Harga Terendah</option>
                                <option value="price-high">Harga Tertinggi</option>
                                <option value="popular">Terpopuler</option>
                            </select>

                            
                            <div id="searchLoader" class="hidden">
                                <div class="w-5 h-5 border-2 border-primary border-t-transparent rounded-full animate-spin"></div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="lg:hidden relative group">
                        <input type="text" id="mobileSearchInput" 
                               class="w-full pl-4 pr-10 py-3 bg-gray-50 border border-gray-200 rounded-2xl text-sm focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all"
                               placeholder="Cari nastar favorit...">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 group-focus-within:text-primary transition-colors">
                            <i data-lucide="search" class="w-5 h-5"></i>
                        </div>
                    </div>
                </div>

                
                <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-8" id="productsContainer">
                    <?php if (empty($products)): ?>
                        <div class="col-span-full py-20 flex flex-col items-center justify-center text-center space-y-6 bg-white rounded-[2rem] border-2 border-dashed border-gray-200">
                            <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center text-gray-300">
                                <i data-lucide="search-x" class="w-12 h-12"></i>
                            </div>
                            <div class="space-y-2">
                                <h3 class="text-xl font-bold text-gray-900">Produk Tidak Ditemukan</h3>
                                <p class="text-sm text-text-muted max-w-xs">Maaf, kami tidak menemukan produk yang Anda cari. Coba gunakan kata kunci lain.</p>
                            </div>
                            <button onclick="window.location.reload()" class="px-8 py-3 bg-primary text-white font-bold rounded-2xl shadow-lg shadow-green-100 hover:bg-primary-dark transition-all">
                                Segarkan Halaman
                            </button>
                        </div>
                    <?php else: ?>
                        <?php foreach ($products as $i => $product): ?>
                            <div class="group bg-white rounded-3xl border border-gray-100 shadow-soft hover:shadow-elegant transition-all duration-500 flex flex-col overflow-hidden animate-fade-in-up" style="animation-delay: <?= ($i % 3) * 0.1 ?>s">
                                <div class="relative aspect-square overflow-hidden bg-gray-50">
                                    <?php if (!empty($product['gambar']) && file_exists(ROOTPATH . 'public/uploads/products/' . $product['gambar'])): ?>
                                        <img src="<?= base_url('uploads/products/' . $product['gambar']) ?>" 
                                             alt="<?= esc($product['nama_product']) ?>"
                                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                    <?php else: ?>
                                        <div class="w-full h-full flex flex-col items-center justify-center text-gray-300">
                                            <i data-lucide="cookie" class="w-12 h-12 mb-2"></i>
                                            <span class="text-[10px] uppercase tracking-widest font-bold">No Image</span>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <?php if ($product['stok'] < 5): ?>
                                        <div class="absolute top-4 left-4">
                                            <span class="px-3 py-1 bg-red-500 text-white text-[10px] font-bold rounded-full shadow-lg shadow-red-100 flex items-center gap-1">
                                                <i data-lucide="alert-triangle" class="w-3 h-3"></i> Stok Tipis!
                                            </span>
                                        </div>
                                    <?php endif; ?>

                                    <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                        <a href="<?= base_url('produk/' . $product['id_product']) ?>" 
                                           class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-gray-900 shadow-xl hover:bg-primary hover:text-white transition-all transform translate-y-4 group-hover:translate-y-0 duration-300">
                                            <i data-lucide="eye" class="w-5 h-5"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="p-5 flex-grow flex flex-col">
                                    <div class="flex-grow">
                                        <h3 class="text-base font-bold text-gray-900 mb-1 group-hover:text-primary transition-colors line-clamp-1">
                                            <?= esc($product['nama_product']) ?>
                                        </h3>
                                        <p class="text-[10px] font-bold text-text-muted flex items-center gap-1 mb-3">
                                            <i data-lucide="box" class="w-3 h-3 text-primary"></i> Stok: <?= $product['stok'] ?> pcs
                                        </p>
                                    </div>
                                    
                                    <div class="flex flex-col sm:flex-row sm:items-center justify-between mt-auto pt-4 border-t border-gray-50 gap-3">
                                        <p class="text-sm sm:text-lg font-extrabold text-primary">
                                            <span class="text-[10px] sm:text-xs">Rp</span><?= number_format($product['harga'], 0, ',', '.') ?>
                                        </p>
                                        
                                        <?php if (session()->get('logged_in') && session()->get('role') !== 'admin'): ?>
                                            <div class="flex items-center gap-2">
                                                <form action="<?= base_url('keranjang/tambah') ?>" method="POST" class="m-0 flex-1 sm:flex-none">
                                                    <?= csrf_field() ?>
                                                    <input type="hidden" name="id_product" value="<?= $product['id_product'] ?>">
                                                    <input type="hidden" name="quantity" value="1">
                                                    <button type="submit" class="w-full sm:w-9 h-9 rounded-xl border border-primary text-primary hover:bg-primary-light flex items-center justify-center transition-all" title="Tambah ke Keranjang">
                                                        <i data-lucide="shopping-cart" class="w-4 h-4"></i>
                                                    </button>
                                                </form>
                                                <form action="<?= base_url('keranjang/tambah') ?>" method="POST" class="m-0 flex-1 sm:flex-none">
                                                    <?= csrf_field() ?>
                                                    <input type="hidden" name="id_product" value="<?= $product['id_product'] ?>">
                                                    <input type="hidden" name="quantity" value="1">
                                                    <button type="submit" name="buy_now" value="1" class="w-full sm:w-9 h-9 rounded-xl bg-primary text-white hover:bg-primary-dark flex items-center justify-center transition-all shadow-md shadow-green-100" title="Beli Sekarang">
                                                        <i data-lucide="zap" class="w-4 h-4 fill-white"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        <?php else: ?>
                                            <a href="<?= base_url('produk/' . $product['id_product']) ?>" class="w-full sm:w-9 h-9 rounded-xl bg-gray-50 text-gray-400 hover:bg-primary-light hover:text-primary flex items-center justify-center transition-all">
                                                <i data-lucide="chevron-right" class="w-4 h-4"></i>
                                            </a>
                                        <?php endif; ?>
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

<style>
    .category-filter-btn.active {
        background-color: #e8f5e9 !important;
        color: #03AC0E !important;
        box-shadow: 0 4px 12px rgba(3, 172, 14, 0.08);
    }
</style>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('searchInput');
        const categoryBtns = document.querySelectorAll('.category-filter-btn');
        const productsContainer = document.getElementById('productsContainer');
        const productCount = document.getElementById('productCount');
        const searchLoader = document.getElementById('searchLoader');
        let debounceTimer;
        let searchController = null;

        const STORAGE_KEY_CATEGORY = 'nastar_selected_category';
        const baseUrl = '<?= base_url() ?>';
        const csrfName = '<?= csrf_token() ?>';
        const csrfHash = '<?= csrf_hash() ?>';
        const isLoggedIn = <?= session()->get('logged_in') && session()->get('role') !== 'admin' ? 'true' : 'false' ?>;

        function formatRp(angka) {
            return 'Rp ' + parseInt(angka).toLocaleString('id-ID');
        }

        function escapeHtml(text) {
            const map = {'&': '&amp;','<': '&lt;','>': '&gt;','"': '&quot;',"'": '&#039;'};
            return text.replace(/[&<>"']/g, m => map[m]);
        }

        function renderProducts(products) {
            productsContainer.innerHTML = '';
            
            if (!products || products.length === 0) {
                productsContainer.innerHTML = `
                    <div class="col-span-full py-20 flex flex-col items-center justify-center text-center space-y-6 bg-white rounded-[2rem] border-2 border-dashed border-gray-200">
                        <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center text-gray-300">
                            <i data-lucide="search-x" class="w-12 h-12"></i>
                        </div>
                        <div class="space-y-2">
                            <h3 class="text-xl font-bold text-gray-900">Produk Tidak Ditemukan</h3>
                            <p class="text-sm text-text-muted max-w-xs">Maaf, kami tidak menemukan produk yang Anda cari. Coba gunakan kata kunci lain.</p>
                        </div>
                    </div>
                `;
                productCount.innerHTML = `Menampilkan <strong>0</strong> produk`;
                lucide.createIcons();
                return;
            }

            productCount.innerHTML = `Menampilkan <strong>${products.length}</strong> produk`;

            products.forEach((p, i) => {
                const stockBadge = p.stok < 5 ? `
                    <div class="absolute top-4 left-4">
                        <span class="px-3 py-1 bg-red-500 text-white text-[10px] font-bold rounded-full shadow-lg shadow-red-100 flex items-center gap-1">
                            <i data-lucide="alert-triangle" class="w-3 h-3"></i> Stok Tipis!
                        </span>
                    </div>
                ` : '';

                const imgHtml = p.gambar ? 
                    `<img src="${baseUrl}uploads/products/${p.gambar}" alt="${escapeHtml(p.nama_product)}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">` :
                    `<div class="w-full h-full flex flex-col items-center justify-center text-gray-300">
                        <i data-lucide="cookie" class="w-12 h-12 mb-2"></i>
                        <span class="text-[10px] uppercase tracking-widest font-bold">No Image</span>
                    </div>`;

                const actionHtml = isLoggedIn ? `
                    <div class="flex items-center gap-1.5 sm:gap-2 flex-shrink-0">
                        <form action="${baseUrl}keranjang/tambah" method="POST" class="m-0">
                            <input type="hidden" name="${csrfName}" value="${csrfHash}">
                            <input type="hidden" name="id_product" value="${p.id_product}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="w-8 h-8 sm:w-9 sm:h-9 rounded-xl border border-primary text-primary hover:bg-primary-light flex items-center justify-center transition-all">
                                <i data-lucide="shopping-cart" class="w-4 h-4"></i>
                            </button>
                        </form>
                        <form action="${baseUrl}keranjang/tambah" method="POST" class="m-0">
                            <input type="hidden" name="${csrfName}" value="${csrfHash}">
                            <input type="hidden" name="id_product" value="${p.id_product}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" name="buy_now" value="1" class="w-8 h-8 sm:w-9 sm:h-9 rounded-xl bg-primary text-white hover:bg-primary-dark flex items-center justify-center transition-all shadow-md shadow-green-100">
                                <i data-lucide="zap" class="w-4 h-4 fill-white"></i>
                            </button>
                        </form>
                    </div>
                ` : `
                    <a href="${baseUrl}produk/${p.id_product}" class="w-9 h-9 rounded-xl bg-gray-50 text-gray-400 hover:bg-primary-light hover:text-primary flex items-center justify-center transition-all">
                        <i data-lucide="chevron-right" class="w-4 h-4"></i>
                    </a>
                `;

                const item = document.createElement('div');
                item.className = 'group bg-white rounded-3xl border border-gray-100 shadow-soft hover:shadow-elegant transition-all duration-500 flex flex-col overflow-hidden animate-fade-in-up';
                item.style.animationDelay = (i % 3) * 0.1 + 's';
                item.innerHTML = `
                    <div class="relative aspect-square overflow-hidden bg-gray-50">
                        ${imgHtml}
                        ${stockBadge}
                        <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <a href="${baseUrl}produk/${p.id_product}" class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-gray-900 shadow-xl hover:bg-primary hover:text-white transition-all transform translate-y-4 group-hover:translate-y-0 duration-300">
                                <i data-lucide="eye" class="w-5 h-5"></i>
                            </a>
                        </div>
                    </div>
                    <div class="p-5 flex-grow flex flex-col">
                        <div class="flex-grow">
                            <h3 class="text-base font-bold text-gray-900 mb-1 group-hover:text-primary transition-colors line-clamp-1">${escapeHtml(p.nama_product)}</h3>
                            <p class="text-[10px] font-bold text-text-muted flex items-center gap-1 mb-3">
                                <i data-lucide="box" class="w-3 h-3 text-primary"></i> Stok: ${p.stok} pcs
                            </p>
                        </div>
                        <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-50">
                            <p class="text-sm sm:text-lg font-extrabold text-primary">
                                <span class="text-[10px] sm:text-xs">Rp</span>${parseInt(p.harga).toLocaleString('id-ID')}
                            </p>
                            ${actionHtml}
                        </div>
                    </div>
                `;
                productsContainer.appendChild(item);
            });
            lucide.createIcons();
        }

        function performSearch(keyword) {
            searchLoader.classList.remove('hidden');
            if (searchController) searchController.abort();
            searchController = new AbortController();

            fetch(`${baseUrl}cari?q=${encodeURIComponent(keyword)}`, {
                method: 'GET',
                headers: {'X-Requested-With': 'XMLHttpRequest'},
                signal: searchController.signal
            })
            .then(res => res.json())
            .then(data => {
                renderProducts(data);
                searchLoader.classList.add('hidden');
            })
            .catch(err => {
                if (err.name !== 'AbortError') {
                    console.error(err);
                    searchLoader.classList.add('hidden');
                }
            });
        }

        const handleInput = function () {
            clearTimeout(debounceTimer);
            categoryBtns.forEach(b => b.classList.remove('active', 'bg-primary-light', 'text-primary'));
            localStorage.removeItem(STORAGE_KEY_CATEGORY);
            const value = this.value.trim();
            debounceTimer = setTimeout(() => performSearch(value), 300);
        };

        searchInput.addEventListener('input', handleInput);
        
        const mobileSearchInput = document.getElementById('mobileSearchInput');
        if (mobileSearchInput) {
            mobileSearchInput.addEventListener('input', handleInput);
        }

        categoryBtns.forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                categoryBtns.forEach(b => b.classList.remove('active', 'bg-primary-light', 'text-primary'));
                this.classList.add('active', 'bg-primary-light', 'text-primary');
                searchInput.value = '';
                const keyword = this.getAttribute('data-keyword');
                localStorage.setItem(STORAGE_KEY_CATEGORY, keyword);
                performSearch(keyword);
            });
        });

        // Init
        const saved = localStorage.getItem(STORAGE_KEY_CATEGORY);
        if (saved) {
            const activeBtn = Array.from(categoryBtns).find(b => b.getAttribute('data-keyword') === saved);
            if (activeBtn) activeBtn.click();
        }
    });
</script>
<?= $this->endSection() ?>