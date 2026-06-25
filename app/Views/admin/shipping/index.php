<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="space-y-6 animate-fade-in">
    
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4" x-data="{
        search: '<?= esc($keyword ?? '') ?>',
        isSearching: false,
        performSearch() {
            this.isSearching = true;
            fetch('<?= base_url('admin/pengiriman') ?>?keyword=' + encodeURIComponent(this.search), {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(response => response.text())
            .then(html => {
                document.getElementById('shipping-table-body').innerHTML = html;
                lucide.createIcons();
                this.isSearching = false;
            });
        }
    }">
        <div>
            <h1 class="text-2xl font-black font-display text-gray-900 tracking-tight">Status <span class="text-primary italic">Pengiriman</span></h1>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mt-1">Pantau dan kelola logistik pesanan pelanggan</p>
        </div>
        
        <div class="relative w-full sm:w-64 group">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors">
                <template x-if="!isSearching">
                    <i data-lucide="search" class="w-4 h-4"></i>
                </template>
                <template x-if="isSearching">
                    <div class="w-4 h-4 border-2 border-primary/30 border-t-primary rounded-full animate-spin"></div>
                </template>
            </div>
            <input type="text" x-model="search" @input.debounce.300ms="performSearch()" placeholder="Cari ID Order atau Resi..." 
                   class="w-full pl-10 pr-4 py-2.5 bg-white border border-gray-100 rounded-2xl text-xs font-medium focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all shadow-sm">
        </div>
    </div>

    
    <div class="bg-white rounded-[2.5rem] border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-50">
                        <th class="px-6 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest">ID Order</th>
                        <th class="px-6 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest">Kurir</th>
                        <th class="px-6 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest">No Resi</th>
                        <th class="px-6 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest">Status Kirim</th>
                        <th class="px-6 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest">Terakhir Update</th>
                        <th class="px-6 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50" id="shipping-table-body">
                    <?= view('admin/shipping/_table_rows', ['shippings' => $shippings]) ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
