<?php
  include_once("PanelIndex.php");

  $listarJuegos=$db->listarJuegosPanel();
?>

<h2>Gestión de Juegos</h2>
<a href="../crear/crear_juegos.php"><button class="btn btn-primary mb-3">Nuevo Juego</button></a>
<table class="table table-hover">
<thead>
<tr><th>ID</th><th>Nombre</th><th>Imagen</th><th>Categorías</th><th>Precio</th><th>Stock</th><th>Ventas</th><th>Acciones</th></tr>
</thead>
<tbody>

<?php
    foreach($listarJuegos as $juego){
      $categorias=$db->listarProductosFiltradosCategoria($juego["id_juego"]);
  ?>
    <tr id="fila-<?= $juego["id_juego"] ?>">
    <td><?=$juego["id_juego"]?></td><td><?=$juego["titulo"]?></td><td><img  width="120" src=../../<?=$juego["imagen"]?>></td><td><?php foreach($categorias as $cate){echo $cate["NOMBRE"]."<br>";}?></td><td><?=$juego["precio_alquiler"]?></td><td><?=$juego["stock"]?></td><td><?=$juego["ventas"]?></td>
    <td>
    <a href="../editar/editar_juego.php?id=<?= $juego["id_juego"] ?>"><button class="btn btn-sm btn-warning">Editar</button></a>
     <button class="btn btn-sm btn-danger" onclick="EliminarJuego(<?=$juego['id_juego']?>)">Eliminar</button></td>
    </tr>
<?php
    }
?>
</tbody>
</table>

</main>
</div>
</body>
</html>
