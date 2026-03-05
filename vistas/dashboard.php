<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../models/modeloProducto.php';

$modelo = new modeloProducto();
$productos = $modelo->consulta();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de administración</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/Postreria/CSS/principal.css">

    <link rel="stylesheet" href="/Postreria/librerias/bootstrap/CSS/bootstrap.min.css">

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/Postreria/librerias/libreriasGenerales.php'; ?>
</head>

<body>
    <!-- Header o encabezado -->
    <?php include '../componentes/encabezado.php'; ?>
    <!-- MAIN Contenedor principal-->
    <div class="main">
        <!-- Left: Productos (panel donde se muestra el catalogo de productos) -->
        <div class="left-panel">
            <div class="mesa-bar">
                <span class="mesa-label">Mesas</span>
                <button class="mesa-btn active" onclick="seleccionarMesa(1, this)">1</button>
                <button class="mesa-btn active" onclick="seleccionarMesa(1, this)">1</button>
                <button class="mesa-btn" onclick="seleccionarMesa(2, this)">2</button>
                <button class="mesa-btn" onclick="seleccionarMesa(3, this)">3</button>
                <button class="mesa-add" onclick="agregarMesa()">＋</button>
            </div>
            <!-- CATEGORÍAS -->
            <div class="cat-bar">
                <button class="cat-btn active" onclick="filtrarCat('todos', this)"><span class="cat-emoji">🌸</span>Todo</button>
                <button class="cat-btn" onclick="filtrarCat('crepas', this)"><span class="cat-emoji">🫔</span>Crepas</button>
                <button class="cat-btn" onclick="filtrarCat('fresas', this)"><span class="cat-emoji">🍓</span>Fresas</button>
                <button class="cat-btn" onclick="filtrarCat('helados', this)"><span class="cat-emoji">🍦</span>Helados</button>
                <button class="cat-btn" onclick="filtrarCat('bebidas', this)"><span class="cat-emoji">🥤</span>Bebidas</button>
                <button class="cat-btn" onclick="filtrarCat('waffles', this)"><span class="cat-emoji">🧇</span>Waffles</button>
                <button class="cat-btn" onclick="filtrarCat('postres', this)"><span class="cat-emoji">🍮</span>Postres</button>
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
                    <span class="ticket-mesa-badge" id="ticket-mesa">Mesa 1</span>
                </div>
                <div class="ticket-meta" id="ticket-hora">—</div>

                <div class="ticket-items" id="ticket-items">
                    <div class="empty-state" id="empty-state">
                        <div class="empty-state-icon">🍰</div>
                        <div class="empty-state-text">Agrega productos<br>al pedido</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="/Postreria/js/productos.js"></script>
</body>

</html>