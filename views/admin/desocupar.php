<?php
require_once "../../config.php"; // Importar archivo de configuración de la base de datos

if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_mesa = $_GET['id'];
    
    $stmt = $conn->prepare("UPDATE mesas SET disponible = TRUE WHERE id = ?");
    $stmt->bind_param("i", $id_mesa);
    
    if ($stmt->execute()) {
        echo "Mesa desocupada exitosamente";
    } else {
        echo "Error al desocupar la mesa: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "ID de mesa inválido";
}

$conn->close();
?>
