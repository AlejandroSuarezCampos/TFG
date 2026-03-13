<?php
  include_once("PanelIndex.php");

   if(isset($_GET["borrar"])){
      $db->eliminarCat($_GET["borrar"]);
	}


 $listaCategorias=$db->listarCategorias();
?>

<h2>Gestión de Categorías</h2>
<a href="../crear/crear_categoria.php"><button class="btn btn-primary mb-3">Nueva categoría</button></a>
<table class="table">
<a href="../editar/editar_categoria.php"><button class="btn btn-primary mb-3">Editar categoría</button></a>
<table class="table">
  
<tr><th>ID</th><th>Nombre</th><th>Acciones</th></tr>
<?php
    foreach($listaCategorias as $categoria){
  ?>
    <tr><td><?= $categoria["id_categoria"] ?></td><td><?= $categoria["nombre"] ?></td>
    <td>
    <button class="btn btn-sm btn-danger" onclick="eliminarCategoria(<?= $categoria['id_categoria'] ?>)">Eliminar</button>
  <?php
    }
  ?>
</table>

</main>
</div>
</body>
</html>
