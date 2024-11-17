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
        // Formatear la fecha y hora
        $fechaHora = date('d-m-Y H:i:s', strtotime($fila['fecha_hora'])); // Cambia el formato según tus necesidades
        $htmlMensajes .= '<p>De: ' . htmlspecialchars($fila['name']) . '<br>Contactar: ' . htmlspecialchars($fila['contacto']) . '<br>Mensaje: ' . htmlspecialchars($fila['mensaje']) . '<br>Fecha y Hora: ' . $fechaHora . '<br>-----------------------------------------------------------------------------------------------------------------------------------</p>';
    }
} else {
    $htmlMensajes = '<p>No hay mensajes.</p>';
}

// Envía los mensajes como HTML
echo $htmlMensajes;

$conexion->close();
?>

