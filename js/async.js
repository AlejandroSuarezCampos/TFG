// Al cargar la página, activa el buscador con Enter (si existe) y carga el carrito
document.addEventListener("DOMContentLoaded", function () {
    const buscador = document.getElementById("buscador");

    if (buscador !== null) {
        buscador.addEventListener("keydown", function (e) {
            if (e.key === "Enter") {
                buscarJuego();
            }
        });
    }
    cargarCarrito();
});

// Filtra los juegos por categoría y vuelca el resultado en el visor
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

// Busca juegos por el texto del input y vuelca el resultado en el visor
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

// Valida el formulario de registro en cliente y envía los datos al servidor; gestiona los mensajes de error o éxito
function registrar() {
    limpiarErrores();

    let xmlhttp = new XMLHttpRequest();

    let nombre = document.getElementById("username").value.trim();
    let correo = document.getElementById("email").value.trim();
    let contrasena = document.getElementById("password").value;
    let contrasena2 = document.getElementById("confirm_password").value;

    if (nombre == "" || correo == "" || contrasena == "" || contrasena2 == "") {
        mostrarErrorRegistro("Todos los campos son obligatorios");
        return;
    }

    if (contrasena != contrasena2) {
        mostrarErrorRegistro("Las contraseñas no coinciden");
        return;
    }

    if (contrasena.length < 8) {
        mostrarErrorRegistro("La contraseña debe tener al menos 8 caracteres");
        return;
    }

    xmlhttp.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {
                            let respuesta = JSON.parse(this.responseText);
                            if (respuesta.exito) {
                    let msgExito = document.getElementById("errorCampos");
                    
                    msgExito.classList.remove("oculto");
                    msgExito.innerText = "¡Registro completado! Redirigiendo...";
                    msgExito.style.color = "#66c0f4";
                    msgExito.style.backgroundColor = "#1b5e8c";
                    msgExito.style.borderColor = "#66c0f4";

                    document.getElementById("username").value = "";
                    document.getElementById("email").value = "";
                    document.getElementById("password").value = "";
                    document.getElementById("confirm_password").value = "";

                    setTimeout(function () {
                        window.location.href = "login.php";
                    }, 2000);
                } else {
                switch (respuesta.error) {
                    case "campos_vacios":
                        document.getElementById("errorCampos").classList.remove("oculto");
                        document.getElementById("errorCampos").innerText = respuesta.mensaje;
                        break;
                    case "contrasenas_no_coinciden":
                        document.getElementById("errorContrasena2").classList.remove("oculto");
                        document.getElementById("errorContrasena2").innerText = respuesta.mensaje;
                        break;
                    case "contrasena_corta":
                        document.getElementById("errorContrasena").classList.remove("oculto");
                        document.getElementById("errorContrasena").innerText = respuesta.mensaje;
                        break;
                    case "correo_invalido":
                        document.getElementById("errorEmail").classList.remove("oculto");
                        document.getElementById("errorEmail").innerText = respuesta.mensaje;
                        break;
                    case "email_existe":
                        document.getElementById("errorEmail").classList.remove("oculto");
                        document.getElementById("errorEmail").innerText = respuesta.mensaje;
                        break;
                    default:
                        document.getElementById("errorCampos").innerText = respuesta.mensaje || "Error en el registro";
                }
            }
        }
    };

    xmlhttp.open("POST", "./async/registro.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send("nombre=" + encodeURIComponent(nombre) + "&correo=" + encodeURIComponent(correo) + "&contrasena=" + encodeURIComponent(contrasena) + "&contrasena2=" + encodeURIComponent(contrasena2));
}

// Muestra el mensaje de error de registro en el elemento correspondiente según el tipo de error
function mostrarErrorRegistro(cadena) {
    switch (cadena) {
        case "Todos los campos son obligatorios":
            document.getElementById("errorCampos").classList.remove("oculto");
            document.getElementById("errorCampos").innerText = cadena;
            break;
        case "Las contraseñas no coinciden":
            document.getElementById("errorContrasena2").classList.remove("oculto");
            document.getElementById("errorContrasena2").innerText = cadena;
            break;
        case "La contraseña debe tener al menos 8 caracteres":
            document.getElementById("errorContrasena").classList.remove("oculto");
            document.getElementById("errorContrasena").innerText = cadena;
            break;
    }
}

// Oculta y vacía todos los mensajes de error del formulario de registro
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

// Valida el formulario de login en cliente, envía las credenciales y gestiona la respuesta del servidor
function iniciarSesion() {
    limpiarErroresLogin();

    let xmlhttp = new XMLHttpRequest();

    let correo = document.getElementById("email").value.trim();
    let contrasena = document.getElementById("password").value.trim();

    if (correo == "" || contrasena == "") {
        mostrarErrorLogin("campos_vacios", "Todos los campos son obligatorios");
        return;
    }

    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let respuesta = JSON.parse(this.responseText);

            console.log("Respuesta del servidor:", respuesta);
            if (respuesta.exito) {
                document.getElementById("errorCampos").classList.remove("oculto");
                document.getElementById("errorCampos").innerText = "¡Login correcto! Redirigiendo...";
                document.getElementById("errorCampos").style.color = "#66c0f4";
                document.getElementById("errorCampos").style.borderColor = "#66c0f4";

                document.getElementById("email").value = "";
                document.getElementById("password").value = "";
                setTimeout(function () {
                    window.location.href = "index.php";
                }, 2000);

            } else {
                ocultarTodosLosErroresLogin();

                switch (respuesta.error) {
                    case "campos_vacios":
                        document.getElementById("errorCampos").classList.remove("oculto");
                        document.getElementById("errorCampos").innerText = respuesta.mensaje;
                        break;
                    case "correo_invalido":
                        document.getElementById("errorEmail").classList.remove("oculto");
                        document.getElementById("errorEmail").innerText = respuesta.mensaje;
                        break;
                    case "credenciales_incorrectas":
                        document.getElementById("errorCampos").classList.remove("oculto");
                        document.getElementById("errorCampos").innerText = respuesta.mensaje;
                        break;
                    case "usuario_no_encontrado":
                        document.getElementById("errorEmail").classList.remove("oculto");
                        document.getElementById("errorEmail").innerText = respuesta.mensaje;
                        break;
                    default:
                        document.getElementById("errorCampos").classList.remove("oculto");
                        document.getElementById("errorCampos").innerText = respuesta.mensaje || "Error en el login";
                }
            }
        }
    };

    let url = "./async/login.php?correo=" + encodeURIComponent(correo) + "&contrasena=" + encodeURIComponent(contrasena);

    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}

// Muestra el error de login en el elemento adecuado según el tipo recibido
function mostrarErrorLogin(tipo, mensaje) {
    ocultarTodosLosErroresLogin();

    switch (tipo) {
        case "campos_vacios":
            document.getElementById("errorCampos").classList.remove("oculto");
            document.getElementById("errorCampos").innerText = mensaje;
            break;
    }
}

// Oculta todos los errores del login y resetea el color del mensaje general
function limpiarErroresLogin() {
    ocultarTodosLosErroresLogin();
    document.getElementById("errorCampos").style.color = "#ff4444";
    document.getElementById("errorCampos").style.borderColor = "#ff4444";
}

// Oculta todos los divs de error del formulario de login
function ocultarTodosLosErroresLogin() {
    document.getElementById("errorCampos").classList.add("oculto");
    document.getElementById("errorEmail").classList.add("oculto");
    document.getElementById("errorContrasena").classList.add("oculto");
}

// Redirige al script de cierre de sesión
function logOut() {
    window.location.href = "/TFG/async/logOut.php";
}

// Pide al servidor el HTML del carrito y lo inyecta en el contenedor; luego recalcula el total
function cargarCarrito() {
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4) {
            if (xmlhttp.status === 200) {
                const campo = document.getElementById("carrito");
                if (!campo) return;
                console.log(xmlhttp.responseText);
                let data = JSON.parse(xmlhttp.responseText);

                campo.innerHTML = data.html;

                requestAnimationFrame(() => {
                    calcularTotal();
                });
            } else {
                console.error("Error al cargar carrito:", xmlhttp.status);
            }
        }
    };
    xmlhttp.open("POST", "./async/cargarCarrito.php", true);
    xmlhttp.setRequestHeader(
        "Content-Type",
        "application/x-www-form-urlencoded; charset=UTF-8"
    );
    xmlhttp.send("valor=1");
}

// Envía el id del juego y las horas al servidor para añadirlo al carrito; muestra confirmación con SweetAlert
function AnadirCarrito(id) {
    let xmlhttp = new XMLHttpRequest();
    let horas = document.getElementById('horas').value

    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(xmlhttp.responseText);
            respuesta = JSON.parse(xmlhttp.responseText);
            if (respuesta.ok) {
                document.getElementById("contador").textContent = respuesta.total;
                Swal.fire({
                    title: 'Juego añadido 🎮',
                    text: '¿Quieres ir al carrito?',
                    icon: 'success',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, ir al carrito',
                    cancelButtonText: 'Seguir comprando',
                    customClass: {
                        popup: 'steam-popup',
                        confirmButton: 'steam-btn-primary',
                        cancelButton: 'steam-btn-secondary'
                    },
                    buttonsStyling: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = './carrito.php';
                    } else {
                        cargarCarrito();
                    }
                });
            } else {
                alert(respuesta.msg);
            }
        }
    };

    xmlhttp.open("POST", "./async/ajax_carrito.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send("id=" + encodeURIComponent(id) + "&horas=" + horas);
}

// Suma los precios de todos los ítems del carrito y actualiza el total mostrado
function calcularTotal() {
    let total = 0;

    document.querySelectorAll('[id^="total-"]').forEach(el => {
        total += parseFloat(el.textContent);
    });

    let tot = document.getElementById("total-carrito-precio");
    if (tot) {
        tot.textContent = total.toFixed(2);
    }
}

// Devuelve el valor de horas corregido si está fuera del rango permitido
function validarHoras(valor) {
    valor = parseInt(valor);

    if (isNaN(valor)) return MIN_HORAS;
    if (valor < MIN_HORAS) return MIN_HORAS;
    if (valor > MAX_HORAS) return MAX_HORAS;

    return valor;
}

// Actualiza el contador de ítems del carrito en el icono del header
function actualizar_contador(num) {
    document.getElementById("contador").innerText = num;
}

// Elimina un juego del carrito y recarga el carrito y el total
function eliminarCarrito(id) {
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var respuesta = JSON.parse(xmlhttp.responseText);
            if (respuesta.ok) {
                document.getElementById("contador").textContent = respuesta.total;
                cargarCarrito();
                calcularTotal();


            } else {
                console.error(respuesta.msg);
            }
        }
    };
    xmlhttp.open("POST", "./async/eliminar_carrito.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send("id=" + encodeURIComponent(id));
}

// Escucha cambios en los inputs de horas del carrito, valida el valor y llama a actualizarCarrito
document.addEventListener("input", function (e) {

    if (e.target.classList.contains("horas-input")) {

        let id = e.target.dataset.id;

        let horas = validarHoras(e.target.value);

        e.target.value = horas;
        actualizarCarrito(id, horas);
    }
});

// Escucha los clics en los botones + y - del carrito, ajusta las horas respetando límites y llama a actualizarCarrito
document.addEventListener("click", function (e) {
    // BOTON +
    if (e.target.classList.contains("btn-mas")) {

        let id = e.target.dataset.id;
        let input = document.querySelector(`.horas-input[data-id="${id}"]`);

        let nuevoValor = parseInt(input.value) + 1;
        if (nuevoValor > 100) nuevoValor = 100;
        input.value = nuevoValor;

        actualizarCarrito(id, nuevoValor);
    }

    // BOTON -
    if (e.target.classList.contains("btn-menos")) {

        let id = e.target.dataset.id;
        let input = document.querySelector(`.horas-input[data-id="${id}"]`);

        let nuevoValor = parseInt(input.value) - 1;

        if (nuevoValor < 1) nuevoValor = 1;

        input.value = nuevoValor;

        actualizarCarrito(id, nuevoValor);
    }
});

// Envía las horas actualizadas al servidor y refresca el precio del juego y el total del carrito
function actualizarCarrito(id, horas) {
    let xmlhttp = new XMLHttpRequest();

    xmlhttp.onload = function () {
        if (xmlhttp.status === 200) {
            console.log(xmlhttp.responseText);
            let respuesta = JSON.parse(xmlhttp.responseText);
            console.log(respuesta);
            document.getElementById("total-" + id).innerText = respuesta.total_juego.toFixed(2);
            document.getElementById("total-carrito-precio").innerText = respuesta.total_precio.toFixed(2);
            document.getElementById("contador").innerText = respuesta.total_items;

        }
    };
    xmlhttp.open("POST", "./async/actualizar_carrito.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send("id=" + id + "&horas=" + horas);
}

// Incrementa o decrementa las horas del input de detalle de juego validando el rango
function cambiarHoras(valor) {
    let input = document.getElementById('horas');
    let nueva = parseInt(input.value) + valor;
    let horas = 0
    if (horas = validarHoras(nueva)) {
        input.value = horas;
    }
}

// Carga los mensajes de un tema del foro y construye el HTML de cada mensaje; muestra el botón eliminar solo a admins
function cargarMensajes(id_tema) {

    let xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function () {

        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(this.responseText);

            let html = "";

            data.forEach(m => {
                let foto = m.foto ? m.foto : "./img/default-user.png";

                let botonEliminar = m.es_admin ? `
                    <button 
                        onclick="eliminarMensaje(${m.id_respuesta})"
                        class="btn btn-danger btn-sm">
                        Eliminar
                    </button>` : "";

                html += `
                <div class="card game-card mb-2">
                    <div class="card-body d-flex gap-3 align-items-start">
                        <img src="${foto}" 
                            class="rounded-circle"
                            width="45" height="45"
                            style="object-fit: cover;">
                        <div class="flex-grow-1">
                            <strong>${m.nombre}</strong><br>
                            <small class="forum-date">${m.fecha_respuesta}</small>
                            <p class="mb-0">${m.contenido}</p>
                        </div>
                        ${botonEliminar}
                    </div>
                </div>`;
            });

            document.querySelector(".forum-messages-list").innerHTML = html;
        }
    };

    xmlhttp.open("GET", "./async/cargarMensajes.php?id=" + id_tema, true);
    xmlhttp.send();
}

// Pide confirmación con SweetAlert y elimina un mensaje del foro recargando la lista tras el borrado
function eliminarMensaje(id_respuesta) {
    Swal.fire({
        title: 'Eliminar mensaje',
        text: '¿Seguro que quieres eliminar este mensaje?',
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

        const id_tema = document.querySelector(".forum-messages-list").dataset.tema;

        let xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                let data = JSON.parse(this.responseText);
                if (data.ok) {
                    cargarMensajes(id_tema);
                } else {
                    alert("Error al eliminar: " + data.error);
                }
            }
        };
        xmlhttp.open("POST", "./async/eliminarMensaje.php", true);
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlhttp.send("id=" + id_respuesta);
    });
}

// Valida que el textarea no esté vacío y envía el mensaje al foro recargando la lista tras el envío
function enviarMensaje(id_tema){

    let contenido = document.getElementById("mensaje").value.trim();
    let error = document.getElementById("errorMensaje");

    error.style.display = "none";

    if (contenido === "") {
        error.style.display = "block";
        return;
    }

    let xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function () {

        if (this.readyState == 4 && this.status == 200) {

            let data = JSON.parse(this.responseText);

            if (data.ok) {
                document.getElementById("mensaje").value = "";
                cargarMensajes(id_tema);
            }
        }
    };

    xmlhttp.open("POST", "./async/enviarMensaje.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xmlhttp.send(
        "id_tema=" + id_tema +
        "&contenido=" + encodeURIComponent(contenido)
    );
}

// Valida el mensaje y lo envía al ticket de soporte; recarga los mensajes del ticket tras el envío
function enviarMensajeTicket(id_ticket) {

    let contenido = document.getElementById("mensaje").value.trim();
    let error = document.getElementById("errorMensaje");

    error.style.display = "none";

    if (contenido === "") {
        error.style.display = "block";
        return;
    }

    let xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            let data = JSON.parse(this.responseText);

            if (data.ok) {
                document.getElementById("mensaje").value = "";
                cargarMensajesTicket(id_ticket, ID_USUARIO_ACTUAL);
            }
        }
    };

    let respuesta = "id_ticket=" + encodeURIComponent(id_ticket)
               + "&mensaje=" + encodeURIComponent(contenido);

    xmlhttp.open("POST", "./async/enviarMensajeticket.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send(respuesta);
}

// Carga los mensajes de un ticket y los renderiza como burbujas de chat diferenciando los propios de los ajenos
function cargarMensajesTicket(id_ticket, id_usuario_actual) {
    let xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            let mensajes = JSON.parse(this.responseText);
            let contenedor = document.querySelector(".forum-messages");

            let estabaAbajo = contenedor.scrollTop + contenedor.clientHeight >= contenedor.scrollHeight - 10;

            let html = "";

            mensajes.forEach(function (msg) {
                let esMio = msg.id_usuario == id_usuario_actual;

                html += `
                    <div class="d-flex ${esMio ? 'justify-content-end' : 'justify-content-start'} mb-3">
                        <div style="max-width: 70%;">
                            <div class="mb-1 ${esMio ? 'text-end' : ''}">
                                <small class="text-secondary">${esMio ? 'Tú' : msg.nombre} · ${msg.fecha}</small>
                            </div>
                            <div class="chat-bubble ${esMio ? 'chat-bubble--mine' : 'chat-bubble--other'}">
                                ${msg.mensaje}
                            </div>
                        </div>
                    </div>
                `;
            });

            contenedor.innerHTML = html;

            if (estabaAbajo) {
                setTimeout(function() {
                    contenedor.scrollTop = contenedor.scrollHeight;
                }, 50);
            }
        }
    };

    let params = "id=" + encodeURIComponent(id_ticket);

    xmlhttp.open("POST", "./async/cargarMensajesTicket.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(params);
}

// Escucha el clic en el botón pagar, muestra un loading y redirige a Stripe; gestiona errores de stock u otros
document.addEventListener('click', function (e) {
    if (e.target && e.target.id === 'pagar') {
        Swal.fire({
            title: 'Redirigiendo al pago...',
            html: 'Conectando con la pasarela segura',
            allowOutsideClick: false,
            allowEscapeKey: false,
            showConfirmButton: false,
            customClass: {
                popup: 'steam-popup',
            },
            didOpen: () => {
                Swal.showLoading();
            }
        });
        let xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4) {
                if (xmlhttp.status === 200) {
                    let data = JSON.parse(xmlhttp.responseText);
                    if (data.url) {
                        setTimeout(() => {
                            window.location.href = data.url;
                        }, 3000);
                    } else {
                        let mensaje = "Ha ocurrido un error inesperado";
                        if (data.type === "stock") {
                            mensaje = data.message;
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: mensaje,
                            confirmButtonText: 'Volver al carrito',
                            customClass: {
                                popup: 'steam-popup',
                            },
                        }).then(() => {
                            window.location.href = '/TFG/carrito.php';
                        });
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error del servidor',
                        text: 'Inténtalo de nuevo más tarde',
                        customClass: {
                            popup: 'steam-popup',
                        },
                    });
                }
            }
        };
        xmlhttp.open("POST", "./async/checkout.php", true);
        xmlhttp.setRequestHeader(
            "Content-Type",
            "application/x-www-form-urlencoded"
        );
        xmlhttp.send();
    }
});

// Valida el formulario de cambio de contraseña en cliente y envía la nueva al servidor
function cambiarPassword() {
    limpiarErroresPerfil();

    let nueva = document.getElementById("nueva").value;
    let repetir = document.getElementById("repetir").value;

    if (nueva === "" || repetir === "") {
        mostrarError("campos_vacios", "Todos los campos son obligatorios");
        return;
    }
    if (nueva !== repetir) {
        mostrarError("contrasenas_no_coinciden", "Las contraseñas no coinciden");
        return;
    }
    if (nueva.length < 8) {
        mostrarError("contrasena_corta", "La contraseña debe tener al menos 8 caracteres");
        return;
    }

    let xmlhttp = new XMLHttpRequest();
    let url = "./async/cambiarContrasena.php" + "?nueva=" + encodeURIComponent(nueva) + "&repetir=" + encodeURIComponent(repetir);

    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let respuesta = JSON.parse(this.responseText);

            if (respuesta.exito) {
                let exito = document.getElementById("exito");
                exito.innerText = respuesta.mensaje;
                exito.classList.remove("oculto");

                document.getElementById("nueva").value = "";
                document.getElementById("repetir").value = "";
            } else {
                switch (respuesta.error) {
                    case "campos_vacios":
                        mostrarError("campos_vacios", respuesta.mensaje);
                        break;
                    case "contrasenas_no_coinciden":
                        mostrarError("contrasenas_no_coinciden", respuesta.mensaje);
                        break;
                    case "contrasena_corta":
                        mostrarError("contrasena_corta", respuesta.mensaje);
                        break;
                    default:
                        mostrarError("campos_vacios", respuesta.mensaje || "Error desconocido");
                }
            }
        }
    };

    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}

// Muestra el mensaje de error del perfil en el elemento correcto según el tipo
function mostrarError(tipo, mensaje) {
    switch (tipo) {
        case "campos_vacios":
            document.getElementById("errorCampos").innerText = mensaje;
            document.getElementById("errorCampos").classList.remove("oculto");
            break;
        case "contrasena_corta":
            document.getElementById("errorContrasena").innerText = mensaje;
            document.getElementById("errorContrasena").classList.remove("oculto");
            break;
        case "contrasenas_no_coinciden":
            document.getElementById("errorRepetir").innerText = mensaje;
            document.getElementById("errorRepetir").classList.remove("oculto");
            break;
    }
}

// Oculta y vacía todos los mensajes de error y éxito del formulario de perfil
function limpiarErroresPerfil() {
  ["errorCampos", "errorContrasena", "errorRepetir", "exito"].forEach(id => {
    let el = document.getElementById(id);
    el.innerText = "";
    el.classList.add("oculto");
  })
}

// Envía el código de activación al servidor y muestra el resultado en el div correspondiente
function activarCodigo() {
  let codigo    = document.getElementById('codigo').value.trim();
  let errorDiv  = document.getElementById('errorCodigo');
  let exitoDiv  = document.getElementById('exitoCodigo');

  errorDiv.classList.add('oculto');
  exitoDiv.classList.add('oculto');

  if (!codigo) {
    errorDiv.textContent = 'Introduce un código.';
    errorDiv.classList.remove('oculto');
    return;
  }

  let url = "./async/activarCodigo.php?codigo=" + encodeURIComponent(codigo);

  let xhr = new XMLHttpRequest();
  xhr.open("GET", url, true);

  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      let data = JSON.parse(xhr.responseText);

      if (data.ok) {
        exitoDiv.textContent = '¡Alquiler activado correctamente!';
        exitoDiv.classList.remove('oculto');
        document.getElementById('codigo').value = '';
      } else {
        errorDiv.textContent = data.error || 'Código inválido.';
        errorDiv.classList.remove('oculto');
      }
    }
  };

  xhr.send();
}

// Recoge los filtros de texto, categoría y precio, los envía al servidor y vuelca el resultado en el visor
function filtrar() {
    let texto    = document.getElementById("buscador").value.trim();
    let categoria = document.getElementById("filtroCat").value;
    let precio    = document.getElementById("filtroPrecio").value;
 
    let xmlhttp = new XMLHttpRequest();
 
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let visor = document.getElementById("visorJuegos");
            let sinResultados = document.getElementById("sinResultados");
 
            visor.innerHTML = this.responseText;
 
            if (visor.innerHTML.trim() === "") {
                visor.classList.add("oculto");
                sinResultados.classList.remove("oculto");
            } else {
                visor.classList.remove("oculto");
                sinResultados.classList.add("oculto");
            }
        }
    };
    xmlhttp.open("GET", "./async/filtrar.php?texto=" + encodeURIComponent(texto) + "&categoria=" + categoria + "&precio=" + precio, true);
    xmlhttp.send();
}

// Pide confirmación y elimina un tema del foro junto con todos sus mensajes; redirige al foro tras el borrado
function eliminarTema(id_tema) {
    Swal.fire({
        title: 'Eliminar tema',
        text: '¿Seguro que quieres eliminar este tema? Se borrarán todos los mensajes.',
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
                        title: 'Tema eliminado',
                        text: 'El tema ha sido eliminado correctamente'
                    }).then(() => {
                        window.location.href = "foro.php";
                    });
                }
            }
        };

        xmlhttp.open("POST", "async/eliminarTema.php", true);
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlhttp.send("id_tema=" + encodeURIComponent(id_tema));
    });
  }

// Valida que el título no esté vacío y envía el nuevo título del tema al servidor; redirige al foro tras editar
function Modificartema(modificar) {

    let titulo = document.getElementById("titulo").value.trim();
    let errorDiv = document.getElementById("errorCampos");

    if (titulo === "" || modificar === "") {
        errorDiv.classList.remove("oculto");
        errorDiv.innerText = "Todos los campos son obligatorios";
        return;
    }
    let formData = new FormData();
    formData.append("titulo", titulo);
    formData.append("modificar", modificar);

    fetch("./async/editartema.php", {
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
                window.location.href = "foro.php";
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

// Pide confirmación con SweetAlert y envía un formulario POST para eliminar la cuenta del usuario
function confirmarBorrarCuenta() {
    Swal.fire({
        title: 'Eliminar cuenta',
        text: '¿Seguro que quieres eliminar tu cuenta? Esta acción no se puede deshacer.',
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

        let form = document.createElement('form');
        form.method = 'POST';
        form.action = '';
        let input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'borrar';
        input.value = '1';
        form.appendChild(input);
        document.body.appendChild(form);
        form.submit();
    });
}

// Busca temas del foro por título y vuelca el resultado en el visor; muestra aviso si no hay resultados
function buscarTema() {
    const texto = document.getElementById("buscadorTema").value.trim();

    const xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const visor = document.getElementById("visorTemas");
            const sinResultados = document.getElementById("sinResultados");

            visor.innerHTML = this.responseText;

            if (visor.innerHTML.trim() === "") {
                visor.classList.add("oculto");
                sinResultados.classList.remove("oculto");
            } else {
                visor.classList.remove("oculto");
                sinResultados.classList.add("oculto");
            }
        }
    };

    xmlhttp.open("GET", "./async/buscarTema.php?texto=" + encodeURIComponent(texto), true);
    xmlhttp.send();
}