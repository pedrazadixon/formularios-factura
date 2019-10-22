<h2>Crear Cliente</h2>
<hr>
<div style="width: 50%;">
    <form action="crear.php" method="post">
        <fieldset>
            <legend>Datos del cliente:</legend>
            NIT: <input name="nit" type="number" min="1" required><br>
            Razon Social: <input name="razon_social" type="text" required><br>
            <br>
            <a href="index.php"><button type="button"><< volver</button></a>
            <button type="submit">Guardar</button>
        </fieldset>
    </form>
</div>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

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

    $sql = "INSERT INTO clientes (id_cliente, nit, razon_social) VALUES (NULL, '" . $_POST["nit"] . "', '" . $_POST["razon_social"] . "')";

    if ($conn->query($sql) === TRUE) {
        header('Location: index.php');
        die();
    } else {
        //echo "Error: " . $sql . "<br>" . $conn->error;
		echo "Nit ya existente por favor vuelve a intentarlo";
	}

    $conn->close();
}



?>