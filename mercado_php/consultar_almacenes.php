<?php

include 'conexion.php';

//Consulta para obtener los almacenes
$sql = "SELECT id_almacen, nombre_almacen, direccion, latitud, longitud, foto FROM almacenes";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de almacenes</title>
    <link rel="stylesheet" href="styles.css" />
</head>
<body>
    <h2>Lista de Almacenes</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Ubicación</th>
                <th>Foto</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['id_almacen']; ?></td>
                        <td><?php echo $row['nombre_almacen']; ?></td>
                        <td><?php echo $row['direccion']; ?></td>
                        <td>
                            <a href="https://www.google.com/maps/search/api=1&query=<?php echo $row['latitud']; ?>,<?php echo $row['longitud']; ?>" target="_blank">Ver en Maps</a>    
                        </td>
                        <td>
                            <?php if ($row['foto']) { ?>
                                <img src="<?php echo $row['foto']; ?>" alt="Foto del Almacén" width="100" height="100" />
                            <?php } else { ?>
                                Sin Foto
                            <?php } ?>
                        </td>
                    </tr>
                <?php }
            } else { ?>
                <tr>
                    <td colspan="5">No hay almacenes registrados.</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="almacen_crud.php">Volver al inicio</a>
</body>
</html>

<?php $conn->close(); ?>