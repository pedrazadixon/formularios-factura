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


$sql = "SELECT count(*) FROM facturas_productos WHERE producto_id = ". $_GET["id"];
$conteo = $conn->query($sql)->fetch_row();

if($conteo[0] > 0){
	echo '<script>
			alert("El producto ya se encuentra en una factura");
 			window.location="./index.php";
		  </script>';
}else{

	$sql = "DELETE FROM `productos` WHERE `id_producto` = " . $_GET["id"];

	if ($conn->query($sql) === TRUE) {
	    header('Location: ./index.php');
	} else {
	    header('Location: ./index.php');
	}

	$conn->close();
	die();


}