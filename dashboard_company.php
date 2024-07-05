<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
?>

<body>
    <h1>Formulario de Empresa</h1>
    <a href="logout.php">Cerrar Sesión</a>
</body>
</html>