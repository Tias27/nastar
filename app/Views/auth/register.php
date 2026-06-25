<?= $this->extend('layouts/auth') ?>
<?= $this->section('content') ?>

<div class="space-y-2 mb-8">
    <h1 class="text-2xl font-bold text-gray-900 font-display">Buat Akun Baru</h1>
    <p class="text-sm text-gray-500">Daftar sekarang dan nikmati nastar premium terbaik.</p>
</div>


<?php if (session()->getFlashdata('errors')): ?>
    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 text-sm rounded-r-lg flex flex-col gap-1">
        <?php foreach (session()->getFlashdata('errors') as $error): ?>
            <div class="flex items-center gap-3">
                <i data-lucide="alert-circle" class="w-4 h-4 flex-shrink-0"></i>
                <span><?= esc($error) ?></span>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 text-sm rounded-r-lg flex flex-col gap-1">
        <div class="flex items-center gap-3">
            <i data-lucide="alert-circle" class="w-4 h-4 flex-shrink-0"></i>
            <span><?= esc(session()->getFlashdata('error')) ?></span>
        </div>
    </div>
<?php endif; ?>

<form action="<?= base_url('register/proses') ?>" method="POST" class="space-y-5" x-data="{ password: '', confpassword: '' }">
    <?= csrf_field() ?>
    
    <div class="space-y-2">
        <label for="nama" class="text-xs font-bold text-gray-700 uppercase tracking-wider block">Nama Lengkap</label>
        <div class="relative group">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors">
                <i data-lucide="user" class="w-5 h-5"></i>
            </div>
            <input type="text" name="nama" id="nama" required value="<?= old('nama') ?>"
                   class="block w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-2xl text-sm focus:ring-4 focus:ring-primary/10 focus:border-primary focus:bg-white transition-all outline-none"
                   placeholder="Nama lengkap sesuai KTP">
        </div>
    </div>

    <div class="space-y-2">
        <label for="username" class="text-xs font-bold text-gray-700 uppercase tracking-wider block">Username</label>
        <div class="relative group">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors">
                <i data-lucide="at-sign" class="w-5 h-5"></i>
            </div>
            <input type="text" name="username" id="username" required value="<?= old('username') ?>"
                   class="block w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-2xl text-sm focus:ring-4 focus:ring-primary/10 focus:border-primary focus:bg-white transition-all outline-none"
                   placeholder="Username unik">
        </div>
    </div>

    <div class="space-y-2">
        <label for="phone" class="text-xs font-bold text-gray-700 uppercase tracking-wider block">No. WhatsApp</label>
        <div class="relative group">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors">
                <i data-lucide="phone" class="w-5 h-5"></i>
            </div>
            <input type="text" name="phone" id="phone" required value="<?= old('phone') ?>"
                   class="block w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-2xl text-sm focus:ring-4 focus:ring-primary/10 focus:border-primary focus:bg-white transition-all outline-none"
                   placeholder="08xxxxxxxxxx">
        </div>
    </div>

    <div class="space-y-2">
        <label for="alamat" class="text-xs font-bold text-gray-700 uppercase tracking-wider block">Alamat Lengkap</label>
        <div class="relative group">
            <div class="absolute inset-y-0 left-0 pl-4 pt-3.5 flex items-start pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors">
                <i data-lucide="map-pin" class="w-5 h-5"></i>
            </div>
            <textarea name="alamat" id="alamat" required rows="3"
                   class="block w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-2xl text-sm focus:ring-4 focus:ring-primary/10 focus:border-primary focus:bg-white transition-all outline-none"
                   placeholder="Masukkan alamat lengkap pengiriman"><?= old('alamat') ?></textarea>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div class="space-y-2" x-data="{ show: false }">
            <label for="password" class="text-xs font-bold text-gray-700 uppercase tracking-wider block">Password</label>
            <div class="relative group">
                <input :type="show ? 'text' : 'password'" name="password" id="password" required x-model="password"
                       class="block w-full px-4 py-3.5 bg-gray-50 border rounded-2xl text-sm focus:ring-4 focus:bg-white transition-all outline-none"
                       :class="password.length > 0 && password.length < 6 ? 'border-red-500 focus:ring-red-100 focus:border-red-500' : 'border-gray-200 focus:ring-primary/10 focus:border-primary'"
                       placeholder="••••••••">
                <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400">
                    <i data-lucide="eye" class="w-4 h-4" x-show="!show"></i>
                    <i data-lucide="eye-off" class="w-4 h-4" x-show="show"></i>
                </button>
            </div>
            <p x-show="password.length > 0 && password.length < 6" x-cloak class="text-[10px] font-bold text-red-500 mt-1">Password minimal 6 karakter</p>
        </div>
        <div class="space-y-2" x-data="{ show: false }">
            <label for="confpassword" class="text-xs font-bold text-gray-700 uppercase tracking-wider block">Konfirmasi</label>
            <div class="relative group">
                <input :type="show ? 'text' : 'password'" name="confpassword" id="confpassword" required x-model="confpassword"
                       class="block w-full px-4 py-3.5 bg-gray-50 border rounded-2xl text-sm focus:ring-4 focus:bg-white transition-all outline-none"
                       :class="(confpassword.length > 0 && confpassword !== password) ? 'border-red-500 focus:ring-red-100 focus:border-red-500' : ((confpassword.length > 0 && confpassword === password && password.length >= 6) ? 'border-green-500 focus:ring-green-100 focus:border-green-500' : 'border-gray-200 focus:ring-primary/10 focus:border-primary')"
                       placeholder="••••••••">
                <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400">
                    <i data-lucide="eye" class="w-4 h-4" x-show="!show"></i>
                    <i data-lucide="eye-off" class="w-4 h-4" x-show="show"></i>
                </button>
            </div>
            <p x-show="confpassword.length > 0 && confpassword !== password" x-cloak class="text-[10px] font-bold text-red-500 mt-1">Konfirmasi password tidak cocok</p>
            <p x-show="confpassword.length > 0 && confpassword === password && password.length >= 6" x-cloak class="text-[10px] font-bold text-green-500 mt-1">Password cocok</p>
        </div>
    </div>

    <div class="flex items-start">
        <input type="checkbox" required id="terms" class="mt-1 w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary">
        <label for="terms" class="ml-2 block text-sm text-gray-600 leading-tight">
            Saya setuju dengan <a href="#" class="text-primary font-bold hover:underline">Syarat & Ketentuan</a> serta <a href="#" class="text-primary font-bold hover:underline">Kebijakan Privasi</a>.
        </label>
    </div>

    <button type="submit" class="w-full py-4 bg-primary text-white font-bold rounded-2xl shadow-lg shadow-green-100 hover:bg-primary-dark hover:-translate-y-0.5 transition-all">
        Daftar Sekarang
    </button>
</form>

<div class="mt-8 pt-8 border-t border-gray-50 text-center">
    <p class="text-sm text-gray-600">
        Sudah punya akun? 
        <a href="<?= base_url('login') ?>" class="text-primary font-bold hover:underline">Masuk di sini</a>
    </p>
</div>

<?= $this->endSection() ?>