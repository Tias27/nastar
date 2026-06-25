<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<section class="min-h-screen flex items-center justify-center bg-gray-50 py-20 px-4">
    <div class="max-w-xl w-full text-center">
        <div class="bg-white rounded-[3.5rem] p-10 lg:p-16 border border-gray-100 shadow-elegant relative overflow-hidden animate-fade-in-up">
            
            <div class="absolute -top-10 -right-10 text-9xl opacity-5 text-primary rotate-12 select-none pointer-events-none">🍍</div>
            
            
            <div class="w-24 h-24 bg-primary text-white rounded-full flex items-center justify-center mx-auto mb-10 shadow-xl shadow-green-100 animate-bounce-slow">
                <i data-lucide="check" class="w-12 h-12 stroke-[3px]"></i>
            </div>

            
            <h1 class="text-4xl lg:text-5xl font-black font-display text-gray-900 mb-4 tracking-tight italic">
                Terima <span class="text-primary">Kasih!</span>
            </h1>
            <p class="text-lg font-bold text-primary-dark mb-8">Pesanan Anda Berhasil Diterima</p>
            
            <p class="text-sm text-text-muted leading-relaxed mb-10 max-w-sm mx-auto font-medium">
                Pesanan Anda <span class="text-gray-900 font-bold">#<?= $order['id_order'] ?></span> telah masuk ke sistem kami. Tim kami akan segera melakukan verifikasi dan memproses pesanan Anda.
            </p>

            
            <div class="bg-gray-50 rounded-[2rem] p-8 mb-10 text-left space-y-4 border border-gray-100">
                <div class="flex justify-between items-center text-sm font-medium">
                    <span class="text-text-muted">Nomor Pesanan</span>
                    <span class="font-black text-gray-900">#<?= $order['id_order'] ?></span>
                </div>
                <div class="flex justify-between items-center text-sm font-medium">
                    <span class="text-text-muted">Tanggal Transaksi</span>
                    <span class="font-bold text-gray-900"><?= date('d F Y', strtotime($order['created_at'])) ?></span>
                </div>
                <div class="flex justify-between items-center text-sm font-medium">
                    <span class="text-text-muted">Metode Pembayaran</span>
                    <span class="font-bold text-primary uppercase">Otomatis / Midtrans</span>
                </div>
                <div class="pt-4 border-t border-gray-200 flex justify-between items-center">
                    <span class="text-base font-bold text-gray-900">Total Pembayaran</span>
                    <span class="text-xl font-black text-primary tracking-tight">Rp <?= number_format($order['total_price'], 0, ',', '.') ?></span>
                </div>
            </div>

            
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="<?= base_url('customer/pesanan/' . $order['id_order']) ?>" class="flex-1 py-4 bg-primary text-white font-bold rounded-2xl shadow-lg shadow-green-100 hover:bg-primary-dark hover:-translate-y-1 transition-all flex items-center justify-center gap-2 group">
                    <i data-lucide="file-text" class="w-5 h-5 transition-transform group-hover:scale-110"></i>
                    Detail Pesanan
                </a>
                <a href="<?= base_url('produk') ?>" class="flex-1 py-4 bg-white text-gray-700 border-2 border-gray-100 font-bold rounded-2xl hover:bg-gray-50 transition-all flex items-center justify-center gap-2 group">
                    <i data-lucide="shopping-cart" class="w-5 h-5 transition-transform group-hover:scale-110"></i>
                    Belanja Lagi
                </a>
            </div>

            
            <div class="mt-12 pt-8 border-t border-gray-50">
                <p class="text-xs text-text-muted font-medium">
                    Punya pertanyaan? <a href="<?= base_url('kontak') ?>" class="text-primary font-bold hover:underline">Hubungi Customer Support Kami</a>
                </p>
            </div>
        </div>
    </div>
</section>

<style>
@keyframes bounce-slow {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}
.animate-bounce-slow {
    animation: bounce-slow 3s ease-in-out infinite;
}
</style>

<?= $this->endSection() ?>
