/*document.addEventListener("DOMContentLoaded", function(){
    document.getElementById("buscador").addEventListener("keydown", function(e){
        if (e.key === "Enter") {
            buscarJuego();
        }
    });
});
*/
const MIN_HORAS = 1;
const MAX_HORAS = 50;
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

function registrar() {
    limpiarErrores();

    let xmlhttp = new XMLHttpRequest();

    let nombre = document.getElementById("username").value.trim();
    let correo = document.getElementById("email").value.trim();
    let contrasena = document.getElementById("password").value;
    let contrasena2 = document.getElementById("confirm_password").value;

    if (nombre == "" || correo == "" || contrasena == "" || contrasena2 == "") {
        mostrarError("Todos los campos son obligatorios");
        return;
    }

    if (contrasena != contrasena2) {
        mostrarError("Las contraseñas no coinciden");
        return;
    }

    if (contrasena.length < 8) {
        mostrarError("La contraseña debe tener al menos 8 caracteres");
        return;
    }

    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            //console.log(xmlhttp.responseText);
            let respuesta = JSON.parse(this.responseText);
            if (respuesta.exito) {
                document.getElementById("errorCampos").innerText = respuesta.mensaje;
                document.getElementById("errorCampos").innerText = "¡Registro completado! Redirigiendo...";
                document.getElementById("errorCampos").style.color = "#66c0f4";

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

    let url = "./async/registro.php?nombre=" + encodeURIComponent(nombre) + "&correo=" + encodeURIComponent(correo) + "&contrasena=" + encodeURIComponent(contrasena) + "&contrasena2=" + encodeURIComponent(contrasena2);
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
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
            //console.log(this.responseText);
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

function mostrarErrorLogin(tipo, mensaje) {
    ocultarTodosLosErroresLogin();

    switch (tipo) {
        case "campos_vacios":
            document.getElementById("errorCampos").classList.remove("oculto");
            document.getElementById("errorCampos").innerText = mensaje;
            break;
    }
}

function limpiarErroresLogin() {
    ocultarTodosLosErroresLogin();
    document.getElementById("errorCampos").style.color = "#ff4444";
    document.getElementById("errorCampos").style.borderColor = "#ff4444";
}


function ocultarTodosLosErroresLogin() {
    document.getElementById("errorCampos").classList.add("oculto");
    document.getElementById("errorEmail").classList.add("oculto");
    document.getElementById("errorContrasena").classList.add("oculto");
}

function logOut() {
    let xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.location.reload();
        }
    };

    xmlhttp.open("GET", "./async/logOut.php", true);
    xmlhttp.send();
}

//Funciones para carrito


function cargarCarrito() {
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4) {
            if (xmlhttp.status === 200) {
                const campo = document.getElementById("carrito");
                if (!campo) return;

                // 🔥 AQUÍ está la clave
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
    // solo si realmente lo necesitas
    xmlhttp.send("valor=1");
}
function AnadirCarrito(id) {
    let xmlhttp = new XMLHttpRequest();
    let horas = document.getElementById('horas').value
    //alert(`El id del juego esss: ${id} y lo alquilaste por ${horas} horas`); 

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
function validarHoras(valor) {
    valor = parseInt(valor);

    if (isNaN(valor)) return MIN_HORAS;
    if (valor < MIN_HORAS) return MIN_HORAS;
    if (valor > MAX_HORAS) return MAX_HORAS;

    return valor;
}
function actualizar_contador(num) {
    document.getElementById("contador").innerText = num;
}
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
/*document.addEventListener("change", function (e) {
    if (e.target.classList.contains("horas-input")) {
        let id = e.target.dataset.id;
        let horas = e.target.value;

        let xmlhttp = new XMLHttpRequest();

        xmlhttp.onload = function () {
            if (xmlhttp.status === 200) {
                console.log(xmlhttp.responseText);
                let respuesta = JSON.parse(xmlhttp.responseText);
                document.getElementById("total-" + id).innerText = respuesta.total_juego.toFixed(2);
                document.getElementById("total-carrito-precio").innerText = respuesta.total_precio.toFixed(2);

            }
        };
        xmlhttp.open("POST", "./async/actualizar_carrito.php", true);
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlhttp.send("id=" + id + "&horas=" + horas);
    }
});*/
//Escuchador para el manejo manual de las horas en el input de las horas en carrito
document.addEventListener("input", function (e) {

    if (e.target.classList.contains("horas-input")) {

        let id = e.target.dataset.id;

        let horas = validarHoras(e.target.value);

        // 🔥 corregimos el input si se pasa
        e.target.value = horas;
        actualizarCarrito(id, horas);
    }
});
//Evento para los botones de sumar o restar horas en carrito
document.addEventListener("click", function (e) {
    //BOTON +
    if (e.target.classList.contains("btn-mas")) {

        let id = e.target.dataset.id;
        let input = document.querySelector(`.horas-input[data-id="${id}"]`);

        input.value = parseInt(input.value) + 1;
        //input.dispatchEvent(new Event("input"));

        actualizarCarrito(id, input.value);
    }

    // BOTON -
    if (e.target.classList.contains("btn-menos")) {

        let id = e.target.dataset.id;
        let input = document.querySelector(`.horas-input[data-id="${id}"]`);

        let nuevoValor = parseInt(input.value) - 1;

        if (nuevoValor < 1) nuevoValor = 1;

        input.value = nuevoValor;
        //input.dispatchEvent(new Event("input"));

        actualizarCarrito(id, nuevoValor);
    }
});
function actualizarCarrito(id, horas) {
    let xmlhttp = new XMLHttpRequest();

    xmlhttp.onload = function () {
        if (xmlhttp.status === 200) {
            console.log(xmlhttp.responseText);
            let respuesta = JSON.parse(xmlhttp.responseText);
            console.log(respuesta); // 👈 DEBUG IMPORTANTE

            document.getElementById("total-" + id).innerText = respuesta.total_juego.toFixed(2);
            document.getElementById("total-carrito-precio").innerText = respuesta.total_precio.toFixed(2);
            document.getElementById("contador").innerText = respuesta.total_items;

        }
    };
    xmlhttp.open("POST", "./async/actualizar_carrito.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send("id=" + id + "&horas=" + horas);
}
function cambiarHoras(valor) {
    let input = document.getElementById('horas');
    let nueva = parseInt(input.value) + valor;

    if (nueva >= 1 && nueva <= 50) {
        input.value = nueva;
    }
        let xmlhttp = new XMLHttpRequest();

        xmlhttp.onload = function () {
            if (xmlhttp.status === 200) {
                console.log(xmlhttp.responseText);
                let respuesta = JSON.parse(xmlhttp.responseText);
                 console.log(respuesta); // 👈 DEBUG IMPORTANTE

                document.getElementById("total-" + id).innerText = respuesta.total_juego.toFixed(2);
                document.getElementById("total-carrito-precio").innerText = respuesta.total_precio.toFixed(2);
                document.getElementById("contador").innerText=respuesta.total_items;

            }
        };
        xmlhttp.open("POST", "./async/actualizar_carrito.php", true);
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlhttp.send("id=" + id + "&horas=" + input.value);
}
function cambiarHoras(valor) {
  let input = document.getElementById('horas');
  let nueva = parseInt(input.value) + valor;

  if (nueva >= 1 && nueva <= 50) {
    input.value = nueva;
  }
}

function cargarMensajes(id_tema){

    let xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function () {

        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(this.responseText);

            let html = "";

            data.forEach(m => {

                let foto = m.foto ? m.foto : "./img/default-user.png";

                html += `
                <div class="card game-card mb-2">
                    <div class="card-body d-flex gap-3 align-items-start">

                        <img src="${foto}" 
                            class="rounded-circle"
                            width="45" height="45"
                            style="object-fit: cover;">

                        <div>
                            <strong>${m.nombre}</strong><br>
                            <small class="forum-date">${m.fecha_respuesta}</small>
                            <p class="mb-0">${m.contenido}</p>
                        </div>

                    </div>
                </div>`;
            });

            document.querySelector(".forum-messages").innerHTML = html;
        }
    };

    xmlhttp.open("GET", "./async/cargarMensajes.php?id=" + id_tema, true);
    xmlhttp.send();
}

function enviarMensaje(id_tema){

    let contenido = document.getElementById("mensaje").value.trim();
    let error = document.getElementById("errorMensaje");

    // reset error
    error.style.display = "none";

    if(contenido === ""){
        error.style.display = "block";
        return;
    }

    let xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function () {

        if (this.readyState == 4 && this.status == 200) {

            let data = JSON.parse(this.responseText);

            if(data.ok){
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
/*function cambiarHorasCarrito(valor,id) {
  let input = document.querySelector(`.horas-input[data-id="${id}"]`);
  let nueva = parseInt(input.value) + valor;

  if (nueva >= 1 && nueva <= 50) {
    input.value = nueva;
  }
}*/
document.addEventListener('click', function (e) {
    if (e.target && e.target.id === 'pagar') {
        // Mostrar loading
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
                    console.log(xmlhttp.responseText);
                    let data = JSON.parse(xmlhttp.responseText);
                    if (data.url) {
                        // Pequeña espera para que se vea el efecto
                        setTimeout(() => {
                            window.location.href = data.url;
                        }, 3000);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.error || 'No se pudo iniciar el pago',
                              customClass: {
                                popup: 'steam-popup',
                            },
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

function cambiarPassword() {
  limpiarErrores();

  let nueva   = document.getElementById("nueva").value;
  let repetir = document.getElementById("repetir").value;

  // Validaciones en cliente
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

  // Petición asíncrona
  let xmlhttp = new XMLHttpRequest();
  let url = "./async/cambiarContrasena.php"+"?nueva="+encodeURIComponent(nueva)+"&repetir="+encodeURIComponent(repetir);

  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      let respuesta = JSON.parse(this.responseText);

      if (respuesta.exito) {
        let exito = document.getElementById("exito");
        exito.innerText = respuesta.mensaje;
        exito.classList.remove("oculto");

        document.getElementById("nueva").value   = "";
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

function limpiarErrores() {
  ["errorCampos", "errorContrasena", "errorRepetir", "exito"].forEach(id => {
    let el = document.getElementById(id);
    el.innerText = "";
    el.classList.add("oculto");
  });
}
