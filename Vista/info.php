<?php include('user_menu.php'); ?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>TSP</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="../assets/img/icono.png" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../css/styles.css" rel="stylesheet" />
    </head>

    <body>

        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <img src="../assets/img/icono.png" alt="" style="width: 30px;">
                <a class="navbar-brand" href="#!">- Problema del Agente Viajero -</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="inicio.php">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link" aria-current="page" href="TSP.php">TSP</a></li>
                        <li class="nav-item"><a class="nav-link " aria-current="page" href="configuracion.php">Configuración</a></li>
                        <li class="nav-item"><a class="nav-link" href="info.php"><img src="../assets/img/info_a.png"></a></li>
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
                            <h1 class="fw-bolder mb-1">¿Que es el TSP?</h1>
                            <!-- Post meta content-->
                            <div class="text-muted fst-italic mb-2">Problema del Agente Viajero</div>
                        </header>
                        <!-- Preview image figure-->
                        <figure class="mb-4"><img class="img-fluid rounded" src="../assets/img/puntos.png" alt="..." /></figure>
                        <!-- Post content-->
                        <section class="mb-5">
                            <p class="fs-5 mb-4" style="text-align: justify;">En el Problema del Agente Viajero – TSP (Travelling Salesman Problem), el objetivo es encontrar 
                                un recorrido completo que conecte todos los nodos de una red, visitándolos tan solo una vez y volviendo al punto de partida, y que además minimice 
                                la distancia total de la ruta, o el tiempo total del recorrido.</p>
                        </section>
                    </article>

                </div>
                <!-- Side widgets-->
                <div class="col-lg-4">
                    <!-- Search widget-->
                    <div class="card mb-4">
                        <div class="card-header">Datos relevantes</div>
                        <div class="card-body" style="text-align: justify;">
                            <p>El TSP es uno de los problemas incluidos en la lista de los siete problemas del milenio del Instituto Clay de Matemáticas, por lo que 
                            su resolución es uno de los mayores desafíos matemáticos actuales.</p>
                            <p>El TSP tiene una amplia variedad de aplicaciones en áreas como la logística, la planificación de rutas de transporte, el diseño de circuitos 
                                integrados, la química y la biología, entre otras.</p>
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
    </body>
</html>
