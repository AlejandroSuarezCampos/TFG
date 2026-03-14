document.addEventListener("DOMContentLoaded", function(){
    document.getElementById("buscador").addEventListener("keydown", function(e){
        if (e.key === "Enter") {
            buscarJuego();
        }
    });
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

    let xmlhttp=new XMLHttpRequest();

    let nombre=document.getElementById("nombre").value.trim();
    if(nombre==""){
        mostrarErrorCat("campos_vacios", "Todos los campos son obligatorios");
        return;
    }
        
        xmlhttp.onreadystatechange=function(){
            if (this.readyState==4 && this.status==200) {
                let respuesta=JSON.parse(this.responseText);
                
                
                if(respuesta.exito){
                    document.getElementById("errorCampos").classList.remove("oculto");
                    document.getElementById("errorCampos").innerText="¡Creado correctamente!";
                    document.getElementById("errorCampos").style.color="#66c0f4";
                    document.getElementById("errorCampos").style.borderColor="#66c0f4";


                    document.getElementById("nombre").value="";
                
                    
                }else{
                    ocultarTodosLosErroresCat();

                    switch(respuesta.error){
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
                             document.getElementById("errorCampos").innerText=respuesta.mensaje || "Error Al crear Cateogira";

                }
            }
        }
        };
        let url="../async/crearCategoria.php?nombre=" + encodeURIComponent(nombre);
        
        xmlhttp.open("GET", url, true);
        xmlhttp.send();
    }


function mostrarErrorCat(tipo, mensaje){
    ocultarTodosLosErroresCat();
    switch(tipo){
        case "campos_vacios":
            document.getElementById("errorCampos").classList.remove("oculto");
            document.getElementById("errorCampos").innerText = mensaje;
            break;
    }
}


function limpiarErroresCat(){
    ocultarTodosLosErroresCat();
    document.getElementById("errorCampos").style.color = "#ff4444";
    document.getElementById("errorCampos").style.borderColor = "#ff4444";
}


function ocultarTodosLosErroresCat(){
    document.getElementById("errorCampos").classList.add("oculto");
    document.getElementById("errorNombre").classList.add("oculto");
}


function crearUsu(){
    limpiarErrores();

    let xmlhttp = new XMLHttpRequest();

    let nombre = document.getElementById("username").value.trim();
    let correo = document.getElementById("email").value.trim();
    let contrasena = document.getElementById("password").value;
    if (nombre == "" || correo == "" || contrasena == "") {
        mostrarError("Todos los campos son obligatorios");
        return;
    }

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let respuesta = JSON.parse(this.responseText);
            if (respuesta.exito) {
                document.getElementById("errorCampos").innerText = respuesta.mensaje;
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

    let url="../async/crearUsuarios.php?nombre="+encodeURIComponent(nombre)+"&correo=" + encodeURIComponent(correo)+"&contrasena=" + encodeURIComponent(contrasena);
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

    let xmlhttp=new XMLHttpRequest();

    let nombre=document.getElementById("nombre").value.trim();
    if(nombre=="" || modificar==""){
        mostrarErrorCat("campos_vacios", "Todos los campos son obligatorios");
        return;
    }
        
        xmlhttp.onreadystatechange=function(){
            if (this.readyState==4 && this.status==200) {
                console.log(this.responseText)
                let respuesta=JSON.parse(this.responseText);
                
                
                if(respuesta.exito){
                    document.getElementById("errorCampos").classList.remove("oculto");
                    document.getElementById("errorCampos").innerText="¡Editado correctamente!";
                    document.getElementById("errorCampos").style.color="#66c0f4";
                    document.getElementById("errorCampos").style.borderColor="#66c0f4";
                    document.getElementById("nombre").value="";
                
                    setTimeout(function(){
                    window.location.href="../cuerpos/categorias.php";
                }, 2000);
                    
                }else{
                    ocultarTodosLosErroresCat();

                    switch(respuesta.error){
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
                             document.getElementById("errorCampos").innerText=respuesta.mensaje || "Error Al crear Cateogira";

                }
            }
        }
        };
        let url="../async/EditarCategoria.php?nombre=" + encodeURIComponent(nombre)+"&modificar="+encodeURIComponent(modificar);
        
        xmlhttp.open("GET", url, true);
        xmlhttp.send();
    }

    function eliminarCategoria(id){
    if(!confirm("¿Seguro que deseas eliminar esta categoría?")) return;

    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200){
            let respuesta = JSON.parse(this.responseText);
            if(respuesta.exito){
                // Eliminar la fila de la tabla
                let fila = document.getElementById("fila-" + id);
                fila.parentNode.removeChild(fila);
                alert(respuesta.mensaje);
            } else {
                alert(respuesta.mensaje);
            }
        }
    };
    let url="../async/eliminar_categoria.php?id=" + encodeURIComponent(id);

    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}
