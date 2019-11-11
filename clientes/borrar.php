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


$sql = "SELECT count(*) FROM facturas WHERE cliente_id = ". $_GET["id"];
$conteo = $conn->query($sql)->fetch_row();
 
if($conteo[0] > 0){
    $conn->close();
	echo '<script>
			alert("El Cliente ya se posee facturas");
 			window.location="./index.php";
          </script>';
          
}else{

	$sql = "DELETE FROM `clientes` WHERE `id_cliente` = " . $_GET["id"];

	if ($conn->query($sql) === TRUE) {
	    header('Location: ./index.php');
	} else {
	    header('Location: ./index.php');
	}

	$conn->close();
	die();


}