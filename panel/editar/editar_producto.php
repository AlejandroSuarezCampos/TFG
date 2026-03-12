<?php
  include_once("cabecera.php");
?>

<h2>Editar producto</h2>
<form class="card p-4">
<div class="row">
<div class="col-md-6 mb-3">
<label>Nombre</label>
<input class="form-control" value="Producto ejemplo">
</div>
<div class="col-md-6 mb-3">
<label>Categoría</label>
<select class="form-select">
<option selected>Electrónica</option>
<option>Deportes</option>
</select>
</div>
</div>

<div class="row">
<div class="col-md-4 mb-3">
<label>Precio</label>
<input type="number" class="form-control" value="99">
</div>
<div class="col-md-4 mb-3">
<label>Stock</label>
<input type="number" class="form-control" value="10">
</div>
<div class="col-md-4 mb-3">
<label>Ventas</label>
<input type="number" class="form-control" value="25" disabled>
</div>
</div>

<div class="mb-3">
<label>Descripción</label>
<textarea class="form-control">Descripción del producto</textarea>
</div>

<button class="btn btn-primary">Guardar cambios</button>
<a href="productos.html" class="btn btn-secondary">Cancelar</a>
</form>

</main>
</div>
</body>
</html>
