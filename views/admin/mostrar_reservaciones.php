<?php
require_once "../../config.php"; 


// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta SQL para obtener el número de reservas
$sql = "SELECT COUNT(*) AS total_reservas FROM reservas";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Obtener el número de reservas y devolverlo como JSON
    $row = $result->fetch_assoc();
    echo json_encode(array('total_reservas' => $row["total_reservas"]));
} else {
    echo json_encode(array('total_reservas' => 0));
}

// Cerrar la conexión
$conn->close();
?>
