<?php 
include_once("cabecera.php");

$categorias = $db->listarCategorias();
$foros = $db->listarForos();

  if(!isset($_SESSION['usuario_id'])){
        header("location: foro.php");
    }

if($_POST){

    $titulo = $_POST["titulo"];
    $foro = $_POST["foro"];
    $idUser = $_SESSION["usuario_id"];

    $db->crearTema($idUser, $titulo, $foro);

    header("Location: foro.php");
    exit;
}
?>

<div class="container py-4">

  <!-- CABECERA -->
  <div class="forum-header mb-5">
    <h1>Crear nuevo tema</h1>

    <p class="text-secondary mb-0">
      Comparte dudas, noticias o inicia una conversación con la comunidad.
    </p>
  </div>

  <!-- FORMULARIO -->
  <div class="card game-card create-topic-card">
    <div class="card-body">

<form action="" method="POST">

  <!-- TITULO -->
  <div class="mb-4">
    <label class="form-label forum-label">Título del tema</label>

    <input 
      type="text"
      name="titulo"
      class="form-control forum-input"
      placeholder="Escribe un título interesante..."
      required
    >
  </div>

  <div class="row">

    <!-- FORO -->
    <div class="col-md-6 mb-4">
      <label class="form-label forum-label">Foro</label>

      <select name="foro" class="form-select forum-input" required>
        <option value="">Selecciona un foro</option>

        <?php foreach($foros as $foro){ ?>
          <option value="<?= $foro["id_foro"] ?>">
            <?= $foro["nombre"] ?>
          </option>
        <?php } ?>

      </select>
    </div>

    <!-- CATEGORIA -->
    <div class="col-md-6 mb-4">
      <label class="form-label forum-label">Categoría</label>

      <select name="categoria" class="form-select forum-input">
        <option value="">Opcional</option>

        <?php foreach($categorias as $cat){ ?>
          <option value="<?= $cat["id_categoria"] ?>">
            <?= $cat["nombre"] ?>
          </option>
        <?php } ?>

      </select>
    </div>

  </div>

  <!-- BOTONES -->
  <div class="d-flex justify-content-between align-items-center mt-4">

    <a href="foro.php" class="btn btn-outline-light">
      Cancelar
    </a>

    <button type="submit" class="btn btn-steam px-4">
      Publicar tema
    </button>

  </div>

</form>

    </div>
  </div>

</div>

<?php include_once("pie.php"); ?>