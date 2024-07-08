<?php
require_once 'includes/db.php';
include 'includes/init.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Leer el cuerpo de la solicitud y decodificar JSON
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['email']) && isset($data['password']) && isset($data['userType'])) {
        $email = $data['email'];
        $password = $data['password'];
        $userType = $data['userType'];

        // Registro de los datos recibidos
        error_log("Datos recibidos: email=$email, userType=$userType");

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

            // Registro de la consulta SQL ejecutada
            error_log("Consulta SQL ejecutada: $sql");

            $stmt = $conexion->prepare($sql);
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $usuario = $result->fetch_assoc();

            if ($usuario && password_verify($password, $usuario['password'])) {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
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
        } catch (mysqli_sql_exception $e) {
            // Registro del error de la consulta
            error_log("Error en la consulta: " . $e->getMessage());
            echo json_encode(['error' => 'Error en la consulta: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['error' => 'Datos incompletos']);
    }
} else {
    echo json_encode(['error' => 'Método no permitido']);
}
?>
