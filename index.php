<?php
session_start();

// Si ya hay sesión iniciada, va directo al dashboard
if (isset($_SESSION['usuario_id'])) {
    header("Location: dashboard.php");
    exit;
}

$error      = $_GET['error'] ?? '';
$registrado = $_GET['registrado'] ?? '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <main class="card">
        <h1>Iniciar sesión</h1>

        <?php if ($error): ?>
            <p class="alerta alerta-error">Correo o contraseña incorrectos.</p>
        <?php endif; ?>
        <?php if ($registrado): ?>
            <p class="alerta alerta-ok">Cuenta creada. ¡Ya podés iniciar sesión!</p>
        <?php endif; ?>

        <form id="formLogin" action="login.php" method="POST" novalidate>
            <div class="campo">
                <input type="email" id="correo" name="correo" placeholder="Correo @gmail.com" required>
                <small class="msg-error" id="errorCorreo"></small>
            </div>

            <div class="campo">
                <input type="password" id="password" name="password" placeholder="Contraseña" minlength="8" required>
                <small class="msg-error" id="errorPassword"></small>
            </div>

            <button type="submit">Ingresar</button>
        </form>

        <div class="opciones">
            <a href="register.php">¿No tenés cuenta? Crear una</a>
            <a href="recuperar.php">¿Olvidaste la contraseña?</a>
        </div>
    </main>

    <script src="js/login.js"></script>
</body>
</html>