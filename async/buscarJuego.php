<?php
    require_once("../db/conexion.php");

    $texto=$_GET["texto"];

    $sentencia = $db->buscarJuego($texto);

    foreach($sentencia as $senten){
        echo `<div class='col-md-3 col-lg-2'>;
                    <a href='producto.php?id= . $senten['id_juego'] . ' class='text-decoration-none'>;        
                        <div class='card game-card h-100'>;
                            <img src='.$senten['imagen'].' class='card-img-top'>;
                            <div class='card-body'>;
                                <h5 class='card-title'>.$senten['titulo'].</h5>;
                                <p>Alquiler 48h</p>;
                                <div class='d-flex justify-content-between'>;
                                <span class='price'>.$senten['precio_alquiler']. €</span>;
                                <button class='btn btn-steam btn-sm' disabled>Alquilar</button>;
                                </div>;
                            </div>;
                        </div>;
                    </a>;
                </div> `;
    }
?>