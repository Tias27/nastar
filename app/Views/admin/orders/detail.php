<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="flex flex-col lg:flex-row gap-8 animate-fade-in">
    <!-- Invoice Print Header -->
    <div class="hidden print:block w-full mb-8 border-b-2 border-primary pb-6">
        <div class="flex justify-between items-start">
            <div>
                <h1 class="text-3xl font-black text-primary italic uppercase tracking-tighter">INVOICE</h1>
                <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mt-1">#<?= $order['id_order'] ?></p>
            </div>
            <div class="text-right">
                <h2 class="text-lg font-black text-gray-900 uppercase">Bulan Cake & Cookies</h2>
                <p class="text-[10px] text-gray-500">Jl. Raya No. 123, Jakarta, Indonesia</p>
                <p class="text-[10px] text-gray-500">Telp: +62 812-3456-7890</p>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-8 mt-8">
            <div>
                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Tagihan Kepada:</p>
                <p class="text-sm font-black text-gray-900"><?= esc($order['nama']) ?></p>
                <p class="text-[10px] text-gray-600"><?= esc($order['phone']) ?></p>
                <p class="text-[10px] text-gray-600 leading-tight mt-1 max-w-[200px]"><?= esc($shipping['alamat_kirim'] ?? $order['alamat']) ?></p>
            </div>
            <div class="text-right">
                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Detail Transaksi:</p>
                <p class="text-[10px] text-gray-700">Tanggal: <span class="font-bold text-black"><?= date('d F Y', strtotime($order['created_at'])) ?></span></p>
                <p class="text-[10px] text-gray-700">Metode: <span class="font-bold text-black uppercase"><?= esc($payment['metode'] ?? '-') ?></span></p>
                <p class="text-[10px] text-gray-700">Status: <span class="font-bold text-black uppercase"><?= $order['status'] ?></span></p>
            </div>
        </div>
    </div>
    
    <div class="flex-1 space-y-8">
        
        <div class="bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-soft">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6 border-b border-gray-50 pb-6 mb-8">
                <div class="flex items-center gap-4 print:hidden">
                    <div class="w-12 h-12 bg-primary-light text-primary rounded-2xl flex items-center justify-center shadow-sm">
                        <i data-lucide="receipt" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-900 font-display">Detail Pesanan #<?= $order['id_order'] ?></h2>
                        <p class="text-xs text-text-muted font-medium">Transaksi pada <?= date('d M Y, H:i', strtotime($order['created_at'])) ?> WIB</p>
                    </div>
                </div>
                
                <?php
                $status_color = 'bg-yellow-50 text-yellow-600 border-yellow-100';
                if ($order['status'] == 'processing') $status_color = 'bg-blue-50 text-blue-600 border-blue-100';
                if ($order['status'] == 'shipped') $status_color = 'bg-orange-50 text-orange-600 border-orange-100';
                if ($order['status'] == 'delivered') $status_color = 'bg-green-50 text-green-600 border-green-100';
                if ($order['status'] == 'cancelled') $status_color = 'bg-red-50 text-red-600 border-red-100';
                ?>
                <span class="px-5 py-2 text-xs font-black uppercase tracking-widest rounded-full border shadow-sm <?= $status_color ?> print:hidden">
                    <?= $order['status'] ?>
                </span>
            </div>

            <div class="overflow-x-auto no-scrollbar mb-8">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-[10px] font-black text-gray-400 uppercase tracking-widest border-b border-gray-50">
                            <th class="px-4 py-4">Produk</th>
                            <th class="px-4 py-4 text-center">Qty</th>
                            <th class="px-4 py-4 text-right">Harga</th>
                            <th class="px-4 py-4 text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        <?php foreach ($items as $item): ?>
                        <tr class="group">
                            <td class="px-4 py-5">
                                <div class="flex items-center gap-4">
                                    <div class="w-14 h-14 bg-gray-50 rounded-2xl overflow-hidden flex-shrink-0 border border-gray-100 print:hidden">
                                        <?php if (!empty($item['gambar']) && file_exists(ROOTPATH . 'public/uploads/products/' . $item['gambar'])): ?>
                                            <img src="<?= base_url('uploads/products/' . $item['gambar']) ?>" class="w-full h-full object-cover">
                                        <?php else: ?>
                                            <div class="w-full h-full flex items-center justify-center text-primary bg-primary-light">
                                                <i data-lucide="cookie" class="w-6 h-6"></i>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-gray-900"><?= esc($item['nama_product']) ?></p>
                                        <p class="text-[10px] text-text-muted mt-1 uppercase font-bold tracking-tighter">SKU-<?= $item['id_product'] ?></p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-5 text-center font-bold text-gray-700"><?= $item['quantity'] ?></td>
                            <td class="px-4 py-5 text-right font-medium text-gray-600 text-sm">Rp <?= number_format($item['price'], 0, ',', '.') ?></td>
                            <td class="px-4 py-5 text-right font-black text-gray-900 text-sm tracking-tight">Rp <?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            
            <div class="flex flex-col items-end space-y-3 pt-4 print:pt-8 print:border-t-2 print:border-gray-50">
                <?php 
                $subtotal_items = 0;
                foreach($items as $it) $subtotal_items += ($it['price'] * $it['quantity']);
                $ongkir_real = $order['total_price'] - $subtotal_items;
                ?>
                <div class="flex justify-between w-full max-w-xs text-sm">
                    <span class="text-text-muted font-medium">Subtotal Produk</span>
                    <span class="font-bold text-gray-900">Rp <?= number_format($subtotal_items, 0, ',', '.') ?></span>
                </div>
                <div class="flex justify-between w-full max-w-xs text-sm">
                    <span class="text-text-muted font-medium">Biaya Pengiriman</span>
                    <span class="font-bold text-gray-900">Rp <?= number_format($ongkir_real, 0, ',', '.') ?></span>
                </div>
                <div class="flex justify-between w-full max-w-xs pt-4 border-t border-gray-100 print:border-gray-200">
                    <span class="text-lg font-black text-gray-900 uppercase tracking-tighter">Total Akhir</span>
                    <span class="text-2xl font-black text-primary tracking-tight">Rp <?= number_format($order['total_price'], 0, ',', '.') ?></span>
                </div>
            </div>

            
            <?php if($order['catatan']): ?>
            <div class="mt-8 p-6 bg-gray-50 rounded-3xl border border-gray-100 flex items-start gap-4">
                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-primary shadow-sm flex-shrink-0">
                    <i data-lucide="message-square" class="w-5 h-5"></i>
                </div>
                <div>
                    <p class="text-[10px] font-black text-text-muted uppercase tracking-widest mb-1">Catatan Pelanggan</p>
                    <p class="text-sm text-gray-700 leading-relaxed italic">"<?= esc($order['catatan']) ?>"</p>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <!-- Payment Info (Hidden on Print) -->
        <div class="bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-soft print:hidden">
            <h5 class="text-lg font-bold text-gray-900 font-display flex items-center gap-3 mb-8">
                <i data-lucide="wallet" class="w-6 h-6 text-primary"></i> Informasi Pembayaran
            </h5>

            <?php if(empty($payment)): ?>
                <div class="p-6 bg-yellow-50 text-yellow-700 rounded-3xl border border-yellow-100 flex items-center gap-4">
                    <i data-lucide="alert-triangle" class="w-6 h-6"></i>
                    <p class="text-sm font-bold">Belum ada data pembayaran yang tercatat untuk pesanan ini.</p>
                </div>
            <?php else: ?>
                <div class="flex flex-col md:flex-row gap-8 items-start">
                    <?php 
                    $isDigital = (strpos(strtolower($payment['metode'] ?? ''), 'midtrans') !== false || strpos(strtolower($payment['metode'] ?? ''), 'simulasi') !== false);
                    if (!$isDigital && !empty($payment['bukti_transfer'])): 
                    ?>
                    <div class="w-full md:w-56 flex-shrink-0">
                        <p class="text-[10px] font-black text-text-muted uppercase tracking-widest mb-3">Bukti Transfer</p>
                        <div class="aspect-[3/4] bg-gray-50 rounded-2xl overflow-hidden border border-gray-100 shadow-sm relative group">
                            <?php if(file_exists(ROOTPATH . 'public/uploads/bukti/' . $payment['bukti_transfer'])): ?>
                                <img src="<?= base_url('uploads/bukti/' . $payment['bukti_transfer']) ?>" class="w-full h-full object-cover">
                                <a href="<?= base_url('uploads/bukti/' . $payment['bukti_transfer']) ?>" target="_blank" 
                                   class="absolute inset-0 bg-black/40 flex items-center justify-center text-white opacity-0 group-hover:opacity-100 transition-opacity">
                                   <i data-lucide="maximize" class="w-8 h-8"></i>
                                </a>
                            <?php else: ?>
                                <div class="w-full h-full flex flex-col items-center justify-center text-gray-300 gap-2">
                                    <i data-lucide="image-off" class="w-10 h-10"></i>
                                    <span class="text-[8px] font-bold uppercase">File tidak ditemukan</span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <div class="flex-1 space-y-6">
                        <?php if($isDigital): ?>
                            <div class="p-4 bg-green-50 border border-green-100 rounded-2xl flex items-center gap-4">
                                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-green-600 shadow-sm">
                                    <i data-lucide="shield-check" class="w-6 h-6"></i>
                                </div>
                                <div>
                                    <p class="text-xs font-black text-green-700 uppercase tracking-widest">Pembayaran Digital Otomatis</p>
                                    <p class="text-[10px] text-green-600 mt-0.5">Transaksi via Midtrans telah divalidasi oleh sistem.</p>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div class="p-4 bg-gray-50 rounded-2xl border border-gray-50">
                                <p class="text-[10px] font-black text-text-muted uppercase tracking-widest mb-1">Metode</p>
                                <p class="text-sm font-bold text-gray-900"><?= esc($payment['metode'] ?? '-') ?></p>
                            </div>
                            <div class="p-4 bg-gray-50 rounded-2xl border border-gray-50">
                                <p class="text-[10px] font-black text-text-muted uppercase tracking-widest mb-1">Waktu Bayar</p>
                                <p class="text-sm font-bold text-gray-900"><?= $payment['payment_date'] ? date('d/m/Y H:i', strtotime($payment['payment_date'])) : '-' ?></p>
                            </div>
                            <div class="p-4 bg-gray-50 rounded-2xl border border-gray-50">
                                <p class="text-[10px] font-black text-text-muted uppercase tracking-widest mb-1">Total Amount</p>
                                <p class="text-sm font-black text-primary tracking-tight">Rp <?= number_format($payment['amount'] ?? 0, 0, ',', '.') ?></p>
                            </div>
                            <div class="p-4 bg-gray-50 rounded-2xl border border-gray-50">
                                <p class="text-[10px] font-black text-text-muted uppercase tracking-widest mb-1">Status Verifikasi</p>
                                <span class="px-3 py-1 text-[10px] font-black uppercase tracking-widest rounded-full border <?= ($payment['status'] ?? '') == 'paid' ? 'bg-green-50 text-green-600 border-green-100' : 'bg-yellow-50 text-yellow-600 border-yellow-100' ?>">
                                    <?= ($payment['status'] ?? '') == 'paid' ? 'LUNAS' : 'PENDING' ?>
                                </span>
                            </div>
                        </div>

                        <?php if(!$isDigital && ($payment['status'] ?? '') == 'pending'): ?>
                            <div class="flex gap-4 pt-4">
                                <a href="<?= base_url('admin/pembayaran/verifikasi/' . $payment['id_payment'] . '/paid') ?>" 
                                   class="flex-1 py-3 bg-primary text-white font-bold rounded-2xl shadow-lg shadow-green-100 hover:bg-primary-dark transition-all flex items-center justify-center gap-2"
                                   onclick="return confirm('Verifikasi pembayaran ini?')">
                                    <i data-lucide="check-circle" class="w-5 h-5"></i> Verifikasi
                                </a>
                                <a href="<?= base_url('admin/pembayaran/verifikasi/' . $payment['id_payment'] . '/rejected') ?>" 
                                   class="flex-1 py-3 bg-white text-red-500 border border-red-100 font-bold rounded-2xl hover:bg-red-50 transition-all flex items-center justify-center gap-2"
                                   onclick="return confirm('Tolak pembayaran ini?')">
                                    <i data-lucide="x-circle" class="w-5 h-5"></i> Tolak
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Sidebar Info (Logistic & Customer Profile) -->
    <div class="w-full lg:w-96 space-y-8 print:hidden">
        
        <div class="bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-elegant space-y-8 sticky top-24">
            <div>
                <h6 class="text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-4">Pengiriman & Logistik</h6>
                <div class="p-6 bg-primary text-white rounded-3xl shadow-lg shadow-green-100 relative overflow-hidden group">
                    <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-white/10 rounded-full blur-2xl transition-transform group-hover:scale-150 duration-700"></div>
                    <p class="text-[10px] font-bold uppercase opacity-70 mb-1">Status Pengiriman</p>
                    <p class="text-xl font-black font-display tracking-tight italic"><?= $order['status'] ?></p>
                </div>
            </div>

            
            <?php if ($order['status'] == 'shipped' || $order['status'] == 'delivered'): ?>
                <div class="p-6 bg-gray-50 rounded-3xl border border-gray-100 space-y-4 relative group" x-data="{ editing: false }">
                    <div class="flex items-center justify-between">
                        <p class="text-[10px] font-black text-text-muted uppercase tracking-widest">Nomor Resi</p>
                        <button @click="editing = !editing" class="text-[10px] font-black text-primary uppercase hover:underline">Ubah Resi</button>
                    </div>
                    <p class="text-lg font-black text-gray-900 tracking-widest uppercase"><?= $shipping['resi'] ?? '-' ?></p>
                    
                    <div x-show="editing" x-cloak class="pt-4 border-t border-gray-200 mt-4 animate-fade-in">
                        <form action="<?= base_url('admin/pesanan/update-resi/' . $order['id_order']) ?>" method="POST" id="form-update-resi"
                              x-data="{
                                  async confirmResi() {
                                      const first = await Swal.fire({
                                          title: 'Ubah Nomor Resi?',
                                          text: 'Apakah Anda yakin ingin mengubah nomor resi ini?',
                                          icon: 'warning',
                                          showCancelButton: true,
                                          confirmButtonText: 'Ya, Lanjut!',
                                          confirmButtonColor: '#059669',
                                          cancelButtonText: 'Batal'
                                      });

                                      if (first.isConfirmed) {
                                          const second = await Swal.fire({
                                              title: 'Cek Sekali Lagi!',
                                              text: 'Pastikan nomor resi sudah benar agar pelanggan tidak bingung.',
                                              icon: 'info',
                                              showCancelButton: true,
                                              confirmButtonText: 'Sudah Benar!',
                                              confirmButtonColor: '#059669',
                                              cancelButtonText: 'Cek Lagi'
                                          });

                                          if (second.isConfirmed) {
                                              const third = await Swal.fire({
                                                  title: 'Konfirmasi Terakhir',
                                                  text: 'Simpan nomor resi baru sekarang?',
                                                  icon: 'question',
                                                  showCancelButton: true,
                                                  confirmButtonText: 'Simpan Sekarang',
                                                  confirmButtonColor: '#059669',
                                                  cancelButtonText: 'Batal'
                                              });

                                              if (third.isConfirmed) {
                                                  document.getElementById('form-update-resi').submit();
                                              }
                                          }
                                      }
                                  }
                              }"
                              @submit.prevent="confirmResi()">
                            <?= csrf_field() ?>
                            <input type="text" name="resi" value="<?= $shipping['resi'] ?? '' ?>" required
                                   class="w-full px-4 py-2 text-xs font-bold bg-white border border-gray-200 rounded-xl outline-none focus:border-primary mb-2 uppercase tracking-widest">
                            <button type="submit" class="w-full py-2 bg-primary text-white text-[10px] font-black uppercase rounded-xl hover:bg-primary-dark transition-all">Simpan Resi</button>
                        </form>
                    </div>
                    
                    <div class="flex items-center gap-2 pt-2">
                        <i data-lucide="info" class="w-3 h-3 text-primary"></i>
                        <p class="text-[10px] text-text-muted leading-tight italic">Pelanggan dapat melacak pesanan via dashboard mereka.</p>
                    </div>
                </div>
            <?php endif; ?>

            <?php if($order['status'] == 'processing' && ($payment['status'] ?? '') == 'paid'): ?>
                <div class="space-y-4">
                    <div class="p-6 bg-green-50 rounded-3xl border border-green-100">
                        <p class="text-xs font-bold text-green-700 leading-relaxed mb-6 flex items-center gap-2">
                            <i data-lucide="check-circle" class="w-4 h-4"></i>
                            Pembayaran sudah masuk. Silakan kirim pesanan sekarang.
                        </p>
                        <a href="<?= base_url('admin/pesanan/kirim/' . $order['id_order']) ?>" 
                           class="w-full py-4 bg-primary text-white font-bold rounded-2xl shadow-xl shadow-green-100 hover:bg-primary-dark hover:-translate-y-1 transition-all flex items-center justify-center gap-3 group"
                           onclick="return confirm('Kirim barang sekarang? Resi akan otomatis dibuat.')">
                            <i data-lucide="truck" class="w-5 h-5 transition-transform group-hover:translate-x-1"></i>
                            Kirim Sekarang
                        </a>
                    </div>
                </div>
            <?php elseif($order['status'] == 'pending'): ?>
                <div class="p-6 bg-yellow-50 rounded-3xl border border-yellow-100 flex items-start gap-4">
                    <i data-lucide="clock" class="w-6 h-6 text-yellow-600 mt-1"></i>
                    <p class="text-xs font-bold text-yellow-700 leading-relaxed italic">
                        Menunggu konfirmasi pembayaran dari pelanggan atau sistem otomatis.
                    </p>
                </div>
            <?php endif; ?>

            
            <div class="pt-8 border-t border-gray-100">
                <h6 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-6">Profil Pelanggan</h6>
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-14 h-14 bg-gray-900 text-white rounded-2xl flex items-center justify-center text-xl font-black shadow-lg">
                        <?= strtoupper(substr($order['nama'], 0, 1)) ?>
                    </div>
                    <div>
                        <p class="text-sm font-black text-gray-900 leading-none"><?= esc($order['nama']) ?></p>
                        <p class="text-[10px] font-bold text-primary mt-1 uppercase tracking-tighter">Verified Customer</p>
                    </div>
                </div>
                
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <i data-lucide="phone" class="w-4 h-4 text-gray-400"></i>
                        <p class="text-xs font-bold text-gray-700"><?= esc($order['phone']) ?></p>
                    </div>
                    <div class="flex items-start gap-3">
                        <i data-lucide="map-pin" class="w-4 h-4 text-gray-400 mt-0.5"></i>
                        <p class="text-xs font-medium text-gray-600 leading-relaxed"><?= esc($shipping['alamat_kirim'] ?? $order['alamat']) ?></p>
                    </div>
                </div>
            </div>

            <div class="pt-4 flex gap-4">
                <a href="<?= base_url('admin/pesanan') ?>" class="flex-1 py-3 bg-gray-50 text-gray-500 font-bold rounded-2xl hover:bg-gray-100 transition-all text-center block text-xs">
                    Kembali
                </a>
                <button onclick="window.print()" class="flex-1 py-3 bg-white border border-gray-100 text-primary font-bold rounded-2xl hover:bg-gray-50 transition-all text-center block text-xs shadow-sm flex items-center justify-center gap-2">
                    <i data-lucide="printer" class="w-4 h-4"></i> Cetak Invoice
                </button>
            </div>
        </div>
    </div>

    <!-- Print Only Invoice Footer -->
    <div class="hidden print:block mt-20">
        <div class="flex justify-between items-end border-t border-gray-100 pt-10">
            <div class="text-gray-400 text-[10px] font-medium max-w-xs italic">
                * Barang yang sudah dibeli tidak dapat ditukar atau dikembalikan.
                Terima kasih atas kunjungan dan kepercayaan Anda.
            </div>
            <div class="text-center">
                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-12 italic">Hormat Kami,</p>
                <div class="w-40 h-px bg-gray-200 mx-auto"></div>
                <p class="text-[10px] font-black text-gray-900 mt-2 uppercase">Bulan Cake & Cookies</p>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
