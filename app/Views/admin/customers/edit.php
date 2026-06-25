<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="max-w-4xl mx-auto space-y-6 animate-fade-in">
    
    <nav class="flex mb-4 text-[10px] font-black uppercase tracking-widest text-gray-400">
        <ol class="flex items-center gap-2">
            <li><a href="<?= base_url('admin/pelanggan') ?>" class="hover:text-primary transition-colors">Pelanggan</a></li>
            <li><i data-lucide="chevron-right" class="w-3 h-3"></i></li>
            <li class="text-primary">Edit Profil</li>
        </ol>
    </nav>

    <div class="flex items-center gap-4 mb-8">
        <div class="w-12 h-12 bg-amber-50 text-amber-500 rounded-2xl flex items-center justify-center shadow-sm">
            <i data-lucide="user-cog" class="w-6 h-6"></i>
        </div>
        <div>
            <h1 class="text-2xl font-black font-display text-gray-900 tracking-tight">Edit <span class="text-amber-500 italic">Pelanggan</span></h1>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mt-1">Perbarui informasi akun pelanggan #<?= $customer['id_customer'] ?></p>
        </div>
    </div>

    
    <div class="bg-white rounded-[2.5rem] border border-gray-100 shadow-elegant overflow-hidden p-8 lg:p-12">
        <form action="<?= base_url('admin/pelanggan/update/' . $customer['id_customer']) ?>" method="POST" class="space-y-8">
            <?= csrf_field() ?>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Nama Lengkap</label>
                    <input type="text" name="nama" value="<?= esc($customer['nama']) ?>" required 
                           class="block w-full px-5 py-3.5 bg-gray-50 border border-gray-100 rounded-2xl text-sm font-bold focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all">
                </div>

                
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Username</label>
                    <input type="text" name="username" value="<?= esc($customer['username']) ?>" required 
                           class="block w-full px-5 py-3.5 bg-gray-100 border border-gray-200 rounded-2xl text-sm font-bold text-gray-400 cursor-not-allowed outline-none" readonly>
                    <p class="text-[10px] text-gray-400 italic ml-1">*Username tidak dapat diubah</p>
                </div>

                
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Nomor WhatsApp</label>
                    <input type="text" name="phone" value="<?= esc($customer['phone']) ?>" required 
                           class="block w-full px-5 py-3.5 bg-gray-50 border border-gray-100 rounded-2xl text-sm font-bold focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all">
                </div>

                
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Password Baru</label>
                    <input type="password" name="password" 
                           class="block w-full px-5 py-3.5 bg-gray-50 border border-gray-100 rounded-2xl text-sm font-bold focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all" 
                           placeholder="Kosongkan jika tidak ingin diubah">
                </div>
            </div>

            
            <div class="space-y-2">
                <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Alamat Lengkap</label>
                <textarea name="alamat" rows="3" required 
                          class="block w-full px-5 py-3.5 bg-gray-50 border border-gray-100 rounded-2xl text-sm font-bold focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all resize-none"><?= esc($customer['alamat']) ?></textarea>
            </div>

            
            <div class="flex items-center gap-4 pt-6 border-t border-gray-50">
                <button type="submit" class="flex-1 py-4 bg-amber-500 text-white font-black text-xs uppercase tracking-widest rounded-2xl hover:bg-amber-600 shadow-xl shadow-amber-100 transition-all flex items-center justify-center gap-3">
                    <i data-lucide="refresh-cw" class="w-4 h-4"></i> Simpan Perubahan
                </button>
                <a href="<?= base_url('admin/pelanggan') ?>" class="px-8 py-4 bg-gray-50 text-gray-500 font-black text-xs uppercase tracking-widest rounded-2xl hover:bg-gray-100 transition-all">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
