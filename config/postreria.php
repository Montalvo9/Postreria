

<?php
// Revisamos si existe la variable de entorno en Render, si no, es que estamos en Local
$is_render = getenv('gateway01.us-west-2.prod.aws.tidbcloud.com
') !== false;

if ($is_render) {
    // --- CONFIGURACIÓN PARA RENDER (TiDB Cloud) ---
    define('SERVER247', getenv('gateway01.us-west-2.prod.aws.tidbcloud.com
'));
    define('DATABASE247', getenv('test'));
    define('USERPOSTRERIA', getenv('3bHwH3NjGLXmRxd.root'));
    define('PASSWORD', getenv('vxkENcKTpYSb3ggg
'));
    $port = getenv('DB_PORT') ?: '4000';

    // TiDB REQUIERE SSL. Esta configuración es para PDO:
    $options = [
        PDO::MYSQL_ATTR_SSL_CA => true, // Esto activa el SSL obligatorio de TiDB
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];

    define('DSN', 'mysql:host=' . SERVER247 . ';port=' . $port . ';dbname=' . DATABASE247 . ';charset=utf8mb4');
} else {
    // --- CONFIGURACIÓN PARA TU PC (XAMPP / Localhost) ---
    define('SERVER247', 'localhost');
    define('DATABASE247', 'postreria');
    define('USERPOSTRERIA', 'root');
    define('PASSWORD', '');

    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];

    define('DSN', 'mysql:host=' . SERVER247 . ';dbname=' . DATABASE247 . ';charset=utf8mb4');
}

// Así es como debes conectar después de las definiciones:
// $pdo = new PDO(DSN, USERPOSTRERIA, PASSWORD, $options);
?>

