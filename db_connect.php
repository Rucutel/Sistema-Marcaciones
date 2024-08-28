<?php
$servername = "localhost";
$username = "root"; // Por defecto en XAMPP
$password = ""; // Deja esto vacío si no configuraste contraseña para root
$dbname = "marcaciones_db";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>