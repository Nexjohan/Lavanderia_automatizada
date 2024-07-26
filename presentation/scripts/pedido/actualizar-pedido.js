window.addEventListener('message', (event) => {
    const pedido = event.data;
    document.getElementById('id').value = pedido.id;
    document.getElementById('nombre').value = pedido.nombre;
    document.getElementById('descripcion').value = pedido.descripcion;
    document.getElementById('categoria_id').value = pedido.categoria_id;
    document.getElementById('precio').value = pedido.precio;
    document.getElementById('imagen').value = pedido.imagen;
});

async function actualizarPedido(event) {
    event.preventDefault();
    
    const id = document.getElementById('id').value;
    const nombre = document.getElementById('nombre').value;
    const descripcion = document.getElementById('descripcion').value;
    const categoria_id = document.getElementById('categoria_id').value;
    const precio = document.getElementById('precio').value;
    const imagen = document.getElementById('imagen').value;

    const pedido = {
        id: id,
        nombre: nombre,
        descripcion: descripcion,
        categoria_id: categoria_id,
        precio: precio,
        imagen: imagen
    };

    console.log(pedido);
  
    try {
        const response = await fetch('http://localhost/Lavanderia_automatizada/bussineslogic/swPedidos.php', {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(pedido)
        });
        window.close();
        
    } catch (error) {
        console.error('Error al actualizar pedido:', error);
    }
}

// Para que detecte la id de la categoría
document.addEventListener("DOMContentLoaded", function() {
    fetch('http://localhost/Lavanderia_automatizada/bussineslogic/swCategorias.php')
        .then(response => response.json())
        .then(data => {
            const categoriaSelect = document.getElementById('categoria_id');
            data.forEach(categoria => {
                const option = document.createElement('option');
                option.value = categoria.id;
                option.textContent = categoria.nombre;
                categoriaSelect.appendChild(option);
            });
        })
        .catch(error => console.error('Error al cargar categorías:', error));
});

document.getElementById('actualizarPedidoForm').addEventListener('submit', actualizarPedido);
