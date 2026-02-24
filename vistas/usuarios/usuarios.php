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
    <!-- MAIN -->
    <div class="container-personalizado">
        <div class="left-panel">
            <div class="form-header">
                <div class="form-eyebrow">Gestión de usuarios</div>
                <h2 class="form-title" id="form-title">Nuevo <em>usuario</em></h2>
                <p class="form-subtitle">Completa los campos para agregar un nuevo usuario</p>
            </div>
            <form id="formRegistroUsuario">
                <div class="form-section">
                    <!-- Nombre completo -->
                    <div class="form-group">
                        <label class="form-label" for="nombre">Nombre completo <span class="required">*</span></label>
                        <input type="text" class="form-input" id="nombre" placeholder="Ej: Daniela" required />
                    </div>

                    <!-- Nombre de usuario -->
                    <div class="form-group">
                        <label class="form-label" for="usuario">Nombre de usuario<span class="required">*</span></label>
                        <input type="text" class="form-input" id="usuario" placeholder="Ej: Dani" require>
                    </div>

                    <!--Contraseña -->
                    <div class="form-group">
                        <label class="form-label" for="password">Contraseña<span class="required">*</span></label>
                        <input type="password" class="form-input" id="idpassword" require>
                    </div>

                    <!-- ROL -->
                    <div class="form-group">
                        <div class="role-grid">
                            <div class="role-card" onclick="selectRole(this, 'vendedor')">
                                <span class="role-icon"><i class="fas fa-user-tie fa-2x"></i></span>
                                <div class="role-name">Vendedor</div>
                                <div class="role-desc">Realiza ventas</div>
                            </div>

                            <div class="role-card" onclick="selectRole(this, 'admin')">
                                <span class="role-icon"><i class="fas fa-key fa-2x"></i></span>
                                <div class="role-name">Admin</div>
                                <div class="role-desc">Acceso total</div>
                            </div>

                            <input type="hidden" name="rol" id="rol-input" required />
                        </div>

                    </div>
                    <!-- ACTIONS -->
                    <div class="form-actions">
                        <button type="button" class="btn btn-secondary" onclick="cancelarForm()">
                            <i class="fas fa-times"></i>
                            <span>Cancelar</span>
                        </button>
                        <button type="button" class="btn btn-primary" id="submit-btn" onclick="registrarUsuario()">
                            <i class="fas fa-check"></i>
                            <span id="submit-text">Crear usuario</span>
                        </button>

                    </div>
            </form>
        </div>
    </div>

    <!-- RIGHT: TABLE SECTION: Lado derecho en donde va ir la tabla de usuarios y en este caso pondre un DataTable -->
    <div class="right-panel">
        <div class="panel-header">
            <div class="panel-title">
                <span class="icon"><i class="fas fa-users"></i></span>
                Equipo registrado
            </div>
            <div class="panel-stats">
                <div class="stat-badge">
                    <span class="icon"><i class="fas fa-user"></i></span>
                    <span id="total-usuarios">0</span> usuarios
                </div>
                <div class="stat-badge">
                    <span class="s-emoji">✅</span>
                    <span id="usuarios-activos">0</span> activos
                </div>
            </div>
        </div>

        <!-- TABLA: Aqui es donde ira la tabla  -->
         <div class="table-container" id="table-container">
            <div id="tablaUsuariosLoad">
                <?php include '../../componentes/tablas/tablaUsuarios.php'; ?>
            </div>
         </div>
    </div>
</body>

</html>