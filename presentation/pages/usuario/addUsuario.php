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
            <h1 class="text-3xl font-bold text-gray-800">Ingresar Usuarios</h1>
        </div>
            <form  id="usuarioForm"  class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <div class="mb-4">
                    <label for="nombre" class="block text-gray-700 text-sm font-bold mb-2">Nombre usuarios:</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Ingrese su nombre"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label for="correo" class="block text-gray-700 text-sm font-bold mb-2">Correo de usuario:</label>
                    <input type="text" id="correo" name="correo" placeholder="Ingrese su correo"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Contraseña:</label>
                    <input type="text" id="password" name="password"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                <label for="rol" class="block text-gray-700 text-sm font-bold mb-2">Tipo de Usuario:</label>
                <select id="rol" name="rol" class="input-field" required>
                    <option value="user">Cliente</option>
                    <option value="admin">Administrador</option>
                </select>
            </div>
                <div class="flex items-center justify-between">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Ingresar</button>
                </div>
            </form>
        </div>
    </div>

</body>
<script src="../../scripts/usuario/add-usuario.js"></script>
</html>