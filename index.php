<?php
include_once("cabezera.php");

$listaProductosVendidos=$db->listarProductosVendidos();



?>
<div class="container-fluid">
  <div class="row">
    <!-- CONTENIDO -->
    <main class="col-md-10 p-4">
      <!-- HERO -->
      <section class="mb-5">
        <h1 class="fw-bold">Alquila videojuegos digitales</h1>
        <p class="lead">Accede a tus juegos favoritos sin pagar el precio completo.</p>
        <a href="buscador.php" class="btn btn-steam btn-lg">Explorar catálogo</a>
      </section>
      <!-- DESTACADOS -->
      <section id="catalogo">
        <h3 class="mb-4">Destacados</h3>
        <div class="row g-4">
          <?php
            foreach($listaProductosVendidos as $producto){
          ?>
          <div class="col-md-4">
            <a href="producto.php?id=<?=$producto["id_juego"]?>" class="text-decoration-none">
              <div class="card game-card h-100">
                <img src="<?=$producto["imagen"]?>" class="card-img-top">
                <div class="card-body">
                  <h5 class="card-title"><?= $producto["titulo"]?></h5>
                  <div class="d-flex justify-content-between">
                    <span class="price"><?=$producto["precio_alquiler"]?></span>
                    <button href="carrito.php" class="btn btn-steam btn-sm">Añadir al carrito</button>
                  </div>
                </div>
              </div>
            </a>
          </div>
            <?php
            } 
            ?>
        </div>
      </section>
    </main>
  </div>
</div>

<?php
  include_once("pie.php");
?>