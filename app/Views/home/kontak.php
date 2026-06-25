<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>


<div class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-12">
        <nav class="flex mb-4 text-xs font-bold uppercase tracking-widest text-text-muted" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2">
                <li><a href="<?= base_url('/') ?>" class="hover:text-primary transition-colors">Beranda</a></li>
                <li><i data-lucide="chevron-right" class="w-3 h-3"></i></li>
                <li class="text-primary">Hubungi Kami</li>
            </ol>
        </nav>
        <h1 class="text-4xl lg:text-5xl font-extrabold font-display text-gray-900 leading-tight">
            Mari <span class="text-primary italic">Berdiskusi</span>
        </h1>
        <p class="mt-4 text-gray-500 max-w-2xl leading-relaxed">
            Punya pertanyaan tentang produk, pesanan, atau kemitraan? Tim kami siap mendengarkan dan membantu Anda dengan sepenuh hati.
        </p>
    </div>
</div>

<section class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            
            <div class="lg:col-span-5 space-y-8">
                <div class="bg-white p-10 rounded-[3rem] border border-gray-100 shadow-soft space-y-10">
                    <div class="space-y-8">
                        <div class="flex items-start gap-5">
                            <div class="w-14 h-14 bg-primary-light text-primary rounded-2xl flex-shrink-0 flex items-center justify-center shadow-sm">
                                <i data-lucide="map-pin" class="w-6 h-6"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-black text-gray-900 uppercase tracking-widest mb-1">Lokasi Kami</h4>
                                <p class="text-gray-500 text-sm leading-relaxed">
                                    Jl. Kue Nastar No. 88, <br>
                                    Kec. Rajeg, Tangerang, Banten
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start gap-5">
                            <div class="w-14 h-14 bg-blue-50 text-blue-500 rounded-2xl flex-shrink-0 flex items-center justify-center shadow-sm">
                                <i data-lucide="phone" class="w-6 h-6"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-black text-gray-900 uppercase tracking-widest mb-1">Telepon / WhatsApp</h4>
                                <p class="text-gray-500 text-sm leading-relaxed">+62 851 7313 4780</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-5">
                            <div class="w-14 h-14 bg-purple-50 text-purple-500 rounded-2xl flex-shrink-0 flex items-center justify-center shadow-sm">
                                <i data-lucide="mail" class="w-6 h-6"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-black text-gray-900 uppercase tracking-widest mb-1">Email Support</h4>
                                <p class="text-gray-500 text-sm leading-relaxed">hello@bulancake.id</p>
                            </div>
                        </div>
                    </div>

                    <div class="pt-10 border-t border-gray-50">
                        <h4 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-6 text-center">Ikuti Media Sosial</h4>
                        <div class="flex justify-center gap-4">
                            <a href="#" class="w-12 h-12 bg-gray-50 rounded-xl flex items-center justify-center text-gray-600 hover:bg-primary hover:text-white transition-all shadow-sm">
                                <i data-lucide="instagram" class="w-5 h-5"></i>
                            </a>
                            <a href="#" class="w-12 h-12 bg-gray-50 rounded-xl flex items-center justify-center text-gray-600 hover:bg-primary hover:text-white transition-all shadow-sm">
                                <i data-lucide="facebook" class="w-5 h-5"></i>
                            </a>
                            <a href="#" class="w-12 h-12 bg-gray-50 rounded-xl flex items-center justify-center text-gray-600 hover:bg-primary hover:text-white transition-all shadow-sm">
                                <i data-lucide="twitter" class="w-5 h-5"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                
                <div class="h-64 bg-gray-200 rounded-[3rem] overflow-hidden relative shadow-inner">
                    <img src="https://images.unsplash.com/photo-1524661135-423995f22d0b?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80" 
                         alt="Map Placeholder" 
                         class="w-full h-full object-cover grayscale opacity-50">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="p-4 bg-white rounded-2xl shadow-xl flex items-center gap-3">
                            <div class="w-3 h-3 bg-red-500 rounded-full animate-ping"></div>
                            <span class="text-xs font-black text-gray-900 uppercase tracking-widest">Bulan Cake HQ</span>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="lg:col-span-7">
                <div class="bg-white p-10 lg:p-12 rounded-[3.5rem] border border-gray-100 shadow-soft relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-primary/5 rounded-full -mr-16 -mt-16"></div>
                    
                    <form action="<?= base_url('kontak/kirim') ?>" method="POST" class="space-y-8 relative z-10">
                        <?= csrf_field() ?>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-3">
                                <label class="text-xs font-black text-gray-700 uppercase tracking-widest pl-1">Nama Lengkap</label>
                                <input type="text" name="nama" required 
                                       class="block w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-sm font-semibold focus:ring-4 focus:ring-primary/10 focus:border-primary focus:bg-white transition-all outline-none" 
                                       placeholder="Tulis nama Anda">
                            </div>
                            <div class="space-y-3">
                                <label class="text-xs font-black text-gray-700 uppercase tracking-widest pl-1">Email / WhatsApp</label>
                                <input type="text" name="kontak" required 
                                       class="block w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-sm font-semibold focus:ring-4 focus:ring-primary/10 focus:border-primary focus:bg-white transition-all outline-none" 
                                       placeholder="nama@email.com">
                            </div>
                        </div>
                        
                        <div class="space-y-3">
                            <label class="text-xs font-black text-gray-700 uppercase tracking-widest pl-1">Subjek</label>
                            <input type="text" name="subjek" 
                                   class="block w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-sm font-semibold focus:ring-4 focus:ring-primary/10 focus:border-primary focus:bg-white transition-all outline-none" 
                                   placeholder="Apa yang ingin Anda tanyakan?">
                        </div>

                        <div class="space-y-3">
                            <label class="text-xs font-black text-gray-700 uppercase tracking-widest pl-1">Pesan Lengkap</label>
                            <textarea name="pesan" rows="6" required 
                                      class="block w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-3xl text-sm font-semibold focus:ring-4 focus:ring-primary/10 focus:border-primary focus:bg-white transition-all outline-none resize-none" 
                                      placeholder="Tuliskan detail pesan Anda di sini..."></textarea>
                        </div>

                        <button type="submit" class="w-full py-5 bg-primary text-white font-black rounded-[2rem] shadow-xl shadow-green-100 hover:bg-primary-dark hover:-translate-y-1 transition-all flex items-center justify-center gap-3 group">
                            Kirim Pesan
                            <i data-lucide="send" class="w-5 h-5 group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
