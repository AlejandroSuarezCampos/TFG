<?php
session_start();
include_once("../db/conexion.php");

header("Content-Type: application/json; charset=UTF-8");

if (!isset($_SESSION['Rol']) || $_SESSION['Rol'] != 1) {
    echo json_encode(["ok" => false, "error" => "No autorizado"]);
    exit;
}

$id_respuesta = intval($_POST['id']);

if ($db->eliminarMensaje($id_respuesta)) {
    echo json_encode(["ok" => true]);
} else {
    echo json_encode(["ok" => false, "error" => "No se pudo eliminar"]);
}
?>