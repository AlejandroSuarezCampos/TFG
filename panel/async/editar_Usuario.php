<?php
    require_once("../db/conexion.php");

    $nombre =$_GET["nombre"];
    $email=$_GET["email"];
    $pass=$_GET["contraseña"];
    $modificar=$_GET["modificar"];

    $respuesta=[];

    //Validaciones básicas
    if ($modificar==NULL){
        header("Location: ../cuerpos/categorias.php");
    }else if($nombre=="" || $email==""|| $modificar==""){
        $respuesta=[
            "exito"=>false,
            "error"=>"campos_vacios",
            "mensaje"=>"Todos los campos son obligatorios"
        ];
    }else{
        $existe=$db->comprobarUsuExistePorID($modificar);
        if($existe>0){
            $db->modificarUsu($modificar,$nombre,$email,$pass);
            $respuesta=[
                "exito"=>true,
                "mensaje"=>"Usuario editado correctamente"
            ];
        }else{
            $respuesta=[
                "exito"=>false,
                "error" => "Usuario_no_existe",
                "mensaje"=>"El usuario no está creado"
            ];
        }
    }

    echo json_encode($respuesta);
?>