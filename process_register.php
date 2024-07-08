<?php
// Incluir archivo de conexión a la base de datos si es necesario
require_once 'includes/db.php';

// Validar que se recibieron datos del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitizar y obtener los datos del formulario
    $companyName = filter_input(INPUT_POST, 'company_name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password']; // En un entorno de producción, considera hashear la contraseña antes de almacenarla en la base de datos

    // Insertar el nuevo usuario en la base de datos
    $sql = "INSERT INTO users (company_name, email, password) VALUES (:companyName, :email, :password)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'companyName' => $companyName,
        'email' => $email,
        'password' => $password, // En producción, deberías usar una función hash segura como password_hash()
    ]);

    // Redireccionar al login o a la página deseada después del registro exitoso
    header('Location: login.php');
    exit();
} else {
    // Si no se enviaron datos por POST, redireccionar o manejar el flujo según tu aplicación
    header('Location: index.php');
    exit();
}
?>



