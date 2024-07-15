
const categoriaForm = document.getElementById('categoriaForm');
categoriaForm.addEventListener('submit', (event) => {
    event.preventDefault();
    agregarCategoria(event);
    });

async function agregarCategoria(event) {
    const nombre = document.getElementById('nombre').value;
    const descripcion = document.getElementById('descripcion').value;
    const imagen = document.getElementById('imagen');

    const file = imagen.files[0];

    const formData = new FormData();
    formData.append('nombre', nombre);
    formData.append('descripcion', descripcion);
    formData.append('imagen', file);

    console.log(formData);
    try {
        const response = await fetch('http://localhost/Lavanderia_automatizada/bussineslogic/swCategorias.php', {
            method: 'POST',
            body: formData
        });
    } catch (error) {
        console.error('Error al registrar categoría:', error);
    }
}
