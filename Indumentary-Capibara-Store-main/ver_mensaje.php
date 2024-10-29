<?php
session_start();
include_once('Conexion.php');

// Verifica si el usuario es administrador
if (!isset($_SESSION['Usuario']) || $_SESSION['admin'] != true) {
    header('Location: index.php');
    exit;
}

// Consulta para obtener los mensajes
$sql = "SELECT * FROM correo";
$resultado = $conexion->query($sql);

// Prepara los mensajes para enviarlos como HTML
$htmlMensajes = '';
if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $htmlMensajes .= '<p>De: ' . htmlspecialchars($fila['name']) .'<br>contactar: ' . htmlspecialchars($fila['contacto']) . '<br>Mensaje: ' . htmlspecialchars($fila['mensaje']) . '<br>-----------------------------------------------------------------------------------------------------------------------------------'.'</p>';
    }
} else {
    $htmlMensajes = '<p>No hay mensajes.</p>';
}

// Envía los mensajes como HTML
echo $htmlMensajes;

$conexion->close();
?>

