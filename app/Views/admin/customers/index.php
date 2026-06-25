<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="space-y-6 animate-fade-in">
    
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h1 class="text-2xl font-black font-display text-gray-900 tracking-tight">Manajemen <span class="text-primary italic">Pelanggan</span></h1>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mt-1">Daftar pengguna yang terdaftar di sistem</p>
        </div>
        <div class="flex flex-col sm:flex-row gap-3 items-center">
            <div class="relative w-full sm:w-64 group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors">
                    <i data-lucide="search" class="w-4 h-4"></i>
                </div>
                <input type="text" id="customer-search" placeholder="Cari Nama / Username..." 
                       class="block w-full pl-11 pr-4 py-3 bg-white border border-gray-100 rounded-2xl text-xs font-medium focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all shadow-sm">
            </div>
            <a href="<?= base_url('admin/pelanggan/tambah') ?>" 
               class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-primary text-white font-black text-[10px] uppercase tracking-widest rounded-2xl hover:bg-primary-dark shadow-lg shadow-green-100 transition-all w-full sm:w-auto">
                <i data-lucide="plus" class="w-4 h-4"></i> Tambah
            </a>
        </div>
    </div>

    
    <div class="bg-white rounded-[2.5rem] border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-50">
                        <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest">Nama Pelanggan</th>
                        <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest">Username</th>
                        <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest">No. WhatsApp</th>
                        <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest">Bergabung</th>
                        <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <?php if(empty($customers)): ?>
                        <tr>
                            <td colspan="5" class="px-8 py-20 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center text-gray-300">
                                        <i data-lucide="users" class="w-8 h-8"></i>
                                    </div>
                                    <p class="text-sm font-bold text-gray-400 uppercase tracking-widest">Belum ada data pelanggan</p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>

                    <?php foreach ($customers as $c): ?>
                    <tr class="hover:bg-gray-50/50 transition-all group">
                        <td class="px-8 py-5">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-primary-light text-primary rounded-xl flex items-center justify-center font-black text-sm shadow-sm">
                                    <?= strtoupper(substr($c['nama'], 0, 1)) ?>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-900 leading-tight"><?= esc($c['nama']) ?></p>
                                    <p class="text-[10px] text-gray-400 font-medium"><?= esc($c['email'] ?? 'No Email') ?></p>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-5">
                            <span class="text-xs font-bold text-gray-600 bg-gray-100 px-3 py-1 rounded-lg">@<?= esc($c['username']) ?></span>
                        </td>
                        <td class="px-8 py-5">
                            <a href="https://wa.me/<?= $c['phone'] ?>" target="_blank" class="text-sm font-bold text-gray-700 hover:text-primary transition-colors flex items-center gap-2">
                                <i data-lucide="phone" class="w-3.5 h-3.5 text-green-500"></i>
                                <?= esc($c['phone']) ?>
                            </a>
                        </td>
                        <td class="px-8 py-5">
                            <span class="text-xs font-bold text-gray-500 italic"><?= date('d M Y', strtotime($c['created_at'])) ?></span>
                        </td>
                        <td class="px-8 py-5 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="<?= base_url('admin/pelanggan/detail/' . $c['id_customer']) ?>" 
                                   class="w-9 h-9 flex items-center justify-center bg-white border border-gray-100 rounded-xl text-gray-400 hover:text-blue-500 hover:border-blue-500 transition-all shadow-sm"
                                   title="Detail">
                                    <i data-lucide="eye" class="w-4 h-4"></i>
                                </a>
                                <a href="<?= base_url('admin/pelanggan/edit/' . $c['id_customer']) ?>" 
                                   class="w-9 h-9 flex items-center justify-center bg-white border border-gray-100 rounded-xl text-gray-400 hover:text-amber-500 hover:border-amber-500 transition-all shadow-sm"
                                   title="Edit">
                                    <i data-lucide="edit-3" class="w-4 h-4"></i>
                                </a>
                                <a href="<?= base_url('admin/pelanggan/delete/' . $c['id_customer']) ?>" 
                                   class="w-9 h-9 flex items-center justify-center bg-white border border-gray-100 rounded-xl text-gray-400 hover:text-red-500 hover:border-red-500 transition-all shadow-sm"
                                   onclick="return confirm('Hapus pelanggan ini?')"
                                   title="Hapus">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->section('scripts') ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('customer-search');
    const tbody = document.querySelector('tbody');

    searchInput.addEventListener('input', function() {
        const query = this.value;
        
        fetch(`<?= base_url('admin/pelanggan/search') ?>?query=${query}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(response => response.text())
        .then(html => {
            tbody.innerHTML = html;
            lucide.createIcons();
        });
    });
});
</script>
<?= $this->endSection() ?>

<?= $this->endSection() ?>
