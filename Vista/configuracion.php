<?php include('user_menu.php'); ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
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
            .mostrar-formulario {
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
                        <li class="nav-item"><a class="nav-link" href="#">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link" aria-current="page" href="TSP.php">TSP</a></li>
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="configuracion.php">Configuración</a></li>
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
                            <h1 class="fw-bolder mb-1">Configuración</h1>
                            <!-- Post meta content-->
                            <div class="text-muted fst-italic mb-2">En este apartado se encuentra su información</div>
                        </header>

                    </article>
                    <!-- Comments section-->
                    <section class="mb-5">
                        <div class="card bg-light">
                            <div class="card-body">
                                <Label>Nombre</Label>
                                <input type="text" name="Nombre" id="Nombre" value="<?php echo $nombre; ?>" disabled style="width: 140px;">
                                
                                <Label>Rol</Label>
                                <input type="text" name="Rol" id="Rol" value="<?php echo $rol; ?>" disabled style="width: 140px;">
                            </div>
                            
                            <div class="card-body">
                                <Label>Coordenadas Casa:</Label>
                                <input type="text" name="CoordenadaX" id="CoordenadaX" value="<?php echo $latitud; ?>" style="width: 120px;">
                                <input type="text" name="CoordenadaY" id="CoordenadaY" value="<?php echo $longitud; ?>" style="width: 120px;"> 
                            </div>
                        </div>
                    </section>
                </div>
                <!-- Side widgets-->
                <div class="col-lg-4">
                    <div class="container">
                        <div class="row">
                            <div class="card mb-4">
                                <div class="card-header" onclick="mostrarFormulario()">Agregar Destino</div>
                                    <div class="card-body" id="formulario-destino" style="display: none;">
                                        <form id="formulario-destino">
                                            <div class="form-group">
                                                <label for="nombre">Nombre:</label>
                                                <input type="text" class="form-control" id="nombre" name="nombre" required style="width:200px;">
                                            </div>

                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th><label for="latitud">Latitud (Y)</label></th>
                                                        <th><label for="longitud">Longitud (X)</label></th>
                                                    </tr>
                                                </thead>
                                                <tbody >
                                                    <td><input type="number" class="form-control" id="latitud" name="latitud" step="0.000001" required></td>
                                                    <td><input type="number" class="form-control" id="longitud" name="longitud" step="0.000001" required></td>
                                                </tbody>
                                        </table>
                                            <button type="submit" class="btn btn-primary">Agregar</button>
                                        </form>
                                    </div>
                            </div>

                            <div class="card mb-4">
                                <div class="card-header" onclick="mostrarBody()">Destinos Guardados</div>
                                <div class="card-body" id="card-body" style="display: none;">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Latitud</th>
                                                <th>Longitud</th>
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
        </div>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">TSP - Abril 2023</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>

        <!--Scrips-->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script src="../js/main.js"></script>

        <script>
            function mostrarBody() {
                var cardBody = document.getElementById("card-body");
                cardBody.classList.toggle("mostrar-body");
            }
            function mostrarFormulario() {
                var formulario = document.getElementById("formulario-destino");
                formulario.classList.toggle("mostrar-formulario");
            }

        </script>



    </body>
</html>