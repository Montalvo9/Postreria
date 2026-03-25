<!--Logica de inicio de sesión -->
<?php
session_start();
require_once './librerias/libreriasGenerales.php';
include './controllers/controlllerLogin.php';
$error = false;

if (isset($_POST['ingresar'])) {
    $usuarioInput = $_POST['usuario']; 
    $passwordInput = $_POST['password'];

    $controller = new Login();
    $json = $controller->obtenerUsuario();
    
    // El segundo parámetro 'true' convierte el JSON en un Arreglo Asociativo
    $usuarios = json_decode($json, true); 

    if (is_array($usuarios)) {
        foreach ($usuarios as $value) {
            // Comparamos usando la sintaxis de arreglo ['']
            if ($value['usuario'] == $usuarioInput && password_verify($passwordInput, $value['password'])) {
                
                // Guardamos los datos asegurándonos de que existan
                $_SESSION['id_usuario'] = $value['id_usuario'] ?? null;
                $_SESSION['usuario']    = $value['nombre'] ?? 'Sin Nombre';
                $_SESSION['rol']        = $value['rol'] ?? 'Sin Rol';

                // Verificación de seguridad antes de redireccionar
                if ($_SESSION['id_usuario'] !== null) {
                    session_write_close(); // Fuerza el guardado de la sesión
                    header('Location: ./vistas/dashboard.php');
                    exit;
                } else {
                    // Si llegamos aquí, el usuario existe pero el ID no vino en el SELECT *
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
    <title>Inicio de sesión</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./CSS/login.css">
</head>

<body>
    <!-- Panel izquierdo -->
    <div class="left">
        <!-- blobs -->
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
        <div class="blob blob-3"></div>

        <!-- floating emojis -->
        <div class="floaters" id="floaters"></div>

        <!-- branding -->
        <div class="branding">
            <div class="logo-mark">🍓</div>
            <div class="brand-name">El Dulce<br><em>Rincón</em></div>
            <div class="brand-tagline">Tu sabor favorito</div>
        </div>
    </div>

    <!-- Panel derecho -->
    <div class="right">
        <div class="form-wrap">
            <div class="form-eyebrow">Bienvenida de nuevo</div>
            <div class="form-title">Accede a tu<br><em>sistema</em></div>
            <div class="form-sub">Ingresa tus credenciales</div>
            <!-- Aquí iría tu formulario -->
            <form action="index.php" method="POST">
                <div class="field">
                    <label for="usuario">USUARIO</label>
                    <div class="input-wrap">
                        <input type="text" id="usuario" name="usuario">
                        <span class="input-icon"><i class="fas fa-user"></i></span>
                    </div>
                    <label for="password">CONTRASEÑA</label>
                    <div class="input-wrap">
                        <input type="password" id="password" name="password" placeholder="••••••••">
                        <span class="input-icon">🔒</span>
                    </div>
                    <button type="submit" name="ingresar" value="" class="btn-login">
                        <span class="btn-icon">🍰</span>
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
</body>

</html>

</body>
<script src="./js/floaters.js"></script>

</html>