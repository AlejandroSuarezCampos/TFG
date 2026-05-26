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
    <th>Acciones</th>
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
      <td>
        <button class="btn btn-sm btn-danger"
         onclick="reembolsarPedido(<?= $pedido['id_pedido'] ?>)">Eliminar
        </button>
        <button class="btn btn-sm btn-warning" onclick="eliminarCategoria(<?= $categoria['id_categoria'] ?>)">Eliminar y
          reembolsar</button>
      </td>
      <?php
  }
  ?>
</table>

</main>
</div>
</body>

</html>