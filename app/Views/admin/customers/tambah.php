<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="max-w-4xl mx-auto space-y-6 animate-fade-in">
    
    <nav class="flex mb-4 text-[10px] font-black uppercase tracking-widest text-gray-400">
        <ol class="flex items-center gap-2">
            <li><a href="<?= base_url('admin/pelanggan') ?>" class="hover:text-primary transition-colors">Pelanggan</a></li>
            <li><i data-lucide="chevron-right" class="w-3 h-3"></i></li>
            <li class="text-primary">Tambah Baru</li>
        </ol>
    </nav>

    <div class="flex items-center gap-4 mb-8">
        <div class="w-12 h-12 bg-primary-light text-primary rounded-2xl flex items-center justify-center shadow-sm">
            <i data-lucide="user-plus" class="w-6 h-6"></i>
        </div>
        <div>
            <h1 class="text-2xl font-black font-display text-gray-900 tracking-tight">Tambah <span class="text-primary italic">Pelanggan</span></h1>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mt-1">Registrasi akun pelanggan baru secara manual</p>
        </div>
    </div>

    
    <div class="bg-white rounded-[2.5rem] border border-gray-100 shadow-elegant overflow-hidden p-8 lg:p-12">
        <form action="<?= base_url('admin/pelanggan/simpan') ?>" method="POST" class="space-y-8">
            <?= csrf_field() ?>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Nama Lengkap</label>
                    <input type="text" name="nama" required 
                           class="block w-full px-5 py-3.5 bg-gray-50 border border-gray-100 rounded-2xl text-sm font-bold focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all" 
                           placeholder="Masukkan nama lengkap">
                </div>

                
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Username</label>
                    <input type="text" name="username" required 
                           class="block w-full px-5 py-3.5 bg-gray-50 border border-gray-100 rounded-2xl text-sm font-bold focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all" 
                           placeholder="Contoh: bulan_cookies">
                </div>

                
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Nomor WhatsApp</label>
                    <input type="text" name="phone" required 
                           class="block w-full px-5 py-3.5 bg-gray-50 border border-gray-100 rounded-2xl text-sm font-bold focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all" 
                           placeholder="0812xxxxxxxx">
                </div>

                
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Password</label>
                    <input type="password" name="password" required 
                           class="block w-full px-5 py-3.5 bg-gray-50 border border-gray-100 rounded-2xl text-sm font-bold focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all" 
                           placeholder="••••••••">
                </div>
            </div>

            
            <div class="space-y-2">
                <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Alamat Lengkap</label>
                <textarea name="alamat" rows="3" required 
                          class="block w-full px-5 py-3.5 bg-gray-50 border border-gray-100 rounded-2xl text-sm font-bold focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all resize-none" 
                          placeholder="Masukkan alamat pengiriman default"></textarea>
            </div>

            
            <div class="flex items-center gap-4 pt-6 border-t border-gray-50">
                <button type="submit" class="flex-1 py-4 bg-primary text-white font-black text-xs uppercase tracking-widest rounded-2xl hover:bg-primary-dark shadow-xl shadow-green-100 transition-all flex items-center justify-center gap-3">
                    <i data-lucide="save" class="w-4 h-4"></i> Simpan Pelanggan
                </button>
                <a href="<?= base_url('admin/pelanggan') ?>" class="px-8 py-4 bg-gray-50 text-gray-500 font-black text-xs uppercase tracking-widest rounded-2xl hover:bg-gray-100 transition-all">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
