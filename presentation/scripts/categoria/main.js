async function getCategorias() {
    try {
      const response = await fetch('http://localhost/Lavanderia_automatizada/bussineslogic/swCategorias.php');
      const data = await response.json();
  
      const categorias = data;
  
      const tableBody = document.querySelector('#table-categoria tbody');
      tableBody.innerHTML = '';
      let cont=1
  
      categorias.forEach(categoria => {
       
        // Create table row
        const row = document.createElement('tr');
  
        // Create cells for each categoria property
        const id = document.createElement('td');
        id.classList.add('py-3', 'px-6', 'text-left', 'whitespace-nowrap');
        id.textContent = cont;
        cont++;
  
        const nombre = document.createElement('td');
        nombre.classList.add('py-3', 'px-6', 'text-left', 'whitespace-nowrap');
        nombre.textContent = categoria.nombre;
  
        const descripcion = document.createElement('td');
        descripcion.classList.add('py-3', 'px-6', 'text-left', 'text-wrap');
        descripcion.textContent = categoria.descripcion;
  
        // Create action cell with icons
        const actionsCell = document.createElement('td');
  
        // edit icon
        const editIcon = document.createElement('i');
        editIcon.classList.add('fas', 'fa-edit', 'text-blue-500', 'cursor-pointer', 'mr-2');
        editIcon.setAttribute('title', 'Editar');
        editIcon.addEventListener('click', () => openEditForm(categoria));
  
        // delete icon
        const deleteIcon = document.createElement('i');
        deleteIcon.classList.add('fas', 'fa-trash-alt', 'text-red-500', 'cursor-pointer', 'mr-2');
        deleteIcon.setAttribute('title', 'Eliminar');
        deleteIcon.addEventListener('click', () => deleteCategoria(categoria.id));
  
        // Photo icon
        const photoIcon = document.createElement('i');
        photoIcon.classList.add('fa-regular', 'fa-file-image', 'text-green-500', 'cursor-pointer');
        photoIcon.setAttribute('title', 'Foto de Categoria');
        photoIcon.addEventListener('click', () => showUserPhotos(categoria.imagen));
  
        // Add icons to the action cell
        actionsCell.appendChild(editIcon);
        actionsCell.appendChild(deleteIcon);
        actionsCell.appendChild(photoIcon);
  
        // Add cells to row
        row.appendChild(id);
        row.appendChild(nombre);
        row.appendChild(descripcion);
        row.appendChild(actionsCell);
  
        // Add row to table
        tableBody.appendChild(row);
      });
  
    } catch (error) {
      console.error('Error al obtener categorias:', error);
    }
  }
  
  // categoria delete function
  async function deleteCategoria(categoriaId) {
    const confirmDelete = confirm('¿Estás seguro de que deseas eliminar este categoria?');
    if (confirmDelete) {
      try {
        const response = await fetch(`http://localhost/Lavanderia_automatizada/bussineslogic/swCategorias.php?id=${categoriaId}`, {
          method: 'DELETE'
        });
        getCategorias();
      } catch (error) {
        console.error('Error al eliminar el categoria:', error);
      }
    }
  }
  
  //Open Update form
  
  function openEditForm(categoria) {
    const newWindow = window.open('../categoria/actualizarCategoria.php', '_blank', 'width=600,height=600');
  
    newWindow.onload = function() {
      newWindow.postMessage(categoria, '*');
    };
  
    newWindow.onbeforeunload = function() {
      getCategorias();
    };
  }
  
  //Show Photo
  
  async function showUserPhotos(imagen) {
    
    const imageUrl ="../../../businessLogic/"+imagen;
  
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
  
  document.addEventListener('DOMContentLoaded', getCategorias);