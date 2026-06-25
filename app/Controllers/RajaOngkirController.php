<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\RajaOngkir;

class RajaOngkirController extends Controller
{
    protected $config;

    public function __construct()
    {
        $this->config = new RajaOngkir();
    }

    public function getProvinces()
    {
        $cacheKey = 'ro_provinces';
        $cached = cache($cacheKey);
        if ($cached) {
            return $this->response->setBody($cached)->setContentType('application/json');
        }

        $curl = service('curlrequest');
        try {
            $response = $curl->get($this->config->baseUrl . 'destination/province', [
                'headers' => [
                    'key' => $this->config->apiKey
                ],
                'verify' => false,
                'http_errors' => false
            ]);
            $body = $response->getBody();
            if ($response->getStatusCode() === 200) {
                cache()->save($cacheKey, $body, 86400 * 30); 
            }
            return $this->response->setBody($body)->setContentType('application/json');
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON(['error' => $e->getMessage()]);
        }
    }

    public function getCities($provinceId)
    {
        $cacheKey = 'ro_cities_' . $provinceId;
        $cached = cache($cacheKey);
        if ($cached) {
            return $this->response->setBody($cached)->setContentType('application/json');
        }

        $curl = service('curlrequest');
        try {
            
            $response = $curl->get($this->config->baseUrl . 'destination/city/' . $provinceId, [
                'headers' => [
                    'key' => $this->config->apiKey
                ],
                'verify' => false,
                'http_errors' => false
            ]);
            $body = $response->getBody();
            if ($response->getStatusCode() === 200) {
                cache()->save($cacheKey, $body, 86400 * 30); 
            }
            return $this->response->setBody($body)->setContentType('application/json');
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON(['error' => $e->getMessage()]);
        }
    }

    public function getCost()
    {
        $destination = $this->request->getPost('destination');
        $weight = $this->request->getPost('weight') ?: 1000;
        $courier = $this->request->getPost('courier');

        $cacheKey = 'ro_cost_' . $destination . '_' . $weight . '_' . $courier;
        $cached = cache($cacheKey);
        if ($cached) {
            return $this->response->setBody($cached)->setContentType('application/json');
        }

        $curl = service('curlrequest');
        try {
            $response = $curl->post($this->config->baseUrl . 'calculate/domestic-cost', [
                'headers' => [
                    'key' => $this->config->apiKey
                ],
                'form_params' => [
                    'origin' => $this->config->origin,
                    'destination' => $destination,
                    'weight' => $weight,
                    'courier' => strtolower($courier)
                ],
                'verify' => false,
                'http_errors' => false
            ]);
            $body = $response->getBody();
            if ($response->getStatusCode() === 200) {
                cache()->save($cacheKey, $body, 86400 * 7); 
            }
            return $this->response->setBody($body)->setContentType('application/json');
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON(['error' => $e->getMessage()]);
        }
    }
}
