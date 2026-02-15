<?php 
            include_once("cabezera.php");
            
            $categorias=$db->listarCategorias();

            $juegos=$db->listarProductos();
?>
<div class="container-fluid">
  <div class="row">
    <aside class="col-md-2 sidebar p-3 d-none d-md-block">
      <h6 class="text-uppercase text-secondary">Categorías</h6>
      <ul class="nav flex-column mb-4">
        <?php
          foreach($categorias as $categoria){
        ?>
        <li class="nav-item"><a class="nav-link text-light" href="#"><?=$categoria["nombre"]?></a></li>
        <?php
          }
        ?>
      </ul>
      <h6 class="text-uppercase text-secondary">Precio máximo</h6>
      <input type="range" class="form-range" min="1" max="10">
    </aside>

    <!-- CONTENIDO DEL BUSCADOR -->
    <main class="col-md-10 p-4">
      <h1 class="mb-4">Resultados de búsqueda</h1>

      <!-- BARRA DE BÚSQUEDA -->
      <form class="mb-4">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Buscar juegos...">
          <button class="btn btn-steam" type="submit">Buscar</button>
        </div>
      </form>

      <!-- GRID DE RESULTADOS -->
        <div class="row g-4">
          <?php
            foreach($juegos as $juego){
          ?>
          <div class="col-md-3 col-lg-2">
            <a href="producto.php?id=<?=$juego["id_juego"]?>" class="text-decoration-none">
              <div class="card game-card h-100">
                <img src="<?=$juego["imagen"]?>" class="card-img-top">
                <div class="card-body">
                  <h5 class="card-title"><?=$juego["titulo"]?></h5>
                  <p>Alquiler 48h</p>
                  <div class="d-flex justify-content-between">
                    <span class="price"><?=$juego["precio_alquiler"]?> €</span>
                    <button class="btn btn-steam btn-sm" disabled>Alquilar</button>
                  </div>
                </div>
              </div>
            </a>
          </div>
          <?php
              }
          ?>
        </div>
    </main>

  </div>
</div>

<?php
  include_once("pie.php");
?>