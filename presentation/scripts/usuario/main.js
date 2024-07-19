console.log("hOLAS")
async function getUsuarios() {
    try {
      const response = await fetch('http://localhost/Lavanderia_automatizada/bussineslogic/swUser.php');
      const data = await response.json();
  
      const usuarios = data;
  
      const tableBody = document.querySelector('#table-categoria tbody');
      tableBody.innerHTML = '';
      let cont=1
  
      usuarios.forEach(usuarios => {
       
        // Create table row
        const row = document.createElement('tr');
  
        // Create cells for each categoria property
        const id = document.createElement('td');
        id.classList.add('py-3', 'px-6', 'text-left', 'whitespace-nowrap');
        id.textContent = cont;
        cont++;
  
        const nombre = document.createElement('td');
        nombre.classList.add('py-3', 'px-6', 'text-left', 'whitespace-nowrap');
        nombre.textContent = usuarios.nombre;
  
        const correo = document.createElement('td');
        correo.classList.add('py-3', 'px-6', 'text-left', 'text-wrap');
        correo.textContent = usuarios.correo;

        const password = document.createElement('td');
        password.classList.add('py-3', 'px-6', 'text-left', 'text-wrap');
        password.textContent = usuarios.password;

        const rol = document.createElement('td');
        rol.classList.add('py-3', 'px-6', 'text-left', 'text-wrap');
        rol.textContent = usuarios.rol;
  
        // Create action cell with icons
        const actionsCell = document.createElement('td');
  
        // edit icon
        const editIcon = document.createElement('i');
        editIcon.classList.add('fas', 'fa-edit', 'text-blue-500', 'cursor-pointer', 'mr-2');
        editIcon.setAttribute('title', 'Editar');
        editIcon.addEventListener('click', () => openEditForm(usuarios));
  
        // delete icon
        const deleteIcon = document.createElement('i');
        deleteIcon.classList.add('fas', 'fa-trash-alt', 'text-red-500', 'cursor-pointer', 'mr-2');
        deleteIcon.setAttribute('title', 'Eliminar');
        deleteIcon.addEventListener('click', () => deleteUsuario(usuarios.id));
  
        // Add icons to the action cell
        actionsCell.appendChild(editIcon);
        actionsCell.appendChild(deleteIcon);
   
  
        // Add cells to row
        row.appendChild(id);
        row.appendChild(nombre);
        row.appendChild(correo);
        row.appendChild(password);
        row.appendChild(rol);
        row.appendChild(actionsCell);
  
        // Add row to table
        tableBody.appendChild(row);
      });
  
    } catch (error) {
      console.error('Error al obtener categorias:', error);
    }
  }
  
  // categoria delete function
  async function deleteUsuario(usuariosId) {
    const confirmDelete = confirm('¿Estás seguro de que deseas eliminar este usuario?');
    if (confirmDelete) {
      try {
        const response = await fetch(`http://localhost/Lavanderia_automatizada/bussineslogic/swUser.php?id=${usuariosId}`, {
          method: 'DELETE'
        });
        getusuarios();
      } catch (error) {
        console.error('Error al eliminar el usuario:', error);
      }
    }
  }
  
  //Open Update form
  
  function openEditForm(usuarios) {
    const newWindow = window.open('../usuario/actualizarUsuario.php', '_blank', 'width=600,height=600');
  
    newWindow.onload = function() {
      newWindow.postMessage(usuarios, '*');


      
    };
  
    newWindow.onbeforeunload = function() {
      getCategorias();
    };
  }
  
  //Show Password
  
  async function showUserPhotos(imagen_categoria) {
    
    const imageUrl ="../../../bussineslogic/"+imagen_categoria;
    console.log(imageUrl)
  
    const newWindow = window.open('', '_blank', 'width=600,height=600');
    newWindow.document.write(`
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta nombre="viewport" content="width=device-width, initial-scale=1.0">
            <title>Foto de Categoria</title>
            <style>
                body {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                    margin: 0;
                    background-color: #f0f0f0;
                }
                img {
                    max-width: 100%;
                    max-height: 100%;
                }
            </style>
        </head>
        <body>
            <img src="${imageUrl}" alt="Foto de Categoria">
        </body>
        </html>
    `);
    newWindow.document.close();
  }
  
  document.addEventListener('DOMContentLoaded', getUsuarios());