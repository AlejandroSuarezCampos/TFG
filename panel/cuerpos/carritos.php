<?php
include_once("PanelIndex.php");
$listaPedidos = $db->listarPedidos();
?>

<h2>Gestión de Pedidos</h2>
<table class="table">

  <tr>
    <th>Id Pedido</th>
    <th>Importe</th>
    <th>Id Usuario</th>
    <th>Email</th>
    <th>Recibos</th>
    <th>Items</th>
    <th>Estado</th>
    <th>Acciones/Información reembolso</th>
  </tr>
  <?php
  foreach ($listaPedidos as $pedido) {
    ?>
    <tr id="fila-<?= $pedido["id_pedido"] ?>">
      <td><?= $pedido["id_pedido"] ?></td>
      <td><?= $pedido["total"] ?>€</td>
      <td><?= $pedido["id_usuario"] ?></td>
      <td><?= $pedido["email"] ?></td>
      <td>
        <a href="../../facturas/<?= $pedido['fichero'] ?>" target="_blank"> 📄 Ver factura</a>
      </td>
      <td><?= $pedido["totales"] ?></td>
      <td><?= $pedido["estado"] ?></td>
      <td>
        <!--Si el pedido está pagado habilitamos la botonera de reembolso sino añadimos la info respecto al reembolso-->
        <?php
        if ($pedido["estado"] == 'pagado') {
          ?>
          <button class="btn btn-sm btn-warning" onclick="reembolsarPedido(<?= $pedido['id_pedido'] ?>)">
            Reembolsar
          </button>
          <?php
        } else {
          ?>
          A fecha '<i><?= $pedido["fecha_reembolso"] ?></i>' => <?= $pedido["motivo_reembolso"] ?>
          <?php
        }
        ?>
      </td>
      <?php
  }
  ?>
</table>

</main>
</div>
</body>

</html>