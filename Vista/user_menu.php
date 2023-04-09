<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ia_bbdd";

    $conn = new mysqli($servername, $username, $password, $dbname);
    
    session_start();
    if (isset($_SESSION["username"])) {
        $username = $_SESSION["username"];

        // Obtener las coordenadas del usuario de la tabla de usuarios
        $sql = "SELECT nombre, latitud, longitud, rol FROM usuarios WHERE usuario = '$username'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $nombre = $row["nombre"];
            $latitud = $row["latitud"];
            $longitud = $row["longitud"];
            $rol = $row["rol"];
        } else {
            echo "No se encontraron las coordenadas del usuario.";
        }
    } else {
        header("Location: ../index.html");
        echo "Debes iniciar sesión primero";
        exit(); 
    }
?>