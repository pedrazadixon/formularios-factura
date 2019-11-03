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

$sql = "DELETE FROM `clientes_datos` WHERE `id` = " . $_GET["id"];

if ($conn->query($sql) === TRUE) {
    header('Location: ./agregar_datos.php?id=' . $_GET["id_cliente"]);
} else {
    header('Location: ./agregar_datos.php?id=' . $_GET["id_cliente"]);
}

$conn->close();

die();
