<?php
require_once(dirname(__FILE__) . '/wp-load.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    wp_send_json_error(['message' => 'Método não permitido.']);
}

$data = json_decode(file_get_contents('php://input'), true);
$assentos = sanitize_text_field($data['assentos'] ?? '');
$total = floatval($data['total'] ?? 0);

// ID fixo do produto 
$product_id = 357;


if (!class_exists('WC_Cart')) {
    wp_send_json_error(['message' => 'WooCommerce não encontrado.']);
}

// Esvazia o carrinho 
WC()->cart->empty_cart();

// Adiciona o produto com preço personalizado
WC()->cart->add_to_cart($product_id, 1, 0, [], [
    'assentos_selecionados' => $assentos,
    'preco_personalizado' => $total,
]);

// Redireciona ao checkout
wp_send_json_success(['checkout_url' => wc_get_checkout_url()]);
