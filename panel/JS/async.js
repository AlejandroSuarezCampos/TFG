/*document.addEventListener("DOMContentLoaded", function(){
    document.getElementById("buscador").addEventListener("keydown", function(e){
        if (e.key === "Enter") {
            buscarJuego();
        }
    });
});*/
document.addEventListener("DOMContentLoaded", function () {
    const buscador = document.getElementById("buscador");

    if (buscador !== null) {
        buscador.addEventListener("keydown", function (e) {
            if (e.key === "Enter") {
                buscarJuego();
            }
        });
    }
});

function filtrarCat(id) {
    let xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("visorJuegos").innerHTML = this.responseText;
        }
    };

    xmlhttp.open("GET", "./async/filtrarCat.php?id=" + id, true);
    xmlhttp.send();
}

function buscarJuego() {
    let xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("visorJuegos").innerHTML = this.responseText;
        }
    };

    let texto = document.getElementById("buscador").value;
    if (texto != "") {
        xmlhttp.open("GET", "./async/buscarJuego.php?texto=" + texto);
        xmlhttp.send();
    } else {
        let capa = document.getElementById("results");
        capa.innerText = "Error al Buscar";
    }
}


function mostrarError(cadena) {
    switch (cadena) {
        case "Todos los campos son obligatorios":
            document.getElementById("errorCampos").classList.remove("oculto");
            document.getElementById("errorCampos").innerText = "Todos los campos son obligatorios";
            break;
        case "Las contraseñas no coinciden":
            document.getElementById("errorContrasena2").classList.remove("oculto");
            document.getElementById("errorContrasena2").innerText = "Las contraseñas no coinciden";
            break;
        case "La contraseña debe tener al menos 8 caracteres":
            document.getElementById("errorContrasena").classList.remove("oculto");
            document.getElementById("errorContrasena").innerText = "La contraseña debe tener al menos 8 caracteres";
            break;
    }
}

function limpiarErrores() {
    document.getElementById("errorCampos").innerText = "";
    document.getElementById("errorCampos").classList.add("oculto");
    document.getElementById("errorEmail").innerText = "";
    document.getElementById("errorEmail").classList.add("oculto");
    document.getElementById("errorContrasena").innerText = "";
    document.getElementById("errorContrasena").classList.add("oculto");
    document.getElementById("errorContrasena2").innerText = "";
    document.getElementById("errorContrasena2").classList.add("oculto");

    document.getElementById("errorCampos").style.color = "#ff4444";
}

function crearCat() {
    limpiarErroresCat();

    let xmlhttp = new XMLHttpRequest();

    let nombre = document.getElementById("nombre").value.trim();
    if (nombre == "") {
        mostrarErrorCat("campos_vacios", "Todos los campos son obligatorios");
        return;
    }

    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let respuesta = JSON.parse(this.responseText);


            if (respuesta.exito) {
                document.getElementById("errorCampos").classList.remove("oculto");
                document.getElementById("errorCampos").innerText = "¡Creado correctamente!";
                document.getElementById("errorCampos").style.color = "#66c0f4";
                document.getElementById("errorCampos").style.borderColor = "#66c0f4";


                document.getElementById("nombre").value = "";


            } else {
                ocultarTodosLosErroresCat();

                switch (respuesta.error) {
                    case "campos_vacios":
                        document.getElementById("errorCampos").classList.remove("oculto");
                        document.getElementById("errorCampos").innerText = respuesta.mensaje;
                        break;
                    case "categoria_existe":
                        document.getElementById("errorNombre").classList.remove("oculto");
                        document.getElementById("errorNombre").innerText = respuesta.mensaje;
                        break;
                    default:
                        document.getElementById("errorCampos").classList.remove("oculto");
                        document.getElementById("errorCampos").innerText = respuesta.mensaje || "Error Al crear Cateogira";

                }
            }
        }
    };
    let url = "../async/crearCategoria.php?nombre=" + encodeURIComponent(nombre);

    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}


function mostrarErrorCat(tipo, mensaje) {
    ocultarTodosLosErroresCat();
    switch (tipo) {
        case "campos_vacios":
            document.getElementById("errorCampos").classList.remove("oculto");
            document.getElementById("errorCampos").innerText = mensaje;
            break;
    }
}


function limpiarErroresCat() {
    ocultarTodosLosErroresCat();
    document.getElementById("errorCampos").style.color = "#ff4444";
    document.getElementById("errorCampos").style.borderColor = "#ff4444";
}


function ocultarTodosLosErroresCat() {
    document.getElementById("errorCampos").classList.add("oculto");
    document.getElementById("errorNombre").classList.add("oculto");
}


function crearUsu() {
    limpiarErrores();

    let xmlhttp = new XMLHttpRequest();

    let nombre = document.getElementById("username").value.trim();
    let correo = document.getElementById("email").value.trim();
    let contrasena = document.getElementById("password").value;
    if (nombre == "" || correo == "" || contrasena == "") {
        mostrarError("Todos los campos son obligatorios");
        return;
    }

    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let respuesta = JSON.parse(this.responseText);
            if (respuesta.exito) {
                document.getElementById("errorCampos").innerText = respuesta.mensaje;
                document.getElementById("errorCampos").classList.remove("oculto");
                document.getElementById("errorCampos").innerText = "¡Creacion completada con exito!";
                document.getElementById("errorCampos").style.color = "#66c0f4";

                document.getElementById("username").value = "";
                document.getElementById("email").value = "";
                document.getElementById("password").value = "";

            } else {
                switch (respuesta.error) {
                    case "Usaurio_existe":
                        document.getElementById("errorUsuario").classList.remove("oculto");
                        document.getElementById("errorUsuario").innerText = respuesta.mensaje;
                        break;
                    case "campos_vacios":
                        document.getElementById("errorCampos").classList.remove("oculto");
                        document.getElementById("errorCampos").innerText = respuesta.mensaje;
                        break;
                    case "correo_invalido":
                        document.getElementById("errorEmail").classList.remove("oculto");
                        document.getElementById("errorEmail").innerText = respuesta.mensaje;
                        break;
                    default:
                        document.getElementById("errorCampos").innerText = respuesta.mensaje || "Error en la creacion de usuario";
                }
            }
        }
    };

    let url = "../async/crearUsuarios.php?nombre=" + encodeURIComponent(nombre) + "&correo=" + encodeURIComponent(correo) + "&contrasena=" + encodeURIComponent(contrasena);
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}

function limpiarErrores() {
    document.getElementById("errorCampos").innerText = "";
    document.getElementById("errorCampos").classList.add("oculto");
    document.getElementById("errorEmail").innerText = "";
    document.getElementById("errorEmail").classList.add("oculto");
    document.getElementById("errorContrasena").innerText = "";
    document.getElementById("errorContrasena").classList.add("oculto");

    document.getElementById("errorCampos").style.color = "#ff4444";
}

function ModificarCat(modificar) {
    limpiarErroresCat();

    let xmlhttp = new XMLHttpRequest();

    let nombre = document.getElementById("nombre").value.trim();
    if (nombre == "" || modificar == "") {
        mostrarErrorCat("campos_vacios", "Todos los campos son obligatorios");
        return;
    }

    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText)
            let respuesta = JSON.parse(this.responseText);


            if (respuesta.exito) {
                document.getElementById("errorCampos").classList.remove("oculto");
                document.getElementById("errorCampos").innerText = "¡Editado correctamente!";
                document.getElementById("errorCampos").style.color = "#66c0f4";
                document.getElementById("errorCampos").style.borderColor = "#66c0f4";
                document.getElementById("nombre").value = "";

                setTimeout(function () {
                    window.location.href = "../cuerpos/categorias.php";
                }, 2000);

            } else {
                ocultarTodosLosErroresCat();

                switch (respuesta.error) {
                    case "campos_vacios":
                        document.getElementById("errorCampos").classList.remove("oculto");
                        document.getElementById("errorCampos").innerText = respuesta.mensaje;
                        break;
                    case "categoria_existe":
                        document.getElementById("errorNombre").classList.remove("oculto");
                        document.getElementById("errorNombre").innerText = respuesta.mensaje;
                        break;
                    default:
                        document.getElementById("errorCampos").classList.remove("oculto");
                        document.getElementById("errorCampos").innerText = respuesta.mensaje || "Error Al crear Cateogira";

                }
            }
        }
    };
    let url = "../async/EditarCategoria.php?nombre=" + encodeURIComponent(nombre) + "&modificar=" + encodeURIComponent(modificar);

    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}
function eliminarCategoria(id) {
    Swal.fire({
        title: 'Eliminar categoría 🗂️',
        text: '¿Estás seguro de que quieres eliminar esta categoría?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar',
        customClass: {
            popup: 'steam-popup',
            confirmButton: 'steam-btn-primary',
            cancelButton: 'steam-btn-secondary'
        },
        buttonsStyling: false
    }).then((result) => {
        if (result.isConfirmed) {

            let xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    let respuesta = JSON.parse(this.responseText);
                    if (respuesta.exito) {
                        // Elimina la fila de la tabla sin recargar la página
                        let fila = document.getElementById("fila-" + id);
                        fila.parentNode.removeChild(fila);
                    } else {
                        alert(respuesta.mensaje);
                    }
                }
            };

            let url = "../async/eliminar_categoria.php?id=" + encodeURIComponent(id);
            xmlhttp.open("GET", url, true);
            xmlhttp.send();

        }
    });
}

function EliminarUsuario(id) {
    Swal.fire({
        title: 'Eliminar usuario 👤',
        text: '¿Estás seguro de que quieres eliminar este usuario?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar',
        customClass: {
            popup: 'steam-popup',
            confirmButton: 'steam-btn-primary',
            cancelButton: 'steam-btn-secondary'
        },
        buttonsStyling: false
    }).then((result) => {
        if (result.isConfirmed) {

            let xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    let respuesta = JSON.parse(this.responseText);
                    if (respuesta.exito) {
                        let fila = document.getElementById("fila-" + id);
                        fila.parentNode.removeChild(fila);
                    } else {
                        alert(respuesta.mensaje);
                    }
                }
            };

            let url = "../async/eliminar_Usuario.php?id=" + encodeURIComponent(id);
            xmlhttp.open("GET", url, true);
            xmlhttp.send();

        }
    });
}

function ModificarUsu(modificar) {
    limpiarErroresUsu();

    let xmlhttp = new XMLHttpRequest();

    let Usuario = document.getElementById("username").value.trim();
    let email = document.getElementById("email").value.trim();
    let pass = document.getElementById("password").value.trim();
    if (Usuario == "" || email == "" || pass == "" || modificar == "") {
        mostrarErrorUsu("campos_vacios", "Todos los campos son obligatorios");
        return;
    }

    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText)
            let respuesta = JSON.parse(this.responseText);


            if (respuesta.exito) {
                document.getElementById("errorCampos").classList.remove("oculto");
                document.getElementById("errorCampos").innerText = "¡Editado correctamente!";
                document.getElementById("errorCampos").style.color = "#66c0f4";
                document.getElementById("errorCampos").style.borderColor = "#66c0f4";
                document.getElementById("username").value = "";
                document.getElementById("email").value = "";
                document.getElementById("password").value = "";

                setTimeout(function () {
                    window.location.href = "../cuerpos/categorias.php";
                }, 2000);

            } else {
                ocultarTodosLosErroresUsu();

                switch (respuesta.error) {
                    case "campos_vacios":
                        document.getElementById("errorCampos").classList.remove("oculto");
                        document.getElementById("errorCampos").innerText = respuesta.mensaje;
                        break;
                    case "categoria_existe":
                        document.getElementById("errorNombre").classList.remove("oculto");
                        document.getElementById("errorNombre").innerText = respuesta.mensaje;
                        break;
                    default:
                        document.getElementById("errorCampos").classList.remove("oculto");
                        document.getElementById("errorCampos").innerText = respuesta.mensaje || "Error Al crear Cateogira";

                }
            }
        }
    };
    let url = "../async/Editar_Usuario.php?modificar=" + encodeURIComponent(modificar) + "&nombre=" + encodeURIComponent(Usuario) + "&email=" + encodeURIComponent(email) + "&contraseña=" + encodeURIComponent(pass);

    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}

function mostrarErrorUsu(tipo, mensaje) {
    ocultarTodosLosErroresUsu();
    switch (tipo) {
        case "campos_vacios":
            document.getElementById("errorCampos").classList.remove("oculto");
            document.getElementById("errorCampos").innerText = mensaje;
            break;
    }
}


function limpiarErroresUsu() {
    ocultarTodosLosErroresUsu();
    document.getElementById("errorCampos").style.color = "#ff4444";
    document.getElementById("errorCampos").style.borderColor = "#ff4444";
}


function ocultarTodosLosErroresUsu() {
    document.getElementById("errorCampos").classList.add("oculto");
    document.getElementById("errorUsuario").classList.add("oculto");
    document.getElementById("errorEmail").classList.add("oculto");
    document.getElementById("errorContrasena").classList.add("oculto");
}


//Funciones para el panel de juegos
function EliminarJuego(id) {
    Swal.fire({
        title: 'Eliminar juego 🎮',
        text: '¿Estás seguro de que quieres eliminar este juego?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar',
        customClass: {
            popup: 'steam-popup',
            confirmButton: 'steam-btn-primary',
            cancelButton: 'steam-btn-secondary'
        },
        buttonsStyling: false
    }).then((result) => {
        if (result.isConfirmed) {

            let xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                    let respuesta = JSON.parse(this.responseText);
                    if (respuesta.exito) {
                        let fila = document.getElementById("fila-" + id);
                        fila.parentNode.removeChild(fila);
                    } else {
                        alert(respuesta.mensaje);
                    }
                }
            };

            xmlhttp.open("POST", "../async/eliminar_juego.php", true);
            xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xmlhttp.send("id=" + encodeURIComponent(id));

        }
    });
}
function limpiarErroresJuegos() {
    document.getElementById("errorCampos").innerText = "";
    document.getElementById("errorCampos").classList.add("oculto");
    document.getElementById("errorTitulo").innerText = "";
    document.getElementById("errorTitulo").classList.add("oculto");
    document.getElementById("errorCampos").style.color = "#ff4444";
    document.getElementById("errorImagen").innerText = "";
    document.getElementById("errorImagen").classList.add("oculto");

}

function crearJuego() {
    limpiarErroresJuegos();

    let xmlhttp = new XMLHttpRequest();

    let titulo = document.getElementById("titulo").value.trim();
    let descripcion = document.getElementById("descripcion").value.trim();
    let precio = document.getElementById("precio").value;
    let imagenInput = document.getElementById("imagen");
    let ventas = document.getElementById("ventas").value;
    let stock = document.getElementById("stock").value
    if (titulo == "" || descripcion == "" || precio <= 0 || imagenInput.files.length == "") {
        mostrarError("Todos los campos son obligatorios");
        return;
    }
    //Para poder enviar los datos recogidos de los inputs como si fueran un formulario y recoger la ruta de la img con FILES
    let formData = new FormData();
    formData.append("titulo", titulo);
    formData.append("descripcion", descripcion);
    formData.append("precio", precio);
    formData.append("imagen", imagenInput.files[0]); // 👈 AQUÍ VA LA IMAGEN REAL
    formData.append("ventas", ventas);
    formData.append("stock", stock);

    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            let respuesta = JSON.parse(this.responseText);
            if (respuesta.exito) {
                document.getElementById("errorCampos").innerText = respuesta.mensaje;
                document.getElementById("errorCampos").classList.remove("oculto");
                document.getElementById("errorCampos").innerText = "¡Creacion completada con exito!";
                document.getElementById("errorCampos").style.color = "#66c0f4";
                document.getElementById("errorCampos").style.borderColor = "#66c0f4";

                document.getElementById("titulo").value = "";
                document.getElementById("descripcion").value = "";
                document.getElementById("precio").value = 0;
                document.getElementById("imagen").src = "";
                document.getElementById("ventas").value = 0;
                document.getElementById("stock").value = 0;

            } else {
                switch (respuesta.error) {
                    case "Juego_existe":
                        document.getElementById("errorTitulo").classList.remove("oculto");
                        document.getElementById("errorTitulo").innerText = respuesta.mensaje;
                        break;
                    case "campos_vacios":
                        document.getElementById("errorCampos").classList.remove("oculto");
                        document.getElementById("errorCampos").innerText = respuesta.mensaje;
                        break;
                    case "no_imagen":
                        document.getElementById("errorImagen").classList.remove("oculto");
                        document.getElementById("errorImagen").innerText = respuesta.mensaje;
                    case "imagen_grande":
                        document.getElementById("errorImagen").classList.remove("oculto");
                        document.getElementById("errorImagen").innerText = respuesta.mensaje;
                    case "dimensiones_invalidas":
                        document.getElementById("errorImagen").classList.remove("oculto");
                        document.getElementById("errorImagen").innerText = respuesta.mensaje;
                    default:
                        document.getElementById("errorCampos").innerText = respuesta.mensaje || "Error en la creacion del juego";
                }
            }
        }
    };
    //Enviamos el formdata sin la cabecera ya que el formdata se encarga de ello
    xmlhttp.open("POST", "../async/crearJuego.php", true);
    xmlhttp.send(formData);
}
function editarJuego(id) {
    limpiarErroresJuegos();

    let xmlhttp = new XMLHttpRequest();

    let titulo = document.getElementById("titulo").value.trim();
    let descripcion = document.getElementById("descripcion").value.trim();
    let precio = document.getElementById("precio").value;
    let imagenActual = document.getElementById("imagen_actual").value;
    let imagenInput = document.getElementById("imagen");
    let ventas = document.getElementById("ventas").value;
    let stock = document.getElementById("stock").value
    if (titulo == "" || descripcion == "" || precio <= 0) {
        mostrarError("Todos los campos son obligatorios");
        return;
    }
    //Para poder enviar los datos recogidos de los inputs como si fueran un formulario y recoger la ruta de la img con FILES
    let formData = new FormData();
    formData.append("titulo", titulo);
    formData.append("descripcion", descripcion);
    formData.append("precio", precio);
    if (imagenInput.files.length > 0) {
        formData.append("imagen", imagenInput.files[0]);
    } else {
        formData.append("imagen_actual", imagenActual);
    }
    formData.append("ventas", ventas);
    formData.append("stock", stock);
    formData.append("id", id);

    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            let respuesta = JSON.parse(this.responseText);
            if (respuesta.exito) {
                document.getElementById("errorCampos").innerText = respuesta.mensaje;
                document.getElementById("errorCampos").classList.remove("oculto");
                document.getElementById("errorCampos").innerText = "¡Edición completada con exito!";
                document.getElementById("errorCampos").style.color = "#66c0f4";

                document.getElementById("titulo").value = "";
                document.getElementById("descripcion").value = "";
                document.getElementById("precio").value = 0;
                document.getElementById("imagen").src = "";
                document.getElementById("ventas").value = 0;
                document.getElementById("stock").value = 0;
                window.location.href = "../cuerpos/juegos.php";

            } else {
                switch (respuesta.error) {
                    case "Juego_existe":
                        document.getElementById("errorTitulo").classList.remove("oculto");
                        document.getElementById("errorTitulo").innerText = respuesta.mensaje;
                        break;
                    case "campos_vacios":
                        document.getElementById("errorCampos").classList.remove("oculto");
                        document.getElementById("errorCampos").innerText = respuesta.mensaje;
                        break;
                    case "no_imagen":
                        document.getElementById("errorImagen").classList.remove("oculto");
                        document.getElementById("errorImagen").innerText = respuesta.mensaje;
                    case "imagen_grande":
                        document.getElementById("errorImagen").classList.remove("oculto");
                        document.getElementById("errorImagen").innerText = respuesta.mensaje;
                    case "dimensiones_invalidas":
                        document.getElementById("errorImagen").classList.remove("oculto");
                        document.getElementById("errorImagen").innerText = respuesta.mensaje;
                    default:
                        document.getElementById("errorCampos").innerText = respuesta.mensaje || "Error en la creacion del juego";
                }
            }
        }
    };
    //Enviamos el formdata sin la cabecera ya que el formdata se encarga de ello
    xmlhttp.open("POST", "../async/editarJuego.php", true);
    xmlhttp.send(formData);
}
function reembolsarPedido(idPedido) {

    Swal.fire({
        title: 'Reembolsar pedido',
        text: 'Introduce el motivo del reembolso',
        input: 'text',
        inputPlaceholder: 'Ej: Solicitud del cliente / error en compra',
        showCancelButton: true,
        confirmButtonText: 'Reembolsar',
        cancelButtonText: 'Cancelar',
        customClass: {
            popup: 'steam-popup',
            confirmButton: 'steam-btn-primary',
            cancelButton: 'steam-btn-secondary'
        },
        buttonsStyling: false,
        inputValidator: (value) => {
            if (!value) {
                return 'Debes introducir un motivo';
            }
        }
    }).then((result) => {

        if (!result.isConfirmed) return;

        let motivo = result.value;

        let xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {

                Swal.fire({
                    icon: 'success',
                    title: 'Reembolsado',
                    text: 'El pedido ha sido reembolsado correctamente'
                });

                setTimeout(() => {
                    location.reload();
                }, 1000);
            }
        };

        xmlhttp.open("POST", "./async/reembolso.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xmlhttp.send(
            "id_pedido=" + encodeURIComponent(idPedido) +
            "&motivo=" + encodeURIComponent(motivo)
        );
    });
}
function cerrarTicket(id_ticket) {
    Swal.fire({
        title: 'Cerrar ticket',
        text: '¿Seguro que quieres cerrar este ticket?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Cerrar ticket',
        cancelButtonText: 'Cancelar',
        customClass: {
            popup: 'steam-popup',
            confirmButton: 'steam-btn-primary',
            cancelButton: 'steam-btn-secondary'
        },
        buttonsStyling: false
    }).then((result) => {

        if (!result.isConfirmed) return;

        let xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {

                let data = JSON.parse(this.responseText);

                if (data.ok) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Ticket cerrado',
                        text: 'El ticket ha sido cerrado correctamente'
                    });

                    // Actualizar badge y botón sin recargar
                    document.querySelector("#fila-" + id_ticket + " .badge").className = "badge badge-resuelto";
                    document.querySelector("#fila-" + id_ticket + " .badge").textContent = "Cerrado";

                    let btn = document.querySelector("#fila-" + id_ticket + " .btn-danger");
                    btn.textContent = "Cerrado";
                    btn.classList.replace("btn-danger", "btn-secondary");
                    btn.disabled = true;
                    btn.onclick = null;
                }
            }
        };

        let params = "id_ticket=" + encodeURIComponent(id_ticket);

        xmlhttp.open("POST", "../async/cerrarTicket.php", true);
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlhttp.send(params);
    });
}
function Modificartema(modificar) {

    const titulo = document.getElementById("titulo").value.trim();
    const errorDiv = document.getElementById("errorCampos");

    // Validación cliente
    if (titulo === "" || modificar === "") {
        errorDiv.classList.remove("oculto");
        errorDiv.innerText = "Todos los campos son obligatorios";
        return;
    }

    // Construir FormData para POST
    const formData = new FormData();
    formData.append("titulo", titulo);
    formData.append("modificar", modificar);

    fetch("../async/editartema.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(respuesta => {
        if (respuesta.exito) {
            errorDiv.classList.remove("oculto");
            errorDiv.innerText = "¡Editado correctamente!";
            errorDiv.style.color = "#66c0f4";
            errorDiv.style.borderColor = "#66c0f4";
            document.getElementById("titulo").value = "";

            setTimeout(function () {
                window.location.href = "../cuerpos/foros.php";
            }, 2000);

        } else {
            ocultarTodosLosErroresCat();

            switch (respuesta.error) {
                case "campos_vacios":
                    errorDiv.classList.remove("oculto");
                    errorDiv.innerText = respuesta.mensaje;
                    break;
                default:
                    errorDiv.classList.remove("oculto");
                    errorDiv.innerText = "Error desconocido";
            }
        }
    })
    .catch(() => {
        errorDiv.classList.remove("oculto");
        errorDiv.innerText = "Error de conexión. Inténtalo de nuevo.";
    });
}

function eliminarTema(id_tema) {
    Swal.fire({
        title: 'Eliminar tema',
        text: '¿Seguro que quieres eliminar este tema? Se borrarán todos sus temas y mensajes.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar',
        customClass: {
            popup: 'steam-popup',
            confirmButton: 'steam-btn-primary',
            cancelButton: 'steam-btn-secondary'
        },
        buttonsStyling: false
    }).then((result) => {
        if (!result.isConfirmed) return;

        let xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                let data = JSON.parse(this.responseText);
                if (data.ok) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Foro eliminado',
                        text: 'El tema ha sido eliminado correctamente',
                        customClass: { popup: 'steam-popup' }
                    });
                    document.getElementById("fila-" + id_tema).remove();
                }
            }
        };

        xmlhttp.open("POST", "../async/eliminarTema.php", true);
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlhttp.send("id_tema=" + encodeURIComponent(id_tema));
    });
}