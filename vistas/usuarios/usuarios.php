<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/Postreria/CSS/principal.css">
    <link rel="stylesheet" href="/Postreria/CSS/usuarios.css">
    <link rel="stylesheet" href="/Postreria/librerias/bootstrap/CSS/bootstrap.min.css">

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/Postreria/librerias/libreriasGenerales.php'; ?>
</head>

<body>
    <?php include '../../componentes/encabezado.php'; ?>
    <div class="left-panel">
        <div class="panel-header">
            <div class="panel-title">
                <span class="emoji">🧁</span>
                Catálogo
            </div>
            <div class="panel-stats">
                <div class="stat-badge">
                    <span class="s-emoji">📦</span>
                    <span id="total-productos">0</span> productos
                </div>
                <div class="stat-badge">
                    <span class="s-emoji">🎯</span>
                    <span id="total-categorias">0</span> categorías
                </div>
            </div>
        </div>

</body>

</html>