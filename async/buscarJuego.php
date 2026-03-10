<?php
    require_once("../db/conexion.php");

    $texto=$_GET["texto"];

    $sentencia = $db->buscarJuego($texto);

    foreach($sentencia as $senten){
        echo"<div class='col-md-3 col-lg-2'>";
        echo    "<a href='producto.php?id='.".$senten['id_juego'].".' class='text-decoration-none'>";
        echo    "<div class='card game-card h-100'>";
        echo        "<img src='".$senten['imagen']."' class='card-img-top'>";
        echo          "<div class='card-body'>";
        echo             "<h5 class='card-title'>".$senten['titulo']."</h5>";
        echo             "<p>Alquiler 48h</p>";
        echo             "<div class='d-flex justify-content-between'>";
        echo               "<span class='price'>".$senten['precio_alquiler']." €</span>";
        echo               "<button class='btn btn-steam btn-sm' disabled>Alquilar</button>";
        echo             "</div>";
        echo           "</div>";
        echo         "</div>";
        echo       "</a>";
        echo     "</div>";
    }
?>