document.getElementById('contactForm').addEventListener('submit', function(e) {
    e.preventDefault(); // Evitar que el formulario se envíe de forma tradicional

    var formData = new FormData(this);

    fetch('save_message.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert(data); // Mostrar respuesta del servidor
        // Puedes agregar lógica adicional para manejar la respuesta
    })
    .catch(error => {
        console.error('Error:', error);
    });
});
