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
document.addEventListener("DOMContentLoaded", function(){
    document.getElementById("buscador").addEventListener("keydown", function(e){
        if (e.key === "Enter") {
            buscarJuego();
        }
    });
})
