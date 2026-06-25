<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="bg-white rounded-[2.5rem] border border-gray-100 shadow-soft overflow-hidden animate-fade-in">
    
    <div class="p-8 border-b border-gray-50 flex flex-col sm:flex-row sm:items-center justify-between gap-6">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 bg-primary-light text-primary rounded-2xl flex items-center justify-center shadow-sm">
                <i data-lucide="package" class="w-6 h-6"></i>
            </div>
            <div>
                <h2 class="text-xl font-bold text-gray-900 font-display">Katalog Produk</h2>
                <p class="text-xs text-text-muted font-medium">Kelola data nastar dan kue kering Anda</p>
            </div>
        </div>
        
        <div class="flex flex-col sm:flex-row items-center gap-4 w-full sm:w-auto" x-data="{ 
            search: '<?= esc($keyword ?? '') ?>',
            isSearching: false,
            performSearch() {
                this.isSearching = true;
                fetch('<?= base_url('admin/produk') ?>?keyword=' + encodeURIComponent(this.search), {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                })
                .then(response => response.text())
                .then(html => {
                    document.getElementById('product-table-body').innerHTML = html;
                    lucide.createIcons();
                    this.isSearching = false;
                });
            }
        }">
            <div class="relative w-full sm:w-64 group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors">
                    <template x-if="!isSearching">
                        <i data-lucide="search" class="w-4 h-4"></i>
                    </template>
                    <template x-if="isSearching">
                        <div class="w-4 h-4 border-2 border-primary/30 border-t-primary rounded-full animate-spin"></div>
                    </template>
                </div>
                <input type="text" x-model="search" @input.debounce.300ms="performSearch()" placeholder="Cari nama produk..." 
                       class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-100 rounded-2xl text-xs font-medium focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all">
            </div>

            <a href="<?= base_url('admin/produk/tambah') ?>" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 bg-primary text-white font-bold text-sm rounded-2xl shadow-lg shadow-green-100 hover:bg-primary-dark hover:-translate-y-1 transition-all">
                <i data-lucide="plus" class="w-5 h-5"></i>
                Tambah Produk
            </a>
        </div>
    </div>

    
    <div class="overflow-x-auto no-scrollbar">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50/50">
                    <th class="px-8 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">No</th>
                    <th class="px-4 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Produk</th>
                    <th class="px-4 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Harga</th>
                    <th class="px-4 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest text-center">Stok</th>
                    <th class="px-8 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50" id="product-table-body">
                <?= view('admin/products/_table_rows', ['products' => $products]) ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
