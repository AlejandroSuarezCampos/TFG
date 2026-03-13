<?php
require_once("../../db/conexion.php");

$respuesta = [];

// Comprobar que venga el ID
if(isset($_GET['id']) && $_GET['id'] != ''){
    $id = $_GET['id'];
    $existe = $db->comprobarCatExistePorID($id);

    if($existe > 0){
        $db->eliminarCat($id);
        $respuesta = [
            "exito" => true,
            "mensaje" => "Categoría eliminada correctamente"
        ];
    } else {
        $respuesta = [
            "exito" => false,
            "mensaje" => "La categoría no existe"
        ];
    }
} else {
    $respuesta = [
        "exito" => false,
        "mensaje" => "ID no válido"
    ];
}

echo json_encode($respuesta);
?>