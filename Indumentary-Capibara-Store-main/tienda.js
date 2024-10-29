const btnCart = document.querySelector('.container-cart-icon');
const containerCartProducts = document.querySelector('.container-cart-products');
const productList = document.querySelectorAll('.container_items > .grid-imagen, .container_items2 > .grid-imagen2');
let allProductos = [];
const valorTotal = document.querySelector('.total-pagar');
const countProduct = document.querySelector('#contador-productos');

btnCart.addEventListener('click', () => {
    containerCartProducts.classList.toggle('hidden-cart');
});

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
                    <span class="total-pagar">$${total.toFixed(2)}</span><a href="pago.php">pagar</a>`;
            containerCartProducts.appendChild(totalDiv);
        }
    
        // Actualizamos el contador de productos
        let totalCount = 0;
        allProductos.forEach(product => {
            totalCount += product.quantity;
        });
        countProduct.textContent = totalCount;
    
    }

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
