<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lavandería Automatizada</title>
    <!-- Incluir Tailwind CSS -->
    <link href="../css/tailwind.css" rel="stylesheet">
    <!-- Incluir SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

    <h3 class="text-xl font-bold mb-6 text-center">Registro de Usuario</h3>
    <div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-lg">
        <form id="registroForm" class="w-full" action="registrar_usuario.php" method="POST">
            <table class="table-auto w-full border-collapse">
                <tbody>
                    <tr>
                        <td class="px-4 py-2">
                            <label for="nombre" class="block text-gray-700 font-bold mb-2">Nombre</label>
                        </td>
                        <td class="px-4 py-2">
                            <input type="text" id="nombre" name="nombre" class="border border-gray-300 p-2 rounded w-full" required>
                            <p class="text-red-500 text-xs mt-2 hidden" id="nombreError">El nombre es obligatorio.</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2">
                            <label for="correo" class="block text-gray-700 font-bold mb-2">Correo Electrónico</label>
                        </td>
                        <td class="px-4 py-2">
                            <input type="email" id="correo" name="correo" class="border border-gray-300 p-2 rounded w-full" required>
                            <p class="text-red-500 text-xs mt-2 hidden" id="correoError">Debe ser un correo electrónico válido.</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2">
                            <label for="password" class="block text-gray-700 font-bold mb-2">Contraseña</label>
                        </td>
                        <td class="px-4 py-2">
                            <input type="password" id="password" name="password" class="border border-gray-300 p-2 rounded w-full" required>
                            <p class="text-red-500 text-xs mt-2 hidden" id="passwordError">La contraseña es obligatoria.</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2">
                            <label for="rol" class="block text-gray-700 font-bold mb-2">Rol de Usuario</label>
                        </td>
                        <td class="px-4 py-2">
                            <select id="rol" name="rol" class="border border-gray-300 p-2 rounded w-full" required onchange="toggleAdminCodeField()">
                                <option value="">Seleccione un rol</option>
                                <option value="admin">Administrador</option>
                                <option value="user">Usuario</option>
                            </select>
                            <p class="text-red-500 text-xs mt-2 hidden" id="rolError">Debe seleccionar un rol.</p>
                        </td>
                    </tr>
                    <tr id="adminCodeRow" class="hidden">
                        <td class="px-4 py-2">
                            <label for="codigo_admin" class="block text-gray-700 font-bold mb-2">Código de Administrador (opcional)</label>
                        </td>
                        <td class="px-4 py-2">
                            <input type="text" id="codigo_admin" name="codigo_admin" class="border border-gray-300 p-2 rounded w-full">
                        </td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2" colspan="2">
                            <div class="flex items-center justify-between">
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Registrarse</button>
                                <a href="../index.html" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 block text-center">Cancelar</a>                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
    
    <!-- Modal de Confirmación -->
    <div id="modalConfirmacion" class="fixed inset-0 flex items-center justify-center hidden bg-black bg-opacity-50">
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-md mx-auto">
            <p class="text-xl font-bold mb-4">¡Registro Exitoso!</p>
            <p class="mb-4">El usuario ha sido registrado correctamente.</p>
            <button id="cerrarModal" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Cerrar</button>
        </div>
    </div>

    <script>
        function toggleAdminCodeField() {
            const rol = document.getElementById('rol').value;
            const adminCodeRow = document.getElementById('adminCodeRow');
            if (rol === 'admin') {
                adminCodeRow.classList.remove('hidden');
            } else {
                adminCodeRow.classList.add('hidden');
            }
        }

        function showModal(message) {
            Swal.fire({
                title: 'Error',
                text: message,
                icon: 'error',
                confirmButtonText: 'Cerrar'
            });
        }

        <?php if(isset($_GET['error']) && $_GET['error'] == 'correo_duplicado'): ?>
        showModal('El correo ya está registrado.');
        <?php elseif(isset($_GET['registro']) && $_GET['registro'] == 'exitoso'): ?>
        Swal.fire({
            title: '¡Registro Exitoso!',
            text: 'El usuario ha sido registrado correctamente.',
            icon: 'success',
            confirmButtonText: 'Cerrar'
        });
        <?php endif; ?>
    </script>

</body>
</html>
