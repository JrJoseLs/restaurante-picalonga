<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];
    $rol = $_POST['rol'];

    // $conn = new mysqli("localhost", "root", "", "restaurante");

    // if ($conn->connect_error) {
    //     die("Error de conexión: " . $conn->connect_error);
    // }
    // Importar el archivo de conexión
    require_once "config.php";

    $sql = "INSERT INTO usuarios (nombre, correo, contraseña, rol) VALUES ('$nombre', '$correo', '$contraseña', '$rol')";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.html");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
