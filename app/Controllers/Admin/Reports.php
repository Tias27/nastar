<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Reports extends BaseController
{
    public function index()
    {
        $start = $this->request->getGet('start') ?: date('Y-m-01');
        $end = $this->request->getGet('end') ?: date('Y-m-d');
        $export = $this->request->getGet('export');

        $db = \Config\Database::connect();

        
        $summary = $db->table('orders')
            ->select('COUNT(id_order) as total_orders, SUM(total_price) as total_revenue')
            ->where('status !=', 'cancelled')
            ->where('DATE(created_at) >=', $start)
            ->where('DATE(created_at) <=', $end)
            ->get()->getRowArray();

        
        $product_sales = $db->table('order_items')
            ->select('products.nama_product, SUM(order_items.quantity) as total_qty, SUM(order_items.quantity * order_items.price) as total_sales')
            ->join('orders', 'orders.id_order = order_items.id_order')
            ->join('products', 'products.id_product = order_items.id_product')
            ->where('orders.status !=', 'cancelled')
            ->where('DATE(orders.created_at) >=', $start)
            ->where('DATE(orders.created_at) <=', $end)
            ->groupBy('products.nama_product')
            ->orderBy('total_qty', 'DESC')
            ->get()->getResultArray();
        
        $items_sold = 0;
        foreach ($product_sales as $row) {
            $items_sold += $row['total_qty'];
        }

        if ($export === 'csv') {
            return $this->exportCSV($start, $end, $product_sales, $summary, $items_sold);
        }

        $data = [
            'title' => 'Laporan Penjualan - Admin',
            'summary' => $summary,
            'product_sales' => $product_sales,
            'items_sold' => $items_sold,
            'start' => $start,
            'end' => $end,
        ];
        return view('admin/reports/index', $data);
    }

    private function exportCSV($start, $end, $product_sales, $summary, $items_sold)
    {
        $filename = "Laporan_Penjualan_{$start}_to_{$end}.csv";
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/csv; ");

        $file = fopen('php://output', 'w');
        
        
        fputcsv($file, ['LAPORAN PENJUALAN BULAN CAKE & COOKIES']);
        fputcsv($file, ["Periode: $start s/d $end"]);
        fputcsv($file, []);
        
        
        fputcsv($file, ['RINGKASAN']);
        fputcsv($file, ['Total Pesanan', $summary['total_orders'] ?? 0]);
        fputcsv($file, ['Total Produk Terjual', $items_sold]);
        fputcsv($file, ['Total Omzet', 'Rp ' . number_format($summary['total_revenue'] ?? 0, 0, ',', '.')]);
        fputcsv($file, []);
        
        
        fputcsv($file, ['DETAIL PENJUALAN PER PRODUK']);
        fputcsv($file, ['Nama Produk', 'Jumlah Terjual', 'Total Pendapatan']);
        
        foreach ($product_sales as $row) {
            fputcsv($file, [
                $row['nama_product'],
                $row['total_qty'] . ' Toples',
                'Rp ' . number_format($row['total_sales'], 0, ',', '.')
            ]);
        }
        
        fclose($file);
        exit;
    }

    public function generate()
    {
        $periode = $this->request->getPost('periode');
        $db = \Config\Database::connect();

        $startDate = $periode . '-01';
        $endDate = date('Y-m-t', strtotime($startDate));

        $result = $db->table('orders')
            ->select('SUM(total_price) as total_sales, COUNT(id_order) as total_orders')
            ->where('status !=', 'cancelled')
            ->where('DATE(created_at) >=', $startDate)
            ->where('DATE(created_at) <=', $endDate)
            ->get()->getRowArray();

        $itemResult = $db->table('order_items')
            ->selectSum('quantity', 'total_items')
            ->join('orders', 'orders.id_order = order_items.id_order')
            ->where('orders.status !=', 'cancelled')
            ->where('DATE(orders.created_at) >=', $startDate)
            ->where('DATE(orders.created_at) <=', $endDate)
            ->get()->getRow()->total_items ?? 0;

        $existing = $db->table('reports')->where('periode', $startDate)->get()->getRowArray();
        if ($existing) {
            $db->table('reports')->where('periode', $startDate)->update([
                'total_sales' => $result['total_sales'] ?? 0,
                'total_orders' => $result['total_orders'] ?? 0,
                'total_items_sold' => $itemResult,
            ]);
        } else {
            $db->table('reports')->insert([
                'periode' => $startDate,
                'total_sales' => $result['total_sales'] ?? 0,
                'total_orders' => $result['total_orders'] ?? 0,
                'total_items_sold' => $itemResult,
            ]);
        }

        return redirect()->to('/admin/laporan')->with('success', 'Laporan berhasil dibuat!');
    }
}
