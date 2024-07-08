<?php
require_once 'includes/db.php';

$conexion = conectarBaseDatos();

try {
    $sql = "SELECT id, password FROM empresas";
    $stmt = $conexion->prepare($sql);
    $stmt->execute();
    $stmt->bind_result($id, $password);

    while ($stmt->fetch()) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $update_sql = "UPDATE empresas SET password = ? WHERE id = ?";
        $update_stmt = $conexion->prepare($update_sql);
        $update_stmt->bind_param('si', $hashed_password, $id);
        $update_stmt->execute();
    }
    echo "Contraseñas actualizadas exitosamente";
} catch (mysqli_sql_exception $e) {
    echo "Error al actualizar contraseñas: " . $e->getMessage();
}
?>
