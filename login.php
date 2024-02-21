<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    // $conn = new mysqli("localhost", "root", "", "restaurante");

    // if ($conn->connect_error) {
    //     die("Error de conexión: " . $conn->connect_error);
    // }
    // Importar el archivo de conexión
    require_once "config.php";

    $sql = "SELECT id, nombre, rol FROM usuarios WHERE correo = '$correo' AND contraseña = '$contraseña'";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows == 1) {
        $row = $resultado->fetch_assoc();
        $_SESSION['id'] = $row['id'];
        $_SESSION['nombre'] = $row['nombre'];
        $_SESSION['rol'] = $row['rol'];

        if ($row['rol'] == 'usuario') {
            header("Location: views/user/user.html");
        } elseif ($row['rol'] == 'admin') {
            header("Location: views/admin/admin.html");
        }
        exit(); // Asegura que no se ejecute más código después de la redirección
    } else {
        echo "Credenciales incorrectas.";
    }

    $conn->close();
}
?>
