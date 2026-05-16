<?php
include_once("../cuerpos/PanelIndex.php");
if (!isset($_GET['id'])) {
    header("Location: ../cuerpos/juegos.php");
    exit;
} else {
    $id = $_GET["id"];
    if (!$existe = $db->existeJuegoId($id)) {
        header("Location: ../cuerpos/juegos.php");
        exit;
    } else {
        $juego = $db->getJuego($id);
    }
}

?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">


            <div class="card game-card border-0 shadow-lg">
                <div class="card-body p-5">

                    <div class="text-center mb-4">
                        <h2 class="fw-bold">Editar juego</h2>
                    </div>


                    <form>
                        <!-- Nombre del juego -->
                        <div class="mb-3">
                            <label for="titulo" class="form-label text">Nombre del juego</label>
                            <input type="text" name="titulo" class="form-control modern-input" id="titulo"
                                value="<?= $juego["titulo"] ?>">
                        </div>

                        <div class="alert error-message mt-4 oculto" id="errorTitulo"></div>

                        <!-- Descripcion -->
                        <div class="mb-3">
                            <label for="descripcion" class="form-label text">Descripcion</label>
                            <input type="text" name="descripcion" class="form-control modern-input" id="descripcion"
                                value="<?= $juego["descripcion"] ?>">
                        </div>

                        <!-- Precio -->
                        <div class="mb-3">
                            <label for="precio" class="form-label text">Precio</label>
                            <input type="number" name="precio" class="form-control modern-input" id="precio" max="99.99"
                                min="0" step="0.01" value="<?= $juego['precio_alquiler']; ?>">
                        </div>

                        <!-- Imagen -->

                       <div class="mb-3">
                            <label class="form-label text">Imagen actual</label><br>

                            <img src="../../<?= $juego['imagen']; ?>" 
                                alt="Imagen del producto" 
                                id="previa"
                                style="max-width: 200px; margin-bottom:10px; display:block;">

                            <input type="hidden" 
                                id="imagen_actual" 
                                value="<?= $juego['imagen']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="imagen" class="form-label text">Cambiar imagen</label>
                            <input type="file" class="form-control modern-input" id="imagen" name="imagen" accept="image/*">

                            <small class="text-secondary">
                                Solo se permiten JPG, JPEG, PNG, GIF o WEBP.
                            </small>
                        </div>

                        <div class="alert error-message mt-4 oculto" id="errorImagen"></div>

                        <!-- Ventas -->

                        <div class="mb-3">
                            <label for="ventas" class="form-label text">Ventas</label>
                            <input type="number" name="ventas" class="form-control modern-input" id="ventas"
                                value="<?= $juego['ventas']; ?>" min="0">
                        </div>

                        <!-- Stock -->

                        <div class="mb-3">
                            <label for="stock" class="form-label text">Stock</label>
                            <input type="number" name="stock" class="form-control modern-input" id="stock"
                                value="<?= $juego['stock']; ?>" min="0" name="stock">
                        </div>

                        <!-- Botón De crear Juego-->
                        <button type="button" class="btn btn-steam w-100 py-2 mb-3"
                            onclick="editarJuego(<?=$id?>)">Guardar</button>
                        <a href="../cuerpos/juegos.php"><button type="button"
                                class="btn btn-steam w-100 py-2 mb-3">Volver</button></a>

                    </form>

                    <div class="alert error-message mt-4 oculto" id="errorCampos"></div>

                </div>
            </div>

        </div>
    </div>
</div>