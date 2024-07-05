<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curso de Alimentos</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h1>Curso de Alimentos</h1>
    <video controls>
        <source src="path_to_video.mp4" type="video/mp4">
        Tu navegador no soporta el elemento de video.
    </video>
    <form method="post" action="questionnaire.php">
        <!-- Aquí van las preguntas del cuestionario -->
        <button type="submit">Enviar Cuestionario</button>
    </form>
</body>
</html>
