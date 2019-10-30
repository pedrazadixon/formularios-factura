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
            INNER JOIN telefonos ON telefonos.id_cliente = facturas.cliente_id 
            INNER JOIN direcciones ON direcciones.id_cliente = facturas.cliente_id 
            INNER JOIN emails ON emails.id_cliente = facturas.cliente_id 
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

require('../vistas/header.html');
?>

<div class="container">
    <div class="col-md-8 my-5 mx-auto text-center">
        <fieldset >
            <legend>Factura de venta</legend>
            <center>
            <table cellspacing="25" class="w-100">
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
                        <b>Provedor: </b>
                        Universidad Cooperativa de Colombia <br>
                        <b>NIT: </b> 0000000-1 <br>
                        <b>Dirección: </b>Cl. 39 #14-39, Bogotá<br>
                        <b>Télefono: </b>(1) 332 3565<br>
                    </td>
                    <td>
                        <b>Cliente: </b>
                        <?php echo $factura[0]['razon_social'] ?><br>
                        <b>NIT: </b> <?php echo $factura[0]['nit'] ?><br>
                        <b>Dirección: </b><?php echo$factura[0]['direccion']?> <br>
                        <b>Telefono: </b><?php echo$factura[0]['telefono']?> <br>
                    </td>
                </tr>

            </table>
            </center>

            <fieldset class="mt-5">
                <legend>Productos</legend>

                <table cellpadding="5" cellspacing="5" border="0" style="border-collapse: collapse; width: 100%;">
                    <tr>
                        <th>Cantidad</th>
                        <th>Descripción</th>
                        <th>Valor und</th>
                        <th>Total</th>
                    </tr>

                    <?php foreach ($factura as $key => $producto) : ?>

                    <tr>
                        <td><?php echo $producto['cantidad_factura'] ?></td>
                        <td><?php echo $producto['descripcion'] ?></td>
                        <td><?php echo $producto['precio_factura'] ?></td>
                        <td><?php echo $total_factura = $producto['cantidad_factura'] * $producto['precio_factura'] ?></td>

                    </tr>

                    <?php endforeach ?>

                    <tr>
                        <td colspan="3" style="text-align: right;"><b>Total:</b></td>
                        <td>$xxxxx</td>
                    </tr>

                </table>

            </fieldset>

        </fieldset>
             <br>
            <a href="./"><button class="btn btn-primary">VOLVER</button> </a>
    </div>
</div>