<?php 
  include_once("./db/conexion.php");

  session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Steam Killer</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="./styles/css.css" rel="stylesheet">
  <script src="./js/async.js"></script>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="index.php">Steam Killer 🚬🗿</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <?php
      if (isset($_SESSION["Rol"])&& $_SESSION["Rol"]==1){
      ?>
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
            <li><a class="nav-link" href="panel/cuerpos/Panelindex.php">Panel De administrador</a></li>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="perfil.php">Perfil</a>
        </li>
      <?php
      }else{
    ?>
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
        <?php
        
      }
        
        ?>
        <?php
        if(isset($_SESSION["usuario_id"])){
        ?>
          <li class="nav-item ms-lg-3">
            <a class="btn btn-steam btn-sm" onclick="logOut()">Cerrar sesión</a>
          </li>
        <?php
        }else{
        ?>
        <li class="nav-item ms-lg-3">
          <a class="btn btn-steam btn-sm" href="login.php">Iniciar sesión</a>
        </li>
        <?php
        }
        ?>

      </ul>
    </div>
  </div>
</nav>