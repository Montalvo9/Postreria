<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>


</header>
<header class="header">
    <div class="header-left">
        <div class="header-logo">Dulce R<span>&</span>ncón</div>
        <nav class="header-nav">
            <!--POS ------>
            <a href="/Postreria/vistas/dashboard.php" class="nav-link active"><i class="fas fa-home" style="font-size:15px;"></i> POS</a>

            <!-- Usuarios   -->
            <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
                <a href="/Postreria/vistas/usuarios/usuarios.php" class="nav-link active"><i class="fa-solid fa-users" style="font-size: 15px;"></i> Usuarios</a>
            <?php endif ?>

            <!-- Productos  -->
            <a href="/Postreria/vistas/productos/productos.php" class="nav-link active"><i class="fa-solid fas fa-box" style="font-size: 15px;"></i> Productos</a>

            <a href="#" class="nav-link active"><i class="fas fa-file-alt" style="font-size: 15px;"></i>Reportes</a>
            <a href="/Postreria/controllers/cerrarSesion.php" class="nav-link active"><i class="fas fa-sign-out-alt" style="font-size: 15px;"></i> Salir</a>
        </nav>
    </div>
    <div class="header-right">
        <div class="cashier-badge">
            <i class="fas fa-user"></i> <?php echo $_SESSION['usuario']; ?>
            <br>
            <i class="fas fa-user-shield"></i> <?php echo $_SESSION['rol']; ?>
        </div>
    </div>
</header>