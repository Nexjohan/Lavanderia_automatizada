<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulario de Pedido de Servicio</title>
  <link href="../css/tailwind.css" rel="stylesheet">
  <script>
    function validarFormulario(event) {
      event.preventDefault(); // Prevenir el envío del formulario por defecto

      // Obtener valores de los campos
      var nombre = document.getElementById('nombre').value;
      var email = document.getElementById('email').value;
      var telefono = document.getElementById('telefono').value;
      var servicio = document.getElementById('servicio').value;
      var mensaje = document.getElementById('mensaje').value;

      // Validar campos obligatorios
      if (nombre.trim() === '' || email.trim() === '' || telefono.trim() === '' || servicio === '') {
        alert('Por favor, completa todos los campos.');
        return false;
      }

      // Validar formato de correo electrónico
      var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(email)) {
        alert('Por favor, ingresa un correo electrónico válido.');
        return false;
      }

      // Si todas las validaciones pasan, registrar en la tabla y limpiar formulario
      registrarEnvio(nombre, email, telefono, servicio, mensaje);
      alert('Formulario enviado correctamente.');
      limpiarFormulario();
      return true;
    }

    function registrarEnvio(nombre, email, telefono, servicio, mensaje) {
      // Obtener la referencia a la tabla
      var tablaEnvios = document.getElementById('tabla-envios');

      // Crear una nueva fila y añadir datos
      var nuevaFila = tablaEnvios.insertRow();
      var celdaNombre = nuevaFila.insertCell(0);
      var celdaEmail = nuevaFila.insertCell(1);
      var celdaTelefono = nuevaFila.insertCell(2);
      var celdaServicio = nuevaFila.insertCell(3);
      var celdaMensaje = nuevaFila.insertCell(4);

      celdaNombre.textContent = nombre;
      celdaEmail.textContent = email;
      celdaTelefono.textContent = telefono;
      celdaServicio.textContent = servicio;
      celdaMensaje.textContent = mensaje;
    }

    function limpiarFormulario() {
      // Limpiar los campos del formulario después de enviar
      document.getElementById('nombre').value = '';
      document.getElementById('email').value = '';
      document.getElementById('telefono').value = '';
      document.getElementById('servicio').value = '';
      document.getElementById('mensaje').value = '';
    }
  </script>
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">
  <div class="max-w-md mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
    <h2 class="text-xl font-bold mb-4">Formulario de Pedido de Servicio</h2>
    
    <form onsubmit="return validarFormulario(event)">
      <!-- Campos del formulario -->
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="nombre">
          Nombre
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nombre" type="text" placeholder="Nombre completo" required>
      </div>
      
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
          Correo Electrónico
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="email" placeholder="Correo electrónico" required>
      </div>
      
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="telefono">
          Teléfono
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="telefono" type="tel" placeholder="Teléfono de contacto" required>
      </div>
      
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="servicio">
          Servicio Solicitado
        </label>
        <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="servicio" required>
          <option value="">Seleccionar servicio...</option>
          <option value="limpieza">Limpieza</option>
          <option value="reparacion">Reparación</option>
          <option value="consultoria">Consultoría</option>
          <!-- Añade más opciones según necesites -->
        </select>
      </div>
      
      <div class="mb-6">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="mensaje">
          Mensaje Adicional
        </label>
        <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="mensaje" placeholder="Escribe detalles adicionales o preguntas"></textarea>
      </div>
      
      <!-- Botón de enviar -->
      <div class="flex items-center justify-between">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
          Enviar Pedido
        </button>
        <a href="../index.html" class="bg-red-600 text-white py-2 px-4 hover:bg-red-700 mx-2">Menú Principal</a>
      </div>
    </form>
    
    <!-- Tabla de registros de envíos -->
    <div class="mt-8">
      <h3 class="text-lg font-bold mb-4">Registros de Envíos</h3>
      <table id="tabla-envios" class="border-collapse border border-gray-300 w-full">
        <thead>
          <tr>
            <th class="border border-gray-300 px-4 py-2">Nombre</th>
            <th class="border border-gray-300 px-4 py-2">Email</th>
            <th class="border border-gray-300 px-4 py-2">Teléfono</th>
            <th class="border border-gray-300 px-4 py-2">Servicio</th>
            <th class="border border-gray-300 px-4 py-2">Mensaje</th>
          </tr>
        </thead>
        <tbody>
          <!-- Aquí se agregarán dinámicamente las filas de datos -->
        </tbody>
      </table>
    </div>
  </div>

  <script>
    // Cargar datos desde el almacenamiento local al cargar la página
    document.addEventListener('DOMContentLoaded', function() {
      cargarDatosDesdeLocalStorage();
    });

    function registrarEnvio(nombre, email, telefono, servicio, mensaje) {
      // Crear objeto con los datos del envío
      var envio = {
        nombre: nombre,
        email: email,
        telefono: telefono,
        servicio: servicio,
        mensaje: mensaje
      };

      // Obtener la referencia a la tabla
      var tablaEnvios = document.getElementById('tabla-envios');

      // Crear una nueva fila y añadir datos
      var nuevaFila = tablaEnvios.insertRow();
      var celdaNombre = nuevaFila.insertCell(0);
      var celdaEmail = nuevaFila.insertCell(1);
      var celdaTelefono = nuevaFila.insertCell(2);
      var celdaServicio = nuevaFila.insertCell(3);
      var celdaMensaje = nuevaFila.insertCell(4);

      celdaNombre.textContent = envio.nombre;
      celdaEmail.textContent = envio.email;
      celdaTelefono.textContent = envio.telefono;
      celdaServicio.textContent = envio.servicio;
      celdaMensaje.textContent = envio.mensaje;

      // Guardar en el almacenamiento local
      guardarEnvioLocalStorage(envio);
    }

    function guardarEnvioLocalStorage(envio) {
      var envios = obtenerEnviosLocalStorage();
      envios.push(envio);
      localStorage.setItem('envios', JSON.stringify(envios));
    }

    function obtenerEnviosLocalStorage() {
      var envios;
      if (localStorage.getItem('envios') === null) {
        envios = [];
      } else {
        envios = JSON.parse(localStorage.getItem('envios'));
      }
      return envios;
    }

    function cargarDatosDesdeLocalStorage() {
      var envios = obtenerEnviosLocalStorage();

      envios.forEach(function(envio) {
        var tablaEnvios = document.getElementById('tabla-envios');
        var nuevaFila = tablaEnvios.insertRow();
        var celdaNombre = nuevaFila.insertCell(0);
        var celdaEmail = nuevaFila.insertCell(1);
        var celdaTelefono = nuevaFila.insertCell(2);
        var celdaServicio = nuevaFila.insertCell(3);
        var celdaMensaje = nuevaFila.insertCell(4);

        celdaNombre.textContent = envio.nombre;
        celdaEmail.textContent = envio.email;
        celdaTelefono.textContent = envio.telefono;
        celdaServicio.textContent = envio.servicio;
        celdaMensaje.textContent = envio.mensaje;
      });
    }
  </script>
</body>
</html>
