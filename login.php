<?php
include_once("cabezera.php");
?>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
      
      <!-- Tarjeta de Login -->
      <div class="card game-card border-0 shadow-lg">
        <div class="card-body p-5">
          
          <!-- Header -->
          <div class="text-center mb-4">
            <h2 class="fw-bold">Bienvenido de vuelta</h2>
            <p class="text">Inicia sesión para acceder a tu cuenta</p>
          </div>

          <!-- Formulario de Login -->
          <form>
            <!-- Email -->
            <div class="mb-3">
              <label for="email" class="form-label text">Correo electrónico</label>
              <input type="email" class="form-control modern-input" id="email" placeholder="tucorreo@ejemplo.com">
            </div>

            <div class="alert error-message mt-4 oculto" id="errorEmail"></div>

            <!-- Contraseña -->
            <div class="mb-3">
              <label for="password" class="form-label text">Contraseña</label>
              <div class="input-group">
                <input type="password" class="form-control modern-input" id="password" placeholder="••••••••">
                <button class="btn btn-outline-secondary" type="button" onclick="togglePass('password', 'iconoOjoLogin')">
                  <i class="bi bi-eye text-white" id="iconoOjoLogin"></i>
                </button>
              </div>
            </div>

            <div class="alert error-message mt-4 oculto" id="errorContrasena"></div>

            <!-- Recordar contraseña y olvidé contraseña -->
            <div class="d-flex justify-content-between align-items-center mb-4">
              <a href="#" class="text-decoration-none forgot-link">¿Olvidaste tu contraseña?</a>
            </div>

            <!-- Botón Iniciar Sesión -->
            <button type="button" class="btn btn-steam w-100 py-2 mb-3" onclick="iniciarSesion()">Iniciar Sesión</button>

            <!-- Línea divisoria -->
            <div class="position-relative my-4">
              <hr class="divider-line">
              <span class="position-absolute top-50 start-50 translate-middle px-3 divider-text">o</span>
            </div>

            <!-- Botón Registro -->
            <a href="registro.php" class="btn btn-outline-steam w-100 py-2">Crear cuenta nueva</a>

          </form>

          <!-- Mensaje de error -->
          <div class="alert error-message mt-4 oculto" id="errorCampos"></div>

        </div>
      </div>

      <!-- Información adicional -->
      <div class="text-center mt-4">
        <p class="text small">
          Al iniciar sesión, aceptas nuestros 
          <a href="#" class="terms-link">Términos de uso</a> y 
          <a href="#" class="terms-link">Política de privacidad</a>
        </p>
      </div>

    </div>
  </div>
</div>

<?php
include_once("pie.php");
?>