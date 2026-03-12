<?php
  include_once("PanelIndex.php");

   if(isset($_GET["borrar"])){
      $db->eliminarCat($_GET["borrar"]);
	}


 $listaCategorias=$db->listarCategorias();
?>

<h2>Gestión de Categorías</h2>
<a href="crear_categoria.php"><button class="btn btn-primary mb-3">Nueva categoría</button></a>
<table class="table">
  
<tr><th>ID</th><th>Nombre</th><th>Acciones</th></tr>
<?php
    foreach($listaCategorias as $categoria){
  ?>
    <tr><td><?= $categoria["id_categoria"] ?></td><td><?= $categoria["nombre"] ?></td>
    <td><a href="editar_categoria.php?modificar=<?= $categoria["id_categoria"]?>"><button class="btn btn-sm btn-warning">Editar</button></a>
    <a href="<?=$_SERVER["PHP_SELF"]?>?borrar=<?=$categoria["id_categoria"]?>"><button class="btn btn-sm btn-danger">Eliminar</button></a>
  <?php
    }
  ?>
</table>

</main>
</div>
</body>
</html>
