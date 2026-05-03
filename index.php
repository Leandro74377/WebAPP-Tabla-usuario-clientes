<?php 
include 'db.php'; 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Inventario - phpMyAdmin</title>
    <style>
        :root { --primary: #2c3e50; --secondary: #27ae60; --bg: #f4f7f6; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: var(--bg); margin: 0; padding: 20px; }
        .container { max-width: 1000px; margin: auto; display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .card { background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        h2 { color: var(--primary); border-bottom: 2px solid var(--secondary); padding-bottom: 10px; }
        
        form { display: flex; flex-direction: column; gap: 15px; }
        label { font-weight: bold; margin-bottom: -10px; color: #555; }
        input { padding: 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 16px; }
        
        button { padding: 12px; background-color: var(--secondary); color: white; border: none; border-radius: 6px; cursor: pointer; font-size: 16px; font-weight: bold; transition: 0.3s; }
        button:hover { background-color: #219150; transform: translateY(-2px); }

        table { width: 100%; border-collapse: collapse; margin-top: 20px; background: white; font-size: 14px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #eee; }
        th { background-color: var(--primary); color: white; }
        tr:hover { background-color: #f9f9f9; }
        
        .full-width { grid-column: 1 / -1; }
        .status-msg { padding: 10px; border-radius: 5px; margin-bottom: 20px; text-align: center; background: #d4edda; color: #155724; display: <?php echo isset($_GET['status']) ? 'block' : 'none'; ?>; }
    </style>
</head>
<body>

<h1 style="text-align: center; color: var(--primary);">Gestión de Productos y Clientes</h1>

<div class="container">
    
    <?php if(isset($_GET['status'])): ?>
        <div class="full-width status-msg">¡Registro guardado correctamente en phpMyAdmin!</div>
    <?php endif; ?>

    <!-- SECCIÓN PRODUCTOS -->
    <div class="card">
        <h2>Registrar Producto</h2>
        <form action="insertar_producto.php" method="POST">
            <label>Nombre del Producto</label>
            <input type="text" name="txt_nombre" placeholder="Ej. Laptop Dell" required>
            
            <label>Precio ($)</label>
            <input type="number" step="0.01" name="txt_precio" placeholder="0.00" required>
            
            <label>Stock Inicial</label>
            <input type="number" name="txt_stock" placeholder="Cantidad" required>
            
            <button type="submit">Guardar en Base de Datos</button>
        </form>

        <h3>Lista de Productos</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Stock</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $res = mysqli_query($conexion, "SELECT * FROM productos ORDER BY id DESC");
                while($fila = mysqli_fetch_assoc($res)){
                    echo "<tr>
                            <td>{$fila['id']}</td>
                            <td>{$fila['nombre']}</td>
                            <td>\${$fila['precio']}</td>
                            <td>{$fila['stock']}</td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- SECCIÓN CLIENTES -->
    <div class="card">
        <h2>Registrar Cliente</h2>
        <form action="insertar_cliente.php" method="POST">
            <label>Nombre Completo</label>
            <input type="text" name="txt_cliente" placeholder="Ej. Juan Pérez" required>
            
            <label>Correo Electrónico</label>
            <input type="email" name="txt_email" placeholder="correo@ejemplo.com" required>
            
            <button type="submit" style="background-color: #3498db;">Registrar Cliente</button>
        </form>

        <h3>Lista de Clientes</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $resC = mysqli_query($conexion, "SELECT * FROM clientes ORDER BY id DESC");
                while($filaC = mysqli_fetch_assoc($resC)){
                    echo "<tr>
                            <td>{$filaC['id']}</td>
                            <td>{$filaC['nombre']}</td>
                            <td>{$filaC['email']}</td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</div>

</body>
</html>
