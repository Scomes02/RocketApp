<!DOCTYPE html>
<html laang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap-grid.min.css" 
    integrity="sha512-q0LpKnEKG/pAf1qi1SAyX0lCNnrlJDjAvsyaygu07x8OF4CEOpQhBnYiFW6YDUnOOcyAEiEYlV4S9vEc6akTEw==" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="Proyecto nuevo.ico">
    <title> CAPIBARA STORE - Inicio de Sesion</title>
    <link rel="stylesheet" href="styleGeneral.css">
    <link rel="stylesheet" href="style3.css">
</head>

<body>
    <form action="IniciarSesion.php" method="post">

        <h1>INICIAR SESION</h1>
        <hr>

        <?php
        if(isset($_GET['error'])){
            ?>
            <p class="error">
                <?php
                    echo $_GET['error']
                ?>

            </p>
        <?php
        }
        ?>
        <hr>
        <i class="fa-solid fa-user"></i>
        <label>Usuario</label>
        <input type="text" name="Usuario" placeholder="Nombre de usuario">
        <hr>
        <i class="fa-solid fa-unlock"></i>
        <label>Clave</label>
        <input type="password" name="Clave" placeholder="Clave">
        <hr>
        <button type="submit">Iniciar sesion</button>
        <a href="CrearCuenta.php">Crear Cuenta</a>

    </form>
</body>