<?php

session_start();

include_once('Conexion.php');

if (isset($_POST['Usuario']) && isset($_POST['Nombre_completo']) && isset($_POST['Clave']) && isset($_POST['RClave'])) {
    function validar($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function validarContrasena($Clave) {
        // Expresión regular para validar la contraseña
        $patron = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';

        // Comprobar si la contraseña coincide con el patrón
        if(preg_match($patron, $Clave)){
            return true;
        }else{
            return false;
        }
    }

    $Usuario = validar($_POST['Usuario']);
    $Nombre_completo = validar($_POST['Nombre_completo']);
    $Clave = validar($_POST['Clave']);
    $RClave = validar($_POST['RClave']);

    $datosUsuarios = 'Usuario=' . $Usuario . '&Nombre_completo=' . $Nombre_completo;

    if (empty($Usuario)) {
        header("Location: CrearCuenta.php?error=El usuario es requerido&$datosUsuarios");
        exit();
    } elseif (empty($Nombre_completo)) {
        header("Location: CrearCuenta.php?error=El nombre completo es requerido&$datosUsuarios");
        exit();
    } elseif (empty($Clave)) {
        header("Location: CrearCuenta.php?error=La clave es requerida&$datosUsuarios");
        exit();
    } elseif (empty($RClave)) {
        header("Location: CrearCuenta.php?error=La clave repetida es requerida&$datosUsuarios");
        exit();
    } elseif ($Clave !== $RClave) {
        header("Location: CrearCuenta.php?error=Las claves no coinciden&$datosUsuarios");
        exit();
    } elseif (!validarContrasena($Clave)) {
        header("Location: CrearCuenta.php?error=La clave debe contener al menos una letra minúscula, una letra mayúscula, un número, un símbolo y tener al menos 8 caracteres&$datosUsuarios");
        exit();
    } else {
        // Verificar si el usuario ya existe
        $sql = "SELECT * FROM usuarios WHERE nombre = ?";
        $stmt = $conexion->prepare($sql);
        if ($stmt === false) {
            die('Error en la consulta SQL: ' . $conexion->error);
        }
        $stmt->bind_param("s", $Usuario);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            header("Location: CrearCuenta.php?error=El usuario ya existe&$datosUsuarios");
            exit();
        } else {
            // Insertar el nuevo usuario en la base de datos
            $sql2 = "INSERT INTO usuarios (nombre, Nombre_completo, Clave) VALUES (?, ?, ?)";
            $stmt2 = $conexion->prepare($sql2);
            if ($stmt2 === false) {
                die('Error en la consulta SQL: ' . $conexion->error);
            }
            $hashedPassword = password_hash($Clave, PASSWORD_DEFAULT); // Hash de la clave
            $stmt2->bind_param("sss", $Usuario, $Nombre_completo, $hashedPassword);
            //alert('Usuario creado con éxito');    ESTA FRACCION VA ARRIBA DE SETIMEOUT, RETIRADA PARA NO MOSTRAR LA ALERTA
            if ($stmt2->execute()) {
                echo "<script>
                        
                        setTimeout(function() {
                            window.location.href = 'Index.php';
                        }, 1000);
                      </script>";
                exit();
            } else {
                header("Location: CrearCuenta.php?error=Ocurrió un error al crear el usuario");
                exit();
            }
        }
    }
} else {
    header("Location: CrearCuenta.php");
    exit();
}
?>