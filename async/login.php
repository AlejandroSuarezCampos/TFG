<?php
session_start();
require_once("../db/conexion.php");

$correo = trim($_GET["correo"]);
$contrasena = trim($_GET["contrasena"]);

$respuesta = [];

if ($correo == "" || $contrasena == "") {
    $respuesta = [
        "exito" => false,
        "error" => "campos_vacios",
        "mensaje" => "Todos los campos son obligatorios"
    ];
} else if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    $respuesta = [
        "exito" => false,
        "error" => "correo_invalido",
        "mensaje" => "El formato del correo no es válido"
    ];
} else {
    $usuario = $db->obtenerUsuarioPorEmail($correo);

    if (!$usuario) {
        $respuesta = [
            "exito" => false,
            "error" => "usuario_no_encontrado",
            "mensaje" => "No existe una cuenta con ese correo"
        ];
    } else if (!password_verify($contrasena, $usuario['password'])) {
        $respuesta = [
            "exito" => false,
            "error" => "credenciales_incorrectas",
            "mensaje" => "Contraseña incorrecta"
        ];
    } else {
        $_SESSION['usuario_id'] = $usuario['id_usuario'];
        $_SESSION['usuario_nombre'] = $usuario['nombre'];
        $_SESSION['usuario_email'] = $usuario['email'];
        $_SESSION['Rol'] = $usuario['id_rol'];
        $_SESSION['foto'] = $usuario['foto'];
      
        $carritoAnonimo = $_SESSION["carrito"];
        $carritoUsuario = $db->obtenerCarritoUsuario($_SESSION["usuario_id"]);
        foreach ($carritoAnonimo as $id => $qty) {

            if (isset($carritoUsuario[$id])) {
                $carritoUsuario[$id] += $qty;
            } else {
                $carritoUsuario[$id] = $qty;
            }
        }
        $db->guardarCarritoUsuario($_SESSION["usuario_id"], $carritoUsuario);
        $_SESSION["carrito"] = $carritoUsuario;
          $respuesta = [
            "exito" => true,
            "mensaje" => "Login correcto",
            "usuario" => [
                "id" => $usuario['id_usuario'],
                "nombre" => $usuario['nombre'],
                "email" => $usuario['email']
            ],
            "carrito"=>$_SESSION["carrito"],
        ];
    }

}

echo json_encode($respuesta);
?>