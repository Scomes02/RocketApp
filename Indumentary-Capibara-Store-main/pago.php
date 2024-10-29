<?php
session_start();

if (!isset($_SESSION['Usuario'])) {
    header('Location: iniciocapibara.php');
    exit;
}
?>
<!DOCTYPE html>
<html laang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap-grid.min.css" integrity="sha512-q0LpKnEKG/pAf1qi1SAyX0lCNnrlJDjAvsyaygu07x8OF4CEOpQhBnYiFW6YDUnOOcyAEiEYlV4S9vEc6akTEw==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="Proyecto nuevo.ico">
    <title> CAPIBARA STORE - Pagina de Pago</title>
    <link rel="stylesheet" href="styleGeneral.css">
    <link rel="stylesheet" href="style4.css">
</head>

<body>
    <h1>Metodos de Pago</h1>
    <hr>
    <h7><img src="atencion.ico" alt="atencion" class="metodo_pago">Momentaneamente el metodo de pago sera en el local<img src="atencion.ico" alt="atencion" class="metodo_pago"></h7>
    <hr>
    <div class="metodos-pago">
        <div class="metodo-pago">
            <img src="debitCard.png" alt="Tarjeta de Débito">
            <input type="radio" id="debito" name="metodo_pago" value="debito">
            <label for="debito">Tarjeta de Débito</label>
        </div>
        <div class="metodo-pago">
            <img src="creditCard.png" alt="Tarjeta de Crédito">
            <input type="radio" id="credito" name="metodo_pago" value="credito">
            <label for="credito">Tarjeta de Crédito</label>
        </div>
        <div class="metodo-pago">
        <img src="mercadoPago.png" alt="Mercado Pago">    
        <input type="radio" id="mercadopago" name="metodo_pago" value="mercadopago">
            <label for="mercadopago" >Mercado Pago</label>
        </div>
        <div class="metodo-pago">
            <img src="plata.png" alt="Efectivo">
            <input type="radio" id="efectivo" name="metodo_pago" value="efectivo">
            <label for="efectivo" >Efectivo</label>
        </div>
    </div>
    <hr>
    <button id="btnPagar">Pagar</button>

    <div class="mensaje-emergente" id="mensajePago">
        <div class="mensaje-contenido">
            <img src="ok.ico" alt="Icono de confirmación">
            Gracias por su compra, el pago se realizará en el local.
        </div>
    </div>
    <script>
        const btnPagar = document.getElementById('btnPagar');

        const mensajePago = document.getElementById('mensajePago');

        btnPagar.addEventListener('click', () => {
            mensajePago.style.display = 'block';

            setTimeout(() => {
                window.location.href = 'index.php';
            }, 5000);
        });
    </script>
    
</body>

</html>