<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú de Navegación con Cardview y Íconos</title>
    <!-- Incluye Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- Incluye FontAwesome para los íconos -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <!-- Barra de navegación -->
    <?php include('../../components/navigation.php');?>

    <!-- Contenido principal -->
    <div class="container mx-auto max-w-4xl py-8">
        <!-- Grid para cardviews -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">


            <!-- Cardview Categorias -->
            <div class="max-w-sm rounded overflow-hidden shadow-lg bg-white">
                <div class="px-6 py-4">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-list text-3xl text-blue-500 mr-2"></i>
                        <div class="font-bold text-xl">Categorias</div>
                    </div>
                    <p class="text-gray-700 text-base text-justify">
                        La sección de administración de categorias te permite gestionar de manera eficiente todas las categorias registradas en tu plataforma.
                    </p>
                </div>
                <div class="px-6 pt-4 pb-2">
                    <a href="../categoria/listarCategoria.php"
                        class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Ingresar
                    </a>
                </div>
            </div>

            <!-- Cardview Usuarios -->
            <div class="max-w-sm rounded overflow-hidden shadow-lg bg-white">
                <div class="px-6 py-4">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-user-circle text-3xl text-blue-500 mr-2"></i>
                        <div class="font-bold text-xl">Usuarios</div>
                    </div>
                    <p class="text-gray-700 text-base text-justify">
                        La sección de administración de usuarios te permite gestionar de manera eficiente todos los usuarios registrados en tu plataforma.
                    </p>
                </div>
                <div class="px-6 pt-4 pb-2">
                    <a href="../usuario/listarUsuarios.php"
                        class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Ingresar
                    </a>
                </div>
            </div>

            <!-- Cardview Usuarios -->
            <div class="max-w-sm rounded overflow-hidden shadow-lg bg-white">
                <div class="px-6 py-4">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-user-circle text-3xl text-blue-500 mr-2"></i>
                        <div class="font-bold text-xl">Servicios</div>
                    </div>
                    <p class="text-gray-700 text-base text-justify">
                        La sección de administración de servicios te permite gestionar de manera eficiente todos los servicios registrados en tu plataforma.
                    </p>
                </div>
                <div class="px-6 pt-4 pb-2">
                    <a href="../servicio/listarServicio.php"
                        class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Ingresar
                    </a>
                </div>
            </div>

            <!-- Cardview Usuarios -->
           
            </div>

        </div>
    </div>
</body>

</html>