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

$sql = "SELECT * FROM `clientes`";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $clientes = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $clientes = null;
}

$conn->close();

?>

<h2>Clientes</h2>
<hr>
<a href="crear.php"><button> + Nuevo Cliente</button></a>
<hr>

<?php if(empty($clientes)): ?>
    <p>Aún no hay clientes registrados.</p>
<?php else: ?>

    <table border="1">
        <tr>
            <th>Id</th>
            <th>Nit</th>
            <th>Razon Social</th>
            <th>Acciones</th>
        </tr>

        <?php foreach ($clientes as $key => $cliente) : ?>
            <tr>
                <td><?php echo $cliente['id_cliente'] ?></td>
                <td><?php echo $cliente['nit'] ?></td>
                <td><?php echo $cliente['razon_social'] ?></td>
                <td>
                    <a href="actualizar.php?id=<?php echo $cliente['id_cliente'] ?>"><button>Modificar</button></a>
                    <a href="borrar.php?id=<?php echo $cliente['id_cliente'] ?>" onclick="return confirm('Estas seguro?')">
                        <button>Eliminar</button>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>

    </table>

<?php endif; ?>




<hr>

<a href="../"><button><< volver</button></a>