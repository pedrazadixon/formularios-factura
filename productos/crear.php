<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

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

    $sql = "INSERT INTO productos (id_producto, descripcion, precio, cantidad) VALUES (NULL, '" . $_POST["descripcion"] . "', '" . $_POST["precio"] . "', '" . $_POST["cantidad"] . "')";

    if ($conn->query($sql) === TRUE) {
        header('Location: index.php');
        die();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

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
    <li class="breadcrumb-item active">Crear producto</li>
</ol>

<h4>Crear producto</h4>
<hr>

<div class="form-group w-50">
    <form form-signin action="crear.php" method="post">
        Nombre del producto: <input required class="form-control" name="descripcion" type="text">
        Precio: <input required class="form-control" name="precio" type="number">
        Cantidad: <input required class="form-control" name="cantidad" type="number">
        <hr>
        <a class="btn btn-danger mr-1" href="index.php">Cancelar</a>
        <button class="btn btn-success " type="submit"><span class="px-2">Guardar</span></button>
    </form>
</div>

<?php require_once '../sitio/pie.php' ?>