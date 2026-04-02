/**Esta funcion sirve para mostrar el total de ventas por fechas, solo para la card total 
 * funciona con la funcion obtenerVentasTotales()
 */

function setPeriod_P(periodo, element) {
    //Quitamos la clase active, la clase activa es la que resaltar el elemento en el que estamos */
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


/**Funcion setPeriod mas completa donde entrega pinta los resulatdos en las 4 cards (Vetntas totales
 * Pedidos
 * producto mas vendidos
 * y cantidad de productos vendidos
) */

function setPeriod(periodo, element) {
    //Quitamos la clase active, la clase activa es la que resaltar el elemento en el que estamos */
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
            //console.log("La respuesta del dervidor es:", response);

            let total = response.resultado.ventas_totales || 0;
            let total_pedidos = response.resultado.numero_ventas || 0;
            let productos_vendidos = response.resultado.productos_vendidos || 0;
            let mas_vendido = response.resultado.producto_top;
            let promedio_ticket = response.resultado.ticket_promedio || 0;

            //pintamos las cards con los datos que devueñve el backend
            $("#total-ventas").text("$" + total.toLocaleString());
            $("#total-pedidos").text(total_pedidos.toLocaleString());
            $("#productos-vendidos").text(productos_vendidos.toLocaleString());
            $("#producto-mas-vendido").text(mas_vendido.toLocaleString());
            $("#promedio_ticket").text(promedio_ticket.toLocaleString());

        }
    });

    //funcion que carga el los top 10 productos mas vendidos
    topVendidos(periodo, fecha);
}

function topVendidos(periodo, fecha = null) {
    console.log("Periodo:", periodo);
    console.log("Fecha:", fecha);

    $.ajax({
        url: "/Postreria/controllers/controllerVentas.php",
        type: 'POST',
        dataType: 'json',
        data: {
            opcion: "top-vendidos",
            periodo: periodo,
            fecha: fecha,
            limite: 5
        },
        success: function(response) {
            console.log("Que esta mandando response:", response);
            const container = document.getElementById('top-products-list');
            container.innerHTML = '';

            if (response.data.length === 0) {
                container.innerHTML = `<div>No hay datos</div>`;
                return;
            }

            response.data.forEach((prod, index) => {
                let rank = index + 1;

                container.innerHTML += `
                <div class="product-row rank-${rank}">

                 <div class="product-rank rank-${rank}">
                ${rank}
                </div>

                 <div class="product-info">
                <div class="product-name">${prod.nombre}</div>
                <div class="product-sales">
                    ${prod.total_vendidos} vendidos
                </div>
                 </div>

                </div>
               `;

            });
        }
    });
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