/*  Las siguientes funciones son para el boton de cancelar en e¿el formulario 
de registrar a un usuario*/

/*
Esta funcin sirve para insertar  y la de abajo es para ambos (insertar y editar)
function selectRole(element, rol) {
    document.querySelectorAll('.role-card').forEach(card => {
        card.classList.remove('selected');
    });

    element.classList.add('selected');
    document.getElementById('idrol').value = rol;
}*/

function selectRole(element, rol) {

    const form = element.closest('form');

    form.querySelectorAll('.role-card').forEach(card => {
        card.classList.remove('selected');
    });

    element.classList.add('selected');

    const hiddenInput = form.querySelector('input[name="rol"]');
    if (hiddenInput) {
        hiddenInput.value = rol;
    }
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

function resetFormEditar() {
    // ejemplo: limpiar todos los campos del formulario
    document.getElementById('frmEditarUsuario').reset();

    // si necesitas limpiar algo más manualmente:
    document.querySelectorAll('.role-card').forEach(card => {
        card.classList.remove('selected');
    });
    document.getElementById('rol-input').value = '';
}

function cancelarFormEditar() {
    resetFormEditar()
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

    if (!formulario.checkValidity()) {
        formulario.reportValidity();
        return;
    }

    let users = {
        opcion: "insertar-usuarios",
        nombre: document.getElementById("idnombre").value,
        usuario: document.getElementById("idusuario").value,
        password: document.getElementById("idpassword").value,
        rol: document.getElementById("idrol").value,
    };

    $.ajax({
        url: '/Postreria/controllers/controllerUsuario.php',
        type: 'POST',
        data: users,
        dataType: 'json', //  IMPORTANTE
        success: function(response) {

            console.log("Respuesta del servidor:", response);

            if (response.status === "success") {

                Swal.fire({
                    title: response.mensaje,
                    icon: "success",
                    timer: 1500,
                    showConfirmButton: false
                });

                formulario.reset();

                if (typeof tablaControlUsuarios !== 'undefined') {
                    tablaControlUsuarios.ajax.reload(null, false);
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

/**Esta funcion abre el modal pero trae los datos del usario selecionado y se rellenal al modal paa editar solamente el campo deseado
 * y los traemos por id.
 */
function obtenerDatos(id) {
    document.getElementById("idUsuarioSeleccionado").value = id;
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

function editarUsuario() {

    const formulario = document.getElementById("frmEditarUsuario");

    if (!formulario.checkValidity()) {
        formulario.reportValidity();
        return;
    }

    const idusuario = document.getElementById("idUsuarioSeleccionado").value;
    const nombre = document.getElementById("editarNombre").value;
    const usuario = document.getElementById("editarNombreDeUsuario").value;
    const password = document.getElementById("editarPassword").value;
    const rol = document.getElementById("editarRol").value;
    const estado = document.getElementById("editarActivo").value;

    let user = {
        opcion: "editar-usuario",
        id: idusuario,
        nombre: nombre,
        usuario: usuario,
        password: password,
        rol: rol,
        estado: estado
    };

    console.log(user);

    $.ajax({
        url: "/Postreria/controllers/controllerUsuario.php",
        type: 'POST',
        data: user,
        success: function(data) {
            console.log("Respuesta del servidor:", data);
            if (data == 1) {
                Swal.fire({
                    title: "Usuario editado correctamente",
                    icon: "success",
                    timer: 1500
                });
                $("#editarUsuarioModal").modal('hide');
                tablaControlUsuarios.ajax.reload(null, false);
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "¡Error al editar el usuario!",
                });
            }
        }
    });
}

function eliminarUsuario(id) {
    Swal.fire({
        title: "¿Eliminar?",
        text: "¿Seguro que desea eliminar el usuario?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#26b04d",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, eliminar"
    }).then((result) => {
        if (result.isConfirmed) {
            const datos = {
                "opcion": "eliminar-usuario",
                "idusuario": id,
            };

            $.ajax({
                url: '/Postreria/controllers/controllerUsuario.php',
                type: 'POST',
                data: datos,
                success: function(data) {
                    if (data == 1) {
                        Swal.fire({
                            title: "Eliminado",
                            text: "Usuario eliminado con éxito",
                            icon: "success",
                            timer: 1500,
                            showConfirmButton: false

                        });

                        tablaControlUsuarios.ajax.reload(null, false);
                    } else {
                        Swal.fire({
                            title: "Error",
                            text: "No se pudo eliminar el usuario",
                            icon: "error"
                        });
                    }
                }
            });
        }
    });
}