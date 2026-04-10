<?php
include_once("../cuerpos/PanelIndex.php");
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">


            <div class="card game-card border-0 shadow-lg">
                <div class="card-body p-5">

                    <div class="text-center mb-4">
                        <h2 class="fw-bold">Crear juego</h2>
                    </div>


                    <form>
                        <!-- Nombre del juego -->
                        <div class="mb-3">
                            <label for="titulo" class="form-label text">Nombre del juego</label>
                            <input type="text" class="form-control modern-input" id="titulo" placeholder="Ej: Juego1">
                        </div>

                        <div class="alert error-message mt-4 oculto" id="errorTitulo"></div>

                        <!-- Descripcion -->
                        <div class="mb-3">
                            <label for="descripcion" class="form-label text">Descripcion</label>
                            <input type="text" class="form-control modern-input" id="descripcion" placeholder="Ej: Juego muy bueno y divertido">
                        </div>

                        <div class="alert error-message mt-4 oculto" id="errorDescripcion"></div>

                        <!-- Precio -->
                        <div class="mb-3">
                            <label for="precio" class="form-label text">Precio</label>
                            <input type="number" class="form-control modern-input" id="precio" placeholder="Ej: 1.25€" max="99.99" min="0" step="0.01">
                        </div>

                        <div class="alert error-message mt-4 oculto" id="errorPrecio"></div>

                        <!-- Imagen -->

                        <div class="mb-3">
                            <label for="imagen" class="form-label text">Subir Imagen</label>
                            <input type="file" class="form-control modern-input" id="imagen" name="imagen" required>
                        </div>

                        <!-- Ventas -->

                        <div class="mb-3">
                            <label for="ventas" class="form-label text">Ventas</label>
                            <input type="number" class="form-control modern-input" id="ventas" placeholder="Ej: 10" min="0">
                        </div>

                        <!-- Stock -->

                        <div class="mb-3">
                            <label for="stock" class="form-label text">Stock</label>
                            <input type="number" class="form-control modern-input" id="stock" placeholder="Ej: 100" min="0">
                        </div>

                        <!-- Botón De crear Juego-->
                        <button type="button" class="btn btn-steam w-100 py-2 mb-3" onclick="crearUsu()">Crear Juego</button>
                        <a href="../cuerpos/juegos.php"><button type="button" class="btn btn-steam w-100 py-2 mb-3">Volver</button></a>

                    </form>

                    <div class="alert error-message mt-4 oculto" id="errorCampos"></div>

                </div>
            </div>

        </div>
    </div>
</div>