<?php
session_start();

include_once("../db/conexion.php");
include_once("../db/consultas.php");

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(["ok" => false]);
    exit;
}

$id_ticket = $_POST["id_ticket"];

$db->cerrarTicket($id_ticket);

echo json_encode(["ok" => true]);