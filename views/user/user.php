<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Restaurante</title>
    <!-- Aquí puedes incluir CSS si lo deseas -->
    <style>
        .mesa {
            display: inline-block;
            border: 1px solid black;
            padding: 10px;
            margin: 10px;
        }
    </style>
</head>

<link rel="stylesheet" href="../../assets/css/adm.css">
<link rel="icon" type="image/svg+xml" href="https://cdn-icons-png.flaticon.com/512/3170/3170733.png" />

<body>


    <?php
    session_start();
    
    // Verificar si el usuario ha iniciado sesión
    if(isset($_SESSION['nombre'])){
        $nombre_usuario = $_SESSION['nombre'];
        echo "<h2>Bienvenido, $nombre_usuario</h2>";
    } else {
        echo "<h2>No has iniciado sesión</h2>";
    }
    ?>

    <!--Navbar-->
    <div class="navbar">
        <div class="logo">
            <img src="https://cdn-icons-png.flaticon.com/512/616/616445.png" alt="Logo">
        </div>
        <div class="nav-buttons">
            <a href="user.php">Inicio</a>
            <a href="#">Acerca de</a>
            <a href="#">Contacto</a>
            <form action="../../logout.php" method="post">
                <button type="submit">Cerrar Sesión</button>
            </form>
        </div>
    </div>

    <!--RESTAURANTE-->
    <h1>Reservar Mesa</h1>
    <form id="reservaForm">
        <label for="nombre_cliente">Nombre del Cliente:</label>
        <input type="text" id="nombre_cliente" name="nombre_cliente" required><br>
        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="telefono" required><br>
        <label for="fecha_reserva">Fecha de Reserva:</label>
        <input type="date" id="fecha_reserva" name="fecha_reserva" required><br>
        <label for="hora_reserva">Hora de Reserva:</label>
        <input type="time" id="hora_reserva" name="hora_reserva" required><br>
        <label for="num_personas">Número de Personas:</label>
        <input type="number" id="num_personas" name="num_personas" min="1" required><br>
        <button type="submit">Reservar</button>
    </form>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="script.js"></script>
</body>

</html>