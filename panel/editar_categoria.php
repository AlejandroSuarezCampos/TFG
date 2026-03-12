<?php
include_once("cabecera.php");

$modificar = $_GET["modificar"] ?? null;

$datosCat= $db->buscarCategoriaId($modificar);
// Procesar formulario
if (isset($_POST["modificar"]) && $modificar !== null) {

    $nombre = trim($_POST["nombre"]);

    if ($nombre === "") {
        $error = "El nombre no puede estar vacío";
    } else if($nombre === $datosCat["nombre"]){
        $error = "El nombre no puede ser el mismo";
    }else{
        $db->modificarCat($modificar, $nombre);
        header("Location: categorias.php");
    }
}
?>



<h2>Editar categoría</h2>

<?php if (isset($error)): ?>
    <div class="alert alert-danger"><?= $error ?></div>
<?php endif; ?>

<form class="card p-4" method="POST">
    <div class="mb-3">
        <label>Nombre de la categoría</label>
        <input class="form-control" name="nombre" required>
    </div>

    <button type="submit" name="modificar" class="btn btn-primary">
        Guardar cambios
    </button>

    <a href="categorias.php" class="btn btn-secondary">Cancelar</a>
</form>


