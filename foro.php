<?php 
include_once("cabecera.php");

$posts = $db->listarTemas();
?>

<div class="container py-4">

  <!-- CABECERA -->
  <div class="d-flex justify-content-between align-items-center mb-4">

    <div>
      <h1 class="mb-0">Foros</h1>
      <small class="text-secondary">
        Discute sobre juegos y soporte
      </small>
    </div>

    <a href="crearTemaForo.php" class="btn btn-steam">
      + Nuevo tema
    </a>
    <a href="crearForo.php" class="btn btn-steam">
      + Nuevo Foro
    </a>
  </div>

  <div class="forum-container">

    <?php foreach($posts as $post){ ?>

      <div class="card game-card forum-post">
        <div class="card-body">

          <div class="row align-items-center gy-3">

            <div class="col-md-6">
              <h5 class="mb-1">
                <a href="mensajes_foro.php?id=<?= $post["id_tema"] ?>" class="text-white text-decoration-none">
                  <?= $post["titulo"] ?>
                </a>
              </h5>

              <small class="text-secondary">
                Tema #<?= $post["id_tema"] ?>
              </small>
            </div>

            <div class="col-md-3 text-md-center">
              <span class="badge bg-primary">
                Foro <?= $post["id_foro"] ?>
              </span>
            </div>

            <div class="col-md-3 text-md-center text-secondary">
              <?= $post["fecha_creacion"] ?>
            </div>

          </div>

        </div>
      </div>

    <?php } ?>

  </div>

</div>

<?php include_once("pie.php"); ?>