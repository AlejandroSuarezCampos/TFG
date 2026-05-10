<?php 
  include_once("cabezera.php");

  $posts = [
    [
      "titulo" => "¿Cuál es el mejor RPG de 2026?",
      "autor" => "DarkPlayer",
      "categoria" => "RPG",
      "mensajes" => 24,
      "fecha" => "Hace 2 horas"
    ],
    [
      "titulo" => "Problema con mando de PS5 en PC",
      "autor" => "NeoGamer",
      "categoria" => "Soporte",
      "mensajes" => 12,
      "fecha" => "Hace 5 horas"
    ],
    [
      "titulo" => "Ofertas de verano Steam",
      "autor" => "PixelKing",
      "categoria" => "Noticias",
      "mensajes" => 45,
      "fecha" => "Hoy"
    ]
  ];
?>

<div class="container py-4">

  <!-- CABECERA -->
  <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">

    <div>
      <h1 class="mb-0">Foros</h1>
      <small class="text-secondary">
        Discute sobre juegos, noticias y soporte
      </small>
    </div>

    <div class="d-flex gap-2 w-100 w-md-auto">

      <!-- BUSCADOR -->
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Buscar temas...">
        <button class="btn btn-steam">Buscar</button>
      </div>

      <!-- NUEVO TEMA -->
      <button class="btn btn-steam">
        + Nuevo tema
      </button>

    </div>
  </div>

  <!-- LISTA DE POSTS -->
  <div class="forum-container">

    <?php
      foreach($posts as $post){
    ?>

    <div class="card game-card forum-post">
      <div class="card-body">

        <div class="row align-items-center gy-3">

          <!-- TITULO -->
          <div class="col-md-6">
            <h5 class="mb-1">
              <a href="#" class="text-white text-decoration-none">
                <?=$post["titulo"]?>
              </a>
            </h5>

            <small class="text-secondary">
              Publicado por <?=$post["autor"]?>
            </small>
          </div>

          <!-- CATEGORIA -->
          <div class="col-md-2 text-md-center">
            <span class="badge bg-primary">
              <?=$post["categoria"]?>
            </span>
          </div>

          <!-- RESPUESTAS -->
          <div class="col-md-2 text-md-center">
            <span class="price">
              <?=$post["mensajes"]?> respuestas
            </span>
          </div>

          <!-- FECHA -->
          <div class="col-md-2 text-md-center text-secondary">
            <?=$post["fecha"]?>
          </div>

        </div>

      </div>
    </div>

    <?php
      }
    ?>

  </div>

</div>

<?php
  include_once("pie.php");
?>