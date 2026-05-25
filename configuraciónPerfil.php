<?php 
include_once("cabecera.php");
include_once("./db/conexion.php");

if(!isset($_SESSION['usuario_id'])){
    header("location: index.php");
    exit;
}

if (isset($_POST['borrar'])) {
    $id_usu=$_SESSION['usuario_id'];
    $db->borrarCuenta($id_usu);
}
?>

<div class="container py-5">

  <!-- =========================
       HEADER + VOLVER
  ========================== -->
  <div class="d-flex justify-content-between align-items-center mb-4">

    <h4 class="section-heading m-0">Configuración de perfil</h4>

    <a href="perfil.php" class="btn btn-outline-steam btn-sm">
      ← Volver al perfil
    </a>

  </div>

  <!-- =========================
       CAMBIAR CONTRASEÑA
  ========================== -->
  <div class="settings-card mb-4">

    <h5 class="settings-title">Cambiar contraseña</h5>

    <form action="cambiar_password.php" method="POST">

      <div class="mb-3">
        <label class="form-label">Nueva contraseña</label>
        <input type="password" name="nueva" class="modern-input" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Repetir nueva contraseña</label>
        <input type="password" name="repetir" class="modern-input" required>
      </div>

      <button type="submit" class="btn btn-steam">
        Guardar cambios
      </button>

    </form>

  </div>

  <!-- =========================
       ELIMINAR CUENTA
  ========================== -->
  <div class="settings-card danger">

    <h5 class="settings-title text-danger">Zona peligrosa</h5>

    <p class="settings-text">
      Eliminar tu cuenta es permanente y no se puede deshacer.
    </p>

    <form method="POST">

      <button type="submit" class="btn btn-danger w-100" name="borrar">
        Borrar cuenta
      </button>

    </form>

  </div>

</div>

<?php include_once("pie.php"); ?>