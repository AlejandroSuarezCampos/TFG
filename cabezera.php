<?php
  include_once("consultas.php");

  $db = new Tienda("localhost",3306,"tfg_videoclub","root","");

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Maqueta TFG</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="css.css" rel="stylesheet">
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="index.php">Steam Killer 🚬🗿</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto align-items-lg-center">

        <li class="nav-item">
          <a class="nav-link" href="buscador.php">Catalogo</a>
        </li>

        <!-- FOROS -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="foros.php" data-bs-toggle="dropdown">
            Foros
          </a>
          <ul class="dropdown-menu dropdown-menu-dark">
            <li><a class="dropdown-item" href="index.php">General</a></li>
            <li><a class="dropdown-item" href="juegos.php">Juegos</a></li>
            <li><a class="dropdown-item" href="soporte.php">Soporte</a></li>
          </ul>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="perfil.php">Perfil</a>
        </li>

        <li class="nav-item ms-lg-3">
          <a class="btn btn-steam btn-sm" href="login.php">Iniciar sesión</a>
        </li>

      </ul>
    </div>
  </div>
</nav>