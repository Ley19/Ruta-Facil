<?php 
    include('user_menu.php'); 
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>TSP</title>

        <!--llamar a la libreria p5.js-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.4.0/p5.min.js"></script>

        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="../assets/img/icono.png" />
        <!-- Estilos -->
        <link href="../css/styles.css" rel="stylesheet" />
        <link href="../css/style_grafica.css" rel="stylesheet" />

        

    </head>
    <body>
        
    <style>
        .mostrar-body {
            display: block !important;
        }
    </style>
        <!-- Menu-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <img src="../assets/img/icono.png" alt="" style="width: 30px;">
                <a class="navbar-brand" href="#!">- Problema del Agente Viajero -</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <!--<li class="nav-item"><a class="nav-link active" href="inicio.php">Inicio</a></li>-->
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="TSP.php">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link " aria-current="page" href="configuracion.php">Configuración</a></li>
                        <li class="nav-item"><a class="nav-link" href="info.php"><img src="../assets/img/info_d.png"></a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php echo $username; ?>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="cerrar_sesion.php">Cerrar sesión</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Page content-->
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Post content-->
                    <article>
                        <!-- Post header-->
                        <header class="mb-4">
                            <!-- Post title-->
                            <h1 class="fw-bolder mb-1">La mejor ruta</h1>
                            <!-- Post meta content-->
                            <div class="text-muted fst-italic mb-2">Por favor selecciona los siguientes datos</div>
                        </header>

                    </article>
                    <!-- Comments section-->
                    <section class="mb-5">
                        <div class="card bg-light">
                            <div class="card-body">
                            
                                <Label>Punto de Partida</Label>
                                <input type="text" name="DCasa" id="DCasa" value="(<?php echo $longitud; ?>,<?php echo $latitud; ?>)" disabled style="width: 130px;">
                                
                                <Label>No. de Destinos</Label>
                                <input type="Number" name="NDestino" id="NDestino" value="0" disabled style="width: 50px;">

                                <Label>No. de Interaciones</Label>
                                <input type="Number" name="NInteraciones" id="NInteraciones" value="1000"  style="width: 75px;">
                                
                                <label for="image-select">Seleccione zona:</label>
                                <select id="image-select">
                                    <option value="" disabled selected>Zona</option>
                                    <option value="singuilucan">Mapa Singuilucan</option>
                                    <option value="zempoala">Mapa Zempoala</option>
                                </select>

                            </div>
                            <div class="card-body">
                                <Label>Distancia</Label>
                                <input type="text" disabled value="0" id="Mostar-Fitness">
                                <Label for="pc" id="pc" title="Probabilidad de Cruce">Pc</Label>
                                <input type="text" disabled value="0.70" style="width: 50px;" >
                                <Label for="pm" id="pm" title="Probabilidad de Mutación">Pm</Label>
                                <input type="text" disabled value="0.002" style="width: 50px;"  >
                            </div>
                            <div class="card-body">
                                <button onclick="calcularBoton()" class="btn btn-primary" id="calcular">Calcular</button>
                                <button onclick="VolverCalcular()" class="btn btn-primary" disabled id="volver">Volver a calcular</button>
                                
                            </div>
                            <div class="card-body">
                                <label for="Mensaje" id="mensaje"></label>
                            </div>
                        </div>
                        <div class="card bg-light">
                            <div id="sketch-container"></div>
                        </div>
                    </section>
                </div>
                <!-- Side widgets-->
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-header">Destinos seleccionados</div>
                        <div class="card-body">
                            <div class="input-group">
                                <ul id="point-list"></ul>
                            </div>
                            <div class="input-group">
                                <ul id="point-list-mejor-ruta"></ul>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header" onclick="mostrarBody()">Destinos Guardados</div>
                            <div class="card-body" id="card-body" style="display: none;">
                                 <table class="table" id="tabla-destinos-guardados">
                                     <thead>
                                        <tr>
                                            <th style="width: 30px;">Nombre</th>
                                            <th style="width: 30px;">Longitud</th>
                                            <th style="width: 30px;">Latitud</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        include 'tabla_destinos_guardados.php';
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="../js/scripts.js"></script>

        <script>

            var label = document.getElementById("pc");
            label.addEventListener("mouseover", function() {
            label.setAttribute("title", "Probabilidad de Cruce");
            });

            var label = document.getElementById("pm");
            label.addEventListener("mouseover", function() {
            label.setAttribute("title", "Probabilidad de Mutación");
            });

            // Definir algunas constantes
            const NUM_COLS = 14;
            const NUM_ROWS = 10;
            const CELL_SIZE = 50;
            const GRID_COLOR = 200;
      
            // Variable para los puntos
              let points = [];
              const coordenadas = [];
              let lineas = []; 
              let soluciones = [];
              let solucionUno = [];
              let solucionDos = [];
              let solucionTres = [];
              let solucionCuatro = [];
              let solucionCinco = [];
              let solucionSeis = [];
              let solucionSiete = [];
              let solucionOcho = [];
              let canvas;

            //Variable aleatoria entre 0 y 1
              const Pc = 0.9;
              const Pm = 0.002;
              let padre1 = [];
              let padre2 = [];
              let hijo1 = []; 
              let hijo2 = [];
              let GuardarValorIndividuo;

            // Contador de puntos
            let pointCount = 1;
            let mejorFitnessGlobal = Infinity;

            // Punto de inicio
            let startPoint = {
                x: <?php echo $longitud; ?>,
                y: <?php echo $latitud; ?>
            };

            // Añadir el punto de inicio a la lista HTML
            const pointList = document.getElementById("point-list");
            const pointListItem = document.createElement("li");
            pointListItem.innerText = `Inicio.- (${startPoint.x}, ${startPoint.y})`;
            pointList.appendChild(pointListItem);

            console.log("Inicializacion de la población");
            // Agregar el punto de inicio al array
            coordenadas[0] = { x: startPoint.x, y: startPoint.y };
            console.log("Inicio. - (", startPoint.x, ",",startPoint.y,")");

            //Añadir imagen al punto de partida en el canvas
            let imgSinguilucan;
            let imgZempoala;
            let startPointImg;

            function preload() {
                imgSinguilucan = loadImage("../assets/img/mapa-singuilucan.jpg");
                imgZempoala = loadImage("../assets/img/mapa-zempoala.jpg");
                startPointImg = loadImage("../assets/img/casa.png");
            }


            function setup() {
                // Crear el canvas
                canvas = createCanvas(NUM_COLS * CELL_SIZE, NUM_ROWS * CELL_SIZE);
                canvas.parent('sketch-container');

                // Color de fondo
                stroke(GRID_COLOR);

                // Crear la cuadrícula de rectángulos
                for (let x = 0; x < NUM_COLS; x++) {
                    for (let y = 0; y < NUM_ROWS; y++) {
                        rect(x * CELL_SIZE, y * CELL_SIZE, CELL_SIZE, CELL_SIZE);
                    }
                }

                // Cuando de click en el canvas se añade un punto
                canvas.mouseClicked(addPoint);

                // Dibujar la imagen actual
                imageSelect = document.getElementById("image-select");
                imageSelect.addEventListener("change", changeImage);

                // Se coloca el punto de inicio
                image(startPointImg, startPoint.x, startPoint.y, 20, 20);
                fill(0, 255, 0);
                ellipse(startPoint.x, startPoint.y, 10, 10);

            }

            function addPoint() {
                // Verificar si el punto ya ha sido agregado previamente
                const pointExists = points.some(point => point.x === mouseX && point.y === mouseY);
                
                // Mostrar mensaje de aviso si el punto ya ha sido agregado
                if (pointExists) {
                    alert('Esta coordenada ya ha sido agregada anteriormente.');
                    return;
                }else{
                     // Añadir punto de inicio al array
                    const point = {
                        x: mouseX,
                        y: mouseY
                    };
                    points.push(point);

                    // Añadir punto roo
                    fill(255, 0, 0);
                    ellipse(mouseX, mouseY, 10, 10);

                    // Agregar número al punto
                    fill(0);
                    text(pointCount, mouseX - 10, mouseY - 10);

                    // Añadir los puntos a la lista
                    const pointList = document.getElementById("point-list");
                    const pointListItem = document.createElement("li");
                    pointListItem.innerText = `${pointCount}.-  (${point.x}, ${point.y})`;
                    pointList.appendChild(pointListItem);
                    console.log(pointListItem);

                    coordenadas[pointCount] = { x: point.x, y: point.y };
                    //console.log(coordenadas);

                    // Actualizar el valor del input con el número de puntos
                    const numPoints = points.length;
                    const numDestinoInput = document.getElementById("NDestino");
                    numDestinoInput.value = numPoints;

                    // Incrementar el contador de puntos
                    pointCount++;
                }
                
               
            }

            function llenarArrays() {
                // Llenar los arrays solucionUno, solucionDos, solucionTres y solucionCuatro con las mismas coordenadas
                //Individuos
                solucionUno = coordenadas.slice();
                solucionDos = coordenadas.slice();
                solucionTres = coordenadas.slice();
                solucionCuatro = coordenadas.slice();
                solucionCinco = coordenadas.slice();
                solucionSeis = coordenadas.slice();
                solucionSiete = coordenadas.slice();
                solucionOcho = coordenadas.slice();
                    
                // Mezclar los arrays, excepto el primer elemento
                solucionUno = [solucionUno[0], ...shuffleArray(solucionUno.slice(1))];
                solucionDos = [solucionDos[0], ...shuffleArray(solucionDos.slice(1))];
                solucionTres = [solucionTres[0], ...shuffleArray(solucionTres.slice(1))];
                solucionCuatro = [solucionCuatro[0], ...shuffleArray(solucionCuatro.slice(1))];
                solucionCinco = [solucionCinco[0], ...shuffleArray(solucionCinco.slice(1))];
                solucionSeis = [solucionSeis[0], ...shuffleArray(solucionSeis.slice(1))];
                solucionSiete = [solucionSiete[0], ...shuffleArray(solucionSiete.slice(1))];
                solucionOcho = [solucionOcho[0], ...shuffleArray(solucionOcho.slice(1))];

            }

            function calcularBoton() {
                padre1 = [];
                padre2 = [];
                hijo1 = []; 
                hijo2 = [];

                //Inicia la poblacion y se evaluan los individuos
                llenarArrays();

                // Llame a la función algoritmoTSP() aquí
                algoritmoTSP();
                const inputFitness = document.getElementById("Mostar-Fitness");
                inputFitness.value = mejorFitnessGlobal;
                document.getElementById("calcular").disabled = true;
                document.getElementById("volver").disabled = false;

            }

            function VolverCalcular() {
                let fitnessActual;
                do {
                    algoritmoTSP();
                    fitnessActual = GuardarValorIndividuo;
                } while (fitnessActual > mejorFitnessGlobal);
                mejorFitnessGlobal = fitnessActual;

                const inputFitness = document.getElementById("Mostar-Fitness");
                inputFitness.value = mejorFitnessGlobal;
            }

            function algoritmoTSP() {
                
                let Total_number_of_cycles = parseInt(document.getElementById("NInteraciones").value);
                let Number_of_cycles = 0;
                //console.log(Total_number_of_cycles);
                soluciones = [solucionUno, solucionDos, solucionTres, solucionCuatro, solucionCinco, solucionSeis, solucionSiete, solucionOcho];


                do {
                    //Seleccion de los 2 padres 
                    [padre1, padre2, indexPadre1, indexPadre2] = SeleccionDePadres( soluciones);
 
                    const randomPc = Math.random();

                    if (randomPc <= Pc) {
                        // Realiza cruce
                        [hijo1, hijo2] = cruce(padre1, padre2);

                    } else {
                        hijo1 = padre1;
                        hijo2 = padre2;
                    }
                    
                    const randomPm = Math.random();
                    if (randomPm <= Pm) {
                        //mutar la descendencia de dos hijos
                        [hijo1, hijo2] = mutacion(hijo1, hijo2);
                    
                    }

                    //Evalua a padres y hijos
                    const fitnessPadre1 = calcularFitness(padre1);
                    const fitnessPadre2 = calcularFitness(padre2);
                    const fitnessHijo1 = calcularFitness(hijo1);
                    const fitnessHijo2 = calcularFitness(hijo2);

                    // Inicializa las variables de best1 y best2
                    let best1, best2;
                    //Best1 es el padre1
                    if (fitnessPadre1 <= fitnessPadre2 && fitnessPadre1 <= fitnessHijo1 && fitnessPadre1 <= fitnessHijo2) {
                        best1 = padre1;
                    } else if (fitnessPadre2 <= fitnessHijo1 && fitnessPadre2 <= fitnessHijo2) {
                        best1 = padre2;
                    } else if (fitnessHijo1 <= fitnessHijo2) {
                        best1 = hijo1;
                    } else {
                        best1 = hijo2;
                    }

                    if (best1 === padre1) {
                        if (fitnessPadre2 <= fitnessHijo1 && fitnessPadre2 <= fitnessHijo2) {
                            best2 = padre2;
                        } else if (fitnessHijo1 <= fitnessHijo2) {
                            best2 = hijo1;
                        } else {
                            best2 = hijo2;
                        }
                    } else if (best1 === padre2) {
                        if (fitnessPadre1 <= fitnessHijo1 && fitnessPadre1 <= fitnessHijo2) {
                            best2 = padre1;
                        } else if (fitnessHijo1 <= fitnessHijo2) {
                            best2 = hijo1;
                        } else {
                            best2 = hijo2;
                        }
                    } else if (best1 === hijo1) {
                        if (fitnessPadre1 <= fitnessPadre2 && fitnessPadre1 <= fitnessHijo2) {
                            best2 = padre1;
                        } else if (fitnessPadre2 <= fitnessHijo2) {
                            best2 = padre2;
                        } else {
                            best2 = hijo2;
                        }
                    } else {
                        if (fitnessPadre1 <= fitnessPadre2 && fitnessPadre1 <= fitnessHijo1) {
                            best2 = padre1;
                        } else if (fitnessPadre2 <= fitnessHijo1) {
                            best2 = padre2;
                        } else {
                            best2 = hijo1;
                        }
                    }

                    //Cambiar el valor de padre1 por best1 y el de padre2 por el de best2
                    //console.log("Solucion en el index",soluciones[indexPadre1] );
                    soluciones[indexPadre1] = best1;
                    soluciones[indexPadre2] = best2;
                    //console.log("Solucion en el index despues",soluciones[indexPadre1] );

                   //console.log("------------------------------"); 
                    //Actualizar lineas
                    clear();
                    
                    Number_of_cycles++;
                } while (Number_of_cycles < Total_number_of_cycles);

                var label = document.getElementById("mensaje");
                var texto2 = "Sigue los puntos para recorrer la ruta mas corta.";
                label.innerText = texto2;


                //Dibujar la solucion
                    // Punto de partida
                    let startPoint = {
                            x: <?php echo $longitud; ?>,
                            y: <?php echo $latitud; ?>
                        };
                        
                
                // Obtener el valor seleccionado del menú desplegable
                const imageSelect = document.getElementById("image-select");
                const imageValue = imageSelect.value;

                // Cargar la imagen correspondiente
                switch(imageValue) {
                    case "singuilucan":
                        image(imgSinguilucan, 0, 0);
                        fill(0, 255, 0);
                        ellipse(startPoint.x, startPoint.y, 10, 10);
                        image(startPointImg, startPoint.x, startPoint.y, 20, 20);
                    break;

                    case "zempoala":
                        image(imgZempoala, 0, 0);
                        fill(0, 255, 0);
                        ellipse(startPoint.x, startPoint.y, 10, 10);
                        image(startPointImg, startPoint.x, startPoint.y, 20, 20);
                    break;

                    default:
                    break;
                }
                
                //Seleccionar al individuo más apto de la población;
                let mejorIndividuo = soluciones[0];
                let mejorFitness = calcularFitness(soluciones[0]);
                
                for (let i = 1; i < soluciones.length; i++) {
                    const fitnessActual = calcularFitness(soluciones[i]);
                    if (fitnessActual < mejorFitness) {
                        mejorIndividuo = soluciones[i];
                        mejorFitness = fitnessActual;
                    }
                }

                console.log("El fitness del mejor individuo es: ", calcularFitness(mejorIndividuo));
                
               
                for (let i = 0; i < mejorIndividuo.length; i++) {
                
                    // Añadir punto rojo
                    fill(255, 0, 0);
                    ellipse(mejorIndividuo[i].x, mejorIndividuo[i].y, 10, 10);

                    // Agregar número al punto
                    fill(0);
                    text(i, mejorIndividuo[i].x - 10, mejorIndividuo[i].y - 10);
                }
            
                        points.unshift(startPoint);

                        // Color rojo del punto de inicio
                        stroke(255, 0, 0);
                        image(startPointImg, startPoint.x, startPoint.y, 20, 20);
                        fill(0, 255, 0);
                        ellipse(startPoint.x, startPoint.y, 10, 10);

                        // Dibujar las lineas
                        for (let i = 0; i < mejorIndividuo.length - 1; i++) {
                            const p1 = mejorIndividuo[i];
                            const p2 = mejorIndividuo[i + 1];
                            const linea = line(p1.x, p1.y, p2.x, p2.y);
                            lineas.push(linea);
                        }

                        // Dibujar una línea desde el último punto al punto de inicio
                        stroke(0, 255, 0); 
                        const lineaInicio = line(mejorIndividuo[mejorIndividuo.length - 1].x, mejorIndividuo[mejorIndividuo.length - 1].y, startPoint.x, startPoint.y);
                        lineas.push(lineaInicio);

                        if (mejorFitness < mejorFitnessGlobal) {
                            mejorFitnessGlobal = mejorFitness;
                        }

                        GuardarValorIndividuo = calcularFitness(mejorIndividuo);
                        

                        return GuardarValorIndividuo;

            }

            function SeleccionDePadres() {

                const fitnessSolucionUno = calcularFitness(solucionUno);
                const fitnessSolucionDos = calcularFitness(solucionDos);
                const fitnessSolucionTres = calcularFitness(solucionTres);
                const fitnessSolucionCuatro = calcularFitness(solucionCuatro);
                const fitnessSolucionCinco = calcularFitness(solucionCinco);
                const fitnessSolucionSeis = calcularFitness(solucionSeis);
                const fitnessSolucionSiete = calcularFitness(solucionSiete);
                const fitnessSolucionOcho = calcularFitness(solucionOcho);

                
                //Seleccion por torneo 
                //soluciones = [solucionUno, solucionDos, solucionTres, solucionCuatro, solucionCinco, solucionSeis, solucionSiete, solucionOcho];
                const tamTorneo = 2;
                padre1 = seleccionPorTorneo(soluciones, tamTorneo);
                padre2 = seleccionPorTorneo(soluciones, tamTorneo);

                const indexPadre1 = soluciones.indexOf(padre1);
                const indexPadre2 = soluciones.indexOf(padre2);

                return [padre1, padre2,indexPadre1,indexPadre2]
            }


            function mostrarBody() {
                var cardBody = document.getElementById("card-body");
                cardBody.classList.toggle("mostrar-body");
            }

            // Seleccionar todos los botones de "Añadir" y agregar un listener a cada uno
            const addPointButtons = document.querySelectorAll('.add-point-button');
            addPointButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const longitud = button.dataset.longitud;
                    const latitud = button.dataset.latitud;
                    addPointToCanvas(Number(longitud), Number(latitud));
                    button.disabled = true; // Deshabilitar el botón
                });
            });

            // Agregar un punto al canvas y actualizar la lista HTML
            function addPointToCanvas(longitud, latitud) {
                // Añadir punto al array
                const point = {
                    x: longitud,
                    y: latitud
                };
                points.push(point);

                // Dibujar el punto
                fill(255, 0, 0);
                ellipse(longitud, latitud, 10, 10);

                // Agregar número al punto
                fill(0);
                text(pointCount, longitud - 10, latitud - 10);

                // Añadir el punto a la lista
                const pointList = document.getElementById("point-list");
                const pointListItem = document.createElement("li");
                pointListItem.innerText = `${pointCount}.- (${longitud}, ${latitud})`;
                pointList.appendChild(pointListItem);

                coordenadas[pointCount] = { x: point.x, y: point.y };

                // Actualizar el valor del input con el número de puntos
                const numPoints = points.length;
                const numDestinoInput = document.getElementById("NDestino");
                numDestinoInput.value = numPoints;

                // Incrementar el contador de puntos
                pointCount++;
            }

            //Fondo de canvas
            function changeImage() {

                console.clear();

                // Habilitar todos los botones addPointButtons
                addPointButtons.forEach(button => {
                    button.disabled = false;
                });

                // Obtener el valor seleccionado del menú desplegable
                const imageSelect = document.getElementById("image-select");
                const imageValue = imageSelect.value;

                // Cargar la imagen correspondiente
                switch(imageValue) {
                    case "singuilucan":
                        image(imgSinguilucan, 0, 0);
                        fill(0, 255, 0);
                        ellipse(startPoint.x, startPoint.y, 10, 10);
                        image(startPointImg, startPoint.x, startPoint.y, 20, 20);
                    break;

                    case "zempoala":
                        image(imgZempoala, 0, 0);
                        fill(0, 255, 0);
                        ellipse(startPoint.x, startPoint.y, 10, 10);
                        image(startPointImg, startPoint.x, startPoint.y, 20, 20);
                    break;

                    default:
                    break;
                }

                // borrar la lista de destinos
                const pointList = document.getElementById("point-list");
                pointList.innerHTML = "";
                
                // borrar los puntos dibujados
                points = [];
                solucionUno = [];
                solucionDos = [];
                solucionTres = [];
                solucionCuatro = [];
                solucionCinco = [];
                solucionSeis = [];
                solucionSiete = [];
                solucionOcho = [];
                
                pointCount = 1;

               // Añadir el punto de inicio a la lista HTML
                pointListItem.innerText = `Inicio.- (${startPoint.x}, ${startPoint.y})`;
                pointList.appendChild(pointListItem);

                console.log("Inicializacion de la población");
                console.log("Inicio. - (", startPoint.x, ",",startPoint.y,")");

            }

            //Cambiar el orden de los arrays
            function shuffleArray(array) {
                const newArray = array.slice();
                for (let i = newArray.length - 1; i > 0; i--) {
                    const j = Math.floor(Math.random() * (i + 1));
                    [newArray[i], newArray[j]] = [newArray[j], newArray[i]];
                }
                return newArray;
            }

            //Calcular fitness
            function calcularFitness(coordenadas) {
                let distanciaTotal = 0;

                for (let i = 0; i < coordenadas.length - 1; i++) {
                    const p1 = coordenadas[i];
                    const p2 = coordenadas[i + 1];
                    //console.log("Coordenadas (", p1.x ,",", p1.y ,") con (", p2.x ,",", p2.y ,")");
                    const distancia = Math.sqrt(Math.pow(p1.x - p2.x, 2) + Math.pow(p1.y - p2.y, 2));
                    //console.log("Distancia entre los puntos es: ", distancia)
                    distanciaTotal += distancia;
                }

                // Agregar la distancia del último punto al primer punto
                const ultimoPunto = coordenadas[coordenadas.length - 1];
                const primerPunto = coordenadas[0];
                //console.log("Coordenadas (", ultimoPunto.x ,",", ultimoPunto.y ,") con (", primerPunto.x ,",", primerPunto.y ,")");
                const distanciaFinal = Math.sqrt(Math.pow(ultimoPunto.x - primerPunto.x, 2) + Math.pow(ultimoPunto.y - primerPunto.y, 2));
                distanciaTotal += distanciaFinal;

                return distanciaTotal;
            }

            //Seleccion por torneo
            function seleccionPorTorneo(soluciones, tamTorneo) {
                const numSoluciones = soluciones.length;
                const indicesAleatorios = Array.from({ length: tamTorneo }, () =>
                    Math.floor(Math.random() * numSoluciones)
                );
                let mejorFitness = Number.POSITIVE_INFINITY;
                let mejorSolucion;

                for (const indice of indicesAleatorios) {
                    const solucion = soluciones[indice];
                    const fitness = calcularFitness(solucion);
                    //console.log("Puso a competir",fitness);

                    if (fitness < mejorFitness) {
                    mejorFitness = fitness;
                    mejorSolucion = solucion;
                    }
                }
                //console.log("Gano", calcularFitness(mejorSolucion));

                return mejorSolucion;
            }

            function cruce(padre1, padre2) {
                const n = padre1.length; // longitud de los padres
                const puntoCruce = Math.floor(Math.random() * n); // selecciona un punto de cruce aleatorio
                //console.log("El punto de cruce es: ", puntoCruce);
                
                const hijo1 = [...padre1.slice(0, puntoCruce), ...padre2.slice(puntoCruce)];
                const hijo2 = [...padre2.slice(0, puntoCruce), ...padre1.slice(puntoCruce)];
                
                let valoresHijo1 = [...hijo1.slice(0, puntoCruce), ...new Array(n - puntoCruce)];
                let valoresHijo2 = [...hijo2.slice(0, puntoCruce), ...new Array(n - puntoCruce)];
                
                // Copiar valores únicos del padre2 al hijo1
                for (let i = 0; i < n; i++) {
                    if (!valoresHijo1.includes(padre2[i])) {
                    for (let j = 0; j < n - puntoCruce; j++) {
                        if (valoresHijo1[puntoCruce + j] === undefined) {
                        valoresHijo1[puntoCruce + j] = padre2[i];
                        break;
                        }
                    }
                    }
                }
                
                // Copiar valores únicos del padre1 al hijo2
                for (let i = 0; i < n; i++) {
                    if (!valoresHijo2.includes(padre1[i])) {
                    for (let j = 0; j < n - puntoCruce; j++) {
                        if (valoresHijo2[puntoCruce + j] === undefined) {
                        valoresHijo2[puntoCruce + j] = padre1[i];
                        break;
                        }
                    }
                    }
                }
                
                hijo1.splice(puntoCruce, n - puntoCruce, ...valoresHijo1.slice(puntoCruce));
                hijo2.splice(puntoCruce, n - puntoCruce, ...valoresHijo2.slice(puntoCruce));
                
                return [hijo1, hijo2];
            }

            //Mutacion
            function mutacion(hijo1, hijo2) {
                const tamCromosoma = hijo1.length;

                // Seleccionar dos posiciones aleatorias diferentes, empezando en la posición 1
                let pos1 = Math.floor(Math.random() * (tamCromosoma - 1)) + 1;
                let pos2 = Math.floor(Math.random() * (tamCromosoma - 1)) + 1;

                // Verificar que las posiciones sean diferentes y que no incluyan la posición 0
                while (pos1 === pos2 || pos1 === 0 || pos2 === 0 ) {
                    pos1 = Math.floor(Math.random() * (tamCromosoma - 1)) + 1;
                    pos2 = Math.floor(Math.random() * (tamCromosoma - 1)) + 1;
                }

                //console.log("La posicion 1 es: ", pos1, "La posicion 2 es: ", pos2);

                // Intercambiamos los valores de los alelos de los hijos
                const temp = hijo1[pos1];
                hijo1[pos1] = hijo1[pos2];
                hijo1[pos2] = temp;

                const temp2 = hijo2[pos1];
                hijo2[pos1] = hijo2[pos2];
                hijo2[pos2] = temp2;

               /* for (let i = 0; i < hijo2.length; i++) {
                 console.log("Hijo2 pos", i, ":", hijo2[i]);
                }*/

                return [hijo1, hijo2];
            }


        </script>

    </body>
</html>
