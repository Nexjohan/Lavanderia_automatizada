async function getPedidos() {
    try {
        const response = await fetch('http://localhost/Lavanderia_automatizada/bussineslogic/swPedidos.php');
        const data = await response.json();

        const pedidos = data;

        const tableBody = document.querySelector('#table-pedido tbody');
        tableBody.innerHTML = '';
        let cont = 1;

        pedidos.forEach(pedido => {
            // Create table row
            const row = document.createElement('tr');

            // Create cells for each pedido property
            const id = document.createElement('td');
            id.classList.add('py-3', 'px-6', 'text-left', 'whitespace-nowrap');
            id.textContent = cont;
            cont++;

            const nombre = document.createElement('td');
            nombre.classList.add('py-3', 'px-6', 'text-left', 'whitespace-nowrap');
            nombre.textContent = pedido.nombre;

            const descripcion = document.createElement('td');
            descripcion.classList.add('py-3', 'px-6', 'text-left', 'text-wrap');
            descripcion.textContent = pedido.descripcion;

            // Create action cell with icons
            const actionsCell = document.createElement('td');

            // Edit icon
            const editIcon = document.createElement('i');
            editIcon.classList.add('fas', 'fa-edit', 'text-blue-500', 'cursor-pointer', 'mr-2');
            editIcon.setAttribute('title', 'Editar');
            editIcon.addEventListener('click', () => openEditForm(pedido));

            // Delete icon
            const deleteIcon = document.createElement('i');
            deleteIcon.classList.add('fas', 'fa-trash-alt', 'text-red-500', 'cursor-pointer', 'mr-2');
            deleteIcon.setAttribute('title', 'Eliminar');
            deleteIcon.addEventListener('click', () => deletePedido(pedido.id));

            // Photo icon
            const photoIcon = document.createElement('i');
            photoIcon.classList.add('fa-regular', 'fa-file-image', 'text-green-500', 'cursor-pointer');
            photoIcon.setAttribute('title', 'Foto del Pedido');
            photoIcon.addEventListener('click', () => showPedidoPhoto(pedido.imagen));

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
        console.error('Error al obtener pedidos:', error);
    }
}

// Pedido delete function
async function deletePedido(pedidoId) {
    const confirmDelete = confirm('¿Estás seguro de que deseas eliminar este pedido?');
    if (confirmDelete) {
        try {
            const response = await fetch(`http://localhost/Lavanderia_automatizada/bussineslogic/swPedidos.php?id=${pedidoId}`, {
                method: 'DELETE'
            });
            if (response.ok) {
                getPedidos();
            } else {
                alert('Error al eliminar el pedido');
            }
        } catch (error) {
            console.error('Error al eliminar el pedido:', error);
        }
    }
}

// Open Update form
function openEditForm(pedido) {
    const newWindow = window.open('../pedido/actualizarPedido.php', '_blank', 'width=600,height=600');

    newWindow.onload = function() {
        newWindow.postMessage(pedido, '*');
    };

    newWindow.onbeforeunload = function() {
        getPedidos();
    };
}

// Show Photo
async function showPedidoPhoto(imagen_pedido) {
    const imageUrl = "../../../bussineslogic/" + imagen_pedido;
    console.log(imageUrl);

    const newWindow = window.open('', '_blank', 'width=600,height=600');
    newWindow.document.write(`
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Foto del Pedido</title>
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
            <img src="${imageUrl}" alt="Foto del Pedido">
        </body>
        </html>
    `);
    newWindow.document.close();
}

document.addEventListener('DOMContentLoaded', getPedidos);
