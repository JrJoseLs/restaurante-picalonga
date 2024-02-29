<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Conexión a la base de datos
    require_once "../../config.php"; // Importar archivo de configuración de la base de datos

    
    // Actualizar estado de la mesa a 'disponible'
    $sql = "UPDATE mesas SET estado = 'disponible' WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        echo 'Mesa desocupada correctamente.';
    } else {
        echo 'Error al desocupar la mesa: ' . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
