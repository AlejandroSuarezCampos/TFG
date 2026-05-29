<?php
include_once("../cuerpos/PanelIndex.php");

$id=$_GET["modificar"];

$usuario=$db->BuscarUsuario($id);
?>
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
      
      <!-- Tarjeta de Registro -->
      <div class="card game-card border-0 shadow-lg">
        <div class="card-body p-5">
          <!-- Formulario de Registro -->
          <form>
            <!-- Nombre de usuario -->
            <div class="mb-3">
              <label for="username" class="form-label text">Nombre de usuario</label>
              <input type="text" class="form-control modern-input" id="username" value="<?=$usuario["nombre"]?>">
            </div>

            <div class="alert error-message mt-4 oculto" id="errorUsuario"></div>

            <!-- Email -->
            <div class="mb-3">
              <label for="email" class="form-label text">Correo electrónico</label>
              <input type="email" class="form-control modern-input" id="email" value="<?=$usuario["email"]?>">
            </div>

            <div class="alert error-message mt-4 oculto" id="errorEmail"></div>

            <!-- Contraseña -->
            <div class="mb-3">
              <label for="password" class="form-label text">Contraseña</label>  
              <div class="input-group">
                <input type="password" class="form-control modern-input" id="password" placeholder="••••••••">
                </button>
              </div>
            </div>

            <div class="alert error-message mt-4 oculto" id="errorContrasena"></div>

            <!-- Botón De editar Usuario -->
            <button type="button" class="btn btn-steam w-100 py-2 mb-3" onclick="ModificarUsu(<?=$id?>)">Editar Usuario</button>
          </form>

          <div class="alert error-message mt-4 oculto" id="errorCampos"></div>

        </div>
      </div>

    </div>
  </div>
</div>