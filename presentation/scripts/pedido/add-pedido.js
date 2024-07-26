const pedidoForm = document.getElementById('pedidoForm');
pedidoForm.addEventListener('submit', (event) => {
    event.preventDefault();
    agregarPedido(event);
});

// Crea una función nueva, no tiene que ver con el back
async function agregarPedido(event) {
    const nombre = document.getElementById('nombre').value;
    const descripcion = document.getElementById('descripcion').value;
    const categoria_id = document.getElementById('categoria_id').value;
    const precio = document.getElementById('precio').value;
    const imagen = document.getElementById('imagen');

    const file = imagen.files[0];
    // Setear para que funcione
    const formData = new FormData();
    formData.append('nombre', nombre);
    formData.append('descripcion', descripcion);
    formData.append('categoria_id', categoria_id);
    formData.append('precio', precio);
    formData.append('imagen', file);

    console.log(formData);
    console.log(file);

    // Le ponemos el link y detecta el post y el formData es creado en la función reciente
    try {
        const response = await fetch('http://localhost/Lavanderia_automatizada/bussineslogic/swPedidos.php', {
            method: 'POST',
            body: formData
        });
        document.getElementById('pedidoForm').reset(); // Resetear el formulario

    } catch (error) {
        console.error('Error al registrar pedido:', error);
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
