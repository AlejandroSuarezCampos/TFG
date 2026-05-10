<?php 
  include_once("cabezera.php");
?>

<div class="container py-4">

  <!-- CABECERA -->
  <div class="forum-header mb-5">
    <h1>Crear nuevo tema</h1>

    <p class="text-secondary mb-0">
      Comparte dudas, noticias o inicia una conversación con la comunidad.
    </p>
  </div>

  <!-- FORMULARIO -->
  <div class="card game-card create-topic-card">
    <div class="card-body">

      <form action="" method="POST">

        <!-- TITULO -->
        <div class="mb-4">

          <label class="form-label forum-label">
            Título del tema
          </label>

          <input 
            type="text"
            class="form-control forum-input"
            placeholder="Escribe un título interesante..."
          >

        </div>

        <!-- CATEGORIA -->
        <div class="mb-4">

          <label class="form-label forum-label">
            Categoría
          </label>

          <select class="form-select forum-input">

            <option>Selecciona una categoría</option>
            <option>General</option>
            <option>Noticias</option>
            <option>RPG</option>
            <option>Soporte</option>
            <option>Multijugador</option>

          </select>

        </div>

        <!-- CONTENIDO -->
        <div class="mb-4">

          <label class="form-label forum-label">
            Contenido
          </label>

          <textarea 
            class="form-control forum-textarea"
            rows="10"
            placeholder="Escribe aquí el contenido del tema..."
          ></textarea>

        </div>

        <!-- OPCIONES -->
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

          <!-- BOTONES -->
          <div class="d-flex gap-3">

            <a href="foros.php" class="btn btn-outline-light">
              Cancelar
            </a>

            <button type="submit" class="btn btn-steam">
              Publicar tema
            </button>

          </div>

        </div>

      </form>

    </div>
  </div>

</div>

<?php
  include_once("pie.php");
?>