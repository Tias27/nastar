<?php if(empty($payments)): ?>
    <tr>
        <td colspan="7" class="px-6 py-20 text-center">
            <div class="flex flex-col items-center gap-3">
                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center text-gray-300">
                    <i data-lucide="inbox" class="w-8 h-8"></i>
                </div>
                <p class="text-sm font-bold text-gray-400">Belum ada pembayaran masuk.</p>
            </div>
        </td>
    </tr>
<?php endif; ?>

<?php foreach ($payments as $p): ?>
<tr class="hover:bg-gray-50/50 transition-colors">
    <td class="px-6 py-5">
        <span class="text-sm font-black text-gray-900 tracking-tight">#<?= $p['id_order'] ?></span>
    </td>
    <td class="px-6 py-5">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 bg-primary-light text-primary rounded-lg flex items-center justify-center text-xs font-black">
                <?= strtoupper(substr($p['username'], 0, 1)) ?>
            </div>
            <span class="text-sm font-bold text-gray-700"><?= esc($p['username']) ?></span>
        </div>
    </td>
    <td class="px-6 py-5">
        <span class="text-xs font-bold text-gray-500 bg-gray-100 px-3 py-1 rounded-full"><?= esc($p['metode']) ?></span>
    </td>
    <td class="px-6 py-5">
        <span class="text-sm font-black text-primary italic">Rp <?= number_format($p['amount'], 0, ',', '.') ?></span>
    </td>
    <td class="px-6 py-5">
        <?php if(!empty($p['bukti_transfer'])): ?>
            <a href="<?= base_url('uploads/bukti/' . $p['bukti_transfer']) ?>" target="_blank" 
               class="inline-flex items-center gap-2 text-[10px] font-black text-blue-500 uppercase tracking-widest hover:text-blue-600 transition-colors">
                <i data-lucide="external-link" class="w-3 h-3"></i> Lihat Bukti
            </a>
        <?php else: ?>
            <span class="text-[10px] font-bold text-gray-300 uppercase tracking-widest italic">Otomatis</span>
        <?php endif; ?>
    </td>
    <td class="px-6 py-5">
        <?php if($p['status'] == 'paid'): ?>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-primary-light text-primary text-[10px] font-black uppercase tracking-widest">
                <span class="w-1.5 h-1.5 bg-primary rounded-full"></span> Lunas
            </span>
        <?php elseif($p['status'] == 'rejected'): ?>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-red-50 text-red-500 text-[10px] font-black uppercase tracking-widest">
                <span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span> Ditolak
            </span>
        <?php else: ?>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-50 text-amber-500 text-[10px] font-black uppercase tracking-widest">
                <span class="w-1.5 h-1.5 bg-amber-500 rounded-full animate-pulse"></span> Pending
            </span>
        <?php endif; ?>
    </td>
    <td class="px-6 py-5 text-center">
        <?php if($p['status'] == 'pending'): ?>
        <div class="flex items-center justify-center gap-2">
            <a href="<?= base_url('admin/pembayaran/verifikasi/' . $p['id_payment'] . '/paid') ?>" 
               class="w-8 h-8 bg-primary text-white rounded-lg flex items-center justify-center hover:bg-primary-dark transition-all shadow-md shadow-green-100"
               title="Sahkan">
                <i data-lucide="check" class="w-4 h-4"></i>
            </a>
            <a href="<?= base_url('admin/pembayaran/verifikasi/' . $p['id_payment'] . '/rejected') ?>" 
               class="w-8 h-8 bg-red-500 text-white rounded-lg flex items-center justify-center hover:bg-red-600 transition-all shadow-md shadow-red-100"
               title="Tolak">
                <i data-lucide="x" class="w-4 h-4"></i>
            </a>
        </div>
        <?php endif; ?>
    </td>
</tr>
<?php endforeach; ?>
