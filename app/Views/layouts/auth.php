<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? esc($title) : 'Authentication - Bulan Cake' ?></title>
    
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    
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
                        background: '#FFFFFF',
                        surface: '#F3F4F6',
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
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-50 font-sans min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md">
        
        <div class="flex flex-col items-center mb-8">
            <a href="<?= base_url('/') ?>" class="flex items-center gap-3 group">
                <div class="w-12 h-12 bg-primary rounded-2xl flex items-center justify-center text-white shadow-lg transform transition-transform group-hover:scale-110">
                    <i data-lucide="moon" class="w-7 h-7"></i>
                </div>
                <div class="text-left">
                    <span class="block text-2xl font-black font-display leading-none text-primary">Bulan</span>
                    <span class="block text-xs font-bold text-gray-400 uppercase tracking-widest">Cake & Cookies</span>
                </div>
            </a>
        </div>

        
        <div class="bg-white rounded-[2rem] shadow-xl border border-gray-100 overflow-hidden">
            <div class="p-8 sm:p-10">
                <?= $this->renderSection('content') ?>
            </div>
        </div>

        
        <p class="mt-8 text-center text-sm text-gray-400">
            &copy; <?= date('Y') ?> Bulan Cake & Cookies. All rights reserved.
        </p>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
