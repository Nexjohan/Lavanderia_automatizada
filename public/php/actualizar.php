<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    // Realiza la conexión a la base de datos
    $conexion = new mysqli('localhost', 'usuario', 'contraseña', 'base_de_datos');

    // Verifica la conexión
    if ($conexion->connect_error) {
        die('Conexión fallida: ' . $conexion->connect_error);
    }

    // Actualiza la categoría
    $stmt = $conexion->prepare('UPDATE categorias SET nombre = ?, descripcion = ? WHERE id = ?');
    $stmt->bind_param('ssi', $nombre, $descripcion, $id);

    if ($stmt->execute()) {
        echo 'Categoría actualizada exitosamente.';
    } else {
        echo 'Error al actualizar la categoría.';
    }

    $stmt->close();
    $conexion->close();
}
?>
