<?php
session_start();

include_once('Conexion.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    function validar($data) {
        return htmlspecialchars(trim($data));
    }

    function validarContrasena($Clave) {
        return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $Clave);
    }

    function validarCorreo($correo) {
        return filter_var($correo, FILTER_VALIDATE_EMAIL);
    }

    $Usuario = validar($_POST['Usuario'] ?? '');
    $mail = validar($_POST['mail'] ?? '');
    $Clave = validar($_POST['Clave'] ?? '');
    $RClave = validar($_POST['RClave'] ?? '');

    $datosUsuarios = "Usuario=" . urlencode($Usuario) . "&mail=" . urlencode($mail);

    // Validaciones
    if (!$Usuario || !$mail || !$Clave || !$RClave || $Clave !== $RClave || !validarContrasena($Clave) || !validarCorreo($mail)) {
        $error = "Error en los datos proporcionados.";
        header("Location: CrearCuenta.php?error=$error&$datosUsuarios");
        exit();
    }

    // Comprobar usuario existente
    $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE nombre = ?");
    $stmt->bind_param("s", $Usuario);
    $stmt->execute();

    if ($stmt->get_result()->num_rows > 0) {
        header("Location: CrearCuenta.php?error=El usuario ya existe&$datosUsuarios");
        exit();
    }

    // Insertar nuevo usuario
    $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, mail, Clave) VALUES (?, ?, ?)");
    $hashedPassword = password_hash($Clave, PASSWORD_DEFAULT);
    $stmt->bind_param("sss", $Usuario, $mail, $hashedPassword);

    if ($stmt->execute()) {
        try {
            $mailer = new PHPMailer(true);
            $mailer->isSMTP();
            $mailer->Host = 'smtp.gmail.com';
            $mailer->SMTPAuth = true;
            $mailer->Username = 'copiawsp02@gmail.com';
            $mailer->Password = 'rwqp bbhi yjvl jkhq';
            $mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mailer->Port = 587;

            $mailer->setFrom('copiawsp02@gmail.com', 'Capibara Store');
            $mailer->addAddress($mail, $Usuario);

            $mailer->isHTML(true);
            $mailer->Subject = 'Registro en Capibara Store';
            $mailer->Body = "Hola $Usuario,<br><br>Has sido registrado en Capibara Store.<br><br>Saludos,<br>El equipo de Capibara Store";

            $mailer->send();
            header("Location: iniciocapibara.php?success=Registro exitoso");
        } catch (Exception $e) {
            echo "Error al enviar el correo: {$mailer->ErrorInfo}";
        }
    } else {
        echo "Error en la inserción de datos.";
    }
} else {
    header("Location: CrearCuenta.php");
}
?>
