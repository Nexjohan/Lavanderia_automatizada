window.addEventListener('message', (event) => {
    const servicio = event.data;
    document.getElementById('id').value = servicio.id;
    document.getElementById('nombre').value = servicio.nombre;
    document.getElementById('descripcion').value = servicio.descripcion;
    document.getElementById('categoria_id').value = servicio.categoria_id;
    document.getElementById('precio').value = servicio.precio;
    document.getElementById('imagen').value = servicio.imagen;


  });
  
  async function actualizarServicio(event) {
    event.preventDefault();
    
    const id = document.getElementById('id').value;
    const nombre = document.getElementById('nombre').value;
    const descripcion = document.getElementById('descripcion').value;
    const categoria_id = document.getElementById('categoria_id').value;
    const precio = document.getElementById('precio').value;
    const imagen = document.getElementById('imagen').value;



    const servicio = {
        id: id,
        nombre: nombre,
        descripcion: descripcion,
        categoria_id:categoria_id,
        precio: precio,
        imagen: imagen
    };

    console.log(servicio)
  
    try {
        const response = await fetch('http://localhost/Lavanderia_automatizada/bussineslogic/swServicios.php', {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(servicio)
        });
        window.close();
        
    } catch (error) {
        console.error('Error al actualizar servicio:', error);
    }
}
  //Para que detecte la id de la categoria
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
  document.getElementById('actualizarServicioForm').addEventListener('submit', actualizarServicio);