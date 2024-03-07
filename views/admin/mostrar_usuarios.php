<?php
require_once "../../config.php"; 


// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta SQL para obtener el número de usuarios
$sql = "SELECT COUNT(*) AS total_usuarios FROM usuarios";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Obtener el número de usuarios y devolverlo como JSON
    $row = $result->fetch_assoc();
    echo json_encode(array('total_usuarios' => $row["total_usuarios"]));
} else {
    echo json_encode(array('total_usuarios' => 0));
}

// Cerrar la conexión
$conn->close();
?>
