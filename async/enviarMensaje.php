<?php
include_once("../db/conexion.php");
session_start();

header("Content-Type: application/json; charset=UTF-8");

try {
    $id_tema = $_POST["id_tema"] ?? null;
    $contenido = $_POST["contenido"] ?? null;
    $id_usuario = $_SESSION["usuario_id"] ?? null;

    if (!$id_tema || !$contenido || !$id_usuario) {
        echo json_encode([
            "ok" => false,
            "error" => "missing_fields",
            "message" => "Los campos deben estar rellenos"
        ]);
        exit;
    }

    if (empty(trim($contenido))) {
        echo json_encode([
            "ok" => false,
            "error" => "empty_message",
            "message" => "El mensaje no puede estar vacío"
        ]);
        exit;
    }

    $db->crearMensaje($id_tema, $id_usuario, $contenido);

    echo json_encode([
        "ok" => true,
        "message" => "Mensaje publicado correctamente"
    ]);

} catch (Exception $e) {
    echo json_encode([
        "ok" => false,
        "error" => "server_error",
        "message" => "Ha habido un error a la hora de colgar el mensaje"
    ]);
}
?>