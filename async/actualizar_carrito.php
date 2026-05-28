<?php
session_start();
include_once("../db/conexion.php");
include_once("../db/consultas.php");

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}
$total_precio = 0;
if (isset($_POST['id']) && isset($_POST['horas'])) {

    $id = $_POST['id'];
    $horas = $_POST['horas'];
    $precio = $db->obtenerPrecio($id);
    $total_juego = $precio * $horas;
    if(isset($_SESSION["usuario_id"])) {

        $usuarioId = $_SESSION["usuario_id"];
        $db->actualizarHorasCarrito($usuarioId, $id, $horas);

        // mantener también sincronizada la sesión
        $_SESSION['carrito'][$id] = $horas;

    } else {
        $_SESSION['carrito'][$id] = $horas;
    }

    // Recalcular total de artículos
    $_SESSION['carrito_total'] = count($_SESSION['carrito']);
foreach ($_SESSION['carrito'] as $id => $horas) {
    $precio = $db->obtenerPrecio($id); // desde BD
    $total_precio += $precio * $horas;
}

    echo json_encode([
    "ok" => true,
    "total_items" =>  count($_SESSION['carrito']),
    "total_precio" => $total_precio,
    "total_juego" => $total_juego
]);

} else {
    echo json_encode([
        'ok' => false,
        'msg' => 'Datos incompletos'
    ]);
}