<?php
session_start();
include_once("../db/conexion.php");

$codigo = trim($_GET['codigo'] ?? '');

if (!$codigo) {
    echo json_encode(['ok' => false, 'error' => 'Introduce un código.']);
    exit;
}

$resultado = $db->activarCodigo($codigo, $_SESSION['usuario_id']);
echo json_encode($resultado);
?>