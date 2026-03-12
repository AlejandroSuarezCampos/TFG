<?php
  include_once("cabecera.php");

  $listarUsuario=$db->listarUsuario();
?>

<h2>Gestión de Usuarios</h2>
<table class="table">
<tr><th>ID</th><th>Nombre</th><th>Email</th><th>Rol</th><th>Acciones</th></tr>
<?php
    foreach($listarUsuario as $usuario){
  ?>
<tr>
<td><?=$usuario["id_users"]?></td><td><?=$usuario["nombre"]?></td><td><?=$usuario["mail"]?></td><td><?=$db->rolUsu($usuario["id_users"])?></td>
<td><a href="editar_usuario.php?modificar=<?= $usuario["id_users"]?>"><button class="btn btn-sm btn-warning">Editar</button></a></td>
</tr>
<?php
    }
?>
</table>

</main>
</div>
</body>
</html>
