<?php
    include_once("cabecera.php");

    $modificar = $_GET["modificar"];

// Procesar formulario
if (isset($_POST["modificar"]) && $modificar !== null) {

    $nombre = $_POST["nombre"];
    $mail = $_POST["mail"];
    if ($nombre === "" || $mail=="") {
        $error = "No pueden estar vacío";
    } else {
        $db->modificarUsu($modificar, $nombre,$mail);
        header("Location: usuarios.php");
    }
}
?>

<h2>Editar Uusario</h2>

<?php if (isset($error)): ?>
    <div class="alert alert-danger"><?= $error ?></div>
<?php endif; ?>

<form class="card p-4" method="POST">
    <div class="mb-3">
        <label>Nombre del usuario</label>
        <input class="form-control" name="nombre" required>
    </div>

    <div class="mb-3">
        <label>Mail del usuario</label>
        <input class="form-control" name="mail" required>
    </div>

    <button type="submit" name="modificar" class="btn btn-primary">
        Guardar cambios
    </button>

    <a href="categorias.php" class="btn btn-secondary">Cancelar</a>
</form>
