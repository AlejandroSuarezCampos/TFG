<?php
include_once("../db/conexion.php");
session_start();


if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(["ok" => false]);
    exit;
}

$id_ticket  = $_POST["id_ticket"];
$mensaje    = $_POST["mensaje"];
$id_usuario = $_SESSION["usuario_id"];

$db->crearMensajeTicket($id_usuario, $id_ticket, $mensaje);

echo json_encode(["ok" => true]);