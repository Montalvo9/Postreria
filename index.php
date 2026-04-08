<?php
// 1. La sesión SIEMPRE va en la línea 1, sin espacios antes
session_start();

require_once './librerias/libreriasGenerales.php';
include './controllers/controlllerLogin.php';
$error = false;

if (isset($_POST['ingresar'])) {
    $usuarioInput = $_POST['usuario'];
    $passwordInput = $_POST['password'];

    $controller = new Login();
    $json = $controller->obtenerUsuario();

    $usuarios = json_decode($json, true);

    if (is_array($usuarios)) {
        foreach ($usuarios as $value) {
            if ($value['usuario'] == $usuarioInput && password_verify($passwordInput, $value['password'])) {

                $_SESSION['id_usuario'] = $value['id_usuario'] ?? null;
                $_SESSION['usuario']    = $value['nombre'] ?? 'Sin Nombre';
                $_SESSION['rol']        = $value['rol'] ?? 'Sin Rol';

                if ($_SESSION['id_usuario'] !== null) {
                    session_write_close();
                    header('Location: ./vistas/dashboard.php');
                    exit;
                } else {
                    $error = true;
                    break;
                }
            }
        }
    }
    $error = true;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión - El Dulce Rincón</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./CSS/login.css">
    <!-- Asegúrate de incluir SweetAlert2 si lo usas -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="left">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
        <div class="blob blob-3"></div>
        <div class="floaters" id="floaters"></div>
        <div class="branding">
            <div class="logo-mark">🍓</div>
            <div class="brand-name">Dulce<br><em>Momento</em></div>
            <div class="brand-tagline">Tu sabor favorito</div>
        </div>
    </div>

    <div class="right">
        <div class="form-wrap">
            <div class="form-eyebrow">Bienvenida de nuevo</div>
            <div class="form-title">Accede a tu<br><em>sistema</em></div>
            <div class="form-sub">Ingresa tus credenciales</div>

            <form action="index.php" method="POST">
                <div class="field">
                    <label for="usuario">USUARIO</label>
                    <div class="input-wrap">
                        <input type="text" id="usuario" name="usuario" required>
                        <span class="input-icon">
                            <i class="fa fa-user"></i>
                        </span>
                    </div>
                    <label for="password">CONTRASEÑA</label>
                    <div class="input-wrap">
                        <input type="password" id="password" name="password" placeholder="••••••••" required>
                        <span class="input-icon">
                            <i class="fa fa-lock"></i>
                        </span>
                    </div>
                    <button type="submit" name="ingresar" class="btn-login">
                        <span class="btn-icon">
                            <i class="fa fa-birthday-cake"></i>
                        </span>
                        <span>Ingresar al sistema</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <?php if ($error): ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '¡Usuario o contraseña incorrectos!'
            });
        </script>
    <?php endif; ?>

    <!-- Ajusté la ruta de floaters para que funcione en Render -->
    <script src="./js/floaters.js"></script>
</body>

</html>