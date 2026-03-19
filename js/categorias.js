/**DataTable */
tablaControlCategorias = $('#tablaCategorias').DataTable({
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
        url: "/Postreria/controllers/controllerCategorias.php",
        type: "POST",
        data: {
            opcion: "lista-categorias"
        }
    },

    //mapeamos las columnas  con los datos que nos devuelve el servidor
    columns: [
        { data: "id" },
        { data: "nombre" },
        { data: "icono" },
        { data: "activo" },
        { data: "fechacreacion" },
        { data: "accion" }
    ]
});