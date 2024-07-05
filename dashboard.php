<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['role'] != 'company') {
    header("location: login.php");
    exit;
}

require_once 'includes/db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $company_id = $_SESSION['id'];

    if (registerCandidate($company_id, $name, $email, $username, $password)) {
        $to = $email;
        $subject = "Curso de Alimentos - Acceso";
        $message = "Su usuario: $username\nSu contraseña: $password\nURL: http://localhost/course.php";
        mail($to, $subject, $message);
        echo "Candidato registrado y correo enviado.";
    } else {
        echo "Error en el registro del candidato.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h1>Bienvenido, <?php echo $_SESSION['username']; ?></h1>
    <form method="post" action="dashboard.php">
        <label for="name">Nombre del Candidato:</label>
        <input type="text" name="name" required>
        <label for="email">Correo del Candidato:</label>
        <input type="email" name="email" required>
        <label for="username">Usuario del Candidato:</label>
        <input type="text" name="username" required>
        <label for="password">Contraseña del Candidato:</label>
        <input type="password" name="password" required>
        <button type="submit">Registrar Candidato</button>
    </form>
</body>
</html>
