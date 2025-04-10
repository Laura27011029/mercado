<?php
include 'conexion.php';

//Obtener los productos

$sql = "SELECT p.ID_PRODUCTO, p.NOMBRE_PRODUCTO, p.CANTIDAD_PRODUCTO, p.VALOR_PRODUCTO, c.NOMBRE_CATEGORIA
        FROM productos p
        JOIN categoria c ON p.ID_CATEGORIA = c.ID_CATEGORIA";
$result = $conn -> query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de productos</title>
</head>
<body>
    
    <h2>Gestión de Productos</h2>
    <!-- Formulario para agregar producto -->
    <h3>Agregar producto</h3>
    <form action="insert_producto.php" method = "POST">
        <input type="text" name = "nombre_producto" placeholder = "Nombre del producto" required>

        <input type="number" name = "cantidad_producto" placeholder = "Cantidad" required>

        <input type="number" name = "valor_producto" placeholder = "Valor del Producto" required>

        <select name="id_categoria" required>
            <option value="">Seleccione una categoría</option>

            <?php
            $sqlCat = "SELECT ID_CATEGORIA, NOMBRE_CATEGORIA FROM categoria";
            $resultCat = $conn -> query($sqlCat);

            while ($rowCat = $resultCat -> fetch_assoc()) {
                echo "<option value = '" . $rowCat['ID_CATEGORIA']. "'>" . $rowCat['NOMBRE_CATEGORIA']. "</option>";
            }
            ?>
        </select>
        <button type = "submit" name = "insertar">Agregar</button>
    </form>

    <h3>Lista de productos</h3>
    <table border = "1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Cantidad</th>
            <th>Valor</th>
            <th>Categoria</th>
            <th>Acciones</th>
        </tr>
        
        <?php
        while ($row = $result -> fetch_assoc()):
        ?>

            <tr>
                <td><?=$row['ID_PRODUCTO']?></td>
                <td><?=$row['NOMBRE_PRODUCTO']?></td>
                <td><?=$row['CANTIDAD_PRODUCTO']?></td>
                <td><?=$row['VALOR_PRODUCTO']?></td>
                <td><?=$row['NOMBRE_CATEGORIA']?></td>
                <td>
                    <a href="update.php?id=<?= $row['ID_PRODUCTO']?>">Editar</a>
                    <a href="delete.php?id=<?= $row['ID_PRODUCTO']?>">Eliminar</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>