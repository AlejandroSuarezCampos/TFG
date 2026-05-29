<?php 
include_once("cabecera.php");

  if(!isset($_SESSION['usuario_id'])){
        header("location: foro.php");
    }
    
if($_POST){

    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];

    if(!empty($nombre)){

        $db->crearForo($nombre, $descripcion);

        header("Location: foro.php");
        exit;
    }
}
?>

<div class="container py-4">

  <!-- CABECERA -->
  <div class="mb-4">
    <h1>Crear nuevo foro</h1>
    <p class="text-secondary">
      Crea una nueva categoría para organizar los temas.
    </p>
  </div>

  <!-- FORMULARIO -->
  <div class="settings-card create-topic-card">
    <div class="card-body">

      <form method="POST">

        <!-- NOMBRE -->
        <div class="mb-3">
          <label class="form-label">Nombre del foro</label>

          <input 
            type="text"
            name="nombre"
            class="form-control forum-input"
            placeholder="Ej: RPG, Noticias, Soporte..."
            required
          >
        </div>

        <!-- DESCRIPCION -->
        <div class="mb-3">
          <label class="form-label">Descripción</label>

          <textarea 
            name="descripcion"
            class="form-control forum-input"
            rows="4"
            placeholder="Describe de qué trata este foro..."
          ></textarea>
        </div>

        <!-- BOTONES -->
        <div class="d-flex justify-content-between">

          <a href="foro.php" class="btn btn-outline-light">
            Cancelar
          </a>

          <button type="submit" class="btn btn-steam">
            Crear foro
          </button>

        </div>

      </form>

    </div>
  </div>

</div>

<?php include_once("pie.php"); ?>