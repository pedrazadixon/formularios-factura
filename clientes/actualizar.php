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

    $sql = "UPDATE `clientes` SET `razon_social` = '" . $_POST["razon_social"] . "', `nit` = '" . $_POST["nit"] . "' 
            WHERE `id` = " . $_GET['id'];

    if ($conn->query($sql) === TRUE) {
        echo "El cliente se modifico correctamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$sql = "SELECT * FROM `clientes` WHERE `id` = " . $_GET['id'];
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $cliente = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $cliente = null;
}

$conn->close();

?>

<h2>Modificar Cliente</h2>
<hr>
<div style="width: 50%;">
    <form action="actualizar.php?id=<?php echo $_GET['id'] ?>" method="post">
        <fieldset>
            <legend>Datos del producto:</legend>
            NIT: <input name="nit" value="<?php echo $cliente[0]['nit'] ?>" type="text"><br>
            Razon Social: <input name="razon_social" value="<?php echo $cliente[0]['razon_social'] ?>" type="text"><br>
            <br>
            <a href="index.php"><button type="button"><< volver</button></a>
            <button type="submit">Guardar</button>
        </fieldset>
    </form>
</div>