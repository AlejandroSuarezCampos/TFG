<?php
include_once("cabezera.php");
?>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
      
      <!-- Tarjeta de Registro -->
      <div class="card game-card border-0 shadow-lg">
        <div class="card-body p-5">
          
          <!-- Header -->
          <div class="text-center mb-4">
            <h2 class="fw-bold">Crear cuenta</h2>
            <p class="text">Únete a la comunidad de Steam Killer</p>
          </div>

          <!-- Formulario de Registro -->
          <form>
            <!-- Nombre de usuario -->
            <div class="mb-3">
              <label for="username" class="form-label text">Nombre de usuario</label>
              <input type="text" class="form-control modern-input" id="username" placeholder="Ej: Cana Gay">
            </div>

            <div class="alert error-message mt-4 oculto" id="errorUsuario"></div>

            <!-- Email -->
            <div class="mb-3">
              <label for="email" class="form-label text">Correo electrónico</label>
              <input type="email" class="form-control modern-input" id="email" placeholder="tucorreo@ejemplo.com">
            </div>

            <div class="alert error-message mt-4 oculto" id="errorEmail"></div>

            <!-- Contraseña -->
            <div class="mb-3">
              <label for="password" class="form-label text">Contraseña</label>
              <input type="password" class="form-control modern-input" id="password" placeholder="Mínimo 8 caracteres">
              <small class="text password-hint">Mínimo 8 caracteres</small>
            </div>

            <div class="alert error-message mt-4 oculto" id="errorContrasena"></div>

            <!-- Confirmar Contraseña -->
            <div class="mb-4">
              <label for="confirm_password" class="form-label text">Confirmar contraseña</label>
              <input type="password" class="form-control modern-input" id="confirm_password" placeholder="Repite tu contraseña">
            </div>

            <div class="alert error-message mt-4 oculto" id="errorContrasena2"></div>

            <!-- Botón Registrarse -->
            <button type="button" class="btn btn-steam w-100 py-2 mb-3" onclick="registrar()">Crear cuenta</button>

            <!-- Enlace a Login -->
            <div class="text-center">
              <span class="text">¿Ya tienes cuenta?</span>
              <a href="login.php" class="login-link">Inicia sesión</a>
            </div>

          </form>

          <div class="alert error-message mt-4 oculto" id="errorCampos"></div>

        </div>
      </div>

    </div>
  </div>
</div>

<?php
include_once("pie.php");
?>