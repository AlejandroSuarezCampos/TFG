<?php
session_start();
include_once("../db/conexion.php");
include_once("../db/consultas.php");

if(isset($_POST["valor"])){
if (!isset($_SESSION["carrito"])) {
  $carrito = [];
} else {
  $carrito = $_SESSION["carrito"];
}

$juegos_carrito = $db->listarjuegoscarrito($carrito);
echo '<h2 class="mb-4 text-white">Tu carrito</h2>';

if(empty($juegos_carrito)){
    echo '<p class="text-white">El carrito está vacío</p>';
}
foreach($juegos_carrito as $juego){
    echo '<div class="carrito-item d-flex align-items-center mb-3 p-3 text-white">

            <!-- Imagen -->
            <img src="' . $juego["imagen"] . '" width="120" class="me-3">

            <!-- Info -->
            <div class="flex-grow-1">

                <h5>' . $juego["titulo"] . '</h5>

                <!-- HORAS -->
                <label>Horas:</label>
                <input type="number" 
                       value="' . $juego["horas"] . '" 
                       min="1"
                       class="horas-input"
                       data-id="' . $juego["id_juego"] . '">

                <p>Precio/hora: ' . $juego["precio_alquiler"] . '€</p>

                <p>Total: 
                    <span id="total-' . $juego["id_juego"] . '">
                        ' . ($juego["precio_alquiler"] * $juego["horas"]) . '
                    </span> €
                </p>
            </div>

            <!-- Acciones -->
            <div>
                <button onclick="eliminarCarrito(' . $juego['id_juego'] . ')" 
                        class="btn btn-danger btn-sm">
                    Eliminar
                </button>
            </div>

        </div>';
}

echo '<h3 class="text-white mt-4">
        Total carrito: <span id="total-carrito-precio">0</span> €
      </h3>';
}else{
        echo "Error al cargar los productos";
}
?>