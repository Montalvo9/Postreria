<!--Logica de inicio de sesión -->
<?php
session_start();
require_once './librerias/libreriasGenerales.php';
include './controllers/controlllerLogin.php';
$error = false;

if (isset($_POST['ingresar'])) {
    $usuario = $_POST['usuario']; // Lo que trae el $_POST son los name del html no los id, os id son para js y css
    $password = $_POST['password'];

    $controller = new Login();
    $json = $controller->obtenerUsuario();
    $usuarios = json_decode($json);  //transformamos con ese sitring que viene el json en un array de objetos php para poder recorrerlos

    foreach ($usuarios as $value) {
        if ($value->usuario == $usuario && password_verify($password, $value->password)) {
            // Guardamos en la sesión el nombre del usuario que viene de la BD.
            // La clave 'usuario' es solo el nombre de la variable de sesión, no el campo de la BD.
            $_SESSION['usuario'] = $value->nombre;

            // Guardamos en la sesión el rol del usuario que viene de la BD.
            // La clave 'rol' es el identificador que usamos en la sesión.
            $_SESSION['rol'] = $value->rol;

            header('Location: ./vistas/dashboard.php');
            exit;
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
<script src="./JS/floaters.js"></script>

</html>