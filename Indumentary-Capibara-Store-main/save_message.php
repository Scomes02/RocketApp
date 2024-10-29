<?php
include 'Conexion.php'; // Incluir el archivo de conexión

// Procesar formulario si se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $message = $_POST['message'];
    $contacto = $_POST['contacto'];

    if ($conexion) { // Verificar que la conexión está definida
        echo "Conexión exitosa."; // Mensaje de depuración
        $sql = "INSERT INTO correo (name, mensaje, contacto) VALUES (?, ?, ?)";
        $stmt = $conexion->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("sss", $name, $message, $contacto);

            if ($stmt->execute()) {
                header("Location: tienda.php");
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
