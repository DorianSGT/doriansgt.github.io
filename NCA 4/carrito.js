let total = 0;

function agregarAlCarrito(precio) {
    total += precio;
    document.getElementById('total').innerText = `Total: $${total}`;
}