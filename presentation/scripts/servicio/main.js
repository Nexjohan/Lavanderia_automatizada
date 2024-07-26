async function getServicios() {
    try {
        const response = await fetch('http://localhost/Lavanderia_automatizada/bussineslogic/swServicios.php');
        const data = await response.json();

        const servicios = data;

        const tableBody = document.querySelector('#table-servicio tbody');
        tableBody.innerHTML = '';
        let cont = 1;

        servicios.forEach(servicio => {
            // Create table row
            const row = document.createElement('tr');

            // Create cells for each servicio property
            const id = document.createElement('td');
            id.classList.add('py-3', 'px-6', 'text-left', 'whitespace-nowrap');
            id.textContent = cont;
            cont++;

            const nombre = document.createElement('td');
            nombre.classList.add('py-3', 'px-6', 'text-left', 'whitespace-nowrap');
            nombre.textContent = servicio.nombre;

            const descripcion = document.createElement('td');
            descripcion.classList.add('py-3', 'px-6', 'text-left', 'text-wrap');
            descripcion.textContent = servicio.descripcion;

            const precio = document.createElement('td');
            precio.classList.add('py-3', 'px-6', 'text-left', 'whitespace-nowrap');
            precio.textContent = servicio.precio;

            // Create action cell with icons
            const actionsCell = document.createElement('td');

            // Edit icon
            const editIcon = document.createElement('i');
            editIcon.classList.add('fas', 'fa-edit', 'text-blue-500', 'cursor-pointer', 'mr-2');
            editIcon.setAttribute('title', 'Editar');
            editIcon.addEventListener('click', () => openEditForm(servicio));

            // Delete icon
            const deleteIcon = document.createElement('i');
            deleteIcon.classList.add('fas', 'fa-trash-alt', 'text-red-500', 'cursor-pointer', 'mr-2');
            deleteIcon.setAttribute('title', 'Eliminar');
            deleteIcon.addEventListener('click', () => deleteServicio(servicio.id));

            // Photo icon
            const photoIcon = document.createElement('i');
            photoIcon.classList.add('fa-regular', 'fa-file-image', 'text-green-500', 'cursor-pointer');
            photoIcon.setAttribute('title', 'Foto de Servicio');
            photoIcon.addEventListener('click', () => showServicioPhoto(servicio.imagen));

            // Add icons to the action cell
            actionsCell.appendChild(editIcon);
            actionsCell.appendChild(deleteIcon);
            actionsCell.appendChild(photoIcon);

            // Add cells to row
            row.appendChild(id);
            row.appendChild(nombre);
            row.appendChild(descripcion);
            row.appendChild(precio);
            row.appendChild(actionsCell);

            // Add row to table
            tableBody.appendChild(row);
        });

    } catch (error) {
        console.error('Error al obtener servicios:', error);
    }
}

// Servicio delete function
async function deleteServicio(servicioId) {
    const confirmDelete = confirm('¿Estás seguro de que deseas eliminar este servicio?');
    if (confirmDelete) {
        try {
            const response = await fetch(`http://localhost/Lavanderia_automatizada/bussineslogic/swServicios.php?id=${servicioId}`, {
                method: 'DELETE'
            });
            if (response.ok) {
                getServicios();
            } else {
                alert('Error al eliminar el servicio');
            }
        } catch (error) {
            console.error('Error al eliminar el servicio:', error);
        }
    }
}

// Open Update form
function openEditForm(servicio) {
    const newWindow = window.open('../servicio/actualizarServicio.php', '_blank', 'width=600,height=600');

    newWindow.onload = function() {
        newWindow.postMessage(servicio, '*');
    };

    newWindow.onbeforeunload = function() {
        getServicios();
    };
}

// Show Photo
async function showServicioPhoto(imagen_servicio) {
    const imageUrl = "../../../bussineslogic/" + imagen_servicio;
    console.log(imageUrl);

    const newWindow = window.open('', '_blank', 'width=600,height=600');
    newWindow.document.write(`
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Foto de Servicio</title>
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
            <img src="${imageUrl}" alt="Foto de Servicio">
        </body>
        </html>
    `);
    newWindow.document.close();
}

document.addEventListener('DOMContentLoaded', getServicios);
