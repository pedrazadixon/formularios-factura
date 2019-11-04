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

<?php require_once '../sitio/cabecera.php' ?>

<style>
    li {
        padding-bottom: 5px !important;
        padding-top: 5px !important;
    }
</style>

<!-- Ruta-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="<?php echo BASE_URL_ ?>">Facturas UCC</a>
    </li>
    <li class="breadcrumb-item">
        <a href="<?php echo BASE_URL_ ?>clientes">Clientes</a>
    </li>
    <li class="breadcrumb-item active">Modificar Datos Cliente</li>
</ol>

<h4>Modificar Datos Cliente</h4>
<hr>

<div class="row">

    <div class="col-md-6">
        <table class="table">
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
    </div>

    <div class="col-md-6">
        <h6>Agregar un dato: </h6>
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
    </div>

    <div class="col-md-6">
        <h6>Direcciones: </h6>
        <ul class="list-group">
            <?php for ($i = 0; $i < @count($direcciones); $i++) : ?>
                <li class="list-group-item">
                    <?php echo $direcciones[$i]['dato'] ?>
                    <a class="btn btn-danger btn-sm float-right" href="borrar_dato.php?id=<?php echo $direcciones[$i]['id'] ?>&id_cliente=<?php echo $_GET['id'] ?>" onclick="return confirm('¿Estas seguro?')">
                        Eliminar
                    </a>
                </li>
            <?php endfor ?>
        </ul>

        <h6>Telefonos: </h6>
        <ul class="list-group">
            <?php for ($i = 0; $i < @count($telefonos); $i++) : ?>
                <li class="list-group-item">
                    <?php echo $telefonos[$i]['dato'] ?>
                    <a class="btn btn-danger btn-sm float-right" href="borrar_dato.php?id=<?php echo $telefonos[$i]['id'] ?>&id_cliente=<?php echo $_GET['id'] ?>" onclick="return confirm('¿Estas seguro?')">
                        Eliminar
                    </a>
                </li>
            <?php endfor ?>
        </ul>

        <h6>Emails: </h6>
        <ul class="list-group">
            <?php for ($i = 0; $i < @count($emails); $i++) : ?>
                <li class="list-group-item">
                    <?php echo $emails[$i]['dato'] ?>
                    <a class="btn btn-danger btn-sm float-right" href="borrar_dato.php?id=<?php echo $emails[$i]['id'] ?>&id_cliente=<?php echo $_GET['id'] ?>" onclick="return confirm('¿Estas seguro?')">
                        Eliminar
                    </a>
                </li>
            <?php endfor ?>
        </ul>
    </div>

</div>


<div class="mt-3">
    <a class="btn btn-danger" href="index.php">Volver</a>
</div>

<?php require_once '../sitio/pie.php' ?>