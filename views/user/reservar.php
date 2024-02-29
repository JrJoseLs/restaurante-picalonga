<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['numero_mesa'])) {
    $numero_mesa = $_POST['numero_mesa'];

    // Conexión a la base de datos
    require_once "../../config.php"; // Importar archivo de configuración de la base de datos


    
    // Verificar si la mesa está disponible
    $sql_check = "SELECT id FROM mesas WHERE numero_mesa = $numero_mesa AND estado = 'disponible'";
    $result_check = mysqli_query($conn, $sql_check);
    if (mysqli_num_rows($result_check) > 0) {
        // Actualizar estado de la mesa a 'ocupada'
        $sql_update = "UPDATE mesas SET estado = 'ocupada' WHERE numero_mesa = $numero_mesa";
        if (mysqli_query($conn, $sql_update)) {
            echo 'Mesa #' . $numero_mesa . ' reservada correctamente.';
        } else {
            echo 'Error al reservar la mesa: ' . mysqli_error($conn);
        }
    } else {
        echo 'La mesa #' . $numero_mesa . ' no está disponible para reservar.';
    }

    mysqli_close($conn);
} else {
    // Código para mostrar las mesas disponibles si no se está realizando una reserva
    $conn = mysqli_connect('localhost', 'usuario', 'contraseña', 'basededatos');
    if (!$conn) {
        die('Error al conectarse a la base de datos: ' . mysqli_connect_error());
    }

    // Consulta para obtener las mesas disponibles
    $sql = "SELECT id, numero_mesa FROM mesas WHERE estado = 'disponible'";
    $result = mysqli_query($conn, $sql);

    // Mostrar las mesas disponibles
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="mesa disponible">';
            echo 'Mesa #' . $row['numero_mesa'];
            echo '<a href="reservar.php?id=' . $row['id'] . '">Reservar</a>';
            echo '</div>';
        }
    } else {
        echo 'No hay mesas disponibles en este momento.';
    }

    mysqli_close($conn);
}
?>
