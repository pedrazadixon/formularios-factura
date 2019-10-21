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

?>

<h2>Facturas</h2>
<hr>
<a href="crear.php"><button> + Nuevo Factura</button></a>
<hr>

<?php if(empty($facturas)): ?>
    <p>Aún no hay facturas registradas.</p>
<?php else: ?>

    <table border="1">
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
                <td>
                    <a href="ver.php?id=<?php echo $factura['id'] ?>"><button>Ver</button></a>
                </td>
            </tr>
        <?php endforeach; ?>

    </table>

<?php endif; ?>

<hr>

<a href="../"><button><< volver</button></a>