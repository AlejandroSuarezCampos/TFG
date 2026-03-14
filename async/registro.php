<?php
    require_once("../db/conexion.php");

    $nombre=trim($_GET["nombre"]);
    $correo=trim($_GET["correo"]);
    $contrasena=trim($_GET["contrasena"]);
    $contrasena2=trim($_GET["contrasena2"]);

    $respuesta=[];

    //Validaciones básicas
    if($nombre=="" || $correo=="" || $contrasena=="" || $contrasena2==""){
        $respuesta=[
            "exito"=>false,
            "error"=>"campos_vacios",
            "mensaje"=>"Todos los campos son obligatorios"
        ];
    }else if($contrasena!=$contrasena2){
        $respuesta=[
            "exito"=>false,
            "error"=>"contrasenas_no_coinciden",
            "mensaje"=>"Las contraseñas no coinciden"
        ];
    }else if(strlen($contrasena)<8){
        $respuesta=[
            "exito"=>false,
            "error"=>"contrasena_corta",
            "mensaje"=>"La contraseña debe tener al menos 8 caracteres"
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
                "error"=>"email_existe",
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