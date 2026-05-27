<?php 
  include_once("cabecera.php");

  // EJEMPLO DE MENSAJES
  $mensajes = [
    [
      "usuario" => "DarkPlayer",
      "fecha" => "10 Mayo 2026 - 18:32",
      "mensaje" => "Para mí Elden Ring sigue siendo el mejor RPG moderno.",
      "avatar" => "https://i.pravatar.cc/80?img=1"
    ],
    [
      "usuario" => "NeoGamer",
      "fecha" => "10 Mayo 2026 - 19:10",
      "mensaje" => "Yo prefiero Baldur's Gate 3 por la historia y decisiones.",
      "avatar" => "https://i.pravatar.cc/80?img=2"
    ],
    [
      "usuario" => "PixelKing",
      "fecha" => "10 Mayo 2026 - 20:01",
      "mensaje" => "The Witcher 3 sigue envejeciendo increíblemente bien.",
      "avatar" => "https://i.pravatar.cc/80?img=3"
    ]
  ];
?>

<div class="container py-4">

  <!-- TITULO DEL FORO -->
  <div class="forum-header">
    <h1>¿Cuál es el mejor RPG de 2026?</h1>

    <div class="d-flex gap-3 text-secondary small flex-wrap">
      <span>Publicado por DarkPlayer</span>
      <span>24 respuestas</span>
      <span>Última actividad hace 5 min</span>
    </div>
  </div>

  <!-- RESPONDER -->
  <div class="card game-card forum-response-box">
    <div class="card-body">

      <h4 class="mb-4">
        Escribir respuesta
      </h4>

      <textarea 
        class="form-control forum-textarea mb-4" 
        rows="6"
        placeholder="Escribe tu mensaje..."
      ></textarea>

      <div class="text-end">
        <button class="btn btn-steam">
          Publicar respuesta
        </button>
      </div>

    </div>
  </div>

  <!-- MENSAJES -->
  <div class="forum-messages">

    <?php
      foreach($mensajes as $mensaje){
    ?>

    <div class="card game-card forum-message">
      <div class="card-body">

        <div class="row g-0">

          <!-- USUARIO -->
          <div class="col-md-2 text-center border-end user-panel">

            <img 
              src="<?=$mensaje["avatar"]?>" 
              class="forum-avatar"
            >

            <h6 class="mb-1 mt-3">
              <?=$mensaje["usuario"]?>
            </h6>

            <small class="text-secondary">
              Gamer veterano
            </small>

          </div>

          <!-- CONTENIDO -->
          <div class="col-md-10 forum-content">

            <div class="d-flex justify-content-between align-items-center forum-message-header">

              <small class="text-secondary">
                <?=$mensaje["fecha"]?>
              </small>

              <button class="btn btn-sm btn-steam">
                Responder
              </button>

            </div>

            <p class="forum-text">
              <?=$mensaje["mensaje"]?>
            </p>

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