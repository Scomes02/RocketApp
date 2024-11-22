<?php
session_start();
header('Content-Type: application/json');

// Obtén la información del carrito enviada
$input = file_get_contents('php://input');
$productos = json_decode($input, true);

// Almacena los productos en la sesión
$_SESSION['productos'] = $productos;

// Devuelve una respuesta exitosa
echo json_encode(['status' => 'success']);
?>