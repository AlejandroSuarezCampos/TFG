
<div class="container-fluid">
  <div class="row">

    <!-- SIDEBAR -->
    <aside class="col-md-2 sidebar p-3 d-none d-md-block">
      <h6 class="text-uppercase text-secondary">Categorías</h6>
      <ul class="nav flex-column mb-4">
        <li class="nav-item"><a class="nav-link text-light" href="#">Acción</a></li>
        <li class="nav-item"><a class="nav-link text-light" href="#">Aventura</a></li>
        <li class="nav-item"><a class="nav-link text-light" href="#">RPG</a></li>
        <li class="nav-item"><a class="nav-link text-light" href="#">Estrategia</a></li>
        <li class="nav-item"><a class="nav-link text-light" href="#">Indie</a></li>
      </ul>

      <h6 class="text-uppercase text-secondary">Precio máximo</h6>
      <input type="range" class="form-range" min="1" max="10">
    </aside>

    <!-- CONTENIDO -->
    <main class="col-md-10 p-4">

      <!-- HERO -->
      <section class="mb-5">
        <h1 class="fw-bold">Alquila videojuegos digitales</h1>
        <p class="lead">Accede a tus juegos favoritos sin pagar el precio completo.</p>
        <a href="#catalogo" class="btn btn-steam btn-lg">Explorar catálogo</a>
      </section>

      <!-- DESTACADOS -->
      <section id="catalogo">
        <h3 class="mb-4">Destacados</h3>
        <div class="row g-4">

          <div class="col-md-4">
            <div class="card game-card h-100">
              <img src="./img/Juego_1.jpg" class="card-img-top">
              <div class="card-body">
                <h5 class="card-title"><?=$juego["titulo"]?></h5>
                <p>Alquiler 48h</p>
                <div class="d-flex justify-content-between">
                  <span class="price"><?=$juego["precio_alquiler"]?>€</span>
                  <button class="btn btn-steam btn-sm">Alquilar</button>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card game-card h-100">
              <img src="./img/Juego_2.jpg" class="card-img-top">
              <div class="card-body">
                <h5 class="card-title">Juego Ejemplo</h5>
                <p>Alquiler 72h</p>
                <div class="d-flex justify-content-between">
                  <span class="price">5,99 €</span>
                  <button class="btn btn-steam btn-sm">Alquilar</button>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card game-card h-100">
              <img src="./img/Juego_3.jpg" class="card-img-top">
              <div class="card-body">
                <h5 class="card-title">Juego Ejemplo</h5>
                <p>Alquiler 24h</p>
                <div class="d-flex justify-content-between">
                  <span class="price">1,99 €</span>
                  <button class="btn btn-steam btn-sm">Alquilar</button>
                </div>
              </div>
            </div>
          </div>

        </div>
      </section>

    </main>
  </div>
</div>

<?php
  require_once("pie.php");
?>
