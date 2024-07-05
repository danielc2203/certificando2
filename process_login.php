<?php
// process_login.php

require_once 'includes/bd.php'; // Asegúrate de ajustar la ruta según tu estructura de archivos
require_once 'includes/config.php'; // Ajusta la ruta según tu estructura de archivos

session_start();

// Verificar que se enviaron los datos esperados
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['userType'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $userType = $_POST['userType'];

    // Conectar a la base de datos (usando la función conectarBaseDatos() de bd.php)
    $conexion = conectarBaseDatos();

    try {
        // Preparar consulta SQL según el tipo de usuario
        if ($userType === 'company') {
            $sql = "SELECT id, password FROM empresas WHERE email = :email LIMIT 1";
        } elseif ($userType === 'employee') {
            $sql = "SELECT id, password FROM empleados WHERE email = :email LIMIT 1";
        }

        // Preparar la declaración SQL
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        // Obtener el resultado de la consulta
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar si se encontró el usuario
        if ($resultado) {
            // Verificar la contraseña con password_verify()
            $hash = $resultado['password'];
            if (password_verify($password, $hash)) {
                // Iniciar sesión y establecer variables de sesión
                $_SESSION['id'] = $resultado['id'];
                $_SESSION['userType'] = $userType;
                $_SESSION['email'] = $email;

                // Redirigir según el tipo de usuario
                if ($userType === 'company') {
                    echo json_encode(['success' => true, 'redirect' => 'dashboard_company.php']);
                } elseif ($userType === 'employee') {
                    echo json_encode(['success' => true, 'redirect' => 'dashboard_employee.php']);
                }
                exit;
            } else {
                // Contraseña incorrecta
                echo json_encode(['error' => 'Contraseña incorrecta']);
            }
        } else {
            // Usuario no encontrado
            echo json_encode(['error' => 'Usuario no encontrado']);
        }

    } catch(PDOException $e) {
        // Manejo de errores de consulta SQL
        echo json_encode(['error' => 'Error en la consulta SQL: ' . $e->getMessage()]);
    }

} else {
    // Datos no enviados correctamente
    echo json_encode(['error' => 'Datos de inicio de sesión no proporcionados correctamente']);
}
?>
