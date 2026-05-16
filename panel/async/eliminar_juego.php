<?php
require_once("../db/conexion.php");

$respuesta = [];

// Comprobar que venga el ID
if(isset($_POST['id']) && $_POST['id'] != ''){
    $id = $_POST['id'];
    $existe = $db->existeJuegoId($id);

    if($existe > 0){
        $db->eliminarJuego($id);  
        $respuesta = [
            "exito" => true,
            "mensaje" => "Juego eliminado correctamente"
        ];
    } else {
        $respuesta = [
            "exito" => false,
            "mensaje" => "El Juego no existe"
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