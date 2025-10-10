// contacto.js
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('form-contacto');
    const mensajeConfirmacion = document.getElementById('mensaje-confirmacion');
  
    form.addEventListener('submit', (e) => {
      e.preventDefault(); // Evita que el formulario se envíe realmente
  
      // Puedes agregar validaciones extra aquí si quieres
  
      // Mostrar el mensaje de confirmación
      mensajeConfirmacion.style.display = 'block';
  
      // Opcional: limpiar el formulario
      form.reset();
    });
  });
  