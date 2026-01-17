<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Producto - Juego Ejemplo</title>
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

<div class="container my-5">
  <div class="row">
    <!-- IMAGEN DEL JUEGO -->
    <div class="col-md-6">
      <img src="./img/Juego_1.jpg" class="img-fluid rounded mb-4" alt="Juego Ejemplo">
    </div>

    <!-- DETALLES DEL JUEGO -->
    <div class="col-md-6">
      <h1 class="fw-bold">Juego Ejemplo</h1>
      <p class="text-secondary">Género: Acción / Aventura</p>
      <p class="lead">Disfruta de este increíble juego durante un tiempo limitado con nuestro sistema de alquiler digital. ¡Accede a todo el contenido y explora nuevas aventuras sin gastar de más!</p>

      <h3 class="price">3,99 € - Alquiler 48h</h3>
      <button class="btn btn-steam btn-lg mt-3">Alquilar ahora</button>

      <hr class="my-4">
      <h5>Requisitos mínimos</h5>
      <ul>
        <li>Sistema operativo: Windows 10</li>
        <li>Procesador: Intel i5 o equivalente</li>
        <li>Memoria: 8 GB RAM</li>
        <li>Gráficos: NVIDIA GTX 960 o equivalente</li>
        <li>Almacenamiento: 20 GB disponibles</li>
      </ul>

      <h5>Descripción detallada</h5>
      <p>Este juego ofrece una experiencia única combinando acción y aventura, con un mundo abierto lleno de misiones, enemigos y secretos por descubrir. Ideal para jugadores que buscan desafíos y entretenimiento de calidad.</p>
    </div>
  </div>
</div>

<footer class="text-center text-secondary py-3 mt-4">
  <small>© 2026 GameRent · Proyecto académico - Cana LadyBoy</small>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>