<?php 
include_once("cabecera.php");

if (!isset($_SESSION['usuario_id'])) {
    header("location: login.php");
    exit;
}

$tickets = $db->listarTicketsUsuario($_SESSION['usuario_id']);
?>

<div class="container py-4 flex-grow-1">

  <!-- CABECERA -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h1 class="mb-1">Mis Tickets</h1>
      <p class="text-secondary mb-0" style="font-size:13px;">
        Gestiona tus solicitudes de soporte
      </p>
    </div>
    <a href="crearTicket.php" class="btn btn-steam">
      <i class="bi bi-plus-lg me-1"></i> Nuevo Ticket
    </a>
  </div>

  <!-- LISTA DE TICKETS -->
  <div class="d-flex flex-column gap-3">

    <?php if (empty($tickets)): ?>

      <div class="card game-card p-5 text-center">
        <i class="bi bi-ticket-perforated" style="font-size:3rem; color:#66c0f4; opacity:.5;"></i>
        <p class="text-secondary mt-3 mb-3">No tienes ningún ticket abierto.</p>
        <a href="crearTicket.php" class="btn btn-steam mx-auto" style="width:fit-content;">
          Crear mi primer ticket
        </a>
      </div>

    <?php else: ?>

      <?php foreach ($tickets as $ticket): ?>

        <a href="verTicket.php?id=<?= $ticket['id_ticket'] ?>" style="text-decoration:none;">
          <div class="card game-card forum-post" style="transition: transform .2s, border-color .2s; border: 1px solid transparent;">

            <div class="card-body">
              <div class="row align-items-center gy-2">

                <!-- ICONO ESTADO -->
                <div class="col-auto">
                  <div class="ticket-icon <?= $ticket['estado'] === 'abierto' ? 'abierto' : 'resuelto' ?>">
                    <i class="bi <?= $ticket['estado'] === 'abierto' ? 'bi-envelope-open' : 'bi-check-circle' ?>"></i>
                  </div>
                </div>

                <!-- INFO -->
                <div class="col">
                  <div class="d-flex align-items-center gap-2 mb-1">
                    <span class="badge-estado <?= $ticket['estado'] === 'abierto' ? 'badge-abierto' : 'badge-resuelto' ?>">
                      <?= ucfirst($ticket['estado']) ?>
                    </span>
                    <span style="font-size:11px; color:#7193a8;">
                      #<?= str_pad($ticket['id_ticket'], 5, '0', STR_PAD_LEFT) ?>
                    </span>
                  </div>
                  <div class="ticket-title"><?= htmlspecialchars($ticket['asunto']) ?></div>
                  <div class="ticket-fecha mt-1">
                    Abierto el <?= date('d M Y · H:i', strtotime($ticket['fecha'])) ?>
                  </div>
                </div>

                <!-- FLECHA -->
                <div class="col-auto">
                  <i class="bi bi-chevron-right" style="color:#66c0f4; font-size:18px;"></i>
                </div>

              </div>
            </div>

          </div>
        </a>

      <?php endforeach; ?>

    <?php endif; ?>

  </div>

</div>

<?php include_once("pie.php"); ?>