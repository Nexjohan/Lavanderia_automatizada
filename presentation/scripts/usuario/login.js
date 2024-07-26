document.getElementById('loginForm').addEventListener('submit', async (event) => {
    event.preventDefault();
    await loginUser();
});

async function loginUser() {
    const correo = document.getElementById('correo').value;
    const password = document.getElementById('password').value;

    if (!correo || !password) {
        Swal.fire({
            icon: 'warning',
            title: 'Campos incompletos',
            text: 'Por favor, complete todos los campos.',
        });
        return;
    }

    const formData = new FormData();
    formData.append('correo', correo);
    formData.append('password', password);

    try {
        const response = await fetch('http://localhost/Lavanderia_automatizada/bussineslogic/swLogin.php', {
            method: 'POST',
            body: formData
        });
        const data = await response.json();
        
        if (data.success) {
            const rol = data.user.rol;
            Swal.fire({
                icon: 'success',
                title: 'Login exitoso',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                if (rol === 'admin') {
                    window.location.href = '../../../presentation/pages/administrador/OptionsList.php';
                } else if (rol === 'user') {
                    window.location.href = '../../../presentation/pages/Pagina_Cliente/paginaCliente.php';
                }
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Credenciales incorrectas',
                text: 'El correo o la contraseña son incorrectos.',
            });
        }
    } catch (error) {
        console.error('Error al iniciar sesión:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Ocurrió un error al intentar iniciar sesión. Por favor, intente de nuevo más tarde.',
        });
    }
}

















/*
ESTO NO TIENE ALERTAS Y ES MAS CORTO
document.getElementById('loginForm').addEventListener('submit', async (event) => {
    event.preventDefault();
    await loginUser();
});

async function loginUser() {
    const correo = document.getElementById('correo').value;
    const password = document.getElementById('password').value;

    const formData = new FormData();
    formData.append('correo', correo);
    formData.append('password', password);

    try {
        const response = await fetch('http://localhost/Practica_Orientada_Eventos_PHP10/businessLogic/swUser.php', {
            method: 'POST',
            body: formData
        });
        const data = await response.json();
        
        if (data.success) {
            const rol = data.user.rol;
            if (rol === 'admin') {
                window.location.href = '../../../presentation/pages/admin/OptionsList.php';
            } else if (rol === 'user') {
                window.location.href = '../../../presentation/pages/categoria/addCategoria.php';
            }
        } else {
            alert('Credenciales incorrectas');
        }
    } catch (error) {
        console.error('Error al iniciar sesión:', error);
    }
}
*/