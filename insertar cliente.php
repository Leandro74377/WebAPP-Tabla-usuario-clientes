<?php
include 'db.php';

// Sanitizar y validar inputs
$nombre = trim($_POST['txt_cliente']);
$email  = trim($_POST['txt_email']);

// Validaciones básicas
if (empty($nombre) || empty($email)) {
    die("El nombre y email son requeridos.");
}

// Usar prepared statements para seguridad
$stmt = mysqli_prepare($conexion, "INSERT INTO clientes (nombre, email) VALUES (?, ?)");
mysqli_stmt_bind_param($stmt, "ss", $nombre, $email);

if (mysqli_stmt_execute($stmt)) {
    header("Location: index.php?status=success");
} else {
    echo "Error al guardar: " . mysqli_error($conexion);
}

mysqli_stmt_close($stmt);
?>
