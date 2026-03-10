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