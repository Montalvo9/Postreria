function setPeriod(periodo, element) {
    /**Quitamos la clase active, la clase activa es la que resaltar el elemento en el que estamos */
    document.querySelectorAll(".date-btn").forEach(btn => {
        btn.classList.remove('active');
    });
    if (element.tagName === "BUTTON") {
        element.classList.add("active");
    }

    let fecha = null;

    if (periodo === "custom") {
        fecha = element.value;
    }

    $.ajax({
        url: "/Postreria/controllers/controllerVentas.php",
        type: 'POST',
        dataType: 'json',
        data: {
            opcion: "obtener-reporte",
            periodo: periodo,
            fecha: fecha
        },
        success: function(response) {
            console.log("La respuesta del dervidor es:", response);

            let total = response.resultado.total;

            $("#total-ventas").text("$" + total.toLocaleString());

        }
    })




}