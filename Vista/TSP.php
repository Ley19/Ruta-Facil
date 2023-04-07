<?php include('user_menu.php'); ?>

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
                <a class="navbar-brand" href="#!">Problema del Agente Viajero</a>
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

                            </div>
                        </div>
                        <div class="card bg-light">
                            <div class="" id="sketch-container"></div>
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
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Longitud</th>
                                                <th>Latitud</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tabla-destinos">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                </div>
            </div>
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>

        <script>
        
            // Definir algunas constantes
            const NUM_COLS = 14;
            const NUM_ROWS = 10;
            const CELL_SIZE = 50;
            const GRID_COLOR = 200;
      
            // Variable para los puntos
              let points = [];
      
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

            //Añadir imagen al punto de partida en el canvas
            let startPointImg;
            function preload() {
                startPointImg = loadImage('../assets/img/casa.png');
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
      
              // Se coloca el punto de inicio
                image(startPointImg, startPoint.x, startPoint.y, 20, 20);
                fill(0, 255, 0);
                ellipse(startPoint.x, startPoint.y, 10, 10);
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

        </script>

    </body>
</html>
