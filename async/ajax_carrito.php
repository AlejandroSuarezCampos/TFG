<?php
session_start();
include_once("../db/conexion.php");
include_once("../db/consultas.php");
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
    $_SESSION['carrito_total'] = 0;
}
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $horas = $_POST['horas'];
    // Evitar duplicados
    if (!in_array($id, $_SESSION['carrito'])) {
        $_SESSION['carrito'][$id] = $horas;
        $_SESSION['carrito_total'] = count($_SESSION['carrito']);
    } else {
        if (!isset($_SESSION['carrito'][$id])) {
            $_SESSION['carrito'][$id] = 0;
        }

        $_SESSION['carrito'][$id] += $horas;
    }
    if (isset($_SESSION["usuario_id"])) {
        $db->guardarCarritoUsuario(
            $_SESSION["usuario_id"],
            $_SESSION["carrito"]
        );
    }
    echo json_encode([
        'ok' => true,
        'carrito' => $_SESSION['carrito'],
        'total' => $_SESSION['carrito_total']
    ]);
} else {
    echo json_encode([
        'ok' => false,
        'msg' => 'ID no recibido'
    ]);
}
?>