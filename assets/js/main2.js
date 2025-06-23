var contador = true;
function vista() {
    var texto = document.getElementById("verPassword");
    if (contador == true) {
        texto.className = "fas fa-eye-slash verPassword";
        document.getElementById("input").type="text";
        contador=false;
    } else {
        texto.className = "fas fa-eye verPassword";
        document.getElementById("input").type="password";
        contador = true;
    }
}



document.addEventListener('DOMContentLoaded', () => {
    const cartIcon = document.querySelector('.fa-cart-shopping');
    const cartCount = document.querySelector('#cart-count');

    // Simula agregar productos (solo para prueba)
    const addToCartButtons = document.querySelectorAll('.btn-agregar-carrito');
    addToCartButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Agregar clase de animación
            cartIcon.classList.add('cart-bounce');

            // Simular actualización del contador (normalmente manejado por backend)
            let currentCount = parseInt(cartCount.textContent);
            cartCount.textContent = currentCount + 1;

            // Quitar clase después de la animación
            setTimeout(() => cartIcon.classList.remove('cart-bounce'), 500);
        });
    });
});
setTimeout(() => {
    const alert = document.querySelector('.alert');
    if (alert) alert.remove();
}, 5000); // 5 segundos
cartCounter.textContent = data.totalProductos;
cartCounter.classList.add('updated');
setTimeout(() => cartCounter.classList.remove('updated'), 300);

document.addEventListener('click', function (e) {
    if (e.target.matches('.btn-remove-product')) { // Clase del botón para eliminar productos
        e.preventDefault();

        // Obtén el rowid del producto desde el atributo data-rowid del botón
        const rowid = e.target.dataset.rowid;

        fetch(`/carrito/eliminar_producto/${rowid}`, {
            method: 'GET',
        })
        .then(response => response.json())
        .then(data => {
            if (data.totalProductos !== undefined) {
                // Actualiza el contador del carrito en el icono
                const cartCounter = document.querySelector('.cart-counter');
                if (cartCounter) {
                    cartCounter.textContent = data.totalProductos;
                }

                // Opcional: Elimina el producto de la vista del carrito
                const productRow = e.target.closest('tr');
                if (productRow) productRow.remove();
            }
        })
        .catch(error => console.error('Error al actualizar el carrito:', error));
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const cartCounter = document.getElementById('cart-counter');

    function updateCartCounter(newValue) {
        // Actualiza el valor del contador
        cartCounter.textContent = newValue;

        // Reinicia las animaciones
        cartCounter.classList.remove('cart-bounce', 'cart-counter-change');
        void cartCounter.offsetWidth; // Forzar reflujo para reiniciar animación
        cartCounter.classList.add('cart-bounce', 'cart-counter-change');
    }

    // Simula un cambio de valor (ejemplo para pruebas)
    setTimeout(() => updateCartCounter(5), 1000); // Cambia el valor a 5 después de 1 segundo
});

  document.addEventListener('DOMContentLoaded', function () {
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltipTriggerList.forEach(function (tooltipTriggerEl) {
      new bootstrap.Tooltip(tooltipTriggerEl)
    })
  });
