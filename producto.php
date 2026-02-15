<?php 
            include_once("cabezera.php");
            include_once("consultas.php");

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

      <h3 class="price"><?=$juego["precio_alquiler"]?> € - Alquiler 48h</h3>
      <button class="btn btn-steam btn-lg mt-3">Alquilar ahora</button>

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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
  include_once("pie.php");
?>