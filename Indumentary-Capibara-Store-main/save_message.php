<?php
include 'Conexion.php'; // Incluir el archivo de conexión

// Procesar formulario si se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $message = $_POST['message'];
    $contacto = $_POST['contacto'];
    $page = $_POST['page']; // Obtener la página de origen

    if ($conexion) { // Verificar que la conexión está definida
        echo "Conexión exitosa."; // Mensaje de depuración

        // Modificar la consulta SQL para incluir la fecha y hora
        $sql = "INSERT INTO correo (name, mensaje, contacto, fecha_hora) VALUES (?, ?, ?, NOW())";
        $stmt = $conexion->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("sss", $name, $message, $contacto);
            if ($stmt->execute()) {
                // Redirigir según la página de origen
                if ($page == 'index') {
                    header("Location: index.php");
                } else {
                    header("Location: tienda.php");
                }
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error en la preparación de la consulta: " . $conexion->error;
        }
    } else {
        echo "Error en la conexión a la base de datos.";
    }
    $conexion->close();
} else {
    echo "Solicitud inválida.";
}
?>