<?php
require_once("../db/conexion.php");

$respuesta = [];

// Comprobar que venga el ID
if(isset($_GET['id']) && $_GET['id'] != ''){
    $id = $_GET['id'];
    $existe = $db->comprobarUsuExistePorID($id);

    if($existe > 0){
        $db->eliminarUsu($id);  
        $respuesta = [
            "exito" => true,
            "mensaje" => "Usuario eliminado correctamente"
        ];
    } else {
        $respuesta = [
            "exito" => false,
            "mensaje" => "El usuario no existe"
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