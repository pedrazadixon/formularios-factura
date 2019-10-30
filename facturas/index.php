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

$sql = "SELECT * FROM `facturas` INNER JOIN clientes ON clientes.id_cliente = facturas.cliente_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $facturas = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $facturas = null;
}

$conn->close();
require('../vistas/header.html');
?>
<div class="container ">
    <div class="col-md-12 my-5 mx-auto text-center ">
        <h2>Facturas</h2>
            <hr>
            <a class="btn btn-primary" href="crear.php">Nueva Factura</a>
            <hr>
    </div>

<?php if(empty($facturas)): ?>
    <p>Aún no hay facturas registradas.</p>
<?php else: ?>

    <div class="row col-md-12 d-flex justify-content-center align-items-center">
    <table class="col-md-8 " border="0">
        <tr>
            <th>Num. Factura</th>
            <th>Cliente NIT</th>
            <th>Razon Social</th>
            <th>Fecha</th>
            <th>Acciones</th>
        </tr>
 
        <?php foreach ($facturas as $key => $factura) : ?>
            <tr>
                <td><?php echo $factura['id_factura'] ?></td>
                <td><?php echo $factura['nit'] ?></td>
                <td><?php echo $factura['razon_social'] ?></td>
                <td><?php echo $factura['fecha'] ?></td>
                <td class="d-flex justify-content-center ">
                    <a class="btn btn-primary " href="ver.php?id=<?php echo $factura['id_factura'] ?>">Ver</a>
                </td>
            </tr>
        <?php endforeach; ?>

    </table>
</div>

<?php endif; ?>

<hr>
<div class="row d-flex justify-content-center align-items-center">
<a href="../" class="btn btn-primary">VOLVER</button></a>
</div>
</div>
</div>