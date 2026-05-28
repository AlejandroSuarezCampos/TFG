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

<?php if (isset($_POST['borrar'])): ?>
    <script>
        // Se ejecuta cuando el formulario ya fue enviado y la cuenta borrada
        Swal.fire({
            icon: 'success',
            title: 'Cuenta eliminada',
            text: 'Tu cuenta ha sido eliminada correctamente.',
            customClass: { popup: 'steam-popup' }
        }).then(() => {
            window.location.href = '../index.php'; // Redirige tras confirmar
        });
    </script>
<?php endif; ?>
<script src="./js/async.js"></script>
<div class="container py-5">

  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="section-heading m-0">Activar Códigos</h4>
    <a href="perfil.php" class="btn btn-outline-steam btn-sm">← Volver al perfil</a>
  </div>

  <div class="settings-card mb-4">
    <h5 class="settings-title">Activación</h5>
    <p class="settings-text">Introduce el código alfanumérico para activar tu alquiler.</p>

    <div id="errorCodigo" class="error-message mb-3 oculto"></div>
    <div id="exitoCodigo" class="exito-message mb-3 oculto"></div>

    <div class="mb-3">
      <label class="form-label">Código de activación</label>
      <input type="text" id="codigo" class="modern-input" 
            placeholder="Ej: A1B2C3D4E5F6G7H8"
            maxlength="16">
    </div>

    <button class="btn btn-steam" onclick="activarCodigo()">
      Activar
    </button>
  </div>

  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="section-heading m-0">Configuración de perfil</h4>
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
      <button type="button" class="btn btn-danger w-100" onclick="confirmarBorrarCuenta()">
      Borrar cuenta
    </button>
  </div>

</div>

<script src="./js/async.js"></script>

<?php include_once("pie.php"); ?>