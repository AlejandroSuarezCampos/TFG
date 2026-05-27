<?php
session_start();
include_once("../db/conexion.php");
include_once("../db/consultas.php");

if (isset($_POST["valor"])) {
    if (!isset($_SESSION["usuario_id"])) {
        if (!isset($_SESSION["carrito"])) {
            $carrito = [];
        } else {
            $carrito = $_SESSION["carrito"];
        }
    } else {
        $carrito = $db->obtenerCarritoUsuario($_SESSION["usuario_id"]);
        $_SESSION["carrito"] = $carrito;
    }
    /*
    if(!isset($_SESSION["carrito"])) {
      $carrito = [];
    } else {
      $carrito = $_SESSION["carrito"];
    }*/

    $juegos_carrito = $db->listarjuegoscarrito($carrito);
    $response = '<h2 class="mb-4 text-white">Tu carrito</h2>';

    if (empty($juegos_carrito)) {
        echo json_encode([
            "html" => $response . '<p class="text-white">El carrito está vacío</p>'
        ]);

        exit;
    }
    foreach ($juegos_carrito as $juego) {
        $id = (int) $juego["id_juego"];
        $horas = (int) $juego["horas"];
        $precio = (float) $juego["precio_alquiler"];
        $total = $precio * $horas;

        $response .= "
        <div class='carrito-item d-flex flex-column flex-md-row align-items-start align-items-md-center mb-3 p-3 text-white'>
            <img src='{$juego["imagen"]}' width='120' class='me-md-3 mb-3 mb-md-0 carrito-img'>
            <div class='flex-grow-1'>
                <h5>{$juego["titulo"]}</h5>
                <div class='d-flex align-items-center gap-2'>
                <button class='btn btn-outline-light btn-menos' type='button' data-id='$id'> − </button>
                <input type='number' id='horascarro' class='horas-input'
                       value='$horas'
                       min='1'
                       data-id='$id'>
                <button class='btn btn-outline-light btn-mas' type='button' data-id='$id'> + </button>
                </div>
                <p>Precio/hora: $precio €</p>

                <p>Total: <span id='total-$id'>$total</span> €</p>
            </div>

            <button onclick='eliminarCarrito($id)' class='btn btn-danger btn-sm'>
                Eliminar
            </button>
        </div>";
    }
    $response .= '<h3 class="text-white mt-4"> 
                  Total carrito: <span id="total-carrito-precio">0</span> €
                </h3>';
    if (isset($_SESSION["usuario_id"])) {
        $response .= '
<div class="d-flex justify-content-center align-items-center mt-4 gap-3">

    <a class="btn btn-steam btn-outline-light" href="buscador.php">
        Seguir Comprando
    </a>

    <a id="pagar" class="btn btn-steam btn-primary px-4">
        Pagar
    </a>
</div>';
    } else {
        $response .= '
<div class="d-flex justify-content-center align-items-center mt-4 gap-3">

    <a class="btn btn-steam btn-outline-light" href="buscador.php">
        Seguir Comprando
    </a>

   <a href="login.php" class="btn btn-warning px-4">
        Inicia sesión para pagar
    </a>
</div>';
    }
}

echo json_encode([
    "html" => $response
]);
?>