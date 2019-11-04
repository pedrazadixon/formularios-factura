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

$sql = "SELECT 
            clientes.nit,
            clientes.razon_social,
        (SELECT clientes_datos.dato FROM clientes_datos WHERE clientes_datos.cliente_id = " . $factura[0]['cliente_id'] . " AND clientes_datos.tipo = 3 LIMIT 1) AS direccion,
        (SELECT clientes_datos.dato FROM clientes_datos WHERE clientes_datos.cliente_id = " . $factura[0]['cliente_id'] . " AND clientes_datos.tipo = 2 LIMIT 1) AS telefono,
        (SELECT clientes_datos.dato FROM clientes_datos WHERE clientes_datos.cliente_id = " . $factura[0]['cliente_id'] . " AND clientes_datos.tipo = 1 LIMIT 1) AS email
        FROM `clientes`
        WHERE clientes.id_cliente = " . $factura[0]['cliente_id'];
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $datos_cliente = $result->fetch_all(MYSQLI_ASSOC);
}

$conn->close();

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php defined('BASE_URL_') or define('BASE_URL_', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/' . basename(dirname(__DIR__)) . '/'); ?>
    <link href="<?php echo BASE_URL_ ?>assets/sb-admin/css/sb-admin.css" rel="stylesheet">
    <title>Facturas UCC</title>
</head>

<body>
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="invoice-title">
                    <h2>Factura # <?php echo $factura[0]['id_factura'] ?></h2>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <address>
                            <strong>Facturado a:</strong><br>
                            <?php echo $factura[0]['razon_social'] ?><br>
                            <?php echo $factura[0]['nit'] ?><br>
                            <?php echo @$datos_cliente[0]['direccion'] ?><br>
                            <?php echo @$datos_cliente[0]['telefono'] ?><br>
                            <?php echo @$datos_cliente[0]['email'] ?><br>
                        </address>
                    </div>
                    <div class="col-md-6 text-right">
                        <address>
                            <strong>Facturado por:</strong><br>
                            Universidad Cooperativa de Colombia<br>
                            000000000-1<br>
                            Cl. 39 #14-39, Bogotá<br>
                            (1) 342 00 00<br>
                            Colombia
                        </address>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6">
                        <address>
                            <strong>Fecha factura:</strong>
                            <?php echo $factura[0]['fecha'] ?><br><br>
                        </address>
                    </div>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Detalle de factura</strong></h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-condensed">
                                <thead>
                                    <tr>
                                        <td><strong>Producto</strong></td>
                                        <td class="text-center"><strong>Precio</strong></td>
                                        <td class="text-center"><strong>Cantidad</strong></td>
                                        <td class="text-right"><strong>Total</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $total_factura = 0; ?>
                                    <?php foreach ($factura as $key => $producto) : ?>
                                        <tr>
                                            <td><?php echo $producto['descripcion'] ?></td>
                                            <td class="text-center">$ <?php echo $producto['precio_factura'] ?></td>
                                            <td class="text-center"><?php echo $producto['cantidad_factura'] ?></td>
                                            <td class="text-right">$ <?php echo $total_item = $producto['cantidad_factura'] * $producto['precio_factura'] ?></td>
                                        </tr>
                                        <?php $total_factura += $total_item; ?>
                                    <?php endforeach ?>
                                    <tr>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line text-center"><strong>Total</strong></td>
                                        <td class="no-line text-right">$ <?php echo $total_factura; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3 d-print-none">
            <div class="col-md-12 text-center">
                <button class="btn btn-danger" onclick="window.close(); return false;"><span>Cerrar</span></button>
                <button class="btn btn-primary" onclick="window.print(); return false;"><span>Imrpimir</span></button>
            </div>
        </div>

    </div>
</body>

</html>