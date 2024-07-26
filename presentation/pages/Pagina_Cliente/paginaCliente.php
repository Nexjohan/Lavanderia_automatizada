<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="../../scripts/pedido/pedido.js" defer></script>
</head>
<body class="bg-gray-100">
    <?php include('../../components/navigation.php'); ?>
    <div class="w-full">
        <section class="w-full h-screen bg-cover bg-center flex items-center justify-center" style="background-image: url('../../styles/img/fondo1.jpeg');">
            <div class="bg-black bg-opacity-50 p-10 rounded-lg text-center">
                <h1 class="text-5xl font-bold text-white mb-4">Bienvenido a nuestra lavanderia automatizada</h1>
                <p class="text-xl text-white">"Tu satisfacción, nuestra prioridad"</p>
            </div>
        </section>
        <section class="w-full min-h-screen bg-cover bg-center py-20" style="background-image: url('../../styles/img/fondo2.jpeg');">
            <div class="bg-black bg-opacity-50 py-10">
                <h2 class="text-3xl font-bold text-white text-center mb-10">Nuestros Servicios</h2>
                <div id="servicios-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 px-10">
                    <!-- Los servicios se cargarán aquí dinámicamente -->
                </div>
            </div>
        </section>
        <section class="w-full min-h-screen bg-cover bg-center py-20" style="background-image: url('../../styles/img/fondo3.jpeg');">
            <div class="bg-black bg-opacity-50 py-10">
                <h2 class="text-3xl font-bold text-white text-center mb-10">Información</h2>
                <div class="text-white text-center">
                    <p class="mb-4"><strong>Redes Sociales:</strong> Facebook, Twitter, Instagram</p>
                    <p class="mb-4"><strong>Horarios de Atención:</strong> Lunes a Viernes 9:00 AM - 6:00 PM</p>
                    <p class="mb-4"><strong>Ubicación:</strong> Calle Quito, Francisco de Orellana</p>
                    <p class="mb-4"><strong>Teléfono:</strong> +593 123 456 789</p>
                </div>
            </div>
        </section>
    </div>
    <button id="carrito-btn" class="fixed bottom-5 left-5 z-50 bg-blue-500 text-white p-4 rounded-full shadow-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-50">
        Carrito
    </button>
    <div id="carrito-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-3/4 max-w-3xl">
            <h2 class="text-2xl font-bold mb-4">Carrito de Compras</h2>
            <div id="carrito-contenido"></div>
            <div class="text-right mt-4">
                <button id="hacer-pedido" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Hacer Pedido</button>
                <button id="cerrar-carrito" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Minimizar</button>
            </div>
        </div>
    </div>
    <button id="ver-pedidos-btn" class="fixed bottom-20 left-5 z-50 bg-blue-500 text-white p-4 rounded-full shadow-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-50">
        Ver Pedidos
    </button>
    <div id="pedidos-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-3/4 max-w-3xl">
            <h2 class="text-2xl font-bold mb-4">Tus Pedidos</h2>
            <div id="pedidos-contenido"></div>
            <div class="text-right mt-4">
                <button id="cerrar-pedidos" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Cerrar</button>
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>