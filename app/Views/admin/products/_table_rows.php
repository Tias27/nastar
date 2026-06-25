<?php $i = 1; foreach ($products as $p): ?>
<tr class="group hover:bg-gray-50/30 transition-all">
    <td class="px-8 py-5 text-sm font-bold text-gray-400"><?= $i++ ?></td>
    <td class="px-4 py-5">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 bg-gray-50 rounded-2xl overflow-hidden flex-shrink-0 border border-gray-100 group-hover:scale-105 transition-transform">
                <?php if (!empty($p['gambar']) && file_exists(ROOTPATH . 'public/uploads/products/' . $p['gambar'])): ?>
                    <img src="<?= base_url('uploads/products/' . $p['gambar']) ?>" class="w-full h-full object-cover">
                <?php else: ?>
                    <div class="w-full h-full flex items-center justify-center text-primary bg-primary-light">
                        <i data-lucide="cookie" class="w-6 h-6"></i>
                    </div>
                <?php endif; ?>
            </div>
            <div class="min-w-0">
                <p class="text-sm font-black text-gray-900 truncate group-hover:text-primary transition-colors"><?= esc($p['nama_product']) ?></p>
                <p class="text-[10px] text-text-muted font-medium line-clamp-1 mt-1"><?= esc($p['deskripsi'] ?? 'Tanpa deskripsi') ?></p>
            </div>
        </div>
    </td>
    <td class="px-4 py-5">
        <span class="text-sm font-black text-primary tracking-tight">Rp <?= number_format($p['harga'], 0, ',', '.') ?></span>
    </td>
    <td class="px-4 py-5 text-center">
        <?php
            $stok_class = 'bg-green-50 text-green-600 border-green-100';
            if ($p['stok'] <= 0) $stok_class = 'bg-red-50 text-red-600 border-red-100';
            elseif ($p['stok'] <= 10) $stok_class = 'bg-yellow-50 text-yellow-600 border-yellow-100';
        ?>
        <span class="inline-flex px-3 py-1 text-[10px] font-black uppercase tracking-widest rounded-full border <?= $stok_class ?>">
            <?= $p['stok'] ?> Toples
        </span>
    </td>
    <td class="px-8 py-5 text-right">
        <div class="flex items-center justify-end gap-2">
            <a href="<?= base_url('admin/produk/edit/' . $p['id_product']) ?>" 
               class="w-9 h-9 flex items-center justify-center bg-white border border-gray-100 rounded-xl text-gray-400 hover:text-blue-500 hover:border-blue-200 transition-all shadow-sm">
                <i data-lucide="edit-3" class="w-4 h-4"></i>
            </a>
            <a href="<?= base_url('admin/produk/hapus/' . $p['id_product']) ?>" 
               class="w-9 h-9 flex items-center justify-center bg-white border border-gray-100 rounded-xl text-gray-400 hover:text-red-500 hover:border-red-200 transition-all shadow-sm"
               onclick="return confirm('Hapus produk ini?')">
                <i data-lucide="trash-2" class="w-4 h-4"></i>
            </a>
        </div>
    </td>
</tr>
<?php endforeach; ?>

<?php if (empty($products)): ?>
<tr>
    <td colspan="5" class="px-8 py-20 text-center">
        <div class="flex flex-col items-center gap-4">
            <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center text-gray-300">
                <i data-lucide="inbox" class="w-10 h-10"></i>
            </div>
            <p class="text-sm font-bold text-gray-400 uppercase tracking-widest">Belum ada produk</p>
            <a href="<?= base_url('admin/produk/tambah') ?>" class="text-primary font-bold hover:underline">Tambah Sekarang</a>
        </div>
    </td>
</tr>
<?php endif; ?>
