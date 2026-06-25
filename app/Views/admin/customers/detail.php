<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="space-y-8 animate-fade-in">
    
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <nav class="flex mb-4 text-[10px] font-black uppercase tracking-widest text-gray-400">
                <ol class="flex items-center gap-2">
                    <li><a href="<?= base_url('admin/pelanggan') ?>" class="hover:text-primary transition-colors">Pelanggan</a></li>
                    <li><i data-lucide="chevron-right" class="w-3 h-3"></i></li>
                    <li class="text-primary">Profil Detail</li>
                </ol>
            </nav>
            <h1 class="text-2xl font-black font-display text-gray-900 tracking-tight">Detail <span class="text-primary italic">Profil Pelanggan</span></h1>
        </div>
        <div class="flex items-center gap-3">
             <a href="<?= base_url('admin/pelanggan/edit/' . $customer['id_customer']) ?>" 
                class="inline-flex items-center gap-2 px-6 py-3 bg-white border border-gray-100 text-amber-500 font-black text-[10px] uppercase tracking-widest rounded-2xl hover:bg-amber-50 transition-all shadow-sm">
                <i data-lucide="edit-3" class="w-4 h-4"></i> Edit Profil
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <div class="lg:col-span-4 space-y-8">
            <div class="bg-white rounded-[2.5rem] border border-gray-100 shadow-sm overflow-hidden text-center p-10 relative">
                <div class="absolute top-0 left-0 w-full h-32 bg-primary/5"></div>
                
                <div class="relative z-10">
                    <div class="w-24 h-24 bg-white p-2 rounded-[2rem] shadow-xl mx-auto mb-6">
                        <div class="w-full h-full bg-primary text-white rounded-[1.5rem] flex items-center justify-center font-black text-3xl">
                            <?= strtoupper(substr($customer['nama'], 0, 1)) ?>
                        </div>
                    </div>
                    <h3 class="text-xl font-black text-gray-900 font-display"><?= esc($customer['nama']) ?></h3>
                    <p class="text-sm font-bold text-primary mt-1">@<?= esc($customer['username']) ?></p>
                    
                    <div class="flex items-center justify-center gap-4 mt-8 pt-8 border-t border-gray-50">
                        <div class="text-center">
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Status</p>
                            <span class="inline-flex px-3 py-1 rounded-full bg-green-50 text-green-600 text-[10px] font-black uppercase tracking-widest">Aktif</span>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="bg-white rounded-[2.5rem] border border-gray-100 shadow-sm p-8 space-y-6">
                <h4 class="text-xs font-black text-gray-900 uppercase tracking-widest flex items-center gap-2">
                    <i data-lucide="contact-2" class="w-4 h-4 text-primary"></i> Kontak & Info
                </h4>
                
                <div class="space-y-4">
                    <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-2xl">
                        <i data-lucide="phone" class="w-5 h-5 text-gray-400 mt-1"></i>
                        <div>
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">WhatsApp</p>
                            <a href="https://wa.me/<?= $customer['phone'] ?>" target="_blank" class="text-sm font-bold text-gray-700 hover:text-primary transition-colors"><?= esc($customer['phone']) ?></a>
                        </div>
                    </div>
                    <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-2xl">
                        <i data-lucide="map-pin" class="w-5 h-5 text-gray-400 mt-1"></i>
                        <div>
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Alamat</p>
                            <p class="text-sm font-bold text-gray-700 leading-relaxed"><?= nl2br(esc($customer['alamat'])) ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="lg:col-span-8 space-y-8">
            <div class="bg-white rounded-[2.5rem] border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-8 py-6 border-b border-gray-50 flex items-center justify-between">
                    <h4 class="text-sm font-black text-gray-900 uppercase tracking-widest">Riwayat Pesanan</h4>
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest bg-gray-50 px-3 py-1 rounded-full"><?= count($orders) ?> Transaksi</span>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/50">
                                <th class="px-8 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">ID Order</th>
                                <th class="px-8 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Tanggal</th>
                                <th class="px-8 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Total</th>
                                <th class="px-8 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Status</th>
                                <th class="px-8 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            <?php if(empty($orders)): ?>
                                <tr>
                                    <td colspan="5" class="px-8 py-12 text-center text-gray-400 font-bold italic">Belum ada transaksi dilakukan.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach($orders as $order): ?>
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-8 py-4 text-sm font-black text-gray-900 tracking-tight">#<?= $order['id_order'] ?></td>
                                        <td class="px-8 py-4 text-xs font-bold text-gray-600"><?= date('d M Y', strtotime($order['created_at'])) ?></td>
                                        <td class="px-8 py-4 text-sm font-black text-primary">Rp <?= number_format($order['total_price'], 0, ',', '.') ?></td>
                                        <td class="px-8 py-4">
                                            <span class="inline-flex px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest <?= ($order['status'] == 'delivered' ? 'bg-green-50 text-green-600' : ($order['status'] == 'cancelled' ? 'bg-red-50 text-red-500' : 'bg-amber-50 text-amber-500')) ?>">
                                                <?= $order['status'] ?>
                                            </span>
                                        </td>
                                        <td class="px-8 py-4 text-right">
                                            <a href="<?= base_url('admin/pesanan/' . $order['id_order']) ?>" class="text-primary hover:underline text-xs font-black uppercase tracking-widest">Detail</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
