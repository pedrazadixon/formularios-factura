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

<?php require_once '../sitio/cabecera.php' ?>

<!-- Ruta-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="<?php echo BASE_URL_ ?>">Facturas UCC</a>
    </li>
    <li class="breadcrumb-item">
        <a href="<?php echo BASE_URL_ ?>clientes">Clientes</a>
    </li>
    <li class="breadcrumb-item active">Crear Cliente</li>
</ol>

<h4>Crear Cliente</h4>
<hr>

<form action="crear.php" method="post" class="w-50">
    NIT: <input class="form-control" name="nit" type="number" min="1" required>
    Razon Social: <input class="form-control" name="razon_social" type="text" required>

    <hr>

    <a class="btn btn-danger mr-1" href="index.php">Cancelar</a>
    <button class="btn btn-success" type="submit"><span class="px-2">Guardar</span></button>
</form>

<?php require_once '../sitio/pie.php' ?>