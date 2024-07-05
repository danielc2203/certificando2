<?php
require_once 'config.php';

function conectarBaseDatos() {
    global $mysqli;
    return $mysqli;
}

// Funciones de registro (puedes mantenerlas aquí si las necesitas)
function registerUser($username, $password, $email, $role) {
    global $mysqli;
    $sql = "INSERT INTO users (username, password, email, role) VALUES (?, ?, ?, ?)";
    if($stmt = $mysqli->prepare($sql)){
        $stmt->bind_param("ssss", $username, password_hash($password, PASSWORD_DEFAULT), $email, $role);
        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
        $stmt->close();
    }
}

function registerCandidate($company_id, $name, $email, $username, $password) {
    global $mysqli;
    $sql = "INSERT INTO candidates (company_id, name, email, username, password) VALUES (?, ?, ?, ?, ?)";
    if($stmt = $mysqli->prepare($sql)){
        $stmt->bind_param("issss", $company_id, $name, $email, $username, password_hash($password, PASSWORD_DEFAULT));
        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
        $stmt->close();
    }
}
?>
