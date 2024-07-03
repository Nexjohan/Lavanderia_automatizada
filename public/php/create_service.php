<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulario con Tailwind CSS</title>
  <link href="../css/tailwind.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-8">
  <div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-6">
    <h2 class="text-2xl font-semibold mb-4">Formulario de Servicio</h2>
    <form>
      <div class="mb-4">
        <label for="nombre" class="block text-gray-700 font-bold mb-2">Nombre</label>
        <input type="text" id="nombre" name="nombre" placeholder="Nombre completo" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
      </div>
      <div class="mb-4">
        <label for="servicio" class="block text-gray-700 font-bold mb-2">Servicio</label>
        <select id="servicio" name="servicio" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
          <option value="">Seleccione un servicio</option>
          <option value="lavado-ropa">Lavado de ropa</option>
          <option value="secado-ropa">Secado de ropa</option>
          <option value="planchado-ropa">Planchado de ropa</option>
          <option value="lavado-seco">Lavado en seco</option>
          <option value="servicio-doblado">Servicio de doblado</option>
          <option value="lavado-articulos-grandes">Lavado de artículos grandes (colchas, cortinas)</option>
          <option value="servicio-entrega-recogida">Servicio de entrega y recogida a domicilio</option>
        </select>
      </div>
      <div class="mb-4">
        <label for="descripcion" class="block text-gray-700 font-bold mb-2">Descripción</label>
        <textarea id="descripcion" name="descripcion" rows="3" placeholder="Descripción del servicio" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"></textarea>
    </div>
      <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Enviar</button>
      <a href="../index.html" class="bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700 mx-2">Menú Principal</a>
    </form> 
  </div>
</body>
</html>
