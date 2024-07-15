window.addEventListener('message', (event) => {
    const categoria = event.data;
    document.getElementById('id').value = categoria.id;
    document.getElementById('nombre').value = categoria.nombre;
    document.getElementById('descripcion').value = categoria.descripcion;
    document.getElementById('imagen').value = categoria.imagen;
  });
  
  async function actualizarCategoria(event) {
    event.preventDefault();
    
    const id = document.getElementById('id').value;
    const nombre = document.getElementById('nombre').value;
    const descripcion = document.getElementById('descripcion').value;
    const imagen = document.getElementById('imagen').value;

    const categoria = {
        id: id,
        nombre: nombre,
        descripcion: descripcion,
        imagen: imagen
    };

    console.log(categoria)
  
    try {
        const response = await fetch('http://localhost/Lavanderia_automatizada/bussineslogic/swCategorias.php', {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(categoria)
        });
        window.close();
        
    } catch (error) {
        console.error('Error al actualizar usuario:', error);
    }
}
  
  document.getElementById('actualizarCategoriaForm').addEventListener('submit', actualizarCategoria);