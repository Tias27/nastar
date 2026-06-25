<?php

if (!function_exists('get_cart_count')) {
    function get_cart_count()
    {
        $session = session();
        if (!$session->get('logged_in') || !$session->get('id_customer')) {
            return 0;
        }

        $db = \Config\Database::connect();
        $cart = $db->table('cart')->where('id_customer', $session->get('id_customer'))->get()->getRowArray();
        
        if (!$cart) {
            return 0;
        }

        return $db->table('cart_items')->where('id_cart', $cart['id_cart'])->countAllResults();
    }
}
