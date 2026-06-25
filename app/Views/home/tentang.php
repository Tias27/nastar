<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>


<div class="relative bg-white overflow-hidden border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-12">
        <div class="relative z-10 lg:w-1/2">
            <nav class="flex mb-4 text-xs font-bold uppercase tracking-widest text-primary/60" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2">
                    <li><a href="<?= base_url('/') ?>" class="hover:text-primary transition-colors">Beranda</a></li>
                    <li><i data-lucide="chevron-right" class="w-3 h-3"></i></li>
                    <li class="text-primary">Tentang Kami</li>
                </ol>
            </nav>
            <h1 class="text-4xl lg:text-6xl font-extrabold font-display text-gray-900 leading-tight">
                Warisan Rasa <br>
                <span class="text-primary italic">Tradisional</span> Premium
            </h1>
            <p class="mt-6 text-lg text-gray-500 max-w-xl leading-relaxed">
                Bulan Cake & Cookies menghadirkan kelezatan nastar handmade dengan resep rahasia yang telah diwariskan turun-temurun, menggunakan bahan-bahan pilihan terbaik.
            </p>
        </div>
    </div>
    
    
    <div class="absolute top-0 right-0 w-1/2 h-full hidden lg:block">
        <div class="absolute inset-0 bg-primary/5 skew-x-12 translate-x-24"></div>
        <img src="https://images.unsplash.com/photo-1558961363-fa8fdf82db35?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80" 
             alt="Tentang Bulan Cake" 
             class="absolute inset-0 w-full h-full object-cover rounded-l-[5rem] shadow-2xl">
    </div>
</div>


<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div class="order-2 lg:order-1">
                <div class="space-y-6">
                    <span class="inline-block px-4 py-1.5 bg-primary-light text-primary text-[10px] font-black uppercase tracking-widest rounded-full">Sejak 2015</span>
                    <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 font-display">Kelezatan yang Terlahir dari <span class="text-primary">Tradisi</span></h2>
                    <div class="w-20 h-1.5 bg-primary rounded-full"></div>
                    
                    <div class="space-y-4 text-gray-600 leading-relaxed">
                        <p>
                            Bulan Cake & Cookies bermula dari kecintaan kami terhadap kue tradisional Indonesia. Didirikan pada tahun 2015, misi kami tetap sama: menghadirkan kue berkualitas premium yang dapat dinikmati oleh seluruh keluarga Indonesia.
                        </p>
                        <p>
                            Kami percaya bahwa bahan yang baik adalah kunci dari rasa yang istimewa. Itulah mengapa kami hanya menggunakan nanas pilihan dengan tingkat kematangan sempurna, butter berkualitas tinggi, dan tepung terigu pilihan. Tanpa pengawet, tanpa pewarna buatan.
                        </p>
                    </div>

                   
                </div>
            </div>
            
            <div class="order-1 lg:order-2 relative">
                <div class="relative z-10 aspect-square rounded-[3rem] overflow-hidden shadow-2xl">
                    <img src="https://images.unsplash.com/photo-1558961363-fa8fdf82db35?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80" 
                         alt="Nastar Production" 
                         class="w-full h-full object-cover">
                </div>

            </div>
        </div>
    </div>
</section>


<?= $this->endSection() ?>
