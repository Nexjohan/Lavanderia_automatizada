window.addEventListener('message', (event) => {
    const usuario = event.data;
    document.getElementById('id').value = usuario.id;
    document.getElementById('nombre').value = usuario.nombre;
    document.getElementById('correo').value = usuario.correo;
    document.getElementById('password').value = usuario.password;
    document.getElementById('rol').value = usuario.rol;
});

async function actualizarUsuario(event) {
    event.preventDefault();
    
    const id = document.getElementById('id').value;
    const nombre = document.getElementById('nombre').value;
    const correo = document.getElementById('correo').value;
    const password = document.getElementById('password').value;
    const rol = document.getElementById('rol').value;

    const usuario = {
        id: id,
        nombre: nombre,
        correo: correo,
        password: password,
        rol: rol,
    };

    console.log(usuario);
  
    try {
        const response = await fetch('http://localhost/Lavanderia_automatizada/bussineslogic/swUser.php', {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(usuario)
        });
        window.close();
        
    } catch (error) {
        console.error('Error al actualizar usuario:', error);
    }
}
  
document.getElementById('actualizarUsuarioForm').addEventListener('submit', actualizarUsuario);
