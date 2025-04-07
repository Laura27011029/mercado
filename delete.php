<?php
include 'conexion.php';

if(isset($_GET['id'])) {
    $id_producto = intval($_GET['id']);

    $sql = "DELETE FROM productos WHERE ID_PRODUCTO = ?";
    $stmt = $conn -> prepare($sql);
    $stmt -> bind_param("i" ,$id_producto);

    if ($stmt -> execute()) {
        //Redirigir automaticamente a productos.php despues de insertar
        header("Location: productos.php");
        exit(); //Asegurar que el script se detiene aquí
    }
    else {
        echo "Error al eliminar el producto: " . $stmt -> error;
    }

    $stmt -> close();
    $conn -> close();
}
?>