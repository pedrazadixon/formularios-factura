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

$sql = "SELECT * FROM `productos`";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $productos = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $productos = null;
}
$conn->close();
?>



<?php require_once '../sitio/cabecera.php' ?>

<!-- Ruta-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="<?php echo BASE_URL_ ?>">Facturas UCC</a>
    </li>
    <li class="breadcrumb-item active">Productos</li>
</ol>

<h4>Productos</h4>
<hr>

<div class="row mb-3">
    <div class="col-md-12">
        <a class="btn btn-success" href="crear.php">Nuevo Producto</a>
    </div>
</div>

<div class="row">
    <div class="col-md-12">

        <?php if (empty($productos)) : ?>
            <p>Aún no hay productos registradas.</p>
        <?php else : ?>

            <table class="table table-sm">
                <tr>
                    <th>Id</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Acciones</th>
                </tr>

                <?php foreach ($productos as $key => $producto) : ?>
                    <tr>
                        <td><?php echo $producto['id_producto'] ?></td>
                        <td><?php echo $producto['descripcion'] ?></td>
                        <td><?php echo $producto['precio'] ?></td>
                        <td><?php echo $producto['cantidad'] ?></td>
                        <td>
                            <a class="btn btn-sm btn-primary " href="actualizar.php?id=<?php echo $producto['id_producto'] ?>">Modificar</a>
                            <a class="btn btn-sm btn-danger " href="borrar.php?id=<?php echo $producto['id_producto'] ?>" onclick="return confirm('¿Estas seguro?')">
                                Eliminar</a>
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