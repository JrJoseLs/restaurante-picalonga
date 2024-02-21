<?php
// // Conexión a la base de datos
// $conn = new mysqli("localhost", "usuario", "contraseña", "basededatos");

// // Verificar conexión
// if ($conn->connect_error) {
//     die("Error de conexión: " . $conn->connect_error);
// }

// import database
// require_once "../config.php";

// Manejar las solicitudes HTTP
$method = $_SERVER['REQUEST_METHOD'];

require_once "../../config.php";

switch ($method) {
    case 'GET':
        // Operación Leer (GET)
        $sql = "SELECT * FROM usuarios";
        $result = $conn->query($sql);
        $usuarios = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $usuarios[] = $row;
            }
            echo json_encode($usuarios);
        } else {
            echo "No hay usuarios.";
        }
        break;

    case 'POST':
        // Operación Crear (POST)
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $contraseña = $_POST['contraseña'];
        $rol = $_POST['rol'];

        $sql = "INSERT INTO usuarios (nombre, correo, contraseña, rol) VALUES ('$nombre', '$correo', '$contraseña', '$rol')";
        if ($conn->query($sql) === TRUE) {
            echo "Usuario creado exitosamente.";
        } else {
            echo "Error al crear el usuario: " . $conn->error;
        }
        break;

    case 'PUT':
        // Operación Actualizar (PUT)
        parse_str(file_get_contents("php://input"), $_PUT);
        $id = $_PUT['id'];
        $nombre = $_PUT['nombre'];
        $correo = $_PUT['correo'];
        $contraseña = $_PUT['contraseña'];
        $rol = $_PUT['rol'];

        $sql = "UPDATE usuarios SET nombre='$nombre', correo='$correo', contraseña='$contraseña', rol='$rol' WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo "Usuario actualizado exitosamente.";
        } else {
            echo "Error al actualizar el usuario: " . $conn->error;
        }
        break;

    case 'DELETE':
        // Operación Eliminar (DELETE)
        parse_str(file_get_contents("php://input"), $_DELETE);
        $id = $_DELETE['id'];

        $sql = "DELETE FROM usuarios WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo "Usuario eliminado exitosamente.";
        } else {
            echo "Error al eliminar el usuario: " . $conn->error;
        }
        break;

    default:
        echo "Método no soportado.";
        break;
}

$conn->close();
?>
