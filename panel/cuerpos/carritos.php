<?php
  include_once("PanelIndex.php");

 


 $listaPedidos=$db->listarPedidos();
?>

<h2>Gestión de Pedidos</h2>
<table class="table">
  
<tr><th>ID</th><th>Nombre</th><th>Juego</th><th>Duración</th><th>Precio</th><th>Acciones</th></tr>
<?php
    foreach($listaPedidos as $pedido){
  ?>
    <tr id="fila-<?= $pedido["id_pedido"] ?>">
      <td><?= $pedido["id_pedido"] ?></td><td><?= $pedido["id_item"] ?></td><td><?= $pedido["id_juego"] ?></td><td><?= $pedido["duracion"] ?></td><td><?= $pedido["precio"] ?>€</td>
    <td>
      <button class="btn btn-sm btn-danger" onclick="eliminarCategoria(<?= $categoria['id_categoria'] ?>)">Eliminar</button>
    </td>
  <?php
    }
  ?>
</table>

</main>
</div>
</body>
</html>
