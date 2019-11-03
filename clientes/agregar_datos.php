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


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $sql = "INSERT INTO `clientes_datos` (`id`, `tipo`, `cliente_id`, `dato`) VALUES (NULL, '" . $_POST["tipo"] . "', '" . $_POST["cliente_id"] . "', '" . $_POST["dato"] . "')";

    if ($conn->query($sql) === TRUE) {
        header('Location: agregar_datos.php?id=' . $_POST["cliente_id"]);
        die();
    } else {
        //echo "Error: " . $sql . "<br>" . $conn->error;
        echo "Ocurrio un error, por favor vuelve a intentarlo";
    }

    $conn->close();
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
        </tbody>
    </table>

    <h5>Direcciones: </h5>
    <ul class="list-group" style="width: 40%;">
        <?php for ($i = 0; $i < @count($direcciones); $i++) : ?>
            <li class="list-group-item">
                <?php echo $direcciones[$i]['dato'] ?>
                <a class="btn btn-danger btn-sm float-right" href="borrar_dato.php?id=<?php echo $direcciones[$i]['id'] ?>&id_cliente=<?php echo $_GET['id'] ?>" onclick="return confirm('¿Estas seguro?')">
                    Eliminar
                </a>
            </li>
        <?php endfor ?>
    </ul>

    <h5>telefonos: </h5>
    <ul class="list-group" style="width: 40%;">
        <?php for ($i = 0; $i < @count($telefonos); $i++) : ?>
            <li class="list-group-item">
                <?php echo $telefonos[$i]['dato'] ?>
                <a class="btn btn-danger btn-sm float-right" href="borrar_dato.php?id=<?php echo $telefonos[$i]['id'] ?>&id_cliente=<?php echo $_GET['id'] ?>" onclick="return confirm('¿Estas seguro?')">
                    Eliminar
                </a>
            </li>
        <?php endfor ?>
    </ul>

    <h5>emails: </h5>
    <ul class="list-group" style="width: 40%;">
        <?php for ($i = 0; $i < @count($emails); $i++) : ?>
            <li class="list-group-item">
                <?php echo $emails[$i]['dato'] ?>
                <a class="btn btn-danger btn-sm float-right" href="borrar_dato.php?id=<?php echo $emails[$i]['id'] ?>&id_cliente=<?php echo $_GET['id'] ?>" onclick="return confirm('¿Estas seguro?')">
                    Eliminar
                </a>
            </li>
        <?php endfor ?>
    </ul>

    <br>

    <h5>Agregar un dato: </h5>
    <form class="form-inline" method="post">

        <input type="hidden" name="cliente_id" value="<?php echo $_GET['id'] ?>">

        <div class="form-group mb-2">
            <select class="form-control" required name="tipo">
                <option value="">Seleccionar...</option>
                <option value="3">Direccion</option>
                <option value="2">Telefono</option>
                <option value="1">Email</option>
            </select>
        </div>
        <div class="form-group mx-sm-3 mb-2">
            <input class="form-control" name="dato" required>
        </div>
        <button type="submit" class="btn btn-primary mb-2">Guardar</button>
    </form>

    <br>
    <div class="mt-3">
        <a class="btn btn-danger" href="index.php">Volver</a>
    </div>

</div>