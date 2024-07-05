<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'certificando2');
define('DB_PASSWORD', 'certificando2');
define('DB_NAME', 'course_db');

$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}
?>
