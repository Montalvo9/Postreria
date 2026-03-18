/**
 * Funcion para limpiar los campos al presionar el boton cancelar del formulario 
 * /
 * */
function cancelarForm() {
    //console.log("Probando función...");
}

function limpiarFormRegistrar() {

}

/**------------------------------------------------------------------------------------- */

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

/**CARGAR CATEGORIA PARA MODAL */
function cargarCategoriaModal() {
    $.post('/Postreria/controllers/controllerProducto.php', { opcion: 'obtener-categoria' },
        function(response) {
            // console.log(response)
            let select = $('#id_categoria_modal');
            select.find('option:not(:first)').remove();

            response.forEach(t => {
                select.append(`<option value="${t.id_categoria}">${t.nombre}</option>`);
            });

        },
        'json'
    );
}
$(document).ready(function() {
    cargarCategoriaModal();
});




/** */
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

/**Abrir el modal de editar productos */
function obtenerDatos(id) {
    //console.log(id);
    document.getElementById('idProductoSeleccionado').value = id;
    $('#editarProductoModal').modal('show');
    obtenerDatosProducto(id);
}

function obtenerDatosProducto(id) {
    $.ajax({
        url: '/Postreria/controllers/controllerProducto.php',
        type: 'POST',
        data: {
            opcion: 'obtener-datos-producto',
            id_producto: id,
        },
        /**success es una función callback que 
         * jQuery ejecuta automáticamente cuando el servidor responde correctamente.
         * item solo es el nombre que le llamo a la respuesta que manda el server php*/
        success: function(item) {
            //console.log("veamos que viene en el ", item);

            //Asignamos los valores a esos inuts del modal 
            document.getElementById('editarNombre').value = item.nombre;
            document.getElementById('editar-descripcion').value = item.descripcion;
            document.getElementById('editar-precio').value = item.precio;
            document.getElementById('editar-stock').value = item.stock;

            // ESTAS FALTAN
            $('#id_categoria_modal').val(item.categoria);
            $('#editarActivo').val(item.activo);
        },
        error: function(xhr) {
            console.error(xhr.responseText); // para debug
        }
    });



}


/**FUNCION EDITAR PRODUCTO */
function editarProducto() {
    //  console.log('Probando la función editar');
    /**Validar los campos obligatorios  */

    const formulario = document.getElementById('frmEditarProducto');

    if (!formulario.checkValidity()) { //si el formulario no es valido
        formulario.reportValidity();
        return;
    }


    /**Recoge los datos de los inputs para mandarlos al controller y este se lo mande a la consulta del 
     * modelo y este ultimo haga la ejecución de la consulta
     */

    const id = document.getElementById('idProductoSeleccionado').value;
    const nombre = document.getElementById('editarNombre').value;
    const descripcion = document.getElementById('editar-descripcion').value;
    const precio = document.getElementById('editar-precio').value;
    const stock = document.getElementById('editar-stock').value;
    const categoria = document.getElementById('id_categoria_modal').value;
    const activo = document.getElementById('editarActivo').value;
    //creamos el objeto para agruparlos y mandarlos por ajax
    let productos = {
        "opcion": "editar-producto",
        "id_producto": id,
        "nombre": nombre,
        "descripcion": descripcion,
        "precio": precio,
        "stock": stock,
        "categoria": categoria,
        "activo": activo
    };
    /*console.log("Que tiene produc?");
    console.log(product);*/

    $.ajax({
        url: '/Postreria/controllers/controllerProducto.php',
        type: 'POST',
        data: productos,
        dataType: 'json',
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
                $('#editarProductoModal').modal('hide'); // cerrar modal
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

/**FUNCION ELIMINAR PRODUCTO */

function eliminarProducto(id) {
    Swal.fire({
        title: "¿Eliminar?",
        text: "¿Seguro que deseas eliminar este producto?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#26b04d",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "No quiero eliminar"
    }).then((respuesta) => {

        if (respuesta.isConfirmed) {

            const datos = {
                opcion: 'eliminar-producto',
                id_producto: id
            };

            $.ajax({
                url: '/Postreria/controllers/controllerProducto.php',
                type: 'POST',
                data: datos,

                success: function(data) {

                    if (data == "1") {

                        Swal.fire({
                            title: "Eliminado",
                            text: "Producto eliminado con éxito",
                            icon: "success",
                            timer: 1500,
                            showConfirmButton: false
                        });

                        tablaControlProductos.ajax.reload(null, false);

                    } else {

                        Swal.fire({
                            title: "Error",
                            text: "No se pudo eliminar el producto",
                            icon: "error"
                        });

                    }
                },

                error: function() {
                    Swal.fire({
                        title: "Error",
                        text: "Error en la comunicación con el servidor",
                        icon: "error"
                    });
                }

            });

        }

    });
}



//-------------------------------------------------

let metodoPago = "efectivo";
let carrito = {
    items: [],
    descuento: null
};

let categoriaActual = "todos";
let busquedaActual = "";


document.querySelectorAll(".product-card").forEach(card => {
    card.addEventListener("click", function() {

        const id = this.dataset.id;
        const nombre = this.dataset.nombre;
        const precio = parseFloat(this.dataset.precio);

        //console.log(nombre);

        agregarProducto(id, nombre, precio);

        // Feedback visual
        this.classList.add("selected");
        setTimeout(() => {
            this.classList.remove("selected");
        }, 150);
    });
});

function agregarProducto(id, nombre, precio) {

    //console.log("Probando");
    const existente = carrito.items.find(p => p.id === id); //- .find(...) busca dentro de ese arreglo el primer producto cuyo id coincida con el id que recibimos como parámetro


    if (existente) {
        existente.qty++;
    } else {
        carrito.items.push({
            id: id,
            nombre: nombre,
            precio: precio,
            qty: 1
        });
    }

    //console.log(carrito); // para que veas cómo va creciendo
    renderCarrito(); //Toma lo que hay en el objeto carrito (la memoria) y lo dibuja en el HTML (la pantalla).
}

function renderCarrito() {
    // Esta función pinta lo que seleciona el usuario y lo agrega al carrito 
    /**Comtainer es la variable donde tomamos ese contenedor para ir agregando los prouctos */

    const container = document.getElementById("ticket-items");
    //Validamos si hay productos en el carrito
    if (!carrito.items.length) {
        container.innerHTML = `
           <div class="empty-state">
                Agrega productos al pedido
            </div>
        `;
        actualizarTotales(0, 0); //"Como no hay productos, subtotal = 0 y total = 0"
        return;
    }

    container.innerHTML = carrito.items.map(item => `
      <div class="ticket-item">
      <div class="item-info">
        
        <div class="item-details">
          <div class="item-name">${item.nombre}</div>
          <div class="item-unit">$${item.precio.toFixed(2)} cada uno</div>
        </div>
      </div>
      <div style="display:flex;align-items:center;gap:8px">
        <div class="item-controls">
          <button class="qty-btn minus" onclick="cambiarCantidad(${item.id}, -1)">−</button>
          <span class="qty-num">${item.qty}</span>
          <button class="qty-btn" onclick="cambiarCantidad(${item.id}, 1)">+</button>
        </div>
        <div class="item-total">$${(item.precio * item.qty).toFixed(2)}</div>
      </div>
    </div>
  `).join('');
    calcularTotales();
}



function renderCarrito() {
    // Esta función pinta lo que seleciona el usuario y lo agrega al carrito 
    /**Comtainer es la variable donde tomamos ese contenedor para ir agregando los prouctos */

    const container = document.getElementById("ticket-items");
    //Validamos si hay productos en el carrito
    if (!carrito.items.length) {
        container.innerHTML = `
           <div class="empty-state">
                Agrega productos al pedido
            </div>
        `;
        actualizarTotales(0, 0); //"Como no hay productos, subtotal = 0 y total = 0"
        return;
    }

    container.innerHTML = carrito.items.map(item => `
      <div class="ticket-item">
      <div class="item-info">
        
        <div class="item-details">
          <div class="item-name">${item.nombre}</div>
          <div class="item-unit">$${item.precio.toFixed(2)} cada uno</div>
        </div>
      </div>
      <div style="display:flex;align-items:center;gap:8px">
        <div class="item-controls">
          <button class="qty-btn minus" onclick="cambiarCantidad(${item.id}, -1)">−</button>
          <span class="qty-num">${item.qty}</span>
          <button class="qty-btn" onclick="cambiarCantidad(${item.id}, 1)">+</button>
        </div>
        <div class="item-total">$${(item.precio * item.qty).toFixed(2)}</div>
      </div>
    </div>
  `).join('');
    calcularTotales();
}

/**Esta funcion es la que decremrta o incrementa los productos */
function cambiarCantidad(id, delta) {
    // delta es es la variable de cambio, cuando incrementamos o decrementamos el producto
    id = Number(id); //  aseguramos tipo número porque   id es de tipo number pero dentro de carrito es string 

    const item = carrito.items.find(p => Number(p.id) === id);

    if (!item) return;

    item.qty += delta;

    if (item.qty <= 0) {
        carrito.items = carrito.items.filter(p => Number(p.id) !== id);
    }

    // Si después de filtrar el carrito está vacío, forzamos los totales a 0
    if (carrito.items.length === 0) {
        actualizarTotales(0, 0, 0);
    }

    renderCarrito();
}

/**Funcion para el descuento del carrito y hacerlo funcional */
function toggleDescuento() {
    const panel = document.getElementById('descuento-panel');
    const arrow = document.getElementById('desc-arrow');
    if (panel.style.display === 'none') {
        panel.style.display = 'flex';
        arrow.textContent = '▾';
    } else {
        panel.style.display = 'none';
        arrow.textContent = '▸';
    }
}
/**Selecionar el descuento si en porcentaje o en pesos (monto) */
let descTipo = null; //descTipo  se refiere al tipo de descuento que se aplicara ya sea por monto o porcentaje


function tipodesc(tipo) {
    //console.log(tipo);
    descTipo = tipo;
    document.getElementById('btn-pct').classList.toggle('active', tipo === 'porcentaje');
    document.getElementById('btn-monto').classList.toggle('active', tipo === 'monto');

}
/**Aplicar el descuento cuando le den click al boton de calcular */
function aplicarDescuento() {
    const valor = parseFloat(document.getElementById('desc-valor').value);

    if (!valor || valor <= 0) {
        showToast('¡Error!', 'Ingresa un descuento valido');
        return;
    }

    carrito.descuento = {
        tipo: descTipo,
        descuento: valor
    };

    renderCarrito();
    toastr.options = {
        "positionClass": "toast-bottom-right"
    };
    toastr.success("Descuento aplicado");


}


/**Calcular los totales */
function calcularTotales() {
    let subtotal = 0;
    let descuento = 0;

    carrito.items.forEach(item => {
        subtotal += item.precio * item.qty;
    });

    //Calcular si hay descuento 
    if (carrito.descuento) {
        if (carrito.descuento.tipo === "porcentaje") {
            descuento = subtotal * (carrito.descuento.descuento / 100);
        }

        if (carrito.descuento.tipo === "monto") {
            descuento = carrito.descuento.descuento;
        }

        // El descuento no debe ser mayor al subtotal 
        if (descuento > subtotal) {
            descuento = subtotal
            toastr.warning("El descuento no puede ser mayor al subtotal");
        }
    }
    let total = subtotal - descuento;

    actualizarTotales(subtotal, descuento, total);

    return total;
}
/** Esta funcion pintara los resultados de las operaciones */
function actualizarTotales(subtotal, descuento, total) {
    // Asegurar que siempre sean números
    subtotal = Number(subtotal) || 0;
    descuento = Number(descuento) || 0;
    total = Number(total) || 0;

    document.getElementById("subtotal-val").textContent = `$${subtotal.toFixed(2)}`;

    const descRow = document.getElementById("desc-row");

    if (descuento > 0) {
        descRow.style.display = "flex";
        document.getElementById("desc-display").textContent = `-$${descuento.toFixed(2)}`;
    } else {
        descRow.style.display = "none";
    }

    document.getElementById("total-val").textContent = `$${total.toFixed(2)}`;
}

/**Funcion para abrir el modal cobro */

function abrirModalCobro() {
    if (!carrito.items.length) {
        toastr.error("El pedido esta vacio", "error");
        return; //el return detiene la funcion (si no existiera aunque este vacio la función aria el calculo)
    }




    const total = calcularTotales();

    document.getElementById('modal-total-amount').textContent = `$${total.toFixed(2)}`;
    document.getElementById('modal-cobro').classList.add('show');
    document.getElementById('pago-con').value = '';
    document.getElementById('cambio-row').style.display = 'none';


}

/**Funcion cerrar modal 
 * Cierra el modal al dar clik en el boton Cancelar
 */

function cerrarModal() {
    document.getElementById('modal-cobro').classList.remove('show');
}

/**Funcion de selecionar pago */
function selectPago(tipo) {
    metodoPago = tipo;
    ['efectivo', 'tarjeta', 'transferencia'].forEach(t => {
        document.getElementById(`pay-${t}`).classList.toggle('selected', t === tipo);
    });
    document.getElementById('cash-section').style.display = tipo === 'efectivo' ? 'block' : 'none';
}

/**Calcular el cambio */

function calculaCambio() {
    const total = calcularTotales();
    const pagoCon = parseFloat(document.getElementById('pago-con').value) || 0;
    const cambioRow = document.getElementById('cambio-row')

    if (pagoCon >= total) {
        cambioRow.style.display = 'flex';
        document.getElementById('cambio-val').textContent = `$${(pagoCon - total).toFixed(2)}`;
    } else {
        cambioRow.style.display = 'none';
    }

}


/**Confiramar cobro */

function confirmarCobro() {

    let total = calcularTotales();
    let pagoCon = parseFloat(document.getElementById('pago-con').value) || 0;
    let cambio = 0;

    if (metodoPago === "efectivo") {

        if (pagoCon < total) {
            toastr.error('El pago es insuficiente', 'Error');
            return;
        }

        cambio = pagoCon - total;
    }

    let venta = {
        opcion: "guardar-venta",
        total: total,
        pago: pagoCon,
        cambio: cambio,
        metodo_pago: metodoPago,
        items: JSON.stringify(carrito.items) //mandamos e onjeto en json( controller lo recibe)
    };

    //console.log(venta); 

    $.ajax({
        url: '/Postreria/controllers/controllerVentas.php',
        type: 'POST',
        data: venta,
        dataType: 'json',

        success: function(response) {
            console.log("Que trae el response", response)

            if (response.status === "success") {

                cerrarModal();
                limpiarCarrito();
                toastr.success(response.mensaje);

            } else {

                toastr.warning(response.mensaje);

            }

        },
        error: function(xhr, status, error) {
            // Solo entra aquí si el PHP EXPLOTÓ (Error 500) o el JSON está roto
            console.error("Error técnico:", error);
            console.log("Respuesta del servidor:", xhr.responseText);
            toastr.error("Error crítico en el servidor. Revisa la consola.");
        }
    });

}

function limpiarCarrito() {

    carrito.items = []; // vacía los productos
    carrito.descuento = null; // quita el descuento si existe
    actualizarTotales(0, 0, 0);

    renderCarrito(); // vuelve a pintar el carrito vacío

}

/*Muestra los productos por categoria*/

function filtrarCat(categoria, boton) {
    //console.log("La ategoria oprimida es", categoria)
    categoriaActual = categoria;


    // cambiar botón activo
    document.querySelectorAll(".cat-btn").forEach(btn => {
        btn.classList.remove("active");
    });

    boton.classList.add("active");
    aplicarFiltros();
}


/**FUNCION PARA BUSCAR LOS PRODUCTOS */
function buscarProducto(valor) {

    busquedaActual = valor.toLowerCase();

    aplicarFiltros();
}

function aplicarFiltros() {

    const productos = document.querySelectorAll(".product-card");

    productos.forEach(producto => {

        const nombre = producto.dataset.nombre.toLowerCase();
        const categoria = producto.dataset.categoria;

        const coincideBusqueda = nombre.includes(busquedaActual);
        const coincideCategoria = categoriaActual === "todos" || categoria === categoriaActual;

        if (coincideBusqueda && coincideCategoria) {
            producto.style.display = "block";
        } else {
            producto.style.display = "none";
        }

    });

}