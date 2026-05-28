<?php
  include_once("PanelIndex.php");

  if ($_SESSION["Rol"] !== 1 && $_SESSION["Rol"] !== 5) {
    header("location: PanelIndex.php");
    exit;
}

 $listaCategorias=$db->listarCategorias();
?>

<h2>Gestión de Categorías</h2>
<a href="../crear/crear_categoria.php"><button class="btn btn-primary mb-3">Nueva categoría</button></a>
<table class="table">
  
<tr><th>ID</th><th>Nombre</th><th>Acciones</th></tr>
<?php
    foreach($listaCategorias as $categoria){
  ?>
    <tr id="fila-<?= $categoria["id_categoria"] ?>">
      <td><?= $categoria["id_categoria"] ?></td><td><?= $categoria["nombre"] ?></td>
    <td>
      <a href="../editar/editar_categoria.php?modificar=<?=$categoria["id_categoria"]?>"><button class="btn btn-sm btn-warning">Editar</button></a>
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
