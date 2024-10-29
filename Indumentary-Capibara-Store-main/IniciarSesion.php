<?php
// Inicia la sesión para acceder y modificar variables de sesión
session_start();

// Incluye el archivo de conexión a la base de datos
include('Conexion.php');

// Verifica si el método de solicitud es POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los valores de usuario y clave del formulario POST
    $Usuario = $_POST['Usuario'];
    $Clave = $_POST['Clave'];

    // Verifica si el campo de usuario está vacío
    if (empty($Usuario)) {
        // Redirige con un mensaje de error si el usuario es requerido
        header("Location: iniciocapibara.php?error=El Usuario Es Requerido");
        exit();
    } elseif (empty($Clave)) {
        // Redirige con un mensaje de error si la clave es requerida
        header("Location: iniciocapibara.php?error=La Clave Es Requerida");
        exit();
    } else {
        // Prevenir inyección SQL escapando los caracteres especiales en la entrada del usuario
        $Usuario = mysqli_real_escape_string($conexion, $Usuario);

        // Consulta para verificar si el usuario existe en la base de datos
        $Sql = "SELECT * FROM usuarios WHERE nombre = '$Usuario'";
        $result = mysqli_query($conexion, $Sql);

        // Verifica si ocurrió un error en la consulta
        if ($result === false) {
            echo "Error en la consulta: " . mysqli_error($conexion);
        } elseif (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);

            // Verificar la contraseña utilizando password_verify()
            if (password_verify($Clave, $row['Clave'])) {
                // Verificar si el usuario es administrador
                // Asegúrate de que el nombre de la columna sea el correcto en tu base de datos
                if ($row['admin'] == 1) {
                    $_SESSION['admin'] = true;
                } else {
                    $_SESSION['admin'] = false;
                }

                // Almacenar el nombre de usuario en la sesión
                $_SESSION['Usuario'] = $Usuario;

                // Redirigir al usuario a la página principal después de iniciar sesión
                header("Location: index.php");
                exit();
            } else {
                // Redirige con un mensaje de error si la contraseña es incorrecta
                header("Location: iniciocapibara.php?error=Contraseña incorrecta");
                exit();
            }
        } else {
            // Redirige con un mensaje de error si el usuario no es encontrado
            header("Location: iniciocapibara.php?error=Usuario no encontrado");
            exit();
        }
    }
}
?>
