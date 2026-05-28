<?php
include_once("../db/conexion.php");

header("Content-Type: application/json; charset=UTF-8");

try {

    $id_ticket = $_POST["id"] ?? null;

    if (!$id_ticket) {  // ← era $id_tema, corregido
        echo json_encode([]);
        exit;
    }

    $mensajes = $db->obtenerMensajesTicket($id_ticket);

    echo json_encode($mensajes);

} catch (Exception $e) {
    echo json_encode([
        "ok" => false,
        "error" => $e->getMessage()
    ]);
}
?>