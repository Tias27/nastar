<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');
$routes->get('produk', 'Products::index');
$routes->get('produk/(:num)', 'Products::detail/$1');
$routes->get('tentang', 'Home::tentang');
$routes->get('kontak', 'Home::kontak');
$routes->post('kontak/kirim', 'Home::kirimKontak');
$routes->get('cari', 'Products::cari');

$routes->get('login', 'Auth::login');
$routes->post('login/proses', 'Auth::prosesLogin');
$routes->get('register', 'Auth::register');
$routes->post('register/proses', 'Auth::prosesRegister');
$routes->get('logout', 'Auth::logout');


$routes->group('customer', ['filter' => ['auth', 'noadmin']], function ($routes) {
    $routes->get('dashboard', 'Customer::dashboard');
    $routes->get('profil', 'Customer::profil');
    $routes->post('profil/update', 'Customer::updateProfil');
    $routes->get('pesanan', 'Customer::pesanan');
    $routes->get('pesanan/(:any)', 'Customer::detailPesanan/$1');
});

$routes->group('keranjang', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'Cart::index');
    $routes->post('tambah', 'Cart::tambah');
    $routes->post('update', 'Cart::update');
    $routes->get('hapus/(:num)', 'Cart::hapus/$1');
    $routes->get('checkout', 'Cart::checkout');
    $routes->post('proses-checkout', 'Cart::prosesCheckout');
});

$routes->group('pesanan', ['filter' => 'auth'], function ($routes) {
    $routes->get('bayar/(:any)', 'Orders::bayar/$1');
    $routes->post('upload-bukti/(:any)', 'Orders::uploadBukti/$1');
    $routes->get('sukses/(:any)', 'Orders::sukses/$1');
    $routes->get('simulate/(:any)', 'Orders::simulatePayment/$1');
    $routes->post('notification', 'Orders::notification');
});

$routes->group('rajaongkir', function ($routes) {
    $routes->get('provinces', 'RajaOngkirController::getProvinces');
    $routes->get('cities/(:num)', 'RajaOngkirController::getCities/$1');
    $routes->post('cost', 'RajaOngkirController::getCost');
});

$routes->group('admin', ['filter' => 'admin'], function ($routes) {
    $routes->get('/', 'Admin\Dashboard::index');
    $routes->get('dashboard', 'Admin\Dashboard::index');

    $routes->get('produk', 'Admin\Products::index');
    $routes->get('produk/tambah', 'Admin\Products::tambah');
    $routes->post('produk/simpan', 'Admin\Products::simpan');
    $routes->get('produk/edit/(:num)', 'Admin\Products::edit/$1');
    $routes->post('produk/update/(:num)', 'Admin\Products::update/$1');
    $routes->get('produk/hapus/(:num)', 'Admin\Products::hapus/$1');

    $routes->get('pesanan', 'Admin\Orders::index');
    $routes->get('pesanan/search', 'Admin\Orders::search');
    $routes->get('pesanan/(:num)', 'Admin\Orders::detail/$1');
    $routes->post('pesanan/update-status/(:num)', 'Admin\Orders::updateStatus/$1');
    $routes->get('pesanan/set-status/(:num)/(:any)', 'Admin\Orders::setStatus/$1/$2');
    $routes->get('pesanan/kirim/(:num)', 'Admin\Orders::kirim/$1');
    $routes->post('pesanan/update-resi/(:num)', 'Admin\Orders::updateResi/$1');

    $routes->get('pelanggan', 'Admin\Customers::index');
    $routes->get('pelanggan/tambah', 'Admin\Customers::tambah');
    $routes->post('pelanggan/simpan', 'Admin\Customers::simpan');
    $routes->get('pelanggan/edit/(:num)', 'Admin\Customers::edit/$1');
    $routes->post('pelanggan/update/(:num)', 'Admin\Customers::update/$1');
    $routes->get('pelanggan/hapus/(:num)', 'Admin\Customers::hapus/$1');
    $routes->get('pelanggan/search', 'Admin\Customers::search');
    $routes->get('pelanggan/detail/(:num)', 'Admin\Customers::detail/$1');

    $routes->get('pembayaran', 'Admin\Payments::index');
    $routes->get('pembayaran/search', 'Admin\Payments::search');
    $routes->post('pembayaran/konfirmasi/(:num)', 'Admin\Payments::konfirmasi/$1');
    $routes->get('pembayaran/verifikasi/(:num)/(:any)', 'Admin\Payments::verifikasi/$1/$2');

    $routes->get('pengiriman', 'Admin\Shipping::index');
    $routes->post('pengiriman/update/(:num)', 'Admin\Shipping::update/$1');

    $routes->get('laporan', 'Admin\Reports::index');
    $routes->post('laporan/generate', 'Admin\Reports::generate');
    $routes->get('laporan/pdf/(:num)', 'Admin\Reports::pdf/$1');
});
