<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ia_bbdd";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Conexión fallida: " . $conn->connect_error);
}

$usuario = $_POST["usuario"];
$contrasena = $_POST["contrasena"];

$sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND contrasena = '$contrasena'";
$result = $conn->query($sql);

// Verificar conexión
if ($conn->connect_error) {
  die("La conexión a la base de datos falló: " . $conn->connect_error);
}
echo "La conexión a la base de datos fue exitosa!";

if ($result->num_rows == 1) {
  $response = array("success" => true);
  header("Location: Vista/index.html");
  exit();
} else {
  $response = array("success" => false, "message" => "Nombre de usuario o contraseña incorrectos");
}

echo json_encode($response);
$conn->close();
?>