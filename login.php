<?php
// Datos de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ia_bbdd";

// Conexión a la base de datos
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Comprobación de errores de conexión
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Procesamiento de los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Obtener los valores de los campos del formulario
  $username = $_POST["username"];
  $password = $_POST["password"];

  // Validación de los campos del formulario
  if (empty($username)) {
    echo "Por favor, introduce tu nombre de usuario.";
  } elseif (empty($password)) {
    echo "Por favor, introduce tu contraseña.";
  } else {
    // Comprobar si el usuario y la contraseña son correctos
    $sql = "SELECT * FROM usuarios WHERE usuario = '$username' AND contrasena = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
      //echo "¡Bienvenido, $username!";
      session_start();
      $_SESSION["username"] = $username;
      header("Location: Vista/info.php");
    } else {
      echo "El nombre de usuario o la contraseña son incorrectos.";
    }
  }
}

// Cierre de la conexión a la base de datos
mysqli_close($conn);
?>
