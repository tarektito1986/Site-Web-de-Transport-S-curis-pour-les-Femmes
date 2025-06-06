<?php
//conexion a la base de donnee
    define('DB_HOST', 'localhost:3307');
    define('DB_NAME', 'site_web_mchina');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];
    try {
        $db = new PDO($dsn, DB_USER, DB_PASS, $options);
    } catch (PDOException $e) {
        die("Échec de la connexion : " . $e->getMessage());
    }
?>
