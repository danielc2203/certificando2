<?php
require_once 'includes/db.php';
include 'includes/init.php';
include 'templates/header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id, username, password, role FROM users WHERE username = ?";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("s", $username);
        if ($stmt->execute()) {
            $stmt->store_result();
            if ($stmt->num_rows == 1) {
                $stmt->bind_result($id, $username, $hashed_password, $role);
                if ($stmt->fetch()) {
                    if (password_verify($password, $hashed_password)) {
                        session_start();
                        $_SESSION['id'] = $id;
                        $_SESSION['username'] = $username;
                        $_SESSION['role'] = $role;
                        header("location: dashboard.php");
                    } else {
                        echo "Contraseña incorrecta.";
                    }
                }
            } else {
                echo "No se encontró una cuenta con ese usuario.";
            }
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <form method="post" action="login.php">
        <label for="username">Usuario:</label>
        <input type="text" name="username" required>
        <label for="password">Contraseña:</label>
        <input type="password" name="password" required>
        <button type="submit">Iniciar Sesión</button>
    </form>
</body>
</html>


<script>
    // Ejemplo de SweetAlert2 para mostrar un mensaje de éxito después del inicio de sesión
    <?php if (isset($_SESSION['login_success'])): ?>
        Swal.fire({
            icon: 'success',
            title: '¡Inicio de sesión exitoso!',
            text: '<?php echo $_SESSION['login_success']; ?>',
            showConfirmButton: false,
            timer: 3000 // Cierra automáticamente después de 3 segundos
        });
        <?php unset($_SESSION['login_success']); // Limpiar la variable de sesión después de mostrar el mensaje ?>
    <?php endif; ?>
</script>