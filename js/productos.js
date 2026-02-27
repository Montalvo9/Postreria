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