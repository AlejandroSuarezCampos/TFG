<?php
include_once("cabecera.php");
include_once("./db/consultas.php");

$recomendados = $db->obtenerJuegosRecomendados($_SESSION['carrito']);
?>

<main class="container-fluid px-4 flex-grow-1">

  <main class="caja_carrito">

    <section id="carrito" class="carrito">
     
    </section>

  </main>
</main>
  

<?php include_once("pie.php"); ?>