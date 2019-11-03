<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "formularios-factura";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("conexion fallida: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $sql = "UPDATE `productos` SET `descripcion` = '" . $_POST["descripcion"] . "', `precio` = '" . $_POST["precio"] . "', `cantidad` = '" . $_POST["cantidad"] . "' 
            WHERE `productos`.`id_producto` = " . $_GET['id'];

    if ($conn->query($sql) === TRUE) {
        echo "El producto se modifico correctamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$sql = "SELECT * FROM `productos` WHERE `id_producto` = " . $_GET['id'];
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $producto = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $producto = null;
}

$conn->close();
?>

<?php require_once '../sitio/cabecera.php' ?>

<!-- Ruta-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="<?php echo BASE_URL_ ?>">Facturas UCC</a>
    </li>
    <li class="breadcrumb-item">
        <a href="<?php echo BASE_URL_ ?>productos">Productos</a>
    </li>
    <li class="breadcrumb-item active">Modificar producto</li>
</ol>

<h4>Modificar producto</h4>
<hr>

<div class="form-group w-50">
    <form action="actualizar.php?id=<?php echo $_GET['id'] ?>" method="post">
        Nombre del producto: <input class="form-control" required name="descripcion" value="<?php echo $producto[0]['descripcion'] ?>" type="text">
        Precio: <input class="form-control" required name="precio" value="<?php echo $producto[0]['precio'] ?>" type="number">
        Cantidad: <input class="form-control" required name="cantidad" value="<?php echo $producto[0]['cantidad'] ?>" type="number">
        <hr>
        <a class="btn btn-danger" href="index.php">Cancelar</a> <button class="btn btn-success " type="submit"><span class="px-2">Guardar</span></button>
    </form>
</div>

<?php require_once '../sitio/pie.php' ?>