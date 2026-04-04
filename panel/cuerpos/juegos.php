<?php
  include_once("PanelIndex.php");

  $listarJuegos=$db->listarUsuarios();
?>

<a href="../crear/crear_Usuarios.php"><button class="btn btn-primary mb-3">Nuevo Juego</button></a>
<table class="table">

<h2>Gestión de Juegos</h2>
<table class="table">
<tr><th>ID</th><th>Nombre</th><th>Email</th><th>Rol</th><th>Acciones</th></tr>
<?php
    foreach($listarUsuario as $usuario){
  ?>
<tr>
<td><?=$usuario["id_usuario"]?></td><td><?=$usuario["nombre"]?></td><td><?=$usuario["email"]?></td><td><?=$usuario["id_rol"]?></td>
<td><a href="../editar/editar_usuario.php?modificar=<?= $usuario["id_usuario"]?>"><button class="btn btn-sm btn-warning">Editar</button></a></td>
</tr>
<?php
    }
?>
</table>

</main>
</div>
</body>
</html>
