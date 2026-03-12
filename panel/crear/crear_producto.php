<?php
  include_once("cabecera.php");
  $nombreimagen="";
  $listarCate=$db->listarCategorias();
  $error=false;

if(isset($_POST["anadir"])){
  if(!isset($_POST["nombre"])){
    echo "el nombre es obligatorio </br>";
     $error=true;
  }
  if(!isset($_POST["precio"])){
    echo "el precio es obligatorio </br>";
     $error=true;
  }
  if(!isset($_POST["stock"])){
    echo "el stock es obligatorio </br>";
     $error=true;
  }
  if(!isset($_POST["descripcion"])){
    echo "el stock es obligatorio </br>";
     $error=true;
  }
  if(!isset($_POST["categoria"])){
    echo "la categoria es obligatorio </br>";
     $error=true;
  }
  if(isset($_FILES["archivo"])){ 
      if(is_uploaded_file($_FILES["archivo"]["tmp_name"])){
          $nombreimagen = "../img/".$_FILES["archivo"]["name"];
          move_uploaded_file($_FILES["archivo"]["tmp_name"],$nombreimagen);
      }else{
          echo "La imagen es obligatoria";
          $error=true;
        }
      }
      if($error === false){
        $db->insertarProducto($_POST["nombre"],$_POST["precio"],$_POST["stock"],$_POST["descripcion"],$nombreimagen,$_POST["categoria"]);
      }
  }
?>



<h2>Crear producto</h2>
<form class="card p-4" action="<?= $_SERVER["PHP_SELF"] ?>" method="POST" enctype="multipart/form-data">
<div class="row">
<div class="col-md-6 mb-3">
<label>Nombre</label>
<input class="form-control" name="nombre">
</div>
<div class="col-md-6 mb-3">
<label>Categoría</label>
<select class="form-select" name="categoria">
  <?php
    foreach($listarCate as $cate){
  ?>
<option value="<?=$cate["id_categoria"]?>"><?=$cate["nombre"]?></option>
<?php
    }
?>
</select>
</div>
</div>

<div class="row">
<div class="col-md-4 mb-3">
<label>Precio</label>
<input type="number" class="form-control" name="precio">
</div>
<div class="col-md-4 mb-3">
<label>Stock</label>
<input type="number" class="form-control" name="stock">
</div>
<div class="col-md-4 mb-3">
<label>Ventas</label>
<input type="number" class="form-control" disabled value="0">
</div>
</div>

<div class="mb-3">
<label>Descripción</label>
<textarea class="form-control" name="descripcion"></textarea>
</div>

<div class="mb-3">
<label>Imagen</label>
<input type="file" class="form-control" name="archivo">
</div>

<button type="submit" value="Añadir" name="anadir" class="btn btn-success">Guardar</button>
<a href="productos.php" class="btn btn-secondary">Cancelar</a>
</form>

</main>
</div>
</body>
</html>
