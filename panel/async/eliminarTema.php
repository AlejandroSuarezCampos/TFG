<?php
session_start();

include_once("../db/conexion.php");
include_once("../db/consultas.php");

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(["ok" => false]);
    exit;
}

$id_tema = $_POST["id_tema"];

$db->eliminarTema($id_tema);

echo json_encode(["ok" => true]);
?>