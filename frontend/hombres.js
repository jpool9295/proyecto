// mujeres.js — versión final optimizada

// ---- VARIABLES PRINCIPALES ----
const botonesAgregar = document.querySelectorAll('.btn');
const cuerpoCarrito = document.getElementById('carrito-body');
const totalSpan = document.getElementById('total');
const vaciarBtn = document.getElementById('vaciar-carrito');
const pagarBtn = document.getElementById('pagar-carrito');
const carritoDiv = document.getElementById('carrito');

// ---- CARRITO EN MEMORIA ----
let carrito = [];

// ---- AGREGAR PRODUCTO ----
botonesAgregar.forEach((btn) => {
  btn.addEventListener('click', (e) => {
    const item = e.target.closest('.item');
    const nombre = item.querySelector('p').textContent;

    // Buscar el párrafo con "Precio"
    const precioParrafo = Array.from(item.querySelectorAll('p'))
      .find(p => p.textContent.toLowerCase().includes('precio'));

    // Extraer el número (ej. "Precio S/.350" → 350)
    let precio = 0;
    if (precioParrafo) {
      const match = precioParrafo.textContent.match(/(\d+([.,]\d+)?)/);
      if (match) precio = parseFloat(match[1]);
    }

    const producto = { nombre, precio, cantidad: 1 };

    // Si el producto ya está en el carrito, solo aumenta la cantidad
    const existente = carrito.find(p => p.nombre === producto.nombre);
    if (existente) {
      existente.cantidad++;
    } else {
      carrito.push(producto);
    }

    actualizarCarrito();
    carritoDiv.classList.add('activo'); // Mostrar el carrito lateral
  });
});

// ---- ACTUALIZAR TABLA DEL CARRITO ----
function actualizarCarrito() {
  cuerpoCarrito.innerHTML = '';
  let total = 0;

  carrito.forEach((p, index) => {
    const subtotal = p.precio * p.cantidad;
    total += subtotal;

    const fila = document.createElement('tr');
    fila.innerHTML = `
      <td>${p.nombre}</td>
      <td>${p.precio.toFixed(2)}</td>
      <td><input type="number" min="1" value="${p.cantidad}" data-index="${index}" class="cantidad-input"></td>
      <td>${subtotal.toFixed(2)}</td>
      <td><button class="eliminar" data-index="${index}">❌</button></td>
    `;
    cuerpoCarrito.appendChild(fila);
  });

  totalSpan.textContent = total.toFixed(2);
  localStorage.setItem('carrito', JSON.stringify(carrito));
}

// ---- CAMBIAR CANTIDAD ----
cuerpoCarrito.addEventListener('input', (e) => {
  if (e.target.classList.contains('cantidad-input')) {
    const index = e.target.dataset.index;
    carrito[index].cantidad = parseInt(e.target.value);
    actualizarCarrito();
  }
});

// ---- ELIMINAR PRODUCTO ----
cuerpoCarrito.addEventListener('click', (e) => {
  if (e.target.classList.contains('eliminar')) {
    const index = e.target.dataset.index;
    carrito.splice(index, 1);
    actualizarCarrito();
  }
});

// ---- VACIAR CARRITO ----
vaciarBtn.addEventListener('click', () => {
  carrito = [];
  actualizarCarrito();
  carritoDiv.classList.remove('activo');
});

// ---- PAGAR ----
pagarBtn.addEventListener('click', () => {
  if (carrito.length === 0) {
    alert('Tu carrito está vacío.');
    return;
  }
  alert(`Gracias por tu compra 🛍️\nTotal pagado: S/. ${totalSpan.textContent}`);
  carrito = [];
  actualizarCarrito();
  carritoDiv.classList.remove('activo');
});

// ---- CARGAR CARRITO GUARDADO ----
window.addEventListener('DOMContentLoaded', () => {
  const guardado = localStorage.getItem('carrito');
  if (guardado) {
    carrito = JSON.parse(guardado);
    actualizarCarrito();
  }
});

// ---- CERRAR CARRITO CON ESC ----
window.addEventListener('keydown', (e) => {
  if (e.key === 'Escape') {
    carritoDiv.classList.remove('activo');
  }
});
