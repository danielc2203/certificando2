<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("location: login.php");
    exit;
}

// Código para generar y enviar el certificado

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Éxito</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <p>Proceso exitoso. El certificado ha sido enviado a su empresa.</p>
</body>
</html>
