<?php

require_once("../db/conexion.php");

$id=$_GET["id"];

$juegos=$db->listarProductosFiltradosCategoria($id);


foreach($juegos as $juego){

    echo"<div class='col-md-3 col-lg-2'>";
    echo    "<a href='producto.php?id='.".$juego['id_juego'].".' class='text-decoration-none'>";
    echo    "<div class='card game-card h-100'>";
    echo        "<img src='".$juego['imagen']."' class='card-img-top'>";
    echo          "<div class='card-body'>";
    echo             "<h5 class='card-title'>".$juego['titulo']."</h5>";
    echo             "<p>Alquiler 48h</p>";
    echo             "<div class='d-flex justify-content-between'>";
    echo               "<span class='price'>".$juego['precio_alquiler']." €</span>";
    echo               "<button class='btn btn-steam btn-sm' disabled>Alquilar</button>";
    echo             "</div>";
    echo           "</div>";
    echo         "</div>";
    echo       "</a>";
    echo     "</div>";
}


?>