<?php
session_start();
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
    $_SESSION['carrito_total']=0;
}
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $horas = $_POST['horas'];
    // Evitar duplicados
    if (!in_array($id, $_SESSION['carrito'])) {
        $_SESSION['carrito'][$id] = $horas;
         $_SESSION['carrito_total']=count($_SESSION['carrito']);
    }

    echo json_encode([
        'ok' => true,
         'total' => $_SESSION['carrito_total']
    ]);
} else {
    echo json_encode([
        'ok' => false,
        'msg' => 'ID no recibido'
    ]);
}
?>