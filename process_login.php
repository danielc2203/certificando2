<?php
require_once 'includes/db.php';
include 'includes/init.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['userType'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $userType = $_POST['userType'];

    if (empty($email) || empty($password) || empty($userType)) {
        echo json_encode(['error' => 'Todos los campos son obligatorios']);
        exit;
    }

    $conexion = conectarBaseDatos();

    try {
        if ($userType === 'company') {
            $sql = "SELECT id, password FROM empresas WHERE email = ?";
        } elseif ($userType === 'employee') {
            $sql = "SELECT id, password FROM empleados WHERE email = ?";
        } else {
            echo json_encode(['error' => 'Tipo de usuario no válido']);
            exit;
        }

        $stmt = $conexion->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            $stmt->bind_result($id, $hashed_password);
            $stmt->fetch();

            if (password_verify($password, $hashed_password)) {
                session_start();
                $_SESSION['user_id'] = $id;
                $_SESSION['user_type'] = $userType;

                if ($userType === 'company') {
                    echo json_encode(['redirect' => 'dashboard_company.php']);
                } elseif ($userType === 'employee') {
                    echo json_encode(['redirect' => 'dashboard_employee.php']);
                }
            } else {
                echo json_encode(['error' => 'Credenciales incorrectas']);
            }
        } else {
            echo json_encode(['error' => 'Usuario no encontrado']);
        }

        $stmt->close();
    } catch (Exception $e) {
        echo json_encode(['error' => 'Error en la consulta: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Datos incompletos']);
}
?>
