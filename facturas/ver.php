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

$sql = "SELECT * 
            FROM facturas 
            INNER JOIN clientes ON clientes.id_cliente = facturas.cliente_id 
            INNER JOIN facturas_productos ON facturas_productos.factura_id = facturas.id_factura 
            INNER JOIN productos ON productos.id_producto = facturas_productos.producto_id
        WHERE facturas.id_factura = " . $_GET['id'];

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $factura = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $factura = null;
}
$conn->close();

?>


<fieldset style="width: 50%;">
    <legend>Factura de venta</legend>

    <table cellspacing="15">
        <tr>
            <td>
                <b>Factura Numero #:</b> <?php echo $factura[0]['id_factura'] ?>
            </td>
            <td>
                <b>Fecha:</b> <?php echo $factura[0]['fecha'] ?>
            </td>
            <!-- <td colspan="4"><b>Fecha: </b>2019-01-01</td> -->
        </tr>
        <tr>
            <td>
                <b>Provedor</b><br>
                Universidad Cooperativa de Colombia <br>
                NIT: 0000000-1 <br>
                Cl. 39 #14-39, Bogotá<br>
                (1) 332 3565<br>
            </td>
            <td>
                <b>Cliente</b><br>
                <?php echo $factura[0]['razon_social'] ?><br>
                NIT: <?php echo $factura[0]['nit'] ?><br>
                xxxxxxxxxx <br>
                xxxxxxx <br>
            </td>
        </tr>

    </table>

    <fieldset>
        <legend>Productos</legend>

        <table cellpadding="5" cellspacing="5" border="1" style="border-collapse: collapse; width: 100%;">
            <tr>
                <th>Cantidad</th>
                <th>Descripción</th>
                <th>Valor und</th>
                <th>Total</th>
            </tr>

            <?php foreach ($factura as $key => $producto) : ?>

                <tr>
                    <td><?php echo $producto['cantidad'] ?></td>
                    <td><?php echo $producto['descripcion'] ?></td>
                    <td><?php echo $producto['precio_factura'] ?></td>
                    <td><?php echo $producto['cantidad'] ?></td>

                </tr>

            <?php endforeach ?>

            <tr>
                <td></td>
                <td></td>
                <td><b>Total:</b></td>
                <td>$xxxxx</td>
            </tr>

        </table>

    </fieldset>

</fieldset>
<br>
<a href="./"><button>
        << volver</button> </a>