<?php 

    include_once("cabecera.php"); 

    if(!isset($_SESSION['usuario_id'])){
        header("location: index.php");
    }

?>
<div class="container-fluid p-0">

  <!-- BANNER -->
  <section class="profile-banner d-flex align-items-end p-4">
    <div class="d-flex align-items-center">
      <img src="img/avatar_default.jpg" class="avatar-xl me-4">
      <div>
        <h2 class="fw-bold mb-1"><?=$_SESSION['usuario_nombre']?></h2>
        <span class="status online">● En línea</span>
      </div>
    </div>
  </section>

  <div class="container-fluid">
    <div class="row">

      <!-- SIDEBAR -->
      <aside class="col-md-3 p-4 sidebar">

        <div class="profile-card text-center p-3 mb-4">
          <h5>Nivel 12</h5>
          <div class="progress mt-2">
            <div class="progress-bar" style="width: 60%"></div>
          </div>
        </div>

        <ul class="nav flex-column profile-menu">
          <li><a href="#" class="nav-link active">Perfil</a></li>
          <li><a href="#" class="nav-link">Biblioteca</a></li>
          <li><a href="#" class="nav-link">Historial</a></li>
          <li><a href="#" class="nav-link">Amigos</a></li>
        </ul>

      </aside>

      <!-- CONTENIDO -->
      <main class="col-md-9 p-4">

        <!-- ESTADÍSTICAS -->
        <section class="mb-5">
          <div class="row g-4">
            <div class="col-md-4">
              <div class="stat-card">
                <h3>25</h3>
                <p>Juegos</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="stat-card">
                <h3>120h</h3>
                <p>Horas jugadas</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="stat-card">
                <h3>8</h3>
                <p>Amigos</p>
              </div>
            </div>
          </div>
        </section>

        <!-- ACTIVIDAD -->
        <section class="mb-5">
          <h4 class="mb-3">Actividad reciente</h4>
          <div class="activity-card p-3">
            <p><strong>NombreUsuario</strong> jugó a <span class="text-info">CyberGame</span> hace 2 horas</p>
          </div>
        </section>

        <!-- BIBLIOTECA -->
        <section>
          <h4 class="mb-4">Biblioteca</h4>
          <div class="row g-4">

            <?php for($i=0; $i<6; $i++){ ?>
            <div class="col-md-4">
              <div class="game-card h-100">
                <div class="game-img">
                  <img src="img/juego_demo.jpg">
                  <div class="overlay">
                    <button class="btn btn-steam btn-sm">Jugar</button>
                  </div>
                </div>
                <div class="p-3">
                  <h6>Juego Demo</h6>
                </div>
              </div>
            </div>
            <?php } ?>

          </div>
        </section>

      </main>
    </div>
  </div>
</div>

<?php include_once("pie.php"); ?>