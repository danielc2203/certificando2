<?php
session_start();
require_once 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'No ha iniciado sesión']);
    exit;
}

$empresa_id = $_SESSION['user_id'];

try {
    $conexion = conectarBaseDatos();
    $sql = "SELECT id, nombre, email, created_at FROM empleados WHERE empresa_id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param('i', $empresa_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $empleados = [];
    while ($row = $result->fetch_assoc()) {
        $empleados[] = $row;
    }

    echo json_encode($empleados);
} catch (mysqli_sql_exception $e) {
    echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
} finally {
    $conexion->close();
}
?>
