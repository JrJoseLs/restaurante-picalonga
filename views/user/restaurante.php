<?php
require_once "../../config.php"; // Importar archivo de configuración de la base de datos

// Lógica para obtener mesas disponibles
$sql_mesas_disponibles = "SELECT * FROM mesas WHERE estado = 'disponible'";
$result_mesas_disponibles = $conn->query($sql_mesas_disponibles);

// Lógica para obtener mesas ocupadas
$sql_mesas_ocupadas = "SELECT * FROM mesas WHERE estado = 'ocupada'";
$result_mesas_ocupadas = $conn->query($sql_mesas_ocupadas);

// Lógica para crear una nueva factura
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['crear_factura'])) {
    $id_mesa = $_POST['id_mesa'];
    $total = $_POST['total'];

    $sql_crear_factura = "INSERT INTO facturas (id_mesa, total) VALUES ('$id_mesa', '$total')";

    if ($conn->query($sql_crear_factura) === TRUE) {
        // Actualizar el estado de la mesa a 'ocupada'
        $sql_actualizar_estado = "UPDATE mesas SET estado = 'ocupada' WHERE id = '$id_mesa'";
        $conn->query($sql_actualizar_estado);
        echo "Factura creada correctamente.";
    } else {
        echo "Error al crear la factura: " . $conn->error;
    }
}

$conn->close();
?>
