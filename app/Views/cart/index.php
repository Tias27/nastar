<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>


<div class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-12 text-center lg:text-left">
        <h1 class="text-3xl lg:text-4xl font-extrabold font-display text-gray-900">Keranjang <span class="text-primary italic">Belanja</span></h1>
        <p class="mt-2 text-text-muted">Siap untuk mencicipi kelezatan nastar premium kami?</p>
    </div>
</div>

<section class="py-12 lg:py-20 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php if (empty($items)): ?>
            
            <div class="max-w-2xl mx-auto py-20 px-8 bg-white rounded-[3rem] border-2 border-dashed border-gray-200 text-center animate-fade-in-up">
                <div class="w-32 h-32 bg-gray-50 rounded-full flex items-center justify-center text-gray-300 mx-auto mb-8">
                    <i data-lucide="shopping-cart" class="w-16 h-16"></i>
                </div>
                <h2 class="text-2xl font-extrabold text-gray-900 mb-4">Keranjang Anda Masih Kosong</h2>
                <p class="text-text-muted mb-10 max-w-sm mx-auto leading-relaxed">Sepertinya Anda belum menambahkan kue nastar lezat ke keranjang Anda. Yuk, mulai belanja sekarang!</p>
                <a href="<?= base_url('produk') ?>" class="inline-flex items-center gap-3 px-10 py-4 bg-primary text-white font-bold rounded-2xl shadow-lg shadow-green-100 hover:bg-primary-dark transition-all transform hover:-translate-y-1">
                    <i data-lucide="grid" class="w-5 h-5 text-white"></i>
                    Lihat Koleksi Produk
                </a>
            </div>
        <?php else: ?>
            <div class="flex flex-col lg:flex-row gap-12">
                
                <div class="flex-1 space-y-6">
                    <div class="flex items-center justify-between px-2">
                        <h4 class="text-lg font-bold text-gray-900 font-display">Item dalam Keranjang (<?= count($items) ?>)</h4>
                        <a href="<?= base_url('produk') ?>" class="text-sm font-bold text-primary flex items-center gap-2 hover:gap-3 transition-all group">
                            <i data-lucide="arrow-left" class="w-4 h-4"></i> Lanjut Belanja
                        </a>
                    </div>

                    <div class="space-y-4">
                        <?php foreach ($items as $i => $item): ?>
                            <div class="bg-white p-4 sm:p-6 rounded-3xl border border-gray-100 shadow-soft flex items-start gap-4 sm:gap-6 animate-fade-in-up relative overflow-hidden" style="animation-delay: <?= $i * 0.1 ?>s">
                                
                                <div class="pt-2">
                                    <label class="relative flex items-center justify-center cursor-pointer group">
                                        <input type="checkbox" name="selected_items[]" value="<?= $item['id'] ?>" checked 
                                               class="cart-item-checkbox peer sr-only"
                                               data-price="<?= $item['price'] ?>" 
                                               data-quantity="<?= $item['quantity'] ?>">
                                        
                                        <div class="w-6 h-6 bg-white border-2 border-gray-200 rounded-lg transition-all group-hover:border-primary peer-checked:bg-primary peer-checked:border-primary"></div>
                                        
                                        <i data-lucide="check" class="absolute w-4 h-4 text-white opacity-0 peer-checked:opacity-100 transition-opacity pointer-events-none"></i>
                                    </label>
                                </div>

                                
                                <div class="w-20 h-20 sm:w-28 sm:h-28 bg-gray-50 rounded-2xl overflow-hidden flex-shrink-0">
                                    <?php if (!empty($item['gambar']) && file_exists(ROOTPATH . 'public/uploads/products/' . $item['gambar'])): ?>
                                        <img src="<?= base_url('uploads/products/' . $item['gambar']) ?>" alt="<?= esc($item['nama_product']) ?>" class="w-full h-full object-cover">
                                    <?php else: ?>
                                        <div class="w-full h-full flex items-center justify-center text-primary bg-primary-light">
                                            <i data-lucide="cookie" class="w-10 h-10"></i>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                
                                <div class="flex-1 min-w-0 flex flex-col sm:flex-row justify-between gap-4">
                                    <div class="space-y-1">
                                        <h5 class="text-base sm:text-lg font-bold text-gray-900 truncate"><?= esc($item['nama_product']) ?></h5>
                                        <p class="text-xs text-text-muted font-bold">
                                            Rp <?= number_format($item['price'], 0, ',', '.') ?>
                                        </p>
                                        
                                        
                                        <div class="pt-2">
                                            <form action="<?= base_url('keranjang/update') ?>" method="POST" class="inline-flex items-center bg-gray-50 border border-gray-100 rounded-xl p-1">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                                <button type="submit" name="quantity" value="<?= $item['quantity'] - 1 ?>" 
                                                        class="w-7 h-7 rounded-lg flex items-center justify-center text-gray-500 hover:bg-white transition-colors"
                                                        <?= $item['quantity'] <= 1 ? 'disabled style="opacity:0.3;"' : '' ?>>
                                                    <i data-lucide="minus" class="w-3.5 h-3.5"></i>
                                                </button>
                                                <input type="number" class="w-8 text-center bg-transparent border-none text-xs font-bold text-gray-900 outline-none focus:ring-0" value="<?= $item['quantity'] ?>" readonly>
                                                <button type="submit" name="quantity" value="<?= $item['quantity'] + 1 ?>" 
                                                        class="w-7 h-7 rounded-lg flex items-center justify-center text-primary hover:bg-white transition-colors"
                                                        <?= $item['quantity'] >= $item['stok'] ? 'disabled style="opacity:0.3;"' : '' ?>>
                                                    <i data-lucide="plus" class="w-3.5 h-3.5"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="flex flex-row sm:flex-col items-center sm:items-end justify-between sm:justify-center gap-2">
                                        <div class="text-left sm:text-right">
                                            <p class="text-[10px] font-bold text-text-muted uppercase">Subtotal</p>
                                            <p class="text-lg font-black text-primary tracking-tight">
                                                Rp <?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?>
                                            </p>
                                        </div>
                                        
                                        
                                        <a href="<?= base_url('keranjang/hapus/' . $item['id']) ?>" 
                                           class="p-2.5 bg-red-50 text-red-500 hover:bg-red-500 hover:text-white rounded-xl transition-all shadow-sm"
                                           onclick="return confirm('Hapus item ini?')">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    
                    
                    <form id="checkoutForm" action="<?= base_url('keranjang/checkout') ?>" method="GET" class="hidden">
                    </form>
                </div>

                
                <div class="w-full lg:w-[400px]">
                    <div class="bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-elegant sticky top-24 space-y-8 animate-fade-in-up" style="animation-delay: 0.3s">
                        <h4 class="text-xl font-bold text-gray-900 font-display flex items-center gap-3">
                            <i data-lucide="receipt" class="w-6 h-6 text-primary"></i> Ringkasan Belanja
                        </h4>

                            <div class="flex justify-between items-center text-sm">
                                <span class="text-text-muted">Total Produk Dipilih</span>
                                <span id="selectedCount" class="font-bold text-gray-900"><?= count($items) ?> Item</span>
                            </div>
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-text-muted">Subtotal Produk</span>
                                <span id="subtotalText" class="font-bold text-gray-900">Rp <?= number_format($cart['total_price'], 0, ',', '.') ?></span>
                            </div>
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-text-muted">Biaya Pengiriman</span>
                                <span class="text-xs font-bold text-primary italic">Dihitung di checkout</span>
                            </div>
                            <div class="pt-6 border-t border-gray-100 flex justify-between items-center">
                                <span class="text-base font-bold text-gray-900">Total Tagihan</span>
                                <span id="totalText" class="text-2xl font-black text-primary tracking-tight">
                                    Rp <?= number_format($cart['total_price'], 0, ',', '.') ?>
                                </span>
                            </div>

                        
                        <div class="p-4 bg-primary-light border border-green-100 rounded-2xl flex items-start gap-3">
                            <i data-lucide="info" class="w-5 h-5 text-primary mt-0.5"></i>
                            <p class="text-xs text-primary-dark font-medium leading-relaxed">
                                Nikmati <strong>Gratis Ongkir</strong> se-Jabodetabek untuk pembelian di atas Rp 200.000!
                            </p>
                        </div>

                        <button type="button" id="checkoutBtn" class="w-full py-4 bg-primary text-white font-bold rounded-2xl shadow-lg shadow-green-100 hover:bg-primary-dark hover:-translate-y-1 transition-all flex items-center justify-center gap-3">
                            Lanjut ke Checkout
                            <i data-lucide="arrow-right" class="w-5 h-5"></i>
                        </button>

                        
                        <div class="space-y-4 text-center">
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Metode Pembayaran Tersedia</p>
                            <div class="flex flex-wrap justify-center gap-4 grayscale opacity-60">
                                <img src="https://img.icons8.com/color/48/visa.png" class="h-6 object-contain">
                                <img src="https://img.icons8.com/color/48/mastercard.png" class="h-6 object-contain">
                                <img src="https://img.icons8.com/color/48/bank-transfer.png" class="h-6 object-contain">
                                <img src="https://img.icons8.com/color/48/google-pay.png" class="h-6 object-contain">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkboxes = document.querySelectorAll('.cart-item-checkbox');
        const subtotalText = document.getElementById('subtotalText');
        const totalText = document.getElementById('totalText');
        const selectedCount = document.getElementById('selectedCount');
        const checkoutBtn = document.getElementById('checkoutBtn');
        const checkoutForm = document.getElementById('checkoutForm');

        function updateSummary() {
            let total = 0;
            let count = 0;
            checkboxes.forEach(cb => {
                if (cb.checked) {
                    const price = parseFloat(cb.dataset.price);
                    const qty = parseInt(cb.dataset.quantity);
                    total += price * qty;
                    count++;
                }
            });

            const formatted = new Intl.NumberFormat('id-ID', { 
                style: 'currency', 
                currency: 'IDR', 
                minimumFractionDigits: 0,
                maximumFractionDigits: 0 
            }).format(total).replace('IDR', 'Rp');

            subtotalText.innerText = formatted;
            totalText.innerText = formatted;
            selectedCount.innerText = count + ' Item';
            
            checkoutBtn.disabled = count === 0;
            checkoutBtn.style.opacity = count === 0 ? '0.5' : '1';
            checkoutBtn.style.cursor = count === 0 ? 'not-allowed' : 'pointer';
        }

        checkboxes.forEach(cb => {
            cb.addEventListener('change', updateSummary);
        });

        checkoutBtn.addEventListener('click', function() {
            checkoutForm.innerHTML = ''; // Clear previous
            checkboxes.forEach(cb => {
                if (cb.checked) {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'items[]';
                    input.value = cb.value;
                    checkoutForm.appendChild(input);
                }
            });
            checkoutForm.submit();
        });

        updateSummary();
    });
</script>
<?= $this->endSection() ?>
