<?php 
  include_once("cabecera.php");
  
  $categorias = $db->listarCategorias();
  $juegos     = $db->listarProductos();
?>

<div class="container-fluid">
  <div class="row">

    <!-- SIDEBAR -->
    <aside class="col-md-2 sidebar p-3 d-none d-md-block">

      <h6 class="text-uppercase text-secondary mb-2">Categorías</h6>
      <select class="modern-select mb-4" id="filtroCat" onchange="filtrar()">
        <option value="">Todas las categorías</option>
        <?php foreach ($categorias as $categoria): ?>
        <option value="<?= $categoria['id_categoria'] ?>">
          <?= htmlspecialchars($categoria['nombre']) ?>
        </option>
        <?php endforeach; ?>
      </select>

      <h6 class="text-uppercase text-secondary mb-2">Precio máximo</h6>
      <select class="modern-select mb-1" id="filtroPrecio" onchange="filtrar()">
        <option value="">Sin límite</option>
        <option value="1">Hasta 1 €/h</option>
        <option value="2">Hasta 2 €/h</option>
        <option value="3">Hasta 3 €/h</option>
        <option value="5">Hasta 5 €/h</option>
        <option value="10">Hasta 10 €/h</option>
      </select>
      <small class="text-secondary" id="precioLabel"></small>

    </aside>

    <!-- CONTENIDO -->
    <main class="col-md-10 p-4">
      <h1 class="mb-4">Resultados de búsqueda</h1>

      <!-- BARRA DE BÚSQUEDA -->
      <div class="mb-4">
        <div class="input-group">
          <input type="text" class="form-control modern-input" placeholder="Buscar juegos..."
                 id="buscador" oninput="filtrar()">
          <button class="btn btn-steam" onclick="filtrar()">Buscar</button>
        </div>
      </div>

      <!-- GRID DE RESULTADOS -->
      <div class="row g-4" id="visorJuegos">
        <?php foreach ($juegos as $juego): ?>
        <div class="col-md-3 col-lg-2">
          <a href="producto.php?id=<?= $juego['id_juego'] ?>" class="text-decoration-none">
            <div class="card game-card h-100">
              <img src="<?= htmlspecialchars($juego['imagen']) ?>" class="card-img-top">
              <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($juego['titulo']) ?></h5>
                <p>Alquiler 1h</p>
                <div class="d-flex justify-content-between">
                  <span class="price"><?= $juego['precio_alquiler'] ?> €</span>
                  <button class="btn btn-steam btn-sm" disabled>Alquilar</button>
                </div>
              </div>
            </div>
          </a>
        </div>
        <?php endforeach; ?>
      </div>

      <!-- SIN RESULTADOS -->
      <div id="sinResultados" class="oculto text-center py-5">
        <p class="text-secondary fs-5">No se encontraron juegos con ese filtro.</p>
      </div>

    </main>
  </div>
</div>

<?php include_once("pie.php"); ?>