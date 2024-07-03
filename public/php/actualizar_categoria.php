<?php
// Conexión a la base de datos
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "lavanderia_automatizada";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $imagen = '';

    // Manejo de la subida de imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        $uploadFile = $uploadDir . basename($_FILES['imagen']['name']);
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $uploadFile)) {
            $imagen = $uploadFile;

            // Actualizar la imagen en la base de datos si se ha subido una nueva imagen
            $sqlImagen = "UPDATE categorias SET imagen=? WHERE id=?";
            $stmtImagen = $conn->prepare($sqlImagen);
            $stmtImagen->bind_param("si", $imagen, $id);
            $stmtImagen->execute();
            $stmtImagen->close();
        } else {
            echo "Error al subir la imagen.";
        }
    }

    // Actualizar la categoría en la base de datos
    $sql = "UPDATE categorias SET nombre=?, descripcion=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $nombre, $descripcion, $id);

    if ($stmt->execute()) {
        echo
        header("Location: visualizar_categorias.php?id=" . $id);
    } else {
        echo "Error al actualizar la categoría: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
