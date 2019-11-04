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
?>

<?php require_once '../sitio/cabecera.php' ?>

<!-- Ruta-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="<?php echo BASE_URL_ ?>">Facturas UCC</a>
    </li>
    <li class="breadcrumb-item">
        <a href="<?php echo BASE_URL_ ?>facturas">Facturas</a>
    </li>
    <li class="breadcrumb-item active">Crear factura</li>
</ol>

<h4>Crear Factura</h4>
<hr>

<form class="form-signin" action="crear.php" method="post">

    <h6>Cliente:</h6>

    <table class="table table-borderless w-75 ml-4">
        <tr>
            <td><b>Razon Social:</b></td>
            <td>
                <select class="form-control" name="cliente_id" onchange="this.form.submit()" required>
                    <option value="">Seleccionar...</option>
                    <?php foreach ($clientes as $key => $cliente) : ?>
                        <?php if ($_POST['cliente_id'] == $cliente['id_cliente']) {
                                $selected = "selected";
                                $cliente_actual = $cliente;
                            } else {
                                $selected = "";
                            } ?>
                        <option value="<?php echo $cliente['id_cliente'] ?>" <?php echo $selected ?>>
                            <?php echo $cliente['razon_social'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
            <td><b>Nit:</b></td>
            <td><input class="form-control" type="text" value="<?php echo @$cliente_actual['nit'] ?>" readonly disabled></td>
        </tr>
        <tr>
            <td><b>Direccion 1: </b></td>
            <td>
                cra 1 1 1
            </td>
            <td><b>Telefono 1</b></td>
            <td>(1) 830 2323</td>
        </tr>
    </table>


    <h6>Productos:</h6>
    
    <input class="form-control" type="hidden" name="productos_factura" value="<?php echo @$productos_factura_input ?>">
    <?php if (@!empty($productos_factura)) : ?>
        <table class="table">
            <thead style="text-align:center">
                <tr>
                    <td>Cantidad</td>
                    <td>Descripcion</td>
                    <td>Precio Und.</td>
                </tr>
            </thead>
            <tbody>
                <?php $contador = 1 ?>
                <?php foreach ($productos_factura as $key => $producto) : ?>
                    <?php
                            @$cantidad_actual = $_POST['productos_'][$contador]['cantidad'];
                            @$precio_actual = (isset($_POST['productos_'][$contador]['precio']) && $_POST['productos_'][$contador]['precio'] != '') ? $_POST['productos_'][$contador]['precio'] : $producto['precio'];
                            ?>
                    <tr>
                        <td>
                            <input class="form-control" type="hidden" name="productos_[<?php echo $contador ?>][id_producto]" value="<?php echo $producto['id_producto'] ?>" required>
                            <input class="form-control" type="number" min="1" max="<?php echo $producto['cantidad'] ?>" name="productos_[<?php echo $contador ?>][cantidad]" value="<?php echo $producto['cantidad'] ?>" required>
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

    <div class="form-inline">
        <div class="form-group mb-2 ml-2">
            <select class="form-control form-control-sm mr-2" form-group name="producto">
                <option value="">Seleccine uno...</option>
                <?php foreach ($productos as $key => $producto) : ?>
                    <?php if (in_array($producto['id_producto'], $array_lista_productos)) continue ?>
                    <option value="<?php echo $producto['id_producto'] ?>">
                        <?php echo $producto['descripcion'] ?> (<?php echo $producto['cantidad'] ?> disponibles)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-sm btn-primary mb-2">Añadir producto</button>
    </div>

    <hr>

    <div class="mt-3">
        <a class="btn btn-danger mr-1" href="index.php">Cancelar</a>
        <button class=" btn btn-success" type="submit" name="facturar" value="facturar"><span class="px-2">Guardar</span></button>
    </div>
</form>



<?php require_once '../sitio/pie.php' ?>