<?php

namespace App\Controllers;

use App\Models\ProductModel;

class Products extends BaseController
{
    protected $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Katalog Produk - Bulan Cake & Cookies',
            'products' => $this->productModel->getProducts(),
            'active_category' => null,
            'keyword' => ''
        ];
        return view('products/index', $data);
    }

    public function detail($id)
    {
        $product = $this->productModel->find($id);
        if (!$product) {
            return redirect()->to('/produk')->with('error', 'Produk tidak ditemukan.');
        }
        $data = [
            'title' => $product['nama_product'] . ' - Bulan Cake & Cookies',
            'product' => $product,
            'related' => $this->productModel->getProducts(4), 
        ];
        return view('products/detail', $data);
    }

    public function cari()
    {
        $keyword = $this->request->getGet('q');
        
        if ($this->request->isAJAX()) {
            try {
                $products = $this->productModel->getProducts(null, $keyword);
                return $this->response
                    ->setHeader('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
                    ->setHeader('Pragma', 'no-cache')
                    ->setJSON($products)
                    ->setContentType('application/json');
            } catch (\Exception $e) {
                return $this->response
                    ->setHeader('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
                    ->setJSON(['error' => $e->getMessage()])
                    ->setContentType('application/json')
                    ->setStatusCode(500);
            }
        }

        $products = $this->productModel->getProducts(null, $keyword);
        $data = [
            'title' => 'Hasil Pencarian: ' . $keyword . ' - Bulan Cake & Cookies',
            'products' => $products,
            'keyword' => $keyword,
            'active_category' => null,
        ];
        return view('products/index', $data);
    }
}
