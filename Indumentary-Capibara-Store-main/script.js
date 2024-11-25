// Función para mostrar la ventana emergente
function mostrarVentanaEmergente() {
    var ventana = document.getElementById('divMensajes');
    ventana.style.display = 'block';
}

// Función para cerrar la ventana emergente
function cerrarVentanaEmergente() {
    var ventana = document.getElementById('divMensajes');
    ventana.style.display = 'none';
}

// Función para obtener los mensajes y mostrarlos en la ventana emergente
function obtenerMensajes() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var contenidoMensajes = document.getElementById('contenidoMensajes');
            contenidoMensajes.innerHTML = this.responseText;
            mostrarVentanaEmergente();
        }
    };
    xhttp.open('GET', 'ver_mensaje.php', true);
    xhttp.send();
}

// Función para cargar los eventos cuando el documento esté listo
document.addEventListener('DOMContentLoaded', function() {
    // Agrega un evento al botón para mostrar los mensajes
    var btnMostrarMensajes = document.getElementById('btnMostrarMensajes');
    if (btnMostrarMensajes) {
        btnMostrarMensajes.addEventListener('click', obtenerMensajes);
    }

    // Agrega un evento al botón de cerrar para cerrar la ventana emergente
    var btnCerrarVentana = document.getElementById('btnCerrarVentana');
    if (btnCerrarVentana) {
        btnCerrarVentana.addEventListener('click', cerrarVentanaEmergente);
    }
});

//Funcion para el movimiento de las imagenes principales "keyframes"
document.addEventListener('DOMContentLoaded', function() {
    var imagenes = document.querySelectorAll('.fotoPrincipal');
    imagenes.forEach(function(imagen) {
        imagen.style.animationPlayState = 'running';
    });
});