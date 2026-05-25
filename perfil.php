<?php 
include_once("cabecera.php"); 

if(!isset($_SESSION['usuario_id'])){
    header("location: index.php");
    exit;
}
?>

<div class="container-fluid p-0">

  <!-- =========================
       BANNER PERFIL
  ========================== -->
  <section class="profile-banner d-flex align-items-center justify-content-between p-4">

    <div class="d-flex align-items-center gap-3">

      <img src=".<?=$_SESSION['foto']?>" class="avatar-circle" alt="avatar">

      <div>
        <h2 class="fw-bold mb-0 text-white">
          <?=$_SESSION['usuario_nombre']?>
        </h2>
        <small style="color:#8aa6bf;">Biblioteca personal</small>
      </div>

    </div>

    <div class="d-flex gap-4">

      <div class="text-center">
        <div class="profile-stat-num">25</div>
        <div class="profile-stat-label">Juegos</div>
      </div>

      <div class="text-center">
        <div class="profile-stat-num">120h</div>
        <div class="profile-stat-label">Jugadas</div>
      </div>

      <div>
        <a class="btn btn-steam" href="configuraciónPerfil.php">
          <i class="bi bi-gear-fill me-1"></i> Ajustes
        </a>
      </div>

    </div>

  </section>

  <!-- =========================
       BIBLIOTECA
  ========================== -->
  <div class="container py-4">

    <h5 class="section-heading mb-4">Mi biblioteca</h5>

    <div class="row g-4">

      <?php for($i=0; $i<6; $i++){ ?>

      <div class="col-6 col-md-4 col-lg-3 col-xl-2">

        <div class="library-card">

          <div class="game-img">
            <span class="library-badge">Biblioteca</span>
            <img src="./img/mambo.jpg" alt="Juego">
          </div>

          <div class="card-body">
            <h6 class="title">Juego Demo</h6>
          </div>

        </div>

      </div>

      <?php } ?>

    </div>

    <!-- =========================
         LOGROS
    ========================== -->
    <h5 class="section-heading mt-5 mb-4">Logros</h5>

    <div class="row g-4">

      <?php 
      // EJEMPLO DE DATOS (luego lo conectas a BD)
      $logros = [
        ["nombre" => "Primer partida", "img" => "https://imgs.search.brave.com/Kxvh3QOFB4KezcMGIa_L6jHfriTtpOaeSCYxU6sWng0/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9zdC5k/ZXBvc2l0cGhvdG9z/LmNvbS8xMTIxMzc2/LzQ2NDIvaS80NTAv/ZGVwb3NpdHBob3Rv/c180NjQyNDgxNS1z/dG9jay1waG90by1h/ZG9sZi1oaXRsZXIt/c2FsdXRpbmctaW4t/YmVybGluLmpwZw", "completado" => true],
        ["nombre" => "100 horas jugadas", "img" => "https://imgs.search.brave.com/qed_y654jqfzTy2bkw29sOQkQvpJs5QXEkf6f041AzI/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9tZWRp/YS5nZXR0eWltYWdl/cy5jb20vaWQvNTE0/ODgwNTc4L3Bob3Rv/LzktNi0zOS1nZW5l/cmFsLWZyYW5jaXNj/by1mcmFuY28tbGVh/ZGVyLW9mLXRoZS1m/YXNjaXN0LXRyb29w/cy1kdXJpbmctdGhl/LXNwYW5pc2gtY2l2/aWwtd2FyLWFuZC5q/cGc_cz02MTJ4NjEy/Jnc9MCZrPTIwJmM9/dlpHQ1AyUDF6dWtP/S3dZNjZDQjR4NEFL/cGxlSjdIZGZCQTJs/M0ZvaFNfND0", "completado" => false],
        ["nombre" => "Completa el juego", "img" => "https://imgs.search.brave.com/rwTsJApF84HQb4sE0aHs6S2bxDLEjjgwb62vWiur4O0/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly93d3cu/aW5mb2JhZS5jb20v/cmVzaXplci92Mi8y/VUNHV1lWWFBORko3/S09HWEwzMk1MR1RW/SS5qcGc_YXV0aD0y/ODYxZjE3NjY1MDM0/MjFiMzExYjRmM2Mw/NDlmMDI2MGVkNWY1/ZTMzMTZiMjQyMzgz/OTFiYzMxZmI2MmQ1/Yzk1JnNtYXJ0PXRy/dWUmd2lkdGg9MzUw/JmhlaWdodD00Njcm/cXVhbGl0eT04NQ", "completado" => true],
        ["nombre" => "Explorador", "img" => "https://imgs.search.brave.com/YTK2HSH_pZiLCOY0Fm8vTCR5SX6dqt79Vap5RIQPz3w/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9tZWRp/YS5nZXR0eWltYWdl/cy5jb20vaWQvNDcx/ODExNDQ2L2VzL2Zv/dG8vY3ViYXMtYW5k/LXZlbmV6dWVsYXMt/cHJlc2lkZW50cy1y/YXVsLWNhc3Ryby1h/bmQtbmljb2xhcy1t/YWR1cm8tcmVzcGVj/dGl2ZWx5LXBhcnRp/Y2lwYXRlLWluLXRo/ZS5qcGc_cz02MTJ4/NjEyJnc9MCZrPTIw/JmM9YlFxdEx1Qm9o/SF9kOXE2OVFWWGpT/TEZ3MjFEX0dxVFo2/TmhZRHBkUW9sYz0", "completado" => false],
      ];

      foreach($logros as $logro){ 
      ?>

      <div class="col-6 col-md-3 col-lg-2">

        <div class="achievement-card <?= $logro['completado'] ? '' : 'locked' ?>">

          <div class="achievement-img">
            <img src="<?= $logro['img'] ?>" alt="logro">
          </div>

          <div class="achievement-body">
            <span class="achievement-title"><?= $logro['nombre'] ?></span>

            <span class="achievement-status">
              <?= $logro['completado'] ? 'Desbloqueado' : 'Bloqueado' ?>
            </span>
          </div>

        </div>

      </div>

      <?php } ?>

    </div>

  </div>
</div>

<?php include_once("pie.php"); ?>