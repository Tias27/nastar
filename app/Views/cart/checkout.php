<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>


<div class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-12">
        <nav class="flex mb-4 text-xs font-bold uppercase tracking-widest text-text-muted" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2">
                <li><a href="<?= base_url('/') ?>" class="hover:text-primary transition-colors">Beranda</a></li>
                <li><i data-lucide="chevron-right" class="w-3 h-3"></i></li>
                <li><a href="<?= base_url('keranjang') ?>" class="hover:text-primary transition-colors">Keranjang</a></li>
                <li><i data-lucide="chevron-right" class="w-3 h-3"></i></li>
                <li class="text-primary">Checkout</li>
            </ol>
        </nav>
        <h1 class="text-3xl lg:text-4xl font-extrabold font-display text-gray-900">Proses <span class="text-primary italic">Checkout</span></h1>
    </div>
</div>

<section class="py-12 lg:py-20 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <form action="<?= base_url('keranjang/proses-checkout') ?>" method="POST" id="checkoutForm">
            <?= csrf_field() ?>
            <?php foreach ($selectedIds as $id): ?>
                <input type="hidden" name="items[]" value="<?= $id ?>">
            <?php endforeach; ?>
            <div class="flex flex-col lg:flex-row gap-12">
                
                
                <div class="flex-1 space-y-8">
                    
                    <div class="bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-soft space-y-8 animate-fade-in-up">
                        <div class="flex items-center gap-4 border-b border-gray-50 pb-6">
                            <div class="w-12 h-12 bg-primary-light rounded-2xl flex items-center justify-center text-primary shadow-sm">
                                <i data-lucide="truck" class="w-6 h-6"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 font-display">Informasi Pengiriman</h3>
                                <p class="text-xs text-text-muted">Ke mana nastar lezat ini harus kami kirim?</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2 md:col-span-2">
                                <label class="text-xs font-bold text-gray-700 uppercase tracking-widest block">Nama Penerima</label>
                                <input type="text" value="<?= session()->get('nama') ?>" readonly
                                       class="w-full px-5 py-3.5 bg-gray-50 border border-gray-100 rounded-2xl text-sm font-semibold text-gray-500 cursor-not-allowed outline-none">
                            </div>

                            <div class="space-y-2">
                                <label class="text-xs font-bold text-gray-700 uppercase tracking-widest block">Provinsi Tujuan</label>
                                <select id="provinsi" name="provinsi" required
                                        class="w-full px-5 py-3.5 bg-white border border-gray-200 rounded-2xl text-sm font-bold text-gray-700 focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all cursor-pointer">
                                    <option value="">Pilih Provinsi</option>
                                </select>
                            </div>

                            <div class="space-y-2">
                                <label class="text-xs font-bold text-gray-700 uppercase tracking-widest block">Kota / Kabupaten</label>
                                <select id="kota" name="id_kota" required disabled
                                        class="w-full px-5 py-3.5 bg-white border border-gray-200 rounded-2xl text-sm font-bold text-gray-700 focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all cursor-pointer disabled:opacity-50 disabled:bg-gray-50 disabled:cursor-not-allowed">
                                    <option value="">Pilih Kota</option>
                                </select>
                            </div>

                            <div class="space-y-2 md:col-span-2">
                                <label class="text-xs font-bold text-gray-700 uppercase tracking-widest block">Alamat Lengkap</label>
                                <textarea name="alamat_kirim" required rows="3"
                                          placeholder="Nama Jalan, Blok, No. Rumah, RT/RW..."
                                          class="w-full px-5 py-3.5 bg-white border border-gray-200 rounded-2xl text-sm font-medium text-gray-700 focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all"><?= session()->get('alamat') ?></textarea>
                            </div>

                            <div class="space-y-2">
                                <label class="text-xs font-bold text-gray-700 uppercase tracking-widest block">Ekspedisi</label>
                                <select id="kurir" name="kurir" required disabled
                                        class="w-full px-5 py-3.5 bg-white border border-gray-200 rounded-2xl text-sm font-bold text-gray-700 focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all cursor-pointer disabled:opacity-50 disabled:bg-gray-50">
                                    <option value="">Pilih Kurir</option>
                                    <option value="jne">JNE (Jalur Nugraha Ekakurir)</option>
                                    <option value="tiki">TIKI (Titipan Kilat)</option>
                                    <option value="pos">POS Indonesia</option>
                                </select>
                            </div>

                            <div class="space-y-2" id="layanan_wrapper" style="display:none;">
                                <label class="text-xs font-bold text-gray-700 uppercase tracking-widest block">Layanan / Ongkir</label>
                                <select id="layanan" name="layanan_ongkir" required
                                        class="w-full px-5 py-3.5 bg-white border border-gray-200 rounded-2xl text-sm font-bold text-gray-700 focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all cursor-pointer">
                                    <option value="">Pilih Layanan</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    
                    <div class="bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-soft space-y-6 animate-fade-in-up" style="animation-delay: 0.1s">
                        <div class="flex items-center gap-4 border-b border-gray-50 pb-6">
                            <div class="w-12 h-12 bg-orange-50 rounded-2xl flex items-center justify-center text-orange-500 shadow-sm">
                                <i data-lucide="package" class="w-6 h-6"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 font-display">Daftar Pesanan</h3>
                                <p class="text-xs text-text-muted">Pastikan pesanan Anda sudah benar</p>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <?php foreach ($items as $item): ?>
                                <div class="flex items-center gap-4 p-3 hover:bg-gray-50 rounded-2xl transition-colors group">
                                    <div class="w-16 h-16 bg-gray-50 rounded-xl overflow-hidden flex-shrink-0">
                                        <?php if (!empty($item['gambar']) && file_exists(ROOTPATH . 'public/uploads/products/' . $item['gambar'])): ?>
                                            <img src="<?= base_url('uploads/products/' . $item['gambar']) ?>" class="w-full h-full object-cover">
                                        <?php else: ?>
                                            <div class="w-full h-full flex items-center justify-center text-primary bg-primary-light">
                                                <i data-lucide="cookie" class="w-6 h-6"></i>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="flex-1">
                                        <h6 class="text-sm font-bold text-gray-900 group-hover:text-primary transition-colors"><?= esc($item['nama_product']) ?></h6>
                                        <p class="text-xs text-text-muted font-medium"><?= $item['quantity'] ?> x Rp <?= number_format($item['price'], 0, ',', '.') ?></p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-black text-gray-900">Rp <?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                
                <div class="w-full lg:w-[400px]">
                    <div class="sticky top-24 space-y-6 animate-fade-in-up" style="animation-delay: 0.2s">
                        <div class="bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-elegant space-y-8">
                        <h4 class="text-xl font-bold text-gray-900 font-display flex items-center gap-3">
                            <i data-lucide="wallet" class="w-6 h-6 text-primary"></i> Ringkasan Pembayaran
                        </h4>

                            <div class="flex justify-between items-center">
                                <span class="text-text-muted">Total Belanja</span>
                                <span class="text-gray-900">Rp <?= number_format($tempTotal, 0, ',', '.') ?></span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-text-muted">Biaya Pengiriman</span>
                                <span id="ongkir_display" class="text-primary font-bold">Rp 0</span>
                                <input type="hidden" name="ongkir" id="ongkir_value" value="0">
                            </div>
                            <div class="pt-6 border-t border-gray-50 flex justify-between items-center">
                                <span class="text-base font-bold text-gray-900">Total Pembayaran</span>
                                <span id="total_pembayaran_display" class="text-2xl font-black text-primary tracking-tight">
                                    Rp <?= number_format($tempTotal, 0, ',', '.') ?>
                                </span>
                                <input type="hidden" id="subtotal" value="<?= $tempTotal ?>">
                            </div>
                        </div>

                        
                        <div class="space-y-4">
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Metode Pembayaran</p>
                            <div class="p-4 bg-primary-light/50 border-2 border-primary rounded-2xl flex items-center gap-4 relative">
                                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-primary shadow-sm">
                                    <i data-lucide="shield-check" class="w-6 h-6"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-900 leading-tight">Midtrans Payment</p>
                                    <p class="text-[10px] text-primary-dark font-medium uppercase tracking-tighter">Otomatis & Aman</p>
                                </div>
                                <div class="ml-auto">
                                    <i data-lucide="check-circle-2" class="w-5 h-5 text-primary fill-primary-light"></i>
                                </div>
                            </div>
                            <p class="text-[10px] text-text-muted leading-relaxed italic text-center">
                                Mendukung QRIS, GoPay, ShopeePay, Transfer Bank, dan Kartu Kredit secara real-time.
                            </p>
                        </div>

                        <button type="submit" class="w-full py-5 bg-primary text-white font-bold rounded-2xl shadow-xl shadow-green-100 hover:bg-primary-dark hover:-translate-y-1 transition-all flex items-center justify-center gap-3 text-lg group">
                            <i data-lucide="lock" class="w-5 h-5 transition-transform group-hover:scale-110"></i>
                            Bayar Sekarang
                        </button>

                        <div class="flex items-center justify-center gap-4 pt-4 grayscale opacity-40">
                             <img src="https://img.icons8.com/color/48/visa.png" class="h-6">
                             <img src="https://img.icons8.com/color/48/mastercard.png" class="h-6">
                             <img src="https://img.icons8.com/color/48/bank-transfer.png" class="h-6">
                             <img src="https://img.icons8.com/color/48/google-pay.png" class="h-6">
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const provinsiSelect = document.getElementById('provinsi');
        const kotaSelect = document.getElementById('kota');
        const kurirSelect = document.getElementById('kurir');
        const layananSelect = document.getElementById('layanan');
        const layananWrapper = document.getElementById('layanan_wrapper');
        const ongkirDisplay = document.getElementById('ongkir_display');
        const ongkirValue = document.getElementById('ongkir_value');
        const totalDisplay = document.getElementById('total_pembayaran_display');
        const subtotal = parseInt(document.getElementById('subtotal').value);

        function formatRupiah(number) {
            return 'Rp ' + number.toLocaleString('id-ID');
        }

        // Load Provinces
        fetch('<?= base_url('rajaongkir/provinces') ?>')
            .then(res => res.json())
            .then(data => {
                data.data.forEach(p => {
                    const opt = document.createElement('option');
                    opt.value = p.id;
                    opt.textContent = p.name;
                    provinsiSelect.appendChild(opt);
                });
            });

        // Province Change
        provinsiSelect.addEventListener('change', function() {
            const pid = this.value;
            kotaSelect.innerHTML = '<option value="">Pilih Kota</option>';
            kotaSelect.disabled = true;
            kurirSelect.disabled = true;
            layananWrapper.style.display = 'none';
            if(pid) {
                fetch('<?= base_url('rajaongkir/cities') ?>/' + pid)
                    .then(res => res.json())
                    .then(data => {
                        data.data.forEach(c => {
                            const opt = document.createElement('option');
                            opt.value = c.id;
                            opt.textContent = c.name;
                            kotaSelect.appendChild(opt);
                        });
                        kotaSelect.disabled = false;
                    });
            }
        });

        // City Change
        kotaSelect.addEventListener('change', function() {
            kurirSelect.disabled = !this.value;
            layananWrapper.style.display = 'none';
            resetOngkir();
        });

        // Courier Change
        kurirSelect.addEventListener('change', function() {
            const cid = kotaSelect.value;
            const courier = this.value;
            if(cid && courier) {
                layananSelect.innerHTML = '<option value="">Memuat layanan...</option>';
                layananWrapper.style.display = 'block';
                const fd = new FormData();
                fd.append('destination', cid);
                fd.append('weight', 1000);
                fd.append('courier', courier);

                fetch('<?= base_url('rajaongkir/cost') ?>', {
                    method: 'POST',
                    body: fd,
                    headers: {'X-Requested-With': 'XMLHttpRequest', '<?= csrf_token() ?>': '<?= csrf_hash() ?>'}
                })
                .then(res => res.json())
                .then(data => {
                    layananSelect.innerHTML = '<option value="">Pilih Layanan</option>';
                    const cityName = kotaSelect.options[kotaSelect.selectedIndex].text.toUpperCase();
                    const isJabodetabek = ['JAKARTA','BOGOR','DEPOK','TANGERANG','BEKASI'].some(k => cityName.includes(k));

                    if(isJabodetabek) {
                        const opt = document.createElement('option');
                        opt.value = 0;
                        opt.textContent = 'Gratis Ongkir (Jabodetabek) - Rp 0';
                        layananSelect.appendChild(opt);
                        layananSelect.value = 0;
                        layananSelect.dispatchEvent(new Event('change'));
                    } else {
                        data.data.forEach(s => {
                            const opt = document.createElement('option');
                            opt.value = s.cost;
                            opt.textContent = `${s.service} - ${formatRupiah(s.cost)}`;
                            layananSelect.appendChild(opt);
                        });
                    }
                });
            }
        });

        // Service Change
        layananSelect.addEventListener('change', function() {
            const cost = parseInt(this.value) || 0;
            ongkirDisplay.textContent = formatRupiah(cost);
            ongkirValue.value = cost;
            totalDisplay.textContent = formatRupiah(subtotal + cost);
        });

        function resetOngkir() {
            ongkirDisplay.textContent = 'Rp 0';
            ongkirValue.value = 0;
            totalDisplay.textContent = formatRupiah(subtotal);
        }
    });
</script>
<?= $this->endSection() ?>