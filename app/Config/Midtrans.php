<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Midtrans extends BaseConfig
{
    // Sandbox keys for development
    public $serverKey = 'Mid-server-YOUR_SERVER_KEY_HERE'; 
    public $clientKey = 'Mid-client-YOUR_CLIENT_KEY_HERE';
    public $isProduction = false;
    public $isSanitized = true;
    public $is3ds = true;
}
