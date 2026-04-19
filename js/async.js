/*document.addEventListener("DOMContentLoaded", function(){
    document.getElementById("buscador").addEventListener("keydown", function(e){
        if (e.key === "Enter") {
            buscarJuego();
        }
    });
});
*/
document.addEventListener("DOMContentLoaded", function(){
    const buscador = document.getElementById("buscador");

    if (buscador !== null) {
        buscador.addEventListener("keydown", function(e){
            if (e.key === "Enter") {
                buscarJuego();
            }
        });
    }
    cargarCarrito();
});

function filtrarCat(id){
    let xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
        if(this.readyState==4 && this.status==200){
            document.getElementById("visorJuegos").innerHTML=this.responseText;
        }
    };

    xmlhttp.open("GET", "./async/filtrarCat.php?id="+id, true);
    xmlhttp.send();
}

function buscarJuego(){
    let xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
        if(this.readyState==4 && this.status==200){
            document.getElementById("visorJuegos").innerHTML=this.responseText;
        }
    };

    let texto = document.getElementById("buscador").value;
		if(texto!=""){
		  xmlhttp.open("GET","./async/buscarJuego.php?texto="+texto);
		  xmlhttp.send();
		}else{
		  let capa = document.getElementById("results");
		  capa.innerText="Error al Buscar";
		}
}

function registrar(){
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

    xmlhttp.onreadystatechange = function() {
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

                setTimeout(function() {
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

    let url="./async/registro.php?nombre="+encodeURIComponent(nombre)+"&correo=" + encodeURIComponent(correo)+"&contrasena=" + encodeURIComponent(contrasena)+"&contrasena2=" + encodeURIComponent(contrasena2);
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

    let xmlhttp=new XMLHttpRequest();

    let correo=document.getElementById("email").value.trim();
    let contrasena=document.getElementById("password").value.trim();

    if(correo=="" || contrasena==""){
        mostrarErrorLogin("campos_vacios", "Todos los campos son obligatorios");
        return;
    }

    xmlhttp.onreadystatechange=function(){
        if (this.readyState==4 && this.status==200) {

            let respuesta=JSON.parse(this.responseText);
            
            console.log("Respuesta del servidor:", respuesta);
            
            if(respuesta.exito){
                document.getElementById("errorCampos").classList.remove("oculto");
                document.getElementById("errorCampos").innerText="¡Login correcto! Redirigiendo...";
                document.getElementById("errorCampos").style.color="#66c0f4";
                document.getElementById("errorCampos").style.borderColor="#66c0f4";

                document.getElementById("email").value="";
                document.getElementById("password").value="";

                setTimeout(function(){
                    window.location.href="index.php";
                }, 2000);
                
            } else {
                ocultarTodosLosErroresLogin();

                switch(respuesta.error){
                    case "campos_vacios":
                        document.getElementById("errorCampos").classList.remove("oculto");
                        document.getElementById("errorCampos").innerText = respuesta.mensaje;
                        break;
                    case "correo_invalido":
                        document.getElementById("errorEmail").classList.remove("oculto");
                        document.getElementById("errorEmail").innerText=respuesta.mensaje;
                        break;
                    case "credenciales_incorrectas":
                        document.getElementById("errorCampos").classList.remove("oculto");
                        document.getElementById("errorCampos").innerText=respuesta.mensaje;
                        break;
                    case "usuario_no_encontrado":
                        document.getElementById("errorEmail").classList.remove("oculto");
                        document.getElementById("errorEmail").innerText=respuesta.mensaje;
                        break;
                    default:
                        document.getElementById("errorCampos").classList.remove("oculto");
                        document.getElementById("errorCampos").innerText=respuesta.mensaje || "Error en el login";
                }
            }
        }
    };

    let url="./async/login.php?correo=" + encodeURIComponent(correo)+"&contrasena="+encodeURIComponent(contrasena);
    
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}

function mostrarErrorLogin(tipo, mensaje){
    ocultarTodosLosErroresLogin();
    
    switch(tipo){
        case "campos_vacios":
            document.getElementById("errorCampos").classList.remove("oculto");
            document.getElementById("errorCampos").innerText = mensaje;
            break;
    }
}

function limpiarErroresLogin(){
    ocultarTodosLosErroresLogin();
    document.getElementById("errorCampos").style.color = "#ff4444";
    document.getElementById("errorCampos").style.borderColor = "#ff4444";
}


function ocultarTodosLosErroresLogin(){
    document.getElementById("errorCampos").classList.add("oculto");
    document.getElementById("errorEmail").classList.add("oculto");
    document.getElementById("errorContrasena").classList.add("oculto");
}

function logOut(){
    let xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
        if (this.readyState==4 && this.status==200) {
            document.location.reload();
        }
    };

    xmlhttp.open("GET", "./async/logOut.php", true);
    xmlhttp.send();
}

//Funciones para carrito


function cargarCarrito(){
     let xmlhttp= new XMLHttpRequest();
            xmlhttp.onreadystatechange=function(){
                 if(this.readyState==4 && this.status==200){
                    let campo=document.getElementById("carrito");
                    if(campo){
                    campo.innerHTML=this.responseText;
                    }
                    calcularTotal();

                 }
            };
            var valor=1;
            var variable="valor="+valor;
            xmlhttp.open("POST","./async/cargarCarrito.php",true);
            xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
            xmlhttp.send(variable);
}

function AnadirCarrito(id){
    let xmlhttp = new XMLHttpRequest();
    let horas=document.getElementById('horas').value
    //alert(`El id del juego esss: ${id} y lo alquilaste por ${horas} horas`); 

    xmlhttp.onreadystatechange = function() {
        if (this.readyState==4 && this.status==200) {
            console.log(xmlhttp.responseText);
            respuesta=JSON.parse(xmlhttp.responseText);
            if (respuesta.ok){
                document.getElementById("contador").textContent = respuesta.total;
                if(confirm("Juego añadido al carrito.\n\n¿Desea ir al carrito?")){
                    window.location.href="./carrito.php";
                    cargarCarrito();
                }
            }else{
                alert(respuesta.msg);
            }
        }
    };

    xmlhttp.open("POST", "./async/ajax_carrito.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send("id="+ encodeURIComponent(id)+"&horas="+horas);
}
function calcularTotal() {
    let total = 0;

    document.querySelectorAll('[id^="total-"]').forEach(el => {
        total += parseFloat(el.textContent);
    });

    let tot=document.getElementById("total-carrito-precio");
    if (tot){
        tot.textContent= total.toFixed(2);
    }
}

function eliminarCarrito(id){
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState==4 && this.status==200) {
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
    xmlhttp.send("id="+ encodeURIComponent(id));
}
document.addEventListener("change", function (e) {
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
});