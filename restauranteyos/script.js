// Archivo: script.js
document.addEventListener('DOMContentLoaded', function() {
    const orderForm = document.querySelector('#order-form');

    if (orderForm) {
        orderForm.addEventListener('submit', function(event) {
            const confirmation = confirm('¿Estás seguro de que deseas realizar este pedido?');
            if (!confirmation) {
                event.preventDefault();
            }
        });
    }
});
