
console.log("Hola")
const categoriaForm = document.getElementById('usuarioForm');
categoriaForm.addEventListener('submit', (event) => {
    event.preventDefault();
    agregarUsuario(event);
    });

async function agregarUsuario(event) {
    const nombre = document.getElementById('nombre').value;
    const correo = document.getElementById('correo').value;
    const password = document.getElementById('password').value;
    const rol = document.getElementById('rol').value;


    const formData = new FormData();
    formData.append('nombre', nombre);
    formData.append('correo', correo);
    formData.append('password', password);
    formData.append('rol', rol);

    console.log(formData);
    try {
        const response = await fetch('http://localhost/Lavanderia_automatizada/bussineslogic/swUser.php', {
            method: 'POST',
            body: formData
        });
    } catch (error) {
        console.error('Error al registrar usuario:', error);
    }
}
