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

<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Facturas</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" crossorigin="anonymous">
</head>

<h2>Datos del cliente</h2>
<hr>

<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th scope="col" colspan="2">Datos del cliente</th>
            </tr>
        </thead>
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

    <br>
    <div class="mt-3">
        <a class="btn btn-danger" href="index.php">Volver</a>
    </div>

</div>