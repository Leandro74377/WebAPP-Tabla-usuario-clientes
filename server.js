const express = require('express');
const mysql = require('mysql2');
const bodyParser = require('body-parser');
const cors = require('cors');

const app = express();
app.use(cors());
app.use(bodyParser.json());

// Conexión a la DB
const db = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: 'tu_password',
    database: 'inventario_db'
});

// Rutas para Clientes
app.post('/clientes', (req, res) => {
    const { nombre, email, telefono } = req.body;
    const query = 'INSERT INTO clientes (nombre, email, telefono) VALUES (?, ?, ?)';
    db.query(query, [nombre, email, telefono], (err, result) => {
        if (err) return res.status(500).send(err);
        res.send('Cliente guardado con éxito');
    });
});

// Rutas para Productos
app.post('/productos', (req, res) => {
    const { nombre_producto, precio, stock } = req.body;
    const query = 'INSERT INTO productos (nombre_producto, precio, stock) VALUES (?, ?, ?)';
    db.query(query, [nombre_producto, precio, stock], (err, result) => {
        if (err) return res.status(500).send(err);
        res.send('Producto guardado con éxito');
    });
});

app.listen(3000, () => console.log('Servidor corriendo en puerto 3000'));
