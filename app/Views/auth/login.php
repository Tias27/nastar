<?= $this->extend('layouts/auth') ?>
<?= $this->section('content') ?>

<div class="space-y-2 mb-8">
    <h1 class="text-2xl font-bold text-gray-900 font-display">Selamat Datang Kembali!</h1>
    <p class="text-sm text-gray-500">Silakan masuk ke akun Anda untuk mulai berbelanja.</p>
</div>


<?php if (session()->getFlashdata('error')): ?>
    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 text-sm rounded-r-lg flex items-center gap-3">
        <i data-lucide="alert-circle" class="w-5 h-5 flex-shrink-0"></i>
        <span><?= session()->getFlashdata('error') ?></span>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('success')): ?>
    <div class="mb-6 p-4 bg-green-50 border-l-4 border-primary text-primary-dark text-sm rounded-r-lg flex items-center gap-3">
        <i data-lucide="check-circle" class="w-5 h-5 flex-shrink-0"></i>
        <span><?= session()->getFlashdata('success') ?></span>
    </div>
<?php endif; ?>

<form action="<?= base_url('login/proses') ?>" method="POST" class="space-y-6">
    <?= csrf_field() ?>
    
    <div class="space-y-2">
        <label for="username" class="text-xs font-bold text-gray-700 uppercase tracking-wider block">Username / Email</label>
        <div class="relative group">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors">
                <i data-lucide="user" class="w-5 h-5"></i>
            </div>
            <input type="text" name="username" id="username" required
                   class="block w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-2xl text-sm focus:ring-4 focus:ring-primary/10 focus:border-primary focus:bg-white transition-all outline-none"
                   placeholder="Masukkan username atau email">
        </div>
    </div>

    <div class="space-y-2" x-data="{ show: false }">
        <div class="flex justify-between items-center">
            <label for="password" class="text-xs font-bold text-gray-700 uppercase tracking-wider block">Password</label>
            <a href="<?= base_url('forgot-password') ?>" class="text-xs font-bold text-primary hover:underline">Lupa Password?</a>
        </div>
        <div class="relative group">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors">
                <i data-lucide="lock" class="w-5 h-5"></i>
            </div>
            <input :type="show ? 'text' : 'password'" name="password" id="password" required
                   class="block w-full pl-11 pr-12 py-3.5 bg-gray-50 border border-gray-200 rounded-2xl text-sm focus:ring-4 focus:ring-primary/10 focus:border-primary focus:bg-white transition-all outline-none"
                   placeholder="••••••••">
            <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600 transition-colors">
                <i data-lucide="eye" class="w-5 h-5" x-show="!show"></i>
                <i data-lucide="eye-off" class="w-5 h-5" x-show="show"></i>
            </button>
        </div>
    </div>

    <div class="flex items-center">
        <input type="checkbox" name="remember" id="remember" class="w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary">
        <label for="remember" class="ml-2 block text-sm text-gray-600">Ingat saya</label>
    </div>

    <button type="submit" class="w-full py-4 bg-primary text-white font-bold rounded-2xl shadow-lg shadow-green-100 hover:bg-primary-dark hover:-translate-y-0.5 transition-all focus:ring-4 focus:ring-primary/20">
        Masuk Sekarang
    </button>
</form>

<div class="mt-8 pt-8 border-t border-gray-50 text-center">
    <p class="text-sm text-gray-600">
        Belum punya akun? 
        <a href="<?= base_url('register') ?>" class="text-primary font-bold hover:underline">Daftar Gratis</a>
    </p>
</div>

<?= $this->endSection() ?>