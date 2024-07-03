<?php
// Conexión a la base de datos
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "lavanderia_automatizada";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
  die("Conexión fallida: " . $conn->connect_error);
}

// Consulta SQL para obtener todos los servicios
$sql = "SELECT id, nombre, descripcion, fecha_hora, precio FROM servicios";
$result = $conn->query($sql);

// Mostrar resultados en una tabla
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td class='py-2 px-4'>" . $row["id"] . "</td>";
    echo "<td class='py-2 px-4'>" . $row["nombre"] . "</td>";
    echo "<td class='py-2 px-4'>" . $row["descripcion"] . "</td>";
    echo "<td class='py-2 px-4'>" . $row["fecha_hora"] . "</td>";
    echo "<td class='py-2 px-4'>" . $row["precio"] . "</td>";
    echo "</tr>";
  }
} else {
  echo "<tr><td colspan='5'>No se encontraron servicios registrados</td></tr>";
}

// Cerrar conexión
$conn->close();
?>
