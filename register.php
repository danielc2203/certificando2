<?php
require_once 'includes/db.php';
include 'includes/init.php';
include 'templates/header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $role = 'company';

    if (registerUser($username, $password, $email, $role)) {
        echo "Registro exitoso.";
    } else {
        echo "Error en el registro.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Empresa</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <form method="post" action="register.php">
        <label for="username">Usuario:</label>
        <input type="text" name="username" required>
        <label for="password">Contraseña:</label>
        <input type="password" name="password" required>
        <label for="email">Correo:</label>
        <input type="email" name="email" required>
        <button type="submit">Registrar Empresa</button>
    </form>
</body>
</html>
