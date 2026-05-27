<?php 
include_once("cabecera.php");

if (!isset($_SESSION['usuario_id'])) {
    header("location: login.php");
    exit;
}

$id_ticket = $_GET["id"];
$ticket = $db->obtenerTicket($id_ticket);

// Que el usuario solo pueda ver sus propios tickets
if (!$ticket || $ticket['id_usuario'] != $_SESSION['usuario_id']) {
    header("location: soporte.php");
    exit;
}
?>

<script>
  cargarMensajesTicket(<?=$id_ticket?>);
      document.addEventListener("DOMContentLoaded", function () {
      document.getElementById("mensaje").addEventListener("keydown", function (e) {
        if (e.key === "Enter" && !e.shiftKey) {
          e.preventDefault();
          enviarMensajeTicket(<?=$id_ticket?>);
        }
      });
  });
</script>

<div class="container py-4">

  <a href="soporte.php" class="backDetalle mb-4 d-inline-block">
    ← Volver a mis tickets
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

  <!-- Solo puede responder si el ticket está abierto -->
  <?php if ($ticket['estado'] === 'abierto'): ?>
  <div class="card game-card forum-response-box mb-4">
    <div class="card-body">

      <h4 class="mb-4">Escribir mensaje</h4>

      <textarea id="mensaje" class="form-control forum-textarea mb-4" rows="5"
        placeholder="Describe tu problema con detalle..."></textarea>

      <div id="errorMensaje" class="error-mensaje">
        El mensaje no puede estar vacío
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
      Este ticket está cerrado. Si necesitas más ayuda abre uno nuevo.
    </div>
  <?php endif; ?>

  <div class="forum-messages"></div>

</div>

<?php include_once("pie.php"); ?>