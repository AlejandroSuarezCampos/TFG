<?php 
include_once("cabezera.php");

$id_tema = $_GET["id"];

$tema = $db->obtenerTema($id_tema);
?>

<div class="container py-4">

  <div class="forum-header">

    <?php if($tema): ?>

      <h1><?= $tema["titulo"] ?></h1>

      <div class="d-flex gap-3 text-secondary small flex-wrap">
        <span>Publicado por <?= $tema["nombre"] ?></span>
      </div>

    <?php else: ?>

      <h1>Tema no encontrado</h1>

    <?php endif; ?>

  </div>

  <div class="card game-card forum-response-box">
    <div class="card-body">

      <h4 class="mb-4">Escribir respuesta</h4>

      <textarea id="mensaje" class="form-control forum-textarea mb-4" rows="6"></textarea>
      <div id="errorMensaje" class="error-mensaje">
        El mensaje no puede estar vacío
    </div>
      <div class="text-end">
        <button onclick="enviarMensaje(<?= $id_tema ?>)" class="btn btn-steam">
          Publicar respuesta
        </button>
      </div>

    </div>
  </div>

  <div class="forum-messages"></div>

</div>

<script>
  const ID_TEMA = <?= $id_tema ?>;
  cargarMensajes(ID_TEMA);
  document.addEventListener("DOMContentLoaded", function () {

    const textarea = document.getElementById("mensaje");

    textarea.addEventListener("keydown", function (e) {

        if (e.key === "Enter" && !e.shiftKey) {
            e.preventDefault();
            enviarMensaje(ID_TEMA);
        }

    });

});
</script>

<?php include_once("pie.php"); ?>