<h2>Crear Producto</h2>
<hr>
<div style="width: 50%;">
    <form action="crear.php" method="post">
        <fieldset>
            <legend>Datos del producto:</legend>
            Nombre: <input name="descripcion" type="text"><br>
            Precio: <input name="precio" type="number"><br>
            Cantidad: <input name="cantidad" type="number"><br>
            <br>
            <a href="index.php"><button type="button">Cancelar</button></a>
            <button type="submit">Guardar</button>
        </fieldset>
    </form>
</div>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

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

    $sql = "INSERT INTO productos (id, descripcion, precio, cantidad) VALUES (NULL, '" . $_POST["descripcion"] . "', '" . $_POST["precio"] . "', '" . $_POST["cantidad"] . "')";

    if ($conn->query($sql) === TRUE) {
        echo "El producto se guardo correctamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}



?>