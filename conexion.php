<?php
$host    = "127.0.0.1";
$puerto  = 3306;
$bd      = "proyecto_login";
$usuario = "root";
$clave   = "";

try {
    $pdo = new PDO(
        "mysql:host=$host;port=$puerto;dbname=$bd;charset=utf8mb4",
        $usuario,
        $clave,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
} catch (PDOException $e) {
    die("Error de conexión a la base de datos.");
}