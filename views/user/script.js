// MESAS
document
    .getElementById("reservaForm")
    .addEventListener("submit", function (event) {
        event.preventDefault();
        var formData = new FormData(this);
        fetch("../../views/user/reservar.php", {
            method: "POST",
            body: formData,
        })
            .then((response) => response.text())
            .then((data) => {
                alert(data);
                window.location.reload();
            })
            .catch((error) => {
                console.error("Error:", error);
            });
    });

// desocupar mesa
function desocuparMesa(id) {
    fetch(`../../views/admin/desocupar.php?id=${id}`, {
        method: "GET",
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error("Error al desocupar la mesa");
            }
            return response.text();
        })
        .then((data) => {
            alert(data);
            // Actualizar la tabla de mesas después de desocupar
            actualizarTablaMesas();
        })
        .catch((error) => {
            console.error("Error:", error);
        });
}

function actualizarTablaMesas() {
    fetch("../../views/user/mesas.php")
        .then((response) => response.text())
        .then((data) => {
            document.getElementById("tablaMesas").innerHTML = data;
        })
        .catch((error) => {
            console.error("Error:", error);
        });
}
