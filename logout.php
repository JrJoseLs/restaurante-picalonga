<?php
// Iniciar la sesión si no está iniciada
session_start();

// Destruir todas las variables de sesión
$_SESSION = array();

// Finalmente, destruir la sesión
session_destroy();

// Redirigir a la página de inicio o a donde prefieras
header("Location: index.html");
exit();
?>
