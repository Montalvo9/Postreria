<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**Veridica si exoste esa variable de session que pasa al loguearse
 * si no se loguea no hay variable y quiza quieren entrara directo con la url , ejemplo :
 * http://localhost/Postreria/vistas/dashboard.php
 */
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}


require_once __DIR__ . '/../models/modeloProducto.php';

$modelo = new modeloProducto();
//$productos = $modelo->consulta(); //este hace una cinsulta de los productos general
$productos = $modelo ->productosActivos();
$categorias = $modelo->obtenerCategoria();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de administración</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/Postreria/librerias/bootstrap/CSS/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="/Postreria/CSS/principal.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/Postreria/librerias/libreriasGenerales.php'; ?>
</head>

<body>
    <!-- Header o encabezado -->
    <?php include '../componentes/encabezado.php'; ?>
    <!-- MAIN Contenedor principal-->
    <div class="main">
        <!-- Left: Productos (panel donde se muestra el catalogo de productos) -->
        <div class="left-panel">
            <!--<div class="mesa-bar">
                <span class="mesa-label">Mesas</span>
                <button class="mesa-btn active" onclick="seleccionarMesa(1, this)">1</button>
                <button class="mesa-btn active" onclick="seleccionarMesa(1, this)">1</button>
                <button class="mesa-btn" onclick="seleccionarMesa(2, this)">2</button>
                <button class="mesa-btn" onclick="seleccionarMesa(3, this)">3</button>
                <button class="mesa-add" onclick="agregarMesa()">＋</button>
            </div> -->
            <!-- CATEGORÍAS -->
            <div class="cat-bar">
                <!-- En HTML + JavaScript, this significa "este elemento que se está clickeando". -->
                <button class="cat-btn active" onclick="filtrarCat('todos', this)">
                    <span class="cat-emoji">🌸</span>Todo
                </button>
                <!-- Recorremos las categorias que vienen de la consulta a la bd -->
                <?php foreach ($categorias as $cat): ?>

                    <button class="cat-btn"
                        onclick="filtrarCat('<?= strtolower($cat['nombre']) ?>', this)">

                        <span class="cat-emoji"><?= $cat['icono'] ?></span>
                        <?= $cat['nombre'] ?>

                    </button>

                <?php endforeach; ?>

            </div>


            <!-- BÚSQUEDA -->
            <div class="search-wrap">
                <span class="search-icon">🔍</span>
                <input type="text" placeholder="Buscar producto..." oninput="buscarProducto(this.value)" />
            </div>

            <!-- GRID -->
            <div class="products-grid" id="products-grid">

                <?php foreach ($productos as $producto): ?>

                    <div class="product-card"
                        data-id="<?= $producto['id_producto'] ?>"
                        data-nombre="<?= $producto['nombre'] ?>"
                        data-precio="<?= $producto['precio'] ?>"
                        data-categoria="<?= strtolower($producto['nombre_categoria']) ?>">
                        


                        <h4 class="product-name"><?= $producto['nombre'] ?></h4>
                        <p class="product-price">$<?= number_format($producto['precio'], 2) ?></p>

                    </div>

                <?php endforeach; ?>

            </div>
        </div>
        <div class="right-panel">

            <div class="ticket-header">
                <div class="ticket-title">
                    Pedido
                    <!--<span class="ticket-mesa-badge" id="ticket-mesa">Mesa 1</span>-->
                </div>
                <div class="ticket-meta" id="ticket-hora">—</div>
            </div>

            <!-- LISTA DE PRODUCTOS (SCROLL) -->
            <div class="ticket-items" id="ticket-items">
                <div class="empty-state" id="empty-state">
                    <div class="empty-state-icon">🍰</div>
                    <div class="empty-state-text">Agrega productos<br>al pedido</div>
                </div>
            </div>

            <!--Descuento Este modulo funciona solo que lo deje para una version 2
    <div class="discount-section">
        <div class="discount-toggle" onclick="toggleDescuento()">
            <span id="desc-arrow">▸</span> Aplicar descuento
        </div>
        <div class="descuento-panel" id="descuento-panel" style="display: none;">
            <div class="discount-row">
                <input type="number" name="desc-valor" id="desc-valor" placeholder="10" min="0">
                <div class="discount-type">
                    <button id="btn-pct" class="active" onclick="tipodesc('porcentaje')">%</button>
                    <button id="btn-monto" onclick="tipodesc('monto')">$</button>
                </div>
                <button class="discount-apply" onclick="aplicarDescuento()"> <i class="fa-solid fa-check"></i>
                </button>
            </div>
        </div>
    </div>  
    -->

            <!-- FOOTER (FIJO ABAJO) -->
            <div class="ticket-footer">

                <!--TOTALES -->
                <div class="totals" id="totales">
                    <div class="total-row"><span>Subtotal:</span><span id="subtotal-val">$0.00</span></div>
                    <div class="total-row discount-row-display" id="desc-row" style="display:none">
                        <span>🏷 Descuento</span><span id="desc-display">-$0.00</span>
                    </div>
                    <div class="total-row grand"><span>Total</span><span id="total-val">$0.00</span></div>
                </div>

                <!-- ACCIONES (abrir el modal, limpiar, imprimir ticket, nuevo pedido, limpiar pedido-->
                <div class="actions">
                    <button class="btn-cobrar" onclick="abrirModalCobro()">
                        <i class="fas fa-credit-card"></i> Cobrar
                    </button>
                    <div class="btn-row">
                        <button class="btn-secondary" style="background-color: blue; color:white" onclick="imprimirTicket()">
                            <i class="fas fa-print"></i>Ticket
                        </button>
                        <button class="btn-secondary" style="background-color: red; color: white" onclick="limpiarCarrito()">
                            <i class="fas fa-trash"></i>Limpiar
                        </button>
                    </div>
                </div>

            </div>

            <!--MODAL DE COBRO -->
            <?php include __DIR__ . '/../componentes/modales/ModalCobro.php'; ?>

        </div>

    </div>



    <!-- Librería Toastr -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Tu JS -->
    <script src="/Postreria/js/productos.js"></script>
</body>

</html>