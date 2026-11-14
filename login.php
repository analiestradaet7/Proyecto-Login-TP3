<?php
session_start();
require "conexion.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit;
}

$correo   = trim($_POST['correo'] ?? '');
$password = $_POST['password'] ?? '';

if ($correo === '' || $password === '') {
    header("Location: index.php?error=1");
    exit;
}

$stmt = $pdo->prepare("SELECT id, nombre, password FROM usuarios WHERE correo = ?");
$stmt->execute([$correo]);
$usuario = $stmt->fetch();

if ($usuario && password_verify($password, $usuario['password'])) {
    session_regenerate_id(true);
    $_SESSION['usuario_id']     = $usuario['id'];
    $_SESSION['usuario_nombre'] = $usuario['nombre'];
    header("Location: dashboard.php");
    exit;
}

header("Location: index.php?error=1");
exit;