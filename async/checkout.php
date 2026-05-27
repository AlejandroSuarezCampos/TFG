<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once("../db/conexion.php");
include_once("../db/consultas.php");
require_once("./../vendor/autoload.php");
\Stripe\Stripe::setApiKey('sk_test_51TVq223JiYqRuNkdWHbg1JOQfZrC4zILSIAXiSet4kUfyoyfKsOqQEJl6z5uz6ckxI7RnNt70i3WVzOax7vtSKef00qRUnr611');
header('Content-Type: application/json');
$precio = 0;
try {
    // 1. OBTENER CARRITO
    $juegos_carrito = $db->listarjuegoscarrito($_SESSION["carrito"]);

    // 2. CONSTRUIR LINE ITEMS
    $line_items = [];
    $customer = \Stripe\Customer::create([
        'email' => $db->obtenerdato($_SESSION["usuario_id"], 0), // Cambia esto por el email del usuario actual
        'name' => $db->obtenerdato($_SESSION["usuario_id"], 1),
    ]);


    foreach ($juegos_carrito as $juego) {

        $line_items[] = [
            'price_data' => [
                'currency' => 'eur',
                'product_data' => [
                    'name' => $juego['titulo'],
                    'description' => $juego['horas'] . ' horas(IVA incluido)'
                ],
                'unit_amount' => intval($juego['precio_alquiler'] * 1.21 * 100),
            ],
            'quantity' => $juego['horas'],
        ];
    }

    // 3. CREAR SESIÓN STRIPE
    $base_url = 'http://' . $_SERVER['HTTP_HOST'] . '/TFG';
    $session = \Stripe\Checkout\Session::create([

        'mode' => 'payment',
        'line_items' => $line_items,
        'success_url' => $base_url . '/success.php?id={CHECKOUT_SESSION_ID}',
        'cancel_url' => $base_url . '/cancel.php',
        'customer' => $customer->id,
        /*'invoice_creation' => [
                'enabled' => true,
            ],*/
        'metadata' => [
            'usuario_id' => $_SESSION['usuario_id'],
            'carrito' => json_encode($_SESSION['carrito']),
            'customer_name' => $db->obtenerdato($_SESSION['usuario_id'], 1)
        ]
    ]);

    // 4. DEVOLVER URL
    echo json_encode([
        'url' => $session->url
    ]);


} catch (Exception $e) {

    http_response_code(500);

    echo json_encode([
        'error' => $e->getMessage()
    ]);
}
?>