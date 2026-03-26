<?php
// Revisamos si existe la variable de entorno DB_HOST en Render
$is_render = getenv('DB_HOST') !== false;

if ($is_render) {
    // --- CONFIGURACIÓN PARA RENDER (Usa las etiquetas, no los datos reales aquí) ---
    define('SERVER247', getenv('DB_HOST'));
    define('DATABASE247', getenv('DB_NAME')); 
    define('USERPOSTRERIA', getenv('DB_USER')); 
    define('PASSWORD', getenv('DB_PASSWORD'));
    $port = getenv('DB_PORT') ?: '4000';

    // TiDB REQUIERE SSL.
    $options = [
        PDO::MYSQL_ATTR_SSL_CA => true, 
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];

    define('DSN', 'mysql:host=' . SERVER247 . ';port=' . $port . ';dbname=' . DATABASE247 . ';charset=utf8mb4');
} else {
    // --- CONFIGURACIÓN PARA TU PC (Localhost) ---
    define('SERVER247', 'localhost');
    define('DATABASE247', 'postreria');
    define('USERPOSTRERIA', 'root');
    define('PASSWORD', '');

  $options = [
    PDO::MYSQL_ATTR_SSL_CA => __DIR__ . '/../certs/isrgrootx1.pem',
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];

    define('DSN', 'mysql:host=' . SERVER247 . ';dbname=' . DATABASE247 . ';charset=utf8mb4');
}
?>