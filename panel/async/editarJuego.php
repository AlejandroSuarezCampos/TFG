<?php
require_once("../db/conexion.php");

header("Content-Type: application/json");


$id = $_POST["id"];
$titulo = trim($_POST["titulo"]);
$descripcion = trim($_POST["descripcion"]);
$precio = $_POST["precio"];
$ventas = $_POST["ventas"];
$stock = $_POST["stock"];

$imagenActual = $_POST["imagen_actual"] ?? null;


if ($titulo == "" || $descripcion == "" || $precio == "") {
    echo json_encode([
        "exito" => false,
        "error" => "campos_vacios",
        "mensaje" => "Todos los campos son obligatorios"
    ]);
    exit();
}

$existe = $db->comprobarJuegoExisteEditar($titulo, $id);

if ($existe) {
    echo json_encode([
        "exito" => false,
        "error" => "duplicado",
        "mensaje" => "Ya existe un juego con ese título"
    ]);
    exit();
}

$imagenActual = $_POST["imagen_actual"] ?? "";

$rutaBD = $imagenActual;

if (isset($_FILES["imagen"]) && !empty($_FILES["imagen"]["name"])) {

    $tipo = mime_content_type($_FILES["imagen"]["tmp_name"]);

    $permitidos = [
        "image/jpeg",
        "image/png",
        "image/gif",
        "image/webp"
    ];

    if (!in_array($tipo, $permitidos)) {
        echo json_encode([
            "exito" => false,
            "error" => "formato_invalido",
            "mensaje" => "Formato de imagen no permitido"
        ]);
        exit();
    
    }
    list($ancho, $alto) = getimagesize($_FILES["imagen"]["tmp_name"]);

    if ($ancho != 600 || $alto != 900) {

        echo json_encode([
            "exito" => false,
            "error" => "dimensiones_invalidas",
            "mensaje" => "La imagen debe ser exactamente 600x900 px"
        ]);

        exit();
    }

    if ($_FILES["imagen"]["size"] > 2 * 1024 * 1024) {
        echo json_encode([
            "exito" => false,
            "error" => "imagen_grande",
            "mensaje" => "La imagen supera 2MB"
        ]);
        exit();
    }
    $DIR = "c:\\xampp\\htdocs\\TFG\\img\\";

    $nombreImagen = time() . "_" . basename($_FILES["imagen"]["name"]);

    $rutaFisica = $DIR . $nombreImagen;

    if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $rutaFisica)) {
        $rutaBD = "img/" . $nombreImagen;
    } else {
        echo json_encode([
            "exito" => false,
            "error" => "subida_fallo",
            "mensaje" => "Error al subir la imagen"
        ]);
        exit();
    }
}

$db->editarJuego($id,$titulo,$descripcion,$precio,$rutaBD,$ventas,$stock);
echo json_encode([
    "exito" => true,
    "mensaje" => "Juego editado correctamente"
]);
?>