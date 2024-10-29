<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap-grid.min.css" 
    integrity="sha512-q0LpKnEKG/pAf1qi1SAyX0lCNnrlJDjAvsyaygu07x8OF4CEOpQhBnYiFW6YDUnOOcyAEiEYlV4S9vEc6akTEw==" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="Proyecto nuevo.ico">
    <title>CAPIBARA STORE - Inicio de Sesión</title>
    <link rel="stylesheet" href="styleGeneral.css">
    <link rel="stylesheet" href="style3.css">
</head>

<body>
    <form action="Registrarse.php" method="post">
        <h1>REGISTRAR</h1>
        <hr>
        <?php if(isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']?></p>
        <?php } ?>
        <br>
        <?php if(isset($_GET['success'])) { ?> 
            <p class='success'><?php echo $_GET['success']?></p>
        <?php } ?>
        <br>
        <label for="usuario">
            <i class="fa-solid fa-user"></i> Usuario
        </label>
        <input type="text" id="usuario" name="Usuario" placeholder="Ingrese Usuario">
        <label for="nombre_completo">
            <i class="fa-solid fa-users"></i> Nombre Completo
        </label>
        <input type="text" id="nombre_completo" name="Nombre_completo" placeholder="Ingrese Nombre Completo">
        <label for="clave">
            <i class="fa-solid fa-key"></i> Clave
        </label>
        <input type="password" id="clave" name="Clave" placeholder="Ingrese Clave">
        <label for="rclave">
            <i class="fa-solid fa-key"></i> Repetir Clave
        </label>
        <input type="password" id="rclave" name="RClave" placeholder="Repetir Clave">
        <hr>
        <input type="submit" class="button styled-button" value="Registrarse">
    </form>
    <?php if(isset($_SESSION['error'])) { ?>
        <p class="error"><?php echo $_SESSION['error']; ?></p>
    <?php unset($_SESSION['error']); } ?>
</body>
</html>
