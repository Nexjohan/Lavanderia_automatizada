<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario con Tailwind CSS</title>
    <!-- Incluye Tailwind CSS -->
    <link href="../../styles/tailwind.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <!-- Barra de navegación -->
    <?php include ('../../components/navigation.php'); ?>

    <div class="container mx-auto max-w-md py-8">
        <!-- Encabezado -->
        <div class="flex items-center justify-between mb-4 text-justify">
            <h1 class="text-3xl font-bold text-gray-800">Ingresar Servicios</h1>
        </div>
        <form id="servicioForm" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="mb-4">
                <label for="nombre" class="block text-gray-700 text-sm font-bold mb-2">Nombre servicio:</label>
                <input type="text" id="nombre" name="nombre" placeholder="Ingrese el nombre del servicio"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="descripcion" class="block text-gray-700 text-sm font-bold mb-2">Descripción servicio:</label>
                <input type="text" id="descripcion" name="descripcion" placeholder="Ingrese la descripción"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="categoria_id" class="block text-[#191d20] font-bold mb-2">Categoría:</label>
                <select id="categoria_id" name="categoria_id" class="w-full px-3 py-2 border rounded-lg text-[#2E2E2E] focus:outline-none focus:border-blue-500">
                </select>
            </div>

            <div class="mb-4">
                <label for="precio" class="block text-gray-700 text-sm font-bold mb-2">Precio servicio:</label>
                <input type="number" id="precio" name="precio" placeholder="Ingrese el precio"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-6">
                <label for="imagen" class="block text-gray-700 text-sm font-bold mb-2">Imagen servicio:</label>
                <input type="file" id="imagen" name="imagen" accept="image/*"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="flex items-center justify-between">
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Agregar servicio</button>
            </div>
        </form>
    </div>

    <script src="../../scripts/servicio/add-servicio.js"></script>
</body>
</html>
