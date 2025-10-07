// ======== VARIABLES ========
let carrito = [];

const botonesAgregar = document.querySelectorAll(".Agregar");
const carritoBody = document.getElementById("carrito-body");
const totalSpan = document.getElementById("total");
const vaciarBtn = document.getElementById("vaciar-carrito");
const pagarBtn = document.getElementById("pagar-carrito");

// ======== FUNCIÓN PARA ACTUALIZAR EL CARRITO ========
function actualizarCarrito() {
  carritoBody.innerHTML = "";
  let total = 0;

  carrito.forEach((item, index) => {
    const subtotal = item.precio * item.cantidad;
    total += subtotal;

    const fila = document.createElement("tr");
    fila.innerHTML = `
      <td>${item.nombre}</td>
      <td>S/. ${item.precio.toFixed(2)}</td>
      <td>${item.cantidad}</td>
      <td>S/. ${subtotal.toFixed(2)}</td>
      <td><button class="eliminar" data-index="${index}">❌</button></td>
    `;
    carritoBody.appendChild(fila);
  });

  totalSpan.textContent = total.toFixed(2);

  // Agregar eventos de eliminar
  document.querySelectorAll(".eliminar").forEach(btn => {
    btn.addEventListener("click", e => {
      const index = e.target.dataset.index;
      carrito.splice(index, 1);
      actualizarCarrito();
    });
  });
}

// ======== FUNCIÓN: AGREGAR AL CARRITO ========
botonesAgregar.forEach(boton => {
  // Mostrar texto en los botones vacíos
  boton.textContent = "Agregar al carrito";

  boton.addEventListener("click", () => {
    const nombre = boton.dataset.nombre;
    const precio = parseFloat(boton.dataset.precio);

    // Verificar si ya está en el carrito
    const productoExistente = carrito.find(p => p.nombre === nombre);

    if (productoExistente) {
      productoExistente.cantidad++;
    } else {
      carrito.push({ nombre, precio, cantidad: 1 });
    }

    actualizarCarrito();
    alert(`✅ ${nombre} agregado al carrito.`);
  });
});

// ======== FUNCIÓN: VACIAR CARRITO ========
vaciarBtn.addEventListener("click", () => {
  if (carrito.length === 0) {
    alert("🛒 El carrito ya está vacío.");
    return;
  }

  const confirmar = confirm("¿Deseas vaciar todo el carrito?");
  if (confirmar) {
    carrito = [];
    actualizarCarrito();
  }
});

// ======== FUNCIÓN: PAGAR CARRITO ========
pagarBtn.addEventListener("click", () => {
  const total = parseFloat(totalSpan.textContent);

  if (total === 0) {
    alert("🛒 Tu carrito está vacío. Agrega productos antes de pagar.");
    return;
  }

  const confirmar = confirm(`💳 Vas a pagar S/. ${total.toFixed(2)}. ¿Deseas continuar?`);

  if (confirmar) {
    alert("✅ ¡Pago realizado con éxito! 🎉\nGracias por comprar en Tienda Urbana 💙💛");
    carrito = [];
    actualizarCarrito();
  }
});
