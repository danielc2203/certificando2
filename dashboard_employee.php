
<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

include 'templates/header.php';
?>



<body>
    <h1>Estudiantes Formulario</h1>
    <!-- dashboard_company.php -->
<button id="btnRegistrarUsuario" class="btn btn-primary">Registrar Nuevo Usuario</button>

    <a href="logout.php">Cerrar Sesión</a>
</body>
</html>

<?php
include 'templates/footer.php';
?>