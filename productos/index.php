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

<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <title>Facturas</title>
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css" crossorigin="anonymous">
</head>

<div class="container">

<div class="my-4 text-center">
<h2>Productos</h2>
<a class="btn btn-primary mt-5 " href="crear.php"> Nuevo Producto</a>
</div>

<?php if(empty($productos)): ?>
    <p>Aún no hay productos registrados.</p>
<?php else: ?>
<div class="row col-md-12 d-flex justify-content-center align-items-center">
    <table class="col-md-8 " border="0">
        <tr>
            <th>Id</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Acciones</th>
        </tr>

        <?php foreach ($productos as $key => $producto) : ?>
            <tr>
                <td><?php echo $producto['id_producto'] ?></td>
                <td><?php echo $producto['descripcion'] ?></td>
                <td><?php echo $producto['precio'] ?></td>
                <td><?php echo $producto['cantidad'] ?></td>
                <td>
                    <a class="btn btn-primary " href="actualizar.php?id=<?php echo $producto['id_producto'] ?>">Modificar</a>
                    <a class="btn btn-primary " href="borrar.php?id=<?php echo $producto['id_producto'] ?>" onclick="return confirm('Estas seguro?')">
                       Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>

    </table>

</div>
<div class="my-4 text-center">
<a class="btn btn-primary" href="../">Volver</a>
</div>

<?php endif; ?>



</div>