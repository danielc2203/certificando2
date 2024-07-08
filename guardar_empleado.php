<?php
// Incluir archivo de conexión a la base de datos y configuraciones iniciales
require_once 'includes/db.php';
include 'includes/init.php'; // Asegúrate de incluir las configuraciones de inicialización necesarias

// Verificar si la solicitud es POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Leer el cuerpo de la solicitud y decodificar JSON
    $data = json_decode(file_get_contents('php://input'), true);

    // Verificar si todos los campos necesarios están presentes
    if (isset($data['nombre']) && isset($data['correo']) && isset($data['contrasena'])) {
        $nombre = $data['nombre'];
        $correo = $data['correo'];
        $contrasena = $data['contrasena'];
        $empresa_id = $_SESSION['user_id']; // Obtener el ID de la empresa desde la sesión

        // Conectar a la base de datos
        $conexion = conectarBaseDatos();

        try {
            // Consulta SQL para insertar en la tabla empleados
            $sql = "INSERT INTO empleados (nombre, email, password, empresa_id) VALUES (?, ?, ?, ?)";

            // Preparar la consulta SQL
            $stmt = $conexion->prepare($sql);

            // Hash de la contraseña antes de guardarla en la base de datos
            $hashed_password = password_hash($contrasena, PASSWORD_DEFAULT);

            // Enlazar parámetros y ejecutar la consulta
            $stmt->bind_param('sssi', $nombre, $correo, $hashed_password, $empresa_id);
            $stmt->execute();

            // Verificar si se insertó correctamente
            if ($stmt->affected_rows > 0) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['error' => 'No se pudo registrar al usuario']);
            }
        } catch (mysqli_sql_exception $e) {
            // Manejar cualquier error de la base de datos
            echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
        } finally {
            // Cerrar la conexión a la base de datos
            $conexion->close();
        }
    } else {
        echo json_encode(['error' => 'Datos incompletos']);
    }
} else {
    echo json_encode(['error' => 'Método no permitido']);
}
?>
