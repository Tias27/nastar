# 🍍 Bulan Cake & Cookies - E-Commerce Nastar & Kue Premium

[![PHP Version](https://img.shields.io/badge/PHP-%3E%3D%208.2-777bb4.svg?style=flat-square&logo=php)](https://www.php.net/)
[![Framework](https://img.shields.io/badge/Framework-CodeIgniter%204.7-EF4444.svg?style=flat-square&logo=codeigniter)](https://codeigniter.com/)
[![CSS Framework](https://img.shields.io/badge/Styling-Tailwind%20CSS-38bdf8.svg?style=flat-square&logo=tailwind-css)](https://tailwindcss.com/)
[![JS Framework](https://img.shields.io/badge/State%20Management-Alpine.js-77c1d2.svg?style=flat-square&logo=alpine.js)](https://alpinejs.dev/)
[![Payment Gateway](https://img.shields.io/badge/Payment-Midtrans-blue.svg?style=flat-square)](https://midtrans.com/)
[![Shipping API](https://img.shields.io/badge/Shipping-RajaOngkir-orange.svg?style=flat-square)](https://rajaongkir.com/)

**Bulan Cake & Cookies** adalah aplikasi web e-commerce modern yang dirancang khusus untuk penjualan produk kue nastar dan kue kering premium secara online. Aplikasi ini menggabungkan antarmuka pengguna (UI/UX) yang estetik dan responsif dengan integrasi sistem pembayaran otomatis serta kalkulasi ongkos kirim real-time untuk memberikan pengalaman belanja terbaik bagi pelanggan.

---

## 🌟 Fitur Utama

### 🛒 Sisi Pelanggan (Customer Side)
* **Antarmuka Premium & Responsif**: Didesain menggunakan Tailwind CSS, Alpine.js, dan Lucide Icons dengan performa yang cepat dan ramah seluler.
* **Katalog Produk Dinamis**: Pencarian produk, filter produk unggulan (featured), detail produk lengkap dengan informasi berat, harga, deskripsi, dan stok.
* **Sistem Keranjang Belanja**: Kelola item belanjaan secara interaktif sebelum melakukan checkout.
* **Integrasi RajaOngkir (Kalkulasi Ongkir Otomatis)**: Menghitung ongkos kirim secara real-time berdasarkan provinsi dan kota tujuan dengan pilihan kurir lokal di Indonesia.
* **Integrasi Midtrans Payment Gateway**: Pembayaran aman secara otomatis menggunakan Snap API Midtrans (mendukung Virtual Account Bank, E-Wallet seperti GoPay/OVO, Kartu Kredit, dll.).
* **Pembayaran Manual**: Opsi pembayaran via transfer bank manual dengan fitur upload bukti transfer langsung dari dashboard.
* **Dashboard Customer**:
  * Pelacakan status pesanan secara real-time (Pending, Processing, Shipped, Delivered).
  * Pengisian/pembaruan profil dan alamat pengiriman lengkap beserta nomor WhatsApp.
  * Riwayat transaksi terperinci.
* **Sistem Testimoni**: Pelanggan dapat memberikan ulasan dan rating bintang untuk produk yang telah dibeli.

### 💼 Sisi Administrator (Admin Side / Back-Office)
* **Dashboard Statistik**: Metrik ringkasan penjualan, jumlah pesanan, produk terlaris, dan grafik perkembangan bisnis.
* **Manajemen Produk (CRUD)**: Kelola data produk secara dinamis termasuk nama, deskripsi, harga, stok, berat, gambar produk, status aktif, dan tanda produk unggulan.
* **Manajemen Pesanan**: 
  * Memantau seluruh pesanan masuk secara real-time.
  * Mengubah status pesanan dan memproses pengiriman.
  * Menginput nomor resi pengiriman kurir untuk dilacak oleh pelanggan.
* **Verifikasi Pembayaran**: Meninjau bukti transfer pembayaran manual dan melakukan konfirmasi satu klik.
* **Manajemen Pelanggan**: Melihat dan mengelola daftar pelanggan terdaftar beserta riwayat belanja mereka.
* **Laporan Penjualan (Export PDF)**: Pembuatan laporan penjualan berdasarkan periode tertentu yang dapat diekspor langsung ke dokumen PDF.
* **Pengaturan Pengiriman**: Konfigurasi parameter logistik dan integrasi pengiriman.

---

## 🛠️ Teknologi & Library

Aplikasi ini dibangun menggunakan tumpukan teknologi modern berikut:

| Komponen | Teknologi / Library | Deskripsi |
| :--- | :--- | :--- |
| **Backend** | PHP 8.2+ | Bahasa pemrograman utama |
| **Framework** | CodeIgniter 4.7 | Framework MVC PHP yang ringan, cepat, dan aman |
| **Database** | MySQL / MariaDB | Penyimpanan data relasional |
| **Frontend Styling**| Tailwind CSS | Kerangka kerja CSS berbasis utilitas untuk UI modern |
| **Frontend Logic** | Alpine.js | Framework Javascript minimalis untuk interaktivitas reaktif |
| **Icons** | Lucide Icons | Paket ikon modern dan bersih |
| **Payment Gateway**| Midtrans PHP SDK | Pustaka resmi integrasi sistem pembayaran Midtrans |
| **Shipping API** | RajaOngkir API | Layanan web untuk pengecekan ongkos kirim di Indonesia |
| **PDF Engine** | DOMPDF (melalui Composer)| Pustaka untuk mengekspor dokumen HTML ke PDF |

---

## 📋 Persyaratan Sistem

Sebelum menjalankan aplikasi, pastikan server lokal atau VPS Anda memenuhi persyaratan berikut:

* **PHP >= 8.2** dengan ekstensi berikut diaktifkan di `php.ini`:
  * `intl`
  * `mbstring`
  * `curl`
  * `openssl`
  * `json` (diaktifkan secara default)
  * `mysqli` / `mysqlnd`
* **Composer** versi 2.0 atau lebih baru.
* **MySQL** versi 5.7+ atau **MariaDB** versi 10.3+.
* Web Server (Apache / Nginx) atau aplikasi local stack seperti **Laragon** (sangat direkomendasikan untuk Windows) atau **XAMPP**.

---

## 🚀 Panduan Instalasi dan Setup

Ikuti langkah-langkah berikut untuk menjalankan aplikasi di lingkungan pengembangan lokal Anda:

### 1. Dapatkan Kode Sumber
Ekstrak arsip proyek ini atau letakkan folder proyek di direktori web server Anda (misalnya `C:\laragon\www\nastar` jika menggunakan Laragon).

### 2. Instal Dependensi Composer
Buka terminal/command prompt di direktori root proyek dan jalankan perintah:
```bash
composer install
```

### 3. Konfigurasi Lingkungan (`.env`)
Salin file `env` bawaan menjadi file `.env` baru:
```bash
cp env .env
```
Buka file `.env` tersebut dan sesuaikan konfigurasinya:
* **Mode Lingkungan**:
  ```env
  CI_ENVIRONMENT = development
  ```
* **URL Aplikasi**:
  ```env
  app.baseURL = 'http://localhost:8080/'
  ```
* **Koneksi Database**:
  Sesuaikan dengan kredensial database lokal Anda:
  ```env
  database.default.hostname = localhost
  database.default.database = tb
  database.default.username = root
  database.default.password = 
  database.default.DBDriver = MySQLi
  database.default.port = 3306
  ```

### 4. Konfigurasi API Pihak Ketiga

#### A. Midtrans Payment Gateway
Konfigurasikan kunci API Midtrans Anda di file `app/Config/Midtrans.php`:
* Masukkan `serverKey` dan `clientKey` dari dashboard sandbox/production Midtrans Anda.
* Tentukan `isProduction` (`false` untuk tahap pengembangan/sandbox, `true` untuk live).
```php
public $serverKey = 'Mid-server-YOUR_SERVER_KEY'; 
public $clientKey = 'Mid-client-YOUR_CLIENT_KEY';
public $isProduction = false;
```

#### B. RajaOngkir Shipping API
Konfigurasikan kunci API RajaOngkir Anda di file `app/Config/RajaOngkir.php`:
* Masukkan `apiKey` RajaOngkir Anda.
* Tentukan `accountType` (`starter`, `basic`, atau `pro`).
* Tentukan `origin` (ID Kota asal pengiriman toko Anda, merujuk pada kode kota RajaOngkir. Contoh default: `'455'` untuk Kota Tangerang).
```php
public $apiKey = 'YOUR_RAJAONGKIR_API_KEY';
public $accountType = 'starter';
public $origin = '455';
```

### 5. Migrasi Database
Buat database kosong bernama `tb` di MySQL Anda (melalui phpMyAdmin atau pengelola database lainnya). Kemudian jalankan migrasi untuk membuat tabel-tabel secara otomatis:
```bash
php spark migrate
```

### 6. Membuat Akun Administrator (Admin)
Untuk masuk ke halaman admin, Anda memerlukan akun dengan peran `admin`. Ikuti langkah mudah berikut:
1. Jalankan aplikasi terlebih dahulu.
2. Buka peramban (browser) dan akses halaman pendaftaran: `http://localhost:8080/register`
3. Daftarkan akun baru dengan mengisi data diri Anda. Setelah berhasil mendaftar, Anda akan otomatis masuk sebagai `customer`.
4. Buka pengelola database Anda (seperti phpMyAdmin, DBeaver, dll.).
5. Cari tabel `users`, temukan baris akun yang baru saja Anda daftarkan, lalu ubah nilai pada kolom `role` dari `'customer'` menjadi `'admin'`.
6. Lakukan **Logout** pada aplikasi, lalu masuk kembali melalui halaman `http://localhost:8080/login`. Anda akan diarahkan langsung ke halaman dashboard admin!

---

## 💻 Menjalankan Aplikasi di Lokal

Jalankan perintah berikut pada terminal Anda untuk mengaktifkan server pengembangan bawaan CodeIgniter 4:
```bash
php spark serve
```
Aplikasi Anda sekarang dapat diakses melalui browser di alamat: **`http://localhost:8080`**

---

## 🛠️ Perintah CLI Kustom (Spark Commands)

Proyek ini dilengkapi dengan beberapa perintah pembantu berbasis CLI untuk mempermudah pengelolaan database:

* **Memeriksa Skema Database**:
  Melihat daftar tabel dan struktur kolom yang saat ini terpasang di database.
  ```bash
  php spark db:check
  ```
* **Membersihkan Database (Opsional)**:
  Perintah pembersihan untuk menyelaraskan batasan relasi dan menghapus tabel/kolom yang tidak digunakan jika diperlukan.
  ```bash
  php spark db:cleanup
  ```

---

## 📁 Struktur Direktori Penting

* `/app` - Direktori utama aplikasi MVC Anda.
  * `/Commands` - Perintah CLI kustom (seperti `db:check` dan `db:cleanup`).
  * `/Config` - Konfigurasi aplikasi, database, filter keamanan, serta konfigurasi Midtrans & RajaOngkir.
  * `/Controllers` - Controller logika aplikasi (termasuk folder `/Admin` untuk panel admin).
  * `/Database` - File migrasi skema basis data (`/Migrations`).
  * `/Filters` - Middleware otentikasi (`AdminFilter.php`, `NoAdminFilter.php`, dll.).
  * `/Models` - Representasi tabel database dan query data.
  * `/Views` - Berkas tampilan (template HTML & PHP) yang terbagi rapi berdasarkan modul/halaman.
* `/public` - Direktori publik yang dapat diakses dari web (berisi file `index.php`, aset CSS, JS, gambar, dan folder unggahan file `/uploads`).
* `/writable` - Direktori untuk menyimpan sesi (session), log aplikasi, cache, dan file temporer.

---

## 📄 Lisensi

Proyek ini dilisensikan di bawah **MIT License** - Lihat file [LICENSE](LICENSE) untuk informasi lebih lanjut.
