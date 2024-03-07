<?php
require_once "../../config.php"; // Importar archivo de configuración de la base de datos

$sql = "SELECT * FROM mesas";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Mesas</title>
    <link rel="stylesheet" href="../../assets/css/adm.css">
</head>
<body>

    <a href="admin.html">Atras</a>
    <h1>Mesas Disponibles</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Hasta</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['nombre'] . "</td>";
                    if ($row['disponible']) {
                        echo "<td>Disponible</td>";
                        echo "<td>-</td>";
                        echo "<td>-</td>";
                    } else {
                        echo "<td>Ocupada</td>";
                        $sql_reserva = "SELECT * FROM reservas WHERE mesa_id = {$row['id']} ORDER BY hora_reserva DESC LIMIT 1";
                        $reserva_result = $conn->query($sql_reserva);
                        if ($reserva_result->num_rows > 0) {
                            $reserva = $reserva_result->fetch_assoc();
                            echo "<td>" . $reserva['hora_reserva'] . "</td>";
                        } else {
                            echo "<td>-</td>";
                        }
                        echo "<td><a href='../../views/admin/desocupar.php?id=" . $row['id'] . "'>Desocupar</a></td>";
                    }
                    echo "</tr>";
                }
            } else {
                echo "0 resultados";
            }
            ?>
        </tbody>
    </table>
</body>
</html>

<?php
$conn->close();
?>
