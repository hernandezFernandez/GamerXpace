
var boton = document.getElementById("play");
var inicio = 0;

var iz = document.getElementById("iz");
var der = document.getElementById("der");


var scoreTotal = 0;
var nivel = 1;
var CanteneNiv = 3
var gameFin = null

function arkanoid(){
    inicio = 1;
    


var canvas = document.getElementById("myCanvas");
canvas.style.display="block";

var ancho = main.clientWidth * 0.8;
var alto = ((main.clientWidth * 0.8) /1.5);

canvas.setAttribute('width', ancho); 
canvas.setAttribute('height', alto); 



var ctx = canvas.getContext("2d");



console.log(nivel)

// alto y ancho de la pala
var naveAncho = ancho * 0.15;
var naveAlto = alto * 0.15;
var naveY = canvas.height * 0.83;
var naveX = canvas.width/2;

// comprobar que boton esta pulsado
var rightPressed = false;
var leftPressed = false;
// puntuacion
var score = 0;
// intervalo
var id;
// misiles
var misiles = []
// imagenes
var gameOver = new Image();
gameOver.src = "../../img/gameOver.png";

var youWin = new Image();
youWin.src = "../../img/youWin.jpg";


var naveImage = new Image(); // nave
naveImage.src = "images/spaceship-pic.png";

var enemiespic1  = new Image(); // enemigo 1
enemiespic1.src     = "images/enemigo1.png";
    
var enemiespic2 = new Image(); // enemigo 2
enemiespic2.src     = "images/enemigo2.png"; //Enemies picture

var backgroundImage = new Image();
backgroundImage.src = "images/background-pic.jpg";


var iz = document.getElementById("iz");
var der = document.getElementById("der");

document.addEventListener("keydown", keyDownHandler, false);
document.addEventListener("keyup", keyUpHandler, false);

// document.addEventListener("mousemove", mouseMoveHandler, false);

iz.addEventListener("touchstart",function(e){ keyDownHandler(e, "iz")} , false);
der.addEventListener("touchstart",function(e){ keyDownHandler(e, "der")}, false);
iz.addEventListener("touchend",function(e){ keyUpHandler(e, "iz")} , false);
der.addEventListener("touchend",function(e){ keyUpHandler(e, "der")} , false);

// disparar.addEventListener('mousedown', function(event) {
//     misiles.push({x: launcher.x + launcher.w*.5, y: launcher.y, w: 3, h: 10});
// });


function keyDownHandler(e, but) {
    if(e.keyCode == 39 || e.keyCode == 68) {
        rightPressed = true;
    }
    else if(e.keyCode == 37 || e.keyCode == 65) {
        leftPressed = true;
    } 
    else if(but == "der"){
        rightPressed = true;
    } 
    else if(but == "iz"){
        leftPressed = true;
    } else if(e.keyCode == 70 || e.keyCode == 32){
        e.preventDefault()

        misiles.push({x: naveX + naveAncho*.5, y: naveY, w: 3,h: 10});
    }

}
function keyUpHandler(e, but) {
    if(e.keyCode == 39 || e.keyCode == 68) {
        rightPressed = false;
    }
    else if(e.keyCode == 37 || e.keyCode == 65) {
        leftPressed = false;
    }
    else if(but == "der"){
        rightPressed = false;
    } 
    else if(but == "iz"){
        leftPressed = false;
    }
}


var enemigo = function(options){
    return {
        id: options.id || '',
        x: options.x || '',
        y: options.y || '',
        w: options.w || '',
        h: options.h || '',
        image: options.image || ''
    }
}

var enemies = [
            //    new enemigo({id: "enemy1", x: ancho * 0.15, y: -(alto*0.03), w: ancho * 0.07, h: alto * 0.05 }),
            //    new enemigo({id: "enemy2", x: 225, y: -20, w: ancho * 0.07, h: alto * 0.05 }),
            //    new enemigo({id: "enemy3", x: 350, y: -20, w: 80, h: 30 }),
            //    new enemigo({id: "enemy4", x:100,  y:-70,  w:80,  h: 30}),
            //    new enemigo({id: "enemy5", x:225,  y:-70,  w:50,  h: 30}),
            //    new enemigo({id: "enemy6", x:350,  y:-70,  w:50,  h: 30}),
            //    new enemigo({id: "enemy7", x:475,  y:-70,  w:50,  h: 30}),
            //    new enemigo({id: "enemy8", x:600,  y:-70,  w:80,  h: 30}),
            //    new enemigo({id: "enemy9", x:475,  y:-20,  w:50,  h: 30}),
            //    new enemigo({id: "enemy10",x: 600, y: -20, w: 50, h: 30}),

            //    // Segundo grupo de enemigos
            //    new enemigo({ id: "enemy11", x: 100, y: -220, w: 50, h: 30, image: enemiespic2 }),
            //    new enemigo({ id: "enemy12", x: 225, y: -220, w: 50, h: 30, image: enemiespic2 }),
            //    new enemigo({ id: "enemy13", x: 350, y: -220, w: 80, h: 50, image: enemiespic2 }),
            //    new enemigo({ id: "enemy14", x: 100, y: -270, w: 80, h: 50, image: enemiespic2 }),
            //    new enemigo({ id: "enemy15", x: 225, y: -270, w: 50, h: 30, image: enemiespic2 }),
            //    new enemigo({ id: "enemy16", x: 350, y: -270, w: 50, h: 30, image: enemiespic2 }),
            //    new enemigo({ id: "enemy17", x: 475, y: -270, w: 50, h: 30, image: enemiespic2 }),
            //    new enemigo({ id: "enemy18", x: 600, y: -270, w: 80, h: 50, image: enemiespic2 }),
            //    new enemigo({ id: "enemy19", x: 475, y: -200, w: 50, h: 30, image: enemiespic2 }),
            //    new enemigo({ id: "enemy20", x: 600, y: -200, w: 50, h: 30, image: enemiespic2 })
              ];

var xene
var yene = alto * 0.03
for (let z = 0; z < CanteneNiv; z++) {    
    xene = ancho * 0.15
    for (let j = 0; j < 5; j++) {
        if(z%2 == 0){
            enemies.push(new enemigo({id: "enemigo" + j + z, x: xene, y: -yene, w: ancho * 0.07, h: alto * 0.05, image: enemiespic2 }))
        } else {
            enemies.push(new enemigo({id: "enemigo" + j + z, x: xene, y: -yene, w: ancho * 0.07, h: alto * 0.05, image: enemiespic1 }))
        }
        
        xene += ancho * 0.17
        
    }
    yene += alto * 0.1
}

// ajustar tamaño de los muñecos + grande
             

function drawEnemies () {
    if(enemies.length == 0){
        gameFin = true
    } else{
        for (var i = 0; i < enemies.length; i++) {
            // console.log(enemies[i]);
            ctx.drawImage(enemies[i].image, enemies[i].x, enemies[i].y += nivel, enemies[i].w, enemies[i].h);
            // Detects when ships hit lower level
            colisionConNave(enemies[i]);
        }
    }
}

function colisionConNave (enemigo){
    // pierde llega abajo
    if(enemigo.y > alto){
        gameFin = false
    }

    // pierde choca
   if ((enemigo.y < naveY + 25 && enemigo.y > naveY - 25) &&
        (enemigo.x < naveX + 45 && enemigo.x > naveX - 45)) { // Checking if enemigo is on the left or right of spaceship
            gameFin = false;
        }

    
}


function drawNave() {
    ctx.drawImage(naveImage, naveX ,naveY , naveAncho, naveAlto);
}

function drawScore() {
    ctx.font = "16px Press Start 2P";
    ctx.fillStyle = "#0095DD";
    ctx.fillText("Score: "+ (scoreTotal + score), 8, 20);
}

function hitDetect (m, mi) {
    for (var i = 0; i < enemies.length; i++) {
        var e = enemies[i];
        if(m.x+m.w >= e.x && 
           m.x <= e.x+e.w && 
           m.y >= e.y && 
           m.y <= e.y+e.h){
           misiles.splice(misiles[mi],1); 
            enemies.splice(i, 1); 
            score += 1
            
        }
    }
}

// est
function drawMisiles(){
    for(var i=0; i < misiles.length; i++){
        var m = misiles[i];
        ctx.fillStyle = "green"
        ctx.fillRect(m.x, m.y-=alto/60, m.w, m.h); // bullet direction
        hitDetect(misiles[i],i);
        if(m.y <= 0){ // If a missile goes past the canvas boundaries, remove it
            misiles.splice(i,1); // splice that missile out of the misiles array
        }
    }
}



function draw() {
    ctx.clearRect(0, 0, canvas.width, canvas.height)
    ctx.drawImage(backgroundImage, 0, 0, ancho, alto)
    drawNave();
    drawScore();
    drawMisiles();
    drawEnemies();

    if(gameFin === false){  
        clearInterval(id); 
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctx.drawImage(gameOver, 0, 0, canvas.width, canvas.height);
        console.log("fin")
        inicio = 0
        EnvPunt()
        boton.innerHTML= "restart";
        nivel = 1;
        CanteneNiv = 3
        if(usuario != null && usuario != ""){
            EnvPunt();
            console.log("envia puntos")
        }
        
    } else if(gameFin === true){
        clearInterval(id)
        ctx.clearRect(0, 0, canvas.width, canvas.height)
        ctx.drawImage(youWin, 0, 0, canvas.width, canvas.height)
        console.log("gana")
        inicio = 0  
        scoreTotal += score
        nivel += 0.2;
        CanteneNiv += 1
    }

    
    if(rightPressed && naveX < canvas.width-naveAncho) {
        naveX += 7;
    }
    else if(leftPressed && naveX > 0) {
        naveX -= 7;
    }

}



id = setInterval(draw, 20);



function EnvPunt(){

    console.log("Puntos en envio" + (scoreTotal + score))

    if (window.XMLHttpRequest) {
        peticion=new XMLHttpRequest(); 
          } else if (window.ActiveXObject) {
        peticion=ActiveXObject("Microsoft.XMLHTTP"); 
          } 

          datos={}
          datos.punt = (scoreTotal + score);
          datos.user = usuario;
   
          console.log(datos.punt)

          peticion.onreadystatechange = function(){
        if(peticion.readyState == 4) {
          if (peticion.status == 200) {
            //  var asd=JSON.parse(peticion.responseText)
            //  console.log(asd)
            console.log(peticion.responseText)
            console.log("puntuacion enviada")
          }
        }
          }
   
          peticion.open("POST", "./Puntuacion.php");
          peticion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
          peticion.send("datos="+JSON.stringify(datos));
}

}





boton.addEventListener('click', function(){
if (inicio == 0){
    gameFin = null
    arkanoid();
    console.log("nivel boton: " + nivel)
}
    this.innerHTML = "siguiente";
    this.setAttribute("display", "none")
})

    




