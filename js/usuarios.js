/*  Las siguientes funciones son para el boton de cancelar en e¿el formulario 
de registrar a un usuario*/
function selectRole(element, rol) {
    document.querySelectorAll('.role-card').forEach(card => {
        card.classList.remove('selected');
    });

    element.classList.add('selected');
    document.getElementById('rol-input').value = rol;
}

function resetForm() {
    // ejemplo: limpiar todos los campos del formulario
    document.getElementById('formRegistroUsuario').reset();

    // si necesitas limpiar algo más manualmente:
    document.querySelectorAll('.role-card').forEach(card => {
        card.classList.remove('selected');
    });
    document.getElementById('rol-input').value = '';
}

function cancelarForm() {
    resetForm();
}

/** ------------------------------------------------------------------*/

//DATATABLE
tablaControlUsuarios = $("#tablaUsuarios").DataTable({
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
        url: '/Postreria/controllers/controllerUsuario.php',
        type: 'POST',
        data: {
            opcion: 'lista-usuarios'
        }
    },
    // Mapeamos las columnas para que se muestren los datos en la tabla (DataTable())
    columns: [
        { data: 'id' },
        { data: 'nombre' },
        { data: 'usuario' },
        { data: 'rol' },
        { data: 'activo' },
        { data: 'fechacreacion' },
        { data: 'accion' }
    ]

});