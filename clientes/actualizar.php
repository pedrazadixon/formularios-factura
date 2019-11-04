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
            WHERE `id_cliente` = " . $_GET['id'];

    if ($conn->query($sql) === TRUE) {
        echo "El cliente se modifico correctamente";
    } else {
        // echo "Error: " . $sql . "<br>" . $conn->error;
        echo "Nit ya existente por favor vuelve a intentarlo";
    }
}

$sql = "SELECT * FROM `clientes` WHERE `id_cliente` = " . $_GET['id'];
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $cliente = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $cliente = null;
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
        <a href="<?php echo BASE_URL_ ?>clientes">Clientes</a>
    </li>
    <li class="breadcrumb-item active">Modificar Cliente</li>
</ol>

<h4>Modificar Cliente</h4>
<hr>

<form class="w-50" action="actualizar.php?id=<?php echo $_GET['id'] ?>" method="post">
    NIT: <input class="form-control" name="nit" value="<?php echo $cliente[0]['nit'] ?>" type="number" min="1" required>
    Razon Social: <input class="form-control" name="razon_social" value="<?php echo $cliente[0]['razon_social'] ?>" type="text" required>
    <hr>
    <a class="btn btn-danger mr-1" href="index.php">Cancelar</a>
    <button class="btn btn-success" type="submit"><span class="px-2">Guardar</span></button>
</form>

<?php require_once '../sitio/pie.php' ?>