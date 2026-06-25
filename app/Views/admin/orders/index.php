<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="bg-white rounded-[2.5rem] border border-gray-100 shadow-soft overflow-hidden animate-fade-in">
    
    <div class="p-8 border-b border-gray-50 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 bg-blue-50 text-blue-500 rounded-2xl flex items-center justify-center shadow-sm">
                <i data-lucide="shopping-bag" class="w-6 h-6"></i>
            </div>
            <div>
                <h2 class="text-xl font-bold text-gray-900 font-display">Manajemen Pesanan</h2>
                <p class="text-xs text-text-muted font-medium">Pantau dan kelola semua transaksi masuk</p>
            </div>
        </div>

        
        <div class="flex flex-col sm:flex-row items-center gap-4">
            <div class="relative w-full sm:w-64 group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors">
                    <i data-lucide="search" class="w-4 h-4"></i>
                </div>
                <input type="text" id="order-search" placeholder="Cari ID / Nama..." 
                       class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-100 rounded-2xl text-xs font-medium focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all">
            </div>
        </div>
    </div>

    
    <div class="px-8 py-4 bg-gray-50/50 border-b border-gray-50 overflow-x-auto no-scrollbar">
        <div class="flex items-center gap-2 min-w-max">
            <?php 
            $status_filter = $_GET['status'] ?? '';
            $statuses = [
                '' => 'Semua',
                'pending' => 'Pending',
                'processing' => 'Diproses',
                'shipped' => 'Dikirim',
                'delivered' => 'Selesai',
                'cancelled' => 'Batal'
            ];
            ?>
            <?php foreach ($statuses as $val => $label): ?>
                <a href="<?= base_url('admin/pesanan' . ($val ? '?status=' . $val : '')) ?>" 
                   class="px-5 py-2 text-xs font-bold rounded-xl transition-all <?= ($status_filter == $val) ? 'bg-primary text-white shadow-md shadow-green-100' : 'text-gray-500 hover:bg-white hover:text-primary' ?>">
                    <?= $label ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

    
    <div class="overflow-x-auto no-scrollbar">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="text-[10px] font-black text-gray-400 uppercase tracking-widest bg-white">
                    <th class="px-8 py-4">ID Order</th>
                    <th class="px-4 py-4">Pelanggan</th>
                    <th class="px-4 py-4">Tanggal</th>
                    <th class="px-4 py-4">Status</th>
                    <th class="px-4 py-4">Total Bayar</th>
                    <th class="px-8 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody id="order-table-body" class="divide-y divide-gray-50">
                <?= view('admin/orders/_table_rows', ['orders' => $orders]) ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->section('scripts') ?>
<script>
    const searchInput = document.getElementById('order-search');
    const tableBody = document.getElementById('order-table-body');
    const currentStatus = '<?= $status_filter ?>';

    let timeout = null;

    searchInput.addEventListener('input', function() {
        clearTimeout(timeout);
        const query = this.value;

        timeout = setTimeout(() => {
            fetch(`<?= base_url('admin/pesanan/search') ?>?query=${query}&status=${currentStatus}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.text())
            .then(html => {
                tableBody.innerHTML = html;
                lucide.createIcons(); // Re-initialize icons for new rows
            });
        }, 300);
    });
</script>
<?= $this->endSection() ?>

<?= $this->endSection() ?>
