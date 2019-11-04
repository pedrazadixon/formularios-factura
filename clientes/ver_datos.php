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

$sql = "SELECT * FROM `clientes` WHERE `id_cliente` = " . $_GET['id'];
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $cliente = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $cliente = null;
}

$sql = "SELECT * FROM `clientes_datos` WHERE `cliente_id` = " . $_GET['id'] . " AND `tipo` = 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $emails = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $emails = null;
}

$sql = "SELECT * FROM `clientes_datos` WHERE `cliente_id` = " . $_GET['id'] . " AND `tipo` = 2";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $telefonos = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $telefonos = null;
}

$sql = "SELECT * FROM `clientes_datos` WHERE `cliente_id` = " . $_GET['id'] . " AND `tipo` = 3";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $direcciones = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $direcciones = null;
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
    <li class="breadcrumb-item active">Ver Cliente</li>
</ol>

<h4>Ver Cliente</h4>
<hr>

<div class="container">
    <table class="table w-75">
        <tbody>
            <tr>
                <th scope="row">Nit: </th>
                <td><?php echo $cliente[0]['nit'] ?></td>
            </tr>
            <tr>
                <th scope="row">Razon Social: </th>
                <td><?php echo $cliente[0]['razon_social'] ?></td>
            </tr>
            <?php for ($i = 0; $i < @count($direcciones); $i++) : ?>
                <tr>
                    <th scope="row">Direccion <?php echo $i + 1 ?>: </th>
                    <td><?php echo $direcciones[$i]['dato'] ?></td>
                </tr>
            <?php endfor ?>
            <?php for ($i = 0; $i < @count($telefonos); $i++) : ?>
                <tr>
                    <th scope="row">Telefono <?php echo $i + 1 ?>: </th>
                    <td><?php echo $telefonos[$i]['dato'] ?></td>
                </tr>
            <?php endfor ?>
            <?php for ($i = 0; $i < @count($emails); $i++) : ?>
                <tr>
                    <th scope="row">Email <?php echo $i + 1 ?>: </th>
                    <td><?php echo $emails[$i]['dato'] ?></td>
                </tr>
            <?php endfor ?>
        </tbody>
    </table>

</div>

<div class="row mb-3">
    <div class="col-md-12">
        <a class="btn btn-danger" href="index.php">Volver</a>
    </div>
</div>

<?php require_once '../sitio/pie.php' ?>