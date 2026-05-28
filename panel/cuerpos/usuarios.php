<?php
  include_once("PanelIndex.php");

  if ($_SESSION["Rol"] !== 1 && $_SESSION["Rol"] !== 3) {
    header("location: PanelIndex.php");
    exit;
  }

  $listarUsuario=$db->listarUsuarios();
?>

<a href="../crear/crear_Usuarios.php"><button class="btn btn-primary mb-3">Nuevo Usaurio</button></a>
<table class="table">

<h2>Gestión de Usuarios</h2>
<table class="table">
<tr><th>ID</th><th>Nombre</th><th>Email</th><th>Rol</th><th>Acciones</th></tr>
<?php
    foreach($listarUsuario as $usuario){
  ?>
<tr id="fila-<?= $usuario["id_usuario"] ?>">
<td><?=$usuario["id_usuario"]?></td><td><?=$usuario["nombre"]?></td><td><?=$usuario["email"]?></td><td><?=$usuario["id_rol"]?></td>
<td><a href="../editar/editar_usuario.php?modificar=<?= $usuario["id_usuario"]?>"><button class="btn btn-sm btn-warning">Editar</button></a>
<button class="btn btn-sm btn-danger" onclick="EliminarUsuario(<?= $usuario['id_usuario'] ?>)">Eliminar</button></td>
</td>
</tr>
<?php
    }
?>
</table>

</main>
</div>
</body>
</html>
