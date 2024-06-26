<?php
// Conexión a la base de datos (ejemplo)
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "lavanderia_automatizada";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener todas las categorías
$sql = "SELECT nombre, descripcion, fecha_hora FROM categorias";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Salida de datos de cada fila
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td class='px-6 py-4 whitespace-nowrap text-sm text-gray-900'>" . $row["nombre"] . "</td>";
        echo "<td class='px-6 py-4 whitespace-nowrap text-sm text-gray-900'>" . $row["descripcion"] . "</td>";
        echo "<td class='px-6 py-4 whitespace-nowrap text-sm text-gray-900'>" . $row["fecha_hora"] . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='3' class='px-6 py-4 whitespace-nowrap text-sm text-gray-500'>No hay categorías registradas.</td></tr>";
}
$conn->close();
?>