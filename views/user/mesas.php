<?php
require_once "../../config.php"; // Importar archivo de configuración de la base de datos

$sql = "SELECT * FROM mesas WHERE disponible = TRUE";
$result = $conn->query($sql);

$mesas = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $mesas[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($mesas);

$conn->close();
?>
