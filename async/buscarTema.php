<?php
require_once("../db/conexion.php");

$texto = trim($_GET["texto"] ?? "");

$temas = $db->buscarTema($texto);

foreach ($temas as $post) {
    echo "
    <div class='card game-card forum-post mb-3'>
        <div class='card-body'>
            <div class='row align-items-center gy-3'>

                <div class='col-md-6'>
                    <h5 class='mb-1'>
                        <a href='mensajes_foro.php?id={$post['id_tema']}'
                           class='text-white text-decoration-none'>
                            " . htmlspecialchars($post['titulo']) . "
                        </a>
                    </h5>
                    <small class='text-secondary'>Tema #{$post['id_tema']}</small>
                </div>

                <div class='col-md-3 text-md-center'>
                    <span class='badge bg-primary'>Foro {$post['id_foro']}</span>
                </div>

                <div class='col-md-3 text-md-center text-secondary'>
                    {$post['fecha_creacion']}
                </div>

            </div>
        </div>
    </div>
    ";
}
?>