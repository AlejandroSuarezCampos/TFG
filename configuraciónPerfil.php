<?php 
include_once("cabecera.php");
include_once("./db/conexion.php");

if (!isset($_SESSION['usuario_id'])) {
    header("location: index.php");
    exit;
}

if (isset($_POST['borrar'])) {
    $id_usu = $_SESSION['usuario_id'];
    $db->borrarCuenta($id_usu);
}
?>
<script src="./js/async.js"></script>
<div class="container py-5">

  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="section-heading m-0">Configuración de perfil</h4>
    <a href="perfil.php" class="btn btn-outline-steam btn-sm">← Volver al perfil</a>
  </div>

  <div class="settings-card mb-4">
    <h5 class="settings-title">Cambiar contraseña</h5>

    <!-- Mensaje de resultado (oculto hasta que llegue respuesta) -->
    <div id="errorCampos"     class="error-message mb-3 oculto"></div>
    <div id="errorContrasena" class="error-message mb-3 oculto"></div>
    <div id="errorRepetir"    class="error-message mb-3 oculto"></div>
    <div id="exito"           class="exito-message mb-3 oculto"></div>

    <div class="mb-3">
      <label class="form-label">Nueva contraseña</label>
      <input type="password" id="nueva" class="modern-input"
             placeholder="Mínimo 8 caracteres">
    </div>

    <div class="mb-3">
      <label class="form-label">Repetir nueva contraseña</label>
      <input type="password" id="repetir" class="modern-input"
             placeholder="Repite la contraseña">
    </div>

    <button class="btn btn-steam" onclick="cambiarPassword()">
      Guardar cambios
    </button>
  </div>

  <div class="settings-card danger">
    <h5 class="settings-title text-danger">Zona peligrosa</h5>
    <p class="settings-text">Eliminar tu cuenta es permanente y no se puede deshacer.</p>
    <form method="POST">
      <button type="submit" class="btn btn-danger w-100" name="borrar">
        Borrar cuenta
      </button>
    </form>
  </div>

</div>

<script src="./js/async.js"></script>

<?php include_once("pie.php"); ?>