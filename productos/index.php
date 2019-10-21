<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "formularios-factura";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    exit("Conexion fallida: " . $conn->connect_error);
}

$sql = "SELECT * FROM `productos`";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $productos = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $productos = null;
}
$conn->close();

?>

<h2>Productos</h2>
<hr>
<a href="crear.php">Nuevo Producto</a>
<hr>

<table border="1">
    <tr>
        <th>Id</th>
        <th>Descripción</th>
        <th>Precio</th>
        <th>Cantidad</th>
        <th>Acciones</th>
    </tr>

    <?php foreach ($productos as $key => $producto) : ?>
        <tr>
            <td><?php echo $producto['id'] ?></td>
            <td><?php echo $producto['descripcion'] ?></td>
            <td><?php echo $producto['precio'] ?></td>
            <td><?php echo $producto['cantidad'] ?></td>
            <td>
                <a href="">Eliminar</a>
                <br>
                <a href="">Modificar</a>
            </td>
        </tr>
    <?php endforeach; ?>

</table>