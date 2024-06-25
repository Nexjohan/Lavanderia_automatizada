<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Categoría CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex flex-col items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md mb-8">
        <h2 class="text-2xl font-bold mb-6 text-center">Lavanderia Automatizada Categorías</h2>
        
        <form action="guardar_categoria.php" id="categoriaForm" class="space-y-4">
            <div>
                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre de la Categoría</label>
                <input type="text" id="nombre" name="nombre" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            
            <div>
                <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                <textarea id="descripcion" name="descripcion" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
            </div>
            
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">Guardar</button>
                <button type="button" id="clearButton" class="bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700">Limpiar</button>
            </div>
        </form>
        
        <div id="message" class="mt-4 text-center"></div>
    </div>

    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-4xl">
        <h2 class="text-2xl font-bold mb-6 text-center">Registros de Categorías</h2>
        
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descripción</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha y Hora</th>
                </tr>
            </thead>
            <tbody id="categoriaTableBody" class="bg-white divide-y divide-gray-200">
                <!-- Registros se agregarán aquí -->
            </tbody>
        </table>
    </div>

    <script>
        document.getElementById('categoriaForm').addEventListener('submit', function(event) {
            event.preventDefault();
            
            const nombre = document.getElementById('nombre').value;
            const descripcion = document.getElementById('descripcion').value;

            const formData = new FormData();
            formData.append('nombre', nombre);
            formData.append('descripcion', descripcion);

            fetch('guardar_categoria.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                document.getElementById('message').textContent = data;
                if (data.includes('exitosamente')) {
                    document.getElementById('message').classList.add('text-green-600');
                    const tableBody = document.getElementById('categoriaTableBody');
                    const row = document.createElement('tr');

                    const nombreCell = document.createElement('td');
                    nombreCell.classList.add('px-6', 'py-4', 'whitespace-nowrap', 'text-sm', 'text-gray-900');
                    nombreCell.textContent = nombre;

                    const descripcionCell = document.createElement('td');
                    descripcionCell.classList.add('px-6', 'py-4', 'whitespace-nowrap', 'text-sm', 'text-gray-900');
                    descripcionCell.textContent = descripcion;

                    const fechaHoraCell = document.createElement('td');
                    fechaHoraCell.classList.add('px-6', 'py-4', 'whitespace-nowrap', 'text-sm', 'text-gray-900');
                    const now = new Date();
                    fechaHoraCell.textContent = now.toLocaleString();

                    row.appendChild(nombreCell);
                    row.appendChild(descripcionCell);
                    row.appendChild(fechaHoraCell);

                    tableBody.appendChild(row);

                    document.getElementById('categoriaForm').reset();
                } else {
                    document.getElementById('message').classList.add('text-red-600');
                }
            })
            .catch(error => {
                document.getElementById('message').textContent = 'Error al guardar la categoría.';
                document.getElementById('message').classList.add('text-red-600');
            });
        });

        document.getElementById('clearButton').addEventListener('click', function() {
            document.getElementById('categoriaForm').reset();
            document.getElementById('message').textContent = '';
        });
    </script>
</body>
</html>
