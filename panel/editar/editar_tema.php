<?php
include_once("../cuerpos/PanelIndex.php");

if(isset($_GET["modificar"])){
  $modificar=$_GET["modificar"];
}else{
  $modificar="";
}

if($modificar==""){
  header("Location:../cuerpos/foros.php");
}

$tema=$db->BuscarTema($modificar);
?>
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
      
      <!-- Tarjeta de Tema -->
      <div class="card game-card border-0 shadow-lg">
        <div class="card-body p-5">
          
          <!-- Header -->
          <div class="text-center mb-4">
            <h2 class="fw-bold">Editar Temas</h2>
          </div>

          <!-- Formulario de Tema -->
          <form>
            <!-- Titulo -->
            <div class="mb-3">
              <label for="titulo" class="form-label text">Titulo nuevo del tema</label>
              <input type="text" class="form-control modern-input" id="titulo" value="<?=$tema["titulo"]?>" placeholder="<?=$tema["titulo"]?>">
            </div>
            <button type="button" class="btn btn-steam w-100 py-2 mb-3" onclick="Modificartema(<?=$modificar?>)">Editar</button>
          </form>

          <!-- Mensaje de error -->
          <div class="alert error-message mt-4 oculto" id="errorCampos"></div>

        </div>
      </div>
    </div>
  </div>
</div>