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

$sql = "SELECT * FROM `clientes`";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $clientes = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $clientes = null;
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




<?php require_once '../sitio/cabecera.php' ?>

<!-- Ruta-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="<?php echo BASE_URL_ ?>">Facturas UCC</a>
    </li>
    <li class="breadcrumb-item active">Clientes</li>
</ol>

<h4>Clientes</h4>
<hr>

<div class="row mb-3">
    <div class="col-md-12">
        <a class="btn btn-success" href="crear.php">Nuevo Cliente</a>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <?php if (empty($clientes)) : ?>
            <p>Aún no hay clientes registrados.</p>
        <?php else : ?>
            <table class="table table-sm">
                <tr>
                    <th>Id</th>
                    <th>Nit</th>
                    <th>Razon Social</th>
                    <th>Acciones</th>
                </tr>
                <?php foreach ($clientes as $key => $cliente) : ?>
                    <tr>
                        <td><?php echo $cliente['id_cliente'] ?></td>
                        <td><?php echo $cliente['nit'] ?></td>
                        <td><?php echo $cliente['razon_social'] ?></td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="ver_datos.php?id=<?php echo $cliente['id_cliente'] ?>">
                                Ver
                            </a>
                            <a class="btn btn-primary btn-sm" href="actualizar.php?id=<?php echo $cliente['id_cliente'] ?>">
                                Modificar Cliente
                            </a>
                            <a class="btn btn-primary btn-sm" href="agregar_datos.php?id=<?php echo $cliente['id_cliente'] ?>">
                                Modificar Datos
                            </a>
                            <a class="btn btn-danger btn-sm" href="borrar.php?id=<?php echo $cliente['id_cliente'] ?>" onclick="return confirm('¿Estas seguro?')">
                                Eliminar
                            </a>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-12">
        <a href="<?php echo BASE_URL_ ?>" class="btn btn-danger">Volver</button></a>
    </div>
</div>

<?php require_once '../sitio/pie.php' ?>