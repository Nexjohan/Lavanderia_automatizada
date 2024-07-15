<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lavandería Automatizada - Iniciar Sesión</title>
    <!-- Incluir Tailwind CSS -->
    <link href="../css/tailwind.css" rel="stylesheet">
</head>
<body class="bg-celeste-pastel">
    <header class="bg-blue-600 text-white py-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="../index.html" class="text-xl font-bold hover:text-gray-200">Menú Principal</a>
            <nav class="space-x-4"></nav>
        </div>
    </header>
    <style>
        .bg-celeste-pastel {
            background-color: #a0d6e4;
        }
    </style>

    <h3 class="text-xl font-bold mb-6 text-center">Iniciar Sesión</h3>
    <div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-lg">
        <form id="loginForm" class="w-full" action="verificar_sesion.php" method="POST">
            <table class="table-auto w-full border-collapse">
                <tbody>
                    <tr>
                        <td class="px-4 py-2">
                            <label for="correo" class="block text-gray-700 font-bold mb-2">Correo Electrónico</label>
                        </td>
                        <td class="px-4 py-2">
                            <input type="email" id="correo" name="correo" class="border border-gray-300 p-2 rounded w-full" required>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2">
                            <label for="password" class="block text-gray-700 font-bold mb-2">Contraseña</label>
                        </td>
                        <td class="px-4 py-2">
                            <input type="password" id="password" name="password" class="border border-gray-300 p-2 rounded w-full" required>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2" colspan="2">
                            <div class="flex items-center justify-between">
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Iniciar Sesión</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>

    <!-- Modal de Error -->
    <div id="modalError" class="fixed inset-0 flex items-center justify-center hidden bg-black bg-opacity-50">
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-md mx-auto">
            <p class="text-xl font-bold mb-4">Error de Inicio de Sesión</p>
            <p class="mb-4">El correo electrónico o la contraseña no son válidos.</p>
            <button id="cerrarModalError" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Cerrar</button>
        </div>
    </div>

    <script>
        <?php if (isset($_GET['error'])): ?>
        // Mostrar el modal de error al cargar la página si hay un parámetro de error en la URL
        document.getElementById('modalError').classList.remove('hidden');
        <?php endif; ?>

        // Cerrar el modal de error al hacer clic en el botón "Cerrar"
        document.getElementById('cerrarModalError').addEventListener('click', function() {
            document.getElementById('modalError').classList.add('hidden');
        });
    </script>
</body>
</html>
