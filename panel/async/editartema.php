<?php
require_once("../db/conexion.php");

$titulo    = $_POST["titulo"]    ?? "";
$modificar = $_POST["modificar"] ?? "";

$respuesta = [];

if (empty($modificar)) {
    $respuesta = [
        "exito" => false,
        "error" => "sin_id",
        "mensaje" => "ID de tema no válido"
    ];
} else if (empty($titulo)) {
    $respuesta = [
        "exito" => false,
        "error" => "campos_vacios",
        "mensaje" => "El título es obligatorio"
    ];
} else {
    $db->modificarTema($modificar, $titulo);
    $respuesta = [
        "exito" => true,
        "mensaje" => "Tema editado correctamente"
    ];
}

echo json_encode($respuesta);
?>