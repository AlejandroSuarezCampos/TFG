<?php 
include_once("cabecera.php");

  if(!isset($_SESSION['usuario_id'])){
        header("location: soporte.php");
        exit;
    }

if($_POST){

    $titulo = $_POST["titulo"];
    $asunto = $_POST["asunto"];
    $idUser = $_SESSION["usuario_id"];

    $db->crearTicket($idUser, $titulo, $asunto);

    header("Location: soporte.php");
    exit;
}
?>

<div class="container py-4">

  <!-- CABECERA -->
  <div class="forum-header mb-5">
    <h1>Crear nuevo ticket</h1>

    <p class="text-secondary mb-0">
      comparte problemas con el staff para poder ayudarte.
    </p>
  </div>

  <!-- FORMULARIO -->
  <div class="settings-card create-topic-card">
    <div class="card-body">

<form action="" method="POST">

  <!-- TITULO -->
  <div class="mb-4">
    <label class="form-label forum-label">Nombre Ticket</label>

    <input 
      type="text"
      name="titulo"
      class="form-control forum-input"
      placeholder="Escribe un nombre"
      required
    >
  </div>
    <!-- Usunto -->
  <div class="mb-4">
    <label class="form-label forum-label">Asunto</label>

    <input 
      type="text"
      name="asunto"
      class="form-control forum-input"
      placeholder="Escribe el asunto del Ticket"
      required
    >

  </div>
  <!-- BOTONES -->
  <div class="d-flex justify-content-between align-items-center mt-4">

    <a href="Soporte.php" class="btn btn-outline-light">
      Cancelar
    </a>

    <button type="submit" class="btn btn-steam px-4">
      Publicar Ticket
    </button>

  </div>

</form>

    </div>
  </div>

</div>

<?php include_once("pie.php"); ?>