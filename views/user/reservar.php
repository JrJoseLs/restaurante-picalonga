<?php
require_once "../../config.php"; // Importar archivo de configuración de la base de datos

$nombre_cliente = $_POST['nombre_cliente'];
$telefono = $_POST['telefono'];
$fecha_reserva = $_POST['fecha_reserva'];
$hora_reserva = $_POST['hora_reserva'];
$num_personas = $_POST['num_personas'];

$sql = "SELECT * FROM mesas WHERE disponible = TRUE";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $mesa_id = $row['id'];
        $sql = "SELECT * FROM reservas WHERE mesa_id = '$mesa_id' AND fecha_reserva = '$fecha_reserva' AND hora_reserva = '$hora_reserva'";
        $check_result = $conn->query($sql);
        if ($check_result->num_rows == 0) {
            $sql = "INSERT INTO reservas (nombre_cliente, telefono, fecha_reserva, hora_reserva, num_personas, mesa_id)
            VALUES ('$nombre_cliente', '$telefono', '$fecha_reserva', '$hora_reserva', $num_personas, $mesa_id)";
            if ($conn->query($sql) === TRUE) {
                $sql = "UPDATE mesas SET disponible = FALSE WHERE id = $mesa_id";
                $conn->query($sql);
                echo "Reserva realizada exitosamente!";
            } else {
                echo "Error al realizar la reserva: " . $conn->error;
            }
            break;
        }
    }
} else {
    echo "No hay mesas disponibles en ese momento.";
}

$conn->close();
?>
