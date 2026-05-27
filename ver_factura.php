<?php
session_start();
require_once("./db/conexion.php");
require_once("./db/consultas.php");


$id_usuario = $_SESSION["usuario_id"];
$id_pedido = $_GET["id"];
$modo = $_GET["modo"] ?? "view";

$factura = $db->reciboPerteneceUsuario($id_pedido, $id_usuario);

if(!$factura){
    die("Acceso denegado");
}
$archivo = __DIR__ . "/facturas/" . $factura;
/* 🔥 comprobar que existe */
if(!file_exists($archivo)){
    die("Factura no encontrada");
}
if($modo === "view"){
    header("Content-Type: application/pdf");
    header("Content-Disposition: inline; filename=".$factura);
    readfile($archivo);
    exit;
}

/* ⬇️ MODO DESCARGA */
if($modo === "download"){
    header("Content-Type: application/pdf");
    header("Content-Disposition: attachment; filename=".$factura);
    readfile($archivo);
    exit;
}
?>