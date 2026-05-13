<?php
session_start();
include_once("../db/conexion.php");
include_once("../db/consultas.php");
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    if (isset($_SESSION["usuario_id"])) {
        $id_usu=$_SESSION["usuario_id"];
        $db->eliminarJuegoCarrito($id_usu,$id);

        unset($_SESSION["carrito"][$id]);
            $_SESSION["carrito_total"] = count($_SESSION["carrito"]);
            echo json_encode([
                'ok' => true,
                'total' => $_SESSION['carrito_total']
            ]);
    } else {
        if (isset($_SESSION["carrito"][$id])) {
            unset($_SESSION["carrito"][$id]);
            $_SESSION["carrito_total"] = count($_SESSION["carrito"]);
            echo json_encode([
                'ok' => true,
                'total' => $_SESSION['carrito_total']
            ]);

        } else {
            echo json_encode([
                'ok' => false,
                'msg' => 'Prodcuto no existente'
            ]);
        }
    }
} else {
    echo json_encode([
        'ok' => false,
        'msg' => 'ID no recibido'
    ]);
}
?>