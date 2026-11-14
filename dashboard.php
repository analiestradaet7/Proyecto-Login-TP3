<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit;
}

$nombre = $_SESSION['usuario_nombre'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <main class="card">
        <h1>Bienvenido <?= htmlspecialchars($nombre) ?> a tu dashboard</h1>
        <p class="texto-dashboard">Esta es una vista protegida. Aquí podés agregar contenido del sistema.</p>
        <a class="boton-link" href="logout.php">Cerrar sesión</a>
    </main>
</body>
</html>