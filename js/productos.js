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
//-------------------------------------------------

let carrito = {
    items: [],
    descuento: null
};
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
    //calcularTotales();
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
    // calcularTotales();
}


function cambiarCantidad(id, delta) {

    id = Number(id); //  aseguramos tipo número porque   id es de tipo number pero dentro de carrito es string 

    const item = carrito.items.find(p => Number(p.id) === id);

    if (!item) return;

    item.qty += delta;

    if (item.qty <= 0) {
        carrito.items = carrito.items.filter(p => Number(p.id) !== id);
    }

    renderCarrito();
}