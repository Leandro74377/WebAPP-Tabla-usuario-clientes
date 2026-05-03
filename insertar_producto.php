<?php
include 'db.php';

// Sanitizar y validar inputs
$nombre = trim($_POST['txt_nombre']);
$precio = floatval($_POST['txt_precio']);
$stock = intval($_POST['txt_stock']);

// Validaciones básicas
if (empty($nombre) || $precio <= 0 || $stock < 0) {
    die("Datos inválidos. Verifica el nombre, precio (>0) y stock (>=0).");
}

// Usar prepared statements para seguridad
$stmt = mysqli_prepare($conexion, "INSERT INTO productos (nombre, precio, stock) VALUES (?, ?, ?)");
mysqli_stmt_bind_param($stmt, "sdi", $nombre, $precio, $stock);

if (mysqli_stmt_execute($stmt)) {
    header("Location: index.php?status=success");
} else {
    echo "Error al guardar: " . mysqli_error($conexion);
}

mysqli_stmt_close($stmt);
?>
