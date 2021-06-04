function EnvLike(event) {

    var id = event.getAttribute("id")

    
    if(event.classList.contains('is-empty')){
        event.setAttribute("class", "nes-icon is-medium like")
        like = "up";
    }  else {
        event.setAttribute("class", "nes-icon is-medium like is-empty")
        like = "down";
    }

    if(like == "up"){
        console.log(parseInt(event.previousSibling.innerHTML) + 1)
        console.log(event.previousSibling.value)
        event.previousSibling.innerHTML = parseInt(event.previousSibling.innerHTML) + 1 + " "
    } else {
        event.previousSibling.innerHTML = parseInt(event.previousSibling.innerHTML) - 1 + " "
    }


    if (window.XMLHttpRequest) {
        peticion = new XMLHttpRequest();
    } else if (window.ActiveXObject) {
        peticion = ActiveXObject("Microsoft.XMLHTTP");
    }
    datos = {}
    datos.idMen = id;
    datos.like = like;
    datos.usu = usuario;


    peticion.onreadystatechange = function () {
        if (peticion.readyState == 4) {
            if (peticion.status == 200) {
                console.log("peticion: " + peticion.responseText)
                
            }
        }
    }

    peticion.open("POST", "enviarlikes.php");
    peticion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    peticion.send("datos=" + JSON.stringify(datos));
}

function enviarMens(event){
    var id = event.getAttribute("id")
    var mensaje = document.getElementById("textarea_field").value
    console.log(mensaje + " " + id)


    if (window.XMLHttpRequest) {
        peticion = new XMLHttpRequest();
    } else if (window.ActiveXObject) {
        peticion = ActiveXObject("Microsoft.XMLHTTP");
    }
    datos = {}
    datos.idHilo = id;
    datos.mens = mensaje;
    datos.usu = usuario;


    peticion.onreadystatechange = function () {
        if (peticion.readyState == 4) {
            if (peticion.status == 200) {
                console.log("peticion: " + peticion.responseText)
                window.location.reload();
            }
        }
    }

    peticion.open("POST", "enviarMensaje.php");
    peticion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    peticion.send("datos=" + JSON.stringify(datos));
}

function enviarHilo(){

    var tema = document.getElementById("tema").value
    console.log(tema + " " + usuario)

    if(tema != ""){
        if (window.XMLHttpRequest) {
            peticion = new XMLHttpRequest();
        } else if (window.ActiveXObject) {
            peticion = ActiveXObject("Microsoft.XMLHTTP");
        }
        datos = {}
        datos.tema = tema;
        datos.usu = usuario;


        peticion.onreadystatechange = function () {
            if (peticion.readyState == 4) {
                if (peticion.status == 200) {
                    console.log(peticion.responseText)
                    var respuesta = peticion.responseText;
                    if(respuesta == "    "){
                        window.location.reload();
                    } else {
                        document.getElementById("error").innerHTML = peticion.responseText
                    }
                    
                }
            }
        }

        peticion.open("POST", "enviarHilo.php");
        peticion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        peticion.send("datos=" + JSON.stringify(datos));

        
    } else{
        document.getElementById("error").innerHTML = "El tema no puede estar en blanco"
    }
}

