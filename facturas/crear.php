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


        print_r($_POST);
        // exit();

        if (isset($_POST['productos_']) && !empty($_POST['productos_'])) {

            $sql = "INSERT INTO `facturas` (id_factura, cliente_id, fecha) VALUES (NULL, '" . $_POST["cliente_id"] . "', '" . date("Y-m-d H:i:s") . "')";

            if ($conn->query($sql) === TRUE) {

                $id_factura = $conn->insert_id;


                foreach ($_POST['productos_'] as $key => $producto_factura) {

                    $sql = "INSERT INTO `facturas_productos` (`id_facturas_productos`, `factura_id`, `producto_id`, `cantidad`, `precio`) 
                        VALUES (NULL, '" . $id_factura . "', '" . $producto_factura["id_producto"] . "', '" . $producto_factura["cantidad"] . "', '" . $producto_factura["precio"] . "')";

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


<h2>Crear Factura</h2>
<hr>
<div style="width: 50%;">
    <form action="crear.php" method="post">
        <fieldset>
            <legend>Datos de la factura:</legend>

            Cliente:
            <select name="cliente_id" onchange="this.form.submit()" required>

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

            </select><br><br>

            NIT: <input type="text" value="<?php echo @$cliente_actual['nit'] ?>" readonly disabled><br><br>


            <fieldset>
                <legend>Productos</legend>

                <input type="text" name="productos_factura" value="<?php echo @$productos_factura_input ?>">

                <?php if (@!empty($productos_factura)) : ?>

                    <table>
                        <tr>
                            <td>Cantidad</td>
                            <td>ID</td>
                            <td>Precio Und</td>
                        </tr>

                        <?php $contador = 1 ?>
                        <?php foreach ($productos_factura as $key => $producto) : ?>
                            <tr>
                                <td>
                                    <input type="hidden" name="productos_['<?php echo $contador ?>'][id_producto]" value="<?php echo $producto['id_producto'] ?>">
                                    <input type="number" name="productos_['<?php echo $contador ?>'][cantidad]">
                                    <!-- <input type="number" required min="1"> -->
                                </td>
                                <td>
                                    <input type="text" readonly disabled value="<?php echo $producto['descripcion'] ?>">
                                </td>
                                <td>
                                    <input type="text" name="productos_['<?php echo $contador ?>'][precio]" value="<?php echo $producto['precio'] ?>">
                                </td>
                            </tr>

                            <?php $contador++ ?>


                        <?php endforeach; ?>
                    </table>

                    <br>
                <?php endif; ?>

                <select name="producto">
                    <option value="">Seleccine uno...</option>
                    <?php foreach ($productos as $key => $producto) : ?>
                        <option value="<?php echo $producto['id_producto'] ?>">
                            <?php echo $producto['descripcion'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit">Añadir producto</button>

            </fieldset>

            <br>
            <br>
            <a href="index.php"><button type="button">
                    << volver</button> </a> <button type="submit" name="facturar" value="facturar">Guardar
                </button>
        </fieldset>
    </form>
</div>