<?php
session_start();
$enviado = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = trim($_POST['correo'] ?? '');
    if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        // Simulación: en un sistema real acá se enviaría un mail con un enlace de recuperación.
        $enviado = true;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar contraseña</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <main class="card">
        <h1>Recuperar contraseña</h1>

        <?php if ($enviado): ?>
            <p class="alerta alerta-ok">Si el correo está registrado, te enviaremos las instrucciones para recuperar tu contraseña.</p>
        <?php else: ?>
            <form action="recuperar.php" method="POST">
                <div class="campo">
                    <input type="email" name="correo" placeholder="Correo @gmail.com" required>
                </div>
                <button type="submit">Enviar instrucciones</button>
            </form>
        <?php endif; ?>

        <div class="opciones">
            <a href="index.php">Volver a iniciar sesión</a>
        </div>
    </main>
</body>
</html>