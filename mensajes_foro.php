<?php 
include_once("cabecera.php");

$id_tema = $_GET["id"];
$tema = $db->obtenerTema($id_tema);
$es_admin = isset($_SESSION['Rol']) && $_SESSION['Rol']==1;

?>

<script>
  cargarMensajes(<?= $id_tema ?>, <?= $es_admin ? 'true' : 'false' ?>);
  setInterval(function() {
    cargarMensajes(<?= $id_tema ?>, <?= $es_admin ? 'true' : 'false' ?>);
  }, 20000);
  
    document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("mensaje").addEventListener("keydown", function (e) {
      if (e.key === "Enter" && !e.shiftKey) {
        e.preventDefault();
        enviarMensaje(<?= $id_tema ?>);
      }
    });
  });
</script>
<div class="container py-4">

  <div class="forum-header">

    <?php if($tema): ?>

      <div class="d-flex justify-content-between align-items-start mb-2">
    <h1><?= $tema["titulo"] ?></h1>

    <?php if (isset($_SESSION['usuario_id']) && $_SESSION['usuario_id'] == $tema['id_usuario']): ?>
        <div class="d-flex gap-2 ms-auto">
            <a href="./modificarTema.php?modificar=<?= $id_tema ?>" 
               class="btn btn-warning btn-sm">
                Modificar tema
            </a>
            <button onclick="eliminarTema(<?= $id_tema ?>)" class="btn btn-danger btn-sm">
                Eliminar tema
            </button>
        </div>
    <?php endif; ?>
</div>
      

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

<div class="forum-messages-list" data-tema="<?= $id_tema ?>"></div>
</div>

<?php include_once("pie.php"); ?>