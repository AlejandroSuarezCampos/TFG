<?php
session_start();
require_once("../db/conexion.php");

$nueva   = trim($_GET["nueva"]);
$repetir = trim($_GET["repetir"]);

$respuesta = [];

if ($nueva == "" || $repetir == "") {
    $respuesta = [
        "exito"   => false,
        "error"   => "campos_vacios",
        "mensaje" => "Todos los campos son obligatorios"
    ];
} else if ($nueva != $repetir) {
    $respuesta = [
        "exito"   => false,
        "error"   => "contrasenas_no_coinciden",
        "mensaje" => "Las contraseñas no coinciden"
    ];
} else if (strlen($nueva) < 8) {
    $respuesta = [
        "exito"   => false,
        "error"   => "contrasena_corta",
        "mensaje" => "La contraseña debe tener al menos 8 caracteres"
    ];
} else {
    $id_usuario = $_SESSION["usuario_id"];
    $db->cambiarPassword($id_usuario, $nueva);

    $respuesta = [
        "exito"   => true,
        "mensaje" => "Contraseña actualizada correctamente"
    ];
}

echo json_encode($respuesta);
?>