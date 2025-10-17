document.getElementById('contacto-form').addEventListener('submit', async (e) => {
  e.preventDefault();

  const nombre = document.getElementById('nombre').value.trim();
  const correo = document.getElementById('correo').value.trim();
  const mensaje = document.getElementById('mensaje').value.trim();

  if (!nombre || !correo || !mensaje) {
    document.getElementById('respuesta').textContent = '⚠️ Por favor, complete todos los campos.';
    return;
  }

  try {
    const response = await fetch('http://localhost:8082/contacto.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ nombre, correo, mensaje })
    });

    const data = await response.json();

    if (response.ok && data.success) {
      document.getElementById('respuesta').textContent = '✅ ¡Gracias por contactarnos! Tu mensaje fue enviado correctamente.';
      e.target.reset();
    } else {
      document.getElementById('respuesta').textContent = '❌ ' + (data.error || 'Error al enviar el mensaje.');
    }
  } catch (error) {
    console.error(error);
    document.getElementById('respuesta').textContent = '⚠️ Error de conexión con el servidor.';
  }
});