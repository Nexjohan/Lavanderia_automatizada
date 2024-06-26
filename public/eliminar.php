<?php
// Aquí deberías manejar la lógica para eliminar la categoría según el ID recibido por GET
if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Realizar la conexión a la base de datos y ejecutar la consulta DELETE
    // Ejemplo simplificado:
    // $query = "DELETE FROM categorias WHERE id = $id";
    // Ejecutar la consulta y manejar errores según tu lógica de PHP

    // Si se elimina correctamente, puedes devolver un mensaje de éxito
    echo 'Categoría eliminada correctamente.';
} else {
    // Manejar el caso en el que la solicitud no sea DELETE o no se envíe un ID válido
    echo 'Error al intentar eliminar la categoría.';
}
?>
