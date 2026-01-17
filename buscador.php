<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <span>cana gay</span>
  <title>Buscador - Steam Killer</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./estilos/styles.css">
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="index.html">Steam Killer 🚬🗿</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto align-items-lg-center">
        <li class="nav-item"><a class="nav-link" href="index.html#catalogo">Tienda</a></li>
        <li class="nav-item"><a class="nav-link" href="buscador.html">Buscar</a></li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Foros</a>
          <ul class="dropdown-menu dropdown-menu-dark">
            <li><a class="dropdown-item" href="#">General</a></li>
            <li><a class="dropdown-item" href="#">Juegos</a></li>
            <li><a class="dropdown-item" href="#">Soporte</a></li>
          </ul>
        </li>
        <li class="nav-item"><a class="nav-link" href="#perfil">Perfil</a></li>
        <li class="nav-item ms-lg-3"><a class="btn btn-steam btn-sm" href="#">Iniciar sesión</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container-fluid">
  <div class="row">

    <!-- SIDEBAR (copiada de index.html) -->
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
        <div class="col-md-4">
          <a href="producto.html" class="text-decoration-none">
            <div class="card game-card h-100">
              <img src="./img/Juego_1.jpg" class="card-img-top">
              <div class="card-body">
                <h5 class="card-title">Juego Ejemplo 1</h5>
                <p>Alquiler 48h</p>
                <div class="d-flex justify-content-between">
                  <span class="price">3,99 €</span>
                  <button class="btn btn-steam btn-sm" disabled>Alquilar</button>
                </div>
              </div>
            </div>
          </a>
        </div>

        <div class="col-md-4">
          <a href="producto.html" class="text-decoration-none">
            <div class="card game-card h-100">
              <img src="./img/Juego_2.jpg" class="card-img-top">
              <div class="card-body">
                <h5 class="card-title">Juego Ejemplo 2</h5>
                <p>Alquiler 72h</p>
                <div class="d-flex justify-content-between">
                  <span class="price">5,99 €</span>
                  <button class="btn btn-steam btn-sm" disabled>Alquilar</button>
                </div>
              </div>
            </div>
          </a>
        </div>

        <div class="col-md-4">
          <a href="producto.html" class="text-decoration-none">
            <div class="card game-card h-100">
              <img src="./img/Juego_3.jpg" class="card-img-top">
              <div class="card-body">
                <h5 class="card-title">Juego Ejemplo 3</h5>
                <p>Alquiler 24h</p>
                <div class="d-flex justify-content-between">
                  <span class="price">1,99 €</span>
                  <button class="btn btn-steam btn-sm" disabled>Alquilar</button>
                </div>
              </div>
            </div>
          </a>
        </div>

      </div>
    </main>

  </div>
</div>

<footer class="text-center text-secondary py-3 mt-4">
  <small>© 2026 GameRent · Proyecto académico - Cana LadyBoy</small>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>