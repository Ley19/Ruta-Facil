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
                        <li class="nav-item"><a class="nav-link" href="inicio.php">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="TSP.php">TSP</a></li>
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
                                <input type="text" name="DCasa" id="DCasa" value="(<?php echo $longitud; ?>,<?php echo $latitud; ?>)" disabled style="width: 190px;">
                                
                                <Label>No. de Destinos</Label>
                                <input type="Number" name="NDestino" id="NDestino" value="0" disabled style="width: 50px;">

                                <Label>No. de Interaciones</Label>
                                <input type="Number" name="NInteraciones" id="NInteraciones" value="10000"  style="width: 55px;">
                                
                                <label for="image-select">Seleccione zona:</label>
                                <select id="image-select">
                                    <option value="" disabled selected>Zona</option>
                                    <option value="singuilucan">Mapa Singuilucan</option>
                                    <option value="zempoala">Mapa Zempoala</option>
                                </select>

                                <Label>Pc</Label>
                                <input type="Number" name="NPc" id="NPc" value="0.5"  style="width: 50px;">
                                
                                <Label>Pm</Label>
                                <input type="Number" name="Pm" id="Pm" value="0.5"  style="width: 50px;">
                                
                                <Label>No. Soluciones</Label>
                                <input type="Number" name="NArrays" id="NArrays" value="1"  style="width: 40px;">
                                
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
                        </div>
                        <button class="btn btn-primary" id="draw-lines">Calcular</button>
                        <button class="btn btn-danger" id="clear-points">Borrar</button>
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
        
            // Definir algunas constantes
            const NUM_COLS = 14;
            const NUM_ROWS = 10;
            const CELL_SIZE = 50;
            const GRID_COLOR = 200;
      
            // Variable para los puntos
              let points = [];
              const coordenadas = [];
              let solucionUno = [];
              let solucionDos = [];
              let solucionTres = [];
              let solucionCuatro = [];
              let solucionCinco = [];
              let solucionSeis = [];
              
            // Definir algunas variables para sketch y canvas
            let sketch;
            let canvas;

            // Contador de puntos
            let pointCount = 1;

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

                // Se añade las cordenadas
                const drawLinesButton = document.getElementById("draw-lines");
                drawLinesButton.addEventListener("click", drawLines);
                
                // Dibujar la imagen actual
                imageSelect = document.getElementById("image-select");
                imageSelect.addEventListener("change", changeImage);

                // Se coloca el punto de inicio
                image(startPointImg, startPoint.x, startPoint.y, 20, 20);
                fill(0, 255, 0);
                ellipse(startPoint.x, startPoint.y, 10, 10);
                //console.log("Casa :)");

            }

            function addPoint() {
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

            function drawLines() {
      
                // Punto de partida
                let startPoint = {
                    x: <?php echo $longitud; ?>,
                    y: <?php echo $latitud; ?>
                };
                
                points.unshift(startPoint);
        
                // Color rojo del punto de inicio
                stroke(255, 0, 0);
        
                // Dibujar las lineas
                for (let i = 0; i < points.length - 1; i++) {
                    const p1 = points[i];
                    const p2 = points[i + 1];
                    line(p1.x, p1.y, p2.x, p2.y);
                }

                // Dibujar una línea desde el último punto al punto de inicio
                    stroke(0, 255, 0); 
                    line(points[points.length - 1].x, points[points.length - 1].y, startPoint.x, startPoint.y);
                    
                    
                // Llenar los arrays solucionUno, solucionDos, solucionTres y solucionCuatro con las mismas coordenadas
                solucionUno = coordenadas.slice();
                solucionDos = coordenadas.slice();
                solucionTres = coordenadas.slice();
                solucionCuatro = coordenadas.slice();
                    
                // Mezclar los arrays, excepto el primer elemento
                solucionUno = [solucionUno[0], ...shuffleArray(solucionUno.slice(1))];
                solucionDos = [solucionDos[0], ...shuffleArray(solucionDos.slice(1))];
                solucionTres = [solucionTres[0], ...shuffleArray(solucionTres.slice(1))];
                solucionCuatro = [solucionCuatro[0], ...shuffleArray(solucionCuatro.slice(1))];

                // Imprimir los arrays
                 printArrays();

                    
            }

            function printArrays() {
                const fitnessSolucionUno = calcularFitness(solucionUno);
                const fitnessSolucionDos = calcularFitness(solucionDos);
                const fitnessSolucionTres = calcularFitness(solucionTres);
                const fitnessSolucionCuatro= calcularFitness(solucionCuatro);

                console.log("Solución 1: ", solucionUno);
                console.log("Fitness S1 es: ", fitnessSolucionUno);

                console.log("Solución 2: ", solucionDos);
                console.log("Fitness S2 es: ", fitnessSolucionDos);

                 console.log("Solución 3: ", solucionTres);
                console.log("Fitness S3 es: ", fitnessSolucionTres);

                console.log("Solución 4: ", solucionCuatro);
                console.log("Fitness S4 es: ", fitnessSolucionCuatro);
                
                //Seleccion por torneo 
                const soluciones = [solucionUno, solucionDos, solucionTres, solucionCuatro];
                const tamTorneo = 2;
                const padre1 = seleccionPorTorneo(soluciones, tamTorneo);
                const padre2 = seleccionPorTorneo(soluciones, tamTorneo);
                
                console.log("Los padres son: ", padre1 ," y ", padre2);
            }

            // Obtener el botón de borrar puntos
            const clearPointsButton = document.getElementById("clear-points");
            
            clearPointsButton.addEventListener("click", function() {
                //Añadir codigo por que aun tenia errores
            });

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

                // Actualizar el valor del input con el número de puntos
                const numPoints = points.length;
                const numDestinoInput = document.getElementById("NDestino");
                numDestinoInput.value = numPoints;

                // Incrementar el contador de puntos
                pointCount++;
            }

            //Fondo de canvas
            function changeImage() {

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
                pointCount = 1;

               // Añadir el punto de inicio a la lista HTML
                pointListItem.innerText = `Inicio.- (${startPoint.x}, ${startPoint.y})`;
                pointList.appendChild(pointListItem);

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
                const indicesAleatorios = Array.from({ length: tamTorneo }, () => Math.floor(Math.random() * numSoluciones));
                let mejorFitness = Number.NEGATIVE_INFINITY;
                
                let mejorSolucion;

                for (const indice of indicesAleatorios) {
                    const solucion = soluciones[indice];
                    const fitness = calcularFitness(solucion);
                    
                    if (fitness > mejorFitness) {
                    mejorFitness = fitness;
                    mejorSolucion = solucion;
                    }
                }

                return mejorSolucion;
            }



        </script>

    </body>
</html>
