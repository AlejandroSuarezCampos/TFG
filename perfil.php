<?php 
include_once("cabecera.php"); 
if(!isset($_SESSION['usuario_id'])){
    header("location: index.php");
    exit;
}

$db->comprobarLogros($_SESSION['usuario_id']);

$juegos       = $db->listarAlquileresPorUsuario($_SESSION['usuario_id']);
$estadisticas = $db->totalEstadisticasUsuario($_SESSION['usuario_id']);
$logros       = $db->obtenerLogrosUsuario($_SESSION['usuario_id']);
?>

<div class="container-fluid p-0 flex-grow-1">

  <!-- =========================
       BANNER PERFIL
  ========================== -->
  <section class="profile-banner d-flex align-items-center justify-content-between p-4">

    <div class="d-flex align-items-center gap-3">

      <img src="<?=$_SESSION['foto']?>" class="avatar-circle" alt="avatar">

      <div>
        <h2 class="fw-bold mb-0 text-white">
          <?=$_SESSION['usuario_nombre']?>
        </h2>
                    
              <a class="btn-steam btn" href="mispedidos.php">
                Mis pedidos
              </a>
           
      </div>

    </div>

    <div class="d-flex gap-4">

      <div class="text-center">
        <div class="profile-stat-num"><?= $estadisticas['total_juegos'] ?></div>
        <div class="profile-stat-label">Juegos</div>
      </div>

      <div class="text-center">
        <div class="profile-stat-num"><?= $estadisticas['total_horas'] ?>h</div>
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

      <?php foreach($juegos as $juego): ?>

      <div class="col-6 col-md-4 col-lg-3 col-xl-2">
        <div class="library-card <?= $juego['estado'] === 'activo' ? '' : 'locked' ?>">
          <div class="game-img">
            <span class="library-badge">Biblioteca</span>
            <img src="<?=$juego['imagen']?>" alt="Juego">
          </div>
          <div class="card-body">
            <h6 class="title"><?=$juego['titulo']?></h6>
          </div>
        </div>
      </div>

      <?php endforeach; ?>

    </div>

    <!-- =========================
         LOGROS
    ========================== -->
    <h5 class="section-heading mt-5 mb-4">Logros</h5>

    <div class="row g-4">

      <?php foreach($logros as $logro): ?>

      <div class="col-6 col-md-3 col-lg-2">
        <div class="achievement-card <?= $logro['completado'] ? '' : 'locked' ?>">

          <div class="achievement-img">
            <img src="<?= $logro['foto'] ?>" alt="logro">
          </div>

          <div class="achievement-body">
            <span class="achievement-title"><?= $logro['nombre'] ?></span>
            <span class="achievement-status">
              <?= $logro['completado'] ? 'Desbloqueado' : 'Bloqueado' ?>
            </span>
          </div>

        </div>
      </div>

      <?php endforeach; ?>

    </div>

  </div>
</div>

<?php include_once("pie.php"); ?>