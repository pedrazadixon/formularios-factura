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

$sql = "DELETE FROM `productos` WHERE `id_producto` = " . $_GET["id"];

if ($conn->query($sql) === TRUE) {
    header('Location: ./index.php');
} else {
    header('Location: ./index.php');
}

$conn->close();

die();
