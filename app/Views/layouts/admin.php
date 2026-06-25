<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? esc($title) : 'Admin - Bulan Cake & Cookies' ?></title>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">


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
                        sidebar: '#FFFFFF',
                        surface: '#F8F9FA',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        display: ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>


    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>


    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        [x-cloak] {
            display: none !important;
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        @keyframes slide-in {
            from {
                transform: translateX(-100%);
            }

            to {
                transform: translateX(0);
            }
        }

        .animate-slide-in {
            animation: slide-in 0.3s ease-out forwards;
        }

        @media print {
            @page {
                size: A4;
                margin: 25mm 20mm;
            }

            body {
                background: white !important;
                color: black !important;
                font-size: 11pt;
                line-height: 1.5;
            }

            aside,
            header,
            footer,
            .print\:hidden,
            button {
                display: none !important;
            }

            main {
                padding: 0 !important;
                margin: 0 !important;
                width: 100% !important;
            }

            /* Container for print content */
            .flex-1 {
                min-width: 100% !important;
                padding: 0 10mm !important;
            }

            .bg-white, .bg-gray-50, .bg-primary {
                background-color: white !important;
                border: 1px solid #eee !important;
                box-shadow: none !important;
                color: black !important;
            }

            .text-white {
                color: black !important;
            }

            table {
                width: 100% !important;
                border-collapse: collapse !important;
            }

            th, td {
                border: 1px solid #ddd !important;
                padding: 8px !important;
            }

            th {
                background-color: #f8f9fa !important;
                font-weight: bold !important;
                text-transform: uppercase !important;
                font-size: 10pt !important;
            }

            .rounded-\[2\.5rem\], .rounded-2xl, .rounded-xl {
                border-radius: 0 !important;
            }

            .shadow-sm, .shadow-md, .shadow-lg, .shadow-soft {
                box-shadow: none !important;
            }

            .text-primary {
                color: #059669 !important;
            }
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-50 text-gray-900 font-sans min-h-screen flex" x-data="{ sidebarOpen: true, mobileSidebar: false }">


    <aside
        class="hidden lg:flex flex-col w-72 bg-white border-r border-gray-100 h-screen sticky top-0 z-40 transition-all duration-300"
        :class="sidebarOpen ? 'w-72' : 'w-20'">


        <div class="h-20 flex items-center px-6 border-b border-gray-50">
            <a href="<?= base_url('admin/dashboard') ?>" class="flex items-center gap-3 overflow-hidden">
                <div
                    class="w-10 h-10 bg-primary rounded-xl flex-shrink-0 flex items-center justify-center text-white shadow-lg shadow-green-100">
                    <i data-lucide="shield-check" class="w-6 h-6"></i>
                </div>
                <div class="transition-opacity duration-300" :class="sidebarOpen ? 'opacity-100' : 'opacity-0'">
                    <span class="block text-lg font-black font-display leading-none text-primary">Bulan Admin</span>
                    <span class="block text-[8px] font-bold text-gray-400 uppercase tracking-[0.2em]">Management
                        System</span>
                </div>
            </a>
        </div>


        <nav class="flex-1 overflow-y-auto no-scrollbar p-4 space-y-1">
            <?php
            $current_url = current_url();
            $nav_items = [
                ['url' => 'admin/dashboard', 'icon' => 'layout-dashboard', 'label' => 'Dashboard'],
                ['url' => 'admin/pesanan', 'icon' => 'shopping-cart', 'label' => 'Pesanan'],
                ['url' => 'admin/pembayaran', 'icon' => 'credit-card', 'label' => 'Pembayaran'],
                ['url' => 'admin/pengiriman', 'icon' => 'truck', 'label' => 'Pengiriman'],
                ['url' => 'admin/produk', 'icon' => 'package', 'label' => 'Produk'],
                ['url' => 'admin/pelanggan', 'icon' => 'users', 'label' => 'Pelanggan'],
                ['url' => 'admin/laporan', 'icon' => 'bar-chart-3', 'label' => 'Laporan'],
            ];
            ?>

            <?php foreach ($nav_items as $item): ?>
                <?php $is_active = (strpos($current_url, base_url($item['url'])) !== false || (base_url($item['url']) == base_url('admin/dashboard') && $current_url == base_url('admin'))); ?>
                <a href="<?= base_url($item['url']) ?>"
                    class="flex items-center gap-3 px-4 py-3 rounded-2xl font-bold text-sm transition-all group relative <?= $is_active ? 'bg-primary text-white shadow-lg shadow-green-100' : 'text-gray-500 hover:bg-gray-50 hover:text-primary' ?>">
                    <div class="flex-shrink-0">
                        <i data-lucide="<?= $item['icon'] ?>"
                            class="w-5 h-5 <?= $is_active ? 'text-white' : 'group-hover:text-primary' ?>"></i>
                    </div>
                    <span class="transition-opacity duration-300"
                        :class="sidebarOpen ? 'opacity-100' : 'opacity-0 w-0 overflow-hidden'"><?= $item['label'] ?></span>

                    <span class="absolute right-4 opacity-0 group-hover:opacity-100 transition-opacity"
                        x-show="!<?= $is_active ? 'true' : 'false' ?> && sidebarOpen"><i data-lucide="chevron-right"
                            class="w-3 h-3"></i></span>
                </a>
            <?php endforeach; ?>

            <div class="pt-6 mt-6 border-t border-gray-50">
                <a href="<?= base_url('logout') ?>"
                    class="flex items-center gap-3 px-4 py-3 rounded-2xl font-bold text-sm text-red-500 hover:bg-red-50 transition-all group">
                    <div class="flex-shrink-0">
                        <i data-lucide="log-out" class="w-5 h-5"></i>
                    </div>
                    <span :class="sidebarOpen ? 'opacity-100' : 'opacity-0 w-0 overflow-hidden'">Keluar Sistem</span>
                </a>
            </div>
        </nav>


        <div class="p-4 border-t border-gray-50">
            <button @click="sidebarOpen = !sidebarOpen"
                class="w-full flex items-center justify-center p-2 text-gray-400 hover:text-primary hover:bg-gray-50 rounded-xl transition-all">
                <i data-lucide="chevron-left" class="w-5 h-5 transition-transform"
                    :class="!sidebarOpen && 'rotate-180'"></i>
            </button>
        </div>
    </aside>


    <div x-show="mobileSidebar" x-cloak class="fixed inset-0 z-[60] lg:hidden">
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" @click="mobileSidebar = false"></div>
        <aside class="relative w-72 bg-white h-screen flex flex-col shadow-2xl animate-slide-in">

            <div class="h-20 flex items-center px-6 border-b border-gray-50">
                <span class="text-xl font-black font-display text-primary italic">Bulan Admin</span>
                <button @click="mobileSidebar = false" class="ml-auto p-2 text-gray-400"><i data-lucide="x"
                        class="w-6 h-6"></i></button>
            </div>
            <nav class="flex-1 p-4 space-y-1">

                <?php foreach ($nav_items as $item): ?>
                    <a href="<?= base_url($item['url']) ?>"
                        class="flex items-center gap-3 px-4 py-3 rounded-2xl font-bold text-sm text-gray-500 hover:bg-gray-50">
                        <i data-lucide="<?= $item['icon'] ?>" class="w-5 h-5"></i>
                        <span><?= $item['label'] ?></span>
                    </a>
                <?php endforeach; ?>
                <a href="<?= base_url('logout') ?>"
                    class="flex items-center gap-3 px-4 py-3 rounded-2xl font-bold text-sm text-red-500 hover:bg-red-50 mt-10">
                    <i data-lucide="log-out" class="w-5 h-5"></i>
                    <span>Keluar</span>
                </a>
            </nav>
        </aside>
    </div>


    <div class="flex-1 flex flex-col min-h-screen min-w-0">

        <header class="h-20 bg-white border-b border-gray-100 flex items-center px-4 lg:px-8 sticky top-0 z-30">
            <button @click="mobileSidebar = true" class="lg:hidden p-2 text-gray-500 hover:bg-gray-50 rounded-xl mr-2">
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>

            <div class="flex-1"></div>

            <div class="flex items-center gap-4">

                <button
                    class="w-10 h-10 flex items-center justify-center text-gray-400 hover:text-primary hover:bg-gray-50 rounded-xl transition-all relative">
                    <i data-lucide="bell" class="w-5 h-5"></i>
                    <span class="absolute top-2 right-2 w-2 h-2 bg-red-500 rounded-full border-2 border-white"></span>
                </button>

                <div class="w-px h-8 bg-gray-100 mx-2"></div>


                <div class="flex items-center gap-3 pl-2">
                    <div class="text-right hidden sm:block">
                        <p class="text-xs font-black text-gray-900 leading-none"><?= session()->get('nama') ?></p>
                        <p class="text-[10px] font-bold text-primary uppercase mt-1">Super Admin</p>
                    </div>
                    <div
                        class="w-10 h-10 bg-primary-light text-primary rounded-xl flex items-center justify-center font-black shadow-sm">
                        <?= strtoupper(substr(session()->get('nama') ?? 'A', 0, 1)) ?>
                    </div>
                </div>
            </div>
        </header>


        <main class="p-4 lg:p-8 flex-grow">

            <?php if (session()->getFlashdata('success')): ?>
                <div
                    class="mb-6 p-4 bg-green-50 border-l-4 border-primary text-primary-dark text-sm rounded-r-2xl flex items-center gap-3 animate-fade-in">
                    <i data-lucide="check-circle-2" class="w-5 h-5"></i>
                    <span class="font-bold"><?= session()->getFlashdata('success') ?></span>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div
                    class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 text-sm rounded-r-2xl flex items-center gap-3 animate-fade-in">
                    <i data-lucide="alert-circle" class="w-5 h-5"></i>
                    <span class="font-bold"><?= session()->getFlashdata('error') ?></span>
                </div>
            <?php endif; ?>

            <?= $this->renderSection('content') ?>
        </main>


        <footer
            class="px-8 py-6 bg-white border-t border-gray-100 flex flex-col sm:flex-row justify-between items-center gap-4">
            <p class="text-xs text-gray-400 font-bold uppercase tracking-widest">&copy; <?= date('Y') ?> Bulan Admin
                System v2.0</p>
            <div class="flex items-center gap-6">
                <a href="#"
                    class="text-[10px] font-black text-gray-400 hover:text-primary transition-colors uppercase tracking-widest">Support</a>
                <a href="#"
                    class="text-[10px] font-black text-gray-400 hover:text-primary transition-colors uppercase tracking-widest">Privacy</a>
            </div>
        </footer>
    </div>

    <script>
        lucide.createIcons();
    </script>
    <?= $this->renderSection('scripts') ?>
</body>

</html>