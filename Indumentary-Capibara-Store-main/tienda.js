const btnCart = document.querySelector('.container-cart-icon');
const containerCartProducts = document.querySelector('.container-cart-products');
const productList = document.querySelectorAll('.container_items > .grid-imagen, .container_items2 > .grid-imagen2');
let allProductos = [];
const valorTotal = document.querySelector('.total-pagar');
const countProduct = document.querySelector('#contador-productos');

btnCart.addEventListener('click', () => {
    containerCartProducts.classList.toggle('hidden-cart');
});

// Función de búsqueda y filtrado de productos
document.getElementById('search-button').addEventListener('click', searchProducts);

function searchProducts() {
    // Obtener valores de búsqueda y categoría
    const searchTerm = document.getElementById("search-bar").value.toLowerCase();
    const selectedCategory = document.getElementById("category-filter").value;

    console.log('Término de búsqueda:', searchTerm); // Verifica el término de búsqueda
    console.log('Categoría seleccionada:', selectedCategory); // Verifica la categoría seleccionada

    // Seleccionar todos los productos (ambas clases)
    const products = document.querySelectorAll(".grid-imagen, .grid-imagen2");

    let hasVisibleRemeras = false;
    let hasVisiblePantalones = false;

    // Recorrer los productos y aplicar filtros
    products.forEach(product => {
        // Obtener el nombre del producto desde el div info_producto
        const productNameElement = product.querySelector(".info_producto h2");

        if (!productNameElement) {
            console.error('No se encontró el elemento h2 en info_producto para el producto:', product);
            return; // Salir si no se encuentra el elemento
        }

        const productName = productNameElement.textContent.toLowerCase(); // Obtener el nombre del producto
        const productCategory = product.dataset.category; // Obtener la categoría del producto

        // Mostrar u ocultar productos según los criterios
        const matchesSearch = productName.includes(searchTerm) || searchTerm === ""; // Coincide con el nombre del producto
        const matchesCategory = (selectedCategory === "all") || (productCategory === selectedCategory); // Coincide con la categoría seleccionada

        // Mostrar sólo si ambos criterios coinciden
        if (matchesSearch && matchesCategory) {
            product.style.display = "block"; // Mostrar producto
            console.log('Mostrando producto:', productName); // Verifica qué producto se muestra

            // Determinar si pertenece a una categoría visible
            if (productCategory === "Remeras") hasVisibleRemeras = true;
            if (productCategory === "Pantalones") hasVisiblePantalones = true;
        } else {
            product.style.display = "none"; // Ocultar producto
            console.log('Ocultando producto:', productName); // Verifica qué producto se oculta
        }
    });

// Se añaden los contenedores de los encabezados
const remerasHeader = document.querySelector(".container-header h1");
const pantalonesHeader = document.querySelector(".container-header h2");

// Mostrar u ocultar los encabezados según corresponda
if (remerasHeader) {
    if (hasVisibleRemeras) {
        remerasHeader.parentNode.style.display = "block"; // Mostrar contenedor
    } else {
        remerasHeader.parentNode.style.display = "none"; // Ocultar contenedor
    }
}

if (pantalonesHeader) {
    if (hasVisiblePantalones) {
        pantalonesHeader.parentNode.style.display = "block"; // Mostrar contenedor
    } else {
        pantalonesHeader.parentNode.style.display = "none"; // Ocultar contenedor
    }
}

    
}


// Agregar productos al carrito
productList.forEach(product => {
    product.addEventListener('click', e => {
        if (e.target.classList.contains('btn-add-cart')) {
            const imgSrc = e.target.getAttribute('data-img');
            const productInfo = {
                quantity: 1,
                title: e.target.parentElement.querySelector('h2').textContent,
                price: parseFloat(e.target.parentElement.querySelector('.precio').textContent.replace('$', '').trim()),
                img: imgSrc
            };

            const exists = allProductos.some(item => item.title === productInfo.title);

            if (exists) {
                allProductos = allProductos.map(item => {
                    if (item.title === productInfo.title) {
                        item.quantity++;
                        return item;
                    } else {
                        return item;
                    }
                });
            } else {
                allProductos.push(productInfo);
            }

            showProducts();
        }
    });
});

// Función para eliminar una unidad de un producto del carrito
function removeProductUnit(title) {
    allProductos.forEach(product => {
        if (product.title === title) {
            product.quantity--;
            if (product.quantity === 0) {
                // Si la cantidad llega a cero, eliminamos el producto del array
                allProductos = allProductos.filter(item => item.title !== title);
            }
            return;
        }
    });
    showProducts();
}

// Manejador de eventos para eliminar una unidad de un producto del carrito
containerCartProducts.addEventListener('click', e => {
    if (e.target.classList.contains('btn-remove-unit')) {
        const title = e.target.parentElement.querySelector('.titulo-procuto-carrito').textContent;
        removeProductUnit(title);
    }
});

// Función para mostrar los productos en HTML
function showProducts() {
    containerCartProducts.innerHTML = ''; // Limpiamos el contenido del contenedor
    allProductos.forEach(product => {
        const productDiv = document.createElement('div');
        productDiv.classList.add('cart-product');

        const productInfo = `
            <div class="info-cart-product">
                <img src="${product.img}" alt="${product.title}" class="cart-product-image">
                <span class="cantidad-carrito-producto">${product.quantity}</span>
                <p class="titulo-procuto-carrito">${product.title}</p>
                <span class="precio-producto-carrito">$${product.price.toFixed(2)}</span>
            </div>
            <img src="fotos tienda/borrar.jpg" alt="Eliminar producto" class="btn-remove-unit">`;
        productDiv.innerHTML = productInfo;
        containerCartProducts.appendChild(productDiv);
    });

    // Calculamos el valor total
    let total = 0;
    allProductos.forEach(product => {
        total += product.price * product.quantity;
    });

    // Creamos la sección de total a pagar si hay productos en el carrito
    if (allProductos.length > 0) {
        const totalDiv = document.createElement('div');
        totalDiv.classList.add('cart-total');
        totalDiv.innerHTML = `
            <h3>Total a pagar</h3>
            <span class="total-pagar">$${total.toFixed(2)}</span>
            <button id="btnPagar">Pagar</button>`; // Botón de pagar
        containerCartProducts.appendChild(totalDiv);

        // Agregar evento al botón de pagar
        document.getElementById('btnPagar').addEventListener('click', () => {
            // Envía el carrito de compras a la sesión antes de redirigir
            fetch('guardar_carrito.php', {
                method: 'POST',
                body: JSON.stringify(allProductos), // Enviamos el carrito como JSON
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => {
                if (response.ok) {
                    // Redirige a la página de pago
                    window.location.href = 'pago.php';
                } else {
                    console.error('Error al guardar el carrito.');
                }
            })
            .catch((error) => {
                console.error('Error:', error);
            });
        });
    }

    // Actualizamos el contador de productos
    let totalCount = 0;
    allProductos.forEach(product => {
        totalCount += product.quantity;
    });
    countProduct.textContent = totalCount;
}

// Función para actualizar el precio
function actualizarPrecio(articuloId, nuevoPrecio) {
    fetch('edicion_precio.php', {
        method: 'POST',
        body: JSON.stringify({ id: articuloId, precio: nuevoPrecio }),
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        console.log('Precio actualizado:', data);
    })
    .catch((error) => {
        console.error('Error:', error);
    });
}