<?php
require_once("../db/conexion.php");

$texto     = trim($_GET["texto"]     ?? "");
$categoria = trim($_GET["categoria"] ?? "");
$precio    = trim($_GET["precio"]    ?? "");

$juegos = $db->filtrarJuegos($texto, $categoria, $precio);

foreach ($juegos as $juego) {
    echo "
    <div class='col-md-3 col-lg-2'>
        <a href='producto.php?id={$juego['id_juego']}' class='text-decoration-none'>
            <div class='card game-card h-100'>
                <img src='{$juego['imagen']}' class='card-img-top'>
                <div class='card-body'>
                    <h5 class='card-title'>{$juego['titulo']}</h5>
                    <p>Alquiler 1h</p>
                    <div class='d-flex justify-content-between'>
                        <span class='price'>{$juego['precio_alquiler']} €</span>
                        <button class='btn btn-steam btn-sm' disabled>Alquilar</button>
                    </div>
                </div>
            </div>
        </a>
    </div>
    ";
}
?>