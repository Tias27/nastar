<?php

namespace App\Controllers;

use App\Models\ProductModel;

class Home extends BaseController
{
    protected $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Bulan Cake & Cookies - Premium Pastry & Confectionery',
            'featured_products' => $this->productModel->getProducts(8, 'premium'), 
            'all_products' => $this->productModel->getProducts(4),
        ];
        return view('home/index', $data);
    }

    public function tentang()
    {
        $data = ['title' => 'Tentang Kami - Bulan Cake & Cookies'];
        return view('home/tentang', $data);
    }

    public function kontak()
    {
        $data = ['title' => 'Kontak Kami - Bulan Cake & Cookies'];
        return view('home/kontak', $data);
    }

    public function kirimKontak()
    {
        
        return redirect()->to('/kontak')->with('success', 'Pesan Anda berhasil dikirim! Kami akan segera menghubungi Anda.');
    }
}
