<?php if(empty($orders)): ?>
    <tr>
        <td colspan="6" class="px-8 py-20 text-center">
            <div class="flex flex-col items-center gap-3">
                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center text-gray-300">
                    <i data-lucide="inbox" class="w-8 h-8"></i>
                </div>
                <p class="text-sm font-bold text-gray-400 uppercase tracking-widest">Tidak ada pesanan ditemukan</p>
            </div>
        </td>
    </tr>
<?php endif; ?>

<?php foreach ($orders as $order): ?>
<tr class="group hover:bg-gray-50/50 transition-all">
    <td class="px-8 py-5 align-middle">
        <span class="text-sm font-black text-gray-900 tracking-tight">#<?= $order['id_order'] ?></span>
    </td>
    <td class="px-4 py-5 align-middle">
        <div class="min-w-[150px]">
            <p class="text-sm font-bold text-gray-900 leading-tight"><?= esc($order['nama']) ?></p>
            <p class="text-[10px] text-text-muted font-medium mt-1">@<?= esc($order['username']) ?> • <?= esc($order['phone']) ?></p>
        </div>
    </td>
    <td class="px-4 py-5 align-middle">
        <div class="min-w-[100px]">
            <p class="text-sm font-bold text-gray-700 leading-tight"><?= date('d M Y', strtotime($order['created_at'])) ?></p>
            <p class="text-[10px] text-text-muted mt-1"><?= date('H:i', strtotime($order['created_at'])) ?> WIB</p>
        </div>
    </td>
    <td class="px-4 py-5 align-middle">
        <?php
        $badge_class = 'bg-yellow-50 text-yellow-600 border-yellow-100';
        if ($order['status'] == 'processing') $badge_class = 'bg-blue-50 text-blue-600 border-blue-100';
        if ($order['status'] == 'shipped') $badge_class = 'bg-orange-50 text-orange-600 border-orange-100';
        if ($order['status'] == 'delivered') $badge_class = 'bg-green-50 text-green-600 border-green-100';
        if ($order['status'] == 'cancelled') $badge_class = 'bg-red-50 text-red-600 border-red-100';
        ?>
        <span class="inline-flex px-3 py-1 text-[10px] font-black uppercase tracking-widest rounded-full border <?= $badge_class ?>">
            <?= $order['status'] ?>
        </span>
    </td>
    <td class="px-4 py-5 align-middle">
        <span class="text-sm font-black text-primary tracking-tight">Rp <?= number_format($order['total_price'], 0, ',', '.') ?></span>
    </td>
    <td class="px-8 py-5 align-middle text-right">
        <div class="flex items-center justify-end gap-2">
            <a href="<?= base_url('admin/pesanan/' . $order['id_order']) ?>" 
               class="w-9 h-9 flex items-center justify-center bg-white border border-gray-100 rounded-xl text-gray-400 hover:text-primary hover:border-primary transition-all shadow-sm">
                <i data-lucide="eye" class="w-4 h-4"></i>
            </a>
        </div>
    </td>
</tr>
<?php endforeach; ?>
