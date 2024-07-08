<?php
require_once 'includes/db.php';
include 'includes/init.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['userType'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $userType = $_POST['userType'];

    // Registro de los datos recibidos
    log_message("Datos recibidos: email=$email, userType=$userType");

    $conexion = conectarBaseDatos();

    try {
        if ($userType === 'company') {
            $sql = "SELECT id, password FROM empresas WHERE email = :email LIMIT 1";
        } elseif ($userType === 'employee') {
            $sql = "SELECT id, password FROM empleados WHERE email = :email LIMIT 1";
        } else {
            echo json_encode(['error' => 'Tipo de usuario no válido']);
            exit;
        }

        // Registro de la consulta SQL ejecutada
        log_message("Consulta SQL ejecutada: $sql");

        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($password, $usuario['password'])) {
            session_start();
            $_SESSION['user_id'] = $usuario['id'];
            $_SESSION['user_type'] = $userType;

            if ($userType === 'company') {
                echo json_encode(['redirect' => 'dashboard_company.php']);
            } elseif ($userType === 'employee') {
                echo json_encode(['redirect' => 'dashboard_employee.php']);
            }
        } else {
            echo json_encode(['error' => 'Usuario o contraseña incorrectos']);
        }
    } catch (PDOException $e) {
        // Registro del error de la consulta
        log_message("Error en la consulta: " . $e->getMessage());
        echo json_encode(['error' => 'Error en la consulta: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Datos incompletos']);
}
?>