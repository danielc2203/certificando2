
<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
include 'templates/header.php';
?>

<body>
    <h1>Formulario para nuevos estudiantes</h1>
    <!-- dashboard_company.php -->

<button type="button" class="btn btn-outline-primary" id="btnRegistrarUsuario">Registrar Nuevo Usuario</button>

</br>

 <button type="button" class="btn btn-danger" href="logout.php">Cerrar Sesión</button>
</body>
</html>

<?php
include 'templates/footer.php';
?>