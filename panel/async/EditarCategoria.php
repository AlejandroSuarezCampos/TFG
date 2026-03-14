<?php
    require_once("../../db/conexion.php");

    $nombre =$_GET["nombre"];
    $modificar=$_GET["modificar"];

    $respuesta=[];

    //Validaciones básicas
    if ($modificar==NULL){
        header("Location: ../cuerpos/categorias.php");
    }else if($nombre=="" || $modificar==""){
        $respuesta=[
            "exito"=>false,
            "error"=>"campos_vacios",
            "mensaje"=>"Todos los campos son obligatorios"
        ];
    }else{
        $existe=$db->comprobarCatExistePorID($modificar);
        if($existe>0){
            $db->modificarCat($modificar,$nombre);
            $respuesta=[
                "exito"=>true,
                "mensaje"=>"Categoria editada correctamente"
            ];
        }else{
            $respuesta=[
                "exito"=>false,
                "error" => "categoria_no_existe",
                "mensaje"=>"La categoria no está Creada"
            ];
        }
    }

    echo json_encode($respuesta);
?>