<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>


<div class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-12 text-center lg:text-left">
        <h1 class="text-3xl lg:text-4xl font-extrabold font-display text-gray-900">Pembayaran <span class="text-primary italic">Pesanan</span></h1>
        <p class="mt-2 text-text-muted">Satu langkah lagi untuk menikmati kelezatan nastar kami</p>
    </div>
</div>

<?php if($snapToken): ?>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?= $midtransClientKey ?>"></script>
<?php endif; ?>

<section class="py-12 lg:py-20 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-12 justify-center">
            
            
            <div class="flex-1 max-w-2xl">
                <div class="bg-white p-8 lg:p-12 rounded-[3.5rem] border border-gray-100 shadow-elegant text-center relative overflow-hidden animate-fade-in-up">
                    <div class="absolute -top-10 -right-10 text-9xl opacity-5 text-primary rotate-12 select-none pointer-events-none">🏦</div>
                    
                    <div class="w-20 h-20 bg-primary-light text-primary rounded-3xl flex items-center justify-center mx-auto mb-8 shadow-sm">
                        <i data-lucide="shield-check" class="w-10 h-10"></i>
                    </div>

                    <h2 class="text-2xl lg:text-3xl font-black font-display text-gray-900 mb-4 tracking-tight italic">
                        Selesaikan <span class="text-primary">Pembayaran</span>
                    </h2>
                    <p class="text-sm text-text-muted leading-relaxed mb-10 max-w-sm mx-auto font-medium">
                        Silakan klik tombol di bawah untuk membayar secara aman melalui Midtrans. Mendukung E-wallet, Virtual Account, dan Kartu Kredit.
                    </p>

                    
                    <div class="bg-gray-50 border-2 border-gray-100 rounded-[2.5rem] p-8 mb-10 inline-block w-full max-w-md">
                        <p class="text-3xl lg:text-4xl font-black text-primary tracking-tighter mb-6 font-display italic">
                            Rp <?= number_format($order['total_price'], 0, ',', '.') ?>
                        </p>
                        
                        <?php if($snapToken): ?>
                            <button id="pay-button" class="w-full py-4 bg-primary text-white font-bold text-lg rounded-xl shadow-lg shadow-green-100 hover:bg-primary-dark hover:-translate-y-1 transition-all flex items-center justify-center gap-3 group">
                                <i data-lucide="zap" class="w-5 h-5 fill-white transition-transform group-hover:scale-110"></i>
                                BAYAR SEKARANG
                            </button>
                        <?php else: ?>
                            <div class="p-4 bg-red-50 text-red-600 rounded-2xl border border-red-100 text-sm font-bold">
                                <i data-lucide="alert-circle" class="w-5 h-5 inline-block mr-2"></i>
                                Sistem pembayaran sedang mengalami gangguan sementara.
                            </div>
                        <?php endif; ?>
                    </div>

                    
                    <div class="flex items-center justify-center gap-6 pt-6 border-t border-gray-50">
                        <div class="flex items-center gap-2 grayscale opacity-40">
                             <img src="https://img.icons8.com/color/48/visa.png" class="h-5">
                             <img src="https://img.icons8.com/color/48/mastercard.png" class="h-5">
                             <img src="https://img.icons8.com/color/48/bank-transfer.png" class="h-5">
                             <img src="https://img.icons8.com/color/48/google-pay.png" class="h-5">
                        </div>
                    </div>
                </div>

                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
                    <div class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-soft flex gap-4">
                        <div class="w-10 h-10 bg-blue-50 text-blue-500 rounded-xl flex items-center justify-center flex-shrink-0">
                            <i data-lucide="zap" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <p class="text-xs font-black text-gray-900 uppercase tracking-widest mb-1">Verifikasi Instan</p>
                            <p class="text-[10px] text-text-muted leading-relaxed">Pesanan langsung diproses otomatis setelah pembayaran sukses.</p>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-soft flex gap-4">
                        <div class="w-10 h-10 bg-accent/10 text-accent rounded-xl flex items-center justify-center flex-shrink-0">
                            <i data-lucide="lock" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <p class="text-xs font-black text-gray-900 uppercase tracking-widest mb-1">Keamanan 100%</p>
                            <p class="text-[10px] text-text-muted leading-relaxed">Seluruh data transaksi dienkripsi dengan standar keamanan tinggi.</p>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="w-full lg:w-96">
                <div class="bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-elegant sticky top-24 space-y-8 animate-fade-in-up" style="animation-delay: 0.2s">
                    <h5 class="text-lg font-bold text-gray-900 font-display flex items-center gap-3">
                        <i data-lucide="receipt" class="w-6 h-6 text-primary"></i> Ringkasan Order
                    </h5>

                    <div class="space-y-4">
                        <?php foreach ($items as $item): ?>
                            <div class="flex justify-between items-start gap-4">
                                <div class="flex-1">
                                    <p class="text-sm font-bold text-gray-900 leading-tight"><?= esc($item['nama_product']) ?></p>
                                    <p class="text-[10px] text-text-muted mt-0.5"><?= $item['quantity'] ?> x Rp <?= number_format($item['price'], 0, ',', '.') ?></p>
                                </div>
                                <span class="text-sm font-bold text-gray-900">Rp <?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="pt-6 border-t border-gray-50 flex justify-between items-center">
                        <span class="text-base font-bold text-gray-900">ID Pesanan</span>
                        <span class="text-sm font-black text-gray-900 tracking-widest">#<?= $order['id_order'] ?></span>
                    </div>

                    <div class="pt-6 border-t border-gray-50 flex justify-between items-center">
                        <span class="text-lg font-black text-gray-900 italic">Total Bayar</span>
                        <span class="text-2xl font-black text-primary tracking-tight">
                            Rp <?= number_format($order['total_price'], 0, ',', '.') ?>
                        </span>
                    </div>

                    <div class="pt-4 text-center">
                        <a href="<?= base_url('customer/dashboard') ?>" class="text-[10px] font-black text-gray-400 uppercase tracking-widest hover:text-red-500 transition-colors flex items-center justify-center gap-2">
                            <i data-lucide="arrow-left" class="w-3 h-3"></i> Batal & Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if($snapToken): ?>
<script type="text/javascript">
    var payButton = document.getElementById('pay-button');
    if (payButton) {
        payButton.addEventListener('click', function () {
            window.snap.pay('<?= $snapToken ?>', {
                onSuccess: function (result) {
                    window.location.href = "<?= base_url('pesanan/simulate/' . $order['order_token']) ?>";
                },
                onPending: function (result) {
                    window.location.href = "<?= base_url('customer/pesanan') ?>";
                },
                onError: function (result) {
                    alert("Pembayaran gagal!");
                },
                onClose: function () {
                    alert('Anda menutup popup tanpa menyelesaikan pembayaran');
                }
            });
        });
    }
</script>
<?php endif; ?>

<?= $this->endSection() ?>