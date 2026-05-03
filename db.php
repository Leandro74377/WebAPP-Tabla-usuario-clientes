<?php
$host = "localhost";
$user = "root";     // Usuario por defecto de XAMPP
$pass = "";         // Contraseña por defecto (vacía)
$db   = "sistema_db";

$conexion = mysqli_connect($host, $user, $pass, $db);

// Verificar si funciona
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>
