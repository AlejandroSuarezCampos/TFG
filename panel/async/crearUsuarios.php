<?php
    require_once("../db/conexion.php");

    $nombre=trim($_GET["nombre"]);
    $correo=trim($_GET["correo"]);
    $contrasena=trim($_GET["contrasena"]);

    $respuesta=[];

    //Validaciones básicas
    if($nombre=="" || $correo=="" || $contrasena==""){
        $respuesta=[
            "exito"=>false,
            "error"=>"campos_vacios",
            "mensaje"=>"Todos los campos son obligatorios"
        ];
    }else if(!filter_var($correo, FILTER_VALIDATE_EMAIL)){
        $respuesta=[
            "exito"=>false,
            "error"=>"correo_invalido",
            "mensaje"=>"El formato del correo no es válido"
        ];
    }else{
        $existe=$db->comprobarEmailExiste($correo);
        if($existe){
            $respuesta=[
                "exito"=>false,
                "error"=>"Usaurio_existe",
                "mensaje"=>"El correo ya está registrado"
            ];
        }else{
            $db->registrarUsuario($nombre, $correo, $contrasena);

            $respuesta=[
                "exito"=>true,
                "mensaje"=>"Usuario registrado correctamente"
            ];
        }
    }

    echo json_encode($respuesta);
?>