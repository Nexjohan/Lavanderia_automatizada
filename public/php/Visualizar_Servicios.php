<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Visualizar Servicios</title>
  <link href="../css/tailwind.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-8">
  <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md p-6">
    <h2 class="text-2xl font-semibold mb-4">Servicios Registrados</h2>
    <table class="min-w-full bg-white shadow-md rounded my-6">
      <thead class="bg-gray-800 text-white">
        <tr>
          <th class="py-2 px-4">ID</th>
          <th class="py-2 px-4">Nombre</th>
          <th class="py-2 px-4">Descripción</th>
          <th class="py-2 px-4">Fecha y Hora</th>
          <th class="py-2 px-4">Precio</th>
        </tr>
      </thead>
      <tbody id="tabla-servicios">
        <!-- Aquí se cargarán dinámicamente los servicios desde PHP -->
        <?php include 'servicios.php'; ?>
      </tbody>
    </table>
    <a href="../index.html" class="bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700 mt-4">Volver al Menú Principal</a>
  </div>
</body>
</html>
