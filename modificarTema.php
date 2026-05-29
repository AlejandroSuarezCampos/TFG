<?php
include_once("cabecera.php");

$modificar = isset($_GET["modificar"]) ? intval($_GET["modificar"]) : 0;

if (empty($modificar)) {
  header("Location: foro.php");
  exit();
}

$tema=$db->BuscarTemaModificar($modificar);

?>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">

      <div class="card game-card border-0 shadow-lg">
        <div class="card-body p-5">

          <div class="text-center mb-4">
            <h2 class="fw-bold">Editar Tema</h2>
          </div>

          <div class="mb-3">
            <label for="titulo" class="form-label forum-label">Título nuevo del tema</label>
            <input type="text" class="form-control" id="titulo" value="<?=$tema["titulo"]?>" placeholder="<?=$tema["titulo"]?>">
          </div>

          <button type="button" class="btn btn-steam w-100 py-2 mb-3"
            onclick="Modificartema(<?= $modificar ?>)">
            Editar
          </button>

          <div class="alert error-message mt-4 oculto" id="errorCampos"></div>

        </div>
      </div>

    </div>
  </div>
</div>

<?php include_once("pie.php"); ?>