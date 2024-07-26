document.addEventListener('DOMContentLoaded', async () => {
    const serviciosContainer = document.getElementById('servicios-container');
    const carritoBtn = document.getElementById('carrito-btn');
    const carritoModal = document.getElementById('carrito-modal');
    const cerrarCarritoBtn = document.getElementById('cerrar-carrito');
    const hacerPedidoBtn = document.getElementById('hacer-pedido');
    const carritoContenido = document.getElementById('carrito-contenido');
    const verPedidosBtn = document.getElementById('ver-pedidos-btn');
    const pedidosModal = document.getElementById('pedidos-modal');
    const cerrarPedidosBtn = document.getElementById('cerrar-pedidos');
    const pedidosContenido = document.getElementById('pedidos-contenido');
    let carrito = [];

    carritoBtn.addEventListener('click', () => {
        carritoModal.classList.remove('hidden');
        renderCarrito();
    });

    cerrarCarritoBtn.addEventListener('click', () => {
        carritoModal.classList.add('hidden');
    });

    hacerPedidoBtn.addEventListener('click', async () => {
        await hacerPedido();
    });

    verPedidosBtn.addEventListener('click', async () => {
        pedidosModal.classList.remove('hidden');
        await getPedidos();
    });

    cerrarPedidosBtn.addEventListener('click', () => {
        pedidosModal.classList.add('hidden');
    });

    async function getServicios() {
        try {
            const response = await axios.get('http://localhost/Lavanderia_automatizada/bussineslogic/swServicios.php');
            const servicios = response.data;

            servicios.forEach(servicio => {
                const servicioCard = document.createElement('div');
                servicioCard.classList.add('bg-white', 'rounded-lg', 'shadow-lg', 'p-6');

                servicioCard.innerHTML = `
                    <h3 class="text-2xl font-bold mb-2">${servicio.nombre}</h3>
                    <p class="text-gray-700">${servicio.descripcion}</p>
                    <p class="text-gray-700 font-bold">Precio: $${servicio.precio}</p>
 . :                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded agregar-carrito" data-id="${servicio.id}" data-nombre="${servicio.nombre}" data-precio="${servicio.precio}">Añadir al Carrito</button>
                `;

                serviciosContainer.appendChild(servicioCard);
            });

            document.querySelectorAll('.agregar-carrito').forEach(button => {
                button.addEventListener('click', () => {
                    const servicioId = button.getAttribute('data-id');
                    const servicioNombre = button.getAttribute('data-nombre');
                    const servicioPrecio = button.getAttribute('data-precio');
                    addToCarrito(servicioId, servicioNombre, servicioPrecio);
                });
            });
        } catch (error) {
            console.error('Error al obtener servicios:', error);
        }
    }

    function addToCarrito(servicioId, servicioNombre, servicioPrecio) {
        const servicio = carrito.find(item => item.id === servicioId);
        if (servicio) {
            servicio.cantidad++;
        } else {
            carrito.push({ id: servicioId, nombre: servicioNombre, precio: servicioPrecio, cantidad: 1 });
        }
        renderCarrito();
    }

    function renderCarrito() {
        carritoContenido.innerHTML = '';
        let total = 0;
        carrito.forEach(item => {
            total += item.cantidad * item.precio;
            const servicioElement = document.createElement('div');
            servicioElement.classList.add('flex', 'justify-between', 'items-center', 'mb-4');
            servicioElement.innerHTML = `
                <span>${item.nombre} - $${item.precio}</span>
                <div class="flex items-center space-x-2">
                    <input type="number" value="${item.cantidad}" class="cantidad-servicio w-12 text-center" data-id="${item.id}">
                    <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded eliminar-servicio" data-id="${item.id}">Eliminar</button>
                </div>
            `;

            carritoContenido.appendChild(servicioElement);
        });

        const totalElement = document.createElement('div');
        totalElement.classList.add('text-right', 'font-bold', 'text-xl', 'mt-4');
        totalElement.innerText = `Total: $${total.toFixed(2)}`;
        carritoContenido.appendChild(totalElement);

        document.querySelectorAll('.cantidad-servicio').forEach(input => {
            input.addEventListener('change', (event) => {
                const servicioId = input.getAttribute('data-id');
                const nuevaCantidad = parseInt(event.target.value, 10);
                updateCantidad(servicioId, nuevaCantidad);
            });
        });

        document.querySelectorAll('.eliminar-servicio').forEach(button => {
            button.addEventListener('click', () => {
                const servicioId = button.getAttribute('data-id');
                removeFromCarrito(servicioId);
            });
        });
    }

    function updateCantidad(servicioId, nuevaCantidad) {
        const servicio = carrito.find(item => item.id === servicioId);
        if (servicio) {
            if (nuevaCantidad <= 0) {
                removeFromCarrito(servicioId);
            } else {
                servicio.cantidad = nuevaCantidad;
                renderCarrito();
            }
        }
    }

    function removeFromCarrito(servicioId) {
        carrito = carrito.filter(item => item.id !== servicioId);
        renderCarrito();
    }

    async function hacerPedido() {
        const usuarioId = 1; // Reemplaza con el ID del usuario actual
        const total = carrito.reduce((sum, item) => sum + item.cantidad * item.precio, 0);

        try {
            const response = await axios.post('http://localhost/Lavanderia_automatizada/bussineslogic/swPedidos.php', {
                usuario_id: usuarioId,
                total: total,
                detalles: carrito
            });

            if (response.data.success) {
                alert('Pedido realizado con éxito');
                carrito = [];
                renderCarrito();
                carritoModal.classList.add('hidden');
            } else {
                alert('Hubo un error al realizar el pedido');
            }
        } catch (error) {
            console.error('Error al realizar el pedido:', error);
        }
    }

    async function getPedidos(usuarioId) {
         // Reemplaza con el ID del usuario actual

        try {
            const response = await axios.get(`http://localhost/Lavanderia_automatizada/bussineslogic/swPedidos.php?usuario_id=${usuarioId}`);  
            const pedidos = response.data;

            if (!Array.isArray(pedidos)) {
                console.error('Error: La respuesta no es un array');
                return;
            }

            pedidosContenido.innerHTML = '';
            pedidos.forEach(pedido => {
                const pedidoElement = document.createElement('div');
                pedidoElement.classList.add('bg-white', 'rounded-lg', 'shadow-lg', 'p-6', 'mb-4');
                pedidoElement.innerHTML = `
                    <h3 class="text-2xl font-bold mb-2">Pedido #${pedido.id} - Total: $${pedido.total}</h3>
                    <p class="text-gray-700">Fecha: ${pedido.fecha}</p>
                    <div class="mt-4">
                        ${pedido.detalles.map(detalle => `
                            <p>${detalle.nombre} - Cantidad: ${detalle.cantidad} - Precio: $${detalle.precio}</p>
                        `).join('')}
                    </div>
                `;
                pedidosContenido.appendChild(pedidoElement);
            });
        } catch (error) {
            console.error('Error al obtener pedidos:', error);
        }
    }

    await getServicios();
});
