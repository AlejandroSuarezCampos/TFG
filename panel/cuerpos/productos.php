<?php
  include_once("cabecera.php");

  $listarProductos=$db->listarProductos();

   if(isset($_GET["borrar"])){
      $db->eliminarProd($_GET["borrar"]);
	}
?>

<h2>Gestión de Productos</h2>
<a href="crear_producto.php"><button class="btn btn-primary mb-3"><i class="bi bi-plus"></i> Nuevo producto</button></a>
<table class="table table-hover">
<thead>
<tr><th>ID</th><th>Imagen</th><th>Nombre</th><th>Categoría</th><th>Precio</th><th>Stock</th><th>Ventas</th><th>Acciones</th></tr>
</thead>
<tbody>
<tr>
<?php
    foreach($listarProductos as $producto){
  ?>
    <td><?=$producto["id_Producto"]?></td><td><img src=<?=$producto["imagen"]?>></td><td><?=$producto["nombre"]?></td><td><?=$db->nombreCategoria($producto["id_categoria"])?></td><td><?=$producto["precio"]?></td><td><?=$producto["stock"]?></td><td><?=$producto["ventas"]?></td>
    <td>
    <a href="editar_producto.php"><button class="btn btn-sm btn-warning">Editar</button></a>
    <a href="<?=$_SERVER["PHP_SELF"]?>?borrar=<?=$producto["id_Producto"]?>"><button class="btn btn-sm btn-danger">Eliminar</button></a>
    </td>
    </tr>
    </tbody>
<?php
    }
?>
</table>

</main>
</div>
</body>
</html>
