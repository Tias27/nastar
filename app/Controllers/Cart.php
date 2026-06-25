<?php

namespace App\Controllers;

use App\Models\CartModel;
use App\Models\CartItemModel;
use App\Models\ProductModel;
use App\Models\OrderModel;
use App\Models\OrderItemModel;
use App\Models\PaymentModel;
use App\Models\ShippingModel;

class Cart extends BaseController
{
    protected $cartModel;
    protected $cartItemModel;
    protected $productModel;

    public function __construct()
    {
        $this->cartModel = new CartModel();
        $this->cartItemModel = new CartItemModel();
        $this->productModel = new ProductModel();
    }

    private function getOrCreateCart()
    {
        $id_customer = session()->get('id_customer');
        $cart = $this->cartModel->getCartByCustomer($id_customer);
        if (!$cart) {
            $id_cart = $this->cartModel->insert(['id_customer' => $id_customer, 'total_price' => 0]);
            $cart = $this->cartModel->find($id_cart);
        }
        return $cart;
    }

    public function index()
    {
        $cart = $this->getOrCreateCart();
        $items = $this->cartItemModel->getItemsByCart($cart['id_cart']);
        $data = [
            'title' => 'Keranjang Belanja - Bulan Cake & Cookies',
            'cart'  => $cart,
            'items' => $items,
        ];
        return view('cart/index', $data);
    }

    public function tambah()
    {
        $id_product = $this->request->getPost('id_product');
        $quantity = $this->request->getPost('quantity');
        $quantity = $quantity ? (int)$quantity : 1;

        $product = $this->productModel->find($id_product);
        if (!$product || $product['stok'] < $quantity) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi.');
        }

        $cart = $this->getOrCreateCart();
        $existing = $this->cartItemModel->findByCartAndProduct($cart['id_cart'], $id_product);

        $itemId = null;
        if ($existing) {
            $newQty = $existing['quantity'] + $quantity;
            $this->cartItemModel->update($existing['id'], ['quantity' => $newQty]);
            $itemId = $existing['id'];
        } else {
            $itemId = $this->cartItemModel->insert([
                'id_cart' => $cart['id_cart'],
                'id_product' => $id_product,
                'quantity' => $quantity,
                'price' => $product['harga'],
            ]);
        }
        $this->cartModel->updateTotal($cart['id_cart']);

        if ($this->request->getPost('buy_now')) {
            
            return redirect()->to('/keranjang/checkout?items[]=' . $itemId);
        }

        return redirect()->to('/keranjang')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function update()
    {
        $id = $this->request->getPost('id');
        $quantity = (int)$this->request->getPost('quantity');

        if ($quantity <= 0) {
            $this->cartItemModel->delete($id);
        } else {
            $this->cartItemModel->update($id, ['quantity' => $quantity]);
        }

        $item = $this->cartItemModel->find($id);
        if ($item) {
            $this->cartModel->updateTotal($item['id_cart']);
        }

        return redirect()->to('/keranjang')->with('success', 'Keranjang diperbarui.');
    }

    public function hapus($id)
    {
        $item = $this->cartItemModel->find($id);
        if ($item) {
            $id_cart = $item['id_cart'];
            $this->cartItemModel->delete($id);
            $this->cartModel->updateTotal($id_cart);
        }
        return redirect()->to('/keranjang')->with('success', 'Item berhasil dihapus dari keranjang.');
    }

    public function checkout()
    {
        $cart = $this->getOrCreateCart();
        $selectedIds = $this->request->getGet('items');
        
        if (!$selectedIds || !is_array($selectedIds)) {
            return redirect()->to('/keranjang')->with('error', 'Silakan pilih produk yang ingin dibeli.');
        }

        $allItems = $this->cartItemModel->getItemsByCart($cart['id_cart']);
        $items = array_filter($allItems, function($item) use ($selectedIds) {
            return in_array($item['id'], $selectedIds);
        });

        if (empty($items)) {
            return redirect()->to('/keranjang')->with('error', 'Produk tidak ditemukan atau belum dipilih.');
        }

        
        $tempTotal = 0;
        foreach ($items as $item) {
            $tempTotal += $item['price'] * $item['quantity'];
        }

        $data = [
            'title' => 'Checkout - Bulan Cake & Cookies',
            'cart'  => $cart,
            'items' => $items,
            'tempTotal' => $tempTotal,
            'selectedIds' => $selectedIds
        ];
        return view('cart/checkout', $data);
    }

    public function prosesCheckout()
    {
        $cart = $this->getOrCreateCart();
        $selectedIds = $this->request->getPost('items');
        
        if (!$selectedIds || !is_array($selectedIds)) {
            return redirect()->to('/keranjang')->with('error', 'Pilih produk terlebih dahulu.');
        }

        $allItems = $this->cartItemModel->getItemsByCart($cart['id_cart']);
        $items = array_filter($allItems, function($item) use ($selectedIds) {
            return in_array($item['id'], $selectedIds);
        });

        if (empty($items)) {
            return redirect()->to('/keranjang')->with('error', 'Item tidak valid.');
        }

        $id_customer = session()->get('id_customer');
        $alamat_kirim = $this->request->getPost('alamat_kirim');
        $id_kota = $this->request->getPost('id_kota');
        $provinsi = $this->request->getPost('provinsi');
        $kurir = $this->request->getPost('kurir');
        $layanan = $this->request->getPost('layanan_ongkir');
        $ongkir = (int)$this->request->getPost('ongkir');
        $catatan = $this->request->getPost('catatan');

        
        $items_total = 0;
        foreach ($items as $item) {
            $items_total += $item['price'] * $item['quantity'];
        }
        $final_total = $items_total + $ongkir;

        
        $orderModel = new OrderModel();
        $order_token = bin2hex(random_bytes(10));
        $id_order = $orderModel->insert([
            'order_token' => $order_token,
            'id_customer' => $id_customer,
            'total_price' => $final_total,
            'status' => 'pending',
            'catatan' => $catatan,
        ]);

        
        $orderItemModel = new OrderItemModel();
        foreach ($items as $item) {
            $orderItemModel->insert([
                'id_order' => $id_order,
                'id_product' => $item['id_product'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        
        $paymentModel = new PaymentModel();
        $paymentModel->insert([
            'id_order' => $id_order,
            'amount' => $final_total,
            'status' => 'unpaid',
        ]);

        
        $shippingModel = new ShippingModel();
        $shippingModel->insert([
            'id_order' => $id_order,
            'alamat_kirim' => $alamat_kirim,
            'kurir' => $kurir,
            'status' => 'pending',
        ]);

        
        foreach ($items as $item) {
            $this->cartItemModel->delete($item['id']);
        }
        $this->cartModel->update($cart['id_cart'], ['total_price' => 0]);

        return redirect()->to('/pesanan/bayar/' . $order_token)->with('success', 'Pesanan berhasil dibuat!');
    }
}
