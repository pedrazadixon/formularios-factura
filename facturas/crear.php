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

$sql = "SELECT * FROM `clientes`";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $clientes = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $clientes = null;
}

$sql = "SELECT * FROM `productos`";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $productos = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $productos = null;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!empty($_POST['producto']) || !empty($_POST['productos_factura'])) {

        $productos_factura_input = $_POST['productos_factura'] . "," . $_POST['producto'];
        $productos_factura_input = trim($productos_factura_input, ",");
        $array_lista_productos =  explode(",", $productos_factura_input);

        foreach ($array_lista_productos as $key => $producto_factura) {
            foreach ($productos as $key => $producto) {
                if ($producto['id_producto'] == $producto_factura) {
                    $productos_factura[] = $producto;
                }
            }
        }
    }

    if (isset($_POST['facturar']) && $_POST['facturar'] == "facturar") {

        if (isset($_POST['productos_']) && !empty($_POST['productos_'])) {

            $sql = "INSERT INTO `facturas` (id_factura, cliente_id, fecha) VALUES (NULL, '" . $_POST["cliente_id"] . "', '" . date("Y-m-d H:i:s") . "')";

            if ($conn->query($sql) === TRUE) {

                $id_factura = $conn->insert_id;

                foreach ($_POST['productos_'] as $key => $producto_factura) {

                    $sql = "INSERT INTO `facturas_productos` (`id_facturas_productos`, `factura_id`, `producto_id`, `cantidad_factura`, `precio_factura`) 
                        VALUES (NULL, '" . $id_factura . "', '" . $producto_factura["id_producto"] . "', '" . $producto_factura["cantidad"] . "', '" . $producto_factura["precio"] . "')";

                    echo $sql;

                    $conn->query($sql);
                }

                header('Location: index.php');
                die();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();
        } else {
            echo "Debe añadir al menos un producto.";
        }
    }

}
require('../vistas/header.html');
?>

<div class="container text-center mt-5">
    <h2>Crear Factura</h2>
     <div class="form-group">
        <form class="form-signin" action="crear.php" method="post">
            <fieldset class="mx-auto col-md-5">
                <legend>Datos de la factura:</legend>Cliente:
                <select class="form-control" name="cliente_id" onchange="this.form.submit()" required>
                    <option value="">Seleccionar...</option>
                    <?php foreach ($clientes as $key => $cliente) : ?>

                    <?php
                        if ($_POST['cliente_id'] == $cliente['id_cliente']) {
                            $selected = "selected";
                            $cliente_actual = $cliente;
                        } else {
                            $selected = "";
                        }
                        ?>

                    <option value="<?php echo $cliente['id_cliente'] ?>" <?php echo $selected ?>>
                        <?php echo $cliente['razon_social'] ?>
                    </option>

                    <?php endforeach; ?>

                </select>
                <br>
                NIT: <input class="form-control" type="text" value="<?php echo @$cliente_actual['nit'] ?>" readonly
                    disabled>
            </fieldset>
            <legend>Productos</legend>
            <input class="form-control" type="hidden" name="productos_factura" value="<?php echo @$productos_factura_input ?>">
            <?php if (@!empty($productos_factura)) : ?>
            <table class="col-4 mx-auto table table-striped" border="0">
                <thead>
                    <tr>
                        <td><b>Cantidad</b></td>
                        <td><b>ID</b></td>
                        <td><b>Precio Und</b></td>
                    </tr>
                </thead>
                <tbody>
                    <?php $contador = 1 ?>
                    <?php foreach ($productos_factura as $key => $producto) : ?>
                    <?php
                                    @$cantidad_actual = $_POST['productos_'][$contador]['cantidad'];
                                    @$precio_actual = (isset($_POST['productos_'][$contador]['precio']) && $_POST['productos_'][$contador]['precio'] != '')
                                        ? $_POST['productos_'][$contador]['precio']
                                        : $producto['precio'];
                    ?>
                    <tr>
                        <td>
                            <input class="form-control" type="hidden" name="productos_[<?php echo $contador ?>][id_producto]" value="<?php echo $producto['id_producto'] ?>" required>
                            <input class="form-control" type="number" min="1" max="<?php echo $producto['cantidad'] ?>" name="productos_[<?php echo $contador ?>][cantidad]" value="<?php //echo @$cantidad_actual ?><?php echo $producto['cantidad'] ?>" required>
                        </td>
                        <td>
                            <input class="form-control" type="text" readonly disabled value="<?php echo $producto['descripcion'] ?>">
                        </td>
                        <td>
                            <input class="form-control" type="number" min="0" name="productos_[<?php echo $contador ?>][precio]" value="<?php echo @$precio_actual ?>" required>
                        </td>
                    </tr>
                    <?php $contador++ ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php endif; ?>
                <select class="form-control col-6" form-group name="producto">
                    <option value="">Seleccine uno...</option>
                    <?php foreach ($productos as $key => $producto) : ?>
                    <option value="<?php echo $producto['id_producto'] ?>">
                        <?php echo $producto['descripcion'] ?>
                    </option>
                    <?php endforeach; ?>
                </select>
                <button class="btn btn-primary" type="submit">Añadir producto</button>
            </fieldset>
            <div class="mt-3">
                <a class="btn btn-primary" href="index.php">Volver</a>
                <button class=" btn btn-primary" type="submit" name="facturar" value="facturar">Guardar</button>
            </div>
        </form>
    </div>
</div>


<style>
    .table td,
    .table th {
        padding: 3px !important;
        vertical-align: top;
        border-top: 1px solid #c6d0da;
    }

    .form-control {
        display: inline !important;
        width: auto !important;
        height: calc(1.5em + .75rem + 2px);
        padding: .375rem .75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: .25rem;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }
</style>
</body>