<?php
session_start();
include_once('Conexion.php');

if (isset($_POST['Usuario']) && isset($_POST['Nueva_Clave']) && isset($_POST['RClave'])) {
    function validar($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function validarContrasena($Clave) {
        $patron = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';
        return preg_match($patron, $Clave);
    }

    $Usuario = validar($_POST['Usuario']);
    $Nueva_Clave = validar($_POST['Nueva_Clave']);
    $RClave = validar($_POST['RClave']);

    // Validaciones
    if (empty($Usuario)) {
        header("Location: CambioContra.php?error=El usuario es requerido");
        exit();
    } elseif (empty($Nueva_Clave)) {
        header("Location: CambioContra.php?error=La nueva clave es requerida");
        exit();
    } elseif (empty($RClave)) {
        header("Location: CambioContra.php?error=La clave repetida es requerida");
        exit();
    } elseif ($Nueva_Clave !== $RClave) {
        header("Location: CambioContra.php?error=Las claves no coinciden");
        exit();
    } elseif (!validarContrasena($Nueva_Clave)) {
        header("Location: CambioContra.php?error=La clave debe contener al menos una letra minúscula, una letra mayúscula, un número, un símbolo y tener al menos 8 caracteres");
        exit();
    }

    // Verificar si el usuario existe
    $sql = "SELECT * FROM usuarios WHERE nombre = ?";
    $stmt = $conexion->prepare($sql);
    if ($stmt === false) {
        die('Error en la consulta SQL: ' . $conexion->error);
    }
    $stmt->bind_param("s", $Usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        header("Location: CambioContra.php?error=El usuario no existe");
        exit();
    } else {
        // Recuperar la contraseña actual
        $row = $result->fetch_assoc();
        $currentPasswordHash = $row['Clave'];

        // Verificar si la nueva contraseña es igual a la contraseña actual
        if (password_verify($Nueva_Clave, $currentPasswordHash)) {
            header("Location: CambioContra.php?error=La nueva contraseña tiene que ser distinta");
            exit();
        }

        // Actualizar la contraseña
        $hashedPassword = password_hash($Nueva_Clave, PASSWORD_DEFAULT); // Hash de la nueva contraseña
        $sql2 = "UPDATE usuarios SET Clave = ? WHERE nombre = ?";
        $stmt2 = $conexion->prepare($sql2);
        if ($stmt2 === false) {
            die('Error en la consulta SQL: ' . $conexion->error);
        }
        $stmt2->bind_param("ss", $hashedPassword, $Usuario);
        if ($stmt2->execute()) {
            header("Location: Login.php?success=La contraseña ha sido cambiada exitosamente");
            exit();
        } else {
            header("Location: CambioContra.php?error=Ocurrió un error al cambiar la contraseña");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="fotos index/Proyecto nuevo.ico">
    <title> CAPIBARA STORE - Cambio de Contraseña</title>
    <link rel="stylesheet" href="style3.css"> <!-- Asegúrate de usar la ruta correcta -->
</head>
<body>
    <div class="container">
        <h1>Cambio de Contraseña</h1>

        <?php
        // Mostrar mensajes de error o éxito
        if (isset($_GET['error'])) {
            echo "<p class='error'>" . htmlspecialchars($_GET['error']) . "</p>";
        }
        if (isset($_GET['success'])) {
            echo "<p class='success-message'>" . htmlspecialchars($_GET['success']) . "</p>";
        }
        ?>

        <form action="CambioContra.php" method="POST" class="form-cambio-contra">
            <div class="form-group">
                <label for="Usuario">Nombre de Usuario:</label>
                <input type="text" id="Usuario" name="Usuario" required class="form-input">
            </div>

            <div class="form-group">
                <label for="Nueva_Clave">Nueva Contraseña:</label>
                <input type="password" id="Nueva_Clave" name="Nueva_Clave" required class="form-input">
            </div>

            <div class="form-group">
                <label for="RClave">Repetir Nueva Contraseña:</label>
                <input type="password" id="RClave" name="RClave" required class="form-input">
            </div>

            <button type="submit" class="btn-submit">Cambiar Contraseña</button>
            <a href="index.php" class="btn-back">Volver al Inicio</a> 
        </form>
    </div>
</body>
</html>