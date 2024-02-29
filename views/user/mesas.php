<?php
// Conexión a la base de datos
    require_once "../../config.php"; // Importar archivo de configuración de la base de datos

    
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

// Consulta para obtener las mesas ocupadas
$sql_ocupadas = "SELECT id, numero_mesa FROM mesas WHERE estado = 'ocupada'";
$result_ocupadas = mysqli_query($conn, $sql_ocupadas);

// Mostrar las mesas ocupadas
if (mysqli_num_rows($result_ocupadas) > 0) {
    echo '<h2>Mesas Ocupadas</h2>';
    while ($row = mysqli_fetch_assoc($result_ocupadas)) {
        echo '<div class="mesa ocupada">';
        echo 'Mesa #' . $row['numero_mesa'];
        echo '<a href="desocupar.php?id=' . $row['id'] . '">Desocupar</a>';
        echo '</div>';
    }
}

mysqli_close($conn);
?>
