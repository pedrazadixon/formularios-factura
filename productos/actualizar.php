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
            WHERE `productos`.`id` = " . $_GET['id'];

    if ($conn->query($sql) === TRUE) {
        echo "El producto se modifico correctamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$sql = "SELECT * FROM `productos` WHERE `id` = " . $_GET['id'];
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $producto = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $producto = null;
}

$conn->close();

?>

<h2>Modificar Producto</h2>
<hr>
<div style="width: 50%;">
    <form action="actualizar.php?id=<?php echo $_GET['id'] ?>" method="post">
        <fieldset>
            <legend>Datos del producto:</legend>
            Nombre: <input name="descripcion" value="<?php echo $producto[0]['descripcion'] ?>" type="text"><br>
            Precio: <input name="precio" value="<?php echo $producto[0]['precio'] ?>" type="number"><br>
            Cantidad: <input name="cantidad" value="<?php echo $producto[0]['cantidad'] ?>" type="number"><br>
            <br>
            <a href="index.php"><button type="button"><< volver</button></a>
            <button type="submit">Guardar</button>
        </fieldset>
    </form>
</div>