<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("location: login.php");
    exit;
}

require_once 'includes/db.php';

// Código para verificar las respuestas y actualizar el estado del candidato

header("location: success.php");
?>
