<?php 
  include_once("cabezera.php");
  include_once("./db/consultas.php");

  if(isset($_GET["id"])){
  $id=$_GET["id"];
  }else{
    header("location: index.php");
  }
      
  $juego =$db->listarProductoID($id);

?>
<div class="container my-5">
  <div class="row">
    <!-- IMAGEN DEL JUEGO -->
    <div class="col-md-6">
      <img src="<?=$juego["imagen"]?>" class="img-fluid rounded mb-4" alt="Juego Ejemplo">
    </div>

    <!-- DETALLES DEL JUEGO -->
    <div class="col-md-6">
      <h1 class="fw-bold"><?=$juego["titulo"]?></h1>
      <p class="text-secondary">Género: Acción / Aventura</p>
      <p class="lead">Disfruta de este increíble juego durante un tiempo limitado con nuestro sistema de alquiler digital. ¡Accede a todo el contenido y explora nuevas aventuras sin gastar de más!</p>

      <h3 class="price"><?=$juego["precio_alquiler"]?> €/hora</h3>
     <!-- HTML -->
      <div class="card p-4 fondo ">
        <label for="horas" class="form-label fw-bold text-secondary">Selecciona las horas</label>
        <input type="number" id="horas" name="horas" min="1" max="50" step="1" value="1" class="form-control mb-3">
        <a href="#" class="btn btn-steam btn-lg w-100" onclick="AnadirCarrito(<?= $juego['id_juego'] ?>)">Alquilar</a>
      </div>
      <hr class="my-4">
      <h5>Requisitos mínimos</h5>
      <ul>
        <li>Sistema operativo: Windows 10</li>
        <li>Procesador: Intel i5 o equivalente</li>
        <li>Memoria: 8 GB RAM</li>
        <li>Gráficos: NVIDIA GTX 960 o equivalente</li>
        <li>Almacenamiento: 20 GB disponibles</li>
      </ul>

      <h5>Descripción detallada</h5>
      <p><?=$juego["descripcion"]?></p>
    </div>
  </div>
</div>
</body>
</html>

<?php
  include_once("pie.php");
?>