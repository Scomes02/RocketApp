<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="Proyecto nuevo.ico">
    <title>CAPIBARA STORE</title>
    <link rel="stylesheet" href="styleGeneral.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/8fa0212ec6.js" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <div class="logo">
            <img src="cover.jpg" class="imag">
        </div>
        <audio controls>
            <source src="Capibara.mp4" type="audio/mp4">
        </audio>
        <nav>
            <ul>
                <li><a href="index.php" class="btn-grow">Inicio</a></li>

                <li><a href="tienda.php" class="btn-grow">Tienda</a></li>

                <li><a href="#contact" class="btn-grow">Contacto</a></li>

                <?php
                if (isset($_SESSION['Usuario'])) {
                    // Verificar si el usuario es administrador
                    $esAdministrador = isset($_SESSION['admin']) ? $_SESSION['admin'] : false;
                    if ($esAdministrador) {
                        echo '<li><a id="btnMostrarMensajes" class="btn-grow">Mostrar Mensajes</a></li>';
                    }
                    echo '<li><a href="CerrarSesion.php" class="btn-grow">Cerrar Sesión</a></li>';
                } else {
                    echo '<li><a href="iniciocapibara.php" class="btn-grow">Iniciar Sesión</a></li>';

                    echo '<li><a href="CrearCuenta.php" class="btn-grow">Registrarse</a></li>';
                }
                ?>
            </ul>
        </nav>

    </header>

   <aside>
        <div class="contenedor1">
            <img src="fotos index/FOT1.jpg" class="fotoPrincipal">
            <img src="fotos index/FOT2.jpg" class="fotoPrincipal">
            <img src="fotos index/FOT3.jpg" class="fotoPrincipal">
            <img src="fotos index/FOT4.jpg" class="fotoPrincipal">
        </div>
    </aside> 

    <hr>

    <div id="conteCarrusel">
        <div class="tarjeta" id="tarjeta-1">
            <div class="imgCarrusel">
                <img src="fotos index/img1.jpg">
            </div>
            <div class="flechasCarrusel">
                <a href="#tarjeta-3">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <a href="#tarjeta-2">
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div> 
        </div>
        <div class="tarjeta" id="tarjeta-2">
            <div class="imgCarrusel">
                <img src="fotos index/img2.jpg">
            </div>
            <div class="flechasCarrusel">
                <a href="#tarjeta-1">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <a href="#tarjeta-3">
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>
        <div class="tarjeta" id="tarjeta-3">
            <div class="imgCarrusel">
                <img src="fotos index/img3.jpg">
            </div>
            <div class="flechasCarrusel">
                <a href="#tarjeta-2">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <a href="#tarjeta-1">
                    <i class="fa-solid fa-arrow-right"></i>
            </div>
        </div>
    </div>

    <footer>
        <div class="contenedor">
            <ul>
                <li><a href="https://www.instagram.com/capibara_store1/" target="_blank">&copy;CAPIBARA 2023</a></li>
            </ul>
            <div id="contact">
                <form action="save_message.php" method="post">
                    <label for="name">Nombre:</label>
                    <input type="text" id="name" name="name">
                    <label for="name">Contacto:</label>
                    <input type="text" id="contacto" name="contacto">
                    <label for="message">Mensaje:</label>
                    <textarea name="message" id="message" cols="30" rows="2"></textarea>
                    <input type="submit" class="enviarmensaje" value="Enviar mensaje">
                </form>
            </div>
        </div>
    </footer>
    <!-- Ventana emergente para mostrar mensajes -->
    <div id="divMensajes" class="ventana-emergente">
        <div class="contenido-ventana">
            <button id="btnCerrarVentana" class="boton-cerrar">&times;</button>
            <div id="contenidoMensajes"></div>
        </div>
    </div>
    <script src="script.js"></script>
</body>

</html>