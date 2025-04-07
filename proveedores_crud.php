<?php
//Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mercado";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Proveedores</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Gestión de Proveedores</h2>
    <form action="guardar_proveedor.php" method="post">
        <label>Nombre del Proveedor:</label>
        <input type="text" name="nombre_proveedor" required>

        <label>Contacto Interno:</label>
        <input type="text" name="contacto_interno">

        <label>Teléfono de Contacto:</label>
        <input type="text" name="teléfono_contacto">

        <label>Email de Contacto:</label>
        <input type="email" name="email_contacto">

        <label>Dirección:</label>
        <input type="text" name="direccion">

        <label>Ciudad:</label>
        <input type="text" name="ciudad">

        <label>País:</label>
        <input type="text" name="pais">

        <label>Obsevaciones:</label>
        <textarea name="observaciones"></textarea>

        <input type="submit" value="Guardar Proveedor">
    </form>

    <h2>Lista de Proveedores</h2>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Contacto</th>
            <th>Teléfono</th>
            <th>Email</th>
            <th>Dirección</th>
            <th>Ciudad</th>
            <th>País</th>
            <th>Acciones</th>
        </tr>
        <?php
        $sql = "SELECT * FROM proveedores";
        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["nombre_proveedor"] . "</td>";
            echo "<td>" . $row["contacto_interno"] . "</td>";
            echo "<td>" . $row["telefono_contacto"] . "</td>";
            echo "<td>" . $row["email_contacto"] . "</td>";
            echo "<td>" . $row["direccion"] . "</td>";
            echo "<td>" . $row["ciudad"] . "</td>";
            echo "<td>" . $row["pais"] . "</td>";
            echo "<td>
                    <a href='editar_proveedor.php?id="  . $row["id_proveedor"] . "'>Editar</a> |
                    
                    <form action='eliminar_proveedor.php' method='post' style='display:inline;' onsubmit='return cnfirm(\"¿Estás seguro de eliminar este proveedor?\");'>
                        <input type='hidden' name='id_proveedor' value='" . $row["id_rpoveedor"] . "'>
                        <button type='submit'>Eliminar</button>
                    </form>
                </td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>