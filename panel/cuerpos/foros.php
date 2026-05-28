<?php
include_once("PanelIndex.php");

  if ($_SESSION["Rol"] !== 1 && $_SESSION["Rol"] !== 2) {
    header("location: PanelIndex.php");
    exit;
}

$listaTemas = $db->listarTemas();
?>

<h2>Gestión de Foros</h2>
<table class="table">

  <tr>
    <th>ID</th>
    <th>Titulo</th>
    <th>d_foro</th>
    <th>id_usuario </th>
    <th>fecha_creacion</th>
  </tr>

  <?php foreach ($listaTemas as $temas): ?>
    <tr id="fila-<?= $temas["id_tema"] ?>">
      <td><?= $temas["id_tema"] ?></td>
      <td><?= htmlspecialchars($temas["titulo"]) ?></td>
      <td><?= htmlspecialchars($temas["id_tema"]) ?></td>
      <td><?= htmlspecialchars($temas["id_usuario"]) ?></td>
      <td><?= htmlspecialchars($temas["fecha_creacion"]) ?></td>
      <td>
        <a class="btn btn-sm btn-warning" href="../editar/editar_tema.php?modificar=<?= $temas['id_tema']?>">Editar</a>
        <button class="btn btn-sm btn-danger" onclick="eliminarTema(<?= $temas['id_tema'] ?>)">Eliminar</button>
      </td>
    </tr>
  <?php endforeach; ?>

</table>

</main>
</div>

</body>
</html>