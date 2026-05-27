<?php
session_start();

include_once("../db/conexion.php");
include_once("../db/consultas.php");

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(["ok" => false]);
    exit;
}

$id_tema    = $_POST["id_tema"];
$id_usuario = $_SESSION["usuario_id"];

// Verificar que el tema pertenece al usuario
$tema = $db->obtenerTema($id_tema);

if (!$tema || $tema['id_usuario'] != $id_usuario) {
    echo json_encode(["ok" => false]);
    exit;
}

$db->eliminarTema($id_tema);

echo json_encode(["ok" => true]);
?>