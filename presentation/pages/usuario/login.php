<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesion</title>
    <link href="../../styles/tailwind.css" rel="stylesheet">
    <!-- Incluir SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100">
<?php include('../../components/navigation.php');?>

    <div class="container mx-auto max-w-md py-8">
       
        <form id="loginForm" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="flex items-center justify-between mb-4 text-justify">
            <h1 class="text-3xl font-bold text-gray-800">Login</h1>
            </div>
            <div class="mb-4">
                <label for="correo" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                <input type="text" id="correo" name="correo" placeholder="Ingrese su correo"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Contraseña:</label>
                <input type="password" id="password" name="password" placeholder="Ingrese su contraseña"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="flex items-center justify-between">
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Login</button>
            </div>
        </form>
    </div>
    <script src="../../scripts/usuario/login.js"></script>
</body>
</html>
