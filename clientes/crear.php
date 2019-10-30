<?php require('../vistas/header.html');
?>

<div class="container text-center mt-5">
<h2>Crear Cliente</h2>
    <div class="form-group">
    <form action="crear.php" method="post">
        <fieldset>
            <legend>Datos del cliente:</legend>
            NIT: <input class="form-control" name="nit" type="number" min="1" required><br>
            Razon Social: <input class="form-control" name="razon_social" type="text" required><br>
            <br>
            <a class="btn btn-primary"  href="index.php">volver</a>
            <button class="btn btn-primary"  type="submit">Guardar</button>
        </fieldset>
    </form>
</div>
</div>

<style>
                  
                  .form-control {
                      display: inline !important;
                      width: auto !important;
                      height: calc(1.5em + .75rem + 2px);
                      padding: .375rem .75rem;
                      font-size: 1rem;
                      font-weight: 400;
                      line-height: 1.5;
                      color: #495057;
                      background-color: #fff;
                      background-clip: padding-box;
                      border: 1px solid #ced4da;
                      border-radius: .25rem;
                      transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
                  }
              </style>
      </body>
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