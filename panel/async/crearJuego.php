<?php
    require_once("../db/conexion.php");

    $titulo=trim($_POST["titulo"]);
    $descripcion=trim($_POST["descripcion"]);
    $precio=$_POST["precio"];
    $imagen = $_FILES["imagen"];//Recogemos con FILES
    $ventas=$_POST["ventas"];
    $stock=$_POST["stock"];
    $respuesta=[];
    $tipoArchivo = mime_content_type($_FILES["imagen"]["tmp_name"]);//Se identifica el tipo de archivo
    //Validaciones básicas
    
    //Buscamos en el array que hemos personalizado con el formato de imagenes aceptadas
    if (!in_array($tipoArchivo, ["image/jpeg", "image/png", "image/gif", "image/webp","imagen/jpg"])) {
        $respuesta=[
            "exito" => false,
            "error"=> "no_imagen",
            "mensaje" => "Solo se permiten imágenes"
        ];
        echo json_encode($respuesta);
        exit();

    }
    list($ancho, $alto) = getimagesize($_FILES["imagen"]["tmp_name"]);
   //Predefinimos un tamaño de imagen
    if ($ancho != 600 || $alto != 900) {

        echo json_encode([
            "exito" => false,
            "error" => "dimensiones_invalidas",
            "mensaje" => "La imagen debe ser exactamente 600x900 px"
        ]);

        exit();
    }
    if ($_FILES["imagen"]["size"] > 2 * 1024 * 1024) {
    $respuesta=[
            "exito" => false,
            "error"=> "imagen_grande",
            "mensaje" => "Imagen muy grande"
        ];
    echo json_encode($respuesta);
    exit();

}
    if($titulo=="" || $descripcion=="" || $imagen=="" || $precio==0){
        $respuesta=[
            "exito"=>false,
            "error"=>"campos_vacios",
            "mensaje"=>"Todos los campos son obligatorios"
        ];
    }else{
        $existe=$db->comprobarJuegoExiste($titulo);
        if($existe){
            $respuesta=[
                "exito"=>false,
                "error"=>"Juego_existe",
                "mensaje"=>"El juego ya esta registrado"
            ];
        }else{
            //Ruta establecida y subimos la futo a la carpeta para después subirla a bbdd
            $DIR="c:\\xampp\\htdocs\\TFG\\";
            $nombreImagen=$_FILES["imagen"]["name"];
            $rutaDestino = $DIR."/img/" . $nombreImagen;
            move_uploaded_file($_FILES['imagen']['tmp_name'],$rutaDestino);
            $rutaBD = "img/" . $nombreImagen;
            $db->registrarJuego($titulo, $descripcion, $precio,$rutaBD, $ventas, $stock);
            $respuesta=[
                "exito"=>true,
                "mensaje"=>"Juego registrado correctamente"
            ];
        }
    }

    echo json_encode($respuesta);
?>