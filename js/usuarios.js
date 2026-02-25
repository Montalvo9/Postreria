/*  Las siguientes funciones son para el boton de cancelar en e¿el formulario 
de registrar a un usuario*/
function selectRole(element, rol) {
    document.querySelectorAll('.role-card').forEach(card => {
        card.classList.remove('selected');
    });

    element.classList.add('selected');
    document.getElementById('idrol').value = rol;
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
/*  Las siguientes funciones son para editar el tipo de rol al editar el usuario*/
function selectRoleEditar(element, rol) {
    document.querySelectorAll('#frmEditarUsuario .role-card').forEach(card => {
        card.classList.remove('selected');
    });

    element.classList.add('selected');
    document.getElementById('editarRol').value = rol;
}


function toggleStatus() {

    const toggle = document.getElementById('status-toggle');
    const text = document.getElementById('status-text');
    const emoji = document.getElementById('status-emoji');
    const input = document.getElementById('editarActivo');

    toggle.classList.toggle('active'); //active es de css, class list es la lista de clases css

    if (toggle.classList.contains('active')) {
        text.textContent = "Usuario activo";
        emoji.textContent = "✅";
        input.value = "1";
    } else {
        text.textContent = "Usuario inactivo";
        emoji.textContent = "❌";
        input.value = "0";
    }
}

function cargarEstadoEditar(activo) {

    const toggle = document.getElementById('status-toggle');
    const text = document.getElementById('status-text');
    const emoji = document.getElementById('status-emoji');
    const input = document.getElementById('editarActivo');

    if (activo == 1) {
        toggle.classList.add('active');
        text.textContent = "Usuario activo";
        emoji.textContent = "✅";
        input.value = "1";
    } else {
        toggle.classList.remove('active');
        text.textContent = "Usuario inactivo";
        emoji.textContent = "❌";
        input.value = "0";
    }
}


//------------------------------------------------------------------------------


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

function registrarUsuario() {
    const formulario = document.getElementById("formRegistroUsuario");
    /**Validamos el formulario (que se hayan llenado todos los campos) */
    if (!formulario.checkValidity()) { //checkValiditi devuelve true o false, cuando es true entra al if 
        formulario.reportValidity();
        return;
    }

    //Recolectamos todos los datos
    let users = {
        "opcion": "insertar-usuarios",
        "nombre": document.getElementById("idnombre").value,
        "usuario": document.getElementById("idusuario").value,
        "password": document.getElementById("idpassword").value,
        "rol": document.getElementById("idrol").value,
    };

    //Peticion AJAx
    $.ajax({
        url: '/Postreria/controllers/controllerUsuario.php',
        type: 'POST',
        data: users,
        success: function(data) {
            console.log("Datos que estan llegandp (que tiene data)", data);
            //Cinvertimos data a numero por si el servidor devuelve un string 
            if (parseInt(data) === 1) {
                Swal.fire({
                    title: "Usuario registrado con exito",
                    icon: "success",
                    timer: 1500,
                    showConfirmButton: false
                });

                //limpia el formulario
                formulario.reset();

                //recargar la tabla
                if (typeof tablaControlUsuarios !== 'undefined') {
                    tablaControlUsuarios.ajax.reload(null, false);
                }
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "El servidor no pudo procesar el registro",
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

/**Esta funcion abre el modal pero trae los datos del usario selecionado y se rellenal al modal paa editar solamente el campo deseado
 * y los traemos por id.
 */
function obtenerDatos(id) {
    document.getElementById("idUsuarioSelecionado").value = id;
    $('#editarUsuarioModal').modal('show');
    //Llamamos a la función que se encarga de traer los datos de los usuarios paara mosrarlos en el modal
    obtenerDatosUsuario(id);
}

function obtenerDatosUsuario(id) {
    $.ajax({
        url: "/Postreria/controllers/controllerUsuario.php",
        type: 'POST',
        dataType: 'json', //jquery parsea el json solo
        data: {
            opcion: 'obtenerDatosUsuario',
            idusuario: id
        },
        success: function(item) {
            console.log(item);

            document.getElementById('editarNombre').value = item.nombre;
            document.getElementById('editarNombreDeUsuario').value = item.usuario;

            cargarEstadoEditar(item.activo);

        },
        error: function(xhr) {
            console.log(xhr.responseText); //para debuguear
        }
    })
}