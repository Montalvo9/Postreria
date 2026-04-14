<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de ventas</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/Postreria/CSS/principal.css">
    <link rel="stylesheet" href="/Postreria/CSS/reportes.css">
    <link rel="stylesheet" href="/Postreria/librerias/bootstrap/CSS/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/Postreria/librerias/libreriasGenerales.php'; ?>
</head>

<body>
    <?php include '../../componentes/encabezado.php'; ?>

    <!-- MAIN -->
    <div class="container-reporte">
        <!--Encabezado del historial -->
        <div class="page-header">
            <div class="page-title">
                <i class="fas fa-history"></i>Historial de ventas
            </div>

            <div class="date-selector">
                <button class="date-btn active" onclick="setPeriod('hoy', this)">Hoy</button>
                <button class="date-btn" onclick="setPeriod('semana', this)">Semana</button>
                <button class="date-btn" onclick="setPeriod('mes', this)">Mes</button>
                <input type="date" class="date-input" id="date-custom" onchange="setPeriod('custom', this)" />
            </div>
        </div>
        <!-- Tabla que muestra el historial -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <?php include '../../componentes/tablas/tablaHistorial.php'; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- SCRIPS -->
    <script src="/Postreria/js/reportes.js"></script>
</body>

</html>