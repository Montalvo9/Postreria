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

            let total = response.resultado.total || 0;

            $("#total-ventas").text("$" + total.toLocaleString());

        }
    })




}
/** Esto para que este activo el boton de hoy sin tener que darle click si no en cuanto entro a reportes como esta activo hoy 
 * debe mostrar el total de ventas totales
 */
document.addEventListener("DOMContentLoaded", function() {

    let botonActivo = document.querySelector(".date-btn.active");

    if (botonActivo) {
        setPeriod("hoy", botonActivo);
    }

});