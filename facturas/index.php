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

$sql = "SELECT * FROM `facturas` INNER JOIN clientes ON clientes.id_cliente = facturas.cliente_id ORDER BY `facturas`.`fecha` DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $facturas = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $facturas = null;
}

$conn->close();
?>

<?php require_once '../sitio/cabecera.php' ?>

<!-- Ruta-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="<?php echo BASE_URL_ ?>">Facturas UCC</a>
    </li>
    <li class="breadcrumb-item active">Facturas</li>
</ol>

<h4>Facturas</h4>
<hr>

<div class="row mb-3">
    <div class="col-md-12">
        <a class="btn btn-success" href="crear.php">Nueva Factura</a>
    </div>
</div>

<div class="row">
    <div class="col-md-12">

        <?php if (empty($facturas)) : ?>
            <p>Aún no hay facturas registradas.</p>
        <?php else : ?>

            <table class="table table-sm">
                <tr>
                    <th>Num. Factura</th>
                    <th>Cliente NIT</th>
                    <th>Razon Social</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>

                <?php foreach ($facturas as $key => $factura) : ?>
                    <tr>
                        <td><?php echo $factura['id_factura'] ?> <?php echo ($key == 0) ? '<span class="badge badge-info">Ultima</span>' : '' ?></td>
                        <td><?php echo $factura['nit'] ?></td>
                        <td><?php echo $factura['razon_social'] ?></td>
                        <td><?php echo $factura['fecha'] ?></td>
                        <td>
                            <a target="blank" class="btn btn-sm btn-primary " href="ver.php?id=<?php echo $factura['id_factura'] ?>">Ver</a>
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