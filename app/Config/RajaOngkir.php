<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class RajaOngkir extends BaseConfig
{
    public $apiKey = 'YOUR_RAJAONGKIR_API_KEY_HERE'; // Ganti dengan API Key RajaOngkir Anda
    public $accountType = 'starter'; // starter, basic, or pro
    public $origin = '455'; // Kota Tangerang
    public $baseUrl = 'https://rajaongkir.komerce.id/api/v1/';
}
