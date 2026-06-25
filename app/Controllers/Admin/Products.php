<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
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
        $keyword = $this->request->getGet('keyword');
        $products = $this->productModel->getProducts(null, $keyword);

        if ($this->request->isAJAX()) {
            return view('admin/products/_table_rows', ['products' => $products]);
        }

        $data = [
            'title'    => 'Kelola Produk - Admin',
            'products' => $products,
            'keyword'  => $keyword,
        ];
        return view('admin/products/index', $data);
    }

    public function tambah()
    {
        $data = ['title' => 'Tambah Produk - Admin'];
        return view('admin/products/form', $data);
    }

    public function simpan()
    {
        $rules = [
            'nama_product' => 'required|min_length[3]',
            'harga'        => 'required|numeric',
            'stok'         => 'required|integer|greater_than_equal_to[0]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->with('errors', $this->validator->getErrors())->withInput();
        }

        $gambar = null;
        $file = $this->request->getFile('gambar');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads/products', $newName);
            $gambar = $newName;
        }

        $this->productModel->insert([
            'nama_product' => $this->request->getPost('nama_product'),
            'deskripsi'    => $this->request->getPost('deskripsi'),
            'harga'        => $this->request->getPost('harga'),
            'stok'         => $this->request->getPost('stok'),
            'gambar'       => $gambar,
        ]);

        return redirect()->to('/admin/produk')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $product = $this->productModel->find($id);
        if (!$product) {
            return redirect()->to('/admin/produk')->with('error', 'Produk tidak ditemukan.');
        }
        $data = [
            'title'   => 'Edit Produk - Admin',
            'product' => $product,
        ];
        return view('admin/products/form', $data);
    }

    public function update($id)
    {
        $product = $this->productModel->find($id);
        if (!$product) {
            return redirect()->to('/admin/produk');
        }

        $gambar = $product['gambar'];
        $file = $this->request->getFile('gambar');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads/products', $newName);
            $gambar = $newName;
        }

        $this->productModel->update($id, [
            'nama_product' => $this->request->getPost('nama_product'),
            'deskripsi'    => $this->request->getPost('deskripsi'),
            'harga'        => $this->request->getPost('harga'),
            'stok'         => $this->request->getPost('stok'),
            'gambar'       => $gambar,
        ]);

        return redirect()->to('/admin/produk')->with('success', 'Produk berhasil diperbarui!');
    }

    public function hapus($id)
    {
        $product = $this->productModel->find($id);
        if ($product && !empty($product['gambar'])) {
            $path = ROOTPATH . 'public/uploads/products/' . $product['gambar'];
            if (file_exists($path)) {
                unlink($path);
            }
        }
        $this->productModel->delete($id);
        return redirect()->to('/admin/produk')->with('success', 'Produk berhasil dihapus.');
    }
}
