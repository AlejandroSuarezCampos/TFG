<?php
include_once("../cuerpos/PanelIndex.php");

if(isset($_GET["modificar"])){
  $modificar=$_GET["modificar"];
}else{
  $modificar="";
}

if($modificar==""){
  header("Location:../cuerpos/categorias.php");
}
$categoria = $db->BuscarCat($modificar);
?>
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
      
      <!-- Tarjeta de Cateogria -->
      <div class="card game-card border-0 shadow-lg">
        <div class="card-body p-5">
          
          <!-- Header -->
          <div class="text-center mb-4">
            <h2 class="fw-bold">Editar Cateogrias</h2>
          </div>

          <!-- Formulario de Categoria -->
          <form>
            <!-- nombre -->
            <div class="mb-3">
              <label for="nombre" class="form-label text">Nombre nuevo de la categoria</label>
              <input type="text" class="form-control modern-input" id="nombre" value="<?=$categoria["nombre"]?>">
            </div>
            <div class="alert error-message mt-4 oculto" id="errorNombre"></div>
            <!-- Botón Crear Cat -->
            <button type="button" class="btn btn-steam w-100 py-2 mb-3" onclick="ModificarCat(<?=$modificar?>)">Editar</button>
          </form>

          <!-- Mensaje de error -->
          <div class="alert error-message mt-4 oculto" id="errorCampos"></div>

        </div>
      </div>
    </div>
  </div>
</div>


