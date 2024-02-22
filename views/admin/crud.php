<?php
require_once "../../config.php"; // Importar archivo de configuración de la base de datos

// Verificar la conexión a la base de datos
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Manejar las solicitudes HTTP
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        // Operación Leer (GET)
        $sql = "SELECT * FROM usuarios";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $usuarios = $result->fetch_all(MYSQLI_ASSOC);
            echo json_encode($usuarios);
        } else {
            echo "No hay usuarios.";
        }
        break;

    case 'POST':
        // Operación Crear (POST)
        $nombre = $_POST['nombre'] ?? '';
        $correo = $_POST['correo'] ?? '';
        $contraseña = $_POST['contraseña'] ?? '';
        $rol = $_POST['rol'] ?? '';

        if ($nombre && $correo && $contraseña && $rol) {
            $sql = "INSERT INTO usuarios (nombre, correo, contraseña, rol) VALUES ('$nombre', '$correo', '$contraseña', '$rol')";
            if ($conn->query($sql) === TRUE) {
                echo "Usuario creado exitosamente.";
            } else {
                echo "Error al crear el usuario: " . $conn->error;
            }
        } else {
            echo "Faltan datos para crear el usuario.";
        }
        break;

    case 'PUT':
        // Operación Actualizar (PUT)
        parse_str(file_get_contents("php://input"), $_PUT);
        $id = $_PUT['id'] ?? '';
        $nombre = $_PUT['nombre'] ?? '';
        $correo = $_PUT['correo'] ?? '';
        $contraseña = $_PUT['contraseña'] ?? '';
        $rol = $_PUT['rol'] ?? '';

        if ($id && $nombre && $correo && $contraseña && $rol) {
            $sql = "UPDATE usuarios SET nombre='$nombre', correo='$correo', contraseña='$contraseña', rol='$rol' WHERE id=$id";
            if ($conn->query($sql) === TRUE) {
                echo "Usuario actualizado exitosamente.";
            } else {
                echo "Error al actualizar el usuario: " . $conn->error;
            }
        } else {
            echo "Faltan datos para actualizar el usuario.";
        }
        break;

    case 'DELETE':
        // Operación Eliminar (DELETE)
        parse_str(file_get_contents("php://input"), $_DELETE);
        $id = $_DELETE['id'] ?? '';

        if ($id) {
            $sql = "DELETE FROM usuarios WHERE id=$id";
            if ($conn->query($sql) === TRUE) {
                echo "Usuario eliminado exitosamente.";
            } else {
                echo "Error al eliminar el usuario: " . $conn->error;
            }
        } else {
            echo "Falta el ID del usuario a eliminar.";
        }
        break;

    default:
        echo "Método no soportado.";
        break;
}

$conn->close();
?>
