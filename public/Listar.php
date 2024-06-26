<?php
include 'conexion.php';

$sql = "SELECT * FROM categorias";
$result = $conn->query($sql);

$categorias = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $categorias[] = $row;
    }
}

echo json_encode($categorias);

$conn->close();
?>
<?php
include 'conexion.php';

$sql = "SELECT * FROM categorias";
$result = $conn->query($sql);

$categorias = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $categorias[] = $row;
    }
}

echo json_encode($categorias);

$conn->close();
?>
