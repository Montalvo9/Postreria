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
    cargarTablaProductos(periodo, fecha);
    historialVentas(periodo, fecha);


}

function topVendidos(periodo, fecha = null) {
    //  console.log("Periodo:", periodo);
    // console.log("Fecha:", fecha);

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
            // console.log("Que esta mandando response:", response);
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



/*DATATABLE DE LA TABLA que muestra los productos vendidos (hoy, semana, mes, fecha selecionada manualmente) */
$(document).ready(function() {
    tablaProductosVendidos = $('#tablaProductosVendidos').DataTable({
        dom: 'Bfrtip',
        buttons: [
            { extend: 'csv', className: 'btn btn-info' },
            { extend: 'excel', className: 'btn btn-success' },
            { extend: 'pdf', className: 'btn btn-danger' },

            { extend: 'print', className: 'btn btn-warning' },
        ],
        language: {
            lengthMenu: "Mostrar MENU filas por página",
            zeroRecords: "No hay elementos que coincidan",
            info: "Mostrando página PAGE de PAGES",
            infoEmpty: "Mostrando 0 a 0 de 0 filas",
            infoFiltered: "(filtradas de MAX filas totales)",
            search: "Buscar:",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior",
            },
        },
        pageLength: 10,
        responsive: true,
        processing: true
    });

    //cargarmos los datos inciales (los datos de hoy porque esta es la que esta selecionada por default al entrar a  "reportes" )
    setPeriod('hoy', document.querySelector(".date-btn.active"));

});




/**Funcion que va a cargar y pintar los datos de la consulta */
function cargarTablaProductos(periodo, fecha = null) {
    $.ajax({
        url: "/Postreria/controllers/controllerVentas.php",
        type: 'POST',
        dataType: 'json',
        data: {
            opcion: 'productos-vendidos',
            periodo: periodo,
            fecha: fecha
        },
        success: function(response) {
            // console.log("Cuales son los productos vendidos que manda el server", response);
            /**LIMPIAR TABLA */
            tablaProductosVendidos.clear();
            if (!response.data || response.data.length === 0) {
                tablaProductosVendidos.draw(); //redibuja la tabla vacia
                return;
            }

            //agregar filas 
            response.data.forEach(prod => {
                tablaProductosVendidos.row.add([
                    prod.nombre,
                    prod.total_vendidos,
                    "$" + parseFloat(prod.total_generado).toFixed(2)

                ]);
            });

            //Redibuja la tabla
            tablaProductosVendidos.draw();

        }
    });
}
/**DATATABLE DEL HISTORIAL DE VENTAS */
let tablaHistorialVentas;
$(document).ready(function() {
    tablaHistorialVentas = $('#tablaHistorialVentas').DataTable({
        language: {
            lengthMenu: "Mostrar MENU filas por página",
            zeroRecords: "No hay elementos que coincidan",
            info: "Mostrando página PAGE de PAGES",
            infoEmpty: "Mostrando 0 a 0 de 0 filas",
            infoFiltered: "(filtradas de MAX filas totales)",
            search: "Buscar:",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior",
            },
        },
        pageLength: 10,
        responsive: true,
        processing: true

    });
    //cargarmos los datos inciales (los datos de hoy porque esta es la que esta selecionada por default al entrar a  "reportes" )
    setPeriod('hoy', document.querySelector(".date-btn.active"));

});







function historialVentas(periodo, fecha = null) {
    $.ajax({
        url: "/Postreria/controllers/controllerVentas.php",
        type: 'POST',
        dataType: 'json',
        data: {
            opcion: 'historial-ventas',
            periodo: periodo,
            fecha: fecha
        },
        success: function(response) {
            console.log("Respuesta del historial:", response);

            // 1. Limpiamos la tabla antes de meter datos nuevos
            tablaHistorialVentas.clear();

            if (response.status === "success" && response.data.length > 0) {

                // 2. Recorremos cada venta que nos mandó PHP
                response.data.forEach(venta => {

                    // Creamos el botón de imprimir (puedes usar un ícono de FontAwesome o texto)
                    let botonTicket = `
                        <button class="btn btn-warning btn-sm" onclick="reimprimirTicket(${venta.id_venta})">
                            <i class="fas fa-print"></i>Ticket
                        </button>
                    `;

                    // 3. Agregamos la fila a la DataTable
                    // Asegúrate de que el orden de las columnas coincida con tu HTML
                    tablaHistorialVentas.row.add([
                        `#${venta.id_venta}`,
                        venta.fecha,
                        venta.vendedor, // Este viene del INNER JOIN que hicimos
                        `$${venta.total}`,
                        botonTicket // Columna de acciones
                    ]);
                });

            } else {
                console.log("No se encontraron ventas en este periodo.");
            }

            // 4. MUY IMPORTANTE: Dibujamos los cambios en la tabla
            tablaHistorialVentas.draw();
        },
        error: function(err) {
            console.error("Error en la petición AJAX:", err);
        }
    });
}

function reimprimirTicket(id) {

    // Si ultimoIdVenta tiene valor, es porque se acaba de hacer una venta
    const url = `/Postreria/controllers/controllerVentas.php?opcion=ver-ticket&id_venta=${id}`;
    window.open(url, '_blank');
}