<?php
    require_once("../db/conexion.php");

    $nombre =$_GET["nombre"];
    $modificar=$_GET["modificar"];

    $respuesta=[];

if ($modificar == NULL) {
    header("Location: ../cuerpos/categorias.php");
} else if ($nombre == "" || $modificar == "") {
    $respuesta = [
        "exito" => false,
        "error" => "campos_vacios",
        "mensaje" => "Todos los campos son obligatorios"
    ];
} else {
    $existe = $db->comprobarCatExistePorID($modificar);
    if ($existe > 0) {
        $existe2 = $db->comprobarCatExiste($nombre);
        if ($existe2 > 0) {
            $respuesta = [
                "exito" => false,
                "error" => "categoria_existe",
                "mensaje" => "La categoria ya está Creada"
            ];
        } else {
            $db->modificarCat($modificar, $nombre);
            $respuesta = [
                "exito" => true,
                "mensaje" => "Categoria editada correctamente"
            ];
        }
    } else {
        $respuesta = [
            "exito" => false,
            "error" => "categoria_no_existe",
            "mensaje" => "La categoria no está Creada"
        ];
    }
}

    echo json_encode($respuesta);
?>