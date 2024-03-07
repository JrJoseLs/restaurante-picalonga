// Realizar una solicitud AJAX para obtener el número de usuarios + reservas
var xhr = new XMLHttpRequest();
xhr.open("GET", "mostrar_usuarios.php", true);
xhr.onload = function () {
    if (xhr.status >= 200 && xhr.status < 300) {
        var response = JSON.parse(xhr.responseText);
        document.getElementById("total-usuarios").textContent =
            response.total_usuarios;
    } else {
        console.error("Error al obtener el número de usuarios");
    }
};
xhr.onerror = function () {
    console.error("Error de conexión");
};
xhr.send();

// Realizar una segunda solicitud AJAX para obtener el número de reservas
var xhr2 = new XMLHttpRequest();
xhr2.open("GET", "mostrar_reservaciones.php", true);
xhr2.onload = function () {
    if (xhr2.status >= 200 && xhr2.status < 300) {
        var response = JSON.parse(xhr2.responseText);
        document.getElementById("total_reservas").textContent =
            response.total_reservas;
    } else {
        console.error("Error al obtener el número de reservas");
    }
};
xhr2.onerror = function () {
    console.error("Error de conexión");
};
xhr2.send();
