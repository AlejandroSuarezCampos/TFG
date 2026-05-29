<?php 
include_once("cabecera.php");

$id_ticket = $_GET["id"] ?? null;
$ticket = $db->obtenerTicket($id_ticket);

$es_propietario = $ticket['id_usuario'] == $_SESSION['usuario_id'];
$es_admin = $_SESSION["Rol"]== 1;

if (!$es_propietario && !$es_admin) {
    header("location: soporte.php");
    exit;
}
?>



<div class="container py-4">

  <a href="soporte.php" class="backDetalle mb-4 d-inline-block">
    <- Volver a mis tickets
  </a>

  <div class="forum-header mb-4">
    <div class="d-flex align-items-center gap-3 mb-2">
      <span class="badge <?= $ticket['estado'] === 'abierto' ? 'badge-abierto' : 'badge-resuelto' ?>">
        <?= ucfirst($ticket['estado']) ?>
      </span>
      <span class="text-secondary" style="font-size:12px;">#<?= $ticket['id_ticket'] ?></span>
    </div>

    <h1><?= htmlspecialchars($ticket['asunto']) ?></h1>

    <div class="d-flex gap-3 text-secondary small flex-wrap">
      <span>Abierto por <?= htmlspecialchars($ticket['nombre']) ?></span>
      <span>· <?= date('d M Y', strtotime($ticket['fecha'])) ?></span>
    </div>
  </div>


  <div class="forum-messages"></div>

  <?php if ($ticket['estado'] === 'abierto'): ?>
  <div class="settings-card forum-response-box">
    <div class="card-body">

      <h4 class="mb-4">Escribir mensaje</h4>

      <textarea id="mensaje" class="form-control forum-textarea mb-4" rows="5"
        placeholder="Describe tu problema con detalle..."></textarea>

      <div id="errorMensaje" class="error-mensaje">
        El mensaje no puede estar vacio
      </div>

      <div class="text-end">
        <button onclick="enviarMensajeTicket(<?= $id_ticket ?>)" class="btn btn-steam">
          Enviar mensaje
        </button>
      </div>

    </div>
  </div>
  <?php else: ?>
    <div class="exito-message mb-4">
      Este ticket esta cerrado. Si necesitas mas ayuda abre uno nuevo.
    </div>
  <?php endif; ?>
</div>
<script>
  const ID_USUARIO_ACTUAL = <?= (int) $_SESSION['usuario_id'] ?>;

  document.addEventListener("DOMContentLoaded", function () {

    cargarMensajesTicket(<?= (int) $id_ticket ?>, ID_USUARIO_ACTUAL);

    setInterval(function() {
      cargarMensajesTicket(<?= (int) $id_ticket ?>, ID_USUARIO_ACTUAL);
    }, 5000);

    document.getElementById("mensaje").addEventListener("keydown", function (e) {
      if (e.key === "Enter" && !e.shiftKey) {
        e.preventDefault();
        enviarMensajeTicket(<?= (int) $id_ticket ?>);
      }
    });

  });
</script>

<?php include_once("pie.php"); ?>