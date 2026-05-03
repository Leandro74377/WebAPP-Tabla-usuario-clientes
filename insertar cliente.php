<?php
include 'db.php';

$nombre = $_POST['txt_cliente'];
$email  = $_POST['txt_email'];

$query = "INSERT INTO clientes (nombre, email) VALUES ('$nombre', '$email')";

if(mysqli_query($conexion, $query)){
    header("Location: index.php?status=success");
} else {
    echo "Error: " . mysqli_error($conexion);
}
?>
