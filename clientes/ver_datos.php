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
<div style="width: 50%;">
    <h5>cliente</h5>
    <pre><?php print_r($cliente[0]) ?></pre>
    <h5>direcciones</h5>
    <pre><?php print_r($direcciones) ?></pre>
    <h5>emails</h5>
    <pre><?php print_r($emails) ?></pre>
    <h5>telefonos</h5>
    <pre><?php print_r($telefonos) ?></pre>

    <br>
    <a href="index.php" class="btn btn-danger">Volver</a>
</div>