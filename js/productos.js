/**DATATABLE */
tablaControlProductos = $("#tablaProductos").DataTable({
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
    processing: true,
    ajax: {
        url: '/Postreria/controllers/controllerProducto.php',
        type: 'POST',
        data: {
            opcion: 'lista-productos'
        }


    },
    // Mapeamos las columnas para que se muestren los datos en la tabla (DataTable())
    columns: [
        { data: 'id' },
        { data: 'nombre' },
        { data: 'descripcion' },
        { data: 'precio' },
        { data: 'stock' },
        { data: 'categoria' },
        { data: 'activo' },
        { data: 'fecha_creacion' },
        { data: 'accion' }
    ]

});

function cargarCategoria() {
    $.post('/Postreria/controllers/controllerProducto.php', { opcion: 'obtener-categoria' },
        function(response) {
            //console.log(response);
            let select = $('#id_categoria');
            select.find('option:not(:first)').remove(); // elimina todas las opciones excepto la primera

            response.forEach(t => {
                select.append(`<option value="${t.id_categoria}">${t.nombre}</option>`);
            });
        },
        'json'
    );
}

$(document).ready(function() {
    cargarCategoria();
});

function registrarProducto() {
    const formulario = document.getElementById("frmRegistroProducto");

    if (!formulario.checkValidity()) {
        formulario.reportValidity();
        return;
    }

    //recolectamos los datos que se llegaran al controller 
    let productos = {
        "opcion": "insertar-producto",
        "nombre": document.getElementById("nombre").value,
        "descripcion": document.getElementById("id-descripcion").value,
        "precio": document.getElementById("precio").value,
        "stock": document.getElementById("stock").value,
        "categoria": document.getElementById("id_categoria").value,
    };

    //peticion AJAX

    $.ajax({
        url: '/Postreria/controllers/controllerProducto.php',
        type: 'POST',
        data: productos,
        dataType: 'json', //Esto ya que al validar datos que ingresa el usario con el backend el back devuelve json 
        success: function(response) {
            //console.log(response); linea para probar 

            if (response.status == "success") {
                Swal.fire({
                    title: response.mensaje,
                    icon: "success",
                    timer: 1500,
                    showConfirmButton: false
                });
                formulario.reset();
                if (typeof tablaControlProductos !== 'undefined') {
                    tablaControlProductos.ajax.reload(null, false);
                }
            } else {
                Swal.fire({
                    icon: "error",
                    title: "error",
                    text: response.mensaje
                });
            }
        },
        error: function() {
            Swal.fire({
                icon: "error",
                title: "Error de conexión",
                text: "No se pudo conectar al servidor"
            });
        }


    });
}