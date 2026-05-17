<?php
include_once("cabecera.php");

$listaProductosVendidos=$db->listarProductosVendidos();



?>
<div class="container-fluid">
  <div class="row">

    <!-- CONTENIDO -->
    <main class="col-12 p-4">

      <!-- HERO -->
      <section class="mb-5">
        <h1 class="fw-bold">Alquila videojuegos digitales</h1>
        <p class="lead">Accede a tus juegos favoritos sin pagar el precio completo.</p>
        <a href="buscador.php" class="btn btn-steam btn-lg">Explorar catálogo</a>
      </section>

      <!-- DESTACADOS -->
      <section id="catalogo" class="container-fluid">
        <h3 class="mb-4">Destacados</h3>

        <div class="row g-4 justify-content-center">
          <?php foreach($listaProductosVendidos as $producto){ ?>
            
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex">
              
              <div class="card game-card w-100 h-100">
                <a href="producto.php?id=<?=$producto["id_juego"]?>" class="text-decoration-none">
                  <img src="<?=$producto["imagen"]?>" class="card-img-top">
                </a>

                <div class="card-body d-flex flex-column">
                  <h5 class="card-title"><?= $producto["titulo"]?></h5>

                  <div class="mt-auto">
                    <span class="price"><?=$producto["precio_alquiler"]?>€ / h</span>
                  </div>
                </div>
              </div>

            </div>

          <?php } ?>
        </div>

      </section>

    </main>
  </div>
</div>

<?php
  include_once("pie.php");
?>