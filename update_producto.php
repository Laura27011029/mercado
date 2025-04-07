<?php
include 'conexion.php';

if (isset($_POST['actualizar'])) {
    $id_producto = intval($_POST['id_producto']);
    $nombre_producto = ($_POST['nombre_producto']);
    $cantidad_producto = intval($_POST['cantidad_producto']);
    $valor_producto = intval($_POST['valor_producto']);

    $sql = "UPDATE productos SET NOMBRE_PRODUCTO = ?, CANTIDAD_PRODUCTO = ?, VALOR_PRODUCTO = ? WHERE ID_PRODUCTO = ?";
    $stmt = $conn -> prepare($sql);
    $stmt -> bind_param("siii",$nombre_producto, $cantidad_producto, $valor_producto, $id_producto);

    if ($stmt -> execute()) {
        //Redirigir automaticamente a productos.php despues de insertar
        header("Location: productos.php");
        exit(); //Asegurar que el script se detiene aquí
    }
    else {
        echo "Error al actualizar el producto: " . $stmt -> error;
    }

    $stmt -> close();
    $conn -> close();
}
?>
