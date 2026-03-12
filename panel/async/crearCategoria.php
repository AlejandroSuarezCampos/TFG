<?php
    require_once("../../db/conexion.php");

    $nombre = $_GET["nombre"];

    $respuesta=[];

    //Validaciones básicas
    if($nombre==""){
        $respuesta=[
            "exito"=>false,
            "error"=>"campos_vacios",
            "mensaje"=>"Todos los campos son obligatorios"
        ];
    }else{
        $existe=$db->comprobarCatExiste($nombre);
        if($existe>0){
            $respuesta=[
                "exito"=>false,
                "error" => "categoria_existe",
                "mensaje"=>"La categoria ya está Creada"
            ];
        }else{
            $db->crearCat($nombre);
            $respuesta=[
                "exito"=>true,
                "mensaje"=>"Categoria creada correctamente"
            ];
        }
    }

    echo json_encode($respuesta);
?>