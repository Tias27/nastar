<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Bulan Cake & Cookies - Toko kue nastar premium, lembut, dengan selai nanas asli pilihan. Pesan sekarang untuk pengiriman ke seluruh Indonesia.">
    <title><?= isset($title) ? esc($title) : 'Bulan Cake & Cookies' ?></title>

    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            DEFAULT: '#03AC0E',
                            dark: '#028e0b',
                            light: '#e8f5e9',
                        },
                        secondary: '#FF5722',
                        accent: '#FFC107',
                        background: '#FFFFFF',
                        surface: '#F3F4F6',
                        'text-main': '#212121',
                        'text-muted': '#6D7588',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        display: ['Poppins', 'sans-serif'],
                    },
                    boxShadow: {
                        'soft': '0 2px 10px rgba(0, 0, 0, 0.05)',
                        'elegant': '0 10px 40px rgba(0, 0, 0, 0.04)',
                    }
                }
            }
        }
    </script>

    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    
    <script src="https://unpkg.com/lucide@latest"></script>

    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">

    <style>
        [x-cloak] { display: none !important; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        
        @keyframes fade-in-up {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up { animation: fade-in-up 0.6s ease-out forwards; }
    </style>

    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🍍</text></svg>">
</head>
<body class="bg-gray-50 text-text-main font-sans min-h-screen flex flex-col" x-data="{ mobileMenu: false }">

    
    <nav class="sticky top-0 z-50 bg-white border-b border-gray-100 shadow-sm" x-data="{ scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 20)">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                
                <div class="flex-shrink-0 flex items-center">
                    <a href="<?= base_url('/') ?>" class="flex items-center gap-2 group">
                        <div class="w-8 h-8 sm:w-10 sm:h-10 bg-primary rounded-lg sm:rounded-xl flex items-center justify-center text-white transform transition-transform group-hover:scale-110">
                            <i data-lucide="moon" class="w-5 h-5 sm:w-6 sm:h-6"></i>
                        </div>
                        <div class="hidden sm:block">
                            <span class="block text-lg sm:text-xl font-extrabold font-display leading-none text-primary">Bulan</span>
                            <span class="block text-[8px] sm:text-[10px] font-medium text-text-muted uppercase tracking-wider">Cake & Cookies</span>
                        </div>
                    </a>
                </div>

                
                <div class="hidden md:flex items-center space-x-8">
                    <a href="<?= base_url('/') ?>" class="text-sm font-semibold <?= (current_url() === base_url('/')) ? 'text-primary' : 'text-text-main hover:text-primary transition-colors' ?>">Beranda</a>
                    <a href="<?= base_url('produk') ?>" class="text-sm font-semibold <?= (strpos(current_url(), '/produk') !== false) ? 'text-primary' : 'text-text-main hover:text-primary transition-colors' ?>">Produk</a>
                    <a href="<?= base_url('tentang') ?>" class="text-sm font-semibold <?= (strpos(current_url(), '/tentang') !== false) ? 'text-primary' : 'text-text-main hover:text-primary transition-colors' ?>">Tentang</a>
                    <a href="<?= base_url('kontak') ?>" class="text-sm font-semibold <?= (strpos(current_url(), '/kontak') !== false) ? 'text-primary' : 'text-text-main hover:text-primary transition-colors' ?>">Kontak</a>
                </div>

                
                <div class="flex items-center gap-4">
                    <?php if (session()->get('logged_in')): ?>
                        
                        <a href="<?= base_url('keranjang') ?>" class="relative p-2 text-text-main hover:bg-gray-100 rounded-full transition-colors">
                            <i data-lucide="shopping-cart" class="w-5 h-5"></i>
                            <span class="absolute top-0 right-0 bg-secondary text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full ring-2 ring-white">
                                <?= get_cart_count() ?>
                            </span>
                        </a>

                        
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center gap-2 p-1 pl-3 bg-gray-50 rounded-full hover:bg-gray-100 transition-colors border border-gray-100">
                                <span class="text-xs font-semibold text-gray-700 hidden sm:block"><?= esc(session()->get('nama') ?? session()->get('username')) ?></span>
                                <div class="w-8 h-8 bg-primary-light text-primary rounded-full flex items-center justify-center font-bold">
                                    <?= strtoupper(substr(session()->get('nama') ?? session()->get('username'), 0, 1)) ?>
                                </div>
                            </button>
                            <div x-show="open" @click.away="open = false" x-cloak
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 class="absolute right-0 mt-2 w-48 bg-white rounded-2xl shadow-elegant ring-1 ring-black ring-opacity-5 py-2 z-50">
                                <?php if (session()->get('role') === 'admin'): ?>
                                    <a href="<?= base_url('admin/dashboard') ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 flex items-center gap-2">
                                        <i data-lucide="layout-dashboard" class="w-4 h-4 text-primary"></i> Admin Panel
                                    </a>
                                <?php else: ?>
                                    <a href="<?= base_url('customer/dashboard') ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 flex items-center gap-2">
                                        <i data-lucide="home" class="w-4 h-4 text-primary"></i> Dashboard
                                    </a>
                                    <a href="<?= base_url('customer/pesanan') ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 flex items-center gap-2">
                                        <i data-lucide="package" class="w-4 h-4 text-primary"></i> Pesanan Saya
                                    </a>
                                    <a href="<?= base_url('customer/profil') ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 flex items-center gap-2">
                                        <i data-lucide="user" class="w-4 h-4 text-primary"></i> Profil
                                    </a>
                                <?php endif; ?>
                                <hr class="my-1 border-gray-100">
                                <a href="<?= base_url('logout') ?>" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50 flex items-center gap-2 font-medium">
                                    <i data-lucide="log-out" class="w-4 h-4"></i> Keluar
                                </a>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="flex items-center gap-2">
                            <a href="<?= base_url('login') ?>" class="hidden sm:block text-sm font-bold text-primary hover:bg-primary-light px-4 py-2 rounded-lg transition-colors">Masuk</a>
                            <a href="<?= base_url('register') ?>" class="bg-primary text-white text-sm font-bold px-6 py-2 rounded-lg shadow-md hover:bg-primary-dark transition-all transform hover:-translate-y-0.5">Daftar</a>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </nav>

    
    <div class="fixed top-20 left-1/2 -translate-x-1/2 z-[100] w-full max-w-md px-4 pointer-events-none">
        <?php if (session()->getFlashdata('success')): ?>
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" 
                 class="bg-white border-l-4 border-primary p-4 shadow-elegant flex items-center gap-3 rounded-xl pointer-events-auto mb-4">
                <div class="w-8 h-8 bg-primary-light rounded-full flex items-center justify-center text-primary">
                    <i data-lucide="check" class="w-5 h-5"></i>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-semibold text-gray-800"><?= session()->getFlashdata('success') ?></p>
                </div>
                <button @click="show = false" class="text-gray-400 hover:text-gray-600">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" 
                 class="bg-white border-l-4 border-red-500 p-4 shadow-elegant flex items-center gap-3 rounded-xl pointer-events-auto mb-4">
                <div class="w-8 h-8 bg-red-50 rounded-full flex items-center justify-center text-red-500">
                    <i data-lucide="alert-circle" class="w-5 h-5"></i>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-semibold text-gray-800"><?= session()->getFlashdata('error') ?></p>
                </div>
                <button @click="show = false" class="text-gray-400 hover:text-gray-600">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>
        <?php endif; ?>
    </div>

    
    <main class="flex-grow">
        <?= $this->renderSection('content') ?>
    </main>

    
    <footer class="bg-white border-t border-gray-100 pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
                
                <div class="space-y-6">
                    <a href="<?= base_url('/') ?>" class="flex items-center gap-2">
                        <div class="w-10 h-10 bg-primary rounded-xl flex items-center justify-center text-white">
                            <i data-lucide="moon" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <span class="block text-xl font-extrabold font-display leading-none text-primary">Bulan</span>
                            <span class="block text-[10px] font-medium text-text-muted uppercase tracking-wider">Cake & Cookies</span>
                        </div>
                    </a>
                    <p class="text-sm text-text-muted leading-relaxed">
                        Kami menghadirkan kue nastar berkualitas premium dengan bahan-bahan pilihan terbaik. Dipanggang dengan cinta untuk setiap momen spesial Anda.
                    </p>
                    <div class="flex items-center gap-3 pt-2">
                        <a href="#" class="w-10 h-10 bg-white hover:bg-primary-light hover:text-primary text-gray-600 rounded-full flex items-center justify-center transition-all shadow-sm border border-gray-100">
                            <i data-lucide="instagram" class="w-5 h-5" stroke-width="2.5"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-white hover:bg-primary-light hover:text-primary text-gray-600 rounded-full flex items-center justify-center transition-all shadow-sm border border-gray-100">
                            <i data-lucide="facebook" class="w-5 h-5" stroke-width="2.5"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-white hover:bg-primary-light hover:text-primary text-gray-600 rounded-full flex items-center justify-center transition-all shadow-sm border border-gray-100">
                            <i data-lucide="twitter" class="w-5 h-5" stroke-width="2.5"></i>
                        </a>
                    </div>
                </div>

                
                <div>
                    <h4 class="text-sm font-bold text-gray-800 uppercase tracking-wider mb-6">Menu</h4>
                    <ul class="space-y-4">
                        <li><a href="<?= base_url('/') ?>" class="text-sm text-text-muted hover:text-primary transition-colors">Beranda</a></li>
                        <li><a href="<?= base_url('produk') ?>" class="text-sm text-text-muted hover:text-primary transition-colors">Semua Produk</a></li>
                        <li><a href="<?= base_url('tentang') ?>" class="text-sm text-text-muted hover:text-primary transition-colors">Tentang Kami</a></li>
                        <li><a href="<?= base_url('kontak') ?>" class="text-sm text-text-muted hover:text-primary transition-colors">Hubungi Kami</a></li>
                    </ul>
                </div>

                
                <div>
                    <h4 class="text-sm font-bold text-gray-800 uppercase tracking-wider mb-6">Kategori Populer</h4>
                    <ul class="space-y-4">
                        <li><a href="<?= base_url('produk?category=nastar') ?>" class="text-sm text-text-muted hover:text-primary transition-colors">Nastar Klasik</a></li>
                        <li><a href="<?= base_url('produk?category=keju') ?>" class="text-sm text-text-muted hover:text-primary transition-colors">Nastar Keju</a></li>
                        <li><a href="<?= base_url('produk?category=hampers') ?>" class="text-sm text-text-muted hover:text-primary transition-colors">Paket Hampers</a></li>
                        <li><a href="<?= base_url('produk?category=premium') ?>" class="text-sm text-text-muted hover:text-primary transition-colors">Edisi Premium</a></li>
                    </ul>
                </div>

                
                <div>
                    <h4 class="text-sm font-bold text-gray-800 uppercase tracking-wider mb-6">Kontak Kami</h4>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3">
                            <i data-lucide="map-pin" class="w-5 h-5 text-primary mt-0.5"></i>
                            <span class="text-sm text-text-muted leading-relaxed">Jl. Kue Nastar No. 88, RAJEG, Indonesia</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i data-lucide="phone" class="w-5 h-5 text-primary"></i>
                            <span class="text-sm text-text-muted">+62 8517 3134 780</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i data-lucide="mail" class="w-5 h-5 text-primary"></i>
                            <span class="text-sm text-text-muted">hello@bulancake.id</span>
                        </li>
                    </ul>
                </div>
            </div>

            
            <div class="pt-8 border-t border-gray-100 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-xs text-text-muted">
                    &copy; <?= date('Y') ?> Bulan Cake & Cookies. All rights reserved.
                </p>
                <div class="flex items-center gap-6">
                    <a href="#" class="text-xs text-text-muted hover:text-primary transition-colors">Kebijakan Privasi</a>
                    <a href="#" class="text-xs text-text-muted hover:text-primary transition-colors">Syarat & Ketentuan</a>
                </div>
            </div>
        </div>
    </footer>

    
    <div class="md:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-gray-100 px-4 py-3 flex justify-between items-center z-50">
        <a href="<?= base_url('/') ?>" class="flex flex-col items-center gap-1 <?= (current_url() === base_url('/')) ? 'text-primary' : 'text-text-muted' ?>">
            <i data-lucide="home" class="w-5 h-5"></i>
            <span class="text-[9px] font-bold">Beranda</span>
        </a>
        <a href="<?= base_url('produk') ?>" class="flex flex-col items-center gap-1 <?= (strpos(current_url(), '/produk') !== false) ? 'text-primary' : 'text-text-muted' ?>">
            <i data-lucide="shopping-bag" class="w-5 h-5"></i>
            <span class="text-[9px] font-bold">Produk</span>
        </a>
        <a href="<?= base_url('tentang') ?>" class="flex flex-col items-center gap-1 <?= (strpos(current_url(), '/tentang') !== false) ? 'text-primary' : 'text-text-muted' ?>">
            <i data-lucide="info" class="w-5 h-5"></i>
            <span class="text-[9px] font-bold">Tentang</span>
        </a>
        <a href="<?= base_url('kontak') ?>" class="flex flex-col items-center gap-1 <?= (strpos(current_url(), '/kontak') !== false) ? 'text-primary' : 'text-text-muted' ?>">
            <i data-lucide="phone" class="w-5 h-5"></i>
            <span class="text-[9px] font-bold">Kontak</span>
        </a>
        <a href="<?= session()->get('logged_in') ? (session()->get('role') === 'admin' ? base_url('admin/dashboard') : base_url('customer/dashboard')) : base_url('login') ?>" 
           class="flex flex-col items-center gap-1 <?= (strpos(current_url(), '/customer') !== false || strpos(current_url(), '/login') !== false) ? 'text-primary' : 'text-text-muted' ?>">
            <i data-lucide="user" class="w-5 h-5"></i>
            <span class="text-[9px] font-bold">Akun</span>
        </a>
    </div>

    
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons();
        });
    </script>
    <?= $this->renderSection('scripts') ?>
</body>
</html>