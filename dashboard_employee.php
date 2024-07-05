
<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
?>

<body>
    <h1>Estudiantes Formulario</h1>
    <a href="logout.php">Cerrar Sesión</a>
</body>
</html>