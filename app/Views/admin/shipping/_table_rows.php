<?php if(empty($shippings)): ?>
    <tr>
        <td colspan="6" class="px-6 py-20 text-center">
            <div class="flex flex-col items-center gap-3">
                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center text-gray-300">
                    <i data-lucide="truck" class="w-8 h-8"></i>
                </div>
                <p class="text-sm font-bold text-gray-400">Belum ada data pengiriman.</p>
            </div>
        </td>
    </tr>
<?php endif; ?>

<?php foreach ($shippings as $s): ?>
<tr class="hover:bg-gray-50/50 transition-colors">
    <td class="px-6 py-5">
        <span class="text-sm font-black text-gray-900 tracking-tight">#<?= $s['id_order'] ?></span>
    </td>
    <td class="px-6 py-5">
        <span class="px-3 py-1 rounded-lg bg-gray-50 border border-gray-100 text-xs font-black text-gray-700 uppercase tracking-wider"><?= esc($s['kurir']) ?></span>
    </td>
    <td class="px-6 py-5">
        <code class="text-xs font-bold text-primary bg-primary-light/50 px-2 py-1 rounded-md"><?= esc($s['resi'] ?: '-') ?></code>
    </td>
    <td class="px-6 py-5">
        <?php if($s['status'] == 'delivered'): ?>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-primary-light text-primary text-[10px] font-black uppercase tracking-widest">
                <i data-lucide="check-circle" class="w-3 h-3"></i> Sampai
            </span>
        <?php elseif($s['status'] == 'shipped'): ?>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-50 text-blue-500 text-[10px] font-black uppercase tracking-widest">
                <i data-lucide="truck" class="w-3 h-3"></i> Dikirim
            </span>
        <?php else: ?>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-50 text-amber-500 text-[10px] font-black uppercase tracking-widest">
                <i data-lucide="clock" class="w-3 h-3"></i> Proses
            </span>
        <?php endif; ?>
    </td>
    <td class="px-6 py-5">
        <div class="flex flex-col">
            <span class="text-xs font-bold text-gray-700"><?= date('d M Y', strtotime($s['updated_at'])) ?></span>
            <span class="text-[10px] text-gray-400"><?= date('H:i', strtotime($s['updated_at'])) ?> WIB</span>
        </div>
    </td>
    <td class="px-6 py-5 text-center">
        <a href="<?= base_url('admin/pesanan/' . $s['id_order']) ?>" 
           class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-100 rounded-xl text-[10px] font-black text-gray-600 uppercase tracking-widest hover:bg-gray-50 hover:text-primary transition-all shadow-sm">
            <i data-lucide="settings" class="w-3.5 h-3.5"></i> Kelola
        </a>
    </td>
</tr>
<?php endforeach; ?>
