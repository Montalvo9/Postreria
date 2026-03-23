<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorias</title>

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/Postreria/CSS/principal.css">
    <link rel="stylesheet" href="/Postreria/CSS/usuarios.css">
    <link rel="stylesheet" href="/Postreria/librerias/bootstrap/CSS/bootstrap.min.css">

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/Postreria/librerias/libreriasGenerales.php'; ?>
</head>

<body>
    <?php include '../../componentes/encabezado.php'; ?>

    <!-- MAIN -->
    <div class="container-personalizado">

        <!-- LEFT PANEL (Aqui va el formulario) -->
        <div class="left-panel">
            <div class="form-header">
                <div class="form-eyebrow">Gestión de categorias</div>
                <h2 class="form-title" id="form-title">Nueva <em>categoria</em></h2>
                <p class="form-subtitle">Completa los campos para agregar una nueva categoria</p>
            </div>

            <!-- Formulario -->
            <form id="frmRegistroCategoria">
                <div class="form-section">
                    <!-- Nombre de la categoria -->
                    <div class="form-group">
                        <label class="form-label" for="idnombre">
                            Nombre de la categoria <span class="required">*</span>
                        </label>
                        <input type="text" class="form-input" id="idnombre" placeholder="Ej: Postres" required>
                    </div>

                    <!-- icono de la categoria -->
                    <div class="form-group">
                        <label class="form-label" for="idicono">
                            Icono de la categoria <span class="optional">(opcional)</span>
                        </label>
                        <input type="text" class="form-input" id="idicono" placeholder="Ej: 🍰">
                    </div>

                    <!-- ACTIONS -->
                    <div class="form-actions">
                        <button type="button" class="btn btn-secondary" onclick="cancelarForm()">
                            <i class="fas fa-times"></i>
                            <span>Cancelar</span>
                        </button>

                        <button type="button" class="btn btn-primary" id="submit-btn" onclick="registrarCategoria()">
                            <i class="fas fa-check"></i>
                            <span id="submit-text">Agregar categoria</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <!-- FIN LEFT PANEL -->

        <!-- RIGHT PANEL (Aqui va la tabla) -->
        <div class="right-panel">
            <div class="panel-header">
                <div class="panel-title">
                    <span class="icon"><i class="fas fa-th"></i></span>
                    Listado de categorías
                </div>
            </div>
            <!-- TABLA -->
            <div class="table-container" id="table-container">
                <div id="tablaCategoriasLoad">
                    <?php include '../../componentes/tablas/tablaCategorias.php'; ?>
                </div>
            </div>
        </div>
        <!-- FIN RIGHT PANEL -->
    </div>
    <!-- FIN MAIN -->

    <!-- Modal para editar categoria -->
     <?php include '../../componentes/modales/modalEditarCategoria.php'; ?>
</body>

</html>