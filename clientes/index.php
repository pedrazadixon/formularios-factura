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

<div class="container">
    <div class="my-4 text-center">

        <h2>Clientes</h2>
        <hr>
        <a class="btn btn-success" href="crear.php">Nuevo Cliente</a>
        <hr>

        <?php if (empty($clientes)) : ?>
            <p>Aún no hay clientes registrados.</p>
        <?php else : ?>
            <div class="row col-md-12 d-flex justify-content-center align-items-center">
                <table class="col-md-8 table-striped">
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
                                    Modificar
                                </a>
                                <a class="btn btn-primary btn-sm" href="borrar.php?id=<?php echo $cliente['id_cliente'] ?>" onclick="return confirm('Estas seguro?')">
                                    Eliminar
                                </a>
                                <a class="btn btn-primary btn-sm" href="agregar_datos.php?id=<?php echo $cliente['id_cliente'] ?>">
                                    Agregar Datos
                                </a>

                            </td>
                        </tr>
                    <?php endforeach; ?>

                </table>
            </div>

        <?php endif; ?>

        <br>
        <a class="btn btn-danger " href="../">volver</a>

    </div>
</div>