<?php
include_once("PanelIndex.php");

if (isset($_GET["cerrar"])) {
    $db->cerrarTicket($_GET["cerrar"]);
}

$listaTickets = $db->listarTickets();
?>

<h2>Gestión de Tickets</h2>
<table class="table">

  <tr>
    <th>ID</th>
    <th>Usuario</th>
    <th>Asunto</th>
    <th>Estado</th>
    <th>Fecha</th>
    <th>Acciones</th>
  </tr>

  <?php foreach ($listaTickets as $ticket): ?>
    <tr id="fila-<?= $ticket["id_ticket"] ?>">
      <td><?= $ticket["id_ticket"] ?></td>
      <td><?= htmlspecialchars($ticket["nombre"]) ?></td>
      <td><?= htmlspecialchars($ticket["asunto"]) ?></td>
      <td>
        <span class="badge <?= $ticket['estado'] === 'abierto' ? 'badge-abierto' : 'badge-resuelto' ?>">
          <?= ucfirst($ticket["estado"]) ?>
        </span>
      </td>
      <td><?= date('d M Y', strtotime($ticket["fecha"])) ?></td>
      <td>
        <a href="../../verTicket.php?id=<?= $ticket["id_ticket"] ?>">
            <button class="btn btn-sm btn-primary">Consultar</button>
        </a>
        <?php if ($ticket["estado"] === "abierto"): ?>
            <button class="btn btn-sm btn-danger" onclick="cerrarTicket(<?= $ticket['id_ticket'] ?>)">
                Cerrar
            </button>
        <?php else: ?>
          <button class="btn btn-sm btn-secondary" disabled>Cerrado</button>
        <?php endif; ?>
      </td>
    </tr>
  <?php endforeach; ?>

</table>

</main>
</div>
</body>
</html>