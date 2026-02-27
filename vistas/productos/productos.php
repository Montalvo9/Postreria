<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/Postreria/CSS/principal.css">
    <link rel="stylesheet" href="/Postreria/CSS/usuarios.css">
    <link rel="stylesheet" href="/Postreria/librerias/bootstrap/CSS/bootstrap.min.css">

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/Postreria/librerias/libreriasGenerales.php'; ?>
</head>

<body>
    <?php include '../../componentes/encabezado.php'; ?>
    <!--  MAIN-->
    <div class="container-personalizado">
        <!-- Left panel -->
        <div class="left-panel">
            <div class="form-header">
                <div class="form-eyebrow">Gestión de productos</div>
                <h2 class="form-title" id="form-title">Nuevo <em>producto</em></h2>
                <p class="form-subtitle">Completa los campos para agregar un nuevo producto</p>
            </div>
            <form id="frmRegistroProducto">
                <div class="form-section">
                    <!-- Nombre del producto-->
                    <div class="form-group">
                        <label class="form-label" for="nombre">Nombre del producto <span class="required">*</span></label>
                        <input type="text" class="form-input" id="nombre" placeholder="Ej: Fresas con crema" required />
                    </div>

                    <!-- Descripción -->
                    <div class="form-group">
                        <label class="form-label" for="id-descripcion">
                            Descripción <span class="required">*</span>
                        </label>
                        <textarea class="form-input" id="id-descripcion" rows="2"></textarea>
                    </div>
                    <!-- Precio -->
                    <div class="form-group">
                        <label class="form-label" for="precio">Precio</label>
                        <input class="form-input" type="text" inputmode="decimal" id="precio">
                    </div>

                    <!-- STOCK -->
                    <div class="form-group">
                        <label class="form-label" for="stock">Stock</label>
                        <input class="form-input" type="text" inputmode="numeric" id="stock" require>
                    </div>

                    <!-- CATEGORIA -->
                    <div class="form-group">
                        <label class="form-label">Categoria</label>
                        <select class="form-input" name="id_categoria" id="id_categoria">
                            <option value="">Categoria</option>
                        </select>
                    </div>

                    <!-- ACTIONS -->
                    <div class="form-actions">
                        <button type="button" class="btn btn-secondary" onclick="cancelarForm()">
                            <i class="fas fa-times"></i>
                            <span>Cancelar</span>
                        </button>

                        <button type="button" class="btn btn-primary" id="submit-btn" onclick="registrarProducto()">
                            <i class="fas fa-check"></i>
                            <span id="submit-text">Agregar producto</span>
                        </button>
                    </div>

                </div>

            </form>
        </div>
        <!-- FIN Left panel -->

        <!-- Inicio del panel derecho donde estara la tabla con los productos -->
        <div class="right-panel">

            <div class="panel-header">
                <div class="panel-title">
                    <span class="icon"><i class="fas fa-cubes"></i></span>
                    Listado de productos
                </div>

                <div class="panel-stats">
                    <div class="stat-badge">
                        <span class="icon"><i class="fas fa-user"></i></span>
                        <span id="total-productos">0</span> usuarios
                    </div>

                    <div class="stat-badge">
                        <span class="s-emoji">✅</span>
                        <span id="productos-activos">0</span> activos
                    </div>
                </div>
            </div>

            <!-- TABLA -->
             <div class="table-container" id="table-container">
                <div id="tablaProductosLoad">
                    <?php include '../../componentes/tablas/tablaProductos.php'; ?>
                </div>
            </div>
        </div>
        <!-- Fin del panel derecho -->

    </div>
    <!-- Fin del contenido main que es el contenido o div donde estan ambos paneles (derecho e izquiero) -->

</body>

</html>

<script>
    document.getElementById("stock").addEventListener("input", function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    document.getElementById("precio").addEventListener("input", function() {
        this.value = this.value.replace(/[^0-9.]/g, '');
    });
</script>