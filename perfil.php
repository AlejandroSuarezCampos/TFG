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
        ["nombre" => "Primer partida", "img" => "https://www.laps4.com/foro/trofeos/psntrofeos/220627_tm.PNG", "completado" => true],
        ["nombre" => "100 horas jugadas", "img" => "https://i.psnprofiles.com/games/ec070c/trophies/1Se5d667.png", "completado" => false],
        ["nombre" => "Completa el juego", "img" => "https://www.laps4.com/foro/trofeos/psntrofeos/109743_tm.PNG", "completado" => true],
        ["nombre" => "Explorador", "img" => "https://i.psnprofiles.com/games/472bfe/trophies/1Sd95001.png", "completado" => false],
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