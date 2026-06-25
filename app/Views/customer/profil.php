<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>


<div class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-12">
        <nav class="flex mb-4 text-xs font-bold uppercase tracking-widest text-text-muted" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2">
                <li><a href="<?= base_url('/') ?>" class="hover:text-primary transition-colors">Beranda</a></li>
                <li><i data-lucide="chevron-right" class="w-3 h-3"></i></li>
                <li><a href="<?= base_url('customer/dashboard') ?>" class="hover:text-primary transition-colors">Dashboard</a></li>
                <li><i data-lucide="chevron-right" class="w-3 h-3"></i></li>
                <li class="text-primary">Profil Saya</li>
            </ol>
        </nav>
        <h1 class="text-3xl lg:text-4xl font-extrabold font-display text-gray-900">Pengaturan <span class="text-primary italic">Profil</span></h1>
    </div>
</div>

<section class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-8">
            
            
            <aside class="w-full lg:w-72 flex-shrink-0 space-y-6">
                <div class="bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-soft text-center space-y-6">
                    <div class="flex flex-col items-center gap-4 mb-6">
                        <div class="relative inline-block group">
                            <div class="w-20 h-20 bg-primary text-white rounded-[2rem] flex items-center justify-center text-3xl font-black shadow-lg shadow-green-100 transform transition-transform group-hover:rotate-12">
                                <?= strtoupper(substr(session()->get('nama'), 0, 1)) ?>
                            </div>
                        </div>
                        <div class="text-center">
                            <h5 class="text-lg font-bold text-gray-900 font-display"><?= session()->get('nama') ?></h5>
                            <p class="text-[10px] text-text-muted font-bold uppercase tracking-widest mt-1">Loyal Member</p>
                        </div>
                    </div>
                    
                    <nav class="space-y-1 text-left pt-6 border-t border-gray-50">
                        <a href="<?= base_url('customer/dashboard') ?>" class="flex items-center gap-3 px-4 py-3 text-text-muted hover:bg-gray-50 hover:text-primary rounded-2xl font-bold text-sm transition-all group">
                            <i data-lucide="layout-grid" class="w-5 h-5"></i>
                            <span>Dashboard</span>
                        </a>
                        <a href="<?= base_url('customer/pesanan') ?>" class="flex items-center gap-3 px-4 py-3 text-text-muted hover:bg-gray-50 hover:text-primary rounded-2xl font-bold text-sm transition-all group">
                            <i data-lucide="package" class="w-5 h-5"></i>
                            <span>Pesanan Saya</span>
                        </a>
                        <a href="<?= base_url('customer/profil') ?>" class="flex items-center gap-3 px-4 py-3 bg-primary-light text-primary rounded-2xl font-bold text-sm transition-all group">
                            <i data-lucide="user" class="w-5 h-5"></i>
                            <span>Profil Saya</span>
                        </a>
                        <div class="pt-4 mt-4 border-t border-gray-50">
                            <a href="<?= base_url('logout') ?>" class="flex items-center gap-3 px-4 py-3 text-red-500 hover:bg-red-50 rounded-2xl font-bold text-sm transition-all group">
                                <i data-lucide="log-out" class="w-5 h-5"></i>
                                <span>Keluar Akun</span>
                            </a>
                        </div>
                    </nav>
                </div>
            </aside>

            
            <div class="flex-1 space-y-8 animate-fade-in-up">
                
                <div class="bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-soft space-y-8">
                    <div class="flex items-center gap-4 border-b border-gray-50 pb-6">
                        <div class="w-10 h-10 lg:w-12 lg:h-12 bg-primary-light rounded-xl lg:rounded-2xl flex items-center justify-center text-primary shadow-sm">
                            <i data-lucide="settings" class="w-5 h-5 lg:w-6 lg:h-6"></i>
                        </div>
                        <div>
                            <h4 class="text-lg lg:text-xl font-bold text-gray-900 font-display">Informasi Akun</h4>
                            <p class="text-[10px] lg:text-xs text-text-muted">Perbarui data diri dan alamat pengiriman Anda</p>
                        </div>
                    </div>

                    <form action="<?= base_url('customer/profil/update') ?>" method="POST" class="space-y-6">
                        <?= csrf_field() ?>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-gray-700 uppercase tracking-widest block pl-1">Nama Lengkap</label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors">
                                        <i data-lucide="user" class="w-5 h-5"></i>
                                    </div>
                                    <input type="text" name="nama" value="<?= session()->get('nama') ?>" required
                                           class="block w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-100 rounded-2xl text-sm font-semibold focus:ring-4 focus:ring-primary/10 focus:border-primary focus:bg-white transition-all outline-none">
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="text-xs font-bold text-gray-700 uppercase tracking-widest block pl-1">Username</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                                        <i data-lucide="at-sign" class="w-5 h-5"></i>
                                    </div>
                                    <input type="text" value="<?= session()->get('username') ?>" disabled
                                           class="block w-full pl-11 pr-4 py-3.5 bg-gray-100 border border-gray-100 rounded-2xl text-sm font-semibold text-gray-400 cursor-not-allowed">
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="text-xs font-bold text-gray-700 uppercase tracking-widest block pl-1">Email</label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors">
                                        <i data-lucide="mail" class="w-5 h-5"></i>
                                    </div>
                                    <input type="email" name="email" value="<?= session()->get('email') ?>" required
                                           class="block w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-100 rounded-2xl text-sm font-semibold focus:ring-4 focus:ring-primary/10 focus:border-primary focus:bg-white transition-all outline-none">
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="text-xs font-bold text-gray-700 uppercase tracking-widest block pl-1">No. Handphone</label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors">
                                        <i data-lucide="phone" class="w-5 h-5"></i>
                                    </div>
                                    <input type="text" name="no_telp" value="<?= session()->get('no_telp') ?>"
                                           class="block w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-100 rounded-2xl text-sm font-semibold focus:ring-4 focus:ring-primary/10 focus:border-primary focus:bg-white transition-all outline-none"
                                           placeholder="628xxx">
                                </div>
                            </div>

                            <div class="space-y-2 md:col-span-2">
                                <label class="text-xs font-bold text-gray-700 uppercase tracking-widest block pl-1">Alamat Utama</label>
                                <div class="relative group">
                                    <div class="absolute top-4 left-4 flex items-start pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors">
                                        <i data-lucide="map-pin" class="w-5 h-5"></i>
                                    </div>
                                    <textarea name="alamat" rows="4" required
                                              class="block w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-100 rounded-3xl text-sm font-semibold focus:ring-4 focus:ring-primary/10 focus:border-primary focus:bg-white transition-all outline-none"
                                              placeholder="Alamat lengkap pengiriman..."><?= session()->get('alamat') ?></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="pt-6 border-t border-gray-50 flex flex-col sm:flex-row items-center justify-between gap-4">
                            <p class="text-xs text-text-muted max-w-sm">
                                <strong>Catatan:</strong> Perubahan data mungkin memerlukan waktu beberapa saat untuk sinkronisasi di semua sistem kami.
                            </p>
                            <button type="submit" class="w-full sm:w-auto px-10 py-4 bg-primary text-white font-bold rounded-2xl shadow-lg shadow-green-100 hover:bg-primary-dark hover:-translate-y-1 transition-all flex items-center justify-center gap-2">
                                <i data-lucide="save" class="w-5 h-5"></i>
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>

                
                <div class="bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-soft space-y-8 animate-fade-in-up" style="animation-delay: 0.2s">
                    <div class="flex items-center gap-4 border-b border-gray-50 pb-6">
                        <div class="w-12 h-12 bg-red-50 rounded-2xl flex items-center justify-center text-red-500 shadow-sm">
                            <i data-lucide="key" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-gray-900 font-display">Ubah Password</h4>
                            <p class="text-xs text-text-muted">Jaga keamanan akun Anda dengan password yang kuat</p>
                        </div>
                    </div>

                    <form action="<?= base_url('customer/profil/password') ?>" method="POST" class="space-y-6">
                        <?= csrf_field() ?>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-gray-700 uppercase tracking-widest block pl-1">Password Baru</label>
                                <input type="password" name="password" required
                                       class="block w-full px-5 py-3.5 bg-gray-50 border border-gray-100 rounded-2xl text-sm font-semibold focus:ring-4 focus:ring-red-100 focus:border-red-300 focus:bg-white transition-all outline-none"
                                       placeholder="••••••••">
                            </div>
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-gray-700 uppercase tracking-widest block pl-1">Konfirmasi Password</label>
                                <input type="password" name="confpassword" required
                                       class="block w-full px-5 py-3.5 bg-gray-50 border border-gray-100 rounded-2xl text-sm font-semibold focus:ring-4 focus:ring-red-100 focus:border-red-300 focus:bg-white transition-all outline-none"
                                       placeholder="••••••••">
                            </div>
                        </div>
                        <div class="pt-2 flex justify-end">
                            <button type="submit" class="w-full sm:w-auto px-10 py-4 bg-gray-900 text-white font-bold rounded-2xl hover:bg-black transition-all">
                                Update Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
