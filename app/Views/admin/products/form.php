<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="max-w-5xl mx-auto animate-fade-in">
    
    <div class="bg-white p-8 rounded-t-[2.5rem] border-x border-t border-gray-100 shadow-soft">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-primary-light text-primary rounded-2xl flex items-center justify-center shadow-sm">
                    <i data-lucide="<?= isset($product) ? 'edit-3' : 'plus-circle' ?>" class="w-6 h-6"></i>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-900 font-display"><?= isset($product) ? 'Edit Produk' : 'Tambah Produk Baru' ?></h2>
                    <p class="text-xs text-text-muted font-medium">Lengkapi detail informasi produk nastar Anda</p>
                </div>
            </div>
            <a href="<?= base_url('admin/produk') ?>" class="inline-flex items-center gap-2 px-6 py-2.5 bg-gray-50 text-gray-600 font-bold text-sm rounded-xl hover:bg-gray-100 transition-all">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Kembali
            </a>
        </div>
    </div>

    
    <div class="bg-white p-8 rounded-b-[2.5rem] border border-gray-100 shadow-elegant">
        <?php if (session()->getFlashdata('errors')): ?>
            <div class="mb-8 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-2xl animate-fade-in">
                <div class="flex items-center gap-3 mb-2">
                    <i data-lucide="alert-circle" class="w-5 h-5 text-red-500"></i>
                    <p class="text-sm font-black text-red-700 uppercase tracking-widest">Ada Kesalahan Input</p>
                </div>
                <ul class="text-sm text-red-600 space-y-1 ml-8 list-disc">
                    <?php foreach (session()->getFlashdata('errors') as $e): ?>
                        <li><?= esc($e) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?= isset($product) ? base_url('admin/produk/update/' . $product['id_product']) : base_url('admin/produk/simpan') ?>"
              method="POST" enctype="multipart/form-data" class="space-y-8">
            <?= csrf_field() ?>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                
                <div class="lg:col-span-2 space-y-6">
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-gray-700 uppercase tracking-widest block pl-1">Nama Produk <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_product" required
                               value="<?= old('nama_product', $product['nama_product'] ?? '') ?>"
                               placeholder="Contoh: Nastar Keju Premium 500gr"
                               class="block w-full px-5 py-3.5 bg-gray-50 border border-gray-100 rounded-2xl text-sm font-semibold focus:ring-4 focus:ring-primary/10 focus:border-primary focus:bg-white transition-all outline-none">
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-bold text-gray-700 uppercase tracking-widest block pl-1">Deskripsi Produk</label>
                        <textarea name="deskripsi" rows="6"
                                  placeholder="Tuliskan deskripsi lengkap, bahan-bahan, dan keunggulan rasa..."
                                  class="block w-full px-5 py-3.5 bg-gray-50 border border-gray-100 rounded-3xl text-sm font-medium focus:ring-4 focus:ring-primary/10 focus:border-primary focus:bg-white transition-all outline-none resize-none"><?= old('deskripsi', $product['deskripsi'] ?? '') ?></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-gray-700 uppercase tracking-widest block pl-1">Harga Satuan (Rp) <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 font-bold text-sm">Rp</div>
                                <input type="number" name="harga" required min="0"
                                       value="<?= old('harga', $product['harga'] ?? '') ?>"
                                       placeholder="75000"
                                       class="block w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-100 rounded-2xl text-sm font-bold text-primary focus:ring-4 focus:ring-primary/10 focus:border-primary focus:bg-white transition-all outline-none">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs font-bold text-gray-700 uppercase tracking-widest block pl-1">Stok Tersedia <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <input type="number" name="stok" required min="0"
                                       value="<?= old('stok', $product['stok'] ?? '') ?>"
                                       placeholder="100"
                                       class="block w-full px-5 py-3.5 bg-gray-50 border border-gray-100 rounded-2xl text-sm font-bold text-gray-900 focus:ring-4 focus:ring-primary/10 focus:border-primary focus:bg-white transition-all outline-none">
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-gray-400 font-bold text-[10px] uppercase">Toples</div>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="space-y-6">
                    <label class="text-xs font-bold text-gray-700 uppercase tracking-widest block pl-1">Gambar Produk</label>
                    <div class="relative group">
                        <div class="aspect-square bg-gray-50 rounded-[2rem] border-2 border-dashed border-gray-200 flex items-center justify-center overflow-hidden relative group-hover:border-primary transition-colors">
                            <img id="imgPreview" 
                                 src="<?= (isset($product['gambar']) && !empty($product['gambar'])) ? base_url('uploads/products/' . $product['gambar']) : '#' ?>"
                                 class="w-full h-full object-cover <?= (isset($product['gambar']) && !empty($product['gambar'])) ? 'block' : 'hidden' ?>">
                            
                            <div id="noImg" class="flex flex-col items-center gap-3 text-gray-300 <?= (isset($product['gambar']) && !empty($product['gambar'])) ? 'hidden' : 'flex' ?>">
                                <i data-lucide="image-plus" class="w-12 h-12"></i>
                                <span class="text-[10px] font-black uppercase tracking-widest">Pilih Gambar</span>
                            </div>
                        </div>
                        <input type="file" name="gambar" id="imgInput" accept="image/*" onchange="previewImage(this)"
                               class="absolute inset-0 opacity-0 cursor-pointer">
                    </div>
                    <div class="p-4 bg-primary-light/50 border border-green-100 rounded-2xl">
                        <p class="text-[10px] text-primary-dark font-medium leading-relaxed">
                            <i data-lucide="info" class="w-3 h-3 inline-block mr-1"></i>
                            Gunakan gambar berkualitas tinggi (JPG/PNG/WEBP). Ukuran maksimal 2MB. Pastikan objek produk berada di tengah.
                        </p>
                    </div>

                    <div class="pt-6">
                        <button type="submit" class="w-full py-4 bg-primary text-white font-bold rounded-2xl shadow-lg shadow-green-100 hover:bg-primary-dark hover:-translate-y-1 transition-all flex items-center justify-center gap-3 group">
                            <i data-lucide="save" class="w-5 h-5 transition-transform group-hover:scale-110"></i>
                            <?= isset($product) ? 'Simpan Perubahan' : 'Terbitkan Produk' ?>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
function previewImage(input) {
    const preview = document.getElementById('imgPreview');
    const noImg = document.getElementById('noImg');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = (e) => {
            preview.src = e.target.result;
            preview.classList.remove('hidden');
            preview.classList.add('block');
            noImg.classList.remove('flex');
            noImg.classList.add('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
<?= $this->endSection() ?>
