function cancelarForm() {
    document.getElementById('frmRegistroCategoria').reset();
}


function cancelarFormEditar() {
    document.getElementById('frmEditarCategoria').reset();
}




/**DataTable.....................................................*/
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


/**Funcion para registrar categorias */

function registrarCategoria() {
    const formulario = document.getElementById('frmRegistroCategoria');

    //Validamos ek formulario que se llenen todos los campos

    if (!formulario.checkValidity()) {
        formulario.reportValidity();
        return;
    }

    //Obtenemos los datos del formulario
    let categoria = {
        opcion: "insertar-categoria",
        nombre: document.getElementById('idnombre').value,
        icono: document.getElementById('idicono').value,
    };

    $.ajax({
        url: "/Postreria/controllers/controllerCategorias.php",
        type: "POST",
        data: categoria,
        dataType: 'json',
        success: function(response) {
            if (response.status === "success") {

                Swal.fire({
                    title: response.mensaje,
                    icon: "success",
                    timer: 1500,
                    showConfirmButton: false
                });

                formulario.reset();

                if (typeof tablaControlCategorias !== 'undefined') {
                    tablaControlCategorias.ajax.reload(null, false);
                }

            } else {

                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: response.mensaje
                });

            }
        },
        error: function() {
            Swal.fire({
                icon: "error",
                title: "Error de conexión",
                text: "No se pudo conectar con el servidor"
            });
        }
    });

}


function obtenerDatos(id) {
    document.getElementById("idCategoriaSeleccionado").value = id;
    $('#editarCategoriaModal').modal('show');

    //llammos a la funcion que se encarga de traer los datos 
    obtenerDatosCategoria(id);
}

function obtenerDatosCategoria(id) {
    $.ajax({
        url: "/Postreria/controllers/controllerCategorias.php",
        type: 'POST',
        data: {
            opcion: 'obtenerDatos-categoria',
            idcategoria: id
        },
        success: function(item) {
            // console.log("Datos del item:", item);

            //llenamos los inputs con los datos 
            document.getElementById("id-editarnombre").value = item.nombre;
            document.getElementById("id-editaricono").value = item.icono;
            document.getElementById("editarActivo").value = item.activo;
        },
        error: function(xhr) {
            console.log(xhr.responseText); //para debuguear
        }

    });
}

/**FUNCION EDITAR CATEGORIA */
function editarCategoria() {
    //Validamos el formuario 
    const formulario = document.getElementById("frmEditarCategoria");
    if (!formulario.checkValidity()) {
        formulario.reportValidity();
        return;
    }


    const idCategoria = document.getElementById("idCategoriaSeleccionado").value;
    const nombre = document.getElementById("id-editarnombre").value;
    const icono = document.getElementById("id-editaricono").value;
    const estado = document.getElementById("editarActivo").value;

    let categoria = {
        opcion: "editar-categoria",
        idCategoria: idCategoria,
        nombre: nombre,
        icono: icono,
        estado: estado
    };

    //console.log(categoria)
    $.ajax({
        url: '/Postreria/controllers/controllerCategorias.php',
        type: 'POST',
        data: categoria,
        dataType: 'json',
        success: function(response) {
            if (response.status == "success") {
                Swal.fire({
                    title: response.mensaje,
                    icon: "success",
                    timer: 1500,
                    showConfirmButton: false
                });
                formulario.reset();
                $('#editarCategoriaModal').modal('hide'); //cerrar modal

                if (typeof tablaControlCategorias !== 'undefined') {
                    tablaControlCategorias.ajax.reload(null, false);
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