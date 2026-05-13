<?php
include_once("../db/conexion.php");

header("Content-Type: application/json; charset=UTF-8");

try {

    $id_tema = $_GET["id"] ?? null;

    if (!$id_tema) {
        echo json_encode([]);
        exit;
    }

    $mensajes = $db->obtenerMensajes($id_tema);

    echo json_encode($mensajes);

} catch (Exception $e) {
    echo json_encode([
        "ok" => false,
        "error" => $e->getMessage()
    ]);
}
?>